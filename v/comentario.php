<?php
$evento_id = $_GET["evento_id"];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <title></title>
  
  
  
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
      // Initialize the Facebook JavaScript SDK
      FB.init({
        appId: '167652430078861',
        xfbml: true,
        status: true,
        cookie: true,
      });
    </script>
  <div data-role="page">
    <div data-role="content">
      <div style="">
          <img style="width: 288px; height: 100px" src="http://eventosdeportivos.sportyguest.es/images/badges/badge1.png">
      </div>
      <h4>
          Gracias por valorar, ¿Quieres dejar un comentario?
      </h4>
      <div class="fb-comments" data-href="http://eventosdeportivos.sportyguest.es/yii/evento/view/id/<?php echo $evento_id;?>" data-numposts="5"></div>
      <a id="no-gracias" data-role="button" data-theme="b">
          No gracias
      </a>
    </div>
  </div>
</body>
</html>