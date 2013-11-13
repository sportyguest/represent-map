<?php
/* @var $this EventoValoracionController */
/* @var $model EventoValoracion */

$this->breadcrumbs=array(
	'Evento Valoracions'=>array('index'),
	$model->id,
);

$evento = Evento::model()->find(array(
    'select'=>'name,description,image_url',
    'condition'=>'id=:id',
    'params'=>array(':id'=>$model->evento_id),
));
Yii::app()->clientScript->registerMetaTag("167839766714035", null, null, array('property'=>'og:app_id'), null);
Yii::app()->clientScript->registerMetaTag(date("c"), null, null, array('property'=>'og:updated_time'), null);
Yii::app()->clientScript->registerMetaTag("sportyguest_eventos:rating", null, null, array('property'=> 'og:type'), null);
Yii::app()->clientScript->registerMetaTag($evento->name, null, null, array('property' => 'og:title'), null);
Yii::app()->clientScript->registerMetaTag($evento->description, null, null, array('property' => 'og:description'), null);
if (!empty($model->image_url)) {
	$image_url = $model->image_url;
} else {
	$image_url = 'http://eventosdeportivos.sportyguest.es/images/preview.jpg';
}
Yii::app()->clientScript->registerMetaTag($image_url, null, null, array('property'=> 'og:image'), null);
Yii::app()->clientScript->registerMetaTag($model->valoracion, null, null, array('property'=> 'sportyguest_eventos:rating_value'), null);
Yii::app()->clientScript->registerMetaTag(EventoValoracion::VALORACION_ESCALA, null, null, array('property'=> 'sportyguest_eventos:rating_scale'), null);
Yii::app()->clientScript->registerMetaTag($model->valoracion_organizacion, null, null, array('property'=> 'sportyguest_eventos:rating_org_value'), null);
Yii::app()->clientScript->registerMetaTag(EventoValoracion::VALORACION_ORGANIZACION_ESCALA, null, null, array('property'=> 'sportyguest_eventos:rating_org_scale'), null);
Yii::app()->clientScript->registerMetaTag($model->valoracion_dificultad, null, null, array('property'=> 'sportyguest_eventos:rating_diff_value'), null);
Yii::app()->clientScript->registerMetaTag(EventoValoracion::VALORACION_DIFICULTAD_ESCALA, null, null, array('property'=> 'sportyguest_eventos:rating_diff_scale'), null);
Yii::app()->clientScript->registerMetaTag($model->valoracion_recorrido, null, null, array('property'=> 'sportyguest_eventos:rating_route_value'), null);
Yii::app()->clientScript->registerMetaTag(EventoValoracion::VALORACION_RECORRIDO_ESCALA, null, null, array('property'=> 'sportyguest_eventos:rating_route_scale'), null);
Yii::app()->clientScript->registerMetaTag($model->valoracion_actividad_complementaria, null, null, array('property'=> 'sportyguest_eventos:rating_extra_value'), null);
Yii::app()->clientScript->registerMetaTag(EventoValoracion::VALORACION_ACTIVIDAD_COMPLEMENTARIA_ESCALA, null, null, array('property'=> 'sportyguest_eventos:rating_extra_scale'), null);
Yii::app()->clientScript->registerMetaTag($model->valoracion_precio, null, null, array('property'=> 'sportyguest_eventos:rating_price_value'), null);
Yii::app()->clientScript->registerMetaTag(EventoValoracion::VALORACION_PRECIO_ESCALA, null, null, array('property'=> 'sportyguest_eventos:rating_price_scale'), null);
?>

<h1>View EventoValoracion #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'evento_id',
		'facebook_id',
		'facebook_valoracion_id',
		'valoracion',
		'valoracion_organizacion',
		'valoracion_dificultad',
		'valoracion_recorrido',
		'valoracion_actividad_complementaria',
		'valoracion_precio',
	),
)); ?>
