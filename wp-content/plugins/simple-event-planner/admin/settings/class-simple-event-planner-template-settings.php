<?php if (!defined('ABSPATH')) { exit; } // Exit if accessed directly
/**
 * Simple_Event_Planner_Appearance_Settings Class
 *
 * This is used to define event listing appearnce settings.
 * 
 * @link        https://wordpress.org/plugins/simple-event-planner/
 * @since       1.3.0
 * @since       1.4.0 Removed Google Map Section
 * @since       1.4.0 Added SEP Container Settings Section
 * 
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/admin/settings
 * @author      PressTigers <support@presstigers.com>
 */

class Simple_Event_Planner_Appearance_Settings {

    /**
     * Initialize the class and set its properties.
     *
     * @since   1.3.0
     */
    public function __construct() {

        // Filter -> Add Appearance Settings Tab
        add_filter('sep_settings_tab_menus', array($this, 'sep_add_settings_tab'), 40);

        // Hook -> Add Appearance Settings Section
        add_action('sep_appearance_settings', array($this, 'sep_add_appearance_settings_section'));
    }

    /**
     * Add Appearance Settings Tab.
     *
     * @since   1.3.0
     * 
     * @param   array  $tabs  Settings Tab
     * @return  array  $tabs  Merge array of Settings Tab with Appearance Key Tab.
     */
    public function sep_add_settings_tab($tabs) {
        $tabs['template'] = esc_html__('Template', 'simple-event-planner');
        return $tabs;
    }

