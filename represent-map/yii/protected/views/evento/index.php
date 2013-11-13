<?php
/* @var $this EventoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Eventos',
);

?>

<h1>Eventos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
