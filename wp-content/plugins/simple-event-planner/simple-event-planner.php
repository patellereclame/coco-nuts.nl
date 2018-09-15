<?php
/**
 * The plugin bootstrap file
 *
 * This file includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.presstigers.com
 * @since             1.0.0
 * @package           Simple_Event_Planner
 *
 * @wordpress-plugin
 * Plugin Name:       Simple Event Planner
 * Plugin URI:        http://www.presstigers.com
 * Description:       A powerful & flexible plugin to create event listing and event calendar on your website in simple & elegant way.
 * Version:           1.4.0
 * Author:            PressTigers
 * Author URI:        http://www.presstigers.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       simple-event-planner
 * Domain Path:       /languages
 */
// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
	die;
}

/**
 *  Add SEP Upgrade Notification
 */
function sep_showUpgradeNotification( $currentPluginMetadata, $newPluginMetadata ) {
	// check "upgrade_notice"
	if ( isset( $newPluginMetadata->upgrade_notice ) && strlen( trim( $newPluginMetadata->upgrade_notice ) ) > 0 ) {
		echo '<div style="background-color: #d54e21; padding: 10px; color: #f9f9f9; margin-top: 10px"><strong>Important Upgrade Notice:</strong> ' . esc_html( $newPluginMetadata->upgrade_notice ) . '</div>';
	}
}

add_action( 'in_plugin_update_message-simple-event-planner/simple-event-planner.php', 'sep_showUpgradeNotification', 10, 2 );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-simple-event-planner-activator.php
 */
function activate_simple_event_planner() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-simple-event-planner-activator.php';
	Simple_Event_Planner_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-simple-event-planner-deactivator.php
 */
function deactivate_simple_event_planner() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-simple-event-planner-deactivator.php';
	Simple_Event_Planner_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_simple_event_planner' );
register_deactivation_hook( __FILE__, 'deactivate_simple_event_planner' );

/**
 * Define constants  */
define( 'SIMPLE_EVENT_PLANNER_PLUGIN_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'SIMPLE_EVENT_PLANNER_PLUGIN_URL', untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) ) );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-simple-event-planner.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_simple_event_planner() {

	$plugin = new Simple_Event_Planner();
	$plugin->run();
}

run_simple_event_planner();