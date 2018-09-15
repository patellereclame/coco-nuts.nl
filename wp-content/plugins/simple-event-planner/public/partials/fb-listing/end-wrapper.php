<?php
/**
 * Facebook Event list end
 *
 * Override this template by copying it to yourtheme/simple_event_planner/fb-listingg/end-wrapper.php
 * 
 * @version     1.0.0
 * @since       1.4.0 
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/fb-listing
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
 * @since   1.4.0
 * 
 * @param   html    $end_wrapper   End wrapper HTML.                   
 */
echo apply_filters( 'sep_end_wrapper_template', $end_wrapper );