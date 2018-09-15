<?php
/**
 * The template for displaying Facebook event title.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/fb-listing/title.php
 * 
 * @version     1.0.0
 * @since       1.4.0 
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/fb-listing
 */
ob_start();

global $item;

if ( !empty( $item->place->name ) ) {
	?>
	<!-- Start Event Title
	================================================== -->
	<h3>
		<a href="https://www.facebook.com/events/<?php echo $item->id; ?>"> 
			<?php
			echo $sep_event_title = $item->name;
			?> 
		</a>
	</h3>

	<!-- ==================================================
	End Event Title -->

	<?php
}
$event_list_title = ob_get_clean();

/**
 * Modify Event Title - title Template. 
 *                                       
 * @since   1.4.0
 * 
 * @param   html    $event_list_title   Title HTML.                   
 */
echo apply_filters( 'sep_facebook_title_template', $event_list_title );