<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ticket-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php if($saved == true)  echo "Ticket Updated";  ?>
	
	<?php echo $form->errorSummary($model); ?>
		
	<div class="row">
		<?php echo $form->labelEx($model,'ticket_no'); ?>
		<?php echo $form->textField($model,'ticket_no'); ?>
		<?php echo $form->error($model,'ticket_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sold_with_promotion_id'); ?>
		<?php echo $form->dropDownList($model,'sold_with_promotion_id',array());?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'final_amount_paid'); ?>
		<?php echo $form->textField($model,'final_amount_paid'); ?>
		<?php echo $form->error($model,'final_amount_paid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payment_comments'); ?>
		<?php echo $form->textField($model,'payment_comments',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'payment_comments'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

	<div class="row">
		<?php $ct = date("Y-m-d H:i:s"); $model->attendee_check_in_time = $ct; echo $ct; ?>
	</div>
	
<?php $this->endWidget(); ?>

</div><!-- form -->



