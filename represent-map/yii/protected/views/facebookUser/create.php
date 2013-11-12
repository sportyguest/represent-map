<?php
/* @var $this FacebookUserController */
/* @var $model FacebookUser */

$this->breadcrumbs=array(
	'Facebook Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FacebookUser', 'url'=>array('index')),
	array('label'=>'Manage FacebookUser', 'url'=>array('admin')),
);
?>

<h1>Create FacebookUser</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>