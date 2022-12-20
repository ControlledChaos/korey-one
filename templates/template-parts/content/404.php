<?php
/**
 * 404 error page content template
 *
 * @package    Korey_One
 * @subpackage Templates
 * @category   Error
 * @since      1.0.0
 */

namespace KoreyOne;

?>
<section class="error-404 not-found">

	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'That page can\'t be found.', 'korey-one' ); ?></h1>
	</header>

	<div class="page-content">
		<?php get_template_part( KWO_PARTS_DIR . '/widgets/404' ); ?>
	</div>
</section>
