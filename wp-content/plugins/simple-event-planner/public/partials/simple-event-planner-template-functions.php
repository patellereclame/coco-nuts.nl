<?php

/**
 * Template Functions
 *
 * Template functions specifically created for event listings
 *
 * @author 	PressTigers
 * @category 	Core
 * @package    Simple_Event_Planner
 * @subpackage Simple_Event_Planner/public/partials
 * @version     1.0.1
 * @since       1.0.1 Removed body class
 */

/**
 * Get and include template files.
 *
 * @since   1.1.0
 * 
 * @param   mixed   $template_name
 * @param   array   $args (default: array())
 * @param   string  $template_path (default: '')
 * @param   string  $default_path (default: '')
 * @return  void
 */
function get_simple_event_planner_template($template_name, $args = array(), $template_path = 'simple_event_planner', $default_path = '') {
    if ($args && is_array($args)) {
        extract($args);
    }
    include( locate_simple_event_planner_template($template_name, $template_path, $default_path) );
}

/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 * yourtheme		/	$template_path	/	$template_name
 * yourtheme		/	$template_name
 * $default_path	/	$template_name
 * 
 * @since   1.1.0
 *
 * @param   string      $template_name
 * @param   string      $template_path  (default: 'simple_event_planner')
 * @param   string|boo  $default_path   (default: '') False to not load a default
 * @return  string
 */
function locate_simple_event_planner_template($template_name, $template_path = 'simple_event_planner', $default_path = '') {

    // Look within passed path within the theme - this is priority
    $template = locate_template(
            array(
                trailingslashit($template_path) . $template_name,
                $template_name
            )
    );

    // Get Default Template
    if (!$template && $default_path !== false) {
        $default_path = $default_path ? $default_path : untrailingslashit(plugin_dir_path(__FILE__));
        if (file_exists(trailingslashit($default_path) . $template_name)) {
            $template = trailingslashit($default_path) . $template_name;
        }
    }

    // Return what we found
    return apply_filters('simple_event_planner_locate_template', $template, $template_name, $template_path);
}

/**
 * Get template part (for templates in loops).
 *
 * @since   1.1.0
 * 
 * @param   string      $slug
 * @param   string      $name           (default: '')
 * @param   string      $template_path  (default: 'simple_event_planner')
 * @param   string|bool $default_path   (default: '') False to not load a default
 */
function get_simple_event_planner_template_part($slug, $name = '', $template_path = 'simple_event_planner', $default_path = '') {
    $template = '';

    if ($name) {
        $template = locate_simple_event_planner_template("{$slug}-{$name}.php", $template_path, $default_path);
    }

    // If template file doesn't exist, look in yourtheme/slug.php and yourtheme/simple_event_planner/slug.php
    if (!$template) {
        $template = locate_simple_event_planner_template("{$slug}.php", $template_path, $default_path);
    }

    if ($template) {
        load_template($template, false);
    }
}

/**
 * Add custom body classes
 * 
 * @since   1.1.0
 * 
 * @param  array    $classes
 * @return array
 */
function sep_body_class($classes) {
    $classes = (array) $classes;
    $classes[] = sanitize_title(wp_get_theme());

    if (is_sep()) {
        $classes[] = 'sep';
    }
    return array_unique($classes);
}

add_filter('body_class', 'sep_body_class');

/**
 * sep_the_event_start_date function.
 *
 * @since   1.1.0
 * 
 * @return  void
 */
function sep_the_event_start_date($post = NULL) {
    if ($start_date = sep_get_the_event_start_date($post)) {
        echo $start_date;
    }
}

/**
 * sep_get_the_event_start_date function.
 *
 * @since   1.1.0
 * 
 * @param   object  $post         Post Object
 * @return  string  $start_date   Start Date
 */
function sep_get_the_event_start_date($post = NULL) {
    $post = get_post($post);
    if ($post->post_type !== 'event_listing') {
        return;
    }
    $event_start_date_time = get_post_meta(get_the_ID(), 'event_start_date_time', TRUE);
    $event_xml = get_post_meta(get_the_ID(), 'event_meta', TRUE);
    $xml_object = new SimpleXMLElement($event_xml);
    $start_date = isset($xml_object->start_date) ? $xml_object->start_date : '';
    $event_date = isset($xml_object->event_date) ? $xml_object->event_date : '';
    if (isset($start_date) && '' != $start_date && 'checked' != $event_date) {
        $start_date = isset($xml_object->start_date) ? $xml_object->start_date : '';
        $sep_event_options = get_option('sep_event_options');
        $date_settings = isset($sep_event_options['sep_date_format']) ? $sep_event_options['sep_date_format'] : 'F j, Y';
        $start_date = date_i18n($date_settings, $event_start_date_time);
    } else {
        $start_date = '';
    }

    return apply_filters('sep_the_event_start_date', $start_date, $post);
}

