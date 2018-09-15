<?php
if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly
/**
 * Simple_Event_Planner_Settings_Init Class
 * 
 * This is used to includes admin settings for:
 *
 * - General Settings.
 * - GMAP API Key Settings.
 * - Appearance Settings. 
 * - Social Settings. 
 * 
 * @link        https://wordpress.org/plugins/simple-event-planner/
 * @since       1.1.0
 * @since       1.4.0 Added social settings tab
 * 
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/includes
 * @author      PressTigers <support@presstigers.com>
 */

class Simple_Event_Planner_Settings_Init {

    /**
     * Initialize the class and set its properties.
     *
     * @since   1.1.0
     */
    public function __construct() {

        /**
         * Calling file containing functionalty of general settings.
         */
        require_once plugin_dir_path(__FILE__) . '/settings/class-simple-event-planner-color-options-settings.php';

        // Check if General Settings Class Exists
        if (class_exists('Simple_Event_Planner_Color_Options_Settings')) {

            // Initialize General Settings Object  
            new Simple_Event_Planner_Color_Options_Settings();
        }

        /**
         * Calling file containing functionalty of Gmap API key settings.
         */
        require_once plugin_dir_path(__FILE__) . '/settings/class-simple-event-planner-settings-api-key.php';

        // Check if Event Calendar Settings Class Exists
        if (class_exists('Simple_Event_Planner_Settings_Api_Key')) {

            // Initialize Event Calendar Settings Object  
            new Simple_Event_Planner_Settings_Api_Key();
        }

        /**
         * Calling file containing functionalty of Appearnce settings.
         */
        require_once plugin_dir_path(__FILE__) . '/settings/class-simple-event-planner-template-settings.php';

        // Check if Event Appearnce Settings Class Exists
        if (class_exists('Simple_Event_Planner_Appearance_Settings')) {

            // Initialize Event Appearnce Settings Object  
            new Simple_Event_Planner_Appearance_Settings();
        }

        /**
         * Calling file containing functionalty of social settings.
         */
        require_once plugin_dir_path(__FILE__) . '/settings/class-simple-event-planner-social-settings.php';
        if (class_exists('Simple_Event_Planner_Social_Settings')) {

            // Initialize Event Social Settings Object  
            new Simple_Event_Planner_Social_Settings();
        }

        /**
         * Calling file containing functionalty of Visual Layout.
         */
        require_once plugin_dir_path(__FILE__) . '/settings/class-simple-event-planner-visual-layout.php';
        if (class_exists('Simple_Event_Planner_Visual_Layout')) {

            // Initialize Event Visual Layout Object  
            new Simple_Event_Planner_Visual_Layout();
        }

        // Hook -> Add Settings Menu
        add_action('admin_menu', array($this, 'admin_menu'));
    }

    /**
     * Event Planner Settings Page.
     *
     * @since     1.1.0
     * 
     * @return    void
     */
    public function admin_menu() {
        add_submenu_page('edit.php?post_type=event_listing', esc_html__('Settings', 'simple-event-planner'), esc_html__('Settings', 'simple-event-planner'), 'manage_options', 'event-planner-settings', array($this, 'sep_settings_tab_menu'));
    }

