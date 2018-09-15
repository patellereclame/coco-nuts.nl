<?php
/**
 * The template containig search by event title for event listing page.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/search/event-search.php
 * 
 * @version     2.0.0
 * @since       1.1.0 
 * @since       1.3.0 Revised structure & added filter
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/search
 */
ob_start();

global $post; ?>

<!-- Start Event Keyword Search
================================================== -->
<div class="search ">
    <!-- Search Form -->
    <div class="form-group">
        <?php
        // Get Current Page Slug           
        $slugs = sep_get_slugs();
        $page_slug = $slugs[0];
        $slug = (!empty($page_slug) ) ? $page_slug : '';
        $search_keyword = isset($_GET['search_keyword']) ? sanitize_text_field($_GET['search_keyword']) : '';
        ?>    
        <form action="<?php echo esc_url(home_url('/')) . $slug; ?>" method="get">
            <input class="form-control" type="text" name="search_keyword" value="<?php echo $search_keyword; ?>" placeholder="<?php esc_html_e('Search by Event Title', 'simple-event-planner') ?>" />

            <?php
            // Append Query string With Page ID When Permalinks are not Set.
            if (!get_option('permalink_structure') && !is_front_page() && !is_home()) {
                ?>
                <input type="hidden" value="<?php echo get_the_ID(); ?>" name="page_id" >
            <?php } ?>
            <button class="input-group-addon" type="submit">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
        </form>
    </div>
</div>
<div class="clearfix"></div>
<!-- ==================================================
End Event Keyword Search -->

<?php
$event_list_search = ob_get_clean();

/**
 * Modify Event Search - Event Search Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html $event_list_search   Event Search HTML.                   
 */
echo apply_filters('sep_event_search_template', $event_list_search);