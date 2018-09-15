/**
 * Simple Event Planner Shortcode Builder JS File - V 1.0.1
 *
 * @author PressTigers <support@presstigers.com>, 2016
 *
 * Actions List
 * - sep_shortcodes_mce_button
 */
(function ($) {
    'use strict';

    $(function () {
        tinymce.PluginManager.add('sep_shortcodes_mce_button', function (editor, url) {
            editor.addButton('sep_shortcodes_mce_button', {
                title: 'Simple Event Planner',
                type: 'menubutton',
                icon: 'icon sep-icon',
                menu: [
                    /* Event Listing */
                    {
                        text: 'Event Listing',
                        onclick: function () {
                            editor.windowManager.open({
                                title: 'Insert Event Listing Shortcode',
                                body: [
                                    // Event Type
                                    {
                                        type: 'listbox',
                                        name: 'type',
                                        label: 'Type',
                                        values: [
                                            {text: 'Upcoming', value: 'upcoming'},
                                            {text: 'Past', value: 'past'},
                                        ]
                                    },
                                    // Event Layout
                                    {
                                        type: 'listbox',
                                        name: 'events_layout',
                                        label: 'Layout',
                                        values: [
                                            {text: 'List', value: 'list'},
                                            {text: 'Grid', value: 'grid'},
                                        ]
                                    },
                                    // Event category
                                    {
                                        type: 'textbox',
                                        name: 'event_category',
                                        label: 'Event Category',
                                    },
                                    // Event Limit                                 
                                    {
                                        type: 'textbox',
                                        subtype: 'number',
                                        name: 'events_limit',
                                        label: 'Event Limit',
                                        value: -1,
                                    },
                                    // Event Search                                   
                                    {
                                        type: 'listbox',
                                        name: 'search',
                                        label: 'Search',
                                        values: [
                                            {text: 'True', value: 'true'},
                                            {text: 'False', value: 'false'},
                                        ]
                                    },
                                ],
                                onsubmit: function (e) {

                                    // If user enter number less than -1
                                    if (e.data.events_limit < -1) {

                                        // Change value with -1
                                        e.data.events_limit = -1;
                                    }
                                    editor.insertContent('[event_listing type="' + e.data.type + '" events_layout="' + e.data.events_layout + '" event_category="' + e.data.event_category + '" events_limit="' + e.data.events_limit + '" search="' + e.data.search + '"]');
                                }
                            });
                        }
                    }, // End Events


                    /* Event Calendar */
                    {
                        text: 'Event Calendar',
                        onclick: function () {
                            editor.windowManager.open({
                                title: 'Insert Event Calendar Shortcode',
                                body: [
                                    // Event Limit                                 
                                    {
                                        type: 'textbox',
                                        subtype: 'number',
                                        name: 'events_limit',
                                        label: 'Event Limit',
                                        value: 0,
                                    },
                                    // Event Category
                                    {
                                        type: 'textbox',
                                        name: 'event_category',
                                        label: 'Event Category',
                                    },
                                    // Event Address
                                    {
                                        type: 'textbox',
                                        name: 'address',
                                        label: 'Address',
                                    },
                                    // Event Search                                   
                                    {
                                        type: 'listbox',
                                        name: 'search',
                                        label: 'Search',
                                        values: [
                                            {text: 'True', value: 'true'},
                                            {text: 'False', value: 'false'},
                                        ]
                                    },
                                ],
                                onsubmit: function (e) {

                                    // If user enter number less than -1
                                    if (e.data.events_limit <= -1) {

                                        // Change value with 0
                                        e.data.events_limit = 0;
                                    }
                                    editor.insertContent('[event_calendar event_category="' + e.data.event_category + '" address="' + e.data.address + '" events_limit="' + e.data.events_limit + '" search="' + e.data.search + '"]');
                                }
                            });
                        }
                    }, // End Event Calendar

                    /* Facebook Event Listing */
                    {
                        text: 'Facebook Event Listing',
                        onclick: function () {
                            editor.windowManager.open({
                                title: 'Insert Facebook Event Listing Shortcode',
                                body: [
                                    // Event Limit                                 
                                    {
                                        type: 'textbox',
                                        subtype: 'number',
                                        name: 'limit',
                                        label: 'Event Limit',
                                        value: 1,
                                    },
                                    // Event Type
                                    {
                                        type: 'listbox',
                                        name: 'time_filter',
                                        label: 'Type',
                                        values: [
                                            {text: 'Upcoming', value: 'upcoming'},
                                            {text: 'Past', value: 'past'},
                                        ]
                                    },
                                    // Event Layout
                                    {
                                        type: 'listbox',
                                        name: 'events_layout',
                                        label: 'Layout',
                                        values: [
                                            {text: 'List', value: 'list'},
                                            {text: 'Grid', value: 'grid'},
                                        ]
                                    },
                                ],
                                onsubmit: function (e) {

                                    // If user enter number less than -1
                                    if (e.data.events_limit <= -1) {

                                        // Change value with 0
                                        e.data.events_limit = 0;
                                    }
                                    editor.insertContent('[sep_fb_event_listing limit="' + e.data.limit + '" time_filter="' + e.data.time_filter + '" events_layout="' + e.data.events_layout + '"]');
                                }
                            });
                        }
                    }, //End Facebook Event Listing

                ]
            });
        });
    });
})(jQuery);