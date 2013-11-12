<?php
/* @var $this EventoMeGustariaParticiparController */
/* @var $model EventoMeGustariaParticipar */

$this->breadcrumbs=array(
	'Evento Me Gustaria Participars'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EventoMeGustariaParticipar', 'url'=>array('index')),
	array('label'=>'Manage EventoMeGustariaParticipar', 'url'=>array('admin')),
);
?>

<h1>Create EventoMeGustariaParticipar</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>