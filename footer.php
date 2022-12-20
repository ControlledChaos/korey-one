<?php
/**
 * Page footer template
 *
 * @package    Korey_One
 * @subpackage Templates
 * @category   Footers
 * @since      1.0.0
 */

namespace KoreyOne;

// Alias namespaces.
use KoreyOne\Tags as Tags;

?>
	<?php Tags\before_footer(); ?>
	<?php Tags\footer(); ?>
	<?php Tags\after_footer(); ?>

</div><!-- #page -->

<?php Tags\after_page(); ?>
<?php wp_footer(); ?>

<style>.no-js body { visibility: visible !important; }</style>
</body>
</html>
