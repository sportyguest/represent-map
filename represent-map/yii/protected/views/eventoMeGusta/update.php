<?php
/* @var $this EventoMeGustaController */
/* @var $model EventoMeGusta */

$this->breadcrumbs=array(
	'Evento Me Gustas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EventoMeGusta', 'url'=>array('index')),
	array('label'=>'Create EventoMeGusta', 'url'=>array('create')),
	array('label'=>'View EventoMeGusta', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EventoMeGusta', 'url'=>array('admin')),
);
?>

<h1>Update EventoMeGusta <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>