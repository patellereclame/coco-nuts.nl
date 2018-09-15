<?php

if ( !defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
/**
 * Simple_Event_Planner_Shortcode_Event_Listing class
 *
 * Event Listing Shortcode.
 *
 * This class lists the events on frontend for [event_listing] shortcode. It 
 * lists all upcoming events in the list with event search bar.
 * 
 * @link        https://wordpress.org/plugins/simple-event-planner/
 * @since       1.1.0
 * @since       1.3.3   Added filters on shortcode & event query arguments 
 * 
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/includes/shortcodes
 * @author      PressTigers <support@presstigers.com>
 */

class Simple_Event_Planner_Shortcode_Event_Listing {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since   1.1.0
	 * 
	 * @return  void
	 */
	public function __construct() {

		// Hook-> Event Listing Shortcode
		add_shortcode( 'event_listing', array( $this, 'sep_listing' ) );
	}

	/**
	 * Event Listing Shortcode
	 *
	 * @since   1.0.0
	 * 
	 * @param   string  $attr   Shortcode Parameters
	 * @return  void 
	 */
	public function sep_listing( $atts, $content ) {
		ob_start();

		global $event_query;

		// Shortcode Default Array
		$shortcode_args = array(
			'type' => 'upcoming',
			'search' => 'true',
			'event_category' => '',
			'events_limit' => '-1',
			'events_layout' => 'list'
		);

		// Combines user shortcode attributes with known attributes
		$shortcode_args = shortcode_atts( apply_filters( 'sep_output_events_defaults', $shortcode_args, $atts ), $atts );

		// Default Date-Time-Zone
		date_default_timezone_set( 'UTC' );
		$current_time = strtotime( current_time( 'Y-m-d H:i', $gmt = 0 ) );

		// Get paged Variable.
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}

		// Default WP_Query Arguments 
		$args = apply_filters(
				'sep_output_events_args', array(
			'posts_per_page' => esc_attr( $shortcode_args['events_limit'] ),
			'post_type' => 'event_listing',
			'post_status' => 'publish',
			'meta_key' => 'event_start_date_time',
			'meta_value' => '',
			'orderby' => 'meta_value',
			'order' => 'ASC',
			'paged' => $paged,
				), $atts
		);

		// Extending Argument Array for Event Category
		if ( !empty( $shortcode_args['event_category'] ) ) {
			$event_category = explode( ",", esc_attr( $shortcode_args['event_category'] ) );
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'event_listing_category',
					'field' => 'slug',
					'terms' => $event_category,
				),
			);
		}

		// Extending Argument Array Event Search by Title
		$args['s'] = (!empty( $_GET['search_keyword'] ) ) ? sanitize_text_field( $_GET['search_keyword'] ) : '';

		// Extending Argument Array for Event Type
		if ( 'upcoming' == esc_attr( $shortcode_args['type'] ) ) {
			$args['meta_value'] = $current_time;
			$args['meta_compare'] = '>=';
		} elseif ( 'past' == esc_attr( $shortcode_args['type'] ) ) {
			$args['meta_value'] = $current_time;
			$args['meta_compare'] = '<=';
		}

		// Event Query
		$event_query = new WP_Query( $args );

		/**
		 * Template -> Start Wrapper:
		 * 
		 * - Event Start Wrapper
		 */
		get_simple_event_planner_template( 'event-listing/start-wrapper.php', array( 'events_layout' => esc_attr( $shortcode_args['events_layout'] ) ) );

		// Display Keyword Search Bar
		if ( 'false' !== strtolower( esc_attr( $shortcode_args['search'] ) ) && '' !== strtolower( esc_attr( $shortcode_args['search'] ) ) ) {

			/**
			 * Template -> Event Search:
			 * 
			 * - Search Event by Title
			 * .
			 */
			get_simple_event_planner_template( 'search/event-search.php' );
		}

		/**
		 * Template -> Event Lisiting Start:
		 * 
		 * - Event Listing Start
		 */
		get_simple_event_planner_template( 'event-listing/event-listings-start.php', array( 'events_layout' => esc_attr( $shortcode_args['events_layout'] ) ) );

		if ( $event_query->have_posts() ) :

			while ( $event_query->have_posts() ): $event_query->the_post();

				// Displays User Defined Layout
				if ( 'grid' === esc_attr( $shortcode_args['events_layout'] ) ) {
					get_simple_event_planner_template( 'content-event-listing-grid-view.php' );
				} elseif ( 'list' === esc_attr( $shortcode_args['events_layout'] ) ) {
					get_simple_event_planner_template( 'content-event-listing-list-view.php' );
				}

			endwhile;

			/**
			 * Template -> Event Lisiting End:
			 * 
			 * - Event Listing End Wrapper
			 */
			get_simple_event_planner_template( 'event-listing/event-listings-end.php' );

			/**
			 * Template -> Event Pagination:
			 * 
			 * - Add Pagination to Resulted Events.
			 */
			get_simple_event_planner_template( 'event-listing/event-pagination.php' );
		else :

			/**
			 * Template -> Event Not Found:
			 * 
			 * - Will Triger When Event Will Not Found.
			 */
			get_simple_event_planner_template( 'event-listing/content-no-events-found.php' );
		endif;

		wp_reset_postdata();

		/**
		 * Template -> End Wraper:
		 * 
		 * - Event End Wrapper
		 */
		get_simple_event_planner_template( 'event-listing/end-wrapper.php' );

		$html = ob_get_clean();

		/**
		 * Filter -> Modify the Event Listing Shortcode
		 * 
		 * @since   1.1.0
		 * 
		 * @param   HTML    $html   Event Listing HTML Structure.
		 */
		return apply_filters( 'sep_event_listing_shortcode', $html . do_shortcode( $content ) );
	}

}
