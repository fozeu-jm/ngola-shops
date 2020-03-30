<?php
/**
  Plugin Name: Monetbil - Mobile Money Gateway for WooCommerce
  Plugin URI: https://github.com/Monetbil/monetbil-wordpress-woocommerce
  Description: A Payment Gateway for Mobile Money Payments - WooCommerce
  Version: 1.15.2
  Author: Serge NTONG
  Author URI: https://www.monetbil.com/
  Text Domain: monetbil
 */
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

add_action('plugins_loaded', 'init_monetbil_woocommerce_gateway', 0);

function init_monetbil_woocommerce_gateway()
{
    if (!class_exists('WC_Payment_Gateway')) {
        return;
    }

    /**
     * Add the Gateway to WooCommerce
     *
     * @param array $methods
     * @return array
     */
    function monetbil_woocommerce_register_gateway($methods)
    {
        $methods[] = 'Monetbil_Woocommerce_Gateway';
        return $methods;
    }

    /**
     * Hook on /monetbil/woocommerce/notify
     *
     * @return void
     */
    function monetbil_woocommerce_notify()
    {

        if (!Monetbil_Woocommerce_Gateway::isMonetbilWoocommerceNotify()) {
            return;
        }

//        if (!Monetbil_Woocommerce_Gateway::checkServer()) {
//            header('HTTP/1.0 404 Not Found');
//            exit('Error: 404 Not Found');
//        }

        $item_ref = Monetbil_Woocommerce_Gateway::getPost('item_ref');
        $transaction_id = Monetbil_Woocommerce_Gateway::getPost('transaction_id');

        $params = Monetbil_Woocommerce_Gateway::getPost();

        $module = new Monetbil_Woocommerce_Gateway();
        $monetbil_service_secret = $module->service_secret;

        if (!Monetbil_Woocommerce_Gateway::checkSign($monetbil_service_secret, $params)) {
            header('HTTP/1.0 403 Forbidden');
            exit('Error: Invalid signature');
        }

        $order_id = $item_ref;

        // Get this Order's information so that we know
        // who to charge and how much
        $customer_order = new WC_Order($order_id);

        list($payment_status, $testmode) = Monetbil_Woocommerce_Gateway::checkPayment($transaction_id);

        if (Monetbil_Woocommerce_Gateway::STATUS_SUCCESS == $payment_status
                or Monetbil_Woocommerce_Gateway::STATUS_SUCCESS_TESTMODE == $payment_status
        ) {
            // Payment has been successful

            $order_state = 'completed';
            $note = __('[Monetbil] Successful payment! #' . $transaction_id, Monetbil_Woocommerce_Gateway::GATEWAY);

            if ($testmode) {
                $order_state = 'pending';
                $note .= ' - TEST MODE';
            } else {
                // Payment has been successful
                // Mark order as Paid
                $customer_order->payment_complete($transaction_id);
            }

            $customer_order->update_status($order_state);
            $customer_order->add_order_note($note);
        } elseif (Monetbil_Woocommerce_Gateway::STATUS_CANCELLED == $payment_status
                or Monetbil_Woocommerce_Gateway::STATUS_CANCELLED_TESTMODE == $payment_status) {

            // Transaction cancelled

            $order_state = 'cancelled';
            $note = __('[Monetbil] Transaction cancelled! #' . $transaction_id, Monetbil_Woocommerce_Gateway::GATEWAY);

            if ($testmode) {
                $order_state = 'cancelled';
                $note .= ' - TEST MODE';
            }

            $customer_order->update_status($order_state);
            $customer_order->add_order_note($note);
        } elseif (Monetbil_Woocommerce_Gateway::STATUS_FAILED == $payment_status
                or Monetbil_Woocommerce_Gateway::STATUS_FAILED_TESTMODE == $payment_status) {

            // Payment failed

            $order_state = 'failed';
            $note = __('[Monetbil] Payment failed! #' . $transaction_id, Monetbil_Woocommerce_Gateway::GATEWAY);

            if ($testmode) {
                $order_state = 'failed';
                $note .= ' - TEST MODE';
            }

            $customer_order->update_status($order_state);
            $customer_order->add_order_note($note);
        }

        // Received
        exit('received');
    }

    /**
     * Hook on /monetbil/woocommerce/return
     *
     * @global WooCommerce $woocommerce
     * @return void
     */
    function monetbil_woocommerce_return()
    {

        if (!Monetbil_Woocommerce_Gateway::isMonetbilWoocommerceReturnPage()) {
            return;
        }

        global $woocommerce;
        $woocommerce instanceof WooCommerce;

        $params = Monetbil_Woocommerce_Gateway::getQueryParams();

        $module = new Monetbil_Woocommerce_Gateway();
        $monetbil_service_secret = $module->service_secret;

        if (!Monetbil_Woocommerce_Gateway::checkSign($monetbil_service_secret, $params)) {
            Monetbil_Woocommerce_Gateway::redirectToCheckout();
        }

        $item_ref = Monetbil_Woocommerce_Gateway::getQuery('item_ref');

        $order_id = $item_ref;

        // Get this Order's information so that we know
        // who to charge and how much
        $customer_order = new WC_Order($order_id);

        //Empty the cart (Very important step)
        $woocommerce->cart->empty_cart();

        // Redirect
        Monetbil_Woocommerce_Gateway::forceRedirect($customer_order);
    }

    /**
     * Register scripts
     *
     * @return void
     */
    function monetbil_woocommerce_register_scripts()
    {

        wp_register_script('monetbil-wcc-widget-v1', plugins_url('assets/js/monetbil-mobile-payments.js', __FILE__), '', time(), true);
        wp_register_script('monetbil-wcc-widget-v2', plugins_url('assets/js/monetbil.min.js', __FILE__), '', time(), true);
    }

    /**
     * Add Actions Links
     *
     * @param array $actions
     * @return array
     */
    function monetbil_woocommerce_actions_links($actions)
    {
        $custom_actions = array(
            'Create An Account' => '<a href="https://www.monetbil.com/try-monetbil" target="_blank">' . __('Create An Account', Monetbil_Woocommerce_Gateway::GATEWAY) . '</a>',
            'Create new service' => '<a href="https://www.monetbil.com/services/create" target="_blank">' . __('Create new service', Monetbil_Woocommerce_Gateway::GATEWAY) . '</a>'
        );

        return array_merge($custom_actions, $actions);
    }

    /**
     * Monetbil Woocommerce Gateway class
     */
    class Monetbil_Woocommerce_Gateway extends WC_Payment_Gateway
    {

        const GATEWAY = 'monetbil';
        const WIDGET_URL = 'https://www.monetbil.com/widget/';
        const GET_SERVICE_URL = 'https://api.monetbil.com/v1/services/get';
        const CHECK_PAYMENT_URL = 'https://api.monetbil.com/payment/v1/checkPayment';
        // WooCommerce
        const WOOCOMMERCE_RETURN_URI = '/monetbil/woocommerce/return';
        const WOOCOMMERCE_NOTIFY_URI = '/monetbil/woocommerce/notify';
        const MONETBIL_PAYMENT_ENABLED = 'MONETBIL_PAYMENT_ENABLED';
        const MONETBIL_PAYMENT_TITLE = 'MONETBIL_PAYMENT_TITLE';
        const MONETBIL_PAYMENT_DESCRIPTION = 'MONETBIL_PAYMENT_DESCRIPTION';
        // Monetbil Service
        const MONETBIL_SERVICE_KEY = 'MONETBIL_SERVICE_KEY';
        const MONETBIL_SERVICE_SECRET = 'MONETBIL_SERVICE_SECRET';
        const MONETBIL_MERCHANT_NAME = 'MONETBIL_MERCHANT_NAME';
        const MONETBIL_MERCHANT_EMAIL = 'MONETBIL_MERCHANT_EMAIL';
        const MONETBIL_SERVICE_NAME = 'MONETBIL_SERVICE_NAME';
        // Monetbil Payment redirection
        const MONETBIL_PAYMENT_REDIRECTION_DEFAULT = 'no';
        const MONETBIL_PAYMENT_REDIRECTION_YES = 'yes';
        const MONETBIL_PAYMENT_REDIRECTION_NO = 'no';
        const MONETBIL_PAYMENT_REDIRECTION = 'MONETBIL_PAYMENT_REDIRECTION';
        // Monetbil Widget version
        const MONETBIL_WIDGET_DEFAULT_VERSION = 'v2.1';
        const MONETBIL_WIDGET_VERSION_V1 = 'v1';
        const MONETBIL_WIDGET_VERSION_V2 = 'v2.1';
        const MONETBIL_WIDGET_VERSION = 'MONETBIL_WIDGET_VERSION';
        // Live mode
        const STATUS_SUCCESS = 1;
        const STATUS_FAILED = 0;
        const STATUS_CANCELLED = -1;
        // Test mode
        const STATUS_SUCCESS_TESTMODE = 7;
        const STATUS_FAILED_TESTMODE = 8;
        const STATUS_CANCELLED_TESTMODE = 9;

        protected static $instance = null;
        protected $configured = false;

        public function __construct()
        {
            // The global ID for this Payment method
            $this->id = Monetbil_Woocommerce_Gateway::GATEWAY;

            // The Title shown on the top of the Payment Gateways Page next to all the other Payment Gateways
            $this->method_title = __('Monetbil', Monetbil_Woocommerce_Gateway::GATEWAY);

            $this->order_button_text = __('Pay by Mobile Money via Monetbil', Monetbil_Woocommerce_Gateway::GATEWAY);

            // The description for this Payment Gateway, shown on the actual Payment options page on the backend
            $this->method_description = __('Payment Gateway for WooCommerce', Monetbil_Woocommerce_Gateway::GATEWAY);

            // The title to be used for the vertical tabs that can be ordered top to bottom
            $this->title = __('Monetbil', Monetbil_Woocommerce_Gateway::GATEWAY);

            // If you want to show an image next to the gateway's name on the frontend, enter a URL to an image.
            $this->icon = WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__)) . '/monetbil_partners_logo.png';

            // Bool. Can be set to true if you want payment fields to show on the checkout
            // if doing a direct integration, which we are doing in this case
            $this->has_fields = true;

            // Supports the default credit card form
            $this->supports = array('subscriptions', 'products', 'subscription_cancellation', 'subscription_reactivation', 'subscription_suspension', 'subscription_amount_changes', 'subscription_date_changes');

            // This basically defines your settings which are then loaded with init_settings()
            $this->init_form_fields();

            // After init_settings() is called, you can get the settings and load them into variables, e.g:
            // $this->title = $this->get_option( 'title' );
            $this->init_settings();

            // Get setting values
            $this->enabled = $this->get_option(Monetbil_Woocommerce_Gateway::MONETBIL_PAYMENT_ENABLED);
            $this->title = $this->get_option(Monetbil_Woocommerce_Gateway::MONETBIL_PAYMENT_TITLE);
            $this->description = $this->get_option(Monetbil_Woocommerce_Gateway::MONETBIL_PAYMENT_DESCRIPTION);
            $this->service_key = $this->get_option(Monetbil_Woocommerce_Gateway::MONETBIL_SERVICE_KEY);
            $this->service_secret = $this->get_option(Monetbil_Woocommerce_Gateway::MONETBIL_SERVICE_SECRET);
            $this->version = $this->get_option(Monetbil_Woocommerce_Gateway::MONETBIL_WIDGET_VERSION, Monetbil_Woocommerce_Gateway::MONETBIL_WIDGET_DEFAULT_VERSION);
            $this->redirection = $this->get_option(Monetbil_Woocommerce_Gateway::MONETBIL_PAYMENT_REDIRECTION, Monetbil_Woocommerce_Gateway::MONETBIL_PAYMENT_REDIRECTION_DEFAULT);

            add_action('woocommerce_receipt_' . $this->id, array($this, 'payment_page'));

            // Save settings
            if (is_admin()) {
                // Versions over 2.0
                // Save our administration options. Since we are not going to be doing anything special
                // we have not defined 'process_admin_options' in this class so the method in the parent
                // class will be used instead
                add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));

                // For old version

                $monetbil_settings = get_option('woocommerce_monetbil_settings');

                if (is_array($monetbil_settings) and array_key_exists(Monetbil_Woocommerce_Gateway::MONETBIL_WIDGET_VERSION, $monetbil_settings)) {
                    $version = $monetbil_settings[Monetbil_Woocommerce_Gateway::MONETBIL_WIDGET_VERSION];

                    if (0 === strpos($version, 'v2')) {
                        $monetbil_settings[Monetbil_Woocommerce_Gateway::MONETBIL_WIDGET_VERSION] = Monetbil_Woocommerce_Gateway::MONETBIL_WIDGET_VERSION_V2;
                        update_option('woocommerce_monetbil_settings', $monetbil_settings);
                    }
                }

                $post = get_page_by_path('monetbil-redirect');

                if ($post instanceof WP_Post) {
                    wp_delete_post($post->ID, true);
                }
            }
        }

        /**
         * admin_options
         *
         * @return void inline html
         */
        public function admin_options()
        {
            ?>

            <h3><?php echo (!empty($this->method_title) ) ? $this->method_title : __('Settings', 'woocommerce'); ?></h3>

            <?php echo (!empty($this->method_description) ) ? wpautop($this->method_description) : ''; ?>
            <style type="text/css">
                .alert {
                    border: 1px solid transparent;
                    border-radius: 0;
                    margin-bottom: 18px;
                    padding: 15px;
                    font-weight: bold;
                    color: #fff;
                }
                .alert-info {
                    background-color: #5192f3;
                }
                .alert-error {
                    background-color: #ff0000;
                }
            </style>
            <?php $this->generateNotice() ?>
            <table class="form-table">
                <?php $this->generate_settings_html(); ?>
            </table><?php
        }

        /**
         * generateNotice
         *
         * @return void inline html
         */
        public function generateNotice()
        {
            if ($this->configured) {
                ?>
                <p class="alert alert-info">
                    <span class="dashicons dashicons-yes"></span>  <?php echo __('Service perfectly configured', Monetbil_Woocommerce_Gateway::GATEWAY); ?>
                </p>
                <?php
            } else {
                ?>
                <p class="alert alert-error">
                    <span class="dashicons dashicons-no"></span>  <?php echo __('Service not configured', Monetbil_Woocommerce_Gateway::GATEWAY); ?>
                </p>
                <?php
            }
        }

        /**
         * process_admin_options
         *
         * @return void
         */
        public function process_admin_options()
        {
            $service_key = Monetbil_Woocommerce_Gateway::getPost('woocommerce_' . $this->id . '_' . Monetbil_Woocommerce_Gateway::MONETBIL_SERVICE_KEY);
            $service_secret = Monetbil_Woocommerce_Gateway::getPost('woocommerce_' . $this->id . '_' . Monetbil_Woocommerce_Gateway::MONETBIL_SERVICE_SECRET);

            $service = Monetbil_Woocommerce_Gateway::getService($service_key, $service_secret);

            if (array_key_exists('service_key', $service)
                    and array_key_exists('service_secret', $service)
                    and array_key_exists('service_name', $service)
                    and array_key_exists('Merchants', $service)
            ) {
                update_option(self::MONETBIL_MERCHANT_NAME, $service['Merchants']['first_name'] . ' ' . $service['Merchants']['last_name']);
                update_option(self::MONETBIL_MERCHANT_EMAIL, $service['Merchants']['email']);
                update_option(self::MONETBIL_SERVICE_NAME, $service['service_name']);

                parent::process_admin_options();
            }
        }

        /**
         * Build the administration fields for this specific Gateway
         *
         * @return void
         */
        public function init_form_fields()
        {
            $merchant_name = get_option(self::MONETBIL_MERCHANT_NAME);
            $merchant_email = get_option(self::MONETBIL_MERCHANT_EMAIL);
            $service_name = get_option(self::MONETBIL_SERVICE_NAME);

            if ($merchant_name
                    and $merchant_email
                    and $service_name
            ) {
                $this->configured = true;
            }

            $this->form_fields = array();

            $this->form_fields[Monetbil_Woocommerce_Gateway::MONETBIL_PAYMENT_ENABLED] = array(
                'title' => __('Enable / Disable', Monetbil_Woocommerce_Gateway::GATEWAY),
                'label' => __('Enable this payment gateway.', Monetbil_Woocommerce_Gateway::GATEWAY),
                'type' => 'checkbox',
                'default' => 'yes',
                'desc_tip' => true,
            );
            $this->form_fields[Monetbil_Woocommerce_Gateway::MONETBIL_PAYMENT_TITLE] = array(
                'title' => __('Title', Monetbil_Woocommerce_Gateway::GATEWAY),
                'type' => 'text',
                'desc_tip' => __('Payment title that the customer will see during the ordering process.', Monetbil_Woocommerce_Gateway::GATEWAY),
                'default' => __('Monetbil (Mobile Money)', Monetbil_Woocommerce_Gateway::GATEWAY),
            );
            $this->form_fields[Monetbil_Woocommerce_Gateway::MONETBIL_PAYMENT_DESCRIPTION] = array(
                'title' => __('Description', Monetbil_Woocommerce_Gateway::GATEWAY),
                'type' => 'textarea',
                'desc_tip' => __('Payment description that the customer will see during the ordering process.', Monetbil_Woocommerce_Gateway::GATEWAY),
                'default' => __('Pay safely using your Mobile Money account.', Monetbil_Woocommerce_Gateway::GATEWAY),
                'css' => 'max-width:350px;'
            );

            if ($merchant_name) {
                $this->form_fields[Monetbil_Woocommerce_Gateway::MONETBIL_MERCHANT_NAME] = array(
                    'title' => __('Merchant name', Monetbil_Woocommerce_Gateway::GATEWAY),
                    'type' => 'text',
                    'disabled' => true,
                    'css' => 'color:#000;font-weight:bold;',
                    'placeholder' => $merchant_name
                );
            }

            if ($merchant_email) {
                $this->form_fields[Monetbil_Woocommerce_Gateway::MONETBIL_MERCHANT_EMAIL] = array(
                    'title' => __('Merchant email', Monetbil_Woocommerce_Gateway::GATEWAY),
                    'type' => 'text',
                    'disabled' => true,
                    'css' => 'color:#000;font-weight:bold;',
                    'placeholder' => $merchant_email
                );
            }

            if ($service_name) {
                $this->form_fields[Monetbil_Woocommerce_Gateway::MONETBIL_SERVICE_NAME] = array(
                    'title' => __('Service name', Monetbil_Woocommerce_Gateway::GATEWAY),
                    'type' => 'text',
                    'disabled' => true,
                    'css' => 'color:#000;font-weight:bold;',
                    'placeholder' => $service_name
                );
            }

            $this->form_fields[Monetbil_Woocommerce_Gateway::MONETBIL_SERVICE_KEY] = array(
                'title' => __('Service key', Monetbil_Woocommerce_Gateway::GATEWAY),
                'type' => 'text',
                'desc_tip' => __('This is the service key provided by Monetbil when you created a service.', Monetbil_Woocommerce_Gateway::GATEWAY),
            );
            $this->form_fields[Monetbil_Woocommerce_Gateway::MONETBIL_SERVICE_SECRET] = array(
                'title' => __('Service secret', Monetbil_Woocommerce_Gateway::GATEWAY),
                'type' => 'text',
                'desc_tip' => __('This is the service secret Monetbil generated when creating a service.', Monetbil_Woocommerce_Gateway::GATEWAY),
            );
            $this->form_fields[Monetbil_Woocommerce_Gateway::MONETBIL_WIDGET_VERSION] = array(
                'title' => __('Select version', Monetbil_Woocommerce_Gateway::GATEWAY),
                'type' => 'select',
                'options' => array(
                    Monetbil_Woocommerce_Gateway::MONETBIL_WIDGET_VERSION_V2 => __('Version 2 (Responsive)', Monetbil_Woocommerce_Gateway::GATEWAY),
                    Monetbil_Woocommerce_Gateway::MONETBIL_WIDGET_VERSION_V1 => __('Version 1 (Not responsive)', Monetbil_Woocommerce_Gateway::GATEWAY)
                )
            );
            $this->form_fields[Monetbil_Woocommerce_Gateway::MONETBIL_PAYMENT_REDIRECTION] = array(
                'title' => __('Payment redirection', Monetbil_Woocommerce_Gateway::GATEWAY),
                'type' => 'select',
                'options' => array(
                    Monetbil_Woocommerce_Gateway:: MONETBIL_PAYMENT_REDIRECTION_YES => __('YES', Monetbil_Woocommerce_Gateway::GATEWAY),
                    Monetbil_Woocommerce_Gateway::MONETBIL_PAYMENT_REDIRECTION_NO => __('NO', Monetbil_Woocommerce_Gateway::GATEWAY)
                )
            );
        }

        public function get_monetbil_payment_url($customer_order)
        {
            $customer_order instanceof WC_Order;
            $total = round($customer_order->order_total, 0, PHP_ROUND_HALF_UP);

            // Get the return url
            $return_url = Monetbil_Woocommerce_Gateway::getServerUrl() . Monetbil_Woocommerce_Gateway::WOOCOMMERCE_RETURN_URI;

            // Get the notify url
            $notify_url = Monetbil_Woocommerce_Gateway::getServerUrl() . Monetbil_Woocommerce_Gateway::WOOCOMMERCE_NOTIFY_URI;

            // Setup Monetbil arguments
            $monetbil_args = array(
                'amount' => $total,
                'phone' => '',
                'locale' => get_locale(), // Display language fr or en
                'country' => 'CM',
                'currency' => $customer_order->currency,
                'item_ref' => $customer_order->id,
                'payment_ref' => $customer_order->order_key,
                'user' => get_current_user_id(),
                'first_name' => $customer_order->billing_first_name,
                'last_name' => $customer_order->billing_last_name,
                'email' => $customer_order->billing_email,
                'return_url' => $return_url,
                'notify_url' => $notify_url
            );

            $monetbil_args['sign'] = Monetbil_Woocommerce_Gateway::sign($this->service_secret, $monetbil_args);

            $payment_url = null;

            if (Monetbil_Woocommerce_Gateway::MONETBIL_WIDGET_VERSION_V2 == $this->version) {

                $response = wp_remote_post(Monetbil_Woocommerce_Gateway::getWidgetUrl($this->service_key, $this->version), array(
                    'body' => $monetbil_args
                ));

                $body = wp_remote_retrieve_body($response);

                $result = json_decode($body, true);

                if (is_array($result) and array_key_exists('payment_url', $result)) {
                    $payment_url = $result['payment_url'];
                }
            }

            if (!$payment_url) {
                $this->version = Monetbil_Woocommerce_Gateway::MONETBIL_WIDGET_VERSION_V1;
                $payment_url = Monetbil_Woocommerce_Gateway::getWidgetV1Url($monetbil_args, $this->service_key, $this->version);
            }

            return $payment_url;
        }

        /**
         * Submit payment and handle response
         *
         * @param int $order_id
         * @return array
         */
        public function process_payment($order_id)
        {
            // Get this Order's information so that we know
            // who to charge and how much
            $customer_order = new WC_Order($order_id);

            if (Monetbil_Woocommerce_Gateway::MONETBIL_PAYMENT_REDIRECTION_NO == $this->redirection) {
                $payment_url = $customer_order->get_checkout_payment_url(true);
            } else {
                $payment_url = $this->get_monetbil_payment_url($customer_order);
            }

            return array(
                'result' => 'success',
                'redirect' => $payment_url
            );
        }

        /**
         * payment_page Output iframe
         *
         * @param int $order_id
         * @return void
         */
        public function payment_page($order_id)
        {
            // Get this Order's information so that we know
            // who to charge and how much
            $customer_order = new WC_Order($order_id);

            $payment_url = $this->get_monetbil_payment_url($customer_order);

            if (Monetbil_Woocommerce_Gateway::MONETBIL_WIDGET_VERSION_V2 == $this->version) {
                wp_enqueue_script('monetbil-wcc-widget-v2');
            } else {
                wp_enqueue_script('monetbil-wcc-widget-v1');
            }

            ($payment_url);

            include 'templates/receipt.php';
        }

        /**
         * getService
         *
         * @param string $service_key
         * @param string $service_secret
         * @return array
         */
        public static function getService($service_key, $service_secret)
        {
            $postData = array(
                'service_key' => $service_key,
                'service_secret' => $service_secret,
            );

            $response = wp_remote_post(Monetbil_Woocommerce_Gateway::GET_SERVICE_URL, array(
                'body' => $postData
            ));

            $body = wp_remote_retrieve_body($response);
            $result = json_decode($body, true);

            if (is_array($result)) {
                return $result;
            }

            return array();
        }

        /**
         * sign
         *
         * @param string $service_secret
         * @param array $params
         * @return string
         */
        public static function sign($service_secret, $params)
        {
            ksort($params);
            $signature = md5($service_secret . implode('', $params));
            return $signature;
        }

        /**
         * checkSign
         *
         * @param string $service_secret
         * @param array $params
         * @return boolean
         */
        public static function checkSign($service_secret, $params)
        {
            if (!array_key_exists('sign', $params)) {
                return false;
            }

            $sign = $params['sign'];
            unset($params['sign']);

            $signature = Monetbil_Woocommerce_Gateway::sign($service_secret, $params);

            return ($sign == $signature);
        }

        /**
         * checkServer
         *
         * @return boolean
         */
        public static function checkServer()
        {
            return in_array($_SERVER['REMOTE_ADDR'], array(
                '184.154.229.42'
            ));
        }

        /**
         * checkPayment
         *
         * @param string $paymentId
         * @return array ($payment_status, $testmode)
         */
        public static function checkPayment($paymentId)
        {
            $postData = array(
                'paymentId' => $paymentId
            );

            $response = wp_remote_post(Monetbil_Woocommerce_Gateway::CHECK_PAYMENT_URL, array(
                'body' => $postData
            ));

            $body = wp_remote_retrieve_body($response);
            $result = json_decode($body, true);

            $payment_status = 0;
            $testmode = 0;
            if (is_array($result) and array_key_exists('transaction', $result)) {
                $transaction = $result['transaction'];

                $payment_status = $transaction['status'];
                $testmode = $transaction['testmode'];
            }

            return array($payment_status, $testmode);
        }

        /**
         * getPost
         *
         * @param string $key
         * @param string $default
         * @return string
         */
        public static function getPost($key = null, $default = null)
        {
            return $key == null ? $_POST : (isset($_POST[$key]) ? $_POST[$key] : $default);
        }

        /**
         * getQuery
         *
         * @param string $key
         * @param string $default
         * @return string
         */
        public static function getQuery($key = null, $default = null)
        {
            return $key == null ? $_GET : (isset($_GET[$key]) ? $_GET[$key] : $default);
        }

        /**
         * getQueryParams
         *
         * @return array
         */
        public static function getQueryParams()
        {
            $queryParams = array();
            $parts = explode('?', Monetbil_Woocommerce_Gateway::getUrl());

            if (isset($parts[1])) {
                parse_str($parts[1], $queryParams);
            }

            return $queryParams;
        }

        /**
         * @return string | null
         */
        public static function getServerUrl()
        {
            return get_site_url();
        }

        /**
         * @return string | null
         */
        public static function getUrl()
        {
            $url = Monetbil_Woocommerce_Gateway::getServerUrl() . Monetbil_Woocommerce_Gateway::getUri();
            return $url;
        }

        /**
         * @return string | null
         */
        public static function getUri()
        {
            $requestUri = $_SERVER['REQUEST_URI'];
            $uri = '/' . ltrim($requestUri, '/');

            return $uri;
        }

        /**
         * getWidgetUrl
         *
         * @param string $service_key
         * @param string $version
         * @return string
         */
        public static function getWidgetUrl($service_key, $version)
        {
            $widget_url = Monetbil_Woocommerce_Gateway::WIDGET_URL . $version . '/' . $service_key;
            return $widget_url;
        }

        /**
         * getWidgetV1Url
         *
         * @param array $monetbil_args
         * @return string
         */
        public static function getWidgetV1Url($monetbil_args, $service_key, $version)
        {
            $monetbil_v1_redirect = Monetbil_Woocommerce_Gateway::getWidgetUrl($service_key, $version) . '?' . http_build_query($monetbil_args, '', '&');
            return $monetbil_v1_redirect;
        }

        /**
         * @return boolean
         */
        public static function isMonetbilWoocommerceReturnPage()
        {
            $uri = Monetbil_Woocommerce_Gateway::getUri();

            if (false === stripos($uri, Monetbil_Woocommerce_Gateway::WOOCOMMERCE_RETURN_URI)) {
                return false;
            }

            return true;
        }

        /**
         * @return boolean
         */
        public static function isMonetbilWoocommerceNotify()
        {
            $uri = Monetbil_Woocommerce_Gateway::getUri();

            if (false === stripos($uri, Monetbil_Woocommerce_Gateway::WOOCOMMERCE_NOTIFY_URI)) {
                return false;
            }

            return true;
        }

        /**
         * redirectToCheckout
         *
         * @return void
         */
        public static function redirectToCheckout()
        {
            global $woocommerce;
            $checkout_url = $woocommerce->cart->get_checkout_url();
            wp_redirect($checkout_url);
            exit;
        }

        /**
         * forceRedirect
         *
         * @param string $customer_order
         * @return void
         */
        public static function forceRedirect($customer_order)
        {
            $module = new Monetbil_Woocommerce_Gateway();

            // Redirect to thank you page
            echo ''
            . '<script type="text/javascript">'
            . 'location.href="' . $module->get_return_url($customer_order) . '";'
            . '</script>';
        }

    }

    add_action('parse_request', 'monetbil_woocommerce_return');
    add_action('parse_request', 'monetbil_woocommerce_notify');
    add_action('wp_enqueue_scripts', 'monetbil_woocommerce_register_scripts');

    add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'monetbil_woocommerce_actions_links', 10, 1);
    add_filter('woocommerce_payment_gateways', 'monetbil_woocommerce_register_gateway');
}
