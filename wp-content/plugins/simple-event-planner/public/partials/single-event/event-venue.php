<?php
/**
 * Displaying venue and map of event of event detail page.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/single-event/event-venue.php
 * 
 * @version     2.0.0
 * @since       1.1.0 
 * @since       1.3.0 Revised structure & added filter
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/single-event
 */
ob_start();
global $post;

// Right Side Map Settings
$sep_event_options = get_option('sep_event_options');
//echo '<pre>';
//print_r($sep_event_options);
//echo '</pre>';
//$map_settings = $sep_event_options['sep_event_map'] ? $sep_event_options['sep_event_map'] : 'map-right' ;
//if ('map-right' == $map_settings) {
if ( '' !== sep_get_the_event_venue() || sep_get_the_event_venue_map() ) {
	?>

	<!-- Start Event Venue and Map 
	================================================== -->
	<div class="event-venue">

		<!-- Event Location -->
		<?php if ( '' !== sep_get_the_event_venue() ) { ?>
			<h4> <?php esc_html_e( 'Venue:', 'simple-event-planner' ); ?> </h4>
			<div class="event-info">
				<i class="fa fa-map-marker" aria-hidden="true"></i>
				<span><?php echo sep_get_the_event_venue(); ?></span>
			</div>
		<?php } ?> 

		<!-- Event Venue Map -->
		<?php if ( sep_get_the_event_venue_map() ) { ?>
			<div class="map">
				<?php echo sep_get_the_event_venue_map(); ?>                   
			</div>
		<?php } ?>
	</div>
	<?php
}
//}
?>
<!-- ==================================================
End Event Venue and Map -->

<?php
$event_venue = ob_get_clean();

/**
 * Modify Event Venue  - Event Venue Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html    $event_venue   Event Venue HTML.                   
 */
echo apply_filters( 'sep_event_venue_template', $event_venue );