/**
 * sep_the_event_start_time function.
 *
 * @since   1.1.0
 * 
 * @return  void
 */
function sep_the_event_start_time($post = NULL) {
    if ($start_time = sep_get_the_event_start_time($post)) {
        echo $start_time;
    }
}

/**
 * sep_get_the_event_start_date function.
 *
 * @since   1.1.0
 * 
 * @param   object  $post       Post Object
 * @return  string  $start_time Start Time
 */
function sep_get_the_event_start_time($post = NULL) {
    $post = get_post($post);
    if ($post->post_type !== 'event_listing') {
        return;
    }
    $event_xml = get_post_meta(get_the_ID(), 'event_meta', TRUE);
    $xml_object = new SimpleXMLElement($event_xml);
    $start_time = isset($xml_object->start_time) ? $xml_object->start_time : '';
    $event_time = isset($xml_object->event_time) ? $xml_object->event_time : '';
    if (isset($start_time) && '' <> $start_time && 'checked' <> $event_time) {
        $start_time = isset($xml_object->start_time) ? $xml_object->start_time : '';
        $start_time = new DateTime($start_time);
        $sep_event_options = get_option('sep_event_options');
        $time_settings = isset($sep_event_options['sep_time_format']) ? $sep_event_options['sep_time_format'] : '24-hours';
        if ('12-hours' === $time_settings) {
            $start_time = date_format($start_time, 'h:i a');
        } else {
            $start_time = date_format($start_time, 'G:i');
        }
    } else {
        $start_time = '';
    }

    return apply_filters('sep_the_event_start_time', $start_time, $post);
}

/**
 * sep_the_event_end_date function.
 *
 * @since   1.1.0
 * 
 * @return  void
 */
function sep_the_event_end_date($post = NULL) {
    if ($start_time = sep_get_the_event_end_date($post)) {
        echo $start_time;
    }
}

/**
 * sep_get_the_event_end_date function.
 *
 * @since   1.1.0
 * 
 * @param   object  $post       Post Object
 * @return  string  $end_date   End Date
 */
function sep_get_the_event_end_date($post = NULL) {
    $post = get_post($post);
    if ($post->post_type !== 'event_listing') {
        return;
    }
    $event_xml = get_post_meta(get_the_ID(), 'event_meta', TRUE);
    $xml_object = new SimpleXMLElement($event_xml);
    $end_date = isset($xml_object->end_date) ? $xml_object->end_date : '';
    $event_date = isset($xml_object->event_date) ? $xml_object->event_date : '';
    if (isset($end_date) && '' != $end_date && 'checked' <> $event_date) {
        $end_date = isset($xml_object->end_date) ? $xml_object->end_date : '';
        $end_date = strtotime($end_date);
        $sep_event_options = get_option('sep_event_options');
        $date_settings = isset($sep_event_options['sep_date_format']) ? $sep_event_options['sep_date_format'] : 'F j, Y';
        $end_date = date_i18n($date_settings, $end_date);
    } else {
        $end_date = '';
    }
    return apply_filters('sep_the_event_end_date', $end_date, $post);
}

/**
 * sep_the_event_end_time function.
 *
 * @since   1.1.0
 * 
 * @return  void
 */
function sep_the_event_end_time($post = NULL) {
    if ($start_time = sep_get_the_event_end_time($post)) {
        echo $start_time;
    }
}

/**
 * sep_get_the_event_end_time function.
 *
 * @since   1.1.0
 * 
 * @param   object  $post       Post Object
 * @return  string  $end_time   End Time
 */
function sep_get_the_event_end_time($post = NULL) {
    $post = get_post($post);

    if ($post->post_type !== 'event_listing') {
        return;
    }
    $event_xml = get_post_meta(get_the_ID(), 'event_meta', TRUE);
    $xml_object = new SimpleXMLElement($event_xml);
    $end_time = isset($xml_object->end_time) ? $xml_object->end_time : '';
    $event_time = isset($xml_object->event_time) ? $xml_object->event_time : '';
    if (isset($end_time) && '' <> $end_time && 'checked' <> $event_time) {
        $end_time = isset($xml_object->end_time) ? $xml_object->end_time : '';
        $end_time = new DateTime($end_time);
        $sep_event_options = get_option('sep_event_options');
        $time_settings = isset($sep_event_options['sep_time_format']) ? $sep_event_options['sep_time_format'] : '24-hours';
        if ('12-hours' === $time_settings) {
            $end_time = date_format($end_time, 'h:i a');
        } else {
            $end_time = date_format($end_time, 'G:i');
        }
    } else {
        $end_time = '';
    }
    return apply_filters('sep_the_event_end_time', $end_time, $post);
}

