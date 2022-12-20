<?php
/**
 * Korey One functions
 *
 * First theme specifically designed for the Korey Washington Production Design website.
 *
 * @package    Korey_One
 * @subpackage Functions
 * @since      1.0.0
 * @link       https://github.com/ControlledChaos/korey-one
 */

namespace KoreyOne;

// Alias namespaces.
use
KoreyOne\Classes        as General,
KoreyOne\Classes\Core   as Core,
KoreyOne\Classes\Front  as Front,
KoreyOne\Classes\Admin  as Admin_Class,
KoreyOne\Classes\Vendor as Vendor;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get plugins path
 *
 * Used to check for active plugins with the `is_plugin_active` function.
 * Namespace escaped in example ( \ ) as it sometimes causes an error.
 *
 * @link https://developer.wordpress.org/reference/functions/is_plugin_active/
 *
 * @example The following would check for the Advanced Custom Fields plugin:
 *          ```
 *          if ( \is_plugin_active( 'advanced-custom-fields/acf.php' ) ) {
 *          	// Execute code.
 *           }
 *          ```
 */
$get_plugin = ABSPATH . 'wp-admin/includes/plugin.php';
if ( file_exists( $get_plugin ) ) {
	include_once( $get_plugin );
}

// Get theme configuration file.
require get_parent_theme_file_path( '/includes/config.php' );

// Get the PHP version class.
require_once get_parent_theme_file_path( '/includes/php.php' );

/**
 * PHP version check
 *
 * Disables theme front end if the minimum PHP version is not met.
 * Prevents breaking sites running older PHP versions.
 *
 * @since  1.0.0
 * @return void
 */
if ( ! PHP\version() && ! is_admin() ) {

	// Get the conditional message.
	$die = PHP\frontend_message();

	// Print the die message.
	die( $die );
}

// Autoload class files.
require_once KWO_PATH . 'includes/autoloader.php';

// Get compatibility functions.
require KWO_PATH . 'includes/vendor/compatibility.php';

// Load required files.
foreach ( glob( KWO_PATH . 'includes/activate/*.php' ) as $filename ) {
	require $filename;
}
foreach ( glob( KWO_PATH . 'includes/core/*.php' ) as $filename ) {
	require $filename;
}
foreach ( glob( KWO_PATH . 'includes/media/*.php' ) as $filename ) {
	require $filename;
}
foreach ( glob( KWO_PATH . 'includes/navigation/*.php' ) as $filename ) {
	require $filename;
}
foreach ( glob( KWO_PATH . 'includes/widgets/*.php' ) as $filename ) {
	require $filename;
}
foreach ( glob( KWO_PATH . 'includes/customize/*.php' ) as $filename ) {
	require $filename;
}
foreach ( glob( KWO_PATH . 'includes/frontend/*.php' ) as $filename ) {
	require $filename;
}
foreach ( glob( KWO_PATH . 'includes/backend/*.php' ) as $filename ) {
	require $filename;
}
foreach ( glob( KWO_PATH . 'includes/users/*.php' ) as $filename ) {
	require $filename;
}
foreach ( glob( KWO_PATH . 'includes/assets/*.php' ) as $filename ) {
	require $filename;
}

// Theme activation and deactivation.
Activate\setup();
Deactivate\setup();

// Theme setup.
Theme\setup();
Templates\setup();
Shared_Assets\setup();
Navigation\setup();
Widgets\setup();
Images\setup();

// Vendor (plugin) classes.
$kwo_acf = new Vendor\Theme_ACF;

// ACF filters.
if ( $kwo_acf->use_bundled() || class_exists( 'acf' ) ) {
	$kwo_acf->filters();
}

// Frontend classes.
if ( ! is_admin() ) {
	Head\setup();
	Tags\setup();
	Front_Assets\setup();
	Layout\setup();
	Comments\setup();
}

// Backend classes.
if ( is_admin() ) {
	Admin\setup();
	Post_Options\setup();
	Admin_Assets\setup();
	Editors\setup();
}

Customize\setup();
