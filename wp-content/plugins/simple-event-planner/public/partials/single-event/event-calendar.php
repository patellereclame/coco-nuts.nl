<?php
/**
 * Template displaying calendar links on event detail page.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/single-event/event_calendar.php
 * 
 * @version     1.0.1
 * @since       1.3.0
 * @since       1.4.0 Hide calander template without event date
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/single-event
 */
ob_start();
global $post;

$start_date = date( 'Ymd', strtotime( sep_get_the_event_start_date() ) );
$end_date = date( 'Ymd', strtotime( sep_get_the_event_end_date() ) );

$start_time = date( '\THis', strtotime( str_replace( '-', '/', sep_get_the_event_start_time() ) ) );
$end_time = date( '\THis', strtotime( str_replace( '-', '/', sep_get_the_event_end_time() ) ) );

$site_url = get_option( 'home' );
$site_name = get_option( 'blogname' );

$sepObj = new Simple_Event_Planner();
$sepVersion = esc_attr( $sepObj->get_version() );

$dates = esc_attr( $start_date ) . esc_attr( $start_time ) . '/' . esc_attr( $end_date ) . esc_attr( $end_time );
$location = sep_get_the_event_venue();
$event_details = 'For details,link here:' . esc_url( get_the_permalink() );

$google_cal_params = array(
	'action' => 'TEMPLATE',
	'text' => urlencode( strip_tags( $post->post_title ) ),
	'dates' => $dates,
	'details' => urlencode( $event_details ),
	'location' => urlencode( $location ),
	'output' => 'xml',
	'sprop' => 'website:' . home_url(),
);
$timezone = sep_get_timezone();
if ( false !== $timezone ) {
	$google_cal_params['ctz'] = urlencode( $timezone );
}
$google_base_url = 'https://www.google.com/calendar/event';
$google_cal_url = add_query_arg( $google_cal_params, $google_base_url );
$startDate = esc_attr( $start_date ) . esc_attr( $start_time );
$endDate = esc_attr( $end_date ) . esc_attr( $end_time );
$iCal_params = array(
	'startDate' => $startDate,
	'endDate' => $endDate,
	'uid' => $post->ID,
	'url' => get_the_permalink(),
	'location' => urlencode( $location ),
	'description' => esc_html( get_the_content() ),
	'subject' => esc_attr( get_the_title() ),
	'site_name' => $site_name,
	'site_url' => home_url(),
	'sep_version' => $sepVersion,
);
$iCal_file_path = plugins_url( '/ical.php', __FILE__ );
$iCal_url = add_query_arg( $iCal_params, $iCal_file_path );
?>

<!-- Event Counter -->
<div class="google-calendar-ical">
	<?php
	if ( '' !== sep_get_the_event_start_date() && '' !== sep_get_the_event_end_date() ) {
		echo '<div class="pull-right">';
	} else {
		echo '<div class="pull-left">';
	}
	$current_date = date( 'Y-m-d H:i:s' );
	$today = strtotime( $current_date );
	$sep_event_start_date = sep_get_the_event_start_date();
	$startDate = strtotime( $sep_event_start_date );
	if ( ('' !== sep_get_the_event_start_date() && '' !== sep_get_the_event_end_date()) && ( $startDate >= $today ) ) {
		?>
		<a href="<?php echo $google_cal_url; ?>" target="_blank" rel="nofollow"> <?php esc_html_e( 'Add to Google Calendar', 'simple-event-planner' ) ?> </a>
		<a href="<?php echo $iCal_url ?>"> <?php esc_html_e( 'Add to iCal', 'simple-event-planner' ) ?> </a>
		<?php
	}
	?>
</div>
</div>
<?php
$event_calendar = ob_get_clean();

/**
 * Modify Event Calendar Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html    $event_calendar  Event Calendar  HTML.                   
 */
echo apply_filters( 'sep_event_calendar_template', $event_calendar );