<?php
include "header.php";

if(isset($_GET['place_id'])) {
  $place_id = htmlspecialchars($_GET['place_id']); 
} else if(isset($_POST['place_id'])) {
  $place_id = htmlspecialchars($_POST['place_id']);
} else {
  exit; 
}


// get place info
$place = Evento::getEvent($wpdb, $place_id);
if($place == null) { 
  exit; 
}


// do place edit if requested
if($task == "doedit") {
  $owner_name = "";
  $owner_email = "";
  $name = str_replace( "'", "\\'", str_replace( "\\", "\\\\", $_POST['name'] ) );
  $category = $_POST['category'];
  $subcategory = $_POST['subcategory_' . $category];
  $address = str_replace( "'", "\\'", str_replace( "\\", "\\\\", $_POST['address'] ) );
  $url = $_POST['url'];
  $description = str_replace( "'", "\\'", str_replace( "\\", "\\\\", $_POST['description'] ) );
  $owner_name = str_replace( "'", "\\'", str_replace( "\\", "\\\\", $_POST['owner_name'] ) );
  $owner_email = $_POST['owner_email'];
  $lat = (float) $_POST['lat'];
  $lng = (float) $_POST['lng'];
  $date = $_POST['date'];
  
  $event = new Evento($owner_name, $owner_email, $name, $description, $url, $address, $lat, $lng, $category, $subcategory, $date);
  $event->id = $place_id;
  $event->updateDB($wpdb);
  
  // geocode
  //$hide_geocode_output = true;
  //include "../geocode.php";
  
  header("Location: index.php?view=$view&search=$search&p=$p");
  exit;
}

?>



<?php echo $admin_head; ?>

<form id="admin" class="form-horizontal" action="edit.php" method="post">
  <h1>
    Edit Place
  </h1>
  <fieldset>
    <div class="control-group">
      <label class="control-label" for="">Owner name</label>
      <div class="controls">
        <input type="text" class="input input-xlarge" name="owner_name" value="<?php echo utf8_decode($place->owner_name);?>" id="">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="">Owner email</label>
      <div class="controls">
        <input type="text" class="input input-xlarge" name="owner_email" value="<?php echo $place->owner_email;?>" id="">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="">Name</label>
      <div class="controls">
        <input type="text" class="input input-xlarge" name="name" value="<?php echo utf8_decode($place->name);?>" id="">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="">Category</label>
      <div class="controls">
        <select class="input input-xlarge" name="category" id="category">
          <?php
          // Shows the categories
          foreach(Evento::$events_categories as $key => $value) {
            echo "<option value='$key'";
                if(strcasecmp($place->category, $key) == 0) { 
                  echo " selected='selected'";
                }
            echo ">" . utf8_decode($value["name"]) . "</option>";
          }
          ?>
        </select>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="">Subcategory</label>
      <div class="controls">
        <?php
        // Shows the subcategories
        foreach(Evento::$events_subcategories as $key => $value) {
          echo "<select name='subcategory_$key' id='add_subcategory_$key' class='input-xlarge'";
          if (strcasecmp($place->category, $key) == 0) {
            echo " style='display:block'>";
          } else {
            echo " style='display: none'>";
          }
          foreach($value as $subcat_key => $subcat_value) {
            echo "<option value='$subcat_key'";
            if (strcasecmp($place->subcategory, $subcat_key) == 0) {
              echo " selected='selected'";
            }
            echo ">" . utf8_decode($subcat_value) . "</option>";
          }
          echo "</select>";
        }
        ?>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="">Address</label>
      <div class="controls">
        <input type="text" class="input input-xlarge" name="address" value="<?php echo $place->address;?>" id="">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="add_date">Date</label>
      <div class="controls">
        <div id="datepicker">
        <input type="hidden" class="input-xlarge" name="date" id="date" value="">
        </p>
      </div>
    </div> 
    <div class="control-group">
      <label class="control-label" for="">URL</label>
      <div class="controls">
        <input type="text" class="input input-xlarge" name="url" value="<?php echo $place->url;?>" id="">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="">Description</label>
      <div class="controls">
        <textarea class="input input-xlarge" name="description"><?php echo utf8_decode($place->description);?></textarea>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="">Location</label>
      <div class="controls">
        <input type="hidden" name="lat" id="mylat" value="<?php echo $place->lat;?>"/>
        <input type="hidden" name="lng" id="mylng" value="<?php echo $place->lng;?>"/>
        <div id="map" style="width:80%;height:300px;">
        </div>
        <script type="text/javascript">
          var map = new google.maps.Map( document.getElementById('map'), {
            zoom: 17,
            center: new google.maps.LatLng( <?php echo $place->lat;?>, <?php echo $place->lng;?> ),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            streetViewControl: false,
            mapTypeControl: false
          });
          var marker = new google.maps.Marker({
            position: new google.maps.LatLng( <?php echo $place->lat;?>, <?php echo $place->lng;?> ),
            map: map,
            draggable: true
          });
          google.maps.event.addListener(marker, 'dragend', function(e){
            document.getElementById('mylat').value = e.latLng.lat().toFixed(6);
            document.getElementById('mylng').value = e.latLng.lng().toFixed(6);
          });
        </script>
      </div>
    </div>    
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">Save Changes</button>
      <input type="hidden" name="task" value="doedit" />
      <input type="hidden" name="place_id" value="<?php echo $place->id;?>" />
      <input type="hidden" name="view" value="<?php echo $view;?>" />
      <input type="hidden" name="search" value="<?php echo $search;?>" />
      <input type="hidden" name="p" value="<?php echo $p;?>" />
      <a href="index.php" class="btn" style="float: right;">Cancel</a>
    </div>
  </fieldset>
</form>

<script>
  jQuery(document).ready(function() {
    jQuery("#category").change(function() {
      var deportes= new Array(
        <?php 
          $keys = array_keys(Evento::$events_categories);
          echo "'" . implode("','", $keys) . "'";
        ?>
      );
      for(var i=0; i<deportes.length; i++){
        var subtipo = "#add_subcategory_" + deportes[i];
        if (this[this.selectedIndex].value==deportes[i])
        {  
          jQuery(subtipo).attr('style','display:block;');
        } 
        else {
          jQuery(subtipo).attr('style','display:none;');
        }
      }
    });
    jQuery("#datepicker").datepicker();    
    jQuery("#datepicker").change(function() {
      jQuery("#date").val(jQuery("#datepicker").val());
    });
    <?php
      $timestamp = strtotime($place->date);
    ?>
    jQuery("#datepicker").datepicker("setDate", "<?php echo date('m', $timestamp) . '/' . date('d', $timestamp) . '/' . date('Y', $timestamp);?>");
    jQuery("#date").val(jQuery("#datepicker").val());
  });
</script>

<?php echo $admin_foot; ?>
