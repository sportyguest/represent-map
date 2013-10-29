<?php
/* @var $this EventoValoracionController */
/* @var $model EventoValoracion */

$this->breadcrumbs=array(
	'Evento Valoracions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EventoValoracion', 'url'=>array('index')),
	array('label'=>'Create EventoValoracion', 'url'=>array('create')),
	array('label'=>'View EventoValoracion', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EventoValoracion', 'url'=>array('admin')),
);
?>

<h1>Update EventoValoracion <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>