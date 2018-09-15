<?php
/**
 * This template contains event schedule's setion.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/single-event/event-schedule.php
 * 
 * @version     1.0.0
 * @since       1.4.0 
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/single-event
 */
ob_start();

global $post;

if ( '' != sep_get_the_event_start_date() || '' != sep_get_the_event_end_date() || '' != sep_get_the_event_start_time() || '' != sep_get_the_event_start_time() ) {
	?>

	<!-- Start Event Schedule
	==================================================-->
	<div class="single-event-time">       
		<h3> <?php esc_html_e( 'Schedule', 'simple-event-planner' ); ?> </h3>
		<?php
		/**
		 * Template -> event-date:
		 * 
		 * - Event  Date
		 */
		get_simple_event_planner_template( 'single-event/event-date.php' );

		/**
		 * Template -> event-time:
		 * 
		 * - Event start and end time
		 */
		get_simple_event_planner_template( 'single-event/event-time.php' );
		?>
	</div>
	<!-- ==================================================
	End Event Schedule -->

	<?php
}
$event_schedule = ob_get_clean();

/**
 * Modify Event Schedule Template. 
 *                                       
 * @since   1.4.0
 * 
 * @param   html    $event_schedule   Event Schedule Section HTML.                   
 */
echo apply_filters( 'sep_event_schedule_template', $event_schedule );