    /**
     * Appearance Settings Section.
     *
     * @since   1.3.0
     *
     * @global  Object $post    Post Object
     * @global  array  $sep_event_options  Event Options Data for Settings.
     */
    public function sep_add_appearance_settings_section() {
        global $post, $sep_event_options;

        //Fetching Values 
        $list_layout = isset($sep_event_options['sep_event_layout']) ? $sep_event_options['sep_event_layout'] : '';
        $list_image = isset($sep_event_options['sep_event_content']) ? $sep_event_options['sep_event_content'] : '';
        $time_settings = isset($sep_event_options['sep_time_format']) ? $sep_event_options['sep_time_format'] : '';
        $date_settings = isset($sep_event_options['sep_date_format']) ? $sep_event_options['sep_date_format'] : '';

        // Get Container Id
        if (isset($sep_event_options['sep_container_id'])) {
            $container_ids = explode(" ", $sep_event_options['sep_container_id']);
            $sep_event_options['sep_container_id'] = $container_ids[0];
        } else {
            $sep_event_options['sep_container_id'] = 'container';
        }

        // Variable Declaration 
        $grid_view = $list_view = $show_image = $hide_image = $hours_12 = $hours_24 = $fjy = $ymd = $mdy = $dmy = $map_left = $map_right = '';

        // Check Event Listing Layout
        if ('list-view' === $list_layout) {
            $list_view = 'checked';
        } elseif ('grid-view' === $list_layout) {
            $grid_view = 'checked';
        } else {

            // Default List View
            $list_view = 'checked';
        }

        // Check Event Listing Image    
        if ('show-image' === $list_image) {
            $show_image = 'checked';
        } elseif ('hide-image' === $list_image) {
            $hide_image = 'checked';
        } else {

            // Default Show Image
            $show_image = 'checked';
        }

        // Check Time Format Settings
        if ('24-hours' === $time_settings) {
            $hours_24 = 'checked';
        } elseif ('12-hours' === $time_settings) {
            $hours_12 = 'checked';
        } else {

            // Default 24 Hours
            $hours_24 = 'checked';
        }

        // Check Date Format Settings
        if ('F j, Y' === $date_settings) {
            $fjy = 'checked';
        } elseif ('Y-m-d' === $date_settings) {
            $ymd = 'checked';
        } elseif ('m/d/Y' === $date_settings) {
            $mdy = 'checked';
        } elseif ('d/m/Y' === $date_settings) {
            $dmy = 'checked';
        } else {
            // Default 24 Hours
            $fjy = 'checked';
        }
        ?>

        <!-- Appearance Settings Header -->
        <div class="theme-header">
            <h1> <?php esc_html_e('Template', 'simple-event-planner'); ?></h1>
        </div>
        <ul class="form-elements">
            <li class="field-label">
                <label><span class="section-heading"><?php esc_html_e('Basic Template Settings', 'simple-event-planner'); ?></span></label>
            </li>
        </ul>

        <!-- Events Listing Layout -->
        <ul class="form-elements">
            <li class="field-label">
                <label><?php esc_html_e('Archive Event View', 'simple-event-planner'); ?></label>
            </li>
            <li class="element-field-radio">
                <input type="radio" name="sep_event_layout" value="list-view"<?php echo esc_attr($list_view); ?>><?php esc_html_e('List', 'simple-event-planner'); ?> 
            </li>
            <li class="element-field-radio">
                <input type="radio" name="sep_event_layout" value="grid-view"<?php echo esc_attr($grid_view); ?>><?php esc_html_e('Grid', 'simple-event-planner'); ?> 
            </li>
        </ul>

        <!-- Events Listing Featured Image -->
        <ul class="form-elements">
            <li class="field-label">
                <label><?php esc_html_e('Enable Image', 'simple-event-planner'); ?></label>
            </li>
            <li class="element-field-radio">
                <input type="radio" name="sep_event_content" value="show-image"<?php echo esc_attr($show_image); ?>><?php esc_html_e('Show', 'simple-event-planner'); ?> 
            </li>
            <li class="element-field-radio">
                <input type="radio" name="sep_event_content" value="hide-image"<?php echo esc_attr($hide_image); ?>><?php esc_html_e('Hide', 'simple-event-planner'); ?> 
            </li>
        </ul>
        <ul class="form-elements">
            <li class="field-label">
                <label> <span class="section-heading"><?php esc_html_e('Content Wrapper Styling', 'simple-event-planner'); ?></span></label>
            </li>
        </ul>
        <ul class="form-elements">
            <li class="field-label">
                <label><?php esc_html_e('SEP Container Class:', 'simple-event-planner'); ?></label>
            </li>
            <li class="element-field">
                <input type="text" id="container-class" name="sep_container_class" value="<?php echo isset($sep_event_options['sep_container_class']) ? esc_attr($sep_event_options['sep_container_class']) : 'container sep-container'; ?>">
                <label><?php _e('Add classes seprated by space or comma e.g. container sep-container or container,sep-container', 'simple-event-planner'); ?></label>
            </li>
        </ul>				
        <ul class="form-elements">
            <li class="field-label">
                <label><?php esc_html_e('SEP Container Id:', 'simple-event-planner'); ?></label>
            </li>
            <li class="element-field">               
                <input type="text" id="container-id" name="sep_container_id" value="<?php echo $sep_event_options['sep_container_id']; ?>" autocomplete="off" />
            </li>
        </ul>
        <ul class="form-elements">
            <li class="field-label">
                <label><span class="section-heading"><?php esc_html_e('Time Format Settings', 'simple-event-planner'); ?></span></label>
            </li>
        </ul>

        <!-- Events Time Format -->
        <ul class="form-elements">
            <li class="field-label">
                <label><?php esc_html_e('Time Format', 'simple-event-planner'); ?></label>
            </li>
            <li class="element-field-radio">
                <input type="radio" name="sep_time_format" value="24-hours"<?php echo esc_attr($hours_24); ?>><?php esc_html_e('24 Hours', 'simple-event-planner'); ?> 
            </li>
            <li class="element-field-radio">
                <input type="radio" name="sep_time_format" value="12-hours"<?php echo esc_attr($hours_12); ?>><?php esc_html_e('12 Hours', 'simple-event-planner'); ?> 
            </li>
        </ul>

        <!-- Date Format Settings -->
        <ul class="form-elements">
            <li class="field-label">
                <label><span class="section-heading"><?php esc_html_e('Date Format Settings', 'simple-event-planner'); ?></span></label>
            </li>
        </ul>

        <!-- Events Date Format -->
        <ul class="form-elements">
            <li class="field-label-date">
                <label><?php esc_html_e('Date Format', 'simple-event-planner'); ?></label>
            </li>
            <li class="element-field-date">
                <input type="radio" name="sep_date_format" value="Y-m-d"<?php echo esc_attr($ymd); ?>>  <?php echo esc_attr($format_two = date('Y-m-d', time())); ?> 
                <code>Y-m-d</code>
            </li>            
            <li class="element-field-date">
                <input type="radio" name="sep_date_format" value="m/d/Y"<?php echo esc_attr($mdy); ?>>  <?php echo esc_attr($format_three = date('m/d/Y', time())); ?>
                <code>m/d/Y</code>
            </li>
            <li class="element-field-date">
                <input type="radio" name="sep_date_format" value="d/m/Y"<?php echo esc_attr($dmy); ?>>  <?php echo esc_attr($format_one = date('d/m/Y', time())); ?> 
                <code>d/m/Y</code>
            </li>
            <li class="element-field-date">
                <input type="radio" name="sep_date_format" value="F j, Y"<?php echo esc_attr($fjy); ?>>  <?php echo esc_attr($format_four = date('F j,Y', time())); ?>
                <code>F j, Y</code>
            </li>
        </ul>
        <div class="clear"></div>
        <?php
    }
}