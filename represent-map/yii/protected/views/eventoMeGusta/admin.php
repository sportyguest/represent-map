<?php
/* @var $this EventoMeGustaController */
/* @var $model EventoMeGusta */

$this->breadcrumbs=array(
	'Evento Me Gustas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List EventoMeGusta', 'url'=>array('index')),
	array('label'=>'Create EventoMeGusta', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#evento-me-gusta-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Evento Me Gustas</h1>

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
	'id'=>'evento-me-gusta-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'facebook_Id',
		'evento_id',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
