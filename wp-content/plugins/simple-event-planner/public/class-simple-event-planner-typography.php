<?php
if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly
/**
 * Simple_Event_Planner_Typography Class
 * 
 * This is used to implement typography settings. This class applying custom 
 * typography on event listing and calendar page. 
 *
 * @link        https://wordpress.org/plugins/simple-event-planner/
 * @since       1.1.0
 *
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public
 * @author      PressTigers <support@presstigers.com>
 */

class Simple_Event_Planner_Typography {

    /**
     * Initialize the class and set its properties.
     *
     * @since   1.1.0
     */
    public function __construct() {

        // Hook -> Trigger User Defined Styles in Head Section
        add_action('wp_head', array($this, 'sep_typography'));
    }

    /**
     * This function implementing style changes on calender and event listing
     * 
     * @since  1.1.0
     * 
     * @global array $sep_event_options
     * 
     * @return void
     */
    public function sep_typography() {
        global $post;

        if (is_sep()) {

            //Get Event Options
            $sep_event_options = get_option('sep_event_options');

            /* Color  Options */
            $event_primary_color = isset($sep_event_options['event_primary_color']) ? esc_attr($sep_event_options['event_primary_color']) : '#3399fe';

            $event_secondary_color = isset($sep_event_options['event_secondary_color']) ? esc_attr($sep_event_options['event_secondary_color']) : '#f7f7f7';

            $event_title_color = isset($sep_event_options['event_title_color']) ? esc_attr($sep_event_options['event_title_color']) : '#363e40';

            $event_content_color = isset($sep_event_options['event_content_color']) ? esc_attr($sep_event_options['event_content_color']) : '#ababab';
            ?>
            <style type="text/css">

                /* Primary Color Styles */
                .sep-page .list-view article .date,
                .sep-page .grid-view article .date,
                .sep-page .grid .search button,
                .sep-page .sep-calendar .search button,
                .sep-page .listing .search button,
                .sep-page .sep-calendar .eventCalendar-wrap .eventsCalendar-slider .eventsCalendar-monthWrap .eventsCalendar-daysList .eventsCalendar-day-header,
                .sep-page .sep-calendar .eventCalendar-wrap .eventsCalendar-slider .eventsCalendar-monthWrap .eventsCalendar-daysList li.dayWithEvents,
                .sep-page .sep-detail .event-description .single-event-image .overlay-counter,
                .sep-page .sep-detail .single-segments .segments-style .timeline,
                .sep-page .list-view .btn.btn-primary,
                .sep-page .list-view .btn.btn-primary:hover,
                .sep-page .grid-view .btn.btn-primary,
                .sep-page .grid-view .btn.btn-primary:hover,
                .sep-page .pagination li a:hover,
                .sep-page .pagination li span.current,
                .sep-page .pagination li span.current:hover
                {
                    background-color: <?php echo $event_primary_color; ?>;
                }

                .sep-page .pagination li span.current {                    
                    border-color: <?php echo $event_primary_color; ?>;
                }

                .sep-page .pagination > li > a, .sep-page .pagination > li > span, 
                .sep-page .sep-detail .event-description .google-calendar-ical a,
                .sep-page .sep-detail .event-organizer span a ,.sep-page .sep-detail .single-segments .segments-style .item::before,
                .sep-page .sep-detail .event-venue .event-info i
                {
                    color: <?php echo $event_primary_color; ?>;  
                }

                /* Secondary Color Styles */
                .sep-page .grid-view article, .sep-page .list-view article 
                {
                    background-color: <?php echo $event_secondary_color; ?>;
                }                

                /* Title (Heading and Sub Heading) */
                .sep-page .list-view article .description h4 a,
                .sep-page .grid-view article .description h4 a,
                .sep-page .sep-detail .event-organizer h3,
                .sep-page .sep-detail .single-event-time h3,
                .sep-page .sep-detail .event-venue h4,
                .sep-page .sep-detail .single-segments h3,
                .sep-page .sep-detail .event-organizer table tr td:first-child,
                .sep-page .sep-detail .single-event-time .event-date-time strong,
                .sep-page .sep-detail .event-description .event-title h2,
                .sep-page .sep-detail a,
                .sep-page .simple-event-calendar a,
                .sep-page .description h3 a,
                .sep-event-organizer span a:focus,
                .sep-page .sep-calendar .eventCalendar-wrap .eventsCalendar-subtitle,
                .eventsCalendar-currentTitle .monthTitle,
                .sep-page .sep-detail .event-organizer strong,.sep-page .sep-detail .single-date
                {
                    color: <?php echo $event_title_color; ?>;
                }

                /* Content */
                .sep-page .sep-detail .event-description .single-event-description p,
                .sep-page .sep-detail .event-organizer table tr td:last-child,
                .sep-page .sep-detail .single-event-time .event-date-time time,
                .sep-page .sep-detail .single-segments .segments-style .item,
                .sep-page .main-digit-wrapp .countdown-period,
                .sep-page .sep-detail .event-venue,
                .sep-page .list-view article .description .location a
                {
                    color: <?php echo $event_content_color; ?>; 
                }
            </style> 
            <?php
        }
    }

}

new Simple_Event_Planner_Typography();