/**
 * sep_the_event_category function.
 *
 * @since   1.1.0
 * 
 * @return  void
 */
function sep_the_event_category($post = NULL) {
    if ($event_categories = sep_get_the_event_category($post)) {
        $count = sizeof($event_categories);
        foreach ($event_categories as $event_category) {
            echo ucfirst($event_category->name);
            if ($count > 1) {
                echo '&nbsp, ';
            }
            $count--;
        }
    }
}

/**
 * sep_get_the_event_category function.
 *
 * @since   1.1.0
 * 
 * @param   object  $post       Post Object
 * @return  array   $categories Event Categories
 */
function sep_get_the_event_category($post = NULL) {
    $post = get_post($post);
    if ($post->post_type !== 'event_listing') {
        return;
    }

    $categories = wp_get_post_terms($post->ID, 'event_listing_category');
    return apply_filters('sep_the_event_category', $categories, $post);
}

/**
 * sep_the_event_venue function.
 *
 * @since   1.1.0
 * 
 * @return  void
 */
function sep_the_event_venue($post = NULL) {
    if ($event_address = sep_get_the_event_venue($post)) {
        echo $event_address;
    }
}

/**
 * sep_get_the_event_venue function.
 *
 * @since   1.1.0
 * 
 * @param   object  $post (default: null)
 * @return  string  $event_address  Event Address
 */
function sep_get_the_event_venue($post = NULL) {
    $post = get_post($post);
    if ($post->post_type !== 'event_listing') {
        return;
    }
    $event_xml = get_post_meta(get_the_ID(), 'event_meta', TRUE);
    $xml_object = new SimpleXMLElement($event_xml);
    $event_address = isset($xml_object->event_address) ? $xml_object->event_address : '';
    $event_loc = isset($xml_object->event_loc) ? $xml_object->event_loc : '';
    $event_address = (isset($event_address) and '' <> $event_address and 'checked' <> $event_loc) ?
            (isset($xml_object->event_address) ? $xml_object->event_address : '') : '';

    return apply_filters('sep_the_event_venue', $event_address, $post);
}

/**
 * sep_the_event_seg function 
 * 
 * @since   1.1.0
 * 
 * @param   type $post
 * @param   mixed $post (default: null)
 * @return  void
 */
function sep_the_event_seg($post = NULL) {
    if ($event_seg = sep_get_event_segment($post)) {
        echo $event_seg;
    }
}

/**
 * sep_get_event_segment function
 * 
 * @since   1.1.0
 * 
 * @param   object  $post       Post Object
 * @return  string  $seg_array  Segments Serialized Array
 */
function sep_get_event_segment($post = NULL) {
    $post = get_post($post);
    if ($post->post_type !== 'event_listing') {
        return;
    }
    $event_xml = get_post_meta(get_the_ID(), 'event_meta', TRUE);
    $xml_object = new SimpleXMLElement($event_xml);
    $seg_array = get_post_meta(get_the_ID(), 'add_segment', TRUE);
    $seg_array = unserialize($seg_array);
    $event_segment = isset($xml_object->event_segment) ? $xml_object->event_segment : '';
    if (isset($seg_array) and '' <> $seg_array and 'checked' <> $event_segment) {
        $seg_array = get_post_meta(get_the_ID(), 'add_segment', TRUE);
        $seg_array = unserialize($seg_array);
    } else {
        $seg_array = '';
    }
    return apply_filters('sep_the_event_segments', $seg_array, $post);
}

/**
 * sep_the_event_venue_google_map_link function.
 *
 * @since   1.1.0
 * 
 * @return  void
 */
function sep_the_event_venue_google_map_link($post = NULL) {
    if ($event_map = sep_get_the_event_venue_google_map_link($post)) {
        echo $event_map;
    }
}

/**
 * sep_get_the_event_venue_google_map_link function.
 *
 * @since   1.1.0
 * 
 * @param   mixed   $post (default: null)
 * @return  string  $event_map_link Event Map Link
 */
function sep_get_the_event_venue_google_map_link($post = NULL) {
    $post = get_post($post);
    if ($post->post_type !== 'event_listing') {
        return;
    }
    $event_xml = get_post_meta(get_the_ID(), 'event_meta', TRUE);
    $xml_object = new SimpleXMLElement($event_xml);
    $event_address = isset($xml_object->event_address) ? $xml_object->event_address : '';
    $event_map_link = 'https://www.google.com/maps?f=q&source=s_q&hl=en&geocode&q=' . str_replace(" ", "+", $event_address);
    return apply_filters('sep_the_event_venue_google_map_link', $event_map_link, $post);
}

