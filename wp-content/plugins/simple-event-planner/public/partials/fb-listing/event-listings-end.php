<?php
/**
 * Facebook Event list end
 *
 * Override this template by copying it to yourtheme/simple_event_planner/fb-listing/event-listing-start.php
 * 
 * @version     1.0.0
 * @since       1.4.0 
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/fb-listing
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
 * @since   1.4.0
 * 
 * @param   html    $event_listing_end   Event Listing Start Page HTML.                   
 */
echo apply_filters('event_listing_end_template', $event_listing_end);