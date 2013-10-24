<?php

/**
 * This is the model class for table "wp_evento".
 *
 * The followings are the available columns in table 'wp_evento':
 * @property integer $id
 * @property string $owner_name
 * @property string $owner_email
 * @property string $name
 * @property string $image_url
 * @property string $description
 * @property string $url
 * @property string $address
 * @property double $lat
 * @property double $lng
 * @property string $category
 * @property string $subcategory
 * @property string $creation_date
 * @property string $date
 * @property integer $approved
 */
class Evento extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'wp_evento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description, url, address, lat, lng, category, subcategory, creation_date, date', 'required'),
			array('approved', 'numerical', 'integerOnly'=>true),
			array('lat, lng', 'numerical'),
			array('owner_name, owner_email, url', 'length', 'max'=>100),
			array('name', 'length', 'max'=>60),
			array('image_url', 'length', 'max'=>150),
			array('description, subcategory', 'length', 'max'=>300),
			array('address', 'length', 'max'=>90),
			array('category', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, owner_name, owner_email, name, image_url, description, url, address, lat, lng, category, subcategory, creation_date, date, approved', 'safe', 'on'=>'search'),
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
			'owner_name' => 'Owner Name',
			'owner_email' => 'Owner Email',
			'name' => 'Name',
			'image_url' => 'Image Url',
			'description' => 'Description',
			'url' => 'Url',
			'address' => 'Address',
			'lat' => 'Lat',
			'lng' => 'Lng',
			'category' => 'Category',
			'subcategory' => 'Subcategory',
			'creation_date' => 'Creation Date',
			'date' => 'Date',
			'approved' => 'Approved',
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
		$criteria->compare('owner_name',$this->owner_name,true);
		$criteria->compare('owner_email',$this->owner_email,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('image_url',$this->image_url,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('lat',$this->lat);
		$criteria->compare('lng',$this->lng);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('subcategory',$this->subcategory,true);
		$criteria->compare('creation_date',$this->creation_date,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('approved',$this->approved);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Evento the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
