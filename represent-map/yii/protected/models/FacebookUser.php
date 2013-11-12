<?php

/**
 * This is the model class for table "wp_facebook_user".
 *
 * The followings are the available columns in table 'wp_facebook_user':
 * @property integer $id
 * @property string $facebook_id
 * @property string $name
 * @property string $first_name
 * @property string $last_name
 * @property string $link
 * @property string $username
 * @property string $gender
 * @property string $email
 */
class FacebookUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'wp_facebook_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('facebook_id, name, first_name, last_name, link, username, email', 'required'),
			array('facebook_id', 'length', 'max'=>20),
			array('name, email', 'length', 'max'=>200),
			array('first_name, last_name, username', 'length', 'max'=>100),
			array('link', 'length', 'max'=>256),
			array('gender', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, facebook_id, name, first_name, last_name, link, username, gender, email', 'safe', 'on'=>'search'),
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
			'facebook_id' => 'Facebook',
			'name' => 'Name',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'link' => 'Link',
			'username' => 'Username',
			'gender' => 'Gender',
			'email' => 'Email',
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
		$criteria->compare('facebook_id',$this->facebook_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FacebookUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
