<?php
/* @var $this EventoValoracionController */
/* @var $model EventoValoracion */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'evento-valoracion-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'evento_id'); ?>
		<?php echo $form->textField($model,'evento_id'); ?>
		<?php echo $form->error($model,'evento_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'facebook_id'); ?>
		<?php echo $form->textField($model,'facebook_id',array('size'=>20,'maxlength'=>20)); ?>
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
		<?php echo $form->labelEx($model,'valoracion_dificultad'); ?>
		<?php echo $form->textField($model,'valoracion_dificultad'); ?>
		<?php echo $form->error($model,'valoracion_dificultad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'valoracion_recorrido'); ?>
		<?php echo $form->textField($model,'valoracion_recorrido'); ?>
		<?php echo $form->error($model,'valoracion_recorrido'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'valoracion_actividad_complementaria'); ?>
		<?php echo $form->textField($model,'valoracion_actividad_complementaria'); ?>
		<?php echo $form->error($model,'valoracion_actividad_complementaria'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'valoracion_precio'); ?>
		<?php echo $form->textField($model,'valoracion_precio'); ?>
		<?php echo $form->error($model,'valoracion_precio'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->