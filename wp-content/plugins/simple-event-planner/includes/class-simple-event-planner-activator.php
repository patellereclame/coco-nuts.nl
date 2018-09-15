<?php
if ( !defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
/**
 * Fired during plugin activation
 *
 * This class defines all code necessary to run during the plugin's activation.
 * 
 * @link       https://wordpress.org/plugins/simple-event-planner/
 * @since      1.0.0
 * 
 * @package    Simple_Event_Planner
 * @subpackage Simple_Event_Planner/includes
 * @author     PressTigers <support@presstigers.com>
 */

class Simple_Event_Planner_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.4.0
	 */
	public static function activate() {

		global $sep_event_options;

		// Default Admin Settings
		$sep_defaults_options = array(
			'event_primary_color' => '#3399fe',
			'event_secondary_color' => '#f7f7f7',
			'event_title_color' => '#363e40',
			'event_content_color' => '#ababab',
			'sep_event_layout' => 'list-view',
			'sep_event_content' => 'show-image',
			'sep_time_format' => '24-hours',
			'sep_date_format' => 'F j, Y',
			'sep_event_layout_col2' => 'event_date,event_details,event_schedule,event_segments',
			'sep_event_layout_col1' => 'event_title,event_image,event_description,event_venue',
			'sep_container_class' => 'sep sep-container',
		);
		add_option( 'sep_event_options', $sep_defaults_options );
	}

}