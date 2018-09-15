<?php
/**
 * The template for displaying event start date on listing page.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/event-listing/event-start-date.php
 * 
 * @version     1.0.0
 * @since       1.3.0 
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/event-listing
 */
ob_start();
global $post;

if(''!== sep_get_the_event_start_date()){ ?>

<!-- Start Event Date
    ================================================== -->
<div class="date">
    <div class="date-style">
        <?php echo sep_get_the_event_start_date(); ?>
    </div>
</div> 
<!-- ==================================================
                              End Event Date section -->
<?php
}
$event_list_start_date = ob_get_clean();

/**
 * Modify Event Listing Start Date - Event Start Date Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html  $event_list_start_date   Date HTML.                   
 */
echo apply_filters('sep_event_list_start_date_template', $event_list_start_date);