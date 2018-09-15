<?php if (!defined('ABSPATH')) { exit; } // Exit if accessed directly
/**
 * Simple_Event_Planner_Shortcode_Facebook_Events class
 *
 * Facebook Events Shortcode.
 *
 * This class lists the events on frontend for [sep_fb_shortcode] shortcode. It 
 * lists all upcoming events in the list with event search bar.
 * 
 * @link        https://wordpress.org/plugins/simple-event-planner/
 * @since       1.4.0
 * 
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/includes/shortcodes
 * @author      PressTigers <support@presstigers.com>
 */

class Simple_Event_Planner_Shortcode_Facebook_Events {

    /**
     * Initialize the class and set its properties.
     *
     * @since   1.4.0
     */
    public function __construct() {

        // Hook-> FB Event Listing Shortcode
        add_shortcode( 'sep_fb_event_listing', array( $this, 'fb_event_listing_shortcode') );
    }

    /**
     * Event Listing Shortcode
     *
     * @since   1.4.0
     * 
     * @param   string  $attr       Shortcode Parameters
     * @param   string  $content    Shortcode Content
     * @return  void 
     */
    public function fb_event_listing_shortcode( $atts, $content ) {
        
        ob_start();
        global $item, $shortcode_args;

        // Shortcode Default Array
        $shortcode_args = array(
            'limit' => '5',
            'events_layout' => 'list',
            'time_filter' => 'upcoming',
        );

        // Combines user shortcode attributes with known attributes
        $shortcode_args = shortcode_atts( apply_filters('sep_output_facebookevents_defaults', $shortcode_args, $atts), $atts );

        if ('upcoming' == esc_attr($shortcode_args['time_filter'])) {
            $shortcode_args['time_filter'] = 'upcoming';
        } elseif ('past' == esc_attr($shortcode_args['time_filter'])) {
            $shortcode_args['time_filter'] = 'past';
        }

        $fb_event_data = fb_get_eventslist($shortcode_args);

        if ($fb_event_data) {

            /**
             * Template -> Event Lisiting Start:
             * 
             * - Event Listing Start
             */
            get_simple_event_planner_template('event-listing/start-wrapper.php');

            /**
             * Template -> Event Lisiting Start:
             * 
             * - Event Listing Start
             */
            get_simple_event_planner_template('event-listing/event-listings-start.php', array('events_layout' => esc_attr($shortcode_args['events_layout'])));

            $paging = $fb_event_data->paging;

            if (array_key_exists("next", $paging)) {
                $paginated_data = sep_facebook_pagination($shortcode_args, 'content');
                
                if (!empty($paginated_data->paging->next) || !empty($paginated_data->paging->previous)) {
                    foreach ($paginated_data->data as $item) {

                        // Displays User Defined Layout
                        if ('grid' === esc_attr($shortcode_args['events_layout'])) {
                            get_simple_event_planner_template('content-facebookevent-listing-grid-view.php');
                        } elseif ('list' === esc_attr($shortcode_args['events_layout'])) {
                            get_simple_event_planner_template('content-facebookevent-listing-list-view.php');
                        }
                    }
                    
                    $pagination_display = sep_facebook_pagination_display();
                }
            } else {

                foreach ( $fb_event_data->data as $item ) {

                    // Displays User Defined Layout
                    if ('grid' === esc_attr($shortcode_args['events_layout'])) {
                        get_simple_event_planner_template('content-facebookevent-listing-grid-view.php');
                    } elseif ('list' === esc_attr($shortcode_args['events_layout'])) {
                        get_simple_event_planner_template('content-facebookevent-listing-list-view.php');
                    }
                    $pagination_display = sep_facebook_pagination_display();
                }
            }
            
            /**
             * Template -> Event Lisiting End:
             * 
             * - Event Listing End Wrapper
             */
            get_simple_event_planner_template('event-listing/event-listings-end.php');

            /**
             * Template -> End Wraper:
             * 
             * - Event End Wrapper
             */
            get_simple_event_planner_template('event-listing/end-wrapper.php');
        } else {
            echo 'It seems you did not fill social settings section properly, please double check it or maybe your given Facebook page does not have events any more.';
        }

        $html = ob_get_clean();

        /**
         * Filter -> Modify the Event Listing Shortcode
         * 
         * @since   1.4.0
         * 
         * @param   HTML    $html   Event Listing HTML Structure.
         */
        return apply_filters('sep_fb_event_listing_shortcode', $html . do_shortcode($content));
    }
}