<?php
/* @var $this EventoValoracionController */
/* @var $model EventoValoracion */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'evento_id'); ?>
		<?php echo $form->textField($model,'evento_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'facebook_id'); ?>
		<?php echo $form->textField($model,'facebook_id',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'facebook_valoracion_id'); ?>
		<?php echo $form->textField($model,'facebook_valoracion_id',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'valoracion'); ?>
		<?php echo $form->textField($model,'valoracion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'valoracion_organizacion'); ?>
		<?php echo $form->textField($model,'valoracion_organizacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'valoracion_dificultad'); ?>
		<?php echo $form->textField($model,'valoracion_dificultad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'valoracion_recorrido'); ?>
		<?php echo $form->textField($model,'valoracion_recorrido'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'valoracion_actividad_complementaria'); ?>
		<?php echo $form->textField($model,'valoracion_actividad_complementaria'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'valoracion_precio'); ?>
		<?php echo $form->textField($model,'valoracion_precio'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->