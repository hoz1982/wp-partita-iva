<?php
/*
Plugin Name: Wooocommerce Partita Iva e Fattura Elettronica FREE
Plugin URI:  https://github.com/hoz1982/woocommerce-partita-iva
Description: Wooocommerce Partita Iva e Fattura Elettronica FREE Aggiunge il supporto per l'inserimento nel form di pagamento di Woocommerce dei campi Partita IVA, Codice Fiscale, Codice Cliente e indirizzo PEC, necessari alla fatturazione elettronica in Italia.

Wooocommerce Partita Iva e Fattura Elettronica FREE adds to the Woocommerce standard checkout form some custom fields(VAT Number, Fiscal Code, NIN Code and PEC email address) required for the italian market.

Version:     1.0
Author:      Alessandro Romani
Author URI:  https://www.blacklotus.eu
*/


if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

define( 'wp_partita_iva_NAME',                 'Wooocommerce Partita Iva e Fattura Elettronica FREE' );
define( 'wp_partita_iva_REQUIRED_PHP_VERSION', '5.3' );                          // because of get_called_class()
define( 'wp_partita_iva_REQUIRED_WP_VERSION',  '3.1' );                          // because of esc_textarea()

/**
 * Checks if the system requirements are met
 *
 * @return bool True if system requirements are met, false if not
 */
function wp_partita_iva_requirements_met() {
	global $wp_version;
	//require_once( ABSPATH . '/wp-admin/includes/plugin.php' );		// to get is_plugin_active() early

	if ( version_compare( PHP_VERSION, wp_partita_iva_REQUIRED_PHP_VERSION, '<' ) ) {
		return false;
	}

	if ( version_compare( $wp_version, wp_partita_iva_REQUIRED_WP_VERSION, '<' ) ) {
		return false;
	}

	/*
	if ( ! is_plugin_active( 'plugin-directory/plugin-file.php' ) ) {
		return false;
	}
	*/

	return true;
}

/**
 * Prints an error that the system requirements weren't met.
 */
function wp_partita_iva_requirements_error() {
	global $wp_version;

	require_once( dirname( __FILE__ ) . '/views/requirements-error.php' );
}

/*
 * Check requirements and load main class
 * The main program needs to be in a separate file that only gets loaded if the plugin requirements are met. Otherwise older PHP installations could crash when trying to parse it.
 */
if ( wp_partita_iva_requirements_met() ) {
	require_once( __DIR__ . '/classes/wp_partita_iva-module.php' );
	require_once( __DIR__ . '/classes/wordpress_partita_iva.php' );
	require_once( __DIR__ . '/classes/wp_partita_iva-settings.php' );
	require_once( __DIR__ . '/classes/wp_partita_iva-cron.php' );
	require_once( __DIR__ . '/classes/wp_partita_iva-instance-class.php' );

    if (class_exists('WordPress_Partita_IVA')) {
		$GLOBALS['wp_partita_iva'] = WordPress_Partita_IVA::get_instance();
		register_activation_hook(   __FILE__, array( $GLOBALS['wp_partita_iva'], 'activate' ) );
		register_deactivation_hook( __FILE__, array( $GLOBALS['wp_partita_iva'], 'deactivate' ) );
	}
} else {
	add_action( 'admin_notices', 'wp_partita_iva_requirements_error' );
}
