<?php
/**
 * Template displaying category on event detail page.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/single-event/event-detail/category.php
 * 
 * @version     2.0.0
 * @since       1.1.0 
 * @since       1.3.0 Revised structure & added filter
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/single-event/event-detail
 */
ob_start();
global $post;

if ($event_categories = sep_get_the_event_category($post)) {
    ?> 

    <!-- Start Event category 
    ================================================== -->
    <strong>
        <?php
        $category_title = sizeof($event_categories) > 1 ? esc_html__('Categories', 'simple-event-planner') : esc_html__('Category', 'simple-event-planner');
        echo '<strong>' . $category_title . '</strong>'
        ?>
    </strong>
    <span>
        <?php
        sep_the_event_category();
        ?>
    </span>
    <!-- ==================================================
    End Event Category -->
    
    <?php
}

$category = ob_get_clean();

/**
 * Modify Event Category  - Category Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html  $category   Event Category HTML.                   
 */
echo apply_filters('sep_category_template', $category);