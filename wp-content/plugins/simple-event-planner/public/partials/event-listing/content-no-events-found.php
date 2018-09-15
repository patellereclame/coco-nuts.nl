<?php
/**
 * Displayed when no events are found, matching the current query.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/event-listing/content-no-events-found.php
 *
 * @version     2.0.0
 * @since       1.1.0
 * @since       1.3.0 Added go back link to event listing and applied filter
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/event-listing
 */
ob_start();

// Get Current Page Slug           
$slugs = sep_get_slugs();
$page_slug = $slugs[0];
$slug = ( get_option( 'permalink_structure' ) ) ? $page_slug : '';

echo '<div class="no_found"><p>' . esc_html__( 'No events found.', 'simple-event-planner' ) . '</p><p><a href="' . esc_url( home_url( '/' ) ) . $slug . '" class="btn btn-primary">' . esc_html__( 'Go Back to Event Listing', 'simple-event-planner' ) . '</a></p></div>';

$sep_not_found = ob_get_clean();

/**
 * Modify Not Found Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html    $sep_not_found   Not Found HTML.                   
 */
echo apply_filters( 'sep_no_events_found_template', $sep_not_found );