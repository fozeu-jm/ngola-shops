<?php

/**
 * Uninstall Monetbil
 *
 * Deletes all settings.
 *
 * @package     Monetbil
 * @subpackage  Uninstall
 * @copyright   Copyright (c) 2017, Serge NTONG
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
// Exit if accessed directly.
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Delete setting values
delete_option('woocommerce_monetbil_settings');
delete_option('MONETBIL_MERCHANT_NAME');
delete_option('MONETBIL_MERCHANT_EMAIL');
delete_option('MONETBIL_SERVICE_NAME');

