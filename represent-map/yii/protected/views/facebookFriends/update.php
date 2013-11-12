<?php
/* @var $this FacebookFriendsController */
/* @var $model FacebookFriends */

$this->breadcrumbs=array(
	'Facebook Friends'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FacebookFriends', 'url'=>array('index')),
	array('label'=>'Create FacebookFriends', 'url'=>array('create')),
	array('label'=>'View FacebookFriends', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FacebookFriends', 'url'=>array('admin')),
);
?>

<h1>Update FacebookFriends <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>