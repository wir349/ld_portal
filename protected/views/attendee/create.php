<?php
/* @var $this AttendeeController */
/* @var $model Attendee */

$this->breadcrumbs=array(
	'Attendees'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Attendee', 'url'=>array('index')),
	array('label'=>'Manage Attendee', 'url'=>array('admin')),
);
?>

<h1>Attendance</h1>

<?php $this->renderPartial('_form', array(
        'model'=>$model,
        'saved'=>$saved,
        'matching_contacts'=>$matching_contacts)); ?>