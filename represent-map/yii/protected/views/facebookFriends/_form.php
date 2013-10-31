<?php
/* @var $this FacebookFriendsController */
/* @var $model FacebookFriends */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'facebook-friends-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'facebook_id'); ?>
		<?php echo $form->textField($model,'facebook_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'facebook_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'facebook_friend_id'); ?>
		<?php echo $form->textField($model,'facebook_friend_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'facebook_friend_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'facebook_friend_name'); ?>
		<?php echo $form->textField($model,'facebook_friend_name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'facebook_friend_name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->