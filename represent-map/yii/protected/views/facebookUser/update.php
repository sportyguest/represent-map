<?php
/* @var $this FacebookUserController */
/* @var $model FacebookUser */

$this->breadcrumbs=array(
	'Facebook Users'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FacebookUser', 'url'=>array('index')),
	array('label'=>'Create FacebookUser', 'url'=>array('create')),
	array('label'=>'View FacebookUser', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FacebookUser', 'url'=>array('admin')),
);
?>

<h1>Update FacebookUser <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>