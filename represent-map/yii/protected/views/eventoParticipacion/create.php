<?php
/* @var $this EventoParticipacionController */
/* @var $model EventoParticipacion */

$this->breadcrumbs=array(
	'Evento Participacions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EventoParticipacion', 'url'=>array('index')),
	array('label'=>'Manage EventoParticipacion', 'url'=>array('admin')),
);
?>

<h1>Create EventoParticipacion</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>