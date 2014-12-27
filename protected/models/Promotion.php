<?php

/**
 * This is the model class for table "promotion".
 *
 * The followings are the available columns in table 'promotion':
 * @property integer $promotion_id
 * @property string $name
 * @property integer $event_event_id
 * @property integer $price
 * @property string $description
 * @property string $deadline
 *
 * The followings are the available model relations:
 * @property Event $eventEvent
 * @property Ticket[] $tickets
 */
class Promotion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'promotion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, event_event_id', 'required'),
			array('event_event_id, price', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('description', 'length', 'max'=>200),
			array('deadline', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('promotion_id, name, event_event_id, price, description, deadline', 'safe', 'on'=>'search'),
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
			'eventEvent' => array(self::BELONGS_TO, 'Event', 'event_event_id'),
			'tickets' => array(self::HAS_MANY, 'Ticket', 'sold_with_promotion_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'promotion_id' => 'Promotion',
			'name' => 'Name',
			'event_event_id' => 'Event Event',
			'price' => 'Price',
			'description' => 'Description',
			'deadline' => 'Deadline',
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

		$criteria->compare('promotion_id',$this->promotion_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('event_event_id',$this->event_event_id);
		$criteria->compare('price',$this->price);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('deadline',$this->deadline,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Promotion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function getAllPromotions() {
            
            $arr = array();
            $ret = self::model()->findAll();
            for ( $i = 0 ; $i < count($ret) ; $i++ ) {
                $arr[$ret[$i]->promotion_id] = $ret[$i]->name . ' - ' . $ret[$i]->price; 
        }
        
        return $arr;
            
        }
}
