<?php
/**
 * Projects grid section layout
 *
 * @package    JPierce_Front
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

use JPierce_Front\Classes\Front as Front;

// Get ACF fields for the current layout.
$grid_tax     = get_sub_field( 'front_grid_taxonomy' );
$grid_types   = get_sub_field( 'front_grid_types' );
$grid_roles   = get_sub_field( 'front_grid_roles' );
$grid_images  = get_sub_field( 'front_grid_images' );
$grid_number  = get_sub_field( 'front_grid_number' );
$grid_columns = get_sub_field( 'front_grid_columns' );

$icon_video = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M488 64h-8v20c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12V64H96v20c0 6.6-5.4 12-12 12H44c-6.6 0-12-5.4-12-12V64h-8C10.7 64 0 74.7 0 88v336c0 13.3 10.7 24 24 24h8v-20c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v20h320v-20c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v20h8c13.3 0 24-10.7 24-24V88c0-13.3-10.7-24-24-24zM96 372c0 6.6-5.4 12-12 12H44c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40zm0-96c0 6.6-5.4 12-12 12H44c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40zm0-96c0 6.6-5.4 12-12 12H44c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40zm288 224c0 6.6-5.4 12-12 12H140c-6.6 0-12-5.4-12-12V108c0-6.6 5.4-12 12-12h232c6.6 0 12 5.4 12 12v296zm96-32c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40zm0-96c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40zm0-96c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40z"/></svg>';

$icon_gallery = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 408c-66.2 0-120-53.8-120-120s53.8-120 120-120 120 53.8 120 120-53.8 120-120 120zm0-208c-48.5 0-88 39.5-88 88s39.5 88 88 88 88-39.5 88-88-39.5-88-88-88zm-32 88c0-17.6 14.4-32 32-32 8.8 0 16-7.2 16-16s-7.2-16-16-16c-35.3 0-64 28.7-64 64 0 8.8 7.2 16 16 16s16-7.2 16-16zM324.3 64c3.3 0 6.3 2.1 7.5 5.2l22.1 58.8H464c8.8 0 16 7.2 16 16v288c0 8.8-7.2 16-16 16H48c-8.8 0-16-7.2-16-16V144c0-8.8 7.2-16 16-16h110.2l20.1-53.6c2.3-6.2 8.3-10.4 15-10.4h131m0-32h-131c-20 0-37.9 12.4-44.9 31.1L136 96H48c-26.5 0-48 21.5-48 48v288c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V144c0-26.5-21.5-48-48-48h-88l-14.3-38c-5.8-15.7-20.7-26-37.4-26z"/></svg>';

$icon_more = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M96 160c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm128-32c0-17.7-14.3-32-32-32s-32 14.3-32 32 14.3 32 32 32 32-14.3 32-32zm96 0c0-17.7-14.3-32-32-32s-32 14.3-32 32 14.3 32 32 32 32-14.3 32-32zm192-48v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h416c26.5 0 48 21.5 48 48zm-32 144H32v208c0 8.8 7.2 16 16 16h416c8.8 0 16-7.2 16-16V224zm0-32V80c0-8.8-7.2-16-16-16H48c-8.8 0-16 7.2-16 16v112h448z"/></svg>';

// Number of projects to query.
if ( $grid_number ) {
	$posts_per_page = $grid_number;
} else {
	$posts_per_page = 8;
}

// Number of columns in the grid.
if ( $grid_columns ) {
	$grid_columns = sprintf(
		'<style>@media not screen and ( max-width: 800px ) {
			#projects-grid-%s {
				grid-template-columns: repeat( %s, 1fr ) !important;
			}
		}</style>',
		$args['layout'],
		$grid_columns
	);
} else {
	$grid_columns = null;
}
echo $grid_columns;

// Get taxonomy & terms to query.
if ( 'role' == $grid_tax ) {
	$taxonomy = 'project_role';
	$get_terms = $grid_roles;
} else {
	$taxonomy  = 'project_type';
	$get_terms = $grid_types;
}

/**
 * Set an array of taxonomy terms.
 * The terms subfields must return
 * the term object.
 */
$terms = [];
foreach ( $get_terms as $term ) {
	$terms[] .= $term->slug;
}

