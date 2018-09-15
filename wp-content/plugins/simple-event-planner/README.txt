=== Simple Event Planner ===
Contributors: PressTigers
Donate link: http://www.presstigers.com
Tags: events, facebook, listing, venue, event calendar, seminar, presentation, event schedule, iCal, Google Calendar, event management
Requires at least: 4.5
Requires PHP : 5.6
Tested up to: 4.9.2
Stable tag: 1.4.0
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

A powerful & flexible plugin to create event listing and event calendar on your website in a simple & elegant way.

== Description ==
The plugin is available in English, Russian(Русский), German(Deutsch), Polish(Polski) and Serbian(Српски језик).

= Are you looking for easy, user-friendly and robust event management plugin? = 

Simple Event Planner by <a href="https://www.presstigers.com">PressTigers</a> is a next generation, lightweight event management plugin that list facebook/WP events and calendar to your WordPress website.

This plugin is used to manage & display various events within the site. It has various options, including events from different categories. Whether you have; a single event or multiple events, you can display it as a list or in calendar format by simply inserting shortcode i.e. [event_listing], [event_calendar]. 

Additionally, you can add event calendar on your WordPress website by simply inserting shortcode [event_calendar], making it extremely powerful and flexible. 

The plugin allows to have a specific number of upcoming events arranged in calendar list along with search feature to search events by event location.

= Facebook Shortcode =
`[sep_fb_event_listing]`

= Plugin Features =

* Create Events Quickly
* Time Zone Settings for Events
* Unlimited Event Segments
* Show/Hide Event's Options
* List View
* Grid View
* Calendar View
* Search Event by Title (List View)
* Search Event by Location (Calendar View)
* Events Categories (Taxonomies)
* Responsive Layout
* Localization (Translation Ready)
* Unlimited Color Combinations
* Shortcode Builder
* Google Maps for Event Location
* Template Layout Settings
* Image Enable/Disable
* Time Format Settings
* Date Format Settings
* iCal Calendar
* Google Calendar
* Facebook Event Listing(With grid & list views.)
* Visual Layout Settings

= Event Planner Templating = 

With event planner templating exciting feature you can change the following file templates.

* content-wrapper-start.php
* content-wrapper-end.php
* event-listings-start.php
* event-listings-end.php
* content-event-listing.php
* content-no-events-found.php
* content-single-event-listing.php
* event-schedule.php
* event-description.php
* event-details.php
* event-venue.php
* single-event-listing.php
* event-search.php
* calendar-search.php
* archive-event-listing.php
* event-pagination.php

1. To change a template, please add "simple_event_planner" folder at default theme root directory.
1. Add above mentioned file from plugin simple-event-planner > public > partials folder keeping the same file directory structure (as mentioned in the header of each file) and customize it based on your needs.

= Can you contribute? =
If you are an awesome contributor to translations or plugin development, please contact us at support@presstigers.com

== Installation ==

1. Upload `simple-event-planner.zip` to the `/wp-content/plugins/` directory to your web server.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Add a standard WordPress page or post and use [event_listing] shortcode in the editor to make it events list.
4. Add a standard WordPress page or post and use [event_calendar] shortcode in the editor to make it event calendar.

== Frequently Asked Questions ==

= How to create event list? =
In your WordPress admin panel, go to "Event Planner" menu and add a new event. All the event listing will be shown in the admin panel and on the front-end.

= How to show event list on the front-end? = 
To list all the event list, add  [event_listing] shortcode in an existing page or add a new page and write shortcode anywhere in the page editor.

= How to change the layout of event listing using a shortcode? = 
To change the event listing view, add [event_listing events_layout="grid"] or [event_listing events_layout="list"] shortcode in an existing page or add a new page and write shortcode anywhere in the page editor.

= How to show event calendar on the front-end? = 
To list event calendar , add [event_calendar] shortcode in an existing page or add a new page and write shortcode anywhere in the page editor.

= What language files are available? =
You can view (and contribute) translations via the <a target='_blank' href="https://translate.wordpress.org/projects/wp-plugins/simple-event-planner"> translate.wordpress.org </a>.

= Can I display event list for particular "category" using a shortcode? = 
Yes, you can use shortcode on post/page i.e [event_listing event_category="category-slug"]

= Can I show event list of Calendar for particular "category" using a shortcode? = 
Yes, you can use a shortcode on post page i.e , [event_calendar event_category="category-slug"]

= Can I show only 5 latest events on front-end with pagination? =
Yes, you can show any number of events on your website with pagination feature by using shortcode with "events_limit" attribute i.e. [event_listing events_limit="5"]

= Can I show only 5 latest events of a calendar on front-end? = 
Yes, you can show any number of events on your website by using shortcode with "events_limit" attribute i.e [event_calendar events_limit="5"]

= Can I show only 5 latest facebook events on front-end with pagination? =
Yes, you can show any number of events with cursor based pagination by using shortcode with "limit" attribute i.e. [sep_fb_event_listing limit="5"]

