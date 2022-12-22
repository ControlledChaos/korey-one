<?php
/**
 * Resume section layout
 *
 * @package    JPierce_Front
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

// Get ACF fields (not repeater subfields).
$resume_type    = get_sub_field( 'front_resume_type' );
$resume_url     = get_sub_field( 'front_resume_url' );
$resume_file    = get_sub_field( 'front_resume_file' );
$resume_notice  = get_sub_field( 'front_resume_notice' );

// Whether to display the resume section.
if ( $resume_url || $resume_file || $resume_notice ) {
	$resume = true;
} else {
	$resume = false;
}

// Resume link.
$resume_link = '';

if ( 'url' == $resume_type && $resume_url ) {

	$resume_link = sprintf(
		'<p class="resume-link"><a href="%s" target="_blank" rel="nofollow">%s</a></p>',
		esc_url( $resume_url ),
		__( 'View Resume', 'korey-one' )
	);

} elseif ( 'file' == $resume_type && $resume_file ) {

	$resume_link = sprintf(
		'<p class="resume-link"><a href="%s" target="_blank" rel="nofollow">%s</a></p>',
		esc_url( $resume_file['url'] ),
		__( 'Download Resume', 'korey-one' )
	);
}

?>
<?php if ( $resume ) : ?>
<div class="contact-resume">
	<?php echo $resume_notice; ?>
	<?php echo $resume_link; ?>
</div>
<?php endif; ?>