/**
 * sep_the_event_venue_map function.
 *
 * @since   1.1.0
 * 
 * @return  void
 */
function sep_the_event_venue_map($post = NULL) {
    if ($event_map = sep_get_the_event_venue_map($post)) {
        echo $event_map;
    }
}

/**
 * sep_get_the_event_venue_map function.
 *
 * @since   1.1.0
 * 
 * @param   mixed   $post (default: null)
 * @return  html    $event_map  Event Map
 */
function sep_get_the_event_venue_map($post = NULL) {
    $post = get_post($post);
    if ($post->post_type !== 'event_listing') {
        return;
    }

    $event_xml = get_post_meta(get_the_ID(), 'event_meta', TRUE);
    $xml_object = new SimpleXMLElement($event_xml);
    $event_address = isset($xml_object->event_address) ? $xml_object->event_address : '';
    $loc_lat = isset($xml_object->loc_lat) ? $xml_object->loc_lat : '';
    $loc_long = isset($xml_object->loc_long) ? $xml_object->loc_long : '';
    $loc_zoom = isset($xml_object->loc_zoom) ? $xml_object->loc_zoom : '16';
    $loc_map = isset($xml_object->loc_map) ? $xml_object->loc_map : '';

    if (isset($event_address) and '' <> $event_address and 'checked' <> $loc_map) {

        if (shortcode_exists('event_map'))
            $event_map = do_shortcode('[event_map map_height="300" map_lat="' . $loc_lat . '" map_lon="' . $loc_long . '" map_zoom="15" map_info="' . $event_address . '"]');
    }
    else {
        $event_map = '';
    }
    return apply_filters('sep_the_event_venue_map', $event_map, $post);
}

/**
 * sep_the_event_image function.
 *
 * @since   1.1.0
 * 
 * @return  void
 */
function sep_the_event_image($before = '', $after = '', $width = '', $height = '', $post = NULL) {
    if ($event_image = sep_get_the_event_image($width, $height, $post))
        echo $before . $event_image . $after;
}

/**
 * sep_get_the_event_image function.
 *
 * @since   1.1.0
 * 
 * @param   mixed   $post (default: null)
 * @return  html    $event_image    Event Image
 */
function sep_get_the_event_image($width = '', $height = '', $post = NULL) {
    $post = get_post($post);

    $sep_event_options = get_option('sep_event_options');
    $list_image = $sep_event_options['sep_event_content'];

    if ($post->post_type !== 'event_listing') {
        return;
    }
    $image_url = sep_get_the_img_src(get_the_ID(), $width, $height);
    $event_image = '';

// Check Event Listing Image    
    if ('hide-image' === $list_image) {
        $event_image = '';
    } elseif ($image_url) {
        $event_image = '<figure><img src="' . $image_url . '" class="img-responsive" alt=""></figure>';
    }
    return apply_filters('sep_the_event_image', $event_image, $post);
}

/**
 * sep_the_event_organizer function
 *
 * @since   1.1.0
 * 
 * @return  void
 */
function sep_the_event_organizer($post = NULL) {
    if ($event_organizer = sep_get_the_event_organizer($post)) {
        echo $event_organizer;
    }
}

/**
 * sep_get_the_event_organizer function.
 *
 * @since   1.1.0
 * 
 * @param   mixed   $post (default: null) 
 * @return  string  $event_organizer    Organizer Name
 */
function sep_get_the_event_organizer($post = NULL) {
    $post = get_post($post);
    if ($post->post_type !== 'event_listing') {
        return;
    }

    $event_xml = get_post_meta(get_the_ID(), 'event_meta', TRUE);
    $xml_object = new SimpleXMLElement($event_xml);
    $event_organizer = isset($xml_object->event_organiser) ? $xml_object->event_organiser : '';
    $event_org = isset($xml_object->event_org) ? $xml_object->event_org : '';

    $event_organizer = (isset($event_organizer) and '' <> $event_organizer and 'checked' <> $event_org) ?
            ( isset($xml_object->event_organiser) ? $xml_object->event_organiser : '' ) : '';

    return apply_filters('sep_the_event_organizer', $event_organizer, $post);
}

/**
 * sep_the_organizer_contact function
 *
 * @since   1.1.0
 * 
 * @return  void
 */
function sep_the_organizer_contact($post = NULL) {
    if ($organizer_contact = sep_get_the_organizer_contact($post)) {
        echo $organizer_contact;
    }
}

/**
 * sep_get_the_organizer_contact function.
 *
 * @since   1.1.0
 * 
 * @param   mixed   $post (default: null)
 * @return  string  $organizer_contact  Organizer Contact Number
 */
