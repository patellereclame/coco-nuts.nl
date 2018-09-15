<?php

/**
 * Content wrappers
 *
 * Override this template by copying it to yourtheme/simple_event_planner/global/content-wrapper-start.php
 * 
 * @version     2.0.0
 * @since       1.1.0 
 * @since       1.3.0 Added filter
 * @since       1.4.0 Added wrapper classes
 * @author 	PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/global
 */
ob_start();

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

$template = get_option('template');
$sep_event_options = get_option('sep_event_options');

// Appearance Settings -> User Defined Container Class
$container_class = isset($sep_event_options['sep_container_class']) ? esc_attr($sep_event_options['sep_container_class']) : 'container sep-container';
$container_class = str_replace(',', ' ', $container_class);

// Get Container Id
if (isset( $sep_event_options['sep_container_id'])) {
    $container_ids = explode(" ", $sep_event_options['sep_container_id']);
    $container_id = $container_ids[0];
} else {
    $container_id = 'container';
}

switch ($template) {
    case 'twentyeleven' :
        echo '<div id="primary"><div role="main">';
        break;
    case 'twentytwelve' :
        echo '<div id="primary"><div id="content" role="main" class="twentytwelve">';
        break;
    case 'twentythirteen' :
        echo '<div id="primary" class="site-content"><div id="content" role="main" class="entry-content twentythirteen">';
        break;
    case 'twentyfourteen' :
        echo '<div id="primary" class="content-area"><div id="content" role="main" class="site-content twentyfourteen"><div class="tfwc">';
        break;
    case 'twentyfifteen' :
        echo '<div id="primary" role="main" class="content-area twentyfifteen"><div id="main" class="site-main t15wc">';
        break;
    case 'twentysixteen' :
        echo '<div id="primary" class="content-area twentysixteen"> <main id="main" class="site-main" role="main">';
        break;
    default:
        echo '<div class="' . esc_attr($container_class) . '" id="' . esc_attr($container_id) . '"><div id="content" class="sep-content" role="main">';
        break;
}

$sep_start_wrapper = ob_get_clean();

/**
 * Modify Content Wrapper Start Template. 
 *                                       
 * @since   1.3.0
 * 
 * @param   html    $sep_start_wrapper  Content Start wrapper HTML.                   
 */
echo apply_filters('sep_content_wrapper_start_template', $sep_start_wrapper);
