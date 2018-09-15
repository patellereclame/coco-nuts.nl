<?php
/**
 * This template contains event title's setion.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/single-event/event-title.php
 * 
 * @version     1.0.0
 * @since       1.4.0 
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/single-event
 */
ob_start();

global $post;
?>

<!-- Event Title -->
<div class="event-title">
	<h2><?php echo apply_filters( 'sep_single_event_detail_page_title', esc_attr( get_the_title() ) ); ?></h2>
</div>

<?php
$event_title = ob_get_clean();
/**
 * Modify Event Description  - Event Description Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html    $event_description   Event Title HTML.                   
 */
echo apply_filters( 'sep_event_title_template', $event_title );
