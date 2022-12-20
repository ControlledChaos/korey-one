<?php
/**
 * Default post content template
 *
 * @package    Korey_One
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

namespace KoreyOne;

// Alias namespaces.
use KoreyOne\Tags      as Tags,
	KoreyOne\Customize as Customize;

// Get the content display setting from the Customizer.
$display = Customize\blog_format( get_theme_mod( 'kwo_blog_format' ) );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">

	<header class="entry-header">
		<?php

		if ( is_singular() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}

		if ( is_single() ) : ?>

		<div class="entry-meta">
			<?php
				Tags\posted_on();
				Tags\posted_by();
				echo get_the_modified_date();
			?>
		</div>

		<?php endif; ?>

	</header>

	<?php if ( is_singular() ) {
		Tags\post_thumbnail();
	} ?>

	<div class="entry-content" itemprop="articleBody">

		<?php

		if ( ! is_singular() && 'excerpt' == $display ) {
			the_excerpt();
		} else {
			the_content( sprintf(
				wp_kses(
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'korey-one' ),
					[
						'span' => [
							'class' => [],
						],
					]
				),
				get_the_title()
			) );
		}

		wp_link_pages( [
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'korey-one' ),
			'after'  => '</div>',
		] );

		if ( post_type_supports( get_post_type( get_the_ID() ), 'author' ) && is_single() ) {
			get_template_part( KWO_PARTS_DIR . '/content/author-section' );
		}
		?>
	</div>

	<footer class="entry-footer">
		<?php  Tags\entry_footer(); ?>
	</footer>

</article>

<?php if ( is_single() ) {
	echo Tags\post_navigation();
} ?>
