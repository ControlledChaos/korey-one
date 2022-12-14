<?php
/**
 * Contains the post embed header template
 *
 * @package    Korey_One
 * @subpackage Templates
 * @category   Footers
 * @since      1.0.0
 */

namespace KoreyOne;

use function KoreyOne\Tags\body_class;

if ( ! headers_sent() ) {
	header( 'X-WP-embed: true' );
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<title><?php echo wp_get_document_title(); ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<?php do_action( 'embed_head' ); ?>
	<?php do_action( 'kwo_embed_head' ); ?>
</head>
<body <?php body_class(); ?>>
