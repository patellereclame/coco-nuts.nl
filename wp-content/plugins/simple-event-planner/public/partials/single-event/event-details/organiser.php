<?php
/**
 * This template contains event orgnaizer's name.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/single-event/event-detail/organiser.php
 * 
 * @version     2.0.0
 * @since       1.1.0 
 * @since       1.3.0 Revised structure & added filter
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/single-event/event-detail
 */
ob_start();
global $post;

if ('' !== sep_get_the_event_organizer()) { ?> 

    <!-- Start Event Organizer's Name
    ================================================== -->
    <strong><?php esc_html_e('Name', 'simple-event-planner'); ?></strong>
    <span><?php echo sep_get_the_event_organizer(); ?></span>
    <!-- ==================================================
    End Event Organizer's Name -->
    <?php
}

$organiser = ob_get_clean();

/**
 * Modify Event's Organiser Name - Name Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html    $organiser   Name HTML.                   
 */
echo apply_filters('sep_organiser_template', $organiser);