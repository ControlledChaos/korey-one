<?php
/**
 * Content for singular sample post type
 *
 * This is provided for compatibility with the
 * Site Core plugin and its content filter classes.
 *
 * @package    Korey_One
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

printf(
	'<p>%s%s</p>',
	__( 'Content for post #', 'korey-one' ),
	get_the_ID()
);
