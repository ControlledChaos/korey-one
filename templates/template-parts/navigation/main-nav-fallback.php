<?php
/**
 * Output of main navigation callback function
 *
 * @package    Korey_One
 * @subpackage Templates
 * @category   Navigation
 * @since      1.0.0
 */

// namespace KoreyOne;

// Alias namespaces.
use KoreyOne\Classes\Front as Front;

// Get front page & blog options.
$show_front = (string) get_option( 'show_on_front' );
$blog_page  = (int) get_option( 'page_for_posts' );

// Theme link.
$get_theme  = wp_get_theme();
$theme_name = $get_theme->get( 'Name' );
$theme_uri  = $get_theme->get( 'ThemeURI' );

// Log in/out link.
if ( is_user_logged_in() ) {
	$log_link = wp_logout_url( site_url( '/' ) );
	$log_text = __( 'Log Out', 'korey-one' );
} else {
	$log_link = wp_login_url( site_url( '/' ) );
	$log_text = __( 'Log In', 'korey-one' );
}

?>
<div id="main-menu" class="menu">
	<ul class="nav-menu">

		<li><a href="<?php echo esc_url( home_url() ); ?>"><?php _e( 'Home', 'korey-one' ); ?></a></li>

		<?php if ( 'page' == $show_front ) : ?>
		<li><a href="<?php echo esc_url( get_permalink( $blog_page ) ); ?>"><?php _e( 'Blog', 'korey-one' ); ?></a></li>
		<?php endif; ?>

		<?php if ( current_user_can( 'customize' ) ) : ?>
		<li><a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=nav_menus' ) ); ?>"><?php _e( 'Customize', 'korey-one' ); ?></a></li>
		<?php endif; ?>

		<?php if ( $theme_uri && current_user_can( 'switch_themes' ) ) : ?>
		<li><a href="<?php echo esc_url( $theme_uri ); ?>" target="_blank" rel="nofollow"><?php echo $theme_name . ' ' . __( 'Theme', 'korey-one' ); ?></a></li>
		<?php endif; ?>

		<li><a href="<?php echo esc_url( $log_link ); ?>"><?php echo $log_text; ?></a></li>
	</ul>
</div>
