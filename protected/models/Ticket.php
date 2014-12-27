<?php

/**
 * This is the model class for table "ticket".
 *
 * The followings are the available columns in table 'ticket':
 * @property integer $ticket_id
 * @property integer $event_id
 * @property integer $ticket_no
 * @property integer $sold_with_promotion_id
 * @property integer $distribution_source_distribution_source_id
 * @property integer $attendee_id_given_to
 * @property string $attendee_check_in_time
 * @property integer $final_amount_paid
 * @property integer $updated_by_user
 * @property string $payment_comments
 * @property string $payment_due_on
 * @property string $guest_ref
 * @property integer $details_filled_out
 *
 * The followings are the available model relations:
 * @property Event $event
 * @property Attendee $attendeeIdGivenTo
 * @property DistributionSource $distributionSourceDistributionSource
 * @property Promotion $soldWithPromotion
 * @property User $updatedByUser
 */
class Ticket extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ticket';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_id, ticket_no, updated_by_user', 'required'),
			array('event_id, ticket_no, sold_with_promotion_id, distribution_source_distribution_source_id, attendee_id_given_to, final_amount_paid, updated_by_user, details_filled_out', 'numerical', 'integerOnly'=>true),
			array('payment_comments', 'length', 'max'=>300),
			array('payment_due_on, guest_ref', 'length', 'max'=>100),
			array('attendee_check_in_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ticket_id, event_id, ticket_no, sold_with_promotion_id, distribution_source_distribution_source_id, attendee_id_given_to, attendee_check_in_time, final_amount_paid, updated_by_user, payment_comments, payment_due_on, guest_ref, details_filled_out', 'safe', 'on'=>'search'),
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
			'event' => array(self::BELONGS_TO, 'Event', 'event_id'),
			'attendeeIdGivenTo' => array(self::BELONGS_TO, 'Attendee', 'attendee_id_given_to'),
			'distributionSourceDistributionSource' => array(self::BELONGS_TO, 'DistributionSource', 'distribution_source_distribution_source_id'),
			'soldWithPromotion' => array(self::BELONGS_TO, 'Promotion', 'sold_with_promotion_id'),
			'updatedByUser' => array(self::BELONGS_TO, 'User', 'updated_by_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ticket_id' => 'Ticket',
			'event_id' => 'Event',
			'ticket_no' => 'Ticket No',
			'sold_with_promotion_id' => 'Sold With Promotion',
			'distribution_source_distribution_source_id' => 'Distribution Source Distribution Source',
			'attendee_id_given_to' => 'Attendee Id Given To',
			'attendee_check_in_time' => 'Attendee Check In Time',
			'final_amount_paid' => 'Final Amount Paid',
			'updated_by_user' => 'Updated By User',
			'payment_comments' => 'Payment Comments',
			'payment_due_on' => 'Payment Due On',
			'guest_ref' => 'Guest Ref',
			'details_filled_out' => 'Details Filled Out',
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

		$criteria->compare('ticket_id',$this->ticket_id);
		$criteria->compare('event_id',$this->event_id);
		$criteria->compare('ticket_no',$this->ticket_no);
		$criteria->compare('sold_with_promotion_id',$this->sold_with_promotion_id);
		$criteria->compare('distribution_source_distribution_source_id',$this->distribution_source_distribution_source_id);
		$criteria->compare('attendee_id_given_to',$this->attendee_id_given_to);
		$criteria->compare('attendee_check_in_time',$this->attendee_check_in_time,true);
		$criteria->compare('final_amount_paid',$this->final_amount_paid);
		$criteria->compare('updated_by_user',$this->updated_by_user);
		$criteria->compare('payment_comments',$this->payment_comments,true);
		$criteria->compare('payment_due_on',$this->payment_due_on,true);
		$criteria->compare('guest_ref',$this->guest_ref,true);
		$criteria->compare('details_filled_out',$this->details_filled_out);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ticket the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function getModelByTicketNo($ticket_no)
        {
            
            return (self::model()->findByAttributes(array('ticket_no'=>$ticket_no)));
            
        }
	
	
}
