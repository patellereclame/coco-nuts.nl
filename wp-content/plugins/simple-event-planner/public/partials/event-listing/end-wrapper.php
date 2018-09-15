<?php
/**
 * Event list end
 *
 * Override this template by copying it to yourtheme/simple_event_planner/event-listing/end-wrapper.php
 * 
 * @version     1.0.1
 * @since       1.3.0 
 * @since       1.4.0 Added wrapper classes 
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/event-listing
 */
ob_start();
?>

</div>
</div>

<?php
$end_wrapper = ob_get_clean();

/**
 * Modify End Wrapper Template. 
 *                                          
 * @since   1.3.0
 * 
 * @param   html    $end_wrapper   End wrapper HTML.                   
 */
echo apply_filters('sep_end_wrapper_template', $end_wrapper);