// Project query arguments.
$query  = [
	'post_type'      => [ 'project' ],
	'post_status'    => [ 'publish' ],
	'posts_per_page' => $posts_per_page,
	'nopaging'       => false,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
	'tax_query' => [
		'relation' => 'OR',
		[
			'taxonomy' => $taxonomy,
			'field'    => 'slug',
			'terms'    => $terms,
			'operator' => 'IN'
		]
	]
];

// New post type query.
$query = new WP_Query( $query );

if ( $query->have_posts() ) :

// Grid class. Poster is the default image size.
if ( 'screenshot' == $grid_images ) {
	$grid_class = 'projects-screenshot-grid';
} else {
	$grid_class = 'projects-poster-grid';
}

?>
<ul id="projects-grid-<?php echo $args['layout']; ?>" class="projects-grid <?php echo $grid_class; ?>">
<?php

while ( $query->have_posts() ) : $query->the_post();

	// If screenshot images are used.
	if ( 'screenshot' == $grid_images ) {
		if ( has_image_size( 'small-video' ) ) {
			$size = 'small-video';
		} else {
			$size = 'medium';
		}
		$image = get_field( 'project_screenshot_image' );

	// Default to poster images.
	} else {
		if ( has_image_size( 'medium-poster' ) ) {
			$size = 'medium-poster';
		} else {
			$size = 'medium';
		}
		$image = get_field( 'project_poster_image' );
	}

	// Only display posts with an image available.
	if ( $image ) :

		$image_url   = $image['url'];
		$title       = $image['title'];
		$alt         = $image['alt'];
		$thumb       = $image['sizes'][ $size ];
		$width       = $image['sizes'][ $size . '-width' ];
		$height      = $image['sizes'][ $size . '-height' ];
		$description = get_field( 'project_description' );
		$vimeo_url   = get_field( 'project_vimeo_url' );
		$gallery     = get_field( 'project_gallery' );

		if ( $gallery ) {
			$first_image = $gallery[0];
			$first_url   = $first_image['url'];
		}
	?>
	<li>
		<figure>
			<img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo get_the_title() . __( ' poster', 'korey-one' ); ?>">
			<figcaption>
				<div>
					<h3><?php the_title(); ?></h3>

					<ul class="projects-links projects-grid-links">

						<?php if ( $vimeo_url ) : ?>
						<li><a class="tooltip" href="<?php echo esc_url( $vimeo_url ); ?>" title="<?php _e( 'Video' ); ?>" data-fancybox target="_blank" rel="nofollow"><span class="icon-video"><?php echo $icon_video; ?></span><span class="text-video"><?php _e( 'Video', 'korey-one' ); ?></span></a></li>
						<?php endif; ?>

						<?php if ( $gallery ) : ?>
						<li class="project-gallery-link"><a class="tooltip" href="<?php echo esc_url( $first_url ); ?>" title="<?php _e( 'Gallery' ); ?>" data-fancybox="<?php echo 'gallery-' . get_the_ID(); ?>"><span class="icon-gallery"><?php echo $icon_gallery; ?></span><span class="text-gallery"><?php _e( 'Gallery', 'korey-one' ); ?></span></a></li>
						<?php endif; ?>

						<li><a class="tooltip" href="<?php the_permalink(); ?>" title="<?php _e( 'Info' ); ?>"><span class="icon-more"><?php echo $icon_more; ?></span><span class="text-more"><?php _e( 'Info', 'korey-one' ); ?></span></a></li>
					</ul>
				</div>
			</figcaption>
		</figure>
		<?php

		if ( $gallery ) :

		?>
		<div class="project-grid-gallery project-gallery-hidden" id="<?php echo 'gallery-' . get_the_ID(); ?>">
			<?php Front\tags()->projects_galleries(); ?>
		</div>
		<?php

		endif;

		?>
	</li>
	<?php endif; // If $image. ?>
<?php endwhile; ?>
</ul>
<?php else :
	printf(
		'<p>%s</p>',
		__( 'No projects match the parameters for this section.', 'korey-one' )
	);
endif; // If have_posts().

// Recent the current query.
wp_reset_query();