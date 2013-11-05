<?php
/* @var $this EventoMeGustariaParticiparController */
/* @var $model EventoMeGustariaParticipar */

$this->breadcrumbs=array(
	'Evento Me Gustaria Participars'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EventoMeGustariaParticipar', 'url'=>array('index')),
	array('label'=>'Create EventoMeGustariaParticipar', 'url'=>array('create')),
	array('label'=>'View EventoMeGustariaParticipar', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EventoMeGustariaParticipar', 'url'=>array('admin')),
);
?>

<h1>Update EventoMeGustariaParticipar <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>