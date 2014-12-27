<?php

class TicketController extends Controller
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
				'actions'=>array('create','update','validateticket'),
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
	 
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
*/
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 
	public function actionCreate()
	{
		$model=new Ticket;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Ticket']))
		{
			$model->attributes=$_POST['Ticket'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ticket_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	*/
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		
		$model = new Ticket();
		$saved = false;
		if ( isset($_POST['Ticket']) ) 
		{
                        $model = Ticket::getModelByTicketNo($_POST['Ticket']['ticket_no']);
			$model->attributes = $_POST['Ticket'];

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
			$model->event_id = 1;
			$model->updated_by_user = 1;
			
			
                        
                        if($model->save())
                        {
                            $saved = true;
                            $model = new Ticket();
                        }
			
		}
		
		$this->render('update',array(
			'model'=>$model,
			'saved'=>$saved,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}



        
        
         * 
         */
	
        public function actionValidateTicket() 
        {
            $ticket_no = Yii::app()->request->getParam('ticket_no');
            $model = Ticket::getModelByTicketNo($ticket_no);
          
            $sold_with_promotion_id = $model->sold_with_promotion_id; 
            $attended = $model->details_filled_out;
            $payment_due_on = $model->payment_due_on;
            $guest_ref = $model->guest_ref;
            $payment_comments = $model->payment_comments;
            $final_amount_paid = $model->final_amount_paid;
             
            if ( isset($model->soldWithPromotion))
            {
                $amountToBeGiven = $model->soldWithPromotion->price;
                $amountPaid = $model->final_amount_paid;

                if ( $amountToBeGiven == $amountPaid )
                    $status = 'PAID';
                else
                    $status = 'UNPAID';
            }
            else
            {
                 $status = 'UNPAID';
            }
            echo CJSON::encode(array('status'=>$status,
                                    'sold_with_promotion_id' => $sold_with_promotion_id,  
                                    'attended' => $attended,
                                    'payment_due_on'=>$payment_due_on,
                                    'guest_ref'=>$guest_ref,
                                    'payment_comments'=>$payment_comments,
                                    'final_amount_paid'=>$final_amount_paid));
            
                        
        }
        
        /**
	 * Lists all models.
	 */
	 
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Ticket');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 
	public function actionAdmin()
	{
		$model=new Ticket('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Ticket']))
			$model->attributes=$_GET['Ticket'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
*/
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Ticket the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Ticket::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Ticket $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ticket-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public static function getModelByTicketNumber($ticket_no)
	{
		$model = Ticket::model()->findByAtt();
		return new Ticket(); 
	}
	
}
