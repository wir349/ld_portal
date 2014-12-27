<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery-1.11.2.min.js',CClientScript::POS_BEGIN);

?>
<script>var baseUrl = '<?php echo Yii::app()->baseUrl; ?>';</script>;
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
		<?php echo $form->textField($model,'ticket_no',  array('autocomplete'=>'off')); ?>
		<?php echo $form->error($model,'ticket_no'); ?>
	</div>
        
        <div class="row">
            <button id="fetch">Retrieve Ticket Information</button>
	</div>
        <br />
        <br />
       
        <div class="row">
            <b>Status : </b> <i><span id="ticket_status">Please Enter Ticket Number</span> </i>
	</div>
        <br />
        <br />
        
        <div class="paymentForm">

	<div class="row">
		<?php echo $form->labelEx($model,'sold_with_promotion_id'); ?>
		<?php echo $form->dropDownList($model,'sold_with_promotion_id',  Promotion::getAllPromotions());?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'final_amount_paid'); ?>
		<?php echo $form->textField($model,'final_amount_paid'); ?>
		<?php echo $form->error($model,'final_amount_paid'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'payment_due_on'); ?>
		<?php echo $form->textField($model,'payment_due_on'); ?>
		<?php echo $form->error($model,'payment_due_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payment_comments'); ?>
		<?php echo $form->textField($model,'payment_comments',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'payment_comments'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'guest_ref'); ?>
		<?php echo $form->textField($model,'guest_ref'); ?>
		<?php echo $form->error($model,'guest_ref'); ?>
	</div>

        
        
        
        <div class="row">
		<input type="checkbox" id="Ticket_details_filled_out" name="Ticket[details_filled_out]"  value="1">&nbsp; I have seen the attendee and his details are on the ticket
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>

	<div class="row">
		<?php //$ct = date("Y-m-d H:i:s"); $model->attendee_check_in_time = $ct; echo $ct; ?>
	</div>
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
    
