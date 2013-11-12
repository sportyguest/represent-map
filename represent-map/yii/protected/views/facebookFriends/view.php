<?php
/* @var $this FacebookFriendsController */
/* @var $model FacebookFriends */

$this->breadcrumbs=array(
	'Facebook Friends'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FacebookFriends', 'url'=>array('index')),
	array('label'=>'Create FacebookFriends', 'url'=>array('create')),
	array('label'=>'Update FacebookFriends', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FacebookFriends', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FacebookFriends', 'url'=>array('admin')),
);
?>

<h1>View FacebookFriends #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'facebook_id',
		'facebook_friend_id',
		'facebook_friend_name',
	),
)); ?>
