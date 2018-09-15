<?php
/**
 * The template is for displaying event listing archive.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/archive-event-listing.php
 * 
 * @version     2.0.1
 * @since       1.1.0 
 * @since       1.3.0   Revised structure & added filter
 * @since       1.4.0   Added wrapper classes
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials
 */
get_header();

ob_start();
global $post, $event_query, $wp_rewrite;

/**
 * Hook -> sep_before_main_content
 * 
 * @hooked sep_event_listing_wrapper_start - 10 
 * - Output Opening div of Main Container.
 * - Output Opening div of Content Area.
 * 
 * @since  1.1.0
 */
do_action( 'sep_before_main_content' );
?>

<!-- Start Event Title
================================================== -->
<h2><?php echo apply_filters( 'sep_archive_page_title', esc_html__( 'Event Archives', 'simple-event-planner' ) ); ?></h2>
<!-- ==================================================
End Event Title -->

<?php
// Get paged variable.
if ( get_query_var( 'paged' ) ) {
	$paged = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
	$paged = get_query_var( 'page' );
} else {
	$paged = 1;
}

// Event Query Default Arguments
$args = array(
	'posts_per_page' => 15,
	'post_type' => 'event_listing',
	'post_status' => 'publish',
	'paged' => $paged,
);

// Extending Argument Array for Event Keyword Search
$args['s'] = (!empty( $_GET['search_keyword'] )) ? sanitize_text_field( $_GET['search_keyword'] ) : '';

// Event Query
$event_query = new WP_Query( $args );

// Layout Settings
$sep_event_options = get_option( 'sep_event_options' );
$list_layout = $sep_event_options['sep_event_layout'];

// Changing Class
$view_class = ('grid-view' == $list_layout) ? 'grid' : 'listing';
?>
<div class="sep-page">
    <div class="<?php echo esc_attr( $view_class ); ?>">
		<?php
		/**
		 * Template -> Event Search:
		 * 
		 * - Search Event by Title
		 */
		get_simple_event_planner_template( 'search/event-search.php' );

		// Changing Class
		$layout_class = ('grid-view' == $list_layout) ? 'grid-view row' : 'list-view';
		?>

        <div class="<?php echo esc_attr( $layout_class ); ?>">

			<?php
			if ( $event_query->have_posts() ) :

				while ( $event_query->have_posts() ): $event_query->the_post();
					/**
					 * Hook -> sep_event_listing_archive_views
					 * 
					 * @hooked sep_event_listing_archive_views - 10  
					 *              
					 * Displays user defined event layout:
					 * 
					 * - Either list view or grid.
					 * 
					 * @since   1.3.0
					 */
					do_action( 'sep_event_listing_archive_views' );
				endwhile;

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
			?>
        </div>
    </div>
</div>

<?php
/**
 * Hook -> sep_after_main_content
 * 
 * @hooked sep_event_listing_wrapper_end - 10 
 * - Output Closing div of Main Container.
 * - Output Closing div of Content Area.
 * 
 * @since  1.1.0
 */
do_action( 'sep_after_main_content' );

$sep_events_archive = ob_get_clean();

/**
 * Modify the Events Archive Page Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html    $sep_events_archive  Events Archive Page HTML.                   
 */
echo apply_filters( 'sep_event_archive_template', $sep_events_archive );

get_footer();
