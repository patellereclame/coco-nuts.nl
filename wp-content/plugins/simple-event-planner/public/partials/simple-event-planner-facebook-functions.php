<?php
/**
 * Template Functions
 *
 * Template functions specifically created for Facebook event listings
 *
 * @author 	PressTigers
 * @category 	Core
 * @package    Simple_Event_Planner
 * @subpackage Simple_Event_Planner/public/partials
 * @version     1.0.0
 * @since       1.4.0
 */

/**
 * Get google map link for the fb event veneu.
 *
 * @since   1.4.0
 * 
 * @return  string  $event_map_link Event Map Link
 */
if ( !function_exists( 'sep_get_the_fb_event_venue_map_link' ) ) {

    function sep_get_the_fb_event_venue_map_link() {
        global $item;
        $event_address = $item->place->name;
        $event_map_link = 'https://www.google.com/maps?f=q&source=s_q&hl=en&geocode&q=' . str_replace(" ", "+", $event_address);
        return apply_filters('sep_the_facebook_event_venue_google_map_link', $event_map_link, $item);
    }

}

/**
 * Generate Facebook API URL for grabbing Event.
 *
 * @since 1.4.0
 */
if (!function_exists('fb_get_access_token')) {

    function fb_get_access_token() {
        $access_token = '';
        $sep_event_options = get_option('sep_event_options');

        // Get user's FB account API Keys
        $fb_app_id = isset($sep_event_options['sep_app_id']) ? $sep_event_options['sep_app_id'] : '';
        $fb_app_secret = isset($sep_event_options['sep_app_sec_id']) ? $sep_event_options['sep_app_sec_id'] : '';
        $fb_page_id = isset($sep_event_options['sep_fb_app_id']) ? $sep_event_options['sep_fb_app_id'] : '';
        $fb_graph_url = 'https://graph.facebook.com/v2.11/';

        // Access token arguments
        $args = array(
            'grant_type' => 'client_credentials',
            'client_id' => $fb_app_id,
            'client_secret' => $fb_app_secret
        );

        $access_token_url = add_query_arg($args, $fb_graph_url . 'oauth/access_token');
        $access_token_response = wp_remote_get($access_token_url);
        $access_token_response_body = wp_remote_retrieve_body($access_token_response);
        $access_token_data = json_decode($access_token_response_body);

        if (( isset($access_token_data->error) && is_object($access_token_data->error) ) || empty($access_token_data)) {
            $access_token = '';
        } else {
            $access_token = $access_token_data->access_token;
        }

        return $access_token;
    }

}

/**
 * Get event list endpoints.
 *
 * @since 1.4.0
 * 
 * @param   array   $shortcode_args Shortcode Arguments
 * @return  string  $fb_events_data Facebook Events Data
 */
if (!function_exists('fb_get_eventslist')) {

    function fb_get_eventslist( $shortcode_args ) {
        $fb_events_data = NULL;

        // Get settings options for FB API
        $sep_event_options = get_option('sep_event_options');
        $fb_app_id = isset($sep_event_options['sep_app_id']) ? $sep_event_options['sep_app_id'] : '';
        $fb_app_secret = isset($sep_event_options['sep_app_sec_id']) ? $sep_event_options['sep_app_sec_id'] : '';
        $fb_page_id = isset($sep_event_options['sep_fb_app_id']) ? $sep_event_options['sep_fb_app_id'] : '';
        $fb_graph_url = 'https://graph.facebook.com/v2.11/' . $fb_page_id . '/';
        
        // Get access token
        $fb_access_token = fb_get_access_token();

        if ( $fb_access_token ) {
            $events_arg = array('name', 'start_time', 'end_time', 'place', 'cover');
            $event_params = implode(",", $events_arg);
            
            // FB events data arguments
            $args = array(
                'fields' => $event_params,
                'access_token' => $fb_access_token,
                'limit' => strtolower($shortcode_args['limit']),
                'time_filter' => strtolower($shortcode_args['time_filter']),
            );

            $fb_endpoint_url = add_query_arg($args, $fb_graph_url . 'events');
            $fb_events_body_response = wp_remote_get($fb_endpoint_url);
            $fb_events_response_body = wp_remote_retrieve_body($fb_events_body_response);
            $fb_events_data = json_decode($fb_events_response_body);
            
            // Error dealing
            if ( isset( $fb_events_data->error ) && is_object( $fb_events_data->error ) ) {
                $fb_events_data = '';
            } else if ( empty($fb_events_data->data ) ) {
                $fb_events_data = '';
            }
        } else {
            $fb_events_data = '';
        }

        return $fb_events_data;
    }

}

/**
 * Display facebook paginated data.
 * 
 * @since 1.4.0
 * 
 * @param   array   $shortcode_args   Shortcode Arguments
 * @param   string  $position         Page number   
 * @return  string  $fb_events_data   Facebook Events Paginated Data
 */
