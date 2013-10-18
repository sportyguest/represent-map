<?php
include_once "header.php";
define( 'SHORTINIT', true );
//require_once( $_SERVER['DOCUMENT_ROOT'] . '/desarrollo/wp-load.php' );
require_once("/var/www/sportyguest/wp-load.php");

require_once ("include/evento.php");
require_once ("include/experiencia.php");
require_once("include/db.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <!--
    This site was based on the Represent.LA project by:
    - Alex Benzer (@abenzer)
    - Tara Tiger Brown (@tara)
    - Sean Bonner (@seanbonner)
    
    Create a map for your startup community!
    https://github.com/abenzer/represent-map
    -->
    <title><?php echo $title_tag;?></title>
    <meta charset="UTF-8">
    <meta name="description" content="Mapa de eventos deportivos con el que podrás planificar tu calendario deportivo con deportes como maratón, ciclismo, esquí, carreras populares, zonas de escalada o running.">
    <link rel="publisher" href="https://plus.google.com/s/sportyguest"/>
    <!-- Twitter card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@sportyguest">
    <meta name="twitter:title" content="Mapa de eventos deportivos">
    <meta name="twitter:description" content="Mapa de eventos deportivos con el que podrás planificar tu calendario deportivo con deportes como maratón, ciclismo, esquí, carreras populares, zonas de escalada o running.">
    <meta name="twitter:creator" content="@sportyguest">
    <meta name="twitter:image:src" content="http://eventosdeportivos.sportyguest.es/images/preview.jpg">
    <meta name="twitter:domain" content="http://eventosdeportivos.sportyguest.es/">
    <!-- End twitter card -->
    <!-- Facebook -->
    <meta property="og:image" content="http://eventosdeportivos.sportyguest.es/images/preview.jpg" />
    <meta property="og:title" content="Mapa de eventos deportivos" />
    <meta property="og:description" content="Mapa de eventos deportivos con el que podrás planificar tu calendario deportivo con deportes como maratón, ciclismo, esquí, carreras populares, zonas de escalada o running." />
    <!-- End Facebook -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700|Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="./bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="map.css?nocache=289671982568" type="text/css" />
    <link rel="stylesheet" media="only screen and (max-device-width: 480px)" href="mobile.css" type="text/css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="./bootstrap/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="./bootstrap/js/bootstrap-typeahead.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
    <script type="text/javascript" src="./scripts/label.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" href="./bootstrap/css/bootstrap-fileupload.min.css" />
    <script src="./bootstrap/js/bootstrap-fileupload.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="./scripts/jquery.cookie.min.js" type="text/javascript" charset="utf-8"></script>
    
    <!-- Code to show the list of addresses -->
    <style>
      .pac-container {
          background-color: #FFF;
          z-index: 20;
          position: fixed;
          display: inline-block;
          float: left;
      }
      .modal{
          z-index: 20;   
      }
      .modal-backdrop{
          z-index: 10;        
      }​
    </style>

    <!-- Código de analytics -->
    <script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-41031859-1']);
      _gaq.push(['_setDomainName', 'sportyguest.es']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

    </script>
    <!-- Fin analytics -->
    
    <script type="text/javascript">
      var map;
      var infowindow = null;
      var gmarkers = [];
      var markerTitles =[];
      var highestZIndex = 0;  
      var agent = "default";
      var zoomControl = true;
      var prueba1;
      var prueba2;
      var prueba3;
      var latm = "40.40";
      var lonm = "-1.85";

      // detect browser agent
      $(document).ready(function(){
        if(navigator.userAgent.toLowerCase().indexOf("iphone") > -1 || navigator.userAgent.toLowerCase().indexOf("ipod") > -1) {
          agent = "iphone";
          zoomControl = false;
        }
        if(navigator.userAgent.toLowerCase().indexOf("ipad") > -1) {
          agent = "ipad";
          zoomControl = false;
        }
      }); 

      // resize marker list onload/resize
      $(document).ready(function(){
        resizeList() 
      });
      $(window).resize(function() {
        resizeList();
      });
      
      // resize marker list to fit window
      function resizeList() {
        newHeight = $('html').height() - $('#topbar').height();
        $('#list').css('height', newHeight + "px"); 
        $('#menu').css('margin-top', $('#topbar').height()); 
      }


      // initialize map
      function initialize() {
        // set map styles
        var mapStyles = [
         {
            featureType: "road",
            elementType: "geometry",
            stylers: [
              { hue: "#8800ff" },
              { lightness: 100 }
            ]
          },{
            featureType: "road",
            stylers: [
              { visibility: "off" },
              { hue: "#91ff00" },
              { saturation: -62 },
              { gamma: 1.98 },
              { lightness: 45 }
            ]
          },{
            featureType: "water",
            stylers: [
              { hue: "#005eff" },
              { gamma: 0.72 },
              { lightness: 42 }
            ]
          },{
            featureType: "transit.line",
            stylers: [
              { visibility: "off" }
            ]
          },{
            featureType: "administrative.locality",
            stylers: [
              { visibility: "on" }
            ]
          },{
            featureType: "administrative.neighborhood",
            elementType: "geometry",
            stylers: [
              { visibility: "simplified" }
            ]
          },{
            featureType: "landscape",
            stylers: [
              { visibility: "on" },
              { gamma: 0.41 },
              { lightness: 46 }
            ]
          },{
            featureType: "administrative.neighborhood",
            elementType: "labels.text",
            stylers: [
              { visibility: "on" },
              { saturation: 33 },
              { lightness: 20 }
            ]
          }
        ];

        // set map options
        var myOptions = {
          zoom: 6,
          //minZoom: 10,
          center: new google.maps.LatLng(latm,lonm), // HE escrito a mano, porque no me dejaba pasar el $latm como parametro
          mapTypeId: google.maps.MapTypeId.HYBRID,
          streetViewControl: true,
          mapTypeControl: true,
          panControl: false,
          zoomControl: zoomControl,
          styles: mapStyles,
          zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL,
            position: google.maps.ControlPosition.LEFT_CENTER
          }
        };
        prueba2=myOptions;
        map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);
        zoomLevel = map.getZoom();

        var input = /** @type {HTMLInputElement} */(document.getElementById('add_address'));
        var autocomplete = new google.maps.places.Autocomplete(input);

        // prepare infowindow
        infowindow = new google.maps.InfoWindow({
          content: "holding..."
        });

        // only show marker labels if zoomed in
        google.maps.event.addListener(map, 'zoom_changed', function() {
          zoomLevel = map.getZoom();
          if(zoomLevel <= 15) {
            $(".marker_label").css("display", "none");
          } else {
            $(".marker_label").css("display", "inline");
          }
        });

        // markers array: name, type (icon), lat, long, description, uri, address
        markers = new Array();
        <?php
          global $wpdb;
          $marker_id = 0;
          $approved_events = Evento::getEventsApproved($wpdb);
          $experiences = Experiencia::getExperiencias($wpdb);
          $experiences_events = array();
          foreach ($experiences as $experience) {
            $owner_name = "";
            $owner_email = "";
            $title = $experience->titulo;
            $description = $experience->descripcion;
            $url = "http://www.sportyguest.es/" . Experiencia::getURL($wpdb, $experience->experiencia_id, $experience->titulo);
            $address = trim(preg_replace('/\s+/', ' ', $experience->direccion));
            $lat = $experience->lat;
            $lng = $experience->lng;
            $image_url = "";
            $date = "";
            $category = "experiencia";
            $subcategory = "experiencia";
            array_push($experiences_events, new Evento($owner_name, 
                                                $owner_email, 
                                                $title, 
                                                $image_url,
                                                $description, 
                                                $url,
                                                $address,
                                                $lat,
                                                $lng,
                                                $category, 
                                                $subcategory,
                                                $date));
          }
          $approved_events = array_merge($approved_events, $experiences_events);
          usort($approved_events, function($evento1,$evento2) {
            return Evento::getCodeEvent($evento1->category) - Evento::getCodeEvent($evento2->category);
          });
          foreach($approved_events as $evento){
            $evento->name = htmlspecialchars_decode(addslashes(htmlspecialchars($evento->name)));
            $evento->description= htmlspecialchars_decode(
                                    addslashes(
                                      htmlspecialchars(
                                            preg_replace('/\s+/', ' ', nl2br($evento->description)))));
            $evento->address = htmlspecialchars_decode(addslashes(htmlspecialchars($evento->address)));
            $evento->category = htmlspecialchars_decode(addslashes(htmlspecialchars($evento->category)));
            $evento->url = htmlspecialchars_decode(addslashes(htmlspecialchars($evento->url)));
            $date = "";
            if ($evento->date != "") {
              $date = (strtotime($evento->date) * 1000);
            }
            echo "
                markers.push(['" . $evento->name . "', '" . 
                                  $evento->category . "', '" . 
                                  $evento->subcategory . "', '" . 
                                  $evento->lat . "', '" . 
                                  $evento->lng . "', '" . 
                                  $evento->description . "', '" . 
                                  $evento->url . "', '" . 
                                  $evento->address . "', " .
                                  $date . "]); 
                 markerTitles[" . $marker_id . "] = '" . $evento->name . "';
               "; 
            $count[$evento->category]++;
            $marker_id++;
          }  
        ?>
        // Properties of the sprite icons
        var icon_ciclismo = {"size" : new google.maps.Size(31, 42, "px", "px"), "origin": new google.maps.Point(96, 0)};
        var icon_deportes_de_invierno = {"size" : new google.maps.Size(30, 41, "px", "px"), "origin": new google.maps.Point(31, 87)};
        var icon_deportes_nauticos = {"size" : new google.maps.Size(30, 43, "px", "px"), "origin": new google.maps.Point(0, 44)};
        var icon_escalada = {"size" : new google.maps.Size(30, 42, "px", "px"), "origin": new google.maps.Point(94, 43)};
        var icon_experiencia = {"size" : new google.maps.Size(30, 42, "px", "px"), "origin": new google.maps.Point(63, 86)};
        var icon_motociclismo = {"size" : new google.maps.Size(31, 43, "px", "px"), "origin": new google.maps.Point(0, 0)};
        var icon_piraguismo = {"size" : new google.maps.Size(31, 42, "px", "px"), "origin": new google.maps.Point(64, 0)};
        var icon_running = {"size" : new google.maps.Size(30, 42, "px", "px"), "origin": new google.maps.Point(63, 43)};
        var icon_senderesimo = {"size" : new google.maps.Size(31, 42, "px", "px"), "origin": new google.maps.Point(32, 0)};
        var icon_triatlon = {"size" : new google.maps.Size(31, 42, "px", "px"), "origin": new google.maps.Point(31, 44)};

        // add markers
        jQuery.each(markers, function(i, val) {
          infowindow = new google.maps.InfoWindow({
            content: ""
          });


          // offset latlong ever so slightly to prevent marker overlap
          rand_x = Math.random();
          rand_y = Math.random();
          val[3] = parseFloat(val[3]) + parseFloat(parseFloat(rand_x) / 6000);
          val[4] = parseFloat(val[4]) + parseFloat(parseFloat(rand_y) / 6000);

          // show smaller marker icons on mobile
          if(agent == "iphone") {
            var iconSize = new google.maps.Size(16,19);
          } else {
           iconSize = null;

          }

          // build this marker
          var size = eval("icon_"+val[1])["size"];
          var origin = eval("icon_"+val[1])["origin"];
          var markerImage = new google.maps.MarkerImage("images/sprite-deportes.png", size, origin, null, iconSize);

          var marker = new google.maps.Marker({
            position: new google.maps.LatLng(val[3],val[4]),
            map: map,
            title: '',
            clickable: true,
            infoWindowHtml: '',
            zIndex: 10 + i,
            icon: markerImage
          });
          marker.category = val[1];
          marker.subcategory = val[2];
          if (val[8] != undefined) {
            marker.date = new Date(val[8]);
          }
          gmarkers.push(marker);

          // add marker hover events (if not viewing on mobile)
          if(agent == "default") {
            google.maps.event.addListener(marker, "mouseover", function() {
              this.old_ZIndex = this.getZIndex(); 
              this.setZIndex(9999); 
              $("#marker"+i).css("display", "inline");
              $("#marker"+i).css("z-index", "99999");
            });
            google.maps.event.addListener(marker, "mouseout", function() { 
              if (this.old_ZIndex && zoomLevel <= 15) {
                this.setZIndex(this.old_ZIndex); 
                $("#marker"+i).css("display", "none");
              }
            }); 
          }

          // format marker URI for display and linking
          var markerURI = val[6];
          if(markerURI.substr(0,7) != "http://") {
            markerURI = "http://" + markerURI; 
          }
          var markerURI_short = markerURI.replace("http://", "").replace("www.", "");
          if (markerURI_short.length > 40) {
            markerURI_short = markerURI_short.substring(0, 40) + "...";
          }
          var date = "";
          if (marker.date != undefined) {
            date = marker.date.toLocaleDateString();
          }
          var titulo = "<div class='marker_title'>" + val[0] + "</div>";
          var url = "<div class='marker_uri'><a target='_blank' href='"+markerURI+"'>"+markerURI_short+"</a></div>";
          var date = "<div class='marker_date'>"+date+"</div>";
          var description = "<div class='marker_desc'>"+val[5]+"</div>";
          var address = "<div class='marker_address'>"+val[7]+"</div>";
          var crear_experiencia = "";
          if (marker.category != "experiencia") {
            crear_experiencia = "<div class='marker_uri'><a target='_blank' href='http://www.sportyguest.es/crear-experiencia/'>Crea una experiencia cerca de " + val[0] + "</a></div>";
          }
          // add marker click effects (open infowindow)
          google.maps.event.addListener(marker, 'click', function () {
            infowindow.setContent(titulo + date + url + description + address + crear_experiencia);
            infowindow.open(map, this);

          });

          // add marker label
          var latLng = new google.maps.LatLng(val[3], val[4]);
          var label = new Label({
            map: map,
            id: i
          });
          label.bindTo('position', marker);
          label.set("text", val[0]);
          label.bindTo('visible', marker);
          label.bindTo('clickable', marker);
          label.bindTo('zIndex', marker);
        });


        // zoom to marker if selected in search typeahead list
        $('#search').typeahead({
          source: markerTitles, 
          onselect: function(obj) {
            marker_id = jQuery.inArray(obj, markerTitles);
            if(marker_id > -1) {
              map.panTo(gmarkers[marker_id].getPosition());
              map.setZoom(15);
              google.maps.event.trigger(gmarkers[marker_id], 'click');
            }
            $("#search").val("");
          }
        });
      } 

      $(document).ready(function() {
        $("#filter_date").change(function() {
          for(var i = 0; i < 12; i++) {
            if (this.value == "n/a") {
              show({"month" : i});
            } else if (i != this.value) {
              hide({"month" : i});
            } else {
              show({"month" : this.value});
            }
          }
        });
      });

      // zoom to specific marker
      function goToMarker(marker_id) {
        if(marker_id) {
          map.panTo(gmarkers[marker_id].getPosition());
          map.setZoom(15);
          google.maps.event.trigger(gmarkers[marker_id], 'click');
        }
      }

      // toggle (hide/show) markers of a given category (on the map)
      function toggle(query) {
        if($('#filter_'+query.category).is('.inactive') || $('#filter_sub_'+query.subcategory).is('.inactive')) {
          show(query); 
        } else {
          hide(query); 
        }
      }

      // hide all markers of a given query
      // The query parameters can be category, subcategory and month
      // The month is a number 0-11
      function hide(query) {
        for (var i=0; i<gmarkers.length; i++) {
          if (
              (query.hasOwnProperty("category") && gmarkers[i].category == query.category) ||
              (query.hasOwnProperty("subcategory") && gmarkers[i].subcategory == query.subcategory) ||
              (query.hasOwnProperty("month") && gmarkers[i].date.getMonth() == query.month)
            ) {
            gmarkers[i].setVisible(false);
          }
        }
        if (query.hasOwnProperty("category")) {
          $("#filter_"+query.category).addClass("inactive");
        }
        if (query.hasOwnProperty("subcategory")) {
          $("#filter_sub_" + query.subcategory).addClass("inactive");
        }
      }

      // show all markers of a given category
      function show(query) {
        for (var i=0; i < gmarkers.length; i++) {
          if ((query.hasOwnProperty("category") && 
                gmarkers[i].category == query.category &&
                !$("#filter_sub_"+gmarkers[i].subcategory).hasClass("inactive")) ||
              (query.hasOwnProperty("subcategory") && 
                gmarkers[i].subcategory == query.subcategory &&
                !$("#filter_"+gmarkers[i].category).hasClass("inactive") ) ||
              (query.hasOwnProperty("month") && 
                gmarkers[i].date != undefined && 
                gmarkers[i].date.getMonth() == query.month &&
                !$("#filter_"+gmarkers[i].category).hasClass("inactive") && 
                !$("#filter_sub_"+gmarkers[i].subcategory).hasClass("inactive"))
            ) {
            gmarkers[i].setVisible(true);
          }
        }
        if (query.hasOwnProperty("category")) {
          $("#filter_"+query.category).removeClass("inactive");
        }
        if (query.hasOwnProperty("subcategory")) {
          $("#filter_sub_" + query.subcategory).removeClass("inactive");
        }
      }
      
      // toggle (hide/show) marker list of a given category
      function toggleList(category) {
        $("#list .list-"+category).toggle();
      }


      // hover on list item
      function markerListMouseOver(marker_id) {
        $("#marker"+marker_id).css("display", "inline");
      }
      function markerListMouseOut(marker_id) {
        $("#marker"+marker_id).css("display", "none");
      }

      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    
    <?php echo $head_html; ?>

     <script>
  $(function() {
    $.datepicker.setDefaults(
      $.extend(
        {'dateFormat':'dd-mm-yy'},
        $.datepicker.regional['es']
      )
    );
    $( "#datepicker" ).datepicker();
    
    });
  </script>
 
  </head>
  <body>
    
    <!-- display error overlay if something went wrong -->
    <?php echo $error; ?>
    
    <!-- facebook like button code -->
    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          //appId      : '167652430078861', // App ID localhost
          appId      : '167839766714035', // App ID de producción
          channelUrl : '//www.sportyguest.es/channel.html', // Channel File
          status     : true, // check login status
          cookie     : true, // enable cookies to allow the server to access the session
          xfbml      : true  // parse XFBML
        });
        FB.Event.subscribe('edge.create', function(response) {
          jQuery("#modal-me-gusta").hide();
          $.cookie("facebook_liked", true, {expires: 3650});
        });
      };
      // Load the SDK Asynchronously
      (function(d){
         var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement('script'); js.id = id; js.async = true;
         js.src = "//connect.facebook.net/en_US/all.js";
         ref.parentNode.insertBefore(js, ref);
       }(document));
    </script>
    
    <!-- google map -->
    <div id="map_canvas"></div>

    <!-- topbar -->
    <div class="topbar" id="topbar">
      <div class="wrapper">
        <div class="right">
          <div class="share">
          <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $domain ?>" data-text="<?php echo $twitter['share_text'] ?>" data-via="<?php echo $twitter['username'] ?>" data-count="none">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            <div class="fb-like" data-href="http://www.facebook.com/Sportyguest" data-width="100"
                 data-layout="button_count" data-show-faces="false" data-send="true"></div>
          </div>
        </div>
        <div class="left">
          <div class="logo">
            <a href="./">
              <img src="images/logo.png" alt="" />
            </a>
          </div>
          <div class="buttons">
            <a href="#modal_info" class="btn btn-large btn-info" data-toggle="modal"><i class="icon-info-sign icon-white"></i>Sobre este mapa</a>
            <a href="#modal_faq" class="btn btn-large btn-info" data-toggle="modal"><i class="icon-info-sign icon-white"></i>FAQ</a>
            <a href="#modal_add" class="btn btn-large btn-success" data-toggle="modal"><i class="icon-plus-sign icon-white"></i>Añade tu evento</a>
          </div>
          <div class="search">
            <input type="text" name="search" id="search" placeholder="Busca competiciones..." data-provide="typeahead" autocomplete="off" />
          </div>
          <div class="combob">
            <select id="filter_date" class="combob" style="background-color: #FFF;">
              <option value="n/a" selected>Elige mes</option>
              <option value="0">Enero</option>
              <option value="1">Febrero</option>
              <option value="2">Marzo</option>
              <option value="3">Abril</option>
              <option value="4">Mayo</option>
              <option value="5">Junio</option>
              <option value="6">Julio</option>
              <option value="7">Agosto</option>
              <option value="8">Septiembre</option>
              <option value="9">Octubre</option>
              <option value="10">Noviembre</option>
              <option value="11">Diciembre</option>
            </select>
          </div>
          <div class="logo">
            <a href="http://www.sportyguest.es">
              <img src="images/logo-sportyguest.png" alt="" />
            </a>
          </div>
        </div>
      </div>
    </div>
    
    <!-- right-side gutter -->
    <div class="menu" id="menu">
      <ul class="list" id="list">
        <?php
          $marker_id = 0;

          foreach(Evento::$events_categories as $key => $value) {
            $markers = array_filter($approved_events, function($elem) use($key){
              return $elem->category == $key;
            });

            $markers_total = count($markers);
            // Shows the categories
            echo "
              <li class='category'>
                <div class='category_item'>
                  <div class='category_toggle'";
            // If it can be hidden it adds the toggle call
            if ($value["can_hide"]) {
              echo " onClick=\"toggle({'category' : '$key'})\"";
            }
            echo " id='filter_$key'></div>
                  <a href='#' onClick=\"toggleList('$key');\" class='category_info'>
                    <span class='$key sprite' style='opacity: 1;'></span>" . $value["name"] .
                    "<span class='total'> ($markers_total)</span>
                  </a>
                </div>
                <ul class='list-items list-$key'>
            ";
            // Shows the subcategories
            foreach(Evento::$events_subcategories[$key] as $subcat_key => $subcat_value) {
              $markers_subcat = array_filter($approved_events, function($elem) use($subcat_key) {
                return $elem->subcategory == $subcat_key;
              });
              echo "
              <li class='category'>
                <div class='category_item'>
                  <div class='category_toggle'";
              // If it can be hidden it adds the toggle call
              if ($value["can_hide"]) {
                echo " onClick=\"toggle({'subcategory' : '$subcat_key'})\"";
              }
              echo " id='filter_sub_$subcat_key'></div>
                  <!--<a href='#' onClick=\"toggleList('$subcat_key');\" class='category_info'>-->
                    <img id='bombilla' src='./images/icons/no-image.png' alt='' />
                    $subcat_value
                    <span class='total'> (" . count($markers_subcat) . ")</span>
                  <!--</a>-->
                </div>
              </li>
              ";
            }
            /*foreach($markers as $marker){
              echo "
                  <li class='".$marker->category."'>
                    <a href='#' onMouseOver=\"markerListMouseOver('".$marker_id."')\" onMouseOut=\"markerListMouseOut('".$marker_id."')\" onClick=\"goToMarker('".$marker_id."');\">".$marker->name."</a>
                  </li>
              ";
              $marker_id++;
            }*/
            echo "
                </ul>
              </li>
            ";
          }
        ?>
        <li class="blurb"><?php echo $blurb ?></li>
        <li class="attribution">
          <!-- per our license, you may not remove this line -->
          <?php echo $attribution?>
        </li>
      </ul>
    </div>

    <div id="modal-me-gusta" class="modal-backdrop" 
          style="opacity: 1!important; filter: alpha(opacity=1)!important; background-color: rgba(0,0,0,0.5);">
      <div class="modal fade in">
        <div class="modal-header">
          <h3>Mapa de eventos deportivos</h3>
        </div>
        <div class="modal-body" style="max-height: 600px!important;">
          <img src="images/preview.jpg" alt="Vista previa de la página" style="width:95%;"/>
          <p class="lead">Indica que te gusta Sportyguest para ver nuestro mapa al completo
            <div class="fb-like" data-href="https://www.facebook.com/Sportyguest" data-width="The pixel width of the plugin" data-height="The pixel height of the plugin" data-colorscheme="light" data-layout="standard" data-action="like" data-show-faces="true" data-send="false"></div>
          </p>
        </div>
        <div class="modal-footer">
          <button id="btn-cerrar-modal-me-gusta" type="button" class="close" data-dismiss="modal">×</button>
        </div>
      </div>
    </div>
    <script>
      jQuery("#btn-cerrar-modal-me-gusta").click(function() {
        jQuery("#modal-me-gusta").hide();
      });
      if ($.cookie("facebook_liked") != undefined) {
        jQuery("#modal-me-gusta").hide();
      }
    </script>
    
    <!-- more info modal -->
    <div class="modal hide in" id="modal_info" style="margin-top: -310px!important;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Sobre este mapa</h3>
      </div>
      <div class="modal-body">
        <p>
        <a href="http://www.sportyguest.es">Sportyguest</a> ha creado este mapa 
        para que la comunidad online pueda promocionar los eventos deportivos outdoor 
        que se realizan tanto a nivel español como internacional y para que así 
        puedas planificarte tu calendario deportivo.<br><br>
        Este mapa te permitirá encontrar los eventos deportivos y experiencias 
        deportivas más cercanas al lugar donde quieras desplazarte o encontrar 
        aquellos eventos y experiencias más cercanas a tu lugar de origen.<br><br>
        Hemos incluido alguna información sobre algunos eventos pero necesitamos 
        tu ayuda para hacerlo más completo. Si quieres añadir un evento deportivo 
        que organizas o, simplemente, al que asistes, únicamente tienes que pulsar 
        el botón: 
          <a href="#modal_add" data-toggle="modal" data-dismiss="modal">añadir evento</a>
        y completar un pequeño formulario con información al respecto. <br><br>
        <strong>Si quieres ayudarnos a apoyar la promoción de este mapa de eventos puedes 
        incorporar las siguientes imágenes (click derecho > guardar imagen como...) en tu 
        Web o blog enlazando el mapa:</strong>
        <ul class="badges">
          <li>
            <img src="./images/badges/badge1.png" alt="Logo Sportyguest map">
          </li>
          <li>
            <img src="./images/badges/badge2.png" alt="Logo secundario sportyguest map">
          </li>
        </ul>
        ¿Tienes preguntas? ¿Aportaciones? Contacta con nosotros en 
        <a href="http://www.twitter.com/ <?php echo $twitter['username'] ?>" target="_blank">@<?php echo $twitter['username'] ?></a>
        <br>
        Creado por <a href="http://www.sportyguest.es">Sportyguest Spain S.L</a>
        </p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal" style="float: right;">Cerrar</a>
      </div>
    </div>

    <!-- FAQ modal -->  
    <div class="modal hide in" id="modal_faq">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>FAQ - Preguntas frecuentes</h3>
      </div>
      <div class="modal-body">
        <ol>
          <li><a href="#1">¿Qué es Sportyguest Sports Map?</a> </li>
          <li><a href="#2">¿Por qué lo hemos creado?</a> </li>
          <li><a href="#3">¿Qué beneficios tiene añadir mi evento en este mapa?</a> </li>
          <li><a href="#4">¿Vamos a vender estos datos?¿Cómo monetizamos esto?</a> </li>
          <li><a href="#5">¿Qué tipo de eventos hay en el mapa?</a> </li>
          <li><a href="#6">¿Cómo añado un evento?</a> </li>
          <li><a href="#7">¿Cómo puedo modificar un evento existente?</a> </li>
          <li><a href="#8">Mi evento no está situado bien en el mapa de Sportyguest Sports Map:</a> </li>
          <li><a href="#9">Me parece una idea muy interesante y me gustaría ayudar a promocionarlo:</a> </li>
          
        </ol>
        <p>&nbsp;</p>
        <ol>
          <li><a name="1">¿Qué es Sportyguest Sports Map?</a> 
            <br>Sportyguest Sports Map es un mapa que representa los eventos deportivos 
                outdoor de España y del ámbito internacional. 
          </li>
          <li><a name="2">¿Por qué lo hemos creado?</a>
            <br>Hemos creado este mapa de eventos deportivos para que puedas encontrar 
                los eventos deportivos y experiencias deportivas más cercanas al lugar 
                donde quieras desplazarte o encontrar aquellos eventos y experiencias más 
                cercanas a tu lugar de origen, para así poder planificarte tu calendario deportivo. 
          </li>
          <li><a name="3">¿Qué beneficios tiene añadir mi evento en este mapa?</a> 
            <br>Indudablemente, si añades tu evento en este mapa de eventos deportivos vas a tener 
                una mayor visibilidad, además de un enlace directo al mismo que te permitirá obtener 
                mas visitantes en la web/blog y probables participantes y visitantes a la ciudad del evento.
          </li>
          <li><a name="4">¿Vamos a vender estos datos?¿Cómo monetizamos esto?</a>
            <br>Absolutamente NO. El objetivo de este mapa es el de darle un valor añadido y una
               herramienta de fácil acceso y usabilidad a cualquier aficionado al deporte que busque 
               eventos a los que asistir o nuevas experiencias deportivas que vivir. En ningún momento 
               cobramos por añadir ningún evento o similares.
          </li>
          <li><a name="5">¿Qué tipo de eventos hay en el mapa?</a> 
            <br>Este mapa ha sido realizado para que sean añadidos todos los eventos de deporte 
              outdoor, sobre todo, aquellos que permiten la participación a cualquier aficionado al 
              deporte outdoor. 
          </li>
          <li><a name="6">¿Cómo añado un evento?</a>
            <br>Únicamente tendrás que pinchar en el botón añadir evento y completar un sencillo 
              formulario con información del mismo. Ten en cuenta que el equipo de Sportyguest 
              revisará el mismo y tardará un máximo de 48h en aprobarlo y que este aparezca en el mapa.
          </li>
          <li><a name="7">¿Cómo puedo modificar un evento existente?</a>
            <br>Para hacer modificaciones de eventos ya publicados tienes que mandarnos un 
              correo a info@sportyguest.es con la información correspondiente.
          </li>
          <li><a name="8">Mi evento no está situado bien en el mapa de Sportyguest Sports Map:</a>
            <br>Sportyguest Sports Map se posiciona utilizando las funcionalidades de Google Maps, 
              por lo tanto, comprueba antes de enviar la dirección que en Google Maps sale correctamente. 
              Si no es así, ajústalo.
          </li>
          <li><a name="9">Me parece una idea muy interesante y me gustaría ayudar a promocionarlo:</a>
            <br>Bienvenido amig@! Estaremos encantados de que nos ayudes a promocionar Sportyguest Sports Map. 
              Si quieres ayudarnos a apoyar la promoción de este mapa de eventos deportivos puedes pinchar 
              en el botón “Sobre este mapa” y allí encontrarás el código que puedes implementar en tu 
              Web o blog. Gracias de antemano!
          </li>
        </ol>      
      </div>
      <div class="modal-footer">
      <a href="#" class="btn" data-dismiss="modal" style="float: right;">Cerrar</a>
      </div>
    </div>  
    
    <!-- add something modal -->
    <div class="modal hide" id="modal_add">
      <form method="POST" action="add.php" id="modal_addform" class="form-horizontal" enctype="multipart/form-data">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">x</button>
          <h3>Añade tu evento</h3>
        </div>
        <div class="modal-body">
          <div id="result"></div>
          <fieldset>
            <div class="control-group" id="control_group_owner_name">
              <label class="control-label" for="add_owner_name">Tu nombre</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="owner_name" id="add_owner_name" maxlength="100">
                <p class="help-block">
                No se muestra en la información del evento.
                </p>
              </div>
            </div>
            <div class="control-group" id="control_group_owner_email">
              <label class="control-label" for="add_owner_email">Tu email</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="owner_email" id="add_owner_email" maxlength="100">
                <p class="help-block">
                No se muestra en la información del evento, para resolver dudas.
                </p>
              </div>
            </div>
            <div class="control-group" id="control_group_title">
              <label class="control-label" for="add_title">Nombre del evento</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="title" id="add_title" maxlength="100" autocomplete="off">
                <p class="help-block">
                Nombre descriptivo del evento.
                </p>
              </div>
            </div>
            <div class="control-group" id="control_group_category">
              <label class="control-label" for="input01">Tipo de deporte</label>
              <div class="controls">
                <select name="category" id="add_category" class="input-xlarge">
                  <option value=""></option>
                  <?php
                  // Shows the categories
                  foreach(Evento::$events_categories as $key => $value) {
                    if ($value["can_add_new"]) {
                      echo "<option value='$key'>" . $value["name"] . "</option>";
                    }
                  }
                  ?>
                </select>
                <p class="help-block">
                La categoría deportiva de la competición.
                </p>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="input01">Categoría</label>
              <div class="controls"  id="add_subcategory_container">
                <select id="add_subcategory"></select>
                <p class="help-block">
                Deporte específico de la competición.
                </p>
              </div>
            </div> 

            <div class="control-group" id="control_group_address">
              <label class="control-label" for="add_address">Dirección</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="address" id="add_address" autocomplete="off">
                <p class="help-block">
                Dirección en la que se va a realizar el evento.
                </p>
              </div>
            </div>
            <input type="hidden"name="city" id="add_city">
            <div class="control-group">
              <label class="control-label" for="add_date">Fecha</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="datepicker" id="datepicker">
                <p class="help-block">
                 Fecha en la que tiene lugar el evento
                </p>
              </div>
            </div> 
            <div class="control-group">
              <label class="control-label" for="add_uri">URL del evento</label>
              <div class="controls">
                <input type="text" class="input-xlarge" id="add_uri" name="uri" placeholder="http://">
                <p class="help-block">
                URL del evento en caso de que la conozcas.
                </p>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="add_uri">Imagen</label>
              <div class="controls">
                <div class="fileupload fileupload-new" data-provides="fileupload">
                  <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;">
                    <img src="http://www.placehold.it/50x50/EFEFEF/AAAAAA" />
                  </div>
                  <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                  <span class="btn btn-file">
                    <span class="fileupload-new">Selecciona imagen</span>
                    <span class="fileupload-exists">Cambiar</span>
                    <input type="file" id="image" name="image"/>
                  </span>
                  <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Eliminiar</a>
                </div>
              </div>
            </div>
            <div class="control-group" id="control_group_description">
              <label class="control-label" for="add_description">Descripción</label>
              <div class="controls">
                <textarea class="input input-xlarge" id="add_description" name="description" maxlength="300" rows="4"></textarea>
                <p class="help-block">
                Describe brevemente en que consiste el evento.
                </p>
              </div>
            </div>
          </fieldset>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Aceptar</button>
          <a href="#" class="btn" data-dismiss="modal" style="float: right;">Cerrar</a>
        </div>
      </form>
    </div>
    <script>
      $(document).ready(function(){ 

        $("#add_category").change(function() {
          var subcategory = [];
          <?php
          // Shows the subcategories
          foreach(Evento::$events_subcategories as $key => $value) {
            if (Evento::$events_categories[$key]["can_add_new"]) {
              echo "subcategory[\"" . $key . "\"] = [];";
                foreach($value as $subcat_key => $subcat_value) {
                  echo "subcategory[\"" . $key . "\"][\"" . $subcat_key . "\"] = '" . $subcat_value . "';";
                }
            }
          }
          ?>
          var category = $("#add_category").val();
          var select = $("<select name='subcategory' id='add_subcategory' class='input-xlarge'></select>");
          for (subcat_key in subcategory[category]) {
            select.append($("<option value='" + subcat_key + "'>" + subcategory[category][subcat_key] + "</option>"));
          }
          $(select).replaceAll("#add_subcategory");
          //$("#add_subcategory_container").append(select);
        });

        // add modal form submit
        $("#modal_addform").submit(function(event) {
          event.preventDefault(); 
          var formData = new FormData(document.getElementById('modal_addform'));
            var url = jQuery("#modal_addform").attr( 'action' );
              $.ajax({
                type: "POST",
                processData: false,
                contentType: false,
                url: url,
                data: formData,
                dataType: "json"
              }).done(function( data ) {
                // if submission was successful, show info alert
                if(data.code == "success") {
                  $("#modal_addform #result").html("Hemos recibido tu propuesta, la procesaremos lo más pronto posible. Gracias!"); 
                  $("#modal_addform #result").addClass("alert alert-info");
                  $("#modal_addform p").css("display", "none");
                  $("#modal_addform fieldset").css("display", "none");
                  $("#modal_addform .btn-primary").css("display", "none");
                  
                // if submission failed, show error
                } else {
                  $("#modal_addform #result").html(data.msg);
                  $("#modal_addform #result").addClass("alert alert-danger");
                  var mandatory_fields = ["owner_name", "owner_email", "title", "category", "address", "description"];
                  // All the fields are cleared
                  for (var i = 0; i < mandatory_fields.length; i++) {
                    var name = "#control_group_" + mandatory_fields[i];
                    if ($(name).hasClass("error")) {
                      $(name).removeClass("error");
                    }
                  }
                  for (error in data.errors) {
                    var name = "#control_group_" + error;
                    $(name).addClass("error");
                  }
                }
              });
        });
        });
    </script>    
  </body>
</html>