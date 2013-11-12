<?php
/* @var $this FacebookFriendsController */
/* @var $data FacebookFriends */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('facebook_id')); ?>:</b>
	<?php echo CHtml::encode($data->facebook_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('facebook_friend_id')); ?>:</b>
	<?php echo CHtml::encode($data->facebook_friend_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('facebook_friend_name')); ?>:</b>
	<?php echo CHtml::encode($data->facebook_friend_name); ?>
	<br />


</div>