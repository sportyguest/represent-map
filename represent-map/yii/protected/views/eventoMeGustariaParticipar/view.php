<?php
/* @var $this EventoMeGustariaParticiparController */
/* @var $model EventoMeGustariaParticipar */

$this->breadcrumbs=array(
	'Evento Me Gustaria Participars'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EventoMeGustariaParticipar', 'url'=>array('index')),
	array('label'=>'Create EventoMeGustariaParticipar', 'url'=>array('create')),
	array('label'=>'Update EventoMeGustariaParticipar', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EventoMeGustariaParticipar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EventoMeGustariaParticipar', 'url'=>array('admin')),
);
?>

<h1>View EventoMeGustariaParticipar #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'facebook_id',
		'evento_id',
		'fecha',
	),
)); ?>
