<?php
/**
 * Intro section layout
 *
 * @package    JPierce_Front
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

// Alias namespaces.
use KoreyOne\Tags as Tags;

$slides = get_field( 'intro_slides' );

/**
 * Intro title & description
 *
 * Defaults to the site title and tagline/description
 * as set in the General Settings.
 */
$title_override = get_field( 'intro_title' );
$desc_override  = get_field( 'intro_description' );
$allowed_html   = [
    'span' => [
        'class' => []
	],
    'br'     => [],
    'em'     => [],
    'strong' => [],
	'i'      => [],
	'b'      => []
];

// Title.
if ( $title_override ) {
	$site_title = $title_override;
} else {
	$site_title = get_bloginfo( 'title' );
}

// Description.
if ( $desc_override ) {
	$site_desc = $desc_override;
} else {
	$site_desc = get_bloginfo( 'description' );
}

/**
 * Slide overlay
 *
 * Override the color & opacity from the stylesheet.
 */
$overlay = get_field( 'intro_overlay_color' );
$color   = get_field( 'intro_overlay_text_color' );
if ( 0 == $overlay['alpha'] ) {
	$alpha = '0.5';
} else {
	$alpha = $overlay['alpha'];
}

if ( $slides ) :

?>
<?php if ( ! empty( $overlay ) ) : ?>
<style>
	.intro-slides li:before {
		background-color: rgba( <?php echo $overlay['red']; ?>, <?php echo $overlay['green']; ?>, <?php echo $overlay['blue']; ?>, <?php echo $alpha; ?> );
	}
	<?php endif; ?>
	<?php if ( $color ) : ?>
	.front-page-intro header .site-title,
	.front-page-intro header .site-title *,
	.front-page-intro header .site-description,
	.front-page-intro header .site-description * {
		color: <?php echo $color; ?> !important;
	}
	.front-page-intro .entry-icon svg {
		fill: <?php echo $color; ?> !important;
	}
</style>
<?php endif; // $overlay ?>
<div class="intro-slideshow" role="presentation">
	<ul class="intro-slides">
		<?php foreach( $slides as $slides ): ?>
			<li style="background-image: url('<?php echo $slides['url']; ?>');">
				<span class="screen-reader-text"><?php echo esc_attr( $slides['title'] ); ?></span>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
<?php

endif; // $slides

?>
<header class="intro-header" role="banner" itemscope="itemscope" itemtype="http://schema.org/Organization">

	<?php if ( ! $slides ) { echo Tags\site_logo(); } ?>
	<p class="site-title"><?php echo wp_kses( $site_title, $allowed_html ); ?></p>
	<p class="site-description"><?php echo wp_kses( $site_desc, $allowed_html ); ?></p>

	<span class="entry-link" id="intro-entry-link">
		<span class="screen-reader-text"><?php _e( 'Enter Site', 'korey-one' ); ?></span>
		<span class="entry-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M443.5 162.6l-7.1-7.1c-4.7-4.7-12.3-4.7-17 0L224 351 28.5 155.5c-4.7-4.7-12.3-4.7-17 0l-7.1 7.1c-4.7 4.7-4.7 12.3 0 17l211 211.1c4.7 4.7 12.3 4.7 17 0l211-211.1c4.8-4.7 4.8-12.3.1-17z"/></svg></span>
	</span>
</header>
