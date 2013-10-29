<?php
/* @var $this EventoValoracionController */
/* @var $data EventoValoracion */
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('valoracion')); ?>:</b>
	<?php echo CHtml::encode($data->valoracion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valoracion_organizacion')); ?>:</b>
	<?php echo CHtml::encode($data->valoracion_organizacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valoracion_dificultad')); ?>:</b>
	<?php echo CHtml::encode($data->valoracion_dificultad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valoracion_recorrido')); ?>:</b>
	<?php echo CHtml::encode($data->valoracion_recorrido); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('valoracion_actividad_complementaria')); ?>:</b>
	<?php echo CHtml::encode($data->valoracion_actividad_complementaria); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valoracion_precio')); ?>:</b>
	<?php echo CHtml::encode($data->valoracion_precio); ?>
	<br />

	*/ ?>

</div>