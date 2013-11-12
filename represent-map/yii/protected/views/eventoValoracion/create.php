<?php
/* @var $this EventoValoracionController */
/* @var $model EventoValoracion */

$this->breadcrumbs=array(
	'Evento Valoracions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EventoValoracion', 'url'=>array('index')),
	array('label'=>'Manage EventoValoracion', 'url'=>array('admin')),
);
?>

<h1>Create EventoValoracion</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>