= Can I turn off calendar search bar? = 
Yes, you turnoff search bar with "search" attribute i.e [event_calendar search="false"]

= Can I turn off event list search bar? = 
Yes, you can turn off search bar with "search" attribute i.e [event_listing search="false"]

== Changelog ==

= 1.4.0 =

* Feature - Added Serbian translation.
* Feature - Added Facebook events listing.
* Feature - Added Social settings tab for Facebook API keys.
* Feature - Added visual layout settings to move event details' sections through drag and drop.
* Feature - Added timezone option in the admin area of event detail page.
* Feature - Added options for container class and Id under Template settings.
* Fix - Resolved the theme styling conflicts for event pages.
* Fix - Removed event counter for past event.
* Fix - Fixed iCal DateTime issue for Apple devices.
* Fix - Removed the "Add to Google Calendar" & "Add to iCal" links when no date is selected.
* Fix - Balanced counter layout with the image.
* Fix - Resolved the map location search issue.
* Fix - Visually balanced the event segments layout in meta box.
* Note - Removed single_event_listing_end action hook from simple-event-planner-template-functions.php file and single-event-listing.php.

= 1.3.4 =
WP 4.9 Compatibility - Resolved the color picker issue in settings color options tab.
Tweak - Localized the calendar strings and updated .pot file.
Fix- Fixed the date translation for non-English languages.

= 1.3.3 =
* Feature - Added Polish translation.
* Tweak - Changed the event timings format to Hours:Minutes(H:M).
* Fix - Added missing patterns for organizer phone number.
* Fix - Added missing phrases in the .pot language file.
* Fix - Localized the hard-coded strings.
* Fix - Fixed the settings tabs toggling issue for none-English sites.

= 1.3.2 =
* Fix - Fixed the WP text editor content ordering issue.
* Fix - Resolved the admin CSS conflict with other plugins.

= 1.3.1 =
* Feature - Added venue/map placement setting.
* Tweak - Minor CSS change.
* Note - Added PressTigers logo branding in footer of admin pages.

= 1.3.0 =
* Tweak - Revamped the whole HTML structure of SEP plugin.
* Feature - Added grid layout.
* Feature - Added shortcode parameter for event listing views ( list or grid view ).
* Feature - Added settings for image hide/show.
* Feature - Added settings for event archive listing layout ( list view or grid view ).
* Feature - Added settings for date & time format. 
* Feature - Added Russian & German translation.
* Feature - Added plugin level templating.
* Feature - Event can be added to Google calendar & iCal.
* Note - Improved plugin security.

= 1.2.2 =
* Fix - Resolved minor calendar layout issues.
* Fix - Trimmed content in different labels & descriptions.
* Fix - Resolved front-end map loading issue.

= 1.2.1 =
* Fix - Critical issue resolved in event listing & calendar shortcode.

= 1.2.0 =
* Feature - General settings for event listing, event detail page & calendar to change colors.
* Feature - Revamped the event listing page design.
* Feature - Revamped the event calendar page design.

= 1.1.0 =
* Feature - Added Google map for event location.    
* Feature - Introduced templating.
* Feature - Introduced settings.
* Feature - Typography settings for event listing, event detail page & calendar.
* Feature - GMap API key settings.
* Feature - Added event title search for event listing.
* Feature - Added event detail and archive template pages. 
* Feature - Event's all detail can hide or show from admin site.
* Feature - Added time zone for events.
* Feature - Added multiple segments for an event.
* Feature - Revised the event listing and event detail page design.
* Feature - Revised the event calendar page design. 
* Feature - Added event planner shortcodes generator in TinyMCE editor.
* Feature - Ready for translation.
* Feature - Added pagination for event listing.
* Fix - Closed the jQuery datepicker for event start & end date after selecting a date.
* Fix - Closed the jQuery timepicker list for event start & end time after selecting time.

= 1.0.0 =
* First release

== Screenshots ==

1. **Event Options** - Let the user fill details of an event.
2. **Event Location** - Let the user fill event location and set its map.
3. **Event Categories** - List of Categories (Taxonomies)
4. **Event List Creation** - Allow users to create event list with ease by using a shortcode. 
5. **Event Calendar Creation** - Allow users to create event calendar with ease by using a shortcode.
6. **Event Facebook List Creation** - Allow users to create facebook events with ease by using a shortcode.
7. **Event Color Options Settings** -  Customize color scheme of all three templates. 
8. **Event API Key Settings** -  Add API key to use GMap for location address.
9. **Event Template Settings** -  Event Listing Configuration.
10. **Event Social Settings** -  Facebook Event Listing Configuration.
11. **Event Visual Layout Settings** -  Drag and drop event sections.
12. **Event List View** - Front-end list view of events.
13. **Event Grid View** - Front-end grid view of events.
14. **Event Detail Page** - Event detail/single page. Event details related to event location and its organizer are placed on it.
15. **Event Calendar** - Front-end view of the calendar with upcoming events listing.

== Upgrade Notice ==

= 1.4.0 =
 1.4.0 is a major update with the facebook event listing  and event sections' visual layouts features.