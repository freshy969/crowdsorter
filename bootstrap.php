<?php
/*
Plugin Name: Crowd-Sorter
Description: Sorts things based on user-votes + algorithms. Good for news aggregation, among other things
Version:     0.0.1
Author:      samirillian
Author URI:  https://viridian.tech
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PONDS_AGGREGATOR_REQUIRED_PHP_VERSION', '5.3' ); // because of get_called_class()
define( 'PONDS_AGGREGATOR_REQUIRED_WP_VERSION',  '3.0' );
define( 'PONDS_AGGREGATOR_REQUIRED_WP_NETWORK',  false ); // because plugin is not compatible with WordPress multisite

/**
 * Checks if the system requirements are met
 *
 * @since    1.0.0
 * @return bool True if system requirements are met, false if not
 */
function ponds_aggregator_requirements_met() {

	global $wp_version;

	if ( version_compare( PHP_VERSION, PONDS_AGGREGATOR_REQUIRED_PHP_VERSION, '<' ) ) {
		return false;
	}
	if ( version_compare( $wp_version, PONDS_AGGREGATOR_REQUIRED_WP_VERSION, '<' ) ) {
		return false;
	}
	if ( is_multisite() != PONDS_AGGREGATOR_REQUIRED_WP_NETWORK ) {
		return false;
	}

	return true;

}

/**
 * Prints an error that the system requirements weren't met.
 *
 * @since    1.0.0
 */
function ponds_aggregator_show_requirements_error() {

	global $wp_version;
	require_once( dirname( __FILE__ ) . '/views/admin/errors/requirements-error.php' );

}

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
function run_ponds_aggregator() {

	/**
	 * Check requirements and load main class
	 * The main program needs to be in a separate file that only gets loaded if the plugin requirements are met.
	 * Otherwise older PHP installations could crash when trying to parse it.
	 **/
	if ( ponds_aggregator_requirements_met() ) {

		/**
		 * The core plugin class that is used to define internationalization,
		 * admin-specific hooks, and public-facing site hooks.
		 */
		// require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-name.php';
    //
		// /**
		//  * Begins execution of the plugin.
		//  *
		//  * Since everything within the plugin is registered via hooks,
		//  * then kicking off the plugin from this point in the file does
		//  * not affect the page life cycle.
		//  *
		//  * @since    1.0.0
		//  */
		// $plugin = Ponds_Aggregator::get_instance();

    require_once plugin_dir_path( __FILE__ ) . 'includes/class-controller.php';
		register_activation_hook( __FILE__, array( 'crowdSortController', 'plugin_activated' ) );

	} else {

		add_action( 'admin_notices', 'ponds_aggregator_show_requirements_error' );
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		deactivate_plugins( plugin_basename( __FILE__ ) );

	}

}
run_ponds_aggregator();