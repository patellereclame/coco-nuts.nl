<?php

/**
 * Simple_Event_Planner_Public Class
 * 
 * The public-facing functionality of the plugin. Defines the plugin name, version,
 * and two examples hooks for how to enqueue the admin-specific stylesheet and JavaScript.
 *
 * @link       https://wordpress.org/plugins/simple-event-planner/
 * @since      1.0.0
 *
 * @package    Simple_Event_Planner
 * @subpackage Simple_Event_Planner/public
 * @author     PressTigers <support@presstigers.com>
 */
class Simple_Event_Planner_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $simple_event_planner    The ID of this plugin.
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
	 * @since   1.0.0
	 * @param   string  $simple_event_planner   The name of the plugin.
	 * @param   string  $version                The version of this plugin.
	 */
	public function __construct( $simple_event_planner, $version ) {
		$this->simple_event_planner = $simple_event_planner;
		$this->version = $version;

		// Hook -> Includes template function
		add_action( 'after_setup_theme', array( $this, 'sep_template_functions' ), 11 );

		/**
		 * This file is responsible for the calender and event listing typography/css.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-simple-event-planner-typography.php';
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		// Enqueue Simple Event Planner Front-end Core CSS File
		wp_enqueue_style( $this->simple_event_planner . '-front-end', plugin_dir_url( __FILE__ ) . 'css/simple-event-planner-public.css', array(), '2.1.1', 'all', TRUE );

		// Enqueue Font Awesome Styles
		wp_enqueue_style( $this->simple_event_planner . '-font-awesome', plugin_dir_url( __FILE__ ) . 'css/font-awesome.min.css', array(), '4.7.0', 'all' );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since   1.0.0
	 */
	public function enqueue_scripts() {

		// Get Settings Map API Key 
		$sep_event_options = get_option( 'sep_event_options' );
		$api_key = (!empty( $sep_event_options['sep_event_gmap_key'] )) ? 'key=' . trim( $sep_event_options['sep_event_gmap_key'] ) . '&' : '';

		// Register Google APi Script
		wp_register_script( $this->simple_event_planner . '-google-api', 'https://maps.googleapis.com/maps/api/js?' . esc_attr( $api_key ) . 'v=3&libraries=places', '', '3.30', TRUE );

		// Register jQuery Map Script
		wp_register_script( $this->simple_event_planner . '-jquery-map', plugin_dir_url( __FILE__ ) . 'js/jquery-map.js', '', $this->version, TRUE );

		// Register Auto Geocomplete Script
		wp_register_script( $this->simple_event_planner . '-jquery-geocomplete', plugin_dir_url( __FILE__ ) . 'js/jquery.geocomplete.min.js', '', '1.6.5', TRUE );

		// Register jQuery Calendar Script
		wp_register_script( $this->simple_event_planner . '-jquery-event-calendar-min', plugin_dir_url( __FILE__ ) . 'js/jquery.eventCalendar.min.js', '', '0.68', TRUE );

		// Register jQuery Moment Script
		wp_register_script( $this->simple_event_planner . '-jquery-moment', plugin_dir_url( __FILE__ ) . 'js/moment.min.js', '', '2.10.6', TRUE );

		// Register jQuery Plugin Script
		wp_register_script( $this->simple_event_planner . '-jquery-plugin', plugin_dir_url( __FILE__ ) . 'js/jquery.plugin.min.js', '', '1.0.1', TRUE );

		// Register jQuery Countdown Script
		wp_register_script( $this->simple_event_planner . '-jquery-countdown', plugin_dir_url( __FILE__ ) . 'js/jquery.countdown.min.js', '', '2.0.2', TRUE );

		// Register Front-end Script
		wp_register_script( $this->simple_event_planner . '-frontend', plugin_dir_url( __FILE__ ) . 'js/simple-event-planner-public.js', array( 'jquery' ), $this->version, TRUE );

		// Register Calendar Callback Script
		wp_register_script( $this->simple_event_planner . '-calendar_callback', plugin_dir_url( __FILE__ ) . 'js/simple-event-planner-calendar-callback.js', array( 'jquery' ), $this->version, TRUE );

		// Localize Script For Translation
		wp_localize_script( $this->simple_event_planner . '-frontend', 'sep_views', array(
			'sep_counter' => array(
				'week' => __( 'W', 'simple-event-planner' ),
				'day' => __( 'D', 'simple-event-planner' ),
				'hours' => __( 'H', 'simple-event-planner' ),
				'minutes' => __( 'M', 'simple-event-planner' ),
				'seconds' => __( 'S', 'simple-event-planner' ),
			),
			'sep_calendar' => array(
				'events' => __( 'Events', 'simple-event-planner' ),
				'no_event' => __( 'No results found.', 'simple-event-planner' ),
				'month' => array(
					'jan' => __( 'January', 'simple-event-planner' ),
					'feb' => __( 'February', 'simple-event-planner' ),
					'mar' => __( 'March', 'simple-event-planner' ),
					'april' => __( 'April', 'simple-event-planner' ),
					'may' => __( 'May', 'simple-event-planner' ),
					'june' => __( 'June', 'simple-event-planner' ),
					'july' => __( 'July', 'simple-event-planner' ),
					'aug' => __( 'August', 'simple-event-planner' ),
					'sep' => __( 'September', 'simple-event-planner' ),
					'oct' => __( 'October', 'simple-event-planner' ),
					'nov' => __( 'November', 'simple-event-planner' ),
					'dec' => __( 'December', 'simple-event-planner' ),
				),
				'day' => array(
					'mon' => __( 'MON', 'simple-event-planner' ),
					'tue' => __( 'TUE', 'simple-event-planner' ),
					'wed' => __( 'WED', 'simple-event-planner' ),
					'thr' => __( 'THU', 'simple-event-planner' ),
					'fri' => __( 'FRI', 'simple-event-planner' ),
					'sat' => __( 'SAT', 'simple-event-planner' ),
					'sun' => __( 'SUN', 'simple-event-planner' ),
				),
			),
				)
		);
	}

	/**
	 * Load Evnet Planner Templates Functions
	 * 
	 * @since 1.1.0
	 */
	public function sep_template_functions() {
		include( 'partials/simple-event-planner-template-functions.php' );
		include( 'partials/simple-event-planner-facebook-functions.php' );
	}

}
