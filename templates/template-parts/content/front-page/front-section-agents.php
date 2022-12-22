<?php
/**
 * Representation section layout
 *
 * @package    JPierce_Front
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

// Get ACF fields (not repeater subfields).
$agents_notice  = get_sub_field( 'front_agents_notice' );

if ( have_rows( 'front_agent_departments' ) ) :

?>
<div class="contact-agents">

	<?php if ( $agents_notice ) { echo $agents_notice; } ?>
	<?php

	while ( have_rows( 'front_agent_departments' ) ) : the_row();

	?>

	<h3><?php echo get_sub_field( 'front_agent_dept_name' ); ?></h3>

	<?php

	if ( have_rows( 'front_agents' ) ) :

	?>
	<ul class="agents-list">
	<?php

	while ( have_rows( 'front_agents' ) ) : the_row();

	$name   = get_sub_field( 'front_agent_name' );
	$agency = get_sub_field( 'front_agent_agency' );
	$phone  = get_sub_field( 'front_agent_phone' );
	$email  = sanitize_email( get_sub_field( 'front_agent_email' ) );

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

<?php endwhile; ?>
</div>
<?php endif; ?>