    /**
     * Settings tabs for event listing and calendar settings.
     * 
     * @since    1.1.0
     * 
     * @global   Object   $post               Post Object
     * @global   array    $sep_event_options  WP options Settings for Event Planner. 
     */
    public function sep_settings_tab_menu() {
        global $post, $sep_event_options;
        $sep_event_options = get_option('sep_event_options');
        $sep_version = new Simple_Event_Planner();
        wp_enqueue_script('simple-event-planner' . '-rubaxa-script');
        ?> 

        <!-- Event Planner Settings Form -->
        <div class="sep-wrap">

            <!-- Event Planner Settings Form -->
            <form id="optioin_frm" method="post" action="javascript:sep_event_option_save('<?php echo admin_url('admin-ajax.php'); ?>', '<?php echo get_template_directory_uri() ?>');">
                <div class="loading_div">
                    <div class="loading"><i class="fa fa-spin fa-spinner"></i></div>
                </div>
                <div class="sep-container-fluid pt-wrapper-bg">
                    <div class="sep-col-lg-2 sep-col-md-3 sep-col-sm-4 sep-col-xs-2" style="padding:0;">

                        <!-- Settings Saved Notification -->
                        <div class="form-msg"><?php esc_html_e('Setting have been saved.', 'simple-event-planner'); ?></div>

                        <!-- Settings Tabs -->
                        <div class="sep-sidebar">
                            <div class="branding">
                                <strong><?php esc_html_e('Simple Event Planner', 'simple-event-planner'); ?></strong><br/>
                                <?php echo $sep_version->get_version(); ?>
                            </div>
                            <div class="main-nav">
                                <ul class="sub-menu categoryitems" style="display:block">
                                    <?php
                                    /**
                                     * Filter the Settings Tab Menus. 
                                     * 
                                     * @since 1.1.0 
                                     * 
                                     * @param array (){
                                     *     @type array Tab ID => Settings Tab Name
                                     * }
                                     */
                                    $settings_tabs = apply_filters('sep_settings_tab_menus', array());
                                    $count = 1;
                                    foreach ($settings_tabs as $key => $tab_name) {
                                        $active_tab = ( 1 === $count ) ? 'active' : '';
                                        ?>
                                        <li class="<?php echo $active_tab ?>">
                                            <a href="#<?php echo sanitize_key($key); ?>-settings" onClick="toggleDiv(this.hash);
                                                                return false;">
                                                <?php if ('color-options' == $key) { ?>
                                                    <i class="fa fa-cog"></i><span><?php echo esc_attr($tab_name); ?></span>

                                                <?php } elseif ('api-key' == $key) { ?>
                                                    <i class="fa fa-map" aria-hidden="true"></i><span><?php echo esc_attr($tab_name); ?> </span>

                                                <?php } elseif ('template' == $key) { ?>
                                                    <i class="fa fa-columns" aria-hidden="true"></i><span><?php echo esc_attr($tab_name); ?></span>

                                                <?php } elseif ('social' == $key) { ?>
                                                    <i class="fa fa-share-alt" aria-hidden="true"></i><span><?php echo esc_attr($tab_name); ?></span>

                                                <?php } elseif ('visual-layout' == $key) { ?>
                                                    <i class="fa fa-th" aria-hidden="true"></i><span><?php echo esc_attr($tab_name); ?></span>
                                                <?php } ?>

                                            </a>
                                        </li>
                                        <?php
                                        $count++;
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="sep-col-lg-10 sep-col-md-9 sep-col-sm-8 sep-col-xs-10" style="padding: 0;">

                        <!-- Settings Sections -->
                        <div class="save-options">
                            <input type="submit" id="submit_btn" name="submit_btn" class="topbtn" value="<?php esc_html_e('Save Changes', 'simple-event-planner'); ?>">
                        </div>

                        <div class="main-content">
                            <!-- General Settings Sections -->
                            <div id="color-options-settings"><?php do_action('sep_general_settings'); ?></div>

                            <!-- GMap API Settings Sections -->
                            <div id="api-key-settings" style="display:none;"><?php do_action('sep_api_key_settings'); ?></div>

                            <!-- Appearance Settings Sections -->
                            <div id="template-settings" style="display:none;"><?php do_action('sep_appearance_settings'); ?></div>

                            <!-- Social Settings Sections -->
                            <div id="social-settings" style="display:none;"><?php do_action('sep_social_settings'); ?></div>

                            <!-- Visual Layout Sections -->
                            <div id="visual-layout-settings" style="display:none;"><?php do_action('sep_visual_layout'); ?></div>
                        </div>

                        <div class="save-options">
                            <input type="submit" id="submit_btn" name="submit_btn" class="topbtn" value="<?php esc_html_e('Save Changes', 'simple-event-planner'); ?>">
                        </div>

                        <div class="clear"></div>
                    </div>
                    <input type="hidden" name="action" value="sep_event_option_save">
                    <input type="hidden" name="sep_nonce" value="<?php echo wp_create_nonce('sep_security_nonce'); ?>">
                </div>
            </form>
        </div>
        <?php
    }
}

new Simple_Event_Planner_Settings_Init();