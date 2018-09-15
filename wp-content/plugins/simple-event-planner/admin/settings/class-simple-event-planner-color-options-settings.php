<?php
if ( !defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
/**
 * Simple_Event_Planner_General_Settings Class
 *
 * This class contains general typogrphy settings for front-end. 
 * 
 * @link        https://wordpress.org/plugins/simple-event-planner/
 * @since       1.2.0
 * 
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/admin/settings
 * @author      PressTigers <support@presstigers.com>
 */

class Simple_Event_Planner_Color_Options_Settings {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since   1.2.0
	 */
	public function __construct() {

		// Filter -> Add General Settings Tab
		add_filter( 'sep_settings_tab_menus', array( $this, 'sep_add_general_settings_tab' ), 20 );

		// Hook -> Add General Settings Section 
		add_action( 'sep_general_settings', array( $this, 'sep_add_general_settings_section' ) );
	}

	/**
	 * Add General Settings Tab.
	 *
	 * @since    1.2.0
	 * 
	 * @param    array  $tabs  Settings Tab
	 * @return   array  $tabs  Merge array of Settings with General Tab.
	 */
	public function sep_add_general_settings_tab( $tabs ) {
		$tabs['color-options'] = __( 'Color Options', 'simple-event-planner' );
		return $tabs;
	}

	/**
	 * General Settings Section.
	 * 
	 * @since    1.2.0
	 * 
	 * @global   Object   $post               Post Object
	 * @global   array    $sep_event_options  WP options Settings for Event Planner. 
	 */
	public function sep_add_general_settings_section() {
		global $post, $sep_event_options;
		$sep_event_options = get_option( 'sep_event_options' );

		// Enqueue Alpha Color Picker Script
		wp_enqueue_script( 'wp-color-picker-alpha' );
		?>

		<!-- General Settings Header -->
		<div class="theme-header">
			<h1><?php esc_html_e( 'Color Options', 'simple-event-planner' ); ?></h1>
		</div>

		<!-- General Settings Section --> 
		<ul class="form-elements">
			<li class="field-label">
				<label><?php esc_html_e( 'Primary', 'simple-event-planner' ); ?></label>
			</li>
			<li class="element-field">
				<input type="text" value="<?php echo isset( $sep_event_options['event_primary_color'] ) ? esc_attr( $sep_event_options['event_primary_color'] ) : '#3399fe'; ?>" name="event_primary_color" class="sep-color-picker" data-alpha="true" data-default-color="#3399fe">
				<label><?php esc_html_e( 'Primary', 'simple-event-planner' ); ?></label>
			</li>
		</ul>
		<ul class="form-elements">
			<li class="field-label">
				<label><?php esc_html_e( 'Secondary', 'simple-event-planner' ); ?></label>
			</li>
			<li class="element-field">
				<input type="text" value="<?php echo isset( $sep_event_options['event_secondary_color'] ) ? esc_attr( $sep_event_options['event_secondary_color'] ) : '#f7f7f7'; ?>" name="event_secondary_color" class="sep-color-picker"  data-alpha="true" data-default-color="#f7f7f7">
				<label><?php esc_html_e( 'Secondary', 'simple-event-planner' ); ?></label>
			</li>
		</ul>
		<ul class="form-elements">
			<li class="field-label">
				<label><?php esc_html_e( 'Title', 'simple-event-planner' ); ?></label>
			</li>
			<li class="element-field">
				<input type="text" value="<?php echo isset( $sep_event_options['event_title_color'] ) ? esc_attr( $sep_event_options['event_title_color'] ) : '#363e40'; ?>" name="event_title_color" class="sep-color-picker" data-alpha="true" data-default-color="#363e40">
				<label><?php esc_html_e( 'Title', 'simple-event-planner' ); ?></label>
			</li>
		</ul>
		<ul class="form-elements">
			<li class="field-label">
				<label><?php esc_html_e( 'Content', 'simple-event-planner' ); ?></label>
			</li>
			<li class="element-field">
				<input type="text" value="<?php echo isset( $sep_event_options['event_content_color'] ) ? esc_attr( $sep_event_options['event_content_color'] ) : '#ababab'; ?>" name="event_content_color" class="sep-color-picker" data-alpha="true" data-default-color="#ababab">
				<label><?php esc_html_e( 'Content', 'simple-event-planner' ); ?></label>
			</li>
		</ul>
		<div class="clear"></div> 

		<?php
	}

}