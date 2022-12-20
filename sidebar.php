<?php
/**
 * Default sidebar template
 *
 * @package    Korey_One
 * @subpackage Templates
 * @category   Asides
 * @since      1.0.0
 */

namespace KoreyOne;

// Alias namespaces.
use KoreyOne\Tags as Tags;

?>
<?php Tags\before_sidebar(); ?>
<?php Tags\sidebar(); ?>
<?php Tags\after_sidebar(); ?>
