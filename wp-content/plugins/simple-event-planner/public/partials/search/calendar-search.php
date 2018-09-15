<?php
/**
 * The template containig event location search for calendar event listing page.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/search/calendar-search.php
 * 
 * @version     2.0.0
 * @since       1.1.0 
 * @since       1.3.0 Revised structure & added filter
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/search
 */
ob_start();

global $post;
?>

<!-- Start Calendar Search
================================================== -->
<div class="search">
    <div class="form-group">

        <!-- Search Form -->
        <form class="form-group" method="post" action="javascript:sep_search_events('<?php echo esc_url( admin_url("admin-ajax.php") ); ?>')" id="search-form">
            <input class="form-control" type="text" placeholder="Search Location" id="loc-addres" name="loc-addres" value="">
            <button class="input-group-addon submit-location" type="submit" id="">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
            <input type="hidden" id="location-address" name="location-address" value="">
            <input type="hidden" id="loc-search" name="loc-search" value="false">
            <input type="hidden" id="event-cat" name="event-cat" value="<?php echo trim(esc_attr($event_category)); ?>">
        </form>
        <!-- Search Form -->

    </div>
</div>
<!-- ==================================================
End Calendar Search -->

<?php
$calendar_search = ob_get_clean();

/**
 * Modify Calendar Seacrch - Calendar Search Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html    $calendar_search   Calendar Search HTML.                   
 */
echo apply_filters('sep_calendar_search_template', $calendar_search);