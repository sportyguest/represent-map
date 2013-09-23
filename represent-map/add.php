
<?php
include_once "header.php";
define('WP_USE_THEMES', false);
require_once( $_SERVER['DOCUMENT_ROOT'] . '/desarrollo/wp-blog-header.php' );
$path= "C:\/wamp\/www\/mapa\/represent-map\/include";
set_include_path(get_include_path(). PATH_SEPARATOR . $path);
require_once ("evento.php");


// This is used to submit new markers for review.
// Markers won't appear on the map until they are approved.

// $persona = mysql_real_escape_string(parseInput($_POST['persona']));
// $email = mysql_real_escape_string(parseInput($_POST['email']));
// $titulo = mysql_real_escape_string(parseInput($_POST['titulo']));
// $type = mysql_real_escape_string(parseInput($_POST['type']));
// $direccion = mysql_real_escape_string(parseInput($_POST['direccion']));
// $uri = mysql_real_escape_string(parseInput($_POST['uri']));
// $descripcion = mysql_real_escape_string(parseInput($_POST['descripcion']));
 //$localidad = mysql_real_escape_string(parseInput($_POST['localidad']));
echo $_POST;
var_dump($_POST); 

//$localidad=$_POST[localidad];


$nombreEvento=$_POST['title'];
$tipo=$_POST['type'];
$direccion=$_POST['address'];
$localidad=$_POST['address2'];
$descripcion=$_POST['description'];
$date=$_POST['date'];

//$fecha=$_POST['fecha'];


// validate fields
if(empty($direccion) || empty($nombreEvento) || empty($tipo) ||  empty($descripcion)) {
  echo "Te has dejado un campo vacío, inténtalo de nuevo.";
  exit;
  
} else {
  
  
  
  // if startup genome mode enabled, post new data to API
  if($sg_enabled) {
    
    try {
      @$r = $http->doPost("/organization", $_POST);
      $response = json_decode($r, 1);
      if ($response['response'] == 'success') {
        include_once("startupgenome_get.php");
        echo "success"; 
        exit;
      }
    } catch (Exception $e) {
      echo "<pre>";
      print_r($e);
    }
    
    
  // normal mode enabled, save new data to local db
  } else {

  $address = $direccion . ", " . $localidad;
                      $url = "http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address)."&sensor=false";
                      $result_string = file_get_contents($url);
                      $result = json_decode($result_string, true);
                      list($lat, $long) = $result['geometry']['location'];
                      
                      $lat = $result['results'][0]['geometry']['location']['lat'];
                      $lng = $result['results'][0]['geometry']['location']['lng'];
  $fecha=$_POST['fecha'];
    // insert into db, wait for approval
   // $insert = mysql_query("INSERT INTO places (approved, title, type, address, uri, description, owner_name, owner_email) VALUES (null, '$title', '$type', '$address', '$uri', '$description', '$owner_name', '$owner_email')") or die(mysql_error());

    // geocode new submission
   // $hide_geocode_output = true;
    //include "geocode.php";

  $evento = new Evento($nombre, $direccion,$lat,$lng,$tipo,$fecha);
 
$evento->guardarDB($wpdb);

    
    echo "success, $nombre, $direccion,$lat,$lng,$tipo,$fecha)";
    exit;
  
  }

  
}


?>
