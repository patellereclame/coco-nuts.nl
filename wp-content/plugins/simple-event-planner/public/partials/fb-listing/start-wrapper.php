<?php
/**
 * Facebook Event list start
 *
 * Override this template by copying it to yourtheme/simple_event_planner/fb-listing/start-wrapper.php
 * 
 * @version     1.0.0
 * @since       1.4.0 
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/fb-listing
 */
ob_start();

// Value From Shortcode's Atributes
$list_layout = isset( $events_layout ) ? $events_layout : 'list';

// Changing Class
$view_class = ('grid' == $list_layout) ? 'grid' : 'listing';
?>
<div class="sep-page">
    <div class="<?php echo $view_class; ?>">

	<?php
	$start_wrapper = ob_get_clean();

	/**
	 * Modify Start Wrapper Template. 
	 *                                       
	 * @since   1.4.0
	 * 
	 * @param   html    $start_wrapper   Start Wrapper HTML.                   
	 */
	echo apply_filters( 'sep_start_wrapper_template', $start_wrapper );