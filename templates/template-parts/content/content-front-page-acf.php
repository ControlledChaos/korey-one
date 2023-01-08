<?php
/**
 * ACF template part for displaying page content in front-page.php
 *
 * @package    Korey_One
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

namespace KoreyOne;

// Alias namespaces.
use KoreyOne\Tags as Tags;

?>
<div id="front-page-sections" class="front-page-sections">

<section id="intro-slider" data-anchor="slider" class="front-page-section front-page-intro active">
	<div class="wrapper">
		<?php get_template_part( 'templates/template-parts/content/front-page/front-section', 'intro' ); ?>
	</div>
</section>
<?php

if ( have_rows( 'front_sections' ) ) :
	$counters = [];

while ( have_rows( 'front_sections' ) ) : the_row();

$get_layout = get_row_layout();
if ( ! isset( $counters[ $get_layout ] ) ) {
	$counters[ $get_layout ] = 1;
} else {
	$counters[ $get_layout ]++;
}
$layout  = 'layout_' . get_row_layout() . '_' . $counters[ $get_layout ];
$heading = get_sub_field( 'front_section_heading' );
$menu    = get_sub_field( 'front_section_menu' );

if ( $menu ) {
	$slug = preg_replace( "/[^A-Za-z0-9]/", '', strtolower( $menu ) );
} else {
	$slug = preg_replace( "/[^A-Za-z0-9]/", '', strtolower( $heading ) );
}

?>
<section id="<?php echo $layout; ?>" data-anchor="<?php echo esc_attr( $slug ); ?>" class="front-page-section">
	<div class="wrapper">
		<h2><?php echo $heading; ?></h2>
		<?php
		if ( 'front_project_grid' === get_row_layout() ) {
			get_template_part( 'templates/template-parts/content/front-page/front-section', 'projects', [ 'layout' => $layout ] );
		}

		if ( 'front_image_gallery' === get_row_layout() ) {
			get_template_part( 'templates/template-parts/content/front-page/front-section', 'gallery', [ 'layout' => $layout ] );
		}

		if ( 'front_content_block' === get_row_layout() ) {
			get_template_part( 'templates/template-parts/content/front-page/front-section', 'content', [ 'layout' => $layout ] );
		}

		if ( 'front_contact_form' === get_row_layout() ) {
			get_template_part( 'templates/template-parts/content/front-page/front-section', 'contact' );
		}

		if ( 'front_agents' === get_row_layout() ) {
			get_template_part( 'templates/template-parts/content/front-page/front-section', 'agents' );
		}

		if ( 'front_resume' === get_row_layout() ) {
			get_template_part( 'templates/template-parts/content/front-page/front-section', 'resume', [ 'layout' => $layout ] );
		}
		?>
	</div>
</section>
<?php endwhile; endif; ?>
<!-- section class="front-page-section"><div class="wrapper">&nbsp;</div></section -->
</div>
