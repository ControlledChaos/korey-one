<?php
/**
 * Template part for displaying page content in front-page.php
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
		<?php

		if ( is_front_page() ) :
			the_title( '<h2 class="entry-title">', '</h2>' );
		elseif ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>
	</header>

	<?php if ( is_singular() ) {
		if ( ! is_page_template( [
			KWO_TMPL_DIR . '/front-page-sections.php',
			KWO_TMPL_DIR . '/no-featured.php',
			KWO_TMPL_DIR . '/no-sidebar-no-featured.php'
		] ) ) {
			Tags\post_thumbnail();
		}
	} ?>

	<div class="entry-content" itemprop="articleBody">
		<?php the_content(); ?>
	</div>
</article>
