<?php
/* @var $this EventoMeGustaController */
/* @var $model EventoMeGusta */

$this->breadcrumbs=array(
	'Evento Me Gustas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EventoMeGusta', 'url'=>array('index')),
	array('label'=>'Manage EventoMeGusta', 'url'=>array('admin')),
);
?>

<h1>Create EventoMeGusta</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>