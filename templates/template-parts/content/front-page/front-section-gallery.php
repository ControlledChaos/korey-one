<?php
/**
 * Image gallery section layout
 *
 * @package    JPierce_Front
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

?>
<?php the_sub_field( 'front_gallery_content' ); ?>

<?php
$images = get_sub_field( 'front_gallery' );
$size   = get_sub_field( 'front_gallery_size' );
if ( $images ) : ?>
	<ul class="image-gallery front-image-gallery <?php echo $size; ?>-gallery">
		<?php foreach ( $images as $image ) :
			if ( $image['caption'] ) {
				$data_caption = $image['caption'];
			} else {
				$data_caption = $image['title'];
			}
		?>
			<li>
				<a href="<?php echo esc_url( $image['url'] ); ?>" data-fancybox="gallery-<?php echo $args['layout']; ?>" data-caption="<?php echo esc_attr( esc_html( $data_caption ) ); ?>">
					 <figure>
					 	<img src="<?php echo esc_url( $image['sizes'][$size] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" loading="lazy" />
						<?php if ( $image['caption'] ) : ?>
						<figcaption><?php echo esc_html( $image['caption'] ); ?></figcaption>
						<?php endif; ?>
					 </figure>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>
