<?php
/**
 * Theme Customizer
 *
 * @package    Korey_One
 * @subpackage Includes
 * @category   Customizer
 */

namespace KoreyOne\Customize;

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

	// Modify existing Customizer elements.
	add_action( 'customize_register', $ns( 'customize_modify' ) );

	// Register new panels, sections, & fields.
	add_action( 'customize_register', $ns( 'customize_register' ) );
}

/**
 * Modify existing Customizer elements
 *
 * @since  1.0.0
 * @param  object $wp_customize The WP_Customizer class.
 * @return void
 */
function customize_modify( $wp_customize ) {

	// Change Site Identity section title.
	$wp_customize->get_section( 'title_tagline' )->title = __( 'Identity', 'korey-one' );
	$wp_customize->get_section( 'title_tagline' )->priority = 5;

	// Put the logo field below site title & tagline.
	$wp_customize->get_control( 'custom_logo' )->priority = 11;

	// Rename Homepage options section & put under Layout panel.
	$wp_customize->get_section( 'static_front_page' )->panel    = 'kwo_layout_panel';
	$wp_customize->get_section( 'static_front_page' )->priority = 3;
	$wp_customize->get_section( 'static_front_page' )->title    = __( 'Front Page', 'korey-one' );

	// Change label for front page option.
	$wp_customize->get_control( 'show_on_front' )->label = __( 'Front Page Displays', 'korey-one' );

	// Rename Background section & put under Appearance panel.
	$wp_customize->get_section( 'background_image' )->panel    = 'kwo_appearance_panel';
	$wp_customize->get_section( 'background_image' )->priority = 5;
	$wp_customize->get_section( 'background_image' )->title    = __( 'Background Display', 'korey-one' );
	$wp_customize->get_control( 'background_color' )->section  = 'background_image';

	// Put header image & color under Header Display section.
	$wp_customize->get_control( 'header_image' )->section     = 'kwo_header_display_section';
	$wp_customize->get_control( 'header_image' )->priority    = 100;

	// Color disabled below.
	// $wp_customize->get_control( 'header_textcolor' )->section = 'kwo_header_display_section';

	// Put CSS section under Appearance panel.
	$wp_customize->get_section( 'custom_css' )->panel    = 'kwo_appearance_panel';
	$wp_customize->get_section( 'custom_css' )->priority = 100;

	// Remove settings controls.
	$wp_customize->remove_control( 'header_textcolor' );
}

/**
 * Register fields
 *
 * @since  1.0.0
 * @param  object $wp_customize The WP_Customizer class.
 * @return void
 */
