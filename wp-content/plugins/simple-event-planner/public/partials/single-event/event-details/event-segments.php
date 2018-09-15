<?php
/**
 * This template contains segment's setion.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/single-event/event-segments.php
 * 
 * @version     2.0.0
 * @since       1.1.0 
 * @since       1.3.0 Revised structure & added filter
 * @since       1.4.0 Add wrapper classed to make this template independent
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/single-event/event-detail
 */
ob_start();
global $post;

$segments = sep_get_event_segment();
if ( is_array( $segments ) && '' !== $segments[0] ) {
	?>

	<!-- Start Event Segments
	================================================== -->
	<div class="single-segments">
		<!-- Start Event Segments 
		================================================== -->
		<h3> <?php esc_html_e( 'Segments:', 'simple-event-planner' ); ?> </h3>
		<ul class="segments-style">
			<?php
			if ( !empty( $segments ) ) {
				$i = 1;
				foreach ( $segments as $key => $value ) {
					if ( $value ) {
						echo '<li class="item">' . "$value" . '</li>';
					}
					$i++;
				}
			}
			?>
			<li class="timeline"></li>
		</ul>
		<!-- ==================================================
		End Event Segments -->
	</div>
	<!-- ==================================================
	End Event Segments -->
	<?php
}

$segments = ob_get_clean();

/**
 * Modify Event's Segments - Segments Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html    $segments   Segments HTML.                   
 */
echo apply_filters( 'sep_segments_template', $segments );
