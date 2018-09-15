<?php
/**
 * The template for displaying Facebook event start date on listing page.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/fb-listing/event-start-date.php
 * 
 * @version     1.0.0
 * @since       1.4.0 
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/fb-listing
 */
ob_start();
global $item;

if ( '' !== $item->start_time ) {
	?>

	<!-- Start Event Date
		================================================== -->
	<div class="date">
		<div class="date-style">
			<?php
			$start_date = strtotime( $item->start_time );
			echo date( 'j F Y', $start_date );			
			?>
		</div>
	</div> 
	<!-- ==================================================
	End Event Date section -->
	<?php
}
$event_list_start_date = ob_get_clean();

/**
 * Modify Event Listing Start Date - Event Start Date Template. 
 *                                       
 * @since   1.4.0
 * 
 * @param   html  $event_list_start_date   Date HTML.                   
 */
echo apply_filters( 'sep_facebook_event_list_start_date_template', $event_list_start_date );
