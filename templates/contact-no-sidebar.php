<?php
/**
 * No Sidebar template for contact page
 *
 * Template Name: Contact Page, No Sidebar
 * Template Post Type: page
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
		endwhile;

		?>

		</main>
	</div>
</div>
<?php

get_footer();
