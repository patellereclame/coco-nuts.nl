<?php
if ( !defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
/**
 * Simple_Event_Planner_Shortcodes_Init Class
 *
 * This file contains shortcodes of event planner.
 * This class used to include shortcode files of event planner plugin.
 * 
 * @link        https://wordpress.org/plugins/simple-event-planner/
 * @since       1.0.0
 * @since       1.4.0 Added Facebook events shortcode
 * 
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/includes
 * @author      PressTigers <support@presstigers.com>
 */

class Simple_Event_Planner_Shortcodes_Init {

	/**
	 * The ID of this plugin.
	 *
	 * @since   1.0.0
	 * @access  private
	 * @var     string    $simple_event_planner the ID of this plugin.
	 */
	private $simple_event_planner;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string    $simple_event_planner       The name of the plugin.
	 * @param    string    $version    The version of this plugin.
	 */
	public function __construct( $simple_event_planner, $version ) {
		$this->simple_event_planner = $simple_event_planner;
		$this->version = $version;

		// Calling Event Listing Shortcode File
		require_once plugin_dir_path( __FILE__ ) . '/shortcodes/class-simple-event-planner-shortcode-event-listing.php';

		// Check if Event Listing Shortcode Class Exists
		if ( class_exists( 'Simple_Event_Planner_Shortcode_Event_Listing' ) ) {
			new Simple_Event_Planner_Shortcode_Event_Listing();
		}

		/* Calling Event Calendar Shortcode File */
		require_once plugin_dir_path( __FILE__ ) . '/shortcodes/class-simple-event-planner-shortcode-event-calendar.php';

		// Check if Calendar Shortcode Class Exists
		if ( class_exists( 'Simple_Event_Planner_Shortcode_Event_Calendar' ) ) {
			new Simple_Event_Planner_Shortcode_Event_Calendar( $this->simple_event_planner, $this->version );
		}

		/* Calling Event Map Shortcode File */
		require_once plugin_dir_path( __FILE__ ) . '/shortcodes/class-simple-event-planner-shortcode-event-map.php';

		// Check if Event Map Shortcode Class Exists
		if ( class_exists( 'Simple_Event_Planner_Shortcode_Event_Map' ) ) {
			new Simple_Event_Planner_Shortcode_Event_Map( $this->simple_event_planner, $this->version );
		}

		/* Calling Facebook Events Shortcode File */
		require_once plugin_dir_path( __FILE__ ) . '/shortcodes/class-simple-event-planner-shortcode-facebook-events.php';

		// Check if Facebook Event Shortcode Class Exists
		if ( class_exists( 'Simple_Event_Planner_Shortcode_Facebook_Events' ) ) {
			new Simple_Event_Planner_Shortcode_Facebook_Events( $this->simple_event_planner, $this->version );
		}
	}

}