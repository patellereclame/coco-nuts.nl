/**
 * Simple Event Planner Core(admin) JS File - V 2.0.0
 *
 * @author PressTigers <support@presstigers.com>, 2016
 *
 * Actions List
 * - Events Options Toggle Tab's Callback
 * - Date Time Picker
 * - Geo Location Search 
 * - Save Settings Options
 * - Wp Color Picker
 * - Email & Phone Validation
 * - Toggle Settings Option's Tabs
 * - Reset Options
 * - Add Event Segments Field
 * - Visual Layout Option
 * - Visual Layout Reset Button
 */
(function ($) {
    'use strict';

    $(document).ready(function () {

        // Events Options Toggle Tab's 
        $('.tab-options ul li a').live('click', function () {
            $(this).parent('li').siblings('li').removeClass('active');
            $(this).parent('li').addClass('active');
            var id = $(this).attr('id');
            $('.vertical-tabs .detail-tab').children().hide();
            $("div#" + id).fadeIn(200);
        });

        // Date Time Picker
        var currdate = new Date();
        currdate = currdate.getDate() + '-' + (currdate.getMonth() + 1) + '-' + currdate.getFullYear();
        $('#to-date , #booking-end-date').datetimepicker({
            mask: '',
            timepicker: false,
            minDate: currdate, //yesterday is minimum date(for today use 0 or -1970/01/01)
            onShow: function () {
                this.setOptions({
                    maxDate: $('#from-date').val() ? $('#from-date').val() : false
                })
            },
            format: 'd-m-Y',
            formatDate: 'd-m-Y',
            scrollMonth: false,
        });

        $('#from-date').datetimepicker({
            mask: '',
            timepicker: false,
            minDate: currdate,
            onShow: function () {
                this.setOptions({
                    minDate: $('#to-date').val() ? $('#to-date').val() : false
                })
            },
            format: 'd-m-Y',
            formatDate: 'd-m-Y',
            scrollMonth: false,
        });

        $('#to-time,#booking-end-time').datetimepicker({
            datepicker: false,
            onShow: function () {
                this.setOptions({
                    maxTime: $('#from-time').val() ? $('#from-time').val() : false
                })
            },
            format: 'H:i',
        });

        $('#from-time').datetimepicker({
            datepicker: false,
            onShow: function () {
                this.setOptions({
                    minTime: $('#to-time').val() ? $('#to-time').val() : false
                })
            },
            format: 'H:i',
        });

        // After selecting Date/Time -> Hide Date/Time Picker List 
        $('.time-picker , .date-picker').on('change', function () {
            $('.xdsoft_datetimepicker').hide();
        });

        // Geo Location Search
        window.gll_search_map = function () {
            var vals;
            vals = $('#loc-add').val();
            $('.gllpSearchField').val(vals);
        }

        // Auto Complete Places
        $("#loc-address").geocomplete()
                .bind("geocode:result", function (event, result) {
                    $.log(result.formatted_address);
                })
                .bind("geocode:error", function (event, status) {
                    $.log("ERROR: " + status);
                })
                .bind("geocode:multiple", function (event, results) {
                    $.log("Multiple: " + results.length + " results found");
                });

        $.log = function (message) {
            var $logger = $("#loc-address");
            $logger.val(message);
        }

        // Map Button Trigger On Page Load
        setTimeout(function () {
            $("input.gllpSearchButton").trigger('click');
        }, 10);

        $('.gllpSearchButton').on('hover', function () {
            var item_val = $('#loc-address').val();
            $('#loc-add').val(item_val);
            gll_search_map();
        });

        // Hide & Show Location Map Options 
        $('#location-map').on('click', function () {
            if (true === $("#location-map").prop('checked')) {
                $('.gllpLatlonPicker').hide();
            }
            else {
                $('.gllpLatlonPicker').show();
            }
        });

        //  Toggle Settings Option's Tabs
        window.toggleDiv = function (id) {

            $(".sub-menu li").removeClass('active');
            var items = $(".sub-menu").find('a[href="' + id + '"]');
            items.parents('li').addClass('active');
            items.addClass('active');
            $('.main-content').children().not('#submit_btn').hide();
            $(id).fadeIn(200);
            location.hash = id + "-show";
        }

        var hash = window.location.hash.substring(1);
        var id = hash.split("-show")[0];
        if (id) {
            $(".sub-menu li").removeClass('active');
            var items = $(".sub-menu").find('a[href="' + id + '"]');
            items.parents('li').addClass('active');
            $('.main-content').children().not('#submit_btn').hide();
            $("#" + id).show();
        }

        // Wp Color Picker        
        $('.sep-color-picker').wpColorPicker();
        $(".sep-color-list .wp-picker-container:first-child").append("<div class='sep-color-label'><label>BG Color</label></div>");
        $(".sep-color-list .wp-picker-container:last-child").append("<div class='sep-color-label'><label>Font Color</label></div>");

        // Save Settings Options
        window.sep_event_option_save = function (admin_url) {
            $('.loading_div').fadeIn(100);
            var dataString = $('#optioin_frm').serialize();
            $.ajax({
                type: 'POST',
                url: admin_url,
                data: dataString,
                success: function (response) {
                    $('.loading').hide();
                    $('.form-msg').slideDown();
                    window.location.reload(false);

                }
            });
        }

        // Add Event Segments Field
        var rowNum = 1;
        window.addRow = function (frm) {
            rowNum++;
            var row = '<p id="rowNum' + rowNum + '">\n\
        <input type="text" name="custom[add_seg][]" value=""> \n\
        <input type="button" value="Remove" class="button button-primary" onclick="removeRow(' + rowNum + ');"> </p>';
            $('#itemRows').append(row);
        }

        // Remove Event Segment Field
        var rowNum = 1;
        window.removeRow = function (rnum) {
            if (rnum == 1) {
                document.getElementById(1).style.visibility = 'hidden';
                alert('You can not remove defualt row');
            } else {
                $('#rowNum' + rnum).remove();
            }
        }

        /** 
         * Event Options -> On Input Email Validation 
         * 
         * @since 1.1.0          
         */
        $('#event-organiser-email').on('input', function () {
            var input = $(this);
            var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            var is_email = re.test(input.val());
            var error_element = $("span", $(this).parent());
            if (is_email) {
                input.removeClass("invalid").addClass("valid");
                error_element.removeClass("error-show").addClass("sep-invalid-email");
                $('.sep-invalid-email').hide();
            }
            else {
                input.removeClass("valid").addClass("invalid");
                $('.sep-invalid-email').show();
            }
        });

        /** 
         * Event Options -> On Input Phone Validation 
         * 
         * @since 1.1.0          
         */
        $('#event-organiser-contact').on('input', function () {

            var input = $(this);
            var re = /^\+?([0-9]{2})\)?[-. ]?([0-9]{1,4})[-. ]?([0-9]{1,4})?[-. ]?([0-9]{1,4})$/;
            var isValid = re.test(input.val());
            var error_element = $("span", $(this).parent());
            if (isValid) {
                input.removeClass("invalid").addClass("valid");
                error_element.removeClass("error-show").addClass("sep-invalid-phone");
                $('.sep-invalid-phone').hide();
            } else {
                input.removeClass("valid").addClass("invalid");
                $('.sep-invalid-phone').show();
            }
        });

        /** 
         * Event Options -> Reset Button
         * 
         * @since 1.4.0          
         */
        $("#reset").on('click', function () {
            $("#tab-event-options .form-elements").find(':input').each(function () {
                if ('text' === this.type || 'tel' === this.type || 'email' === this.type || 'select-one' === this.type) {
                    $(this).val('');
                }
                else if (this.type == 'checkbox' || this.type == 'radio') {
                    this.checked = false;
                }
            });
        });

        /*
         * Visual Layout Option -> Drag & Drop between two columns
         * 
         * @since 1.4.0
         */
        if ($('#vl-col-one').length) {
            var col_1 = $('#vl-col-one');
            var col1 = col_1[0];
            var col1_order = new Sortable(col1, {
                group: "visual_layout",
                onSort: function (e) {
                    var items = e.to.children;
                    var result = [];
                    var listLength = col_1.children().length;
                    for (var i = 0; i < items.length; i++) {
                        result.push($(items[i]).data('id'));
                    }
                    $(".visuaplayoutCol02").val('');
                    $('.visuaplayoutCol02').attr('value', result);
                },
                disabled: false,
            });
        }


        if ($('#vl-col-two').length) {
            var col_2 = $('#vl-col-two');
            var col2 = col_2[0];
            var col2_order = new Sortable(col2, {
                group: "visual_layout",
                onSort: function (e) {
                    var items = e.to.children;
                    var result = [];
                    var listLength = col_2.children().length;
                    for (var i = 0; i < items.length; i++) {
                        result.push($(items[i]).data('id'));
                    }
                    $(".visuaplayoutCol01").val('');
                    $('.visuaplayoutCol01').attr('value', result);
                },
                disabled: false,
            });
        }

        /** 
         * Visual Layout Options -> Reset Button
         * 
         * @since 1.4.0           
         */

        // Default Values for Column 1
        var default1 = ['event_date', 'event_details', 'event_schedule', 'event_segments'];

        // Default Values for Column 2
        var default2 = ['event_title', 'event_image', 'event_description', 'event_venue'];

        // Restore default list
        $('.reset-style').on('click', function () {
            
            $("#vl-col-one").empty();
            for (var x = 0; x < default1.length; x++) {
                $("#vl-col-one").append('<li data-id="' + default1[x] + '" class="item default-item-1">' + default1[x].replace("_", " ").replace(default1[x].charAt(0), default1[x].charAt(0).toUpperCase()).replace(default1[x].charAt(6), default1[x].charAt(6).toUpperCase()) + '</li>');
            }
            $(".visuaplayoutCol01").val('event_title,event_image,event_description,event_venue');
            $("#vl-col-two").empty();
            for (var x = 0; x < default2.length; x++) {
                $("#vl-col-two").append('<li data-id="' + default2[x] + '" class="item default-item-2">' + default2[x].replace("_", " ").replace(default2[x].charAt(0), default2[x].charAt(0).toUpperCase()).replace(default2[x].charAt(6), default2[x].charAt(6).toUpperCase()) + '</li>');
            }
            $(".visuaplayoutCol02").val('event_date,event_details,event_schedule,event_segments');
        });
    });
})(jQuery);