<?php
/**
 * Default page template
 *
 * @package    Korey_One
 * @subpackage Templates
 * @category   Archives
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
		if ( have_posts() ) : while ( have_posts() ) : the_post();

			content_template();
			endwhile;

			the_posts_navigation( [
				'prev_text' => __( 'Previous', 'korey-one' ),
				'next_text' => __( 'Next', 'korey-one' )
			] );

		else :
			content_template();
		endif;
		?>

		</main>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php

get_footer();
