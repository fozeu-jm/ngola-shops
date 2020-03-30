<?php

/**
 * Remove default styles
 */
ob_start();

wp_head();

$linesh = explode("\n", ob_get_clean());
foreach ($linesh as $value) {

    if (false !== stripos($value, '/plugins/monetbil-woocommerce-gateway/assets/css')) {
        echo $value;
    }
}

if (Monetbil_Woocommerce_Gateway::MONETBIL_WIDGET_VERSION_V2 == $this->version) {
    include 'payment-widget-v2.php';
} else {
    include 'payment-widget-v1.php';
}

/**
 * Remove default scripts
 */
ob_start();

wp_footer();

$linesf = explode("\n", ob_get_clean());
foreach ($linesf as $value) {

    if (false !== stripos($value, '/plugins/monetbil-woocommerce-gateway/assets/js')) {
        echo $value;
    }
}