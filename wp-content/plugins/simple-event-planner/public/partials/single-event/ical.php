<?php
/**
 * Template contains iCalndar for event detail page.
 *
 * Override this template by copying it to yourtheme/simple_event_planner/single-event/ical.php
 * 
 * @version     1.0.1
 * @since       1.3.0
 * @since       1.4.0 Updated iCal template with more attributes
 * @author      PressTigers
 * @package     Simple_Event_Planner
 * @subpackage  Simple_Event_Planner/public/partials/single-event
 */
//set correct content-type-header
header( 'Content-type: text/calendar; charset=utf-8' );
header( 'Content-Disposition: inline; filename=calendar.ics' );

//Get Perameters to Create iCal File.
$uid = $_GET['uid'];
$link = $_GET['url'];
$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];
$subject = $_GET['subject'];
$location = $_GET['location'];
$sepVersion = $_GET['sep_version'];
$pluginName = 'Simple Event Planner';
$full_format = 'Ymd\THis';
$dateStamp = date( $full_format, time() );
$siteName = $_GET['site_name'];
$siteURL = $_GET['site_url'];
$eventDescription = $_GET['description'];
$ical = "BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//" . $siteName . " - ECPv" . $sepVersion . "//NONSGML v1.0//EN
CALSCALE:GREGORIAN
METHOD:PUBLISH
X-WR-CALNAME:" . $siteName . "
X-ORIGINAL-URL:" . $siteURL . "
X-WR-CALDESC:" . $pluginName . "
BEGIN:VEVENT
SUMMARY:" . $subject . "
Description:" . $eventDescription . "
URL:" . $link . "
DTSTART:".$startDate."
DTEND:".$endDate."
DTSTAMP:" . $dateStamp . "
UID:" . $uid . "
LOCATION:".$location."
END:VEVENT
END:VCALENDAR";
echo $ical;
exit;