<?php if (!defined('ABSPATH')) { exit; } // Exit if accessed directly
/**
 * Simple_Event_Planner_Shortcode_Event_Calendar class
 *
 * Event Calendar Shortcode.
 * 
 * This class shows the event calendar on frontend for [event_calendar] 
 * shortcode. It displays calendar with all upcoming events listing.
 * 
 * @link        https://wordpress.org/plugins/simple-event-planner/
 * @since       1.1.0
 * @since       1.1.1 Added wrapper classes
 * 
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/includes/shortcodes
 * @author      PressTigers <support@presstigers.com>
 */

class Simple_Event_Planner_Shortcode_Event_Calendar {

    /**
     * The ID of this plugin.
     *
     * @since    1.1.0
     * @access   private
     * @var      string    $simple_event_planner    The ID of this plugin.
     */
    private $simple_event_planner;

    /**
     * The version of this plugin.
     *
     * @since    1.1.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.1.0
     * @param    string    $simple_event_planner       The name of the plugin.
     * @param    string    $version    The version of this plugin.
     */
    public function __construct($simple_event_planner, $version) {
        $this->simple_event_planner = $simple_event_planner;
        $this->version = $version;

        // Hook-> Event Calendar Shortcode
        add_shortcode( 'event_calendar', array( $this, 'sep_calendar' ) );
    }

    /**
     * Event Calander Shortcode
     *
     * @since   1.0.0
     * 
     * @param   string  $attr Calendar Shortcode Parameters 
     * @return  void 
     */
    public function sep_calendar($atts, $content) {
        // Shortcode Default Array
        $shortcode_args = array(
            'event_category' => '',
            'search' => 'true',
            'address' => '',
            'events_limit' => '5'
        );

        //Combines user shortcode attributes with known attributes
        $shortcode_args = shortcode_atts($shortcode_args, $atts);
        $rand_id = rand(999, 9999);

        // Enqueueing Scripts for Event Calendar
        wp_enqueue_script($this->simple_event_planner . '-frontend');
        wp_enqueue_script($this->simple_event_planner . '-jquery-event-calendar-min');
        wp_enqueue_script($this->simple_event_planner . '-jquery-moment');
        wp_enqueue_script($this->simple_event_planner . '-jquery-geocomplete');

        ob_start();
        ?>
        <div class="sep-page">
            <div class="sep-calendar">
                <?php
                // Display Calendar Search Bar 
                if ('false' !== strtolower(esc_attr($shortcode_args['search'])) && '' !== strtolower(esc_attr($shortcode_args['search']))) {

                    // Enqueueing Script for Google API
                    wp_enqueue_script($this->simple_event_planner . '-google-api');

                    /**
                     * Template -> Calendar Search:
                     * 
                     * - Event Location Search.
                     * 
                     * Search calendar event listing by its location.
                     */
                    get_simple_event_planner_template('search/calendar-search.php', array('event_category' => esc_attr($shortcode_args['event_category'])));
                }

                $event_calendar = $this->sep_calendar_output($shortcode_args);
                ?>
                <!-- Event Calendar -->    
                <div id="simple-event-calendar" class="simple-event-calendar" >
                    <div class="event-calendar eventCalendar-wrap" id="event-calendar-limit"> </div>
                </div>

                <!-- Script for Displaying Event Calendar -->
                <?php
                wp_enqueue_script($this->simple_event_planner . '-calendar_callback');

                // Localize Script for Making jQuery Stings Translation Ready
                wp_localize_script(
                        $this->simple_event_planner . '-calendar_callback', 'calendar_parameters', array(
                    'event_calendar' => '' . $event_calendar . '',
                    'event_limit' => esc_attr($shortcode_args['events_limit']),
                    'security' => wp_create_nonce('sep_cal_security_nonce'),
                        )
                );
                ?>
            </div>
        </div>
        <?php
        $html = ob_get_clean();

        /**
         * Filter -> Modify the Event Calendar Shortcode
         * 
         * @since   1.1.0
         * 
         * @param   HTML    $html    Event Calendar HTML Structure.
         */
        return apply_filters('sep_event_calendar_shortcode', $html . do_shortcode($content));
    }

    /**
     * sep_calendar_output
     *
     * @since   1.3.0
     * 
     * @param   string  $attr Calendar Shortcode Parameters 
     * @return  void 
     */
    public function sep_calendar_output($atts) {

        date_default_timezone_set('UTC');
        $current_time = strtotime(current_time('Y-m-d H:i:s', $gmt = 0));
        $count = 1;
        $seprator = ',';

        // Default WP_Query Arguments 
        $args = array(
            'posts_per_page' => esc_attr($atts['events_limit']),
            'post_type' => 'event_listing',
            'post_status' => 'publish',
            'meta_key' => 'event_start_date_time',
            'meta_value' => $current_time,
            'meta_compare' => '>=',
            'orderby' => 'meta_value',
            'order' => 'ASC',
        );

        // Extending Argument Array for Event Category
        if (isset($atts['event_category']) && '' !== $atts['event_category']) {
            $atts = explode(",", esc_attr($atts['event_category']));
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'event_listing_category',
                    'field' => 'slug',
                    'terms' => esc_attr($atts['event_category']),
                ),
            );
        }

        // Search Address Meta Query 
        $meta_query = array('relation' => 'OR',);
        if (isset($atts['address']) && '' !== trim($atts['address'])) {
            $search_address = explode(",", $atts['address']);
            $meta_query[] = array(
                'key' => 'event_address',
                'value' => $search_address[0],
                'compare' => 'LIKE'
            );
        }

        // Extending Argument Array for Event Search
        $args['meta_query'] = $meta_query;
        $custom_query = new WP_Query($args);
        $published_posts = $custom_query->post_count;

        // Calendar Json Encoding
        $event_calendar = '[';
        if ("" !== $custom_query->have_posts()) {
            while ($custom_query->have_posts()): $custom_query->the_post();
                global $post;
                $loc_address = get_post_meta( get_the_ID(), 'event_address', TRUE );
                $event_xml = get_post_meta( $post->ID, 'event_meta', TRUE );
                $xml_object = new SimpleXMLElement($event_xml);
                $start_date = isset($xml_object->start_date) ? $xml_object->start_date : '';
                $start_time = isset($xml_object->start_time) ? $xml_object->start_time : '';
                $dateformat = date('Y-m-d', strtotime($start_date));
                $timeformat = date('H:i:s', strtotime($start_time));
                $event_calendar .= '{"date":"' . $dateformat . ' ' . $timeformat . '","type":"","title":"' . get_the_title() . '","description":"' . $loc_address . '","url":"' . get_permalink() . '"}';
                if ($count != $published_posts) {
                    $event_calendar .= $seprator;
                }
                $count++;
            endwhile;
        }
        
        wp_reset_postdata();
        
        return $event_calendar .= ']';
    }
}