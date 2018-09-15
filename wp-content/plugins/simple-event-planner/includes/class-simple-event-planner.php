<?php

/**
 * The core plugin class.The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin
 * 
 * @link       https://wordpress.org/plugins/simple-event-planner/
 * @since      1.0.0
 *
 * @package    Simple_Event_Planner
 * @subpackage Simple_Event_Planner/includes
 * @author     PressTigers <support@presstigers.com>
 */
class Simple_Event_Planner {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Simple_Event_Planner_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $simple_event_planner    The string used to uniquely identify this plugin.
	 */
	protected $simple_event_planner;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * The directory path of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $event_planner_directory  The directory path of the plugin.
	 */
	protected $event_planner_directory;

	/**
	 * The url of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $event_planner_url The url of the plugin.
	 */
	protected $event_planner_url;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->simple_event_planner = 'simple-event-planner';
		$this->version = '1.4.0';
		$this->event_planner_directory = untrailingslashit( plugin_dir_path( __FILE__ ) );
		$this->event_planner_url = untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) );

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_shortcodes();
		$this->start_session();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Simple_Event_Planner_Loader. Orchestrates the hooks of the plugin.
	 * - Simple_Event_Planner_i18n. Defines internationalization functionality.
	 * - Simple_Event_Planner_Admin. Defines all hooks for the admin area.
	 * - Simple_Event_Planner_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-simple-event-planner-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-simple-event-planner-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-simple-event-planner-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-simple-event-planner-public.php';

		/**
		 * The class responsible for defining all post types of the plugin
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-simple-event-planner-post-type-event-listing.php';

		/**
		 * The class responsible for defining all shortcodes of the plugin
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-simple-event-planner-shortcodes-init.php';

		/**
		 * The file is responsible for all event planner ajax calls i.e. saving 
		 * the calender settings/options and keyword search.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-simple-event-planner-ajax.php';

		$this->loader = new Simple_Event_Planner_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Simple_Event_Planner_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {
		$plugin_i18n = new Simple_Event_Planner_i18n();
		$plugin_i18n->set_domain( $this->get_simple_event_planner() );
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$plugin_admin = new Simple_Event_Planner_Admin( $this->get_simple_event_planner(), $this->get_version() );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {
		$plugin_public = new Simple_Event_Planner_Public( $this->get_simple_event_planner(), $this->get_version() );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
	}

	/**
	 * Register all of the Shortcode related to the events
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_shortcodes() {
		new Simple_Event_Planner_Shortcodes_Init( $this->get_simple_event_planner(), $this->get_version() );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_simple_event_planner() {
		return $this->simple_event_planner;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Simple_Event_Planner_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Retrieve the directory path of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The directory path of the plugin.
	 */
	public function get_event_planner_directory() {
		return $this->event_planner_directory;
	}

	/**
	 * Retrieve the url of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The url of the plugin.
	 */
	public function get_event_planner_url() {
		return $this->event_planner_url;
	}

	public function start_session() {
		if ( !session_id() ) {
			session_start();
		}
	}

}
