/**
 * Simple Event Planner Calendar Callback JS File - V 1.0.0
 *
 * @author PressTigers <support@presstigers.com>, 2016
 *
 * Actions List
 * - Event calendar_init
 * - sep_search_events
 */
(function ($) {
    'use strict';
    var calendar_init = function (jsondata, eventslimit)
    {
        $("#event-calendar-limit").eventCalendar({
            jsonData: JSON.parse(jsondata),
            jsonDateFormat: 'human',
            txt_noEvents: sep_views.sep_calendar['no_event'],
            showDescription: true,
            eventsLimit: eventslimit,
            txt_NextEvents: sep_views.sep_calendar['events'],
            monthNames: [sep_views.sep_calendar['month']['jan'] + ", ", sep_views.sep_calendar['month']['feb'] + ", ", sep_views.sep_calendar['month']['mar'] + ", ", sep_views.sep_calendar['month']['april'] + ", ", sep_views.sep_calendar['month']['may'] + ", ", sep_views.sep_calendar['month']['june'] + ", ",
                sep_views.sep_calendar['month']['july'] + ", ", sep_views.sep_calendar['month']['aug'] + ", ", sep_views.sep_calendar['month']['sep'] + ", ", sep_views.sep_calendar['month']['oct'] + ", ", sep_views.sep_calendar['month']['nov'] + ", ", sep_views.sep_calendar['month']['dec'] + ", "],
            dayNamesShort: [sep_views.sep_calendar['day']['sun'], sep_views.sep_calendar['day']['mon'], sep_views.sep_calendar['day']['tue'], sep_views.sep_calendar['day']['wed'], sep_views.sep_calendar['day']['thr'], sep_views.sep_calendar['day']['fri'],
                sep_views.sep_calendar['day']['sat']],
        });
    }

    $(document).ready(function ($)
    {

        // Search Events
        window.sep_search_events = function (admin_url)
        {
            alert(sep_views.sep_calendar['no_event']);
            var loc_address = $('#loc-addres').val();
            var event_category = $('#event-cat').val();
            var dataString = 'address=' + loc_address + '&event_category=' + event_category + '&action=sep_search_events&security=' + calendar_parameters.security + '';
            $.ajax({
                type: 'POST',
                url: admin_url,
                data: dataString,
                success: function (response) {
                    $('#event-calendar-limit').html('');
                    calendar_init('' + response + '', '9999999');
                }
            });
        }

        calendar_init(calendar_parameters.event_calendar, calendar_parameters.event_limit); 
    });
})(jQuery);