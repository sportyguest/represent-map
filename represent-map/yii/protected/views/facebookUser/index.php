<?php
/* @var $this FacebookUserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Facebook Users',
);

$this->menu=array(
	array('label'=>'Create FacebookUser', 'url'=>array('create')),
	array('label'=>'Manage FacebookUser', 'url'=>array('admin')),
);
?>

<h1>Facebook Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
