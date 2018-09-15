<?php
/**
 * The template for displaying event details on signle event detail page.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/single-event-listing.php
 *
 * @version     2.1.1
 * @since       1.1.0 
 * @since       1.3.0   Revised structure & added filter
 * @since       1.3.1   Added wrapper class
 * @since       1.4.0   Removed the "single_event_listing_end" action hook.
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials
 */
get_header();

ob_start();
global $post;

/**
 * Hook -> sep_before_main_content
 * 
 * @hooked sep_event_listing_wrapper_start - 10 
 * - Output Opening div of Main Container.
 * - Output Opening div of Content Area.
 * 
 * @since  1.1.0
 */
do_action('sep_before_main_content');
?>

<!-- Start Content Wrapper
================================================== -->
<div class="sep-page">
    <div class="sep-detail">
        <?php while (have_posts()) : the_post(); ?>
            <div class="row">

                <!-- Start Event Details
                ================================================== -->
                <?php
                $sep_event_options = get_option('sep_event_options');
                if (empty($sep_event_options['sep_event_layout_col1']) || empty($sep_event_options['sep_event_layout_col2'])) {
                    ?>
                    <div class="col-md-12 col-sm-12 event-description">
                        <div class="full-column">

                            <?php
                        }

                        if (!empty($sep_event_options['sep_event_layout_col1']) && !empty($sep_event_options['sep_event_layout_col2'])) {
                            ?>
                            <div class="col-md-6 col-sm-6">
                                <div class="left-column">
                                    <div class="single-event-details"> 
                                        <?php
                                    }
                                    /**
                                     * single_event_listing_start hook
                                     *
                                     * @hooked sep_event_counter_script_localization- 20
                                     * @hooked event_schedule - 30
                                     * 
                                     * @since   1.1.0
                                     */
                                    do_action('single_event_listing_start');
                                    
                                    sep_vl_col1();
                                    
                                    if (!empty($sep_event_options['sep_event_layout_col1']) && !empty($sep_event_options['sep_event_layout_col2'])) {
                                        ?>                        
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- ================================================== 
                        End Event Detail -->
                        <?php if (!empty($sep_event_options['sep_event_layout_col1']) && !empty($sep_event_options['sep_event_layout_col2'])) { ?>
                            <div class="col-md-6 col-sm-6">
                                <div class="right-column">
                                    <?php
                                }

                                /**
                                 * Template -> Content Single Event Listing:
                                 * 
                                 * - Event Featured Image 
                                 * - Event Title
                                 * - Event Description
                                 */
                                get_simple_event_planner_template_part('content', 'single-event-listing');
                            endwhile;

                            if (!empty($sep_event_options['sep_event_layout_col1']) && !empty($sep_event_options['sep_event_layout_col2'])) {
                                ?>
                            </div>
                        </div>
                    <?php }
                    ?>
                    <!--					</div>-->
                    <?php if (empty($sep_event_options['sep_event_layout_col1']) || empty($sep_event_options['sep_event_layout_col2'])) {
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>
</div>
<!-- ==================================================
End Content Wrapper -->

<?php
/**
 * Hook -> sep_after_main_content
 * 
 * @hooked sep_event_listing_wrapper_end - 10 
 * - Output Closing div of Main Container.
 * - Output Closing div of Content Area.
 * 
 * @since  1.1.0
 */
do_action('sep_after_main_content');

$single_event_listing = ob_get_clean();

/**
 * Modify Single Event Listing  Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html    $single_event_listing   Single Event Listing Page HTML.                   
 */
echo apply_filters('single_event_listing_template', $single_event_listing);

get_footer();