<?php
/**
 * Frontend assets
 *
 * Methods for enqueueing and printing assets
 * such as JavaScript and CSS files.
 *
 * @package    Korey_One
 * @subpackage Includes
 * @category   Assets
 * @since      1.0.0
 */

namespace KoreyOne\Front_Assets;

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

	// Frontend scripts.
	add_action( 'wp_enqueue_scripts', $ns( 'frontend_scripts' ) );

	// Frontend styles.
	add_action( 'wp_enqueue_scripts', $ns( 'frontend_styles' ) );

	// Print footer scripts.
	add_action( 'wp_footer', $ns( 'print_scripts' ) );
}

/**
 * Frontend scripts
 *
 * @since  1.0.0
 * @return void
 */
function frontend_scripts() {

	// Enqueue jQuery.
	wp_enqueue_script( 'jquery' );

	// Navigation toggle and dropdown.
	wp_enqueue_script( 'kwo-navigation', get_theme_file_uri( '/assets/js/navigation' . suffix() . '.js' ), [], KWO_VERSION, true );

	// Skip link focus, for accessibility.
	wp_enqueue_script( 'kwo-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix' . suffix() . '.js' ), [], KWO_VERSION, true );

	// FitVids for responsive video embeds.
	wp_enqueue_script( 'kwo-fitvids', get_theme_file_uri( '/assets/js/jquery.fitvids' . suffix() . '.js' ), [ 'jquery' ], KWO_VERSION, true );
	wp_add_inline_script( 'kwo-fitvids', 'jQuery(document).ready(function($){ $( ".entry-content" ).fitVids(); });', true );

	// FullPage & slider.
	if ( is_front_page() && is_page_template( KWO_TMPL_DIR . '/front-page-sections.php' ) ) {
		wp_enqueue_script( 'jpt-scrolloverflow', get_theme_file_uri( '/assets/js/scrolloverflow' . suffix() . '.js' ), [ 'jquery' ], KWO_VERSION, true );
		wp_enqueue_script( 'kwo-fullpage', get_theme_file_uri( '/assets/js/fullpage' . suffix() . '.js' ), [ 'jquery' ], KWO_VERSION, true );
		wp_enqueue_script( 'kwo-fullpage-ext', get_theme_file_uri( '/assets/js/fullpage.extensions' . suffix() . '.js' ), [ 'kwo-fullpage' ], KWO_VERSION, true );
		wp_enqueue_script( 'kwo-slider', get_theme_file_uri( '/assets/js/slider' . suffix() . '.js' ), [ 'jquery' ], KWO_VERSION, true );
	}

	// Comments scripts.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/**
 * Frontend styles
 *
 * @since  1.0.0
 * @return void
 */
function frontend_styles() {

	// Google fonts.
	wp_enqueue_style( 'kwo-google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap', [], KWO_VERSION, 'screen' );

	/**
	 * Theme stylesheet
	 *
	 * This enqueues the minified stylesheet compiled from SASS (.scss) files.
	 * The main stylesheet, in the root directory, only contains the theme header but
	 * it is necessary for theme activation. DO NOT delete the main stylesheet!
	 */
	wp_enqueue_style( 'kwo-theme', get_theme_file_uri( '/assets/css/style' . suffix() . '.css' ), [], KWO_VERSION, 'all' );

	// Right-to-left languages.
	if ( is_rtl() ) {
		wp_enqueue_style( 'kwo-theme-rtl', get_theme_file_uri( '/assets/css/style-rtl' . suffix() . '.css' ), [ 'kwo-theme' ], KWO_VERSION, 'all' );
	}

	// Block styles.
	if ( function_exists( 'has_blocks' ) ) {
		wp_enqueue_style( 'kwo-blocks', get_theme_file_uri( '/assets/css/blocks' . suffix() . '.css' ), [ 'wp-block-library', 'kwo-theme' ], KWO_VERSION, 'all' );

		if ( is_rtl() ) {
			wp_enqueue_style( 'kwo-blocks-rtl', get_theme_file_uri( '/assets/css/blocks-rtl' . suffix() . '.css' ), [ 'kwo-blocks' ], KWO_VERSION, 'all' );
		}
	}

	// FullPage & slider.
	if ( is_front_page() && is_page_template( KWO_TMPL_DIR . '/front-page-sections.php' ) ) {
		wp_enqueue_style( 'kwo-slider', get_theme_file_uri( '/assets/css/slider' . suffix() . '.css' ), [], KWO_VERSION, 'all' );
		wp_enqueue_style( 'kwo-fullpage', get_theme_file_uri( '/assets/css/fullpage' . suffix() . '.css' ), [ 'kwo-theme' ], KWO_VERSION, 'all' );
	}

	// Print styles.
	wp_enqueue_style( 'kwo-print', get_theme_file_uri( '/assets/css/print' . suffix() . '.css' ), [], KWO_VERSION, 'print' );
}

/**
 * Print footer scripts
 *
 * @since  1.0.0
 * @return void
 */
function print_scripts() {

	?>
	<script>
	// Reveal body element once DOM is loaded.
	jQuery(document).ready( function ($) {
		$( 'body' ).css( 'visibility', 'visible' );
	});
	</script>
	<?php
}
