<?php
/* @var $this EventoController */
/* @var $model Evento */

$this->breadcrumbs=array(
	'Eventos'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Evento', 'url'=>array('index')),
	array('label'=>'Create Evento', 'url'=>array('create')),
	array('label'=>'Update Evento', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Evento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Evento', 'url'=>array('admin')),
);
Yii::app()->clientScript->registerMetaTag("167839766714035", null, null, array('property'=>'og:app_id'), null);
Yii::app()->clientScript->registerMetaTag("sportyguest_eventos:sport_event", null, null, array('property'=> 'og:type'), null);
Yii::app()->clientScript->registerMetaTag($model->url, null, null, array('property'=> 'og:see_also'), null);
Yii::app()->clientScript->registerMetaTag($model->name, null, null, array('property'=>'og:title'), null);
Yii::app()->clientScript->registerMetaTag($model->description, null, null, array('property'=> 'og:description'), null);
if (!empty($model->image_url)) {
	Yii::app()->clientScript->registerMetaTag($model->image_url, null, null, array('property'=> 'og:image'), null);
}
?>

<h1>View Evento #<?php echo $model->id; ?></h1>

<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    // init the FB JS SDK
    FB.init({
      appId      : '167839766714035',                        // App ID from the app dashboard
      channelUrl : '//eventosdeportivos.sportyguest.es/channel.html', // Channel file for x-domain comms
      status     : true,                                 // Check Facebook Login status
      xfbml      : true                                  // Look for social plugins on the page
    });

    // Additional initialization code such as adding Event Listeners goes here
  };

  // Load the SDK asynchronously
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/all.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

<div class="fb-comments" data-href="http://eventosdeportivos.sportyguest.es/yii/evento/view/id/<?php echo $model->id;?>" data-colorscheme="light" data-numposts="5" data-width="400"></div>

