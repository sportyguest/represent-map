<?php
include_once "header.php";
//define( 'SHORTINIT', true );
//require_once( 'C:\/wamp\/www\/desarrollo\/wp-load.php' );
require_once("/var/www/sportyguest/wp-load.php");
require_once ("include/evento.php");
require_once("include/email.php");


// This is used to submit new markers for review.
// Markers won't appear on the map until they are approved.
  // Avoid backslash in front of quotes
$_POST = array_map('stripslashes_deep', $_POST);
$image_name = "";
if (isset($_FILES["image"]) && isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"])) {
  $image_name = Evento::createImageName($_FILES["image"]["name"]);
  move_uploaded_file($_FILES["image"]["tmp_name"], Evento::IMAGES_PATH . $image_name);
}
$owner_name = $_POST['owner_name'];
$owner_email = $_POST['owner_email'];
$title = $_POST['title'];
$category = $_POST['category'];
$address = $_POST['address'];
$description = $_POST['description'];
$date = $_POST['datepicker'];
$web = $_POST['uri'];
$subcategory = $_POST['subcategory'];
$price = $_POST['price'];

$errors = array();
// validate fields
if (empty($owner_name)) {
  $errors["owner_name"] = 1;
}
if (empty($owner_email)) {
  $errors["owner_email"] = 1;
}
if(empty($address)) {
  $errors["address"] = 1;
}
if (empty($title)) {
  $errors["title"] = 1;
}
if (empty($category)) {
  $errors["category"] = 1;
}
if (empty($description)) {
  $errors["description"] = 1;
}
if (empty($subcategory)) {
  $errors["subcategory"] = 1;
}
if (empty($date)) {
  $errors["datepicker"] = 1;
}
if (empty($web)) {
  $errors["uri"] = 1;
}
if (strlen($price) == 0 || !is_numeric(str_replace("€", "", $price))) {
  $errors["price"] = 1;
}
if (empty($image_name)) {
  $errors["image"] = 1;
}
if (!empty($errors)) {
  echo json_encode(array( "code" => "fail", 
                          "msg" => "Te has dejado algún campo vacío, inténtalo de nuevo.", 
                          "errors" => $errors));
  exit;
}

// If there aren't missing parameters data is stored
$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address)."&sensor=false";
$result_string = file_get_contents($url);
$result = json_decode($result_string, true);
list($lat, $long) = $result['geometry']['location'];
$lat = $result['results'][0]['geometry']['location']['lat'];
$lng = $result['results'][0]['geometry']['location']['lng'];
$image_url = "";
if (isset($_FILES["image"]) && isset($_FILES["image"]["name"])) {
  $image_url = Evento::createImageURL("http://eventosdeportivos.sportyguest.es/", $image_name);
}

$evento = new Evento($owner_name, $owner_email, $title, $image_url, $price, $description, $web, $address, $lat, $lng, $category, $subcategory, $date);
$evento->saveDB($wpdb);
Email::notifyEventCreated($evento);

$respuesta = array('code'=>'success');
echo json_encode($respuesta);
?>
