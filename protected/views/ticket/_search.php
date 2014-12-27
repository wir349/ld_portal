<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ticket_id'); ?>
		<?php echo $form->textField($model,'ticket_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'event_id'); ?>
		<?php echo $form->textField($model,'event_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ticket_no'); ?>
		<?php echo $form->textField($model,'ticket_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sold_with_promotion_id'); ?>
		<?php echo $form->textField($model,'sold_with_promotion_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'distribution_source_distribution_source_id'); ?>
		<?php echo $form->textField($model,'distribution_source_distribution_source_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'attendee_id_given_to'); ?>
		<?php echo $form->textField($model,'attendee_id_given_to'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'attendee_check_in_time'); ?>
		<?php echo $form->textField($model,'attendee_check_in_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'final_amount_paid'); ?>
		<?php echo $form->textField($model,'final_amount_paid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updated_by_user'); ?>
		<?php echo $form->textField($model,'updated_by_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'payment_comments'); ?>
		<?php echo $form->textField($model,'payment_comments',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->