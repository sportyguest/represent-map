<?php
/* @var $this FacebookFriendsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Facebook Friends',
);

$this->menu=array(
	array('label'=>'Create FacebookFriends', 'url'=>array('create')),
	array('label'=>'Manage FacebookFriends', 'url'=>array('admin')),
);
?>

<h1>Facebook Friends</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
