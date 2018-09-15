<?php
/**
 * This template contains event orgnaizer's name.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/single-event/event-detail/venue.php
 * 
 * @version     1.0.0
 * @since       1.3.1 
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/single-event/event-detail
 */
ob_start();
global $post;

// Left Side Map Settings
$sep_event_options = get_option('sep_event_options');
//$map_settings = $sep_event_options['sep_event_map'];
//
//if ('map-left' === $map_settings) {
    if ('' !== sep_get_the_event_venue() || sep_get_the_event_venue_map()) {
        ?>
    <!-- Start Event Left Side Venue
    ================================================== -->
        <div class="event-venue">
            
            <!-- Event Location -->
            <?php if ('' !== sep_get_the_event_venue()) { ?>
                <h3> <?php esc_html_e('Venue:', 'simple-event-planner'); ?> </h3>
                <div class="event-info">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <span><?php echo sep_get_the_event_venue(); ?></span>
                </div>
            <?php } ?> 

            <!-- Event Venue Map -->
            <?php if (sep_get_the_event_venue_map()) { ?>
                <div class="map">
                    <?php echo sep_get_the_event_venue_map(); ?>                   
                </div>
            <?php } ?>
        </div>
     <!-- ==================================================
    End Event Left Side Venu -->
        <?php
    }
//}
$left_venue = ob_get_clean();

/**
 * Modify Event Left Venue Template. 
 *                                       
 * @since   1.3.1
 * 
 * @param   html    $left_venue   Event Left Venue Section HTML.                   
 */
echo apply_filters('sep_left_venue', $left_venue);