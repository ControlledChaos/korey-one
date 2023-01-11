<?php
/**
 * Content template for contact page templates.
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

	<div class="entry-content" itemprop="articleBody">
		<?php the_content(); ?>
	</div>
</article>
