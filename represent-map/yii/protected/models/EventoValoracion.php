<?php

/**
 * This is the model class for table "wp_evento_valoracion".
 *
 * The followings are the available columns in table 'wp_evento_valoracion':
 * @property integer $id
 * @property integer $evento_id
 * @property string $facebook_id
 * @property string $email
 * @property string $facebook_valoracion_id
 * @property double $valoracion
 * @property double $valoracion_organizacion
 * @property double $valoracion_dificultad
 * @property double $valoracion_recorrido
 * @property double $valoracion_actividad_complementaria
 * @property double $valoracion_precio
 * @property string $comentario
 *
 * The followings are the available model relations:
 * @property Evento $evento
 */
class EventoValoracion extends CActiveRecord
{
	const VALORACION_ESCALA = 5;
	const VALORACION_ORGANIZACION_ESCALA = 5;
	const VALORACION_DIFICULTAD_ESCALA = 5;
	const VALORACION_RECORRIDO_ESCALA = 5;
	const VALORACION_ACTIVIDAD_COMPLEMENTARIA_ESCALA = 5;
	const VALORACION_PRECIO_ESCALA = 5;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'wp_evento_valoracion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('evento_id, valoracion, valoracion_organizacion, valoracion_dificultad, valoracion_recorrido, valoracion_actividad_complementaria, valoracion_precio', 'required'),
			array('evento_id', 'numerical', 'integerOnly'=>true),
			array('valoracion, valoracion_organizacion, valoracion_dificultad, valoracion_recorrido, valoracion_actividad_complementaria, valoracion_precio', 'numerical'),
			array('facebook_id, facebook_valoracion_id', 'length', 'max'=>20),
			array('email', 'length', 'max'=>100),
			array('comentario', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, evento_id, facebook_id, email, facebook_valoracion_id, valoracion, valoracion_organizacion, valoracion_dificultad, valoracion_recorrido, valoracion_actividad_complementaria, valoracion_precio, comentario', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'evento' => array(self::BELONGS_TO, 'Evento', 'evento_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'evento_id' => 'Evento',
			'facebook_id' => 'Facebook',
			'email' => 'Email',
			'facebook_valoracion_id' => 'Facebook Valoracion',
			'valoracion' => 'Valoracion',
			'valoracion_organizacion' => 'Valoracion Organizacion',
			'valoracion_dificultad' => 'Valoracion Dificultad',
			'valoracion_recorrido' => 'Valoracion Recorrido',
			'valoracion_actividad_complementaria' => 'Valoracion Actividad Complementaria',
			'valoracion_precio' => 'Valoracion Precio',
			'comentario' => 'Comentario',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('evento_id',$this->evento_id);
		$criteria->compare('facebook_id',$this->facebook_id,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('facebook_valoracion_id',$this->facebook_valoracion_id,true);
		$criteria->compare('valoracion',$this->valoracion);
		$criteria->compare('valoracion_organizacion',$this->valoracion_organizacion);
		$criteria->compare('valoracion_dificultad',$this->valoracion_dificultad);
		$criteria->compare('valoracion_recorrido',$this->valoracion_recorrido);
		$criteria->compare('valoracion_actividad_complementaria',$this->valoracion_actividad_complementaria);
		$criteria->compare('valoracion_precio',$this->valoracion_precio);
		$criteria->compare('comentario',$this->comentario,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EventoValoracion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
