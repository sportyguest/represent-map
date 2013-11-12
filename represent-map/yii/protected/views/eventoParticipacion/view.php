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
?>

<h1>View EventoParticipacion #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'evento_id',
		'facebook_id',
		'facebook_participacion_id',
		'year',
	),
)); ?>
