<?php
if ( !defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
/**
 * Simple_Event_Planner_Settings_Api_Key Class
 *
 * This is used to define api key settings.
 * This class containing API key settings to use Gmap.
 * 
 * @link        https://wordpress.org/plugins/simple-event-planner/
 * @since       1.1.0
 * 
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/admin/settings
 * @author      PressTigers <support@presstigers.com>
 */

class Simple_Event_Planner_Settings_Api_Key {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since   1.1.0
	 */
	public function __construct() {

		// Filter -> Add Settings Api Key Tab
		add_filter( 'sep_settings_tab_menus', array( $this, 'sep_add_settings_tab' ), 40 );

		// Hook - Add GMAP Api Key Settings Section
		add_action( 'sep_api_key_settings', array( $this, 'sep_add_settings_section' ) );
	}

	/**
	 * Add GMAP API Key Settings Tab.
	 *
	 * @since    1.1.0
	 * 
	 * @param    array  $tabs  Settings Tab
	 * @return   array  $tabs  Merge array of Settings Tab with Api Key Tab.
	 */
	public function sep_add_settings_tab( $tabs ) {
		$tabs['api-key'] = esc_html__( 'GMap API Key', 'simple-event-planner' );
		return $tabs;
	}

	/**
	 * GMap Api Key Settings Section.
	 *
	 * @since    1.1.0
	 *
	 * @global   Object $post               Post Object
	 * @global   array  $sep_event_options  Event Options Data for Settings.
	 */
	public function sep_add_settings_section() {
		global $post, $sep_event_options;
		$sep_event_options = get_option( 'sep_event_options' );
		?>

		<!-- API Key Settings Header -->
		<div class="theme-header">
			<h1><?php esc_html_e( 'GMap API Key', 'simple-event-planner' ); ?></h1>
		</div>

		<!-- API Key Settings Section -->
		<ul class="form-elements">
			<li class="field-label">
				<label><?php esc_html_e( 'GMap API Key', 'simple-event-planner' ); ?></label>
			</li>
		</ul>
		<ul class="form-elements">
			<li class="field-label">
				<label><?php esc_html_e( 'API Key', 'simple-event-planner' ); ?></label>
			</li>
			<li class="element-field">
				<input type="text" id="event-organiser" name="sep_event_gmap_key" value="<?php echo isset( $sep_event_options['sep_event_gmap_key'] ) ? esc_attr( $sep_event_options['sep_event_gmap_key'] ) : ''; ?>">
				<label><?php esc_html_e( 'API Key', 'simple-event-planner' ); ?></label>
			</li>
		</ul>
		<div class="clear"></div>
		<?php
	}

}