function sep_get_the_organizer_contact($post = NULL) {
    $post = get_post($post);
    if ($post->post_type !== 'event_listing') {
        return;
    }
    $event_xml = get_post_meta(get_the_ID(), 'event_meta', TRUE);
    $xml_object = new SimpleXMLElement($event_xml);
    $organizer_contact = isset($xml_object->organiser_contact) ? $xml_object->organiser_contact : '';
    $org_contact = isset($xml_object->org_contact) ? $xml_object->org_contact : '';
    if (isset($organizer_contact) and '' <> $organizer_contact and 'checked' <> $org_contact) {
        $organizer_contact = isset($xml_object->organiser_contact) ? $xml_object->organiser_contact : '';
    } else {
        $organizer_contact = '';
    }

    return apply_filters('sep_the_organizer_contact', $organizer_contact, $post);
}

/**
 * sep_the_organizer_email function
 *
 * @since   1.1.0
 * @return  void
 */
function sep_the_organizer_email($post = NULL) {
    if ($organizer_email = sep_get_the_organizer_email($post)) {
        echo $organizer_email;
    }
}

/**
 * sep_get_the_organizer_contact function.
 *
 * @since   1.1.0
 * 
 * @param   mixed   $post (default: null)
 * @return  string  $organizer_email    Organizer Email
 */
function sep_get_the_organizer_email($post = NULL) {
    $post = get_post($post);
    if ($post->post_type !== 'event_listing') {
        return;
    }
    $event_xml = get_post_meta(get_the_ID(), 'event_meta', TRUE);
    $xml_object = new SimpleXMLElement($event_xml);
    $organizer_email = isset($xml_object->organiser_email) ? $xml_object->organiser_email : '';
    $event_email = isset($xml_object->event_email) ? $xml_object->event_email : '';

    if (isset($organizer_email) and '' <> $organizer_email and 'checked' <> $event_email) {
        $organizer_email = isset($xml_object->organiser_email) ? $xml_object->organiser_email : '';
    } else {
        $organizer_email = '';
    }

    return apply_filters('sep_the_organizer_email', $organizer_email, $post);
}

/**
 * Get the Image Url.
 *
 * @since   1.1.0
 * 
 * @param   string  $post_id    Event Post ID.
 * @param   string  $width      Image Width.
 * @param   string  $height     Image Height.
 * 
 * @return  string  $image_url  Image URL.
 */
function sep_get_the_img_src($post_id, $width, $height) {
    if (has_post_thumbnail()) {
        $image_id = get_post_thumbnail_id($post_id);
        $image_url = wp_get_attachment_image_src($image_id, 'event-venue-image', TRUE);

        if ($image_url[1] == $width and $image_url[2] == $height) {
            return $image_url[0];
        } else {
            $image_url = wp_get_attachment_image_src($image_id, "full", TRUE);
            return $image_url[0];
        }
    }
}

/**
 * Custom Excerpt Function.
 *
 * @since   1.1.0
 * 
 * @param   string  $charlength     Character length.
 * @param   string  $readmore       Read more Enable.
 * @param   string  $readmore_text  Read more Text.
 * 
 * @return  string  $excerpt        Excerpt of Event description
 */
function sep_get_the_excerpt($charlength = '255', $readmore = 'true', $readmore_text = 'Read More') {
    $excerpt = trim(preg_replace('/<a[^>]*>(.*)<\/a>/iU', '', get_the_excerpt()));
    if (strlen($excerpt) > $charlength) {

        if ($charlength > 0) {
            $excerpt = substr($excerpt, 0, $charlength);
        } else {
            $excerpt = $excerpt;
        }
        if ($readmore == 'true') {
            $more = '... <a href="' . get_permalink() . '" class="cs-read-more colr"><i class="fa fa-caret-right"></i>' . $readmore_text . '</a>';
        } else {
            $more = '...';
        }
        return $excerpt . $more;
    } else {
        return $excerpt;
    }
}

/**
 * Counter Script
 * 
 * @since 1.1.0
 */
function sep_event_counter_script_localization() {

    $plugin_name = new Simple_Event_Planner();
    wp_enqueue_script($plugin_name->get_simple_event_planner() . '-jquery-plugin');
    wp_enqueue_script($plugin_name->get_simple_event_planner() . '-jquery-countdown');

    // Event Start Date & Time 
    global $post;
    $event_xml = get_post_meta($post->ID, 'event_meta', TRUE);
    $xml_object = new SimpleXMLElement($event_xml);
    $start_date = isset($xml_object->start_date) ? $xml_object->start_date : '';
    $start_time = isset($xml_object->start_time) ? $xml_object->start_time : '';
    $year = date("Y", strtotime($start_date));
    $month = date_i18n("m", strtotime($start_date));
    $day = date_i18n("d", strtotime($start_date));
    $hours = date_i18n("H", strtotime($start_time));
    $minutes = date_i18n("i", strtotime($start_time));

    // Localize the script with event data
    $event_date_time = array(
        'year' => esc_js($year),
        'month' => esc_js($month),
        'day' => esc_js($day),
        'hours' => esc_js($hours),
        'minutes' => esc_js($minutes),
    );

    // Enqueued script with localized data.
    wp_enqueue_script($plugin_name->get_simple_event_planner() . '-frontend');
    wp_localize_script($plugin_name->get_simple_event_planner() . '-frontend', 'event', $event_date_time);
}

