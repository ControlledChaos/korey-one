<?php
/**
 * ACF content template for contact page templates.
 *
 * Used if the Advanced Custom Fields plugin is active.
 *
 * @package    Korey_One
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

namespace KoreyOne;

// Alias namespaces.
use KoreyOne\Tags as Tags;

// Get ACF fields (not repeater subfields).
$page_layout    = get_field( 'contact_page_layout' );
$contact_info   = get_field( 'contact_info' );
$contact_form   = get_field( 'contact_form' );
$form_heading   = get_field( 'contact_form_heading' );
$form_notice    = get_field( 'contact_form_notice' );
$info_location  = get_field( 'contact_info_location' );
$form_location  = get_field( 'contact_form_location' );
$agents_heading = get_field( 'agents_heading' );
$agents_notice  = get_field( 'agents_notice' );
$resume_heading = get_field( 'resume_heading' );
$resume_type    = get_field( 'resume_type' );
$resume_url     = get_field( 'resume_url' );
$resume_file    = get_field( 'resume_file' );
$resume_notice  = get_field( 'resume_notice' );

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
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

	<div class="entry-content" itemprop="articleBody">

		<?php if ( $contact_info && ( ! $info_location || 'top' == $info_location ) ) : ?>
		<div class="contact-info contact-info-top">
			<?php echo $contact_info; ?>
		</div>
		<?php endif; ?>

		<?php

		if ( 'list' != $page_layout && $contact_form && ( ! $form_location || 'top' == $form_location ) ) : ?>
		<div class="contact-form contact-form-top">
			<?php if ( $form_heading ) {
				printf(
					'<h2>%s</h2>',
					esc_html( $form_heading )
				);
			} ?>
			<?php if ( $form_notice ) { echo $form_notice; } ?>
			<?php echo do_shortcode( sanitize_text_field( $contact_form ) ); ?>
		</div>
		<?php endif; ?>

		<?php

		if ( 'form' != $page_layout && have_rows( 'agent_departments' ) ) :

		?>
		<div class="contact-agents">

			<?php if ( $agents_heading ) {
				printf(
					'<h2>%s</h2>',
					esc_html( $agents_heading )
				);
			} ?>
			<?php if ( $agents_notice ) { echo $agents_notice; } ?>
			<?php

			while ( have_rows( 'agent_departments' ) ) : the_row();

			?>
			<div class="agents-department">
				<h3><?php echo get_sub_field( 'agent_dept_name' ); ?></h3>

				<?php

				if ( have_rows( 'agents' ) ) :

				?>
				<ul class="agents-list">
				<?php

				while ( have_rows( 'agents' ) ) : the_row();

				$name   = get_sub_field( 'agent_name' );
				$agency = get_sub_field( 'agent_agency' );
				$phone  = get_sub_field( 'agent_phone' );
				$email  = sanitize_email( get_sub_field( 'agent_email' ) );

				$agent = '';
				if ( $name && $agency ) {
					$agent = sprintf(
						'<p class="agent-line-item agent-id"><span class="agent-name name-has-agency">%s</span>, <span class="agent-agency agency-has-name">%s</span></p>',
						$name,
						$agency
					);
				} elseif ( $name && ! $agency ) {
					$agent = sprintf(
						'<p class="agent-line-item agent-id"><span class="agent-name no-agency">%s</span></p>',
						$name
					);
				} elseif ( ! $name && $agency ) {
					$agent = sprintf(
						'<p class="agent-line-item agent-id"><span class="agent-agency no-name">%s</span></p>',
						$agency
					);
				}

				?>
					<li class="agent">
						<?php echo $agent; ?>
						<?php if ( $email ) {
							printf(
								'<p class="agent-line-item agent-email">%s <a href="%s">%s</a></p>',
								__( 'Email:', 'korey-one' ),
								esc_attr( 'mailto:' . $email ),
								esc_html( $email )
							);
						} ?>
						<?php if ( $phone ) {
							printf(
								'<p class="agent-line-item agent-phone">%s <a href="%s">%s</a></p>',
								__( 'Phone:', 'korey-one' ),
								esc_attr( 'tel:' . preg_replace( '/[^\d+]/', '', $phone ) ),
								esc_html( $phone )
							);
						} ?>
					</li>
				<?php endwhile; ?>
				</ul>
			<?php endif; ?>
		</div>
		<?php endwhile; ?>
		</div>
		<?php endif; ?>

		<?php

		if ( 'list' != $page_layout && $contact_form && 'bottom' == $form_location ) : ?>
		<div class="contact-form contact-form-bottom">
			<?php if ( $form_heading ) {
				printf(
					'<h2>%s</h2>',
					esc_html( $form_heading )
				);
			} ?>
			<?php if ( $form_notice ) { echo $form_notice; } ?>
			<?php echo do_shortcode( sanitize_text_field( $contact_form ) ); ?>
		</div>
		<?php endif; ?>

		<?php if ( $contact_info && 'bottom' == $info_location ) : ?>
		<div class="contact-info contact-info-bottom">
			<?php echo $contact_info; ?>
		</div>
		<?php endif; ?>

		<?php if ( $resume ) : ?>
		<div class="contact-resume">

			<?php if ( $resume_heading ) {
				printf(
					'<h2>%s</h2>',
					esc_html( $resume_heading )
				);
			} ?>
			<?php echo $resume_notice; ?>
			<?php echo $resume_link; ?>
		</div>
		<?php endif; ?>

	</div>
</article>
