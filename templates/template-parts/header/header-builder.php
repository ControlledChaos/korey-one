<?php
/**
 * Page builder header content template
 *
 * @package    Korey_One
 * @subpackage Templates
 * @category   Headers
 * @since      1.0.0
 */

namespace KoreyOne;

// Alias namespaces.
use KoreyOne\Tags as Tags;

?>
<header id="masthead" class="site-header" role="banner" itemscope="itemscope" itemtype="http://schema.org/Organization">

	<div class="site-branding">

		<?php echo Tags\site_logo(); ?>

		<div class="site-title-description">

			<?php if ( is_front_page() ) : ?>
				<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
				<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_attr( esc_url( get_bloginfo( 'url' ) ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif;

			$site_description = get_bloginfo( 'description', 'display' );
			if ( $site_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $site_description; ?></p>
			<?php endif; ?>

		</div>
	</div>
</header>
