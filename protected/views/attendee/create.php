<?php
/* @var $this AttendeeController */
/* @var $model Attendee */

$this->breadcrumbs=array(
	'Attendees'=>array('index'),
	'Create',
);


?>

<h1>Attendee Contact Information</h1>

<?php $this->renderPartial('_form', array(
        'model'=>$model,
        'ticketModel' => $ticketModel
        )); ?>