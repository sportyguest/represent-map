<?php
/* @var $this EventoValoracionController */
/* @var $model EventoValoracion */

$this->breadcrumbs=array(
	'Evento Valoracions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EventoValoracion', 'url'=>array('index')),
	array('label'=>'Create EventoValoracion', 'url'=>array('create')),
	array('label'=>'Update EventoValoracion', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EventoValoracion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EventoValoracion', 'url'=>array('admin')),
);
$evento = Evento::model()->find(array(
    'select'=>'title,description,image_url',
    'condition'=>'id=:id',
    'params'=>array(':id'=>$model->evento_id),
));
Yii::app()->clientScript->registerMetaTag("167839766714035", null, null, array('property'=>'og:app_id'), null);
Yii::app()->clientScript->registerMetaTag("sportyguest_eventos:rating", null, null, array('property'=> 'og:type'), null);
Yii::app()->clientScript->registerMetaTag($evento->title, null, null, array('property' => 'og:title'), null);
Yii::app()->clientScript->registerMetaTag($evento->description, null, null, array('property' => 'og:description'), null);
if (!empty($evento->image_url)) {
	Yii::app()->clientScript->registerMetaTag($evento->image_url, null, null, array('property'=> 'og:image'), null);
}
Yii::app()->clientScript->registerMetaTag($model->valoracion, null, null, array('property'=> 'sportyguest_eventos:rating_value'), null);
Yii::app()->clientScript->registerMetaTag(EventoValoracion::VALORACION_ESCALA, null, null, array('property'=> 'sportyguest_eventos:rating_scale'), null);
Yii::app()->clientScript->registerMetaTag($model->valoracion_organizacion, null, null, array('property'=> 'sportyguest_eventos:rating_org_value'), null);
Yii::app()->clientScript->registerMetaTag(EventoValoracion::VALORACION_ORGANIZACION_ESCALA, null, null, array('property'=> 'sportyguest_eventos:rating_org_scale'), null);
Yii::app()->clientScript->registerMetaTag($model->valoracion_dificultad, null, null, array('property'=> 'sportyguest_eventos:rating_diff_value'), null);
Yii::app()->clientScript->registerMetaTag(EventoValoracion::VALORACION_DIFICULTAD_ESCALA, null, null, array('property'=> 'sportyguest_eventos:rating_diff_scale'), null);
Yii::app()->clientScript->registerMetaTag($model->valoracion_recorrido, null, null, array('property'=> 'sportyguest_eventos:rating_route_value'), null);
Yii::app()->clientScript->registerMetaTag(EventoValoracion::VALORACION_RECORRIDO_ESCALA, null, null, array('property'=> 'sportyguest_eventos:rating_route_scale'), null);
Yii::app()->clientScript->registerMetaTag($model->valoracion_actividad_complementaria, null, null, array('property'=> 'sportyguest_eventos:rating_extra_value'), null);
Yii::app()->clientScript->registerMetaTag(EventoValoracion::VALORACION_ACTIVIDAD_COMPLEMENTARIA_ESCALA, null, null, array('property'=> 'sportyguest_eventos:rating_extra_scale'), null);
Yii::app()->clientScript->registerMetaTag($model->valoracion_precio, null, null, array('property'=> 'sportyguest_eventos:rating_price_value'), null);
Yii::app()->clientScript->registerMetaTag(EventoValoracion::VALORACION_PRECIO_ESCALA, null, null, array('property'=> 'sportyguest_eventos:rating_price_scale'), null);
?>

<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'valoracion-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array(
			'onkeypress'=>" if(event.keyCode == 13){ send(); } " /* Do ajax call when user presses enter key */
		),
	));
	?>
    <?php echo $form->errorSummary($model); ?>
 
	<div class="row">
		<?php echo $form->labelEx($model,'evento_id'); ?>
		<?php echo $form->textField($model,'evento_id'); ?>
		<?php echo $form->error($model,'evento_id'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'facebook_id'); ?>
		<?php echo $form->textField($model,'facebook_id'); ?>
		<?php echo $form->error($model,'facebook_id'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'valoracion'); ?>
		<?php echo $form->textField($model,'valoracion'); ?>
		<?php echo $form->error($model,'valoracion'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'valoracion_organizacion'); ?>
		<?php echo $form->textField($model,'valoracion_organizacion'); ?>
		<?php echo $form->error($model,'valoracion_organizacion'); ?>
	</div>
		<div class="row">
		<?php echo $form->labelEx($model,'valoracion_recorrido'); ?>
		<?php echo $form->textField($model,'valoracion_recorrido'); ?>
		<?php echo $form->error($model,'valoracion_recorrido'); ?>
	</div>
		<div class="row">
		<?php echo $form->labelEx($model,'valoracion_precio'); ?>
		<?php echo $form->textField($model,'valoracion_precio'); ?>
		<?php echo $form->error($model,'valoracion_precio'); ?>
	</div>
		<div class="row">
		<?php echo $form->labelEx($model,'valoracion_dificultad'); ?>
		<?php echo $form->textField($model,'valoracion_dificultad'); ?>
		<?php echo $form->error($model,'valoracion_dificultad'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'valoracion_actividad_complementaria'); ?>
		<?php echo $form->textField($model,'valoracion_actividad_complementaria'); ?>
		<?php echo $form->error($model,'valoracion_actividad_complementaria'); ?>
	</div>
    <div class="row buttons">
        <?php echo CHtml::Button('SUBMIT',array('onclick'=>'send();')); ?> 
    </div>
 
<?php $this->endWidget(); ?>
 
</div><!-- form -->
<script type="text/javascript">
function send()
 {

	var data = $("#valoracion-form").serialize();


	$.ajax({
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("eventoValoracion/ajax"); ?>',
		data:data,
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
 
</script>

<h1>View EventoValoracion #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'evento_id',
		'facebook_id',
		'facebook_valoracion_id',
		'valoracion',
		'valoracion_organizacion',
		'valoracion_dificultad',
		'valoracion_recorrido',
		'valoracion_actividad_complementaria',
		'valoracion_precio',
	),
)); ?>