add_action('single_event_listing_start', 'sep_event_counter_script_localization', 20);

/**
 * Event Start Time 
 * 
 * @since 1.1.0
 */
function sep_event_start_date() {
    get_simple_event_planner_template('single-event/event-start-date.php');
}

/**
 * sep_the_event_two_dates_diff function.
 *
 * @since   1.1.0
 * 
 * @return   void
 */
function sep_the_event_two_dates_diff($post = NULL) {
    if ($even_count_days = sep_get_the_event_two_dates_diff($post)) {
        echo $even_count_days;
    }
}

/**
 * sep_get_the_event_two_dates_diff function.
 *
 * @since   1.1.0
 * 
 * @param    mixed  $post (default: null)
 * @return   int    $even_count_days  Total Event Days
 */
function sep_get_the_event_two_dates_diff($post = NULL) {
    $post = get_post($post);
    if ($post->post_type !== 'event_listing') {
        return;
    }

    $event_xml = get_post_meta(get_the_ID(), 'event_meta', TRUE);
    $xml_object = new SimpleXMLElement($event_xml);
    $start_date = isset($xml_object->start_date) ? $xml_object->start_date : '';
    $start_date = new DateTime($start_date);
    $start_date = date_format($start_date, 'F d, Y');

    $start_time = isset($xml_object->start_time) ? $xml_object->start_time : '';
    $end_time = isset($xml_object->end_time) ? $xml_object->end_time : '';

    $end_date = isset($xml_object->end_date) ? $xml_object->end_date : '';
    $end_date = new DateTime($end_date);
    $end_date = date_format($end_date, 'F d, Y');

    $start_datetime = new DateTime($start_date . $start_time);
    $end_datetime = new DateTime($end_date . $end_time);
    $interval = $start_datetime->diff($end_datetime);

    $even_count_days = '';
    $months = ( 1 == $interval->format('%m') || 0 == $interval->format('%m') ) ? esc_html__('month', 'simple-event-planner') : esc_html__('months', 'simple-event-planner');
    $days = ( 1 == $interval->format('%d') || 0 == $interval->format('%d') ) ? esc_html__('day', 'simple-event-planner') : esc_html__('days', 'simple-event-planner');

    $hours = ( 1 == $interval->format('%h') || 0 == $interval->format('%h') ) ? esc_html__('hour', 'simple-event-planner') : esc_html__('hours', 'simple-event-planner');
    $years = ( 1 == $interval->format('%y') || 0 == $interval->format('%y') ) ? esc_html__('year', 'simple-event-planner') : esc_html__('years', 'simple-event-planner');
    if (0 < $interval->format('%y')) {
        $even_count_days = ' (' . $interval->format('%y') . ' ' . $years;
        $even_count_days .= ' ' . $interval->format('%m') . ' ' . $months;
        $even_count_days .= ' ' . $interval->format('%d') . ' ' . $days;
        $even_count_days .= ' ' . $interval->format('%h') . ' ' . $hours . ')';
    } elseif (0 == $interval->format('%d') && 0 < $interval->format('%h')) {
        $even_count_days = ' (' . $interval->format('%h') . ' ' . $hours . ')';
    } elseif (0 < $interval->format('%d') && 0 == $interval->format('%m')) {
        $even_count_days = ' (' . $interval->format('%d') . ' ' . $days;
        $even_count_days .= ' ' . $interval->format('%h') . ' ' . $hours . ')';
    } elseif (0 < $interval->format('%m')) {
        $even_count_days = ' (' . $interval->format('%m') . ' ' . $months;
        $even_count_days .= ' ' . $interval->format('%d') . ' ' . $days;
        $even_count_days .= ' ' . $interval->format('%h') . ' ' . $hours . ')';
    }

    return apply_filters('sep_the_event_days_count', $even_count_days, $post);
}

/**
 * Output Wrapper start div
 * 
 * @since 1.1.0
 * 
 */
function sep_event_listing_wrapper_start() {
    get_simple_event_planner_template('global/content-wrapper-start.php');
}

add_action('sep_before_main_content', 'sep_event_listing_wrapper_start', 10);