if ( !function_exists( 'sep_facebook_pagination' ) ) {

    function sep_facebook_pagination( $shortcode_args, $position ) {

        $sep_event_options = get_option('sep_event_options');
        $fb_app_id = isset($sep_event_options['sep_app_id']) ? $sep_event_options['sep_app_id'] : '';
        $fb_app_secret = isset($sep_event_options['sep_app_sec_id']) ? $sep_event_options['sep_app_sec_id'] : '';
        $fb_page_id = isset($sep_event_options['sep_fb_app_id']) ? $sep_event_options['sep_fb_app_id'] : '';
        $fb_graph_url = 'https://graph.facebook.com/v2.11/' . $fb_page_id . '/';

        $fb_access_token = fb_get_access_token();

        if ( $fb_access_token ) {
            $events_arg = array('name', 'start_time', 'end_time', 'place', 'cover');
            $event_params = implode(",", $events_arg);
            
            // Pagination data arguments
            $args = array(
                'fields' => $event_params,
                'access_token' => $fb_access_token,
                'limit' => strtolower($shortcode_args['limit']),
                'time_filter' => strtolower($shortcode_args['time_filter']),
            );

            // Get Paginated Data Page State on reload
            $pageState = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

            if (isset($_GET['getEvent']) && ( $_GET['getEvent'] == 'next' )) {
                $args['after'] = ( $pageState ? $_SESSION['sep_cursor_after_old'] : $_SESSION['sep_cursor_after_current'] );
            } else if (isset($_GET['getEvent']) && ( $_GET['getEvent'] == 'previous' )) {
                $args['before'] = ( $pageState ? $_SESSION['sep_cursor_before_old'] : $_SESSION['sep_cursor_before_current'] );
            } else {
                $_SESSION['sep_cursor_before_current'] = '';
                $_SESSION['sep_cursor_after_current'] = '';
            }

            $url = add_query_arg($args, $fb_graph_url . 'events');
            $fb_events_body_response = wp_remote_get($url);
            $fb_events_response_body = wp_remote_retrieve_body($fb_events_body_response);
            $fb_events_data = json_decode($fb_events_response_body);

            if (isset($fb_events_data->error) && is_object($fb_events_data->error)) {
                $fb_events_data = '';
            } elseif (empty($fb_events_data->data)) {
                $fb_events_data = '';
            } else {

                // Save Endpoint Data State in Session
                if ($position == 'content') {
                    $_SESSION['sep_fb_before_new'] = (!empty($fb_events_data->paging->cursors->before) ? $fb_events_data->paging->cursors->before : '' );
                    $_SESSION['sep_fb_after_new'] = (!empty($fb_events_data->paging->cursors->after) ? $fb_events_data->paging->cursors->after : '' );
                } else {
                    if ($pageState) {
                        
                    } else {
                        $_SESSION['sep_cursor_before_old'] = $_SESSION['sep_cursor_before_current'];
                        $_SESSION['sep_cursor_after_old'] = $_SESSION['sep_cursor_after_current'];
                        $_SESSION['sep_cursor_before_current'] = $_SESSION['sep_fb_before_new'];
                        $_SESSION['sep_cursor_after_current'] = $_SESSION['sep_fb_after_new'];
                    }
                }
            }
        } else {
            $fb_events_data = '';
        }

        return $fb_events_data;
    }

}

/**
 * Facebook pagination Structure
 * 
 * Display pagination for event listing.
 * 
 * @since 1.4.0
 * 
 * @return  HTML  Facebook Events Pagination HTML Structure
 */
if (!function_exists('sep_facebook_pagination_display')) {
    function sep_facebook_pagination_display() {

        global $shortcode_args;
        $fb_events_data = sep_facebook_pagination($shortcode_args, 'pagination');
        ?>
        <nav aria-label="Page">
            <ul class="pagination">
                <?php if (!empty($fb_events_data->paging->previous)) { ?>
                    <li><a class="prev page-numbers" href="?getEvent=previous"><?php echo __('Previous', 'simple-event-planner'); ?></a></li>
                <?php } else { ?>
                    <li><a style=display:none;cursor:default; class ="prev page-numbers" href="?prevEvent=false"><?php _e( 'Previous', 'simple-event-planner'); ?></a></li>
                <?php }
                ?>
                <?php if (!empty($fb_events_data->paging->next)) { ?>
                    <li><a class="next page-numbers" href="?getEvent=next"><?php echo __('Next', 'simple-event-planner'); ?></a></li>
                <?php } else { ?>
                    <li><a style=display:none;cursor:default; class ="prev page-numbers" href="?prevEvent=false"><?php echo __('Next', 'simple-event-planner'); ?></a></li>
        <?php } ?>
            </ul>
            <div class="clearfix"></div>
        </nav>
        <?php
    }
}