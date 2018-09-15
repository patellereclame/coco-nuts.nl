<?php if (!defined('ABSPATH')) { exit; } // Exit if accessed directly
/**
 * Simple_Event_Planner_Visual_Layout Class
 *
 * This is used for Event Visual Settings.
 * 
 * @link        https://wordpress.org/plugins/simple-event-planner/
 * @since       1.4.0
 * 
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/admin/settings
 * @author      PressTigers <support@presstigers.com>
 */
class Simple_Event_Planner_Visual_Layout {

    /**
     * Initialize the class and set its properties.
     *
     * @since   1.4.0
     */
    public function __construct() {

        // Filter -> Add Visual Layout Settings Tab
        add_filter('sep_settings_tab_menus', array($this, 'sep_add_visual_layout_tab'), 40);

        // Hook -> Add Visual Layout Settings Section
        add_action('sep_visual_layout', array($this, 'sep_add_visual_layout_section'));
    }

    /**
     * Add Visual Layout Settings Tab.
     *
     * @since   1.4.0
     * 
     * @param   array  $tabs  Settings Tab
     * @return  array  $tabs  Merge array of Settings Tab with Visual Layout Key Tab.
     */
    public function sep_add_visual_layout_tab($tabs) {
        $tabs['visual-layout'] = esc_html__('Visual Layout', 'simple-event-planner');
        return $tabs;
    }

    /**
     * Visual Layout Settings Section.
     *
     * @since   1.4.0
     *
     * @global  Object $post    Post Object
     * @global  array  $sep_event_options  Event Options Data for Settings.
     */
    public function sep_add_visual_layout_section() {
        global $post, $sep_event_options;
        $sep_event_options = get_option('sep_event_options');
        wp_enqueue_script('simple-event-planner' . '-rubaxa-script');
        ?>

        <!-- Visual Layout Settings Header -->
        <div class="theme-header">
            <h1> <?php esc_html_e('Visual Layout', 'simple-event-planner'); ?></h1>
        </div>
        <!-- Visual Layout Settings Section -->
        <div class="visual-layout-container">
            <div class="visual-layout-section-1">
                <div class="vl-column-title">
                    <?php echo __('Left Column','simple-event-planner');?>                    
                </div>
                <ul id="vl-col-one" class="visual-layout-list visual-layout-list-items">
                    <span class="drag-pos"><?php echo __('Drop Elements Here...','simple-event-planner');?></span>
                    <?php
                    //Default Values
                    $default1 = 'event_date,event_details,event_schedule,event_segments';

                    if (!empty($sep_event_options['sep_event_map'])) {
                        $event_map = $sep_event_options['sep_event_map'];
                        if ('map-left' == $event_map) {
                            $default1 = $default1 . ',' . 'event_venue';
                        }
                        $visual_layout1 = isset($sep_event_options['sep_event_layout_col2']) ? esc_attr($sep_event_options['sep_event_layout_col2']) : $default1;
                    } else {
                        $visual_layout1 = isset($sep_event_options['sep_event_layout_col2']) ? esc_attr($sep_event_options['sep_event_layout_col2']) : 'event_title,event_image,event_description,event_venue';
                    }
                    $event_col1 = explode(',', $visual_layout1);

                    foreach ($event_col1 as $value) {
                        if (!empty($value)) {
                            ?><li data-id="<?php echo $value; ?>" class="item default-item-1">
                                <span><?php echo ucwords(str_replace('_', ' ', $value)); ?></span>
                            </li><?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <input type="text" hidden="" name="sep_event_layout_col2" value="<?php echo isset($sep_event_options['sep_event_layout_col2']) ? esc_attr($sep_event_options['sep_event_layout_col2']) : 'event_title,event_image,event_description,event_venue'; ?>" class="visuaplayoutCol02">
            <div class="visual-layout-section-2">
                <div class="vl-column-title">
                    <?php echo __('Right Column','simple-event-planner');?>                                    
                </div>
                <ul id="vl-col-two" class="visual-layout-list visual-layout-list-items">
                    <span class="drag-pos"><?php echo __('Drop Elements Here...','simple-event-planner');?></span>    
                    <?php
                    //Default Values
                    $default2 = 'event_title,event_image,event_description';

                    //Managing Event Map Data Legacy For SEP Old Version
                    if (!empty($sep_event_options['sep_event_map'])) {
                        if ('map-right' == $event_map) {
                            $default2 = $default2 . ',' . 'event_venue';
                        }
                        $visual_layout2 = isset($sep_event_options['sep_event_layout_col1']) ? esc_attr($sep_event_options['sep_event_layout_col1']) : $default2;
                    } else {
                        $visual_layout2 = isset($sep_event_options['sep_event_layout_col1']) ? esc_attr($sep_event_options['sep_event_layout_col1']) : 'event_date,event_details,event_schedule,event_segments';
                    }

                    $event_col2 = explode(',', $visual_layout2);

                    foreach ($event_col2 as $value) {
                        if (!empty($value)) {
                            ?><li data-id="<?php echo $value; ?>" class="item default-item-2">
                                <span><?php echo ucwords(str_replace('_', ' ', $value)); ?></span>
                            </li><?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <input type="text" hidden="" name="sep_event_layout_col1" value="<?php echo isset($sep_event_options['sep_event_layout_col1']) ? esc_attr($sep_event_options['sep_event_layout_col1']) : 'event_date,event_details,event_schedule,event_segments'; ?>" class="visuaplayoutCol01">
        </div>
        <div class="reset-style">
            <input type="button" id="reset-vl" value="Reset Options">
        </div>
        <div class="clear"></div>
        <?php
    }
}