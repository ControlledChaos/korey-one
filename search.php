<?php
/**
 * Search results template
 *
 * @package    Korey_One
 * @subpackage Templates
 * @category   Archives
 * @since      1.0.0
 */

namespace KoreyOne;

// Alias namespaces.
use KoreyOne\Classes\Front as Front;

get_header();

?>
<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" itemscope itemprop="mainContentOfPage">

		<?php
		if ( have_posts() ) :

		?>
			<header class="page-header">
				<h1 class="page-title">
					<?php printf( esc_html__( 'Search Results for: %s', 'korey-one' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header>

			<?php while ( have_posts() ) : the_post();

				get_template_part( KWO_PARTS_DIR . '/content/content', 'search' . $kwo_acf->suffix() );
				endwhile;

				the_posts_navigation( [
					'prev_text' => __( 'Previous', 'korey-one' ),
					'next_text' => __( 'Next', 'korey-one' )
				] );

		else :
			get_template_part( KWO_PARTS_DIR . '/content/content', 'none' . $kwo_acf->suffix() );
		endif;
		?>

		</main>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php

get_footer();