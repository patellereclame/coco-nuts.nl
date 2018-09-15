<?php
/**
 * The template for displaying Facebook event featured image.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/fb-listing/featured-image.php
 * 
 * @version     1.0.0
 * @since       1.4.0 
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/fb-listing
 */
ob_start();
global $item;

if (!empty($item->cover->source)) {
    ?>

    <!-- Start Event Featured Image
    ================================================== -->
    <div class="col-md-12">
        <a href="<?php esc_url( 'https://www.facebook.com/events/'. $item->id .'' ); ?>">

            <!-- Featured Image -->
            <figure><img src="<?php echo $item->cover->source; ?>" class="img-responsive" alt=""></figure>
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
 * @since   1.4.0
 * 
 * @param   html    $list_feature_image  Feature Image HTML.                   
 */
echo apply_filters( 'sep_list_featured_image_template', $list_feature_image );