<?php
include "../include/db.php";
include "../include/evento.php";
define( 'SHORTINIT', true );
//require_once('C:\/wamp\/www\/desarrollo\/wp-load.php' );
require_once("/var/www/sportyguest/wp-load.php");
global $wpdb;

// get task
if(isset($_GET['task'])) { $task = $_GET['task']; } 
else if(isset($_POST['task'])) { $task = $_POST['task']; }

// get view
if(isset($_GET['view'])) { $view = $_GET['view']; } 
else if(isset($_POST['view'])) { $view = $_POST['view']; }
else { $view = ""; }

// get page
if(isset($_GET['p'])) { $p = $_GET['p']; } 
else if(isset($_POST['p'])) { $p = $_POST['p']; }
else { $p = 1; }

// get search
if(isset($_GET['search'])) { $search = $_GET['search']; } 
else if(isset($_POST['search'])) { $search = $_POST['search']; }
else { $search = ""; }

// make sure admin is logged in
if($page != "login") {
  if($_COOKIE["representmap_user"] != crypt($admin_user, $admin_user) OR $_COOKIE["representmap_pass"] != crypt($admin_pass, $admin_pass)) {
    header("Location: login.php");
    exit;
  }
}
// get marker totals
$total_approved = Evento::getApprovedCount($wpdb);
$total_rejected = Evento::getRejectedCount($wpdb);
$total_pending = Evento::getPendingCount($wpdb);
$total_all = Evento::getTotalCount($wpdb);

// admin header
$admin_head = "
  <html>
  <head>
    <title>RepresentMap Admin</title>
    <link href='../bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css' />
    <link href='../bootstrap/css/bootstrap-responsive.min.css' rel='stylesheet' type='text/css' />
    <link rel='stylesheet' href='admin.css' type='text/css' />
    <script src='../scripts/jquery-1.7.1.js' type='text/javascript' charset='utf-8'></script>
    <script src='https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false' type='text/javascript' charset='utf-8'></script>
    <link rel='stylesheet' media='only screen and (max-device-width: 480px)' href='../mobile.css' type='text/css' />
    <script src='../bootstrap/js/bootstrap.min.js' type='text/javascript' charset='utf-8'></script>
    <script src='http://code.jquery.com/ui/1.10.3/jquery-ui.js'></script>
    <link rel='stylesheet' href='http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css' />
  </head>
  <body>
";
if($page != "login") {
  $admin_head .= "
    <div class='navbar navbar-fixed-top'>
      <div class='navbar-inner'>
        <div class='container'>
          <a class='brand' href='index.php'>
            RepresentMap
          </a>
          <ul class='nav'>
            <li"; if($view == "") { $admin_head .= " class='active'"; } $admin_head .= ">
              <a href='index.php'>All Listings</a>
            </li>
            <li"; if($view == "approved") { $admin_head .= " class='active'"; } $admin_head .= ">
              <a href='index.php?view=approved'>
                Approved
                <span class='badge badge-info'>$total_approved</span>
              </a>
            </li>
            <li"; if($view == "pending") { $admin_head .= " class='active'"; } $admin_head .= ">
              <a href='index.php?view=pending'>
                Pending
                <span class='badge badge-info'>$total_pending</span>
              </a>
            </li>
            <li"; if($view == "rejected") { $admin_head .= " class='active'"; } $admin_head .= ">
              <a href='index.php?view=rejected'>
                Rejected
                <span class='badge badge-info'>$total_rejected</span>
              </a>
            </li>
          </ul>
          <form class='navbar-search pull-left' action='index.php' method='get'>
            <input type='text' name='search' class='search-query' placeholder='Search' autocomplete='off' value='$search'>
          </form>
          <ul class='nav pull-right'>
            <li><a href='login.php?task=logout'>Sign Out</a></li>
          </ul>
        </div>
      </div>
    </div>
  ";
}
$admin_head .= "
  <div id='content'>
";

// admin footer 
$admin_foot = "
    </div>
  </body>
</html>
";




?>