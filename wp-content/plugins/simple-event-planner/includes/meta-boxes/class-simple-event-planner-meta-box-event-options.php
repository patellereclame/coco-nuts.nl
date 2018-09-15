<?php
if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly
/**
 * Simple_Event_Planner_Meta_Box_Event_Options class
 *
 * This is used to define event options meta box.
 *
 * This meta box is designed to store:
 * 
 * - Event Options
 * - Location Options 
 * - Timezone Options 
 *
 * @link        https://wordpress.org/plugins/simple-event-planner/
 * @since       1.1.0
 * @since       1.4.0 Added Timezone Dropdown
 * 
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/admin/partials/meta-boxes
 * @author      PressTigers <support@presstigers.com>
 */

class Simple_Event_Planner_Meta_Box_Event_Options {

    /**
     * Event Options Meta box.
     * 
     * @since   1.1.0
     */
    public static function sep_meta_box_output() {
        global $post, $xml_object;

        // Add a nonce field so we can check for it later.
        wp_nonce_field('sep_event_meta_box', 'sep_event_meta_box_nonce');

        // Use get_post_meta() to retrieve an existing value
        $seg_array = get_post_meta($post->ID, 'add_segment', TRUE);
        $seg_array = unserialize($seg_array);
        $event_xml = get_post_meta($post->ID, 'event_meta', TRUE);

        if ('' !== $event_xml) {
            $xml_object = new SimpleXMLElement($event_xml);
            $start_date = isset($xml_object->start_date) ? $xml_object->start_date : '';
            $end_date = isset($xml_object->end_date) ? $xml_object->end_date : '';
            $start_time = isset($xml_object->start_time) ? $xml_object->start_time : '';
            $end_time = isset($xml_object->end_time) ? $xml_object->end_time : '';
            $timezone_string = isset($xml_object->timezone_string) ? $xml_object->timezone_string : sep_get_timezone();
            $event_organiser = isset($xml_object->event_organiser) ? $xml_object->event_organiser : '';
            $organiser_email = isset($xml_object->organiser_email) ? $xml_object->organiser_email : '';
            $organiser_contact = isset($xml_object->organiser_contact) ? $xml_object->organiser_contact : '';
            $event_date = isset($xml_object->event_date) ? $xml_object->event_date : '';
            $event_org = isset($xml_object->event_org) ? $xml_object->event_org : '';
            $event_email = isset($xml_object->event_email) ? $xml_object->event_email : '';
            $org_contact = isset($xml_object->org_contact) ? $xml_object->org_contact : '';
            $event_time = isset($xml_object->event_time) ? $xml_object->event_time : '';
            $event_segment = isset($xml_object->event_segment) ? $xml_object->event_segment : '';
            $location_map = isset($xml_object->location_map) ? $xml_object->location_map : '';
        } else {
            $start_date = $end_date = $start_time = $end_time = $event_address = $event_organiser = $organiser_email = $event_type = $organiser_contact = $event_date = $event_time = $timezone_string = $event_segment = $event_org = $event_email = $org_contact = $location_map = '';
            $current_offset = get_option('gmt_offset');
            $timezone_string = get_option('timezone_string');

            // Remove old Etc mappings. Fallback to gmt_offset.
            if (false !== strpos($timezone_string, 'Etc/GMT'))
                $timezone_string = '';

            if (empty($timezone_string)) { // Create a UTC+- zone if no timezone string exists
                if (0 == $current_offset)
                    $timezone_string = 'UTC+0';
                elseif ($current_offset < 0)
                    $timezone_string = 'UTC' . $current_offset;
                else
                    $timezone_string = 'UTC+' . $current_offset;
            }
        }
        ?>
        <!-- Event Options Meta Box -->
        <div class="page-elements c-post-<?php echo intval($post->ID); ?>">
            <div class="page-wrap">

                <!-- Event Planner Tabs-->
                <div class="vertical-tabs sep-wrap">
                    <div class="tab-options">
                        <ul>
                            <li class="active"><a id="tab-event-options"><i class="fa fa-hand-o-right"></i><?php esc_html_e('Event Options', 'simple-event-planner'); ?></a></li>                           
                            <li><a id="location-tab"><i class="fa fa-hand-o-right"></i><?php esc_html_e('Venue Address & Map', 'simple-event-planner'); ?></a></li>                    
                        </ul>
                    </div>
                    <div class="detail-tab">

                        <!-- Events Options-->
                        <div id="tab-event-options" style="display:block;">
                            <header class="tab-head">
                                <h5><?php esc_html_e('Event Options', 'simple-event-planner'); ?></h5>
                            </header>

                            <!-- Events Start and End Date-->
                            <ul class="form-elements">
                                <li class="field-label full-width">
                                    <input type="checkbox"   name="custom[event_date]"<?php echo esc_attr($event_date); ?>> 
                                    <label><?php esc_html_e("Don't show event date", 'simple-event-planner'); ?></label>
                                </li>
                                <li class="field-label">
                                    <label><?php esc_html_e('Event Date', 'simple-event-planner'); ?></label>
                                </li>
                                <li class="element-field">
                                    <div class="input-sec">
                                        <input type="text" id="to-date" class="date-picker" name="custom[start_date]" value="<?php echo esc_attr($start_date); ?>">
                                        <label class="label-small"><?php esc_html_e('Start Date', 'simple-event-planner'); ?></label>
                                    </div>
                                    <div class="input-sec">
                                        <input id="from-date" class="date-picker" type="text" name="custom[end_date]" value="<?php echo esc_attr($end_date); ?>">
                                        <label class="label-small"><?php esc_html_e('End Date', 'simple-event-planner'); ?></label>
                                    </div>
                                </li>
                            </ul>

                            <!-- Event Start and End Time -->
                            <ul class="form-elements">
                                <li class="field-label full-width">
                                    <input type="checkbox" name="custom[event_time]" <?php echo esc_attr($event_time); ?>> 
                                    <label><?php esc_html_e("Don't show event time", 'simple-event-planner'); ?></label> 
                                </li>
                                <li class="field-label">
                                    <label><?php esc_html_e('Event Time', 'simple-event-planner'); ?></label>
                                </li>
                                <li class="element-field">
                                    <div class="input-sec">
                                        <input id="to-time" class="time-picker" type="text" name="custom[start_time]" value="<?php echo esc_attr($start_time); ?>">
                                        <label class="label-small"><?php esc_html_e('Start Time', 'simple-event-planner'); ?></label>
                                    </div>
                                    <div class="input-sec">
                                        <input id="from-time" class="time-picker" type="text" name="custom[end_time]" value="<?php echo esc_attr($end_time); ?>">
                                        <label class="label-small"><?php esc_html_e('End Time', 'simple-event-planner'); ?></label>
                                    </div> 
                                    <div class="input-sec-timezone">
                                        <select class="sep-timezone-selecter" name="custom[timezone_string]"><?php echo wp_timezone_choice(esc_attr($timezone_string), get_user_locale()); ?></select>
                                        <label class="label-small"><?php esc_html_e('Timezone', 'simple-event-planner'); ?></label>
                                    </div>   
                                </li>
                            </ul>

                            <!-- Events Organizer -->
                            <ul class="form-elements">
                                <li class="field-label full-width">
                                    <input type="checkbox" name="custom[event_org]"<?php echo esc_attr($event_org); ?>>
                                    <label><?php esc_html_e("Don't show organizer name", 'simple-event-planner'); ?></label>
                                </li>
                                <li class="field-label">
                                    <label><?php esc_html_e('Organizer', 'simple-event-planner'); ?></label>
                                </li>
                                <li class="element-field">
                                    <input type="text" id="event-organiser" name="custom[event_organiser]" value="<?php echo esc_attr($event_organiser); ?>">
                                    <label class="label-small label-margin"><?php esc_html_e('Organizer of Event', 'simple-event-planner'); ?></label>
                                </li>
                            </ul>

                            <!-- Events Organizer Email -->
                            <ul class="form-elements">
                                <li class="field-label full-width">
                                    <input type="checkbox" name="custom[event_email]"<?php echo esc_attr($event_email); ?>>
                                    <label><?php esc_html_e("Don't show organizer email", 'simple-event-planner'); ?></label>
                                </li>
                                <li class="field-label">
                                    <label><?php esc_html_e('Email', 'simple-event-planner'); ?></label>
                                </li>
                                <li class="element-field">
                                    <input type="email" id="event-organiser-email" name="custom[organiser_email]" value="<?php echo esc_attr($organiser_email); ?>">
                                    <label class="label-small label-margin"><?php esc_html_e('Organizer Email', 'simple-event-planner'); ?></label>
                                    <span class="sep-invalid-email"><?php esc_html_e('A valid email address is required.', 'simple-event-planner'); ?></span>
                                </li>
                            </ul>

                            <!-- Events Contact -->
                            <ul class="form-elements">
                                <li class="field-label full-width">
                                    <input type="checkbox" name="custom[org_contact]"<?php echo esc_attr($org_contact); ?>>
                                    <label><?php esc_html_e("Don't show contact", 'simple-event-planner'); ?></label>
                                </li>
                                <li class="field-label">
                                    <label><?php esc_html_e('Phone Number', 'simple-event-planner'); ?></label>
                                </li>
                                <li class="element-field">
                                    <input type="tel" id="event-organiser-contact" name="custom[organiser_contact]" pattern="^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{1,4})[-. )]*(\d{1,4})[-. ]*(\d{1,4})(?: *x(\d+))?\s*$" title="<?php esc_html_e('A valid phone address is required.', 'simple-event-planner'); ?>" value="<?php echo esc_attr($organiser_contact); ?>">
                                    <label class="label-small label-margin"><?php esc_html_e('Phone Number', 'simple-event-planner'); ?></label>
                                    <span class="sep-invalid-phone"><?php esc_html_e('A valid phone address is required.', 'simple-event-planner'); ?></span>
                                </li>
                            </ul>

                            <!-- Event Segments !-->
                            <ul class="form-elements">
                                <li class="field-label full-width">
                                    <input type="checkbox" name="custom[event_segment]"<?php echo esc_attr($event_segment); ?>>
                                    <label><?php esc_html_e("Don't show event segments", 'simple-event-planner'); ?></label>
                                </li>
                                <li class="field-label">
                                    <label><?php esc_html_e('Add Segments', 'simple-event-planner'); ?></label>
                                </li>
                                <li class="element-field">
                                    <?php
                                    $segment_size = sizeof($seg_array);
                                    if (is_null($seg_array) && 0 == $segment_size) {
                                        ?>
                                        <div id="itemRows">
                                            <input type="text" name="custom[add_seg][]" value="" class="first-segment">
                                        </div>  
                                    <?php } if (1 == $segment_size) { ?>
                                        <div id="itemRows">
                                            <input type="text" name="custom[add_seg][]" value="<?php echo trim(esc_attr($seg_array[0])); ?>" class="first-segment">
                                        </div>  
                                        <?php
                                    } else {
                                        $row_count = 1;
                                        ?>                          
                                        <div id="itemRows"> 
                                            <?php foreach ($seg_array as $key => $value) { ?>
                                                <p id="rowNum<?php echo intval($row_count); ?>">
                                                    <input type="text" name="custom[add_seg][]"  value="<?php echo trim(esc_attr($value)); ?>">   
                                                    <input type="button" id="<?php echo intval($row_count); ?>" value="<?php esc_html_e('Remove', 'simple-event-planner'); ?>" onclick="removeRow('<?php echo intval($row_count); ?>');" class="button button-primary">
                                                </p>
                                                <?php
                                                $row_count++;
                                            }
                                            ?>
                                        </div>  
                                    <?php } ?>
                                    <input onclick="addRow('<?php echo esc_js('itemRows'); ?>');" type="button" value="<?php esc_html_e('Add more', 'simple-event-planner'); ?>" class="add-more-btn button button-primary">
                                </li>
                            </ul>
                            <input class="reset-button-primary" type="button" id="reset" value="<?php esc_html_e('Reset Options', 'simple-event-planner'); ?>">
                        </div> 

                        <!-- Location Map Options-->
                        <div id="location-tab" style="display:none;">
                            <div class="page-event-registration">
                                <header class="tab-head">
                                    <h5> <?php esc_html_e('Venue Address & Map', 'simple-event-planner'); ?></h5>
                                </header> 
                                <?php
                                // Enqueueing Scripts for Map 
                                wp_enqueue_script('simple-event-planner' . '-jquery-google-map-api');
                                global $post, $xml_object;
                                $loc_address = isset($xml_object->event_address) ? $xml_object->event_address : '';
                                $is_location_map = isset($xml_object->loc_map) ? $xml_object->loc_map : 'checked';
                                $loc_lat = isset($xml_object->loc_lat) ? $xml_object->loc_lat : '37.6';
                                $loc_long = isset($xml_object->loc_long) ? $xml_object->loc_long : '-95.665';
                                $loc_zoom = isset($xml_object->loc_zoom) ? $xml_object->loc_zoom : '6';
                                $event_loc = isset($xml_object->event_loc) ? $xml_object->event_loc : '';

                                // Check Map Visibility
                                $map_visibility = ('checked' == $is_location_map) ? 'none' : 'block';
                                ?>

                                <!-- Events Venue -->
                                <ul class="form-elements">
                                    <li class="field-label">
                                        <input type="checkbox" id="eve_location" name="custom[event_loc]"<?php echo esc_attr($event_loc); ?>>
                                        <label><?php esc_html_e("Don't Show venue", 'simple-event-planner'); ?></label>
                                    </li>
                                </ul>

                                <!-- Events Address -->
                                <ul class="form-elements">                            
                                    <li class="field-label">
                                        <label><?php esc_html_e('Address', 'simple-event-planner'); ?></label>
                                    </li>
                                    <li class="element-field">
                                        <input type="text" id="loc-address" name="event_address" value="<?php echo esc_attr($loc_address); ?>">
                                        <input type="hidden" id="loc-add" name="event-address" value="<?php echo esc_attr($loc_address); ?>">
                                        <label class="label-small label-margin"><?php esc_html_e('Enter Your Address', 'simple-event-planner'); ?></label>
                                    </li>
                                </ul>

                                <!-- Events Gmap -->
                                <ul class="form-elements">                            
                                    <li class="field-label">
                                        <input type="checkbox" id="location-map" name="loc_map" <?php echo esc_attr($is_location_map); ?>>
                                        <label><?php esc_html_e("Don't Show Map", 'simple-event-planner'); ?></label>
                                    </li>
                                </ul>
                                <div class="gllpLatlonPicker" style="display:<?php echo esc_attr($map_visibility); ?>"> 
                                    <div class="clear"></div>
                                    <input type="hidden" value="<?php echo esc_attr($loc_address); ?>" class="gllpSearchField">
                                    <input type="button" id="map-search-btn" class="gllpSearchButton button-primary" value="<?php esc_html_e("Search Map", 'simple-event-planner'); ?>">                            
                                    <br/><br/>
                                    <div id="event-map-convas" class="gllpMap"><?php esc_html_e('Google Maps', 'simple-event-planner'); ?></div>
                                    <div class="clear"></div>
                                    <input type="hidden" class="gllpLatitude" name="loc_lat" value="<?php echo esc_attr($loc_lat); ?>">
                                    <input type="hidden" class="gllpLongitude" name="loc_long" value="<?php echo esc_attr($loc_long); ?>">
                                    <input type="hidden" class="gllpZoom" name="loc_zoom" value="<?php echo esc_attr($loc_zoom); ?>">
                                </div>
                            </div>                            
                        </div>                
                        <input type="hidden" name="event_meta_form" value="1">
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Update Event Meta. 
     *
     * @since   1.0.0
     * 
     * @param   $post_id    Event post id 
     */
    public static function sep_save_event_listing_meta($post_id) {
        global $post;

        // Check Nonce Field
        if (!isset($_POST['sep_event_meta_box_nonce'])) {
            return;
        }

        // Verify that the nonce is valid.
        if (!wp_verify_nonce($_POST['sep_event_meta_box_nonce'], 'sep_event_meta_box')) {
            return;
        }

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        $sxe = new SimpleXMLElement('<simple_event_planner></simple_event_planner>');
        Simple_Event_Planner_Meta_Box_Event_Options::save_google_map($sxe, $post_id);

        // Checkbox for event date
        $_POST['custom']['event_date'] = (!empty($_POST['custom']['event_date'])) ? "checked" : "";

        // Checkbox for event time
        $_POST['custom']['event_time'] = (!empty($_POST['custom']['event_time'])) ? "checked" : "";

        // Checkbox for organizer name
        $_POST['custom']['event_org'] = (!empty($_POST['custom']['event_org'])) ? "checked" : "";

        // Checkbox for organizer email
        $_POST['custom']['event_email'] = (!empty($_POST['custom']['event_email'])) ? "checked" : "";

        // Checkbox for organizer contact
        $_POST['custom']['org_contact'] = (!empty($_POST['custom']['org_contact'])) ? "checked" : "";

        // Checkbox for event location
        $_POST['custom']['event_loc'] = (!empty($_POST['custom']['event_loc'])) ? "checked" : "";

        // Checkbox for event segment
        $_POST['custom']['event_segment'] = (!empty($_POST['custom']['event_segment'])) ? "checked" : "";

        // Dropdown for timezone string
        $_POST['custom']['timezone_string'] = (!empty($_POST['custom']['timezone_string'])) ? esc_attr($_POST['custom']['timezone_string']) : "";

        // Adding child element to the XML node.
        if (isset($_POST['custom'])) {
            foreach ($_POST['custom'] as $key => $value) {
                if (sanitize_text_field($key) !== ""
                        . "") {
                    $value = sanitize_text_field($value);
                    $sxe->addChild($key, empty($value) ? '' : $value );
                }
            }
        }

        // Event Start Date & Time
        if (isset($_POST['custom']['start_date']) && isset($_POST['custom']['start_time'])) {

            // Add or update event start time.
            update_post_meta($post_id, 'event_start_date_time', strtotime(sanitize_text_field($_POST['custom']['start_date']) . ' ' . sanitize_text_field($_POST['custom']['start_time'])));
        }

        // Add segment array in postmeta for event type post.
        $add_seg = (empty($_POST['custom']['add_seg'])) ? $_POST['custom']['add_seg'] = " " : $_POST['custom']['add_seg'];
        $serialized_add_seg = serialize($add_seg);
        update_post_meta($post_id, 'add_segment', $serialized_add_seg);

        // Saving whole child node in one metadata.
        update_post_meta($post_id, 'event_meta', $sxe->asXML());
    }

    /**
     * Update Event's Location Map. 
     *
     * @since   1.1.0
     * 
     * @param   $sxe    XML Object
     * @param   $id     Event post id  
     * @return  void
     */
    private static function save_google_map($sxe, $id = '') {

        /**
         *  Set Event Meta Default Values
         */
        $event_address = (empty($_POST["event_address"])) ? "" : sanitize_text_field($_POST["event_address"]);
        $loc_lat = (empty($_POST["loc_lat"])) ? "" : sanitize_text_field($_POST["loc_lat"]);
        $loc_long = (empty($_POST["loc_long"])) ? "" : sanitize_text_field($_POST["loc_long"]);
        $loc_zoom = (empty($_POST["loc_zoom"])) ? "" : sanitize_text_field($_POST["loc_zoom"]);
        $loc_map = (!empty($_POST["loc_map"])) ? "checked" : "";

        // Save Event Location Meta
        $sxe->addChild('event_address', $event_address);
        $sxe->addChild('loc_lat', $loc_lat);
        $sxe->addChild('loc_long', $loc_long);
        $sxe->addChild('loc_zoom', $loc_zoom);
        $sxe->addChild('loc_map', $loc_map);

        update_post_meta($id, 'event_address', sanitize_text_field($_POST["event_address"]));
    }

}
