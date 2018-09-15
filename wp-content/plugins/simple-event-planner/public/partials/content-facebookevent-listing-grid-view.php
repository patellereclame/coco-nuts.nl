<?php
/**
 * The template for displaying Facebook events in grid view/layout.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/content-event-listing-grid-view.php
 * 
 * @version     1.0.0
 * @since       1.4.0 
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials
 */
ob_start();
global $item;
?>

<!-- Start Event Grid View
================================================== -->
<div class="col-sm-4">
    <article>

        <!-- Featured Image -->
        <?php if (!empty($item->cover->source)) { ?>
            <a href="https://www.facebook.com/events/<?php echo $item->id; ?>">
                <img src="<?php echo $item->cover->source; ?>">
            </a>
            <?php
        }

        /**
         * Template -> Event Start Date:
         * 
         * - Event Start Title
         */
        get_simple_event_planner_template('fb-listing/event-start-date.php');
        ?>
        <div class="description">

            <?php
            /**
             * Template -> Title:
             * 
             * - Event Title
             */
            get_simple_event_planner_template('fb-listing/title.php');

            /**
             * Template -> Venue:
             * 
             * - Event Venue
             */
            get_simple_event_planner_template('fb-listing/venue.php');

            /**
             * Template -> Date:
             * 
             * - Event Date
             */
            get_simple_event_planner_template('fb-listing/date.php');
            ?>  
        </div>
    </article>
</div>     
<!-- ==================================================
End Event Grid -->

<?php
$html_gird_view = ob_get_clean();

/**
 * Modify Event Listing Grid View Template. 
 *                                       
 * @since   1.4.0
 * 
 * @param   html    $html_grid_view   Event List Grid HTML.                   
 */
echo apply_filters('sep_grid_view_template', $html_gird_view);
