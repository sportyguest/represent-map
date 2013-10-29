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
Yii::app()->clientScript->registerMetaTag("309591845843765", null, null, array('property'=>'og:app_id'), null);
Yii::app()->clientScript->registerMetaTag("t_sportyguest:carrera", null, null, array('property'=> 'og:type'), null);
Yii::app()->clientScript->registerMetaTag($model->url, null, null, array('property'=> 'og:see_also'), null);
Yii::app()->clientScript->registerMetaTag($model->name, null, null, array('property'=>'og:title'), null);
Yii::app()->clientScript->registerMetaTag($model->description, null, null, array('property'=> 'og:description'), null);
Yii::app()->clientScript->registerMetaTag($model->image_url, null, null, array('property'=> 'og:image'), null);
?>

<h1>View Evento #<?php echo $model->id; ?></h1>

<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    // init the FB JS SDK
    FB.init({
      appId      : '309591845843765',                        // App ID from the app dashboard
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

<script>
jQuery("#participado").click(function() {
	FB.getLoginStatus(function(response) {
		if (response.status === 'connected') {
			var uid = response.authResponse.userID;
			var accessToken = response.authResponse.accessToken;
			participarFB('<?php echo "http://" . Yii::app()->request->serverName . Yii::app()->request->requestUri;?>');
		} else if (response.status === 'not_authorized') {
			// the user is logged in to Facebook, 
			// but has not authenticated your app
		} else {
			FB.login(function(response) {
				if (response.authResponse) {
					FB.api('/me', function(response) {
						participarFB('<?php echo "http://" . Yii::app()->request->serverName . Yii::app()->request->requestUri;?>')
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
			var uid = response.authResponse.userID;
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

function participarFB(url, years) {
	FB.api(
		'me/t_sportyguest:participate',
		'post',
		{
			'sport_event': url,
			'years': years
		},
		function(response) {
			console.log(response);
		}
	);
}
function valorarFB(rating_url, evento_url) {
	FB.api(
		'me/t_sportyguest:rate',
		'post',
		{
			'rating': rating_url,
			'evento': evento_url
		},
		function(response) {
			console.log(response);
		}
	);
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