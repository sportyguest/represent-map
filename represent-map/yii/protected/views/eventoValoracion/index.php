<?php
/* @var $this EventoValoracionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Evento Valoracions',
);

$this->menu=array(
	array('label'=>'Create EventoValoracion', 'url'=>array('create')),
	array('label'=>'Manage EventoValoracion', 'url'=>array('admin')),
);
?>

<h1>Evento Valoracions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
