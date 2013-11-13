<?php
/* @var $this EventoValoracionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Evento Valoracions',
);

?>

<h1>Evento Valoracions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
