<?php
/* @var $this EventoAsistireController */
/* @var $model EventoAsistire */

$this->breadcrumbs=array(
	'Evento Asistires'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EventoAsistire', 'url'=>array('index')),
	array('label'=>'Manage EventoAsistire', 'url'=>array('admin')),
);
?>

<h1>Create EventoAsistire</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>