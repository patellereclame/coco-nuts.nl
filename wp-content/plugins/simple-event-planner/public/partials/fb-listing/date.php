<?php
/**
 * The template for displaying Facebook event's start & end date.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/fb-listing/date.php
 * 
 * @version     1.0.0
 * @since       1.4.0
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/fb-listing
 */
ob_start();

global $item;
if ( !empty( $item->start_time ) || !empty( $item->end_time ) ) {
	?>
	<div class="time">
		<?php
		$sep_start_date = strtotime( $item->start_time );
		$start_date = date( 'j F Y', $sep_start_date );
		if ( !empty( $item->end_time ) ) {
			$sep_end_date = strtotime( $item->end_time );
			$end_date = date( 'j F Y', $sep_end_date );
		} else {
			$end_date = '';
		}
		if ( '' !== $start_date && '' !== $end_date ) {
			?>                            
			<time datetime="<?php echo $start_date . esc_html__( ' - to - ', 'simple-event-planner' ) . $end_date; ?>"><?php echo $start_date . __( ' - to - ', 'simple-event-planner' ) . $end_date; ?></time>
		<?php } elseif ( '' !== $start_date ) {
			?>
			<time datetime="<?php echo $start_date; ?>"><?php echo $start_date; ?></time>
		<?php } ?>
	</div>

	<?php
}
$event_list_date = ob_get_clean();

/**
 * Modify Event Listing Date - Date Template. 
 *                                       
 * @since   1.4.0
 * 
 * @param   html  $event_list_date   Date HTML.                   
 */
echo apply_filters( 'sep_facebook_date_template', $event_list_date );