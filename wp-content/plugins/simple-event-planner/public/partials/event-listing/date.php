<?php
/**
 * The template for displaying event start & end date.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/event-listing/date.php
 * 
 * @version     2.0.0
 * @since       1.1.0 
 * @since       1.3.0 Revised Structre and added filter
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/event-listing
 */
ob_start();

global $post;
?>
<div class="time">
    <?php
    if ('' !== sep_get_the_event_start_date() && '' !== sep_get_the_event_end_date()) {
        ?>                            
        <time datetime="<?php echo sep_get_the_event_start_date() . esc_html__(' - to - ', 'simple-event-planner') . sep_get_the_event_end_date(); ?>"><?php echo sep_get_the_event_start_date() . __(' - to - ', 'simple-event-planner') . sep_get_the_event_end_date(); ?></time>
    <?php } elseif ('' !== sep_get_the_event_start_date()) {
        ?>
        <time datetime="<?php echo sep_get_the_event_start_date(); ?>"><?php echo sep_get_the_event_start_date(); ?></time>
    <?php } ?>
</div>

<?php
$event_list_date = ob_get_clean();

/**
 * Modify Event Listing Date - Date Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html  $event_list_date   Date HTML.                   
 */
echo apply_filters('sep_date_template', $event_list_date);