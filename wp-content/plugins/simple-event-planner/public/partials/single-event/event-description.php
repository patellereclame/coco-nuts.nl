<?php
/**
 * Template displayng descirption of event detail page.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/single-event/event-description.php
 * 
 * @version     2.0.0
 * @since       1.1.0 
 * @since       1.3.0 Revised structure & added filter
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/single-event
 */
ob_start();
?>

<!-- Event Description -->
<div class="single-event-description">
	<?php the_content(); ?> 
</div>
<!--End Description-->

<?php
$event_description = ob_get_clean();
/**
 * Modify Event Description  - Event Description Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html    $event_description   Event Description HTML.                   
 */
echo apply_filters( 'sep_event_description_template', $event_description );
