<?php
$page = "index";
include "header.php";
define( 'SHORTINIT', true );
//require_once( 'C:\/wamp\/www\/desarrollo\/wp-load.php' );
require_once("/var/www/sportyguest/wp-load.php");
require_once("../include/evento.php");
require_once("../include/db.php");
require_once("../include/email.php");
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
  // Notify
  Email::notifyEventApproved(Evento::getEvent($wpdb, $place_id));
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
$consulta = "SELECT evento_id, COUNT(evento_id) count FROM wp_evento_me_gusta GROUP BY evento_id";
$me_gusta = $wpdb->get_results($consulta);
$consulta = "SELECT evento_id, COUNT(evento_id) count FROM wp_evento_asistire GROUP BY evento_id";
$asistire = $wpdb->get_results($consulta);
$consulta = "SELECT evento_id, COUNT(evento_id) count FROM wp_evento_me_gustaria_participar GROUP BY evento_id";
$me_gustaria_participar = $wpdb->get_results($consulta);
$consulta = "SELECT evento_id, COUNT(evento_id) count FROM wp_evento_participacion GROUP BY evento_id";
$participacion = $wpdb->get_results($consulta);

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
        $count_me_gusta = array_filter($me_gusta,
          function($item) use($place) {
            return $item->evento_id == $place->id;
          }
        )[0]->count;
        $count_asistire = array_filter($asistire, 
          function($item) use($place) {
            return $item->evento_id == $place->id;
          }
        )[0]->count;
        $count_me_gustaria_participar = array_filter($me_gustaria_participar,
          function($item) use($place) {
            return $item->evento_id == $place->id;
          }
        )[0]->count;
        $count_participacion = array_filter($participacion,
          function($item) use($place) {
            return $item->evento_id == $place->id;
          }
        )[0]->count;
        if (empty($count_me_gusta)) {
          $count_me_gusta = 0;
        }
        if (empty($count_asistire)) {
          $count_asistire = 0;
        }
        if (empty($count_me_gustaria_participar)) {
          $count_me_gustaria_participar = 0;
        }
        if (empty($count_participacion)) {
          $count_participacion = 0;
        }
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
              <span title='Like'>(L:" . $count_me_gusta . ")</span>
              <span title='Asistiré'>(A:" . $count_asistire . ")</span>
              <span title='Han participado'>(P:" . $count_participacion . ")</span>
              <span title='Les gustaría participar'>(GP:" . $count_me_gustaria_participar . ")</span>
            </div>
          </li>
        ";
      }
    ?>
  </ul>
  
  <?php if($p > 1 || $total >= $items_per_page) { ?>
	<ul class="pagination">
		<?php 
			if ($p <= 1) {
				$class = "disabled";
			} else {
				$href = "index.php?view=' . $view . '&search=' . $search . '&p=' . ($p - 1) . '";
			}
			echo "<li class='" . $class . "'><a href='" . $href . "'>&laquo;</a></li>";
		?>
		<?php for($i = 0; $total >= $items_per_page * $i; $i++) { ?>
			<?php
				if ($p == $i + 1) {
					$class = "active";
					$href = "";
				} else {
					$class = "";
					$href = 'index.php?view=' . $view . '&search=' . $search . '&p=' . ($i + 1);
				}
				echo "<li class='" . $class . "'><a href='" . $href . "'>" . ($i + 1) . "</a></li>";
			?>
		<?php } ?>
		<?php
			if ($total <= $items_per_page * $p) {
				$class = "disabled";
				$href = "";
			} else {
				$class = "";
				$href = 'index.php?view=' . $view . '&search=' . $search . '&p=' . ($p + 1);
			}
			echo "<li class='" . $class . "'><a href='" . $href . "'>&raquo;</a></li>";
		?>
	</ul>
  <?php } ?>

</div>

<?php echo $admin_foot ?>