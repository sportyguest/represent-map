<?php
/* @var $this EventoMeGustaController */
/* @var $model EventoMeGusta */

$this->breadcrumbs=array(
	'Evento Me Gustas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EventoMeGusta', 'url'=>array('index')),
	array('label'=>'Create EventoMeGusta', 'url'=>array('create')),
	array('label'=>'Update EventoMeGusta', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EventoMeGusta', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EventoMeGusta', 'url'=>array('admin')),
);
?>

<h1>View EventoMeGusta #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'facebook_Id',
		'evento_id',
	),
)); ?>
