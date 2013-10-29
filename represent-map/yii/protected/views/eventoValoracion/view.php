<?php
/* @var $this EventoValoracionController */
/* @var $model EventoValoracion */

$this->breadcrumbs=array(
	'Evento Valoracions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EventoValoracion', 'url'=>array('index')),
	array('label'=>'Create EventoValoracion', 'url'=>array('create')),
	array('label'=>'Update EventoValoracion', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EventoValoracion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EventoValoracion', 'url'=>array('admin')),
);
Yii::app()->clientScript->registerMetaTag("309591845843765", null, null, array('property'=>'og:app_id'), null);
Yii::app()->clientScript->registerMetaTag("t_sportyguest:rating", null, null, array('property'=> 'og:type'), null);
Yii::app()->clientScript->registerMetaTag($model->valoracion, null, null, array('property'=> 't_sportyguest:rating_value'), null);
Yii::app()->clientScript->registerMetaTag(EventoValoracion::VALORACION_ESCALA, null, null, array('property'=> 't_sportyguest:rating_scale'), null);
Yii::app()->clientScript->registerMetaTag($model->valoracion_organizacion, null, null, array('property'=> 't_sportyguest:rating_organization_value'), null);
Yii::app()->clientScript->registerMetaTag(EventoValoracion::VALORACION_ORGANIZACION_ESCALA, null, null, array('property'=> 't_sportyguest:rating_organization_scale'), null);
Yii::app()->clientScript->registerMetaTag($model->valoracion_dificultad, null, null, array('property'=> 't_sportyguest:rating_difficulty_value'), null);
Yii::app()->clientScript->registerMetaTag(EventoValoracion::VALORACION_DIFICULTAD_ESCALA, null, null, array('property'=> 't_sportyguest:rating_difficulty_scale'), null);
Yii::app()->clientScript->registerMetaTag($model->valoracion_recorrido, null, null, array('property'=> 't_sportyguest:rating_route_value'), null);
Yii::app()->clientScript->registerMetaTag(EventoValoracion::VALORACION_RECORRIDO_ESCALA, null, null, array('property'=> 't_sportyguest:rating_route_scale'), null);
Yii::app()->clientScript->registerMetaTag($model->valoracion_actividad_complementaria, null, null, array('property'=> 't_sportyguest:rating_extra_activities_value'), null);
Yii::app()->clientScript->registerMetaTag(EventoValoracion::VALORACION_ACTIVIDAD_COMPLEMENTARIA_ESCALA, null, null, array('property'=> 't_sportyguest:rating_extra_activities_scale'), null);
Yii::app()->clientScript->registerMetaTag($model->valoracion_precio, null, null, array('property'=> 't_sportyguest:rating_price_value'), null);
Yii::app()->clientScript->registerMetaTag(EventoValoracion::VALORACION_PRECIO_ESCALA, null, null, array('property'=> 't_sportyguest:rating_price_scale'), null);
?>

<h1>View EventoValoracion #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'evento_id',
		'facebook_id',
		'valoracion',
		'valoracion_organizacion',
		'valoracion_dificultad',
		'valoracion_recorrido',
		'valoracion_actividad_complementaria',
		'valoracion_precio',
	),
)); ?>
