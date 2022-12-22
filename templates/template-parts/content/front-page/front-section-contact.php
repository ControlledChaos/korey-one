<?php
/**
 * Contact form section layout
 *
 * @package    JPierce_Front
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

?>
<?php the_sub_field( 'front_form_content' ); ?>
<?php echo do_shortcode( sanitize_text_field( get_sub_field( 'front_form_shortcode' ) ) ); ?>
