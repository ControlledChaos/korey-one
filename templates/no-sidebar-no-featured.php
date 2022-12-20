<?php
/**
 * No Sidebar, No Featured Image template for posts & pages
 *
 * Template Name: No Sidebar, No Featured Image
 * Template Post Type: post, page
 *
 * @package    Korey_One
 * @subpackage Templates
 * @category   Posts
 * @since      1.0.0
 */

namespace KoreyOne;

use function KoreyOne\Tags\content_template;

get_header();

?>
<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" itemscope itemprop="mainContentOfPage">

		<?php

		while ( have_posts() ) : the_post();
			content_template();
			if ( ! is_page() ) {
				comments_template();
			}
		endwhile;

		?>

		</main>
	</div>
</div>
<?php

get_footer();
