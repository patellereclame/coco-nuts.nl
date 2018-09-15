<?php if (!defined('ABSPATH')) { exit; } // Exit if accessed directly
/**
 * Simple_Event_Planner_Admin Class
 * 
 * The admin-specific functionality of the plugin.
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and javaScript
 * 
 * @link       https://wordpress.org/plugins/simple-event-planner/
 * @since      1.0.0
 * @since      1.3.1    PressTiger Branding in SEP Footer
 * 
 * @package    Simple_Event_Planner
 * @subpackage Simple_Event_Planner/admin
 * @author     PressTigers <support@presstigers.com>
 */

class Simple_Event_Planner_Admin {

    /**
     * The ID of this plugin.
     *
     * @since   1.0.0
     * @access  private
     * @var     string  $simple_event_planner   The ID of this plugin.
     */
    private $simple_event_planner;

    /**
     * The version of this plugin.
     *
     * @since   1.0.0
     * @access  private
     * @var     string  $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since   1.0.0
     * @param   string  $simple_event_planner   The name of this plugin.
     * @param   string  $version                The version of this plugin.
     */
    public function __construct($simple_event_planner, $version) {
        $this->simple_event_planner = $simple_event_planner;
        $this->version = $version;

        /**
         * The class responsible for defining all the meta options under custom post type in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-simple-event-planner-meta-boxes-init.php';

        /**
         * The class is responsible for defining all the plugin settings that occurs in event setting.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-simple-event-planner-admin-settings-init.php';

        /**
         * The class is responsible for creating shortcode builder.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-simple-event-planner-admin-shortcodes-generator.php';

        // Filter -> Footer Branding - With PressTigers Logo
        add_filter('admin_footer_text', array($this, 'admin_powered_by'));
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since   1.0.0
     * 
     * @version 1.0.0
     */
    public function enqueue_styles() {
        if (is_admin()) {

            // Enqueue Google Fonts
            wp_enqueue_style($this->simple_event_planner . "-opensans", 'https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic)', array(), 'all');

            // Enqueue Font Awesome Styles
            wp_enqueue_style($this->simple_event_planner . '-fontawsome', plugin_dir_url(__FILE__) . 'css/font-awesome.min.css', array(), '4.7.0', 'all');

            // Enqueue Admin Styles
            wp_enqueue_style($this->simple_event_planner . '-admin-styles', plugin_dir_url(__FILE__) . 'css/simple-event-planner-admin.css', array('wp-color-picker'), $this->version, 'all');

            // Enqueue Media Styles
            wp_enqueue_media();
        }
    }

    /**
     * Register the JavaScript for the admin area.  
     *
     * @since   1.0.0
     * @since   1.1.0  Added new JS file  simple-event-planner-functions.js
     */
    public function enqueue_scripts() {
        
        if (is_admin()) {
            $sep_event_options = get_option('sep_event_options');
            $api_key = (!empty($sep_event_options['sep_event_gmap_key'])) ? 'key=' . trim($sep_event_options['sep_event_gmap_key']) . '&' : '';

            // Register Google Map API Script
            wp_register_script($this->simple_event_planner . '-jquery-google-map-api', 'https://maps.googleapis.com/maps/api/js?' . esc_attr($api_key) . 'v=3&libraries=places', '', '3.31', TRUE);

            // Enqueue GMap Latitude Longitute Script
            wp_enqueue_script($this->simple_event_planner . '-jquery-gmaps-latlon-picker', plugin_dir_url(__FILE__) . 'js/jquery-gmaps-latlon-picker.js', '', '1.2', TRUE);

            // Enqueue Auto Geocomplete Script
            wp_enqueue_script($this->simple_event_planner . '-jquery-geocomplete', plugin_dir_url(__FILE__) . 'js/jquery.geocomplete.min.js', '', '1.7.0', TRUE);

            // Enqueue Datepicker Script
            wp_enqueue_script($this->simple_event_planner . '-jquery-datepicker', plugin_dir_url(__FILE__) . 'js/jquery.datetimepicker.js', '', '2.5.4', TRUE);

            // Enqueue Admin Script
            wp_enqueue_script($this->simple_event_planner . '-admin-scripts', plugin_dir_url(__FILE__) . 'js/simple-event-planner-admin.js', array('jquery', 'wp-color-picker'), $this->version, TRUE);

            // Enqueue Sortable Script
            wp_register_script($this->simple_event_planner . '-rubaxa-script', plugin_dir_url(__FILE__) . 'js/Sortable.min.js', '', '1.7.0', TRUE);

            // Enqueue jQuery UI Script
            wp_enqueue_script($this->simple_event_planner . '-jQuery-ui-script', plugin_dir_url(__FILE__) . 'js/jquery-ui.min.js', '', '1.10.3', TRUE);

            // Register Alpha Color Picker Script
            wp_register_script('wp-color-picker-alpha', plugin_dir_url(__FILE__) . 'js/wp-color-picker-alpha.min.js', array('wp-color-picker'), '2.1.2', TRUE);
        }
    }

    /**
     * PressTiger Branding in SEP Footer.
     *
     * @since   1.3.1
     */
    public function admin_powered_by($text) {
        $screen = get_current_screen();

        // SEP Admin Page ID's
        $sep_pages = array(
            'event_listing_page_event-planner-settings',
            'edit-event_listing',
            'event_listing',
            'edit-event_listing_category',
        );

        if (is_admin() && ( in_array($screen->id, apply_filters('sep_pages', $sep_pages)) )) {
            $text = '<a href="' . esc_url("https://www.presstigers.com/") . '" target="_blank"><img src="' . plugins_url('/images/powerByIcon.png', __FILE__) . '" alt="Powered by PressTigers"></a>';
        }
        return $text;
    }
}