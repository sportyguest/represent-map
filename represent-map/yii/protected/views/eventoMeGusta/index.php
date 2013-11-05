<?php
/* @var $this EventoMeGustaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Evento Me Gustas',
);

$this->menu=array(
	array('label'=>'Create EventoMeGusta', 'url'=>array('create')),
	array('label'=>'Manage EventoMeGusta', 'url'=>array('admin')),
);
?>

<h1>Evento Me Gustas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