/**
 * Output Wrapper end div's
 * 
 *  @since   1.1.0
 */
function sep_event_listing_wrapper_end() {
    get_simple_event_planner_template('global/content-wrapper-end.php');
}

add_action('sep_after_main_content', 'sep_event_listing_wrapper_end', 10);

/**
 * Search SQL filter for matching against post title only.
 *
 * @since   1.1.0
 *
 * @param   string      $search     Search Keyword
 * @param   WP_Query    $wp_query   Search Query
 */
function sep_keywords_search_by_title($search, $wp_query) {

    if (!empty($search) && !empty($wp_query->query_vars['search_terms']) && isset($wp_query->query['post_type']) && 'event_listing' == $wp_query->query['post_type']) {

        global $wpdb;

        $q = $wp_query->query_vars;
        $n = !empty($q['exact']) ? '' : '%';

        $search = array();

        foreach ((array) $q['search_terms'] as $term)
            $search[] = $wpdb->prepare("$wpdb->posts.post_title LIKE %s", $n . $wpdb->esc_like($term) . $n);

        if (!is_user_logged_in())
            $search[] = "$wpdb->posts.post_password = ''";

        $search = ' AND ' . implode(' AND ', $search);
    }

    return $search;
}

/* Hook-> Keywords Search By Title */
add_filter('posts_search', 'sep_keywords_search_by_title', 10, 2);

/**
 * Get Current Page Slug. 
 * 
 * @since   1.1.0
 */
function sep_get_slugs() {
    if ($link = get_permalink()) {
        $link = str_replace(home_url('/'), '', $link);
        if (( $len = strlen($link) ) > 0 && $link[$len - 1] == '/') {
            $link = substr($link, 0, -1);
        }
        return explode('/', $link);
    }
    return false;
}

/**
 * is_sep - Returns TRUE when Viewing the event_listing Pages.
 * 
 * @since   1.3.0 
 * 
 * @return bool
 */
function is_sep() {
    return apply_filters('is_sep', ( is_sep_shortcode() || is_sep_listing() || is_sep_archive() || is_sep_taxonomy()) ? TRUE : FALSE );
}

/**
 * is_sep_shortcode - Returns TRUE When Viewing event_listing & event_calendar shortcodes.
 * 
 * @since   1.3.0
 * 
 * @param   array  $classes
 * @return  array
 */
function is_sep_shortcode() {
    global $post;

    return ( isset($post->post_content) && (has_shortcode($post->post_content, 'event_listing') || has_shortcode($post->post_content, 'event_calendar') || has_shortcode($post->post_content, 'sep_fb_event_listing')) );
}

/**
 * is_sep_listing - Returns TRUE When Viewing Single Page of Event Listing.
 * 
 * @since   1.3.0 
 * 
 * @return bool
 */
function is_sep_listing() {
    return is_singular(array('event_listing'));
}

/**
 * is_sep_archive - Returns TRUE When Viewing Event's Archive Page.
 * 
 * @since   1.3.0
 * 
 * @return  bool
 */
function is_sep_archive() {
    return ( is_post_type_archive('event_listing') );
}

/**
 * is_sep_taxonomy - Returns True When Viewing event_listing Cat/Tax
 * 
 * @since   1.3.0
 * 
 * @return  bool  
 */
function is_sep_taxonomy() {
    return is_tax(get_object_taxonomies('event_listing'));
}

/**
 * Archive Event Listing Views 
 * 
 * This function displays the user defined event listing
 * layout for archive page.  
 * 
 * @since   1.3.0 
 */
function sep_archive_views() {

    $sep_event_options = get_option('sep_event_options');
    $list_layout = $sep_event_options['sep_event_layout'];

    // Displays User Defined Layout
    if ('grid-view' === $list_layout) {
        get_simple_event_planner_template('content-event-listing-grid-view.php');
    } else {
        get_simple_event_planner_template('content-event-listing-list-view.php');
    }
}

// Hook -> Event Listing Layout
add_action('sep_event_listing_archive_views', 'sep_archive_views', 10);

/**
 * Tests to see if the timezone string is a UTC offset, ie "UTC+2".
 * 
 * @since	1.4
 *
 * @param string $timezone
 *
 * @return bool
 */
function sep_is_utc_offset($timezone) {
    $timezone = trim($timezone);
    return ( 0 === strpos($timezone, 'UTC') && strlen($timezone) > 3 );
}

/**
 * Try to figure out the Timezone name base on offset
 *
 * @since  1.4
 *
 * @param  string|int|float $timezone The timezone
 *
 * @return string           The Guessed Timezone String
 */
