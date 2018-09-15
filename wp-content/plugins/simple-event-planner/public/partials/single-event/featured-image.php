<?php
/**
 * Template displaying featured image of event detail page.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/single-event/featured-image.php
 * 
 * @version     2.0.0
 * @since       1.1.0 
 * @since       1.3.0 Revised structure & added filter
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/single-event
 */
ob_start();
global $post;
?>

<!-- Start Event Feature Image 
================================================== -->
<div class="single-event-image">
	<?php
	sep_the_event_image( '', '', 557, 300, $post );

	/**
	 * Template -> event-counter:
	 * 
	 * - Event Counter
	 */
	get_simple_event_planner_template( 'single-event/event-counter.php' );
	?> 
</div>
<?php
/**
 * Template -> event-calendar:
 * 
 * - Event Calendar
 */
get_simple_event_planner_template( 'single-event/event-calendar.php' );
?>

<!-- ==================================================
End Event Feature Image  -->

<?php
$html_featured_image = ob_get_clean();

/**
 * Modify Event Featured Image - Featured Image Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html    $html_featured_image   Event Description HTML.                   
 */
echo apply_filters( 'sep_event_featured_image_template', $html_featured_image );
