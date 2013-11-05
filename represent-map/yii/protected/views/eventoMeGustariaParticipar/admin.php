<?php
/* @var $this EventoMeGustariaParticiparController */
/* @var $model EventoMeGustariaParticipar */

$this->breadcrumbs=array(
	'Evento Me Gustaria Participars'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List EventoMeGustariaParticipar', 'url'=>array('index')),
	array('label'=>'Create EventoMeGustariaParticipar', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#evento-me-gustaria-participar-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Evento Me Gustaria Participars</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'evento-me-gustaria-participar-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'facebook_id',
		'evento_id',
		'fecha',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
