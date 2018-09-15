<?php if (!defined('ABSPATH')) { exit; } // Exit if accessed directly

/**
 * Simple_Event_Planner_Post_Type_Event_Listing Class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * This is used to define the event_listing custom post type. 
 * This class is used to create custom post type for listing events in admin area. 
 * 
 * @link       https://wordpress.org/plugins/simple-event-planner/
 * @since      1.1.0
 * 
 * @package    Simple_Event_Planner
 * @subpackage Simple_Event_Planner/includes/posttype
 * @author     PressTigers <support@presstigers.com>
 */
if (!class_exists('Simple_Event_Planner_Post_Type_Event_Listing')) {

    class Simple_Event_Planner_Post_Type_Event_Listing {

        /**
         * Initialize the class and set its properties.
         *
         * @since   1.1.0
         */
        public function __construct() {

            // Add Hook into the 'init()' action
            add_action('init', array($this, 'sep_init'));

            // Add Hook into the 'admin_init()' action
            add_action('admin_init', array($this, 'sep_admin_init'));
        }

        /**
         * A function hook that the WordPress core launches at 'init' points.
         *          
         * @since   1.1.0
         */
        public function sep_init() {
            $this->sep_create_post_type();

            // Flush Rewrite Rules
            flush_rewrite_rules();

            // Add Filter into the Single Page Template
            add_filter('single_template', array($this, 'get_simple_event_planner_single_template'));

            // Add Filter into the Archive Page Template
            add_filter('archive_template', array($this, 'get_simple_event_planner_archive_template'));
        }

        /**
         * A function hook that the WordPress core launches at 'admin_init' points
         * 
         * @since   1.1.0
         */
        public function sep_admin_init() {

            // Hook - Taxonomy -> Event Category ->  Add New Column
            add_filter('manage_event_listing_posts_columns', array($this, 'sep_columns'));

            // Hook - Taxonomy -> Event Category ->  Add Value to New Column
            add_action('manage_event_listing_posts_custom_column', array($this, 'sep_columns_value'));
        }

        /**
         * Register Post Type & Taxonomy function.
         *
         * @since   1.0.0
         */
        public function sep_create_post_type() {

            if (post_type_exists("event_listing")) {
                return;
            }

            /**
             * Post Type -> Events
             */
            $singular = esc_html__('Event', 'simple-event-planner');
            $plural = esc_html__('Events', 'simple-event-planner');

            $has_archive = current_theme_supports('event-planner-templates') ?
                    esc_attr_x('events', 'Post type archive slug - resave permalinks after changing this', 'simple-event-planner') :
                    FALSE;

            $rewrite = array(
                'slug' => esc_attr_x('event', 'Event permalink - resave permalinks after changing this', 'simple-event-planner'),
                'with_front' => FALSE,
                'feeds' => FALSE,
                'pages' => FALSE,
                'hierarchical' => FALSE,
            );

            // Post Type -> Event Listing -> Label Arguments
            $labels_events = array(
                'name' => $plural,
                'singular_name' => $singular,
                'menu_name' => esc_html__('Event Planner', 'simple-event-planner'),
                'all_items' => sprintf(esc_html__('All %s', 'simple-event-planner'), $plural),
                'add_new' => esc_html__('Add New', 'simple-event-planner'),
                'add_new_item' => sprintf(esc_html__('Add %s', 'simple-event-planner'), $singular),
                'edit' => esc_html__('Edit', 'simple-event-planner'),
                'edit_item' => sprintf(esc_html__('Edit %s', 'simple-event-planner'), $singular),
                'new_item' => sprintf(esc_html__('New %s', 'simple-event-planner'), $singular),
                'view' => sprintf(esc_html__('View %s', 'simple-event-planner'), $singular),
                'view_item' => sprintf(esc_html__('View %s', 'simple-event-planner'), $singular),
                'search_items' => sprintf(esc_html__('Search %s', 'simple-event-planner'), $plural),
                'not_found' => sprintf(esc_html__('No %s found', 'simple-event-planner'), $plural),
                'not_found_in_trash' => sprintf(esc_html__('No %s found in trash', 'simple-event-planner'), $plural),
                'parent' => sprintf(esc_html__('Parent %s', 'simple-event-planner'), $singular)
            );

            // Post Type -> Event Listing -> Event Arguments
            $args_events = array(
                'labels' => $labels_events,
                'description' => sprintf(esc_html__('This is where you can create and manage %s.', 'simple-event-planner'), $plural),
                'public' => TRUE,
                'show_ui' => TRUE,
                'capability_type' => 'post',
                'map_meta_cap' => TRUE,
                'publicly_queryable' => TRUE,
                'exclude_from_search' => FALSE,
                'hierarchical' => FALSE,
                'rewrite' => array('slug' => esc_attr_x('events', 'Event permalink - resave permalinks after changing this', 'simple-event-planner'), 'hierarchical' => TRUE, 'with_front' => FALSE),
                'query_var' => TRUE,
                'can_export' => TRUE,
                'supports' => array(
                    'title',
                    'editor',
                    'excerpt',
                    'author',
                    'comments',
                    'thumbnail',
                    'page-attributes',
                ),
                'has_archive' => TRUE,
                'show_in_nav_menus' => TRUE,
                'menu_icon' => 'dashicons-calendar-alt',
            );

            // Register Event Listing Post Type
            register_post_type("event_listing", apply_filters("register_post_type_event_listing", $args_events));

            /* Custom Taxonomy for Custom Post Type event_listing */
            $singular = esc_html__('Category', 'simple-event-planner');
            $plural = esc_html__('Categories', 'simple-event-planner');

            if (current_theme_supports('event-planner-templates')) {
                $rewrite = array(
                    'slug' => esc_attr_x('event-category', 'Event category slug - resave permalinks after changing this', 'simple-event-planner'),
                    'with_front' => FALSE,
                    'hierarchical' => FALSE,
                );

                $public = TRUE;
            } else {
                $rewrite = FALSE;
                $public = FALSE;
            }

            // Post Type -> Event Listing -> Taxonomy -> Event Category -> Labels
            $labels_category = array(
                'name' => $plural,
                'singular_name' => $singular,
                'menu_name' => ucwords($plural),
                'search_items' => sprintf(esc_html__('Search %s', 'simple-event-planner'), $plural),
                'all_items' => sprintf(esc_html__('All %s', 'simple-event-planner'), $plural),
                'parent_item' => sprintf(esc_html__('Parent %s', 'simple-event-planner'), $singular),
                'parent_item_colon' => sprintf(esc_html__('Parent %s:', 'simple-event-planner'), $singular),
                'edit_item' => sprintf(esc_html__('Edit %s', 'simple-event-planner'), $singular),
                'update_item' => sprintf(esc_html__('Update %s', 'simple-event-planner'), $singular),
                'add_new_item' => sprintf(esc_html__('Add New %s', 'simple-event-planner'), $singular),
                'new_item_name' => sprintf(esc_html__('New %s Name', 'simple-event-planner'), $singular)
            );

            // Post Type -> Event Listing -> Taxonomy -> Event Category -> Arguments
            $args_category = array(
                'hierarchical' => TRUE,
                'update_count_callback' => '_update_post_term_count',
                'label' => $plural,
                'labels' => $labels_category,
                'show_ui' => TRUE,
                'public' => $public,
                'rewrite' => FALSE,
            );

            // Register Event Categry Taxonomy
            register_taxonomy(
                    "event_listing_category", apply_filters('register_taxonomy_event_listing_category_object_type', array('event_listing')), apply_filters('register_taxonomy_event_listing_category_args', $args_category)
            );
        }

        /**
         * Overriding the HTML of Default Theme
         * 
         * @since   1.1.0
         * 
         * @param   html    $html
         * @param   int     $post_id
         * @param   int     $post_thumbnail_id
         * @param   int     $size
         * @param   array   $attr
         * @return  html    $html
         */
        public function remove_post_image_html($html, $post_id, $post_thumbnail_id, $size, $attr) {
            global $post;
            if (is_single() and 'event_listing' === $post->post_type) {
                $html = '<br>';
            }
            return $html;
        }

        /**
         * Add Event Post Custom Columns 
         *
         * @since   1.0.0
         * @param   $columns   Default Columns of Event Post
         *  
         * @return  $columns   Custom Columns
         */
        public function sep_columns($columns) {
            $columns['author'] = esc_html__('Author', 'simple-event-planner');
            $columns['category'] = esc_html__('Category', 'simple-event-planner');
            $columns['address'] = esc_html__('Address', 'simple-event-planner');
            $columns['start_date'] = esc_html__('Start Date', 'simple-event-planner');
            return $columns;
        }

        /**
         * Add Event Post Custom Column's Value
         *
         * @since   1.0.0
         * @param   $name   Custom Columns Name
         *  
         * @return  void
         */
        public function sep_columns_value($name) {
            global $post;
            switch ($name) {
                case 'category':
                    $categories = get_the_terms($post->ID, 'event_listing_category');
                    if ($categories <> "") {
                        $couter = 0;
                        foreach ($categories as $category) {
                            echo esc_attr($category->name);
                            $couter++;
                            if ($couter < count($categories)) {
                                echo ", ";
                            }
                        }
                    }
                    break;
                case 'author':
                    echo get_the_author();
                    break;
                case 'address':
                    $loc_address = get_post_meta($post->ID, 'event_address', TRUE);
                    echo $loc_address;
                    break;
                case 'start_date':
                    if (get_post_meta(get_the_ID(), 'event_meta', TRUE)) {
                        $event_xml = get_post_meta(get_the_ID(), 'event_meta', TRUE);
                        $xml_object = new SimpleXMLElement($event_xml);
                        $start_date = isset($xml_object->start_date) ? $xml_object->start_date : '';
                        echo $start_date;
                    }
                    break;
            }
        }

        /**
         * To load archive course page in front end
         * 
         * @since   1.1.0
         *
         * @param   string  $archive_template   Default Archive Page Path.     	
         * @return  string  $archive_template   Plugin Archive Page Path.
         */
        function get_simple_event_planner_archive_template($archive_template) {
            if (is_post_type_archive('event_listing')) {
                $archive_template = (!file_exists(get_stylesheet_directory() . '/simple_event_planner/archive-event-listing.php')) ?
                        plugin_dir_path(dirname(__FILE__)) . '/public/partials/archive-event-listing.php' :
                        get_stylesheet_directory() . '/simple_event_planner/archive-event-listing.php';
            }
            return $archive_template;
        }

        /**
         * To load single course page for front end
         *
         * @since   1.1.0
         * 
         * @param   string  $single_template    Default Single Page Path.        	
         * @return  string  $single_template    Plugin Single Page Path.
         */
        function get_simple_event_planner_single_template($single_template) {
            global $post;

            if ( 'event_listing' === $post->post_type ) {
                $single_template = (!file_exists(get_stylesheet_directory() . '/simple_event_planner/single-event-listing.php')) ?
                        plugin_dir_path(dirname(__FILE__)) . '/public/partials/single-event-listing.php' :
                        get_stylesheet_directory() . '/simple_event_planner/single-event-listing.php';
            }
            return $single_template;
        }

    }

}

new Simple_Event_Planner_Post_Type_Event_Listing();