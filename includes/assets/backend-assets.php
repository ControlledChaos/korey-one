<?php
/**
 * Admin assets
 *
 * Methods for enqueueing and printing assets
 * such as JavaScript and CSS files.
 *
 * @package    Korey_One
 * @subpackage Includes
 * @category   Admin
 * @since      1.0.0
 */

namespace KoreyOne\Admin_Assets;

// Alias namespaces.
use KoreyOne\Classes\Core as Core,
	KoreyOne\Customize    as Customize;

use function KoreyOne\Shared_Assets\suffix;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Execute functions
 *
 * @since  1.0.0
 * @return void
 */
function setup() {

	// Return namespaced function.
	$ns = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	// Admin scripts.
	add_action( 'admin_enqueue_scripts', $ns( 'admin_scripts' ) );

	/**
	 * Admin styles
	 * Call late to override plugin styles.
	 */
	add_action( 'admin_enqueue_scripts', $ns( 'admin_styles' ), 99 );
}

/**
 * Admin scripts
 *
 * @since  1.0.0
 * @return void
 */
function admin_scripts() {}

/**
 * Admin styles
 *
 * @since  1.0.0
 * @return void
 */
function admin_styles() {

	// Get Customizer settings.
	$use_theme = Customize\use_admin_theme( get_theme_mod( 'kwo_admin_theme' ) );

	// Enqueue admin theme styles if set in the Customizer.
	if ( $use_theme ) {
		wp_enqueue_style( 'kwo-admin', get_theme_file_uri( '/assets/css/admin' . suffix() . '.css' ), [], KWO_VERSION, 'all' );

		if ( is_rtl() ) {
			wp_enqueue_style( 'kwo-admin-rtl', get_theme_file_uri( '/assets/css/admin-rtl' . suffix() . '.css' ), [], KWO_VERSION, 'all' );
		}
	}
	wp_enqueue_style( 'kwo-admin-acf', get_theme_file_uri( '/assets/css/admin-acf' . suffix() . '.css' ), [], KWO_VERSION, 'all' );
}
