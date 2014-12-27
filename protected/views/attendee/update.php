<?php
/* @var $this AttendeeController */
/* @var $model Attendee */

$this->breadcrumbs=array(
	'Attendees'=>array('index'),
	$model->name=>array('view','id'=>$model->attendee_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Attendee', 'url'=>array('index')),
	array('label'=>'Create Attendee', 'url'=>array('create')),
	array('label'=>'View Attendee', 'url'=>array('view', 'id'=>$model->attendee_id)),
	array('label'=>'Manage Attendee', 'url'=>array('admin')),
);
?>

<h1>Update Attendee <?php echo $model->attendee_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>