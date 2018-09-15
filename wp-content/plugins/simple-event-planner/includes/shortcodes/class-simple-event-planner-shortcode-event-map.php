<?php if (!defined('ABSPATH')) { exit; } // Exit if accessed directly
/**
 * Simple_Event_Planner_Shortcode_Event_Map class
 *
 * Event Map Shortcode Class.
 *
 * This class shows the event map on frontend for [event_map] shortcode. It 
 * shows the location map on event detail page.
 * 
 * @link        https://wordpress.org/plugins/simple-event-planner/
 * @since       1.1.0
 * 
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/includes/shortcodes
 * @author      PressTigers <support@presstigers.com>
 */

class Simple_Event_Planner_Shortcode_Event_Map {

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
    public function __construct( $simple_event_planner, $version ) {
        $this->simple_event_planner = $simple_event_planner;
        $this->version = $version;

        // Hook-> Frontend Map Shortcode
        add_shortcode('event_map', array($this, 'sep_map'));
    }

    /**
     * Map Shortcode.
     *
     * @since   1.1.0
     */
    public function sep_map($atts) {
        
        // Shortcode Default Array
        $shortcode_args = array(
            'map_title'       => '',
            'map_height'      => '300',
            'map_lat'         => '37.6',
            'map_lon'         => '-95.665',
            'map_type'        => 'ROADMAP',
            'map_info'        => '',
            'map_zoom'        => '7',
            'map_info_width'  => '200',
            'map_info_height' => '100',
            'map_show_marker' => TRUE,
            'map_controls'    => TRUE,
            'map_draggable'   => TRUE,
            'map_scrollwheel' => TRUE,
            'map_color'       => '',
            'marker_image'    => ''
        );
        
       //Combines user shortcode attributes with known attributes
       $shortcode_args= shortcode_atts($shortcode_args, $atts);
       
        $map_dynmaic_no = rand(99, 999);

        // Localize the Script With Map Data
        $map_data = array(
            'map_height'        => esc_attr( $shortcode_args['map_height'] ),
            'map_lat'           => esc_attr( $shortcode_args['map_lat'] ),
            'map_lon'           => esc_attr( $shortcode_args['map_lon'] ),
            'map_type'          => esc_attr( $shortcode_args['map_type'] ),
            'map_info'          => esc_attr( $shortcode_args['map_info'] ),
            'map_zoom'          => esc_attr( $shortcode_args['map_zoom'] ),
            'map_info_width'    => esc_attr( $shortcode_args['map_info_width'] ),
            'map_info_height'   => esc_attr( $shortcode_args['map_info_height'] ),
            'map_show_marker'   => esc_attr( $shortcode_args['map_show_marker'] ),
            'map_controls'      => esc_attr( $shortcode_args['map_controls'] ),
            'map_draggable'     => esc_attr( $shortcode_args['map_draggable'] ),
            'map_scrollwheel'   => esc_attr( $shortcode_args['map_scrollwheel'] ),
            'map_color'         => esc_attr( $shortcode_args['map_color'] ),
            'marker_image'      => esc_attr( $shortcode_args['marker_image'] ),
            'map_dynmaic_no'    => esc_attr( $map_dynmaic_no ),
        );

        // Enqueueing Scripts for Map
        wp_enqueue_script($this->simple_event_planner . '-google-api');
        wp_enqueue_script($this->simple_event_planner . '-jquery-map');
        wp_localize_script($this->simple_event_planner . '-jquery-map', 'event_map', $map_data);
        
        // Event Map
        $html = '<div class="cs-map-section">';  
        
        // Map Title
        if ($shortcode_args['map_title'] <> '') {
            $html.='<div class="title_section">
              <h2>' . esc_attr( $shortcode_args['map_title'] ) . '</h2>
              </div><div class="clearfix"></div>';
        }
        
        $html .= '<div class="cs-map-' . $map_dynmaic_no . '">';
        $html .= '<div class="mapcode iframe mapsection gmapwrapp" id="map_canvas' . $map_dynmaic_no . '" style="height:' . esc_attr ( $shortcode_args['map_height'] ) . 'px;"> </div>';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }
    
}