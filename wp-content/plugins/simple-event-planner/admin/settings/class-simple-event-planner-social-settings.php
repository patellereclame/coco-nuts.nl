<?php
if ( !defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
/**
 * Simple_Event_Planner_Social_Settings Class
 *
 * This is used to Facebook social settings.
 * 
 * @link        https://wordpress.org/plugins/simple-event-planner/
 * @since       1.4.0
 * 
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/admin/settings
 * @author      PressTigers <support@presstigers.com>
 */

class Simple_Event_Planner_Social_Settings {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since   1.4.0
	 */
	public function __construct() {

		// Filter -> Add Appearance Settings Tab
		add_filter( 'sep_settings_tab_menus', array( $this, 'sep_add_social_settings_tab' ), 40 );

		// Hook -> Add Appearance Settings Section
		add_action( 'sep_social_settings', array( $this, 'sep_add_social_settings_section' ) );
	}

	/**
	 * Add Social Settings Tab.
	 *
	 * @since   1.4.0
	 * 
	 * @param   array  $tabs  Settings Tab
	 * @return  array  $tabs  Merge array of Settings Tab with Appearance Key Tab.
	 */
	public function sep_add_social_settings_tab( $tabs ) {
		$tabs['social'] = esc_html__( 'Social Settings', 'simple-event-planner' );
		return $tabs;
	}

	/**
	 * Social Settings Section.
	 *
	 * @since   1.4.0
	 *
	 * @global  Object $post    Post Object
	 * @global  array  $sep_event_options  Event Options Data for Settings.
	 */
	public function sep_add_social_settings_section() {
		global $post, $sep_event_options;
		?>

		<!-- Social Settings Header -->
		<div class="theme-header">
			<h1> <?php esc_html_e( 'Social Settings', 'simple-event-planner' ); ?></h1>
		</div>
		<ul class="form-elements">
			<li class="field-label">
				<label><span class="section-heading"><?php esc_html_e( 'Facebooks API Settings', 'simple-event-planner' ); ?></span></label>
			</li>
		</ul>

		<!-- API Key Settings Section -->
		<ul class="form-elements">
			<li class="field-label">
				<label><?php esc_html_e( 'Facebook App ID', 'simple-event-planner' ); ?></label>
			</li>
			<li class="element-field">
				<input type="text" id="event-organiser" name="sep_app_id" value="<?php echo isset( $sep_event_options['sep_app_id'] ) ? esc_attr( $sep_event_options['sep_app_id'] ) : ''; ?>">
				<label><?php esc_html_e( 'Facebook App ID', 'simple-event-planner' ); ?></label>
			</li>
		</ul>

		<!-- App Secret ID Section -->
		<ul class="form-elements">
			<li class="field-label">
				<label><?php esc_html_e( 'Facebook  App Secret ID', 'simple-event-planner' ); ?></label>
			</li>
			<li class="element-field">
				<input type="text" id="event-organiser" name="sep_app_sec_id" value="<?php echo isset( $sep_event_options['sep_app_sec_id'] ) ? esc_attr( $sep_event_options['sep_app_sec_id'] ) : ''; ?>">
				<label><?php esc_html_e( 'Facebook  App Secret ID', 'simple-event-planner' ); ?></label>
			</li>
		</ul>

		<!-- Facebook Page ID -->
		<ul class="form-elements">
			<li class="field-label">
				<label><?php esc_html_e( 'Facebook Page ID', 'simple-event-planner' ); ?></label>
			</li>
			<li class="element-field">
				<input type="text" id="event-organiser" name="sep_fb_app_id" value="<?php echo isset( $sep_event_options['sep_fb_app_id'] ) ? esc_attr( $sep_event_options['sep_fb_app_id'] ) : ''; ?>">
				<label><?php esc_html_e( 'Facebook  Page ID', 'simple-event-planner' ); ?></label>
			</li>
		</ul>
		<div class="clear"></div>
		<?php
	}

}