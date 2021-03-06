<?php

/**
 * This is the model class for table "wp_evento_asistire".
 *
 * The followings are the available columns in table 'wp_evento_asistire':
 * @property integer $id
 * @property integer $evento_id
 * @property string $facebook_id
 * @property string $fecha_creacion
 * @property string $facebook_asistire_id
 */
class EventoAsistire extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'wp_evento_asistire';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('evento_id, facebook_id', 'required'),
			array('evento_id', 'numerical', 'integerOnly'=>true),
			array('facebook_id, facebook_asistire_id', 'length', 'max'=>20),
			array('fecha_creacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, evento_id, facebook_id, fecha_creacion, facebook_asistire_id', 'safe', 'on'=>'search'),
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
			'fecha_creacion' => 'Fecha Creacion',
			'facebook_asistire_id' => 'Facebook Asistire',
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
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('facebook_asistire_id',$this->facebook_asistire_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EventoAsistire the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
