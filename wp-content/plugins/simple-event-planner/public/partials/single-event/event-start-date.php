<?php
/**
 * This part of template displaying event start date on top left corner of event detail page.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/single-event/event-start-date.php
 * 
 * @version     1.0.0
 * @since       1.3.0 
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/single-event
 */
ob_start(); 
global $post;

 if(''!== sep_get_the_event_start_date()){ ?>

<!-- Start Event Date
    ================================================== -->
<div class="event-schedule">
    
    <!-- Event Date -->
    <div class="single-date">
        <?php echo sep_get_the_event_start_date(); ?>
    </div>
</div>
 <!-- ==================================================
End Event Date section -->
 
<?php
 }
$single_start_date = ob_get_clean();

/**
 * Modify Event Start Date - Event Date Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html    $single_start_date   Event Start Date HTML.                   
 */
echo apply_filters('sep_event_start_date_template', $single_start_date);