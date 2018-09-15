<?php
if ( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
/**
 * Simple_Event_Planner_Meta_Boxes_Init Class
 *
 * This is used to define event planner meta boxes.
 * 
 * @link        https://wordpress.org/plugins/simple-event-planner/
 * @since       1.1.0
 * 
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/admin
 * @author      PressTigers <support@presstigers.com>
 */

class Simple_Event_Planner_Meta_Boxes_Init {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since   1.1.0
	 */
	public function __construct() {

		/**
		 * The class responsible for defining event data meta box options under custom post type in the admin area.
		 */
		require_once plugin_dir_path( __FILE__ ) . 'meta-boxes/class-simple-event-planner-meta-box-event-options.php';

		// Action -> Post Type -> Event_Listing -> Add Meta Boxes.
		add_action( 'add_meta_boxes', array( $this, 'sep_add_meta_boxes' ) );

		// Action -> Post Type -> Event_Listing -> Save Meta Boxes.
		add_action( 'save_post_event_listing', array( $this, 'sep_save_meta_boxes' ) );

		// Action -> Post Type -> Event_Listing -> Save Event Options Meta Box.
		add_action( 'sep_save_event_listing_meta', array( 'Simple_Event_Planner_Meta_Box_Event_Options', 'sep_save_event_listing_meta' ) );
	}

	/**
	 * Add event meta boxes.
	 *
	 * @since 1.1.0
	 */
	public function sep_add_meta_boxes() {
		add_meta_box( 'simple_event_planner_meta', __( 'Event Options', 'simple-event-planner' ), array( 'Simple_Event_Planner_Meta_Box_Event_Options', 'sep_meta_box_output' ), 'event_listing', 'normal', 'high' );
	}

	/**
	 * Save meta boxes.
	 *
	 * @since 1.1.0
	 */
	public function sep_save_meta_boxes( $post_id ) {

		/**
		 * We need to verify this came from our screen and with proper authorization,
		 * because the save_post action can be triggered at other times.
		 */
		// Check if our nonce is set.
		if ( !isset( $_POST['sep_event_meta_box_nonce'] ) ) {
			return;
		}

		// Verify that the nonce is valid.
		if ( !wp_verify_nonce( $_POST['sep_event_meta_box_nonce'], 'sep_event_meta_box' ) ) {
			return;
		}

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		} else {
			if ( !current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}

		/**
		 * @hooked sep_save_event_listing_meta - 10
		 * 
		 * Save event meta box:
		 * 
		 * - save event features meta box.
		 * 
		 * @since   1.1.0
		 * 
		 * @param   int  $post_id    Post Id
		 */
		do_action( 'sep_save_event_listing_meta', $post_id );
	}

}

new Simple_Event_Planner_Meta_Boxes_Init();