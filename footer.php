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

<script>
jQuery(document).ready( function($) {

if ( $.isFunction( $.fn.tooltipster ) ) {
	$( '.button.tooltip, a.tooltip' ).tooltipster( {
		theme    : 'kwo-tooltips',
		delay    : 72,
		distance : 36 ,
		animationDuration : 250,
	} );
}
});
</script>

<?php if ( is_front_page() && is_page_template( KWO_TMPL_DIR . '/front-page-sections.php' ) ) : ?>
<script>
jQuery(document).ready( function($) {
	if ( $.isFunction( $.fn.fullpage ) ) {
		$( '#front-page-sections' ).fullpage({
			anchors         : [ <?php echo Tags\front_page_sections(); ?> ],
			lockAnchors     : true,
			menu            : '#site-navigation',
			navigation      : true,
			dragAndMove     : true,
			sectionSelector : '.front-page-section',
			paddingTop      : '72px',
			paddingBottom   : '32px',
			responsiveWidth     : 480,
			responsiveHeight    : 560,
			scrollOverflow      : true,
			scrollOverflowReset : true,
			afterRender     : function() {
				$( '.intro-slides' ).slick({
					slidesToShow   : 1,
					slidesToScroll : 1,
					autoplay       : true,
					autoplaySpeed  : 4000,
					speed          : 750,
					fade           : true,
					easing         : 'easeInOut',
					adaptiveHeight : false,
					pauseOnHover   : false,
					arrows         : false,
					dots           : false
				});
			},
			afterLoad : function( origin, destination, direction ) {
				var leavingSection = this;
				if ( origin.index == 0 && direction =='down' ) {
					$( '.site-header-wrap' ).addClass( 'header-wrap-scrolled' );
				}
			},
			onLeave : function( origin, destination, direction ) {
				var leavingSection = this;
				if ( destination.index == 0 ) {
					$( '.site-header-wrap' ).removeClass( 'header-wrap-scrolled' );
				}
			}
		});
		// Make FullPage work with id attributes for no JS navigation fallback.
		$( '#site-navigation ul li a' ).click( function() {
			let newSlide = $(this).closest( 'li' ).data( 'menuanchor' )
			$.fn.fullpage.moveTo( newSlide, 1 );
		});
		$(document).on( 'click', '#intro-entry-link', function() {
			fullpage_api.moveSectionDown();
		});
		$( '#site-navigation ul li a' ).click( function() {
			$( '.main-navigation' ).removeClass( 'toggled' );
		});
	}
});
</script>
<?php else : // Else not front page. ?>
<script>
// Add class to header on scroll.
( function($) {
$(window).scroll( function() {

	scroll_top = $( '.site-header' ).outerHeight();

	if ( $(this).scrollTop() > scroll_top ) {
		$( '.site-header-wrap' ).addClass( 'header-wrap-scrolled' );
	} else {
		$( '.site-header-wrap' ).removeClass( 'header-wrap-scrolled' );
	}
});
})(jQuery);
</script>
<?php endif; ?>
<style>.no-js body { visibility: visible !important; }</style>
</body>
</html>