function customize_register( $wp_customize ) {

	// Return namespaced function.
	$ns = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	// Add Layout panel.
	$wp_customize->add_panel( 'kwo_layout_panel' , [
		'priority'    => 10,
		'capability'  => 'edit_theme_options',
		'title'       => __( 'Layout', 'korey-one' )
	] );

	// Add Content panel.
	$wp_customize->add_panel( 'kwo_content_panel' , [
		'priority'    => 15,
		'capability'  => 'edit_theme_options',
		'title'       => __( 'Content', 'korey-one' )
	] );

	// Add Appearance panel.
	$wp_customize->add_panel( 'kwo_appearance_panel' , [
		'priority'    => 20,
		'capability'  => 'edit_theme_options',
		'title'       => __( 'Appearance', 'korey-one' )
	] );

	// Add Header Layout section.
	$wp_customize->add_section( 'kwo_header_layout_section' , [
		'priority'    => 5,
		'title'       => __( 'Header Layout', 'korey-one' ),
		'description' => __( '', 'korey-one' ),
		'panel'       => 'kwo_layout_panel'
	] );

	// Add Header Display section.
	$wp_customize->add_section( 'kwo_header_display_section' , [
		'priority'    => 10,
		'title'       => __( 'Header Display', 'korey-one' ),
		'description' => __( 'Choose which header elements to display and how to display them.', 'korey-one' ),
		'panel'       => 'kwo_appearance_panel'
	] );

	// Add Content Display section.
	$wp_customize->add_section( 'kwo_content_section' , [
		'priority'    => 10,
		'title'       => __( 'Content Display', 'korey-one' ),
		'description' => __( '', 'korey-one' ),
		'panel'       => 'kwo_content_panel'
	] );

	// Add Admin section.
	$wp_customize->add_section( 'kwo_admin_options_section' , [
		'priority'    => 135,
		'capability'  => 'manage_options',
		'title'       => __( 'Admin', 'korey-one' ),
		'description' => __( '', 'korey-one' )
	] );

	// Header image display.
	$wp_customize->add_setting( 'kwo_header_image', [
		'default'	        => 'always',
		'sanitize_callback' => $ns( 'header_image' )
	] );
	$wp_customize->add_control( new \WP_Customize_Control(
		$wp_customize,
		'kwo_header_image',
		[
			'priority'    => 10,
			'section'     => 'kwo_header_display_section',
			'settings'    => 'kwo_header_image',
			'label'       => __( 'Header Image Display', 'korey-one' ),
			'description' => __( 'Choose when to display the header image.', 'korey-one' ),
			'type'        => 'select',
			'choices'     => [
				'never'       => __( 'Never Display', 'korey-one' ),
				'always'      => __( 'Always Display', 'korey-one' ),
				'enable_per'  => __( 'Enable Per Post/Page', 'korey-one' ),
				'disable_per' => __( 'Disable Per Post/Page', 'korey-one' )
			]
		]
	) );

	// Main navigation location.
	$wp_customize->add_setting( 'kwo_nav_location', [
		'default'	        => 'aside',
		'sanitize_callback' => $ns( 'nav_location' )
	] );
	$wp_customize->add_control( new \WP_Customize_Control(
		$wp_customize,
		'kwo_nav_location',
		[
			'section'     => 'kwo_header_layout_section',
			'settings'    => 'kwo_nav_location',
			'label'       => __( 'Main Navigation Location', 'korey-one' ),
			'description' => __( 'Display the main navigation menu before or after the header branding and image.', 'korey-one' ),
			'type'        => 'select',
			'choices'     => [
				'aside'  => __( 'Aside Site Branding', 'korey-one' ),
				'before' => __( 'Before Header', 'korey-one' ),
				'after'  => __( 'After Header', 'korey-one' )
			]
		]
	) );

	// Blog/archive content.
	$wp_customize->add_setting( 'kwo_blog_format', [
		'default'	        => 'content',
		'sanitize_callback' => $ns( 'blog_format' )
	] );
	$wp_customize->add_control( new \WP_Customize_Control(
		$wp_customize,
		'kwo_blog_format',
		[
			'section'     => 'kwo_content_section',
			'settings'    => 'kwo_blog_format',
			'label'       => __( 'Post Archive Content', 'korey-one' ),
			'description' => __( 'Should the blog index and archive pages show the full post or an excerpt?', 'korey-one' ),
			'type'        => 'select',
			'choices'     => [
				'content' => __( 'Full Content', 'korey-one' ),
				'excerpt' => __( 'Excerpt/Summary', 'korey-one' )
			]
		]
	) );

	// Author section on single posts.
	$wp_customize->add_setting( 'kwo_author_section', [
		'default'	        => 'never',
		'sanitize_callback' => $ns( 'author_section' )
	] );
	$wp_customize->add_control( new \WP_Customize_Control(
		$wp_customize,
		'kwo_author_section',
		[
			'section'     => 'kwo_content_section',
			'settings'    => 'kwo_author_section',
			'label'       => __( 'Author Section', 'korey-one' ),
			'description' => __( 'Display the name, bio, and profile picture of the author on single post pages.', 'korey-one' ),
			'type'        => 'select',
			'choices'     => [
				'never'       => __( 'Never Display', 'korey-one' ),
				'always'      => __( 'Always Display', 'korey-one' ),
				'enable_per'  => __( 'Enable Per Post', 'korey-one' ),
				'disable_per' => __( 'Disable Per Post', 'korey-one' )
			]
		]
	) );

	// Use admin theme.
	$wp_customize->add_setting( 'kwo_admin_theme', [
		'default'	        => false,
		'transport'         => 'postMessage',
		'sanitize_callback' => $ns( 'use_admin_theme' )
	] );
	$wp_customize->add_control( new \WP_Customize_Control(
		$wp_customize,
		'kwo_admin_theme',
		[
			'section'     => 'kwo_admin_options_section',
			'settings'    => 'kwo_admin_theme',
			'label'       => __( 'Admin Theme', 'korey-one' ),
			'description' => __( 'Enqueue styles for a custom admin pages theme.', 'korey-one' ),
			'type'        => 'checkbox'
		]
	) );

	// Load admin header.
	$wp_customize->add_setting( 'kwo_admin_header', [
		'default'	        => false,
		'transport'         => 'postMessage',
		'sanitize_callback' => $ns( 'use_admin_header' )
	] );
	$wp_customize->add_control( new \WP_Customize_Control(
		$wp_customize,
		'kwo_admin_header',
		[
			'section'     => 'kwo_admin_options_section',
			'settings'    => 'kwo_admin_header',
			'label'       => __( 'Admin Header', 'korey-one' ),
			'description' => __( 'Load a page header on admin pages.', 'korey-one' ),
			'type'        => 'checkbox'
		]
	) );
}

/**
 * Header image
 *
 * @since  1.0.0
 * @param  $input
 * @return string Returns the theme mod.
 */
function header_image( $input ) {

	$valid = [ 'never', 'always', 'enable_per', 'disable_per' ];

	if ( in_array( $input, $valid ) ) {
		return $input;
	}
	return 'always';
}

/**
 * Main navigation location
 *
 * @since  1.0.0
 * @param  $input
 * @return string Returns the theme mod.
 */
function nav_location( $input ) {

	$valid = [ 'aside', 'before', 'after' ];

	if ( in_array( $input, $valid ) ) {
		return $input;
	}
	return 'aside';
}

/**
 * Blog/archive content
 *
 * @since  1.0.0
 * @param  $input
 * @return string Returns the theme mod.
 */
function blog_format( $input ) {

	$valid = [ 'content', 'excerpt' ];

	if ( in_array( $input, $valid ) ) {
		return $input;
	}
	return 'content';
}

/**
 * Author section
 *
 * @since  1.0.0
 * @param  $input
 * @return string Returns the theme mod.
 */
function author_section( $input ) {

	$valid = [ 'never', 'always', 'enable_per', 'disable_per' ];

	if ( in_array( $input, $valid ) ) {
		return $input;
	}
	return 'never';
}

/**
 * Admin theme
 *
 * @since  1.0.0
 * @param  $input
 * @return string Returns the theme mod.
 */
function use_admin_theme( $input ) {

	if ( true == $input ) {
		return true;
	}
	return false;
}

/**
 * Admin header
 *
 * @since  1.0.0
 * @param  $input
 * @return string Returns the theme mod.
 */
function use_admin_header( $input ) {

	if ( true == $input ) {
		return true;
	}
	return false;
}