<div><input type="button" id="participado" value="Participado"></div>
<div><input type="button" id="like" value="Like"></div>
<div><input type="button" id="valorar" value="Valorar"></div>
<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'valoracion-form',
		'enableAjaxValidation'=>false,
	));
	$valoracion = new EventoValoracion;
	?>
	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($valoracion,'valoracion'); ?>
		<?php echo $form->textField($valoracion,'valoracion'); ?>
		<?php echo $form->error($valoracion,'valoracion'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($valoracion,'valoracion_organizacion'); ?>
		<?php echo $form->textField($valoracion,'valoracion_organizacion'); ?>
		<?php echo $form->error($valoracion,'valoracion_organizacion'); ?>
	</div>
		<div class="row">
		<?php echo $form->labelEx($valoracion,'valoracion_recorrido'); ?>
		<?php echo $form->textField($valoracion,'valoracion_recorrido'); ?>
		<?php echo $form->error($valoracion,'valoracion_recorrido'); ?>
	</div>
		<div class="row">
		<?php echo $form->labelEx($valoracion,'valoracion_precio'); ?>
		<?php echo $form->textField($valoracion,'valoracion_precio'); ?>
		<?php echo $form->error($valoracion,'valoracion_precio'); ?>
	</div>
		<div class="row">
		<?php echo $form->labelEx($valoracion,'valoracion_dificultad'); ?>
		<?php echo $form->textField($valoracion,'valoracion_dificultad'); ?>
		<?php echo $form->error($valoracion,'valoracion_dificultad'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($valoracion,'valoracion_actividad_complementaria'); ?>
		<?php echo $form->textField($valoracion,'valoracion_actividad_complementaria'); ?>
		<?php echo $form->error($valoracion,'valoracion_actividad_complementaria'); ?>
	</div>
 
<?php $this->endWidget(); ?>
 
</div><!-- form -->
<script>
var uid;
jQuery("#participado").click(function() {
	FB.getLoginStatus(function(response) {
		if (response.status === 'connected') {
			uid = response.authResponse.userID;
			var accessToken = response.authResponse.accessToken;
			participarFB('<?php echo "http://" . Yii::app()->request->serverName . Yii::app()->request->requestUri;?>', uid);
		} else if (response.status === 'not_authorized') {
			// the user is logged in to Facebook, 
			// but has not authenticated your app
		} else {
			FB.login(function(response) {
				if (response.authResponse) {
					uid = response.authResponse.userID;
					FB.api('/me', function(response) {
						participarFB('<?php echo "http://" . Yii::app()->request->serverName . Yii::app()->request->requestUri;?>',  uid);
					});
				} else {
					console.log('User cancelled login or did not fully authorize.');
				}
			}, {scope: 'publish_actions'});
		}
	});
});
jQuery("#like").click(function() {
	FB.getLoginStatus(function(response) {
		if (response.status === 'connected') {
			uid = response.authResponse.userID;
			var accessToken = response.authResponse.accessToken;
			likeFB('<?php echo "http://" . Yii::app()->request->serverName . Yii::app()->request->requestUri;?>');
		} else if (response.status === 'not_authorized') {
			// the user is logged in to Facebook, 
			// but has not authenticated your app
		} else {
			FB.login(function(response) {
				if (response.authResponse) {
					FB.api('/me', function(response) {
						likeFB('<?php echo "http://" . Yii::app()->request->serverName . Yii::app()->request->requestUri;?>')
					});
				} else {
					console.log('User cancelled login or did not fully authorize.');
				}
			}, {scope: 'publish_actions'});
		}
	});
});
jQuery("#valorar").click(function() {
	FB.getLoginStatus(function(response) {
		if (response.status === 'connected') {
			uid = response.authResponse.userID;
			var accessToken = response.authResponse.accessToken;
			valorarFB('<?php echo "http://" . Yii::app()->request->serverName . Yii::app()->request->requestUri;?>', uid);
		} else if (response.status === 'not_authorized') {
			// the user is logged in to Facebook, 
			// but has not authenticated your app
		} else {
			FB.login(function(response) {
				if (response.authResponse) {
					uid = response.authResponse.userID;
					FB.api('/me', function(response) {
						valorarFB('<?php echo "http://" . Yii::app()->request->serverName . Yii::app()->request->requestUri;?>', uid);
					});
				} else {
					console.log('User cancelled login or did not fully authorize.');
				}
			}, {scope: 'publish_actions'});
		}
	});
});

function participarFB(url, uid) {
	FB.api(
		'me/sportyguest_eventos:participate',
		'post',
		{
			'sport_event': url,
			'years': ["2000"]
		},
		function(response) {
			console.log(response);
			console.log(response.id);
			// Create a new participation
			var data = {
							evento_id: <?php echo $model->id;?>, 
							facebook_id: uid, 
							facebook_participacion_id: response.id, 
							year: "2000"
						};
			$.ajax({
				type: 'POST',
				url: '<?php echo Yii::app()->createAbsoluteUrl("eventoParticipacion/ajax"); ?>',
				data: data,
				success:function(data){
					alert(data); 
				},
				error: function(data) { // if error occured
					alert("Error occured.please try again");
					alert(data);
				},
				dataType:'html'
			});
		}
	);
}
function valorarFB(evento_url, uid) {
	var rating = $("#EventoValoracion_valoracion").val();
	var rating_org = $("#EventoValoracion_valoracion_organizacion").val();
	var rating_diff = $("#EventoValoracion_valoracion_dificultad").val();
	var rating_route = $("#EventoValoracion_valoracion_recorrido").val();
	var rating_price = $("#EventoValoracion_valoracion_precio").val();
	var rating_extra = $("#EventoValoracion_valoracion_actividad_complementaria").val();
	var data = {
					evento_id: <?php echo $model->id;?>, 
					facebook_id: uid, 
					'EventoValoracion[valoracion]': rating,
					'EventoValoracion[valoracion_organizacion]': rating_org,
					'EventoValoracion[valoracion_dificultad]': rating_diff,
					'EventoValoracion[valoracion_recorrido]': rating_route,
					'EventoValoracion[valoracion_precio]': rating_price,
					'EventoValoracion[valoracion_actividad_complementaria]': rating_extra
				};
	// The rating is created in the database and then the rating is post to facebook
	$.ajax({
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("eventoValoracion/ajax"); ?>',
		data: data,
		success:function(data){
			alert(data);
			if (data.code == "success") {
				var rating_url = 'http://eventosdeportivos.sportyguest.es/yii/eventoValoracion/view/id/' + data.id;
				FB.api(
					'me/sportyguest_eventos:rate',
					'post',
					{
						'rating': rating_url,
						'sport_event': evento_url
					},
					function(response) {
						console.log(response);
					}
				);
			}
		},
		error: function(data) { // if error occured
			alert("Error occured.please try again");
			alert(data);
		},
		dataType:'html'
	});
}
function likeFB(url) {
	FB.api(
		'me/og.likes',
		'post',
		{
			object: url
		},
		function(response) {
			console.log(response);
		}
	);
}
</script>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'owner_name',
		'owner_email',
		'name',
		'image_url',
		'description',
		'url',
		'address',
		'lat',
		'lng',
		'category',
		'subcategory',
		'creation_date',
		'date',
		'approved',
	),
)); ?>