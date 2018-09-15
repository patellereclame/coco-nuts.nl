<?php
/**
 * Content wrappers
 *
 * Override this template by copying it to yourtheme/simple_event_planner/global/content-wrapper-end.php
 * 
 * @version     2.0.0
 * @since       1.1.0 
 * @since       1.3.0 Added filter
 * @author 	PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/global
 */
ob_start();

// Exit if accessed directly 
if (!defined('ABSPATH')) { exit; }

$template = get_option('template');
switch ($template) {
    case 'twentyeleven':
        echo '</div></div>';
        break;
    case 'twentytwelve':
        echo '</div></div>';
        break;
    case 'twentythirteen':
        echo '</div></div>';
        break;
    case 'twentyfourteen':
        echo '</div></div></div>';
        get_sidebar('content');
        break;
    case 'twentyfifteen':
        echo '</div></div></div>';
        break;
    case 'twentysixteen':
        echo '</div></main>  ';
        break;
    default :
        echo '</div></div>';
        break;
}

$sep_end_wrapper = ob_get_clean();

/**
 * Modify Content Wrapper End Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html    $sep_end_wrapper  Content End Wrapper HTML.                   
 */
echo apply_filters('sep_content_wrapper_end_template', $sep_end_wrapper);