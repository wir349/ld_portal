<?php

class AttendeeController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','ValidatePhone'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

        
        public function actionValidatePhone() {
            
            $phoneNum = Yii::app()->request->getParam('phone_number');
            $countryCode = Yii::app()->request->getParam('country_code');
           
            $attendees = $this->loadModelByPhone($countryCode, $phoneNum);
            $attJson = array();
            
            
            if ( isset($attendees)) {
                
                foreach ( $attendees as $att ) {
                    $attJson[$att['attendee_id']] = $att;
                }
            
            }
            
            
            if ( isset ($attendees) ) {
                echo CJSON::encode(array('isNew'=>false,'data'=>$attJson));
            } else {
                echo CJSON::encode(array('isNew'=>true));
            }
            
        }
        
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
                
                
               // print_r($_POST['Attendee']); exit();
		if(isset($_POST['Attendee']))
		{
                        // Find model by attId
                        if ( isset($_POST['Attendee']['attendee_id']) && $_POST['Attendee']['attendee_id'] != '' ) {
                              $model = $this->loadModelById($_POST['Attendee']['attendee_id']);
                        } 
                        
                        if( !isset($model) ) {
                              $model = new Attendee();
                        }
                       
                        $model->attributes=$_POST['Attendee'];
                    
                        
                        
                        
                    if ( $model->save() ) {
                        $ticketModel = Ticket::getModelByTicketNo($_POST['Ticket']['ticket_no']);
                        $ticketModel->attendee_id_given_to = $model->attendee_id;
                         if ( $ticketModel->save() )
                             $this->refresh();
                    }
                } else {
                  $ticketModel = new Ticket();
                  $model = new Attendee();
                  if ( Yii::app()->user->gender == 0 )
                      $model->gender = 'BROTHER';
                  else
                      $model->gender = 'SISTER'; 
                }
                
                $this->render('create',array(
			'model'=>$model,
                        'ticketModel' => $ticketModel
		));
	}


	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Attendee');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Attendee('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Attendee']))
			$model->attributes=$_GET['Attendee'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Attendee the loaded model
	 * @throws CHttpException
	 */
	public function loadModelByPhone($countryCode , $phoneNum)
	{
		$attendees = Yii::app()->db->createCommand()
                        ->select('*')
                        ->from('attendee')
                        ->where('country_code=:countryCode AND phone_number=:phoneNum', array(':countryCode'=>$countryCode,':phoneNum'=>$phoneNum))
         
                        ->queryAll();
                
                if ( count($attendees) > 0 )
                    return $attendees;
                
		
		else return null;
	}
        
        
        public function loadModelById($id)
	{
               
		$model = Attendee::model()->findByPk($id);
		
		return $model;
		
	}

	
}
