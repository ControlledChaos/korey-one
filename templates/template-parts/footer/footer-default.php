<?php
/**
 * Default footer content template
 *
 * @package    Korey_One
 * @subpackage Templates
 * @category   Headers
 * @since      1.0.0
 */

namespace KoreyOne;

// Alias namespaces.
use KoreyOne\Classes\Tags as Tags;

// Copyright HTML.
$copyright = sprintf(
	'<p class="copyright-text" itemscope="itemscope" itemtype="http://schema.org/CreativeWork">&copy; <span class="screen-reader-text">%1s</span><span itemprop="copyrightYear">%2s</span> <span itemprop="copyrightHolder">%3s.</span> %4s.</p>',
	esc_html__( 'Copyright ', 'korey-one' ),
	date( 'Y' ),
	get_bloginfo( 'name' ),
	esc_html__( 'All rights reserved', 'korey-one' )
);

?>
<footer id="colophon" class="site-footer">
	<div class="footer-content global-wrapper footer-wrapper">
		<?php echo apply_filters( 'kwo_footer_copyright', $copyright ); ?>
	</div>
</footer>
