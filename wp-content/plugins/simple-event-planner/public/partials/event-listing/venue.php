<?php
/**
 * The template for displaying event venue google link.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/event-listing/venue.php
 * 
 * @version     2.0.0
 * @since       1.1.0 
 * @since       1.3.0  Revised structure & added filter
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/event-listing
 */
ob_start();
global $post;

if ('' !== sep_get_the_event_venue()) { ?>

    <!-- Start Event Venue Google Map Link
    ================================================== -->
    <h4 class="location">
        <a target="blank" href="<?php sep_the_event_venue_google_map_link(); ?> "><?php sep_the_event_venue(); ?></a>
    </h4>
    <!-- ==================================================
    End Event Venue Google Map Link -->
<?php
}

$event_list_venue = ob_get_clean();

/**
 * Modify Event Venue - Venue Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html   $event_list_venue  Venue HTML.                   
 */
echo apply_filters('sep_event_list_venue_template', $event_list_venue);