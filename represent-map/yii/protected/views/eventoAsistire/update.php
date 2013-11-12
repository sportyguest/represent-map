<?php
/* @var $this EventoAsistireController */
/* @var $model EventoAsistire */

$this->breadcrumbs=array(
	'Evento Asistires'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EventoAsistire', 'url'=>array('index')),
	array('label'=>'Create EventoAsistire', 'url'=>array('create')),
	array('label'=>'View EventoAsistire', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EventoAsistire', 'url'=>array('admin')),
);
?>

<h1>Update EventoAsistire <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>