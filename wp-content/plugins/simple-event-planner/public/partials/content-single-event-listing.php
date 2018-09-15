<?php
/**
 * The template invoking event's featured image, title & description template.
 * 
 * Override this template by copying it to yourtheme/simple_event_planner/content-single-event-listing.php
 * 
 * @version     2.1.0
 * @since       1.1.0 
 * @since       1.3.0   Revised structure & added filter
 * @since       1.4.0   Updated functions.
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials
 */
ob_start();
?>

<!-- Start Event Description
  ================================================== -->
<div class="event-description">    
    <?php /**
     * Template -> Event Description:
     * 
     * - Event Featured Image
     * - Event Title
     * - Event Description
     */
    ?>
    <!--Start Event Title, Featured Image & Description
    ================================================== -->
    <div class = "sep-event-description">
        <?php
        /**
         * Template -> Event Calendar:
         * 
         * - Event Calendar 
         */
        sep_v2_col2();
        ?>
    </div>
    <!-- ==================================================
    End Event Title, Featured Image & Description-->
</div>
<!-- ==================================================
 End Event Description -->

<?php
$content_event_listing = ob_get_clean();

/**
 * Modify Content Single Event Listing  Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html    $content_event_listing  Content Single Event Listing Page HTML.                   
 */
echo apply_filters('content_single_event_listing_template', $content_event_listing);