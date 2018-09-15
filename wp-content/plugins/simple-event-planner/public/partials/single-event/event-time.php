<?php
/**
 * This part of template displaying event start and end time with timezone string on event detail page.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/single-event/event-time.php
 * 
 * @version     2.0.1
 * @since       1.1.0 
 * @since       1.3.0 Revised structure & added filter
 * @since       1.4.0 Added Timezone string with time
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/single-event
 */
ob_start();
global $post;

// Start Event's Start and End Time
if ( '' !== sep_get_the_event_start_time() && '' !== sep_get_the_event_end_time() ) {
	$time_zone = sep_get_timezone();
	?>
	<div class="event-date-time">
		<strong><?php esc_html_e( 'Time:', 'simple-event-planner' ); ?></strong>
		<time><?php echo sep_get_the_event_start_time() . esc_html__( ' - to - ', 'simple-event-planner' ) . sep_get_the_event_end_time() . ' (' . $time_zone . ')'; ?></time>
	</div>
<?php } elseif ( '' !== sep_get_the_event_start_time() ) {
	?>
	<div class="event-date-time">
		<strong><?php esc_html_e( 'Time:', 'simple-event-planner' ); ?></strong>
		<time><?php echo sep_get_the_event_start_time() . ' (' . $time_zone . ')'; ?></time>
	</div>
	<?php
}

$event_time = ob_get_clean();

/**
 * Modify Event Time  - Event Time Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html    $event_time   Event Time HTML.                   
 */
echo apply_filters( 'sep_event_time_template', $event_time );