<?php
/**
 * Event list start
 *
 * Override this template by copying it to yourtheme/simple_event_planner/event-listing/event-listing-start.php
 * 
 * @version     2.0.0
 * @since       1.1.0 
 * @since       1.3.0 Added grid-view, list_view class and filter
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/event-listing
 */
ob_start();

// Value From Shortcode's Atributes
$list_layout = isset( $events_layout ) ? $events_layout : 'list';

// Changing Class
$view_class = ('grid' == $list_layout) ? 'grid-view row' : 'list-view';
?>
<div class="<?php echo $view_class; ?>">
	<?php
	$event_listing_start = ob_get_clean();

	/**
	 * Modify Event Listing Start Template. 
	 *                                       
	 * @since   1.3.0
	 * 
	 * @param   html    $event_listing_start   Event Listing Start Page HTML.                   
	 */
	echo apply_filters( 'event_listing_start_template', $event_listing_start );