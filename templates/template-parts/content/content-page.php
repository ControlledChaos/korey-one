<?php
/**
 * Content template for post type: page
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
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

	<?php
	if (
		! is_page_template( KWO_TMPL_DIR . '/no-featured.php' ) ||
		! is_page_template( KWO_TMPL_DIR . '/no-sidebar-no-featured.php' )
	) {
		Tags\post_thumbnail();
	}
	?>

	<div class="entry-content" itemprop="articleBody">

		<?php

		the_content();

		wp_link_pages( [
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'korey-one' ),
			'after'  => '</div>',
		] );

		?>

	</div>
</article>
