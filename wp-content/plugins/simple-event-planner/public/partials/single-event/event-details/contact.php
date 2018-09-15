<?php
/**
 * This template contains event organiser's contact number.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/single-event/event-detail/conatct.php
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

if ('' <> sep_get_the_organizer_contact()) { ?>

    <!-- Start Event Organizer contact
    ================================================== -->
    <strong>
    <?php esc_html_e('Phone', 'simple-event-planner'); ?>
    </strong>
    <span>
    <?php echo sep_get_the_organizer_contact(); ?> 
    </span>
    <!-- ==================================================
    End Event Organizer contact -->
    <?php
}

$contact = ob_get_clean();

/**
 * Modify Event Contact - Contact Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html    $contact   Event Contact HTML.                   
 */
echo apply_filters('sep_contact_template', $contact);