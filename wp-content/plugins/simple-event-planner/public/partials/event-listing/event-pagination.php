<?php
/**
 * Pagination - Show numbered pagination for event listing
 * 
 * Override this template by copying it to yourtheme/simple_event_planner/event-lisitng/event-pagination.php
 * 
 * @version     2.0.0
 * @since       1.1.0 
 * @since       1.3.0 Added pagination class & filter
 * @author 	PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/event-listing
 */
ob_start();
global $event_query, $wp_rewrite;

/**
 * Event listing pagination
 * 
 * Show pagiantion after displaying on event listing page.
 */
$event_query->query_vars['paged'] > 1 ? $current = $event_query->query_vars['paged'] : $current = 1;

// Pagination Arguments
$pagination_args = array(
    'format' => '',
    'total' => $event_query->max_num_pages,
    'current' => $current,
    'show_all' => TRUE,
    'next_text' => 'Next',
    'prev_text' => 'Previous',
    'type' => 'array',
);

// Paginaton Base for Different Types of Pages
if (is_home() || is_front_page()) {

    // Paginaton Base for Home Page & Static Front Page
    $big = 999999999; // Need an unlikely integer
    $pagination_args['base'] = str_replace($big, '%#%', esc_url(get_pagenum_link($big)));
} else {

    // Paginaton Base for WP Post/Page
    $pagination_args['base'] = @add_query_arg('page', '%#%');
}

/**
 * Modify query string.
 *  
 * Remove query "page" argument from permalink
 */
if (!(isset($_GET['search_keyword']))) {
    if ($wp_rewrite->using_permalinks())
        $pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('page', get_pagenum_link(1))) . '?page=%#%/', 'paged');

    if (!empty($event_query->query_vars['s']))
        $pagination['add_args'] = array('s' => get_query_var('s'));
}
$pagination = apply_filters('sep_pagination_links_default_args', $pagination_args);

// Retrieve paginated links for event posts
$pages = paginate_links($pagination);

if (is_array($pages)) {
    $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
    echo "<nav aria-label=Page navigation>";
    echo "<ul class=pagination>";
    
    foreach ($pages as $page) {
        echo "<li>$page</li>";
    }
    
    echo "</ul>";
    echo '<div class="clearfix"></div>';
    echo "</nav>";
}

$sep_pagination = ob_get_clean();

/**
 * Modify  Event Pagination Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html    $sep_pagination   Pagination HTML.                   
 */
echo apply_filters( 'sep_pagination_template', $sep_pagination );