<form action="<?php echo $payment_url; ?>" method="get" data-monetbil="form">
    <button class="btn btn-block btn-primary m-t-20" type="submit" id="monetbil-payment-widget"<?php echo $id; ?>><?php echo __('Pay by Mobile Money', Monetbil_Woocommerce_Gateway::GATEWAY); ?></button>
</form>