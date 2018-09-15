<?php
/**
 * Event list end
 *
 * Override this template by copying it to yourtheme/simple_event_planner/event-listing/event-listing-start.php
 * 
 * @version     2.0.0
 * @since       1.1.0 
 * @since       1.3.0 Added filter
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/event-listing
 */
ob_start();
?>
    <div class="clear"></div>
</div>
<div class="clearfix"></div>
<?php
$event_listing_end = ob_get_clean();
/**
 * Modify Event Listing Start Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html    $event_listing_start   Event Listing Start Page HTML.                   
 */
echo apply_filters('event_listing_end_template', $event_listing_end);