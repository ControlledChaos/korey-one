<?php
/**
 * Default search form template
 *
 * @package    Korey_One
 * @subpackage Templates
 * @category   Forms
 * @since      1.0.0
 */

namespace KoreyOne;

// Avoid error on widgets admin screen.
if ( is_admin() ) {
	return;
}

// Alias namespaces.
use KoreyOne\Tags as Tags;

?>
<?php Tags\before_searchform(); ?>
<?php Tags\searchform(); ?>
<?php Tags\after_searchform(); ?>
