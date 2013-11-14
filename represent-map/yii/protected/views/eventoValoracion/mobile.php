<?php
$this->layout = "mobile_rating_layout";
?>

<!-- Load the Facebook JavaScript SDK -->
<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js"></script>

<script type="text/javascript">
  var url_home = "http://eventosdeportivos.sportyguest.es/";
  // Initialize the Facebook JavaScript SDK
  FB.init({
    appId: '167652430078861',
    xfbml: true,
    status: true,
    cookie: true,
  });

  $(document).ready(function() {
    // Hide emails specific fields
    $("#comment-group").hide();
    $("#email-group").hide();
    // Facebook button clicked
    $("#send-fb").click(function() {
      var evento_id = $("#evento").val();
      var val_general = $("#val_general").val();
      var val_organization = $("#val_organization").val();
      var val_difficulty = $("#val_difficulty").val();
      var val_route = $("#val_route").val();
      var val_extra_activities = $("#val_extra_activities").val();
      var val_price = $("#val_price").val();
      FB.login(function(response) {
        if(response && response.status == 'connected') {
          valorar(evento_id, response.authResponse.userID);
        } 
      }, {scope:'email,publish_actions'});
    });
    // Email button clicked
    $("#send-email").click(function() {
      if ($("#email").is(":visible")) {
        if ($("#email").val() && $("#comment").val()) {
          var evento_id = $("#evento").val();
          var val_general = $("#val_general").val();
          var val_organization = $("#val_organization").val();
          var val_difficulty = $("#val_difficulty").val();
          var val_route = $("#val_route").val();
          var val_extra_activities = $("#val_extra_activities").val();
          var val_price = $("#val_price").val();
          valorar(evento_id, 0);
        } else {
          alert("Los campos email y comentario son obligatorios");
        }
      } else {
        $("#email-group").show();
        $("#comment-group").show();
      }
    });
  });
  function valorar(evento_id, uid) {
    var rating = jQuery("#val_general").val();
    var rating_org = jQuery("#val_organization").val();
    var rating_diff = jQuery("#val_difficulty").val();
    var rating_route = jQuery("#val_route").val();
    var rating_price = jQuery("#val_price").val();
    var rating_extra = jQuery("#val_extra_activities").val();
    if (!uid) {
      var comment = jQuery("#comment").val();
      var email = jQuery("#email").val();
    }
    var data = {
      'EventoValoracion[evento_id]': evento_id, 
      'EventoValoracion[facebook_id]': uid, 
      'EventoValoracion[valoracion]': rating,
      'EventoValoracion[valoracion_organizacion]': rating_org,
      'EventoValoracion[valoracion_dificultad]': rating_diff,
      'EventoValoracion[valoracion_recorrido]': rating_route,
      'EventoValoracion[valoracion_precio]': rating_price,
      'EventoValoracion[valoracion_actividad_complementaria]': rating_extra,
      'EventoValoracion[comentario]': comment,
      'EventoValoracion[email]': email
    };
    // The rating is created in the database and then the rating is post to facebook
    $.ajax({
      type: 'POST',
      url: url_home + 'yii/eventoValoracion/ajax',
      data: data,
      success:function(data){
        if (uid != 0 && data.code == "success") {
          var rating_url = url_home + 'yii/eventoValoracion/view/id/' + data.id;
          FB.api(
            'me/sportyguest_eventos:rating',
            'post',
            {
              'rating': rating_url,
              'sport_event': url_home + 'yii/evento/view/id/' + evento_id
            },
            function(response) {
              window.location.href = url_home + "v/comentario.php?evento_id=" + evento_id;
            }
          );
        } else {
          window.location.href = url_home + "v/gracias.html";
        }
      },
      error: function(data) { // if error occured
        alert("Ha ocurrido un error, inténtelo de nuevo por favor.");
      },
      dataType:'json'
    });
  }
</script>
<!-- Home -->
<div data-role="page" id="page1">
    <div data-role="content">
        <div>
            <img style="width: 288px; height: 100px" src="http://eventosdeportivos.sportyguest.es/images/badges/badge1.png">
        </div>
        <h1>
            Valora el evento
        </h1>
        <div data-role="fieldcontain">
            <label for="evento">
                Evento:
            </label>
            <?php 
              echo CHtml::dropDownList('evento', 6, $events, array('0' => '(Selecciona un evento)'));
              ?>
        </div>
        <div data-role="fieldcontain">
            <label for="val_general">
                Valoración General
            </label>
            <input id="val_general" type="range" name="slider" value="1" min="1" max="5"
            data-highlight="false">
        </div>
        <div data-role="fieldcontain">
            <label for="val_organization">
                Valoración organización
            </label>
            <input id="val_organization" type="range" name="slider" value="1" min="1" max="5"
            data-highlight="false">
        </div>
        <div data-role="fieldcontain">
            <label for="val_difficulty">
                Valoración dificultad
            </label>
            <input id="val_difficulty" type="range" name="slider" value="1" min="1" max="5"
            data-highlight="false">
        </div>
        <div data-role="fieldcontain">
            <label for="val_route">
                Valoración recorrido
            </label>
            <input id="val_route" type="range" name="slider" value="1" min="1" max="5"
            data-highlight="false">
        </div>
        <div data-role="fieldcontain">
            <label for="val_extra_activities">
                Valoración actividades complementarias
            </label>
            <input id="val_extra_activities" type="range" name="slider" value="1" min="1" max="5"
            data-highlight="false">
        </div>
        <div data-role="fieldcontain">
            <label for="val_price">
                Valoración precio
            </label>
            <input id="val_price" type="range" name="slider" value="1" min="1" max="5"
            data-highlight="false">
        </div>
        <div data-role="fieldcontain" id="comment-group">
            <label for="comment">
                Comentario (obligatorio)
            </label>
            <textarea name="comment" id="comment" placeholder="Danos tu opinión"></textarea>
        </div>
        <div data-role="fieldcontain" id="email-group">
            <label for="email">
                Email (obligatorio)
            </label>
            <input type="text" name="email" id="email" placeholder="nombre@email.com">
        </div>
        <a id="send-fb" data-role="button" data-theme="b">
            Enviar con Facebook
        </a>
        <a id="send-email" data-role="button" data-theme="d">
            Enviar con email
        </a>
    </div>
</div>
