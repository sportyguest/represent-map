<?php
include_once "header.php";
define('WP_USE_THEMES', false);
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php' );
require_once ("include/evento.php");


// This is used to submit new markers for review.
// Markers won't appear on the map until they are approved.

$name = $_POST['title'];
$category = $_POST['category'];
$address = $_POST['address'];
$city = $_POST['city'];
$description = $_POST['description'];
$date = $_POST['datepicker'];
$web = $_POST['uri'];
$subcategory = $_POST['subcategory'];


// validate fields
if(empty($address) || empty($name) || empty($category) ||  empty($description)) {
  $respuesta = array('code'=> 1, 'mensaje'=> "Te has dejado un campo vacío, inténtalo de nuevo");
  echo json_encode($respuesta);
  exit;
} else {
  $address_and_city = $address . ", " . $city;
  $url = "http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address_and_city)."&sensor=false";
  $result_string = file_get_contents($url);
  $result = json_decode($result_string, true);
  list($lat, $long) = $result['geometry']['location'];
  $lat = $result['results'][0]['geometry']['location']['lat'];
  $lng = $result['results'][0]['geometry']['location']['lng'];

  $evento = new Evento($name, $description, $web, $address_and_city, $lat, $lng, $category, $subcategory, $date);
  $evento->guardarDB($wpdb);

  $respuesta = array('code'=>'success');
  echo json_encode($respuesta);
  exit;
}
?>
