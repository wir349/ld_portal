<?php
/* @var $this AttendeeController */
/* @var $model Attendee */

$this->breadcrumbs=array(
	'Attendees'=>array('index'),
	'Create',
);


?>

<h1>Data Entry Form</h1>

<?php $this->renderPartial('_form', array(
        'model'=>$model,
        'ticketModel' => $ticketModel
        )); ?>