function sep_maybe_get_tz_name($timezone) {
    if (!sep_is_utc_offset($timezone) && !is_numeric($timezone)) {
        return $timezone;
    }

    if (!is_numeric($timezone)) {
        $offset = str_replace('utc', '', trim(strtolower($timezone)));
    } else {
        $offset = $timezone;
    }


    // try to get timezone from gmt_offset, respecting daylight savings
    $timezone = timezone_name_from_abbr(null, $offset * 3600, true);

    // if that didn't work, maybe they don't have daylight savings
    if (false === $timezone) {
        $timezone = timezone_name_from_abbr(null, $offset * 3600, false);
    }

    // and if THAT didn't work, round the gmt_offset down and then try to get the timezone respecting daylight savings
    if (false === $timezone) {
        $timezone = timezone_name_from_abbr(null, (int) $offset * 3600, true);
    }

    // lastly if that didn't work, round the gmt_offset down and maybe that TZ doesn't do daylight savings
    if (false === $timezone) {
        $timezone = timezone_name_from_abbr(null, (int) $offset * 3600, false);
    }
    return $timezone;
}

/**
 * Returns the current site-wide timezone string.
 * 
 * @since   1.4
 *
 * Based on the core WP code found in wp-admin/options-general.php.
 *
 * @return string
 */
function sep_get_timezone_string() {
    global $post;
    if ($post->post_type !== 'event_listing') {
        return;
    }
    $gmt_offset = get_option('gmt_offset');
    $timezone_string = get_option('timezone_string');
    $event_xml = get_post_meta(get_the_ID(), 'event_meta', TRUE);
    $xml_object = new SimpleXMLElement($event_xml);
    $timezone_string = $xml_object->timezone_string;
    return $timezone_string;
}

/**
 * Returns the current site-wide timezone string.
 * 
 * @since   1.4
 *
 * Based on the core WP code found in wp-admin/options-general.php.
 *
 * @return string
 */
function sep_get_timezone() {
    $timezone_string = sep_get_timezone_string();
    $timezone = sep_maybe_get_tz_name($timezone_string);
    if ($timezone == false) {
        echo $timezone;
        return $timezone_string;
    }
    return $timezone;
}

/**
 * Try to figure out the Timezone name base on offset
 *
 * @since  1.4
 *
 * @param  string|int|float $timezone The timezone
 *
 * @return string
 */
function sep_vl_col1() {
    $sep_event_options = get_option('sep_event_options');
    $visual_layout1 = $sep_event_options['sep_event_layout_col2'];
    $visual_layout1 = explode(',', $visual_layout1);
    foreach ($visual_layout1 as $key => $value) {
        if ($value == 'event_title') {
            get_simple_event_planner_template('single-event/event-title.php');
        }
		if ($value == 'event_date') {
            get_simple_event_planner_template('single-event/event-start-date.php');
        }
        if ($value == 'event_details') {
            get_simple_event_planner_template('single-event/event-details.php');
        }
        if ($value == 'event_image') {
            get_simple_event_planner_template('single-event/featured-image.php');
        }
        if ($value == 'event_schedule') {
            get_simple_event_planner_template('single-event/event-schedule.php');
        }
        if ($value == 'event_description') {
            get_simple_event_planner_template('single-event/event-description.php');
        }
        if ($value == 'event_segments') {
            get_simple_event_planner_template('single-event/event-details/event-segments.php');
        }
        if ($value == 'event_venue') {
            get_simple_event_planner_template('single-event/event-venue.php');
        }
    }
}

/**
 * Try to figure out the Timezone name base on offset
 *
 * @since  1.4
 *
 * @param  string|int|float $timezone The timezone
 *
 * @return string
 */
function sep_v2_col2() {
    $sep_event_options = get_option('sep_event_options');
    $visual_layout2 = $sep_event_options['sep_event_layout_col1'];
    $visual_layout2 = explode(',', $visual_layout2);
    foreach ($visual_layout2 as $key => $value) {
        if ($value == 'event_title') {
            get_simple_event_planner_template('single-event/event-title.php');
        }
		if ($value == 'event_date') {
            get_simple_event_planner_template('single-event/event-start-date.php');
        }
        if ($value == 'event_details') {
            get_simple_event_planner_template('single-event/event-details.php');
        }
        if ($value == 'event_image') {
            get_simple_event_planner_template('single-event/featured-image.php');
        }
        if ($value == 'event_schedule') {
            get_simple_event_planner_template('single-event/event-schedule.php');
        }
        if ($value == 'event_description') {
            get_simple_event_planner_template('single-event/event-description.php');
        }
        if ($value == 'event_segments') {
            get_simple_event_planner_template('single-event/event-details/event-segments.php');
        }
        if ($value == 'event_venue') {
            get_simple_event_planner_template('single-event/event-venue.php');
        }
    }
}