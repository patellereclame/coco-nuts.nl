<?php
/**
 * This part of template displaying event start date on top left corner of event detail page.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/single-event/event-date.php
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

// Start Event's Start and End Date
if ('' !== sep_get_the_event_start_date() && '' !== sep_get_the_event_end_date()) {
    ?>
    <div class="event-date-time">
        <strong> <?php esc_html_e('Date:', 'simple-event-planner'); ?> </strong>
        <time> <?php echo sep_get_the_event_start_date() . esc_html__(' - to - ', 'simple-event-planner') . sep_get_the_event_end_date() . sep_get_the_event_two_dates_diff(); ?>
        </time>
    </div>
<?php } elseif ('' !== sep_get_the_event_start_date()) {
    ?>
    <div class="event-date-time">
        <strong><?php esc_html_e('Date:', 'simple-event-planner'); ?> </strong>
        <time> <?php echo sep_get_the_event_start_date(); ?> </time>
    </div>
    <?php
}
$event_date = ob_get_clean();

/**
 * Modify Event Start Date - Event Date Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html    $start_date   Event Start Date HTML.                   
 */
echo apply_filters('sep_event_date_template', $event_date);