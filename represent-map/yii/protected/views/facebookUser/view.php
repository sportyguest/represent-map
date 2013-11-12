<?php
/* @var $this FacebookUserController */
/* @var $model FacebookUser */

$this->breadcrumbs=array(
	'Facebook Users'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List FacebookUser', 'url'=>array('index')),
	array('label'=>'Create FacebookUser', 'url'=>array('create')),
	array('label'=>'Update FacebookUser', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FacebookUser', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FacebookUser', 'url'=>array('admin')),
);
?>

<h1>View FacebookUser #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'facebook_id',
		'name',
		'first_name',
		'last_name',
		'link',
		'username',
		'gender',
		'email',
	),
)); ?>
