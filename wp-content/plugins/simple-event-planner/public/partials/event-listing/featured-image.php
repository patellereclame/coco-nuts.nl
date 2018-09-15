<?php
/**
 * The template for displaying event featured image.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/event-listing/featured-image.php
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

if (sep_get_the_event_image()) { ?>

    <!-- Start Event Featured Image
    ================================================== -->
    <div class="col-md-12">
        <a href="<?php  esc_url(the_permalink()); ?>">
            
            <!-- Featured Image -->
            <?php echo sep_get_the_event_image(); ?>
            <!-- End Event Featured Image -->
            
        </a>
    </div>
    <!-- ==================================================
    End Event Featured Image -->
 <?php
}

$list_feature_image = ob_get_clean();

/**
 * Modify Featured Image - Featured Image Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html    $list_feature_image  Feature Image HTML.                   
 */
echo apply_filters('sep_list_featured_image_template', $list_feature_image);