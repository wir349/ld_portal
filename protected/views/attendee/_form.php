<?php
/* @var $this AttendeeController */
/* @var $model Attendee */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery-1.11.2.min.js',CClientScript::POS_BEGIN);

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'attendee-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>


	<?php if($saved == true)  echo "Contact Information Updated";  ?>
	
	<?php echo $form->errorSummary($model); ?>
		
        <div class="ticketNo">
	<div class="row">
		<?php echo $form->labelEx($model,'ticket_no'); ?>
		<?php echo $form->textField($model,'ticket_no',  array('autocomplete'=>'off')); ?>
		<?php echo $form->error($model,'ticket_no'); ?>
	</div>
        <div class="row">
            <button id="checkTicket">Validate Ticket No.</button>
	</div>
        <br />
        </div>
        <div class="phoneNumber">
	<div class="row">
		<?php echo $form->labelEx($model,'Phone Number'); ?>
		<?php echo $form->textField($model,'country_code',  array(
                    'value'=>'+92', 
                    'width'=>4)
                        ); ?>
		<?php echo $form->textField($model,'phone_number',  array(
                    'autocomplete'=>'off',
                    'width'=>11)
                        ); ?>
		<?php //echo $form->error($model,'ticket_no'); ?>
	</div>

        <div class="row">
            <button id="checkPhoneNumber">Retrieve Contact Information</button>
	</div>
        <br />
        </div>
        
        <div class="selectContactInfoType">

	<div class="row">
            <?php echo $form->dropDownList($model, '', $matching_contacts); ?>
        </div>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php echo $form->textField($model,'gender',array('size'=>7,'maxlength'=>7)); ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_created'); ?>
		<?php echo $form->textField($model,'date_created'); ?>
		<?php echo $form->error($model,'date_created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_of_birth'); ?>
		<?php echo $form->textField($model,'date_of_birth'); ?>
		<?php echo $form->error($model,'date_of_birth'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country_code'); ?>
		<?php echo $form->textField($model,'country_code',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'country_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone_number'); ?>
		<?php echo $form->textField($model,'phone_number',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'phone_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email_address'); ?>
		<?php echo $form->textField($model,'email_address',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'email_address'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
    
$( document ).ready(function() {
    $(".paymentForm").hide();
    $("#fetch").click(function(e){
        e.preventDefault();
        if ( $('#Ticket_ticket_no').val() == '' || $('#Ticket_ticket_no').val().length < 2) {
            $('#ticket_status').html('Please Enter Ticket Number');
            return;
        }
        $.ajax({
            type: "POST",
            url: baseUrl + "/index.php?r=ticket/validateTicket",
            data: { 'ticket_no': $('#Ticket_ticket_no').val() },
            dataType: 'json'
        })
        .done(function(datar) {
            $(".paymentForm").show();
            console.log(datar);
            $('#ticket_status').html(datar['status']);
            if(datar['attended'] == 1)
                $('#Ticket_details_filled_out').attr("checked", true);
			else
            $('#Ticket_details_filled_out').attr("checked", false);
            
            $('#Ticket_sold_with_promotion_id').val(datar['sold_with_promotion_id']);
            $('#Ticket_final_amount_paid').val(datar['final_amount_paid']);
            $('#Ticket_payment_due_on').val(datar['payment_due_on']);
            $('#Ticket_guest_ref').val(datar['guest_ref']);
            $('#Ticket_payment_comments').val(datar['payment_comments']);
            
            if(datar['status'] == 'PAID')
                $('#Ticket_final_amount_paid').attr("disabled", true);
            else
                $('#Ticket_final_amount_paid').attr("disabled", false);
        })
        .fail(function() {
            $(".paymentForm").hide();
            alert( "Ticket ID is invalid." );
        });


    }); 

});








</script>
    