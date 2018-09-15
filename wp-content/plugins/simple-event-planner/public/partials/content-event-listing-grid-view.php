<?php
/**
 * The template for displaying events in grid view/layout.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/content-event-listing-grid-view.php
 * 
 * @version     1.0.0
 * @since       1.3.0 
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials
 */
ob_start();
global $post;
?>

<!-- Start Event Grid View
================================================== -->
<div class="col-sm-4">
    <article>

        <!-- Featured Image -->
		<?php if ( sep_get_the_event_image() ) { ?>
			<a href="<?php esc_url( the_permalink() ); ?>">
				<?php echo sep_get_the_event_image(); ?>
			</a>
			<?php
		}

		/**
		 * Template -> Event Start Date:
		 * 
		 * - Event Start Title
		 */
		get_simple_event_planner_template( 'event-listing/event-start-date.php' );
		?>
        <div class="description">

			<?php
			/**
			 * Template -> Title:
			 * 
			 * - Event Title
			 */
			get_simple_event_planner_template( 'event-listing/title.php' );

			/**
			 * Template -> Venue:
			 * 
			 * - Event Venue
			 */
			get_simple_event_planner_template( 'event-listing/venue.php' );

			/**
			 * Template -> Date:
			 * 
			 * - Event Date
			 */
			get_simple_event_planner_template( 'event-listing/date.php' );
			?>  
        </div>
    </article>
</div>     
<!-- ==================================================
End Event Grid -->

<?php
$html_gird_view = ob_get_clean();

/**
 * Modify Event Listing Grid View Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html    $html_grid_view   Event List Grid HTML.                   
 */
echo apply_filters( 'sep_grid_view_template', $html_gird_view );