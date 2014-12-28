<?php

/**
 * This is the model class for table "attendee".
 *
 * The followings are the available columns in table 'attendee':
 * @property integer $attendee_id
 * @property string $name
 * @property string $gender
 * @property string $date_created
 * @property string $date_of_birth
 * @property string $country_code
 * @property string $phone_number
 * @property string $email_address
 * @property string $area
 *
 * The followings are the available model relations:
 * @property Ticket[] $tickets
 */
class Attendee extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'attendee';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('phone_number', 'required'),
			array('name, country_code, email_address', 'length', 'max'=>45),
			array('gender', 'length', 'max'=>7),
			array('phone_number', 'length', 'max'=>11),
			array('area', 'length', 'max'=>350),
			array('date_created, date_of_birth', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('attendee_id, name, gender, date_created, date_of_birth, country_code, phone_number, email_address, area', 'safe', 'on'=>'search'),
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
			'tickets' => array(self::HAS_MANY, 'Ticket', 'attendee_id_given_to'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'attendee_id' => 'Attendee',
			'name' => 'Name',
			'gender' => 'Gender',
			'date_created' => 'Date Created',
			'date_of_birth' => 'Date Of Birth',
			'country_code' => 'Country Code',
			'phone_number' => 'Phone Number',
			'email_address' => 'Email Address',
			'area' => 'Area',
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

		$criteria->compare('attendee_id',$this->attendee_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_of_birth',$this->date_of_birth,true);
		$criteria->compare('country_code',$this->country_code,true);
		$criteria->compare('phone_number',$this->phone_number,true);
		$criteria->compare('email_address',$this->email_address,true);
		$criteria->compare('area',$this->area,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Attendee the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
