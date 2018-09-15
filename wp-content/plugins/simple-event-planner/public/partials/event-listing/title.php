<?php
/**
 * The template for displaying event title.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/event-listing/title.php
 * 
 * @version     2.0.0
 * @since       1.1.0 
 * @since       1.3.0 Revised structure & added filter
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/event-listing
 */
ob_start();

global $post;
?>
<!-- Start Event Title
================================================== -->
<h3>
    <a href="<?php esc_url(the_permalink()); ?>"> <?php esc_attr(the_title()); ?> </a>
</h3>

<!-- ==================================================
End Event Title -->

<?php
$event_list_title = ob_get_clean();

/**
 * Modify Event Title - title Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html    $event_list_title   Title HTML.                   
 */
echo apply_filters('sep_title_template', $event_list_title);