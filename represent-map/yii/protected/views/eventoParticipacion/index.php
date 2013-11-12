<?php
/* @var $this EventoParticipacionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Evento Participacions',
);

$this->menu=array(
	array('label'=>'Create EventoParticipacion', 'url'=>array('create')),
	array('label'=>'Manage EventoParticipacion', 'url'=>array('admin')),
);
?>

<h1>Evento Participacions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
