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
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/map_social.js'); 
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
      appId      : '167652430078861',                        // App ID from the app dashboard
      channelUrl : '//localhost/mapa/represent-map/channel.html', // Channel file for x-domain comms
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