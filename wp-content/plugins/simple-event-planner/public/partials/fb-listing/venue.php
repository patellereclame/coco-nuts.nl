<?php
/**
 * The template for displaying Facebook event venue google link.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/fb-listing/venue.php
 * 
 * @version     1.0.0
 * @since       1.4.0 
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/fb-listing
 */
ob_start();
global $item;

if (!empty($item->place->name)) {
    ?>

    <!-- Start Event Venue Google Map Link
    ================================================== -->
    <h4 class="location">
        <a target="blank" href="<?php echo esc_url(sep_get_the_fb_event_venue_map_link()); ?> "><?php
            if ('' !== $item->place->name) {
                echo $item->place->name;
            }
            ?></a>
    </h4>
    <!-- ==================================================
    End Event Venue Google Map Link -->
    <?php
}

$event_list_venue = ob_get_clean();

/**
 * Modify Event Venue - Venue Template. 
 *                                       
 * @since   1.4.0
 * 
 * @param   html   $event_list_venue  Venue HTML.                   
 */
echo apply_filters('sep_facebook_event_list_venue_template', $event_list_venue);
