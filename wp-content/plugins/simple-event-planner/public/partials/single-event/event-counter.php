<?php
/**
 * This part of template displaying counter & date on event detail page.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/single-event/event-counter.php
 * 
 * @version     2.0.1
 * @since       1.1.0 
 * @since       1.3.0 Revised structure & added filter
 * @since       1.4.0 Hide event counter for past events
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/single-event
 */
ob_start();
$current_date = date( 'Y-m-d H:i:s' );
$today = strtotime( $current_date );
$sep_event_start_date = sep_get_the_event_start_date();
$startDate = strtotime( $sep_event_start_date );

if ( ('' !== sep_get_the_event_start_date() && '' !== sep_get_the_event_end_date()) || ( $startDate >= $today ) ) {

	// Change Class of Image is not Available 
	$image_class = sep_get_the_event_image() ? 'countdown' : 'countdown no-image';
	?>
	<div class="<?php echo esc_attr( $image_class ); ?>">

		<!-- Event Counter -->
		<div id="countdownwrapp">
			<div id="countdown-underconstruction"></div>
			<div class="clearfix"></div>
		</div>        
	</div>
	<div class="overlay-counter"></div>

	<?php
}
$event_counter = ob_get_clean();

/**
 * Modify Event Counter - Event Counter Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html    $event_counter   Event Counter HTML.                   
 */
echo apply_filters( 'sep_event_counter_template', $event_counter );