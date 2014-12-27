<?php
/* @var $this AttendeeController */
/* @var $model Attendee */

$this->breadcrumbs=array(
	'Attendees'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Attendee', 'url'=>array('index')),
	array('label'=>'Create Attendee', 'url'=>array('create')),
	array('label'=>'Update Attendee', 'url'=>array('update', 'id'=>$model->attendee_id)),
	array('label'=>'Delete Attendee', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->attendee_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Attendee', 'url'=>array('admin')),
);
?>

<h1>View Attendee #<?php echo $model->attendee_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'attendee_id',
		'name',
		'gender',
		'date_created',
		'date_of_birth',
		'country_code',
		'phone_number',
		'email_address',
	),
)); ?>
