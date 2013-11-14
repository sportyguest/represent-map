<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <title>Valora el evento</title>
  
  
  
  <link rel="stylesheet" href="https://d10ajoocuyu32n.cloudfront.net/mobile/1.3.1/jquery.mobile-1.3.1.min.css">
  
  <!-- jQuery and jQuery Mobile -->
  <script src="https://d10ajoocuyu32n.cloudfront.net/jquery-1.9.1.min.js"></script>
  <script src="https://d10ajoocuyu32n.cloudfront.net/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
   
</head>
<body>
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
          console.log("Clicado send email");
          if ($("#email").is(":visible") && $("#email").val()) {
            console.log("Campo email es visible");
            var evento_id = $("#evento").val();
            var val_general = $("#val_general").val();
            var val_organization = $("#val_organization").val();
            var val_difficulty = $("#val_difficulty").val();
            var val_route = $("#val_route").val();
            var val_extra_activities = $("#val_extra_activities").val();
            var val_price = $("#val_price").val();
            valorar(evento_id, 0);
          } else {
            console.log("Campo email no es visible");
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
          'EventoValoracion[comentario]': comment
        };
        // The rating is created in the database and then the rating is post to facebook
        $.ajax({
          type: 'POST',
          url: url_home + 'yii/eventoValoracion/ajax',
          data: data,
          success:function(data){
            console.log(data);
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
                  alert("Gracias por valorar");
                  window.location.href = url_home + "v/comentario.php?evento_id=" + evento_id;
                }
              );
            } else {
              window.location.href = url_home + "v/gracias.html";
            }
          },
          error: function(data) { // if error occured
            alert("Error occured.please try again");
            console.log(data);
          },
          dataType:'json'
        });
      }
    </script>
<!-- Home -->
<div data-role="page" id="page1">
    <div data-role="content">
        <div style="">
            <img style="width: 288px; height: 100px" src="http://eventosdeportivos.sportyguest.es/images/badges/badge1.png">
        </div>
        <h1>
            Puntúa el evento
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
                Comentario
            </label>
            <textarea name="comment" id="comment" placeholder="Danos tu opinión"></textarea>
        </div>
        <div data-role="fieldcontain" id="email-group">
            <label for="email">
                Email
            </label>
            <input type="text" name="email" id="email" placeholder="nombre@email.com"></textarea>
        </div>
        <a id="send-fb" data-role="button" data-theme="b">
            Enviar con Facebook
        </a>
        <a id="send-email" data-role="button" data-theme="d">
            Enviar con email
        </a>
    </div>
</div>
</body>
</html>
