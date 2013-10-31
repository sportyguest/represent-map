<?php
/* @var $this FacebookFriendsController */
/* @var $model FacebookFriends */

$this->breadcrumbs=array(
	'Facebook Friends'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FacebookFriends', 'url'=>array('index')),
	array('label'=>'Manage FacebookFriends', 'url'=>array('admin')),
);
?>

<h1>Create FacebookFriends</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>