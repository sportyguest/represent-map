<?php
/* @var $this EventoController */
/* @var $model Evento */

$this->breadcrumbs=array(
	'Eventos'=>array('index'),
	$model->name,
);

Yii::app()->clientScript->registerMetaTag("167839766714035", null, null, array('property'=>'og:app_id'), null);
Yii::app()->clientScript->registerMetaTag(date("c"), null, null, array('property'=>'og:updated_time'), null);
Yii::app()->clientScript->registerMetaTag("sportyguest_eventos:sport_event", null, null, array('property'=> 'og:type'), null);
Yii::app()->clientScript->registerMetaTag($model->url, null, null, array('property'=> 'og:see_also'), null);
Yii::app()->clientScript->registerMetaTag($model->name, null, null, array('property'=>'og:title'), null);
Yii::app()->clientScript->registerMetaTag($model->description, null, null, array('property'=> 'og:description'), null);
if (!empty($model->image_url)) {
	$image_url = $model->image_url;
} else {
	$image_url = 'http://eventosdeportivos.sportyguest.es/images/preview.jpg';
}
Yii::app()->clientScript->registerMetaTag($image_url, null, null, array('property'=> 'og:image'), null);
?>

<h1>Evento #<?php echo $model->id; ?></h1>
<h2>Visita nuestro mapa interactivo de eventos deportivos:</h2>

<?php
echo CHtml::link(CHtml::image('/images/preview.jpg', 'Mapa de eventos deportivos'), 'http://eventosdeportivos.sportyguest.es');
?>
<br>
<br>
<h2>Información del evento:</h2>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'image_url',
		'description',
		'url',
		'address',
		'lat',
		'lng',
		'category',
		'subcategory',
	),
)); ?>