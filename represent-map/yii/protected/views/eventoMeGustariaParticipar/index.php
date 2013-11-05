<?php
/* @var $this EventoMeGustariaParticiparController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Evento Me Gustaria Participars',
);

$this->menu=array(
	array('label'=>'Create EventoMeGustariaParticipar', 'url'=>array('create')),
	array('label'=>'Manage EventoMeGustariaParticipar', 'url'=>array('admin')),
);
?>

<h1>Evento Me Gustaria Participars</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
