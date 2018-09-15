<?php
/**
 * Simple_Event_Planner_i18n Class
 * 
 * Define the internationalization functionality. Loads and defines the 
 * internationalization files for this plugin so that it is ready for translation.
 *
 * @link       https://wordpress.org/plugins/simple-event-planner/
 * @since      1.0.0
 * 
 * @package    Simple_Event_Planner
 * @subpackage Simple_Event_Planner/includes
 * @author     PressTigers <support@presstigers.com>
 */
class Simple_Event_Planner_i18n {

	/**
	 * The domain specified for this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $domain    The domain identifier for this plugin.
	 */
	private $domain;

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
				$this->domain, FALSE, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}

	/**
	 * Set the domain equal to that of the specified domain.
	 *
	 * @since    1.0.0
	 * @param    string    $domain    The domain that represents the locale of this plugin.
	 */
	public function set_domain( $domain ) {
		$this->domain = $domain;
	}

}