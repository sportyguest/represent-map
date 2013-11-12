<?php
/* @var $this EventoMeGustaController */
/* @var $model EventoMeGusta */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'evento-me-gusta-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'facebook_Id'); ?>
		<?php echo $form->textField($model,'facebook_Id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'facebook_Id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'evento_id'); ?>
		<?php echo $form->textField($model,'evento_id'); ?>
		<?php echo $form->error($model,'evento_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->