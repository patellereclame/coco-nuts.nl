<?php
/**
 * The template for displaying event event schedule.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/event-listing/schedule.php
 * 
 * @version     2.0.0
 * @since       1.1.0 
 * @since       1.3.0 Revised structure & added filter
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/event-listing
 */
ob_start();
global $post;
?>

<!-- Start Event Start & End Date
================================================== -->
<div class="event-plan">
    <div class="event-schedule">
        <?php
        /**
         * Template -> Venue:
         * 
         * - Event Venue.
         */
        get_simple_event_planner_template('event-listing/venue.php');
        ?>
    </div>
    <div class="event-schedule">
        <?php
        /**
         * Template -> Date:
         * 
         * - Event Start & End Date.
         */
        get_simple_event_planner_template('event-listing/date.php');
        ?>
    </div>
</div>
<!-- ==================================================
End Event Start & End Date -->

<?php

$event_list_schedule = ob_get_clean();
/**
 * Modify Event Schedule - Schedule Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html    $event_list_schedule   Schedule HTML.                   
 */
echo apply_filters('sep_schedule_template', $event_list_schedule);