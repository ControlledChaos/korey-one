<?php
/**
 * Default ACF post content template
 *
 * Used if the Advanced Custom Fields plugin is active.
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

	<?php if ( is_singular() ) : ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>
	<?php endif; ?>

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
</article>

<?php if ( is_single() ) {
	echo Tags\post_navigation();
} ?>
