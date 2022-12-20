<?php
/**
 * Frontend template tags
 *
 * @package    Korey_One
 * @subpackage Includes
 * @category   Frontend
 * @since      1.0.0
 */

namespace KoreyOne\Layout;

// Alias namespaces.
use KoreyOne\Customize      as Customize,
	KoreyOne\Classes\Vendor as Vendor;

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

	// Add nav to both actions for customizer refresh.
	add_action( 'KoreyOne\nav_before_header', $ns( 'navigation_main' ) );
	add_action( 'KoreyOne\nav_aside_branding', $ns( 'navigation_main' ) );
	add_action( 'KoreyOne\nav_after_header', $ns( 'navigation_main' ) );

	// Add the default header.
	add_action( 'KoreyOne\header', $ns( 'page_header' ) );

	// Site branding wrap class.
	add_action( 'KoreyOne\site_branding_wrap_class', $ns( 'site_branding_wrap_class' ) );

	// Add the default sidebar.
	add_action( 'KoreyOne\sidebar', $ns( 'page_sidebar' ) );

	// Add the default search form.
	add_action( 'KoreyOne\searchform', $ns( 'default_searchform' ) );

	// Add the default header.
	add_action( 'KoreyOne\footer', $ns( 'page_footer' ) );
}

/**
 * Load main navigation
 *
 * @since  1.0.0
 * @return void
 */
function navigation_main() {
	get_template_part( KWO_PARTS_DIR . '/navigation/navigation-main' );
}

/**
 * Load default header
 *
 * @since  1.0.0
 * @return void
 */
function page_header() {

	// Instantiate ACF class to get the suffix.
	$acf = new Vendor\Theme_ACF;

	/**
	 * Conditional page header
	 *
	 * Out of the box there is no difference between the two header files.
	 * This condition is provided for demonstration primarily, also
	 * because it is common for a project to have a front page header
	 * that is bigger & bolder than those of subsequent pages.
	 */
	if ( is_front_page() ) {
		get_template_part( KWO_PARTS_DIR . '/header/header-front-page' . $acf->suffix() );
	} elseif ( is_page_template( KWO_TMPL_DIR . '/page-builder.php' ) ) {
		get_template_part( KWO_PARTS_DIR . '/header/header-builder' );
	} else {
		get_template_part( KWO_PARTS_DIR . '/header/header-default' . $acf->suffix() );
	}
}

/**
 * Site branding wrap class
 *
 * @since  1.0.0
 * @return string Returns the class(es) added.
 */
function site_branding_wrap_class() {

	// Get the navigation location setting from the Customizer.
	$nav_location = Customize\nav_location( get_theme_mod( 'kwo_nav_location' ) );

	$classes = '';

	if ( 'aside' == $nav_location ) {
		$classes = ' nav-aside-branding';
	}

	echo $classes;
}

/**
 * Load default sidebar
 *
 * @since  1.0.0
 * @return void
 */
function page_sidebar() {
	get_template_part( KWO_PARTS_DIR . '/widgets/sidebar' );
}

/**
 * Load default search form
 *
 * @since  1.0.0
 * @return void
 */
function default_searchform() {
	get_template_part( KWO_PARTS_DIR . '/forms/searchform' );
}

/**
 * Load default footer
 *
 * @since  1.0.0
 * @return void
 */
function page_footer() {
	get_template_part( KWO_PARTS_DIR . '/footer/footer-default' );
}
