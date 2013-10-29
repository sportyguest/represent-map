<?php
/* @var $this EventoParticipacionController */
/* @var $model EventoParticipacion */

$this->breadcrumbs=array(
	'Evento Participacions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EventoParticipacion', 'url'=>array('index')),
	array('label'=>'Create EventoParticipacion', 'url'=>array('create')),
	array('label'=>'Update EventoParticipacion', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EventoParticipacion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EventoParticipacion', 'url'=>array('admin')),
);
Yii::app()->clientScript->registerMetaTag("309591845843765", null, null, array('property'=>'og:app_id'), null);
Yii::app()->clientScript->registerMetaTag("t_sportyguest:participation", null, null, array('property'=> 'og:type'), null);

?>
<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'participacion-form',
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
    <div class="row buttons">
        <?php echo CHtml::Button('SUBMIT',array('onclick'=>'send();')); ?> 
    </div>
 
<?php $this->endWidget(); ?>
 
</div><!-- form -->
<script type="text/javascript">
function send()
 {

	var data = $("#participacion-form").serialize();


	$.ajax({
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("eventoParticipacion/ajax"); ?>',
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
<h1>View EventoParticipacion #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'evento_id',
		'facebook_id',
		'year',
	),
)); ?>
