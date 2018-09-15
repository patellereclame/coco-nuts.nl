<?php
/**
 * This template contains event organizer's email.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/single-event/event-detail/email.php
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

if ('' <> sep_get_the_organizer_email()) { ?> 

    <!-- Start Event Organizer's Email 
    ================================================== -->
    <strong>
        <?php esc_html_e('Email', 'simple-event-planner'); ?>
    </strong>
    <span>
        <a href="mailto:<?php echo sep_get_the_organizer_email(); ?> "> <?php echo sep_get_the_organizer_email(); ?> </a>
    </span>

    <!-- ==================================================
    End Event Organizer's Email -->

    <?php
}

$email = ob_get_clean();

/**
 * Modify Event Email - Email Template. 
 *                                       
 * @since   1.3.0
 *
 * @param   html  $email   Event Email HTML.                   
 */
echo apply_filters('sep_email_template', $email);