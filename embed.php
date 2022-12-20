<?php
/**
 * Embedded post template
 *
 * @package    Korey_One
 * @subpackage Templates
 * @category   Posts
 * @since      1.0.0
 */

get_header( 'embed' );

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		get_template_part( KWO_PARTS_DIR . '/content/content', 'embed' );
	endwhile;
else :
	get_template_part( KWO_PARTS_DIR . '/content/content', 'none-embed' );
endif;

get_footer( 'embed' );
