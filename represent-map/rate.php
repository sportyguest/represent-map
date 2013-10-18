<?php

define( 'SHORTINIT', true );
//require_once( 'C:\/wamp\/www\/desarrollo\/wp-load.php' );
require_once("/var/www/sportyguest/wp-load.php");
require_once("include/rating.php");

$ip = $_SERVER['REMOTE_ADDR'];
$rate = $_POST["rate"];
$event_id = $_POST["event_id"];

if (empty($rate) || empty($event_id)) {
	exit;
}

$rating = new Rating($event_id, $rate, $ip);
if (!Rating::isIP($wpdb, $event_id, $ip)) {
	$rating->saveDB($wpdb);
}

?>