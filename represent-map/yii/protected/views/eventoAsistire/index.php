<?php
/* @var $this EventoAsistireController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Evento Asistires',
);

$this->menu=array(
	array('label'=>'Create EventoAsistire', 'url'=>array('create')),
	array('label'=>'Manage EventoAsistire', 'url'=>array('admin')),
);
?>

<h1>Evento Asistires</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
