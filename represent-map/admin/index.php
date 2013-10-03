<?php
$page = "index";
include "header.php";
define('WP_USE_THEMES', false);
//require_once( 'C:\/wamp\/www\/desarrollo\/wp-load.php' );
require_once("/var/www/sportyguest/wp-load.php");
require_once("../include/evento.php");
require_once("../include/db.php");
global $wpdb;

// hide marker on map
if($task == "hide") {
  $place_id = htmlspecialchars($_GET['place_id']);
  Evento::hide($wpdb, $place_id);
  header("Location: index.php?view=$view&search=$search&p=$p");
  exit;
}

// show marker on map
if($task == "approve") {
  $place_id = htmlspecialchars($_GET['place_id']);
  Evento::approve($wpdb, $place_id);
  header("Location: index.php?view=$view&search=$search&p=$p");
  exit;
}

// completely delete marker from map
if($task == "delete") {
  $place_id = htmlspecialchars($_GET['place_id']);
  Evento::delete($wpdb, $place_id);
  header("Location: index.php?view=$view&search=$search&p=$p");
  exit;
}

// paginate
$items_per_page = 15;
$page_start = ($p-1) * $items_per_page;
$page_end = $page_start + $items_per_page;

// get results
if($view == "approved") {
  $places = Evento::getEventsApproved($wpdb, $page_start, $items_per_page);
  $total = $total_approved;
} else if($view == "rejected") {
  $places = Evento::getEventsRejected($wpdb, $page_start, $items_per_page);
  $total = $total_rejected;
} else if($view == "pending") {
  $places = Evento::getEventsPending($wpdb, $page_start, $items_per_page);
  $total = $total_pending;
} else if($view == "") {
  $places = Evento::getEventsSortByName($wpdb, $page_start, $items_per_page);
  $total = $total_all;
}
if($search != "") {
  $places = Evento::getEventsByName($wpdb, $search, $page_start, $items_per_page);
  $total = Evento::getCountByName($wpdb, $search); 
}

echo $admin_head;
?>


<div id="admin">
  <h3>
    <?php if($total > $items_per_page) { ?>
      <?php echo $page_start+1; ?>-<?php if($page_end > $total) { echo $total; } else { echo $page_end; } ?>
      of <?php echo $total;?> markers
    <?php } else { ?>
      <?php echo $total;?> markers
    <?php } ?>
  </h3>
  <ul>
    <?php
      foreach($places as $place) {
        $place->url = str_replace("http://", "", $place->url);
        $place->url = str_replace("https://", "", $place->url);
        $place->url = str_replace("www.", "", $place->url);
        echo "
          <li>
            <div class='options'>
              <a class='btn btn-small' href='edit.php?place_id=$place->id&view=$view&search=$search&p=$p'>Edit</a>
              ";
              if($place->approved == 1) {
                echo "
                  <a class='btn btn-small btn-success disabled'>Approve</a>
                  <a class='btn btn-small btn-inverse' href='index.php?task=hide&place_id=$place->id&view=$view&search=$search&p=$p'>Reject</a>
                ";
              } else if(is_null($place->approved)) {
                echo "
                  <a class='btn btn-small btn-success' href='index.php?task=approve&place_id=$place->id&view=$view&search=$search&p=$p'>Approve</a>
                  <a class='btn btn-small btn-inverse' href='index.php?task=hide&place_id=$place->id&view=$view&search=$search&p=$p'>Reject</a>
                ";
              } else if($place->approved == 0) {
                echo "
                  <a class='btn btn-small btn-success' href='index.php?task=approve&place_id=$place->id&view=$view&search=$search&p=$p'>Approve</a>
                  <a class='btn btn-small btn-inverse disabled'>Reject</a>
                ";
              }
              echo "
              <a class='btn btn-small btn-danger' href='index.php?task=delete&place_id=$place->id&view=$view&search=$search&p=$p'>Delete</a>
            </div>
            <div class='place_info'>
              <a href='http://$place->url' target='_blank'>
                " . utf8_decode($place->name) . "
                <span class='url'>
                  $place->url
                </span>
              </a>
            </div>
          </li>
        ";
      }
    ?>
  </ul>
  
  <?php if($p > 1 || $total >= $items_per_page) { ?>
    <ul class="pager">
      <?php if($p > 1) { ?>
        <li class="previous">
          <a href="index.php?view=<?php echo $view;?>&search=<?php echo $search;?>&p=<?php echo $p-1; ?>">&larr; Previous</a>
        </li>
      <?php } ?>
      <?php if($total >= $items_per_page * $p) { ?>
        <li class="next">
          <a href="index.php?view=<?php echo $view;?>&search=<?php echo $search;?>&p=<?php echo $p+1; ?>">Next &rarr;</a>
        </li>
      <?php } ?>
    </ul>
  <?php } ?>

</div>


<?php echo $admin_foot ?>