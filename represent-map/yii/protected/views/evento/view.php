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
<div class="fb-like" data-href="<?php echo "http://" . Yii::app()->request->serverName . Yii::app()->request->requestUri;?>" data-width="The pixel width of the plugin" data-height="The pixel height of the plugin" data-colorscheme="light" data-layout="standard" data-action="like" data-show-faces="true" data-send="false"></div>

<div><input type="button" id="participado" value="Participado"></div>
<script>
jQuery("#particiado").click(function() {
	FB.login(function(response) {
	if (response.authResponse) {
		console.log('Welcome!  Fetching your information.... ');
		FB.api('/me', function(response) {
			console.log('Good to see you, ' + response.name + '.');

			FB.api(
				'me/t_sportyguest:participar',
				'post',
				{
					'carrera': '<?php echo "http://" . Yii::app()->request->serverName . Yii::app()->request->requestUri;?>'
				},
				function(response) {
					console.log(response);
				}
			);
		});
	} else {
		console.log('User cancelled login or did not fully authorize.');
	}
	}, {scope: 'publish_actions'});
});
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