<?php
/**
 * The template for displaying events in list view/layout.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/content-event-listing-list-view.php
 * 
 * @version     2.0.0
 * @since       1.3.0 Revised structure & added filter
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials
 */
ob_start();
global $post;
?>

<!-- Start Event Listing
================================================== -->
<article>
    <div class="row"> 

		<?php
		/**
		 * Template -> Featured Image:
		 * 
		 * - Event Featured Image
		 */
		get_simple_event_planner_template( 'event-listing/featured-image.php' );
		?>
        <div class="col-md-12">

			<?php
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
        </div>
    </div>  
</article>
<div class="clearfix"></div>
<!-- ==================================================
End Event Listing -->

<?php
$html_list_view = ob_get_clean();

/**
 * Modify the Event List View Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html    $html_list_view   Event List View HTML.                   
 */
echo apply_filters( 'sep_list_view_template', $html_list_view );
