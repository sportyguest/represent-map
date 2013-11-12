<?php
/* @var $this EventoAsistireController */
/* @var $data EventoAsistire */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('evento_id')); ?>:</b>
	<?php echo CHtml::encode($data->evento_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('facebook_id')); ?>:</b>
	<?php echo CHtml::encode($data->facebook_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />


</div>