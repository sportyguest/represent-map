<?php
/* @var $this EventoParticipacionController */
/* @var $model EventoParticipacion */

$this->breadcrumbs=array(
	'Evento Participacions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EventoParticipacion', 'url'=>array('index')),
	array('label'=>'Create EventoParticipacion', 'url'=>array('create')),
	array('label'=>'View EventoParticipacion', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EventoParticipacion', 'url'=>array('admin')),
);
?>

<h1>Update EventoParticipacion <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>