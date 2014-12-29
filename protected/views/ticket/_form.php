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

	
	
	<?php foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
         }?>
		
	<div class="row">
		<?php echo $form->labelEx($model,'ticket_no'); ?>
		<?php echo $form->textField($model,'ticket_no',  array('autocomplete'=>'off')); ?>
		<?php echo $form->error($model,'ticket_no'); ?>
	</div>
        
        <div class="row">
            <button class="btn btn-small" id="fetch">Retrieve Ticket Information</button>
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
            <?php 
            $promotions_list = Promotion::getAllPromotions();
            echo $form->dropDownList($model,'sold_with_promotion_id', $promotions_list, array( 'empty' => '--Select a Promotion --'));
            ?>
	</div>

	<div class="row final_amount_paid_div">
		<?php echo $form->labelEx($model,'final_amount_paid'); ?>
		<?php echo $form->textField($model,'final_amount_paid'); ?>
		<?php echo $form->error($model,'final_amount_paid'); ?>
	</div>

        <div class="row payment_due_on_div">
		<?php echo $form->labelEx($model,'payment_due_on'); ?>
		<?php echo $form->textField($model,'payment_due_on'); ?>
		<?php echo $form->error($model,'payment_due_on'); ?>
	</div>

        <div class="row guest_ref_div">
		<?php echo $form->labelEx($model,'guest_ref'); ?>
		<?php echo $form->textField($model,'guest_ref'); ?>
		<?php echo $form->error($model,'guest_ref'); ?>

	</div>

            
	<div class="row payment_comments_div">
		<?php echo $form->labelEx($model,'payment_comments'); ?>
		<?php echo $form->textArea($model,'payment_comments',array('rows'=>3,'size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'payment_comments'); ?>
	</div>
        
        <div class="row">
            <?php echo $form->checkBox($model,'details_filled_out', array('value'=>1, 'uncheckValue'=>0)); ?> I have seen the attendee and his details are on the ticket
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Save',array('class'=>"btn btn-success")); ?>
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
            
            //if(datar['status'] == 'PAID' data )
            //    $('#Ticket_final_amount_paid').attr("disabled", true);
            //else
            //    $('#Ticket_final_amount_paid').attr("disabled", false);
            console.log(datar);
            if(datar['sold_with_promotion_id'] == null) {
                console.log(datar);
                $(".final_amount_paid_div").hide();
                $(".payment_due_on_div").hide();
                $(".payment_comments_div").hide();
                $(".guest_ref_div").hide();
            }
            else if(datar['sold_with_promotion_id'] == "16") {
                $(".final_amount_paid_div").hide();
                $(".payment_due_on_div").hide();
                $(".payment_comments_div").hide();
                $(".guest_ref_div").show();
            }
            else {
                $(".final_amount_paid_div").show();
                $(".payment_due_on_div").show();
                $(".payment_comments_div").show();
                $(".guest_ref_div").hide();
            }
            
        })
        .fail(function() {
            $(".paymentForm").hide();
            alert( "Ticket ID is invalid." );
        });
        
    }); 
    $("#Ticket_sold_with_promotion_id").change(function(e){
        if($("#Ticket_sold_with_promotion_id option:selected").index() == 0) {
                $(".final_amount_paid_div").hide();
                $(".payment_due_on_div").hide();
                $(".payment_comments_div").hide();
                $(".guest_ref_div").hide();
        }
        else if($("#Ticket_sold_with_promotion_id option:selected").index() == "16") {
                $(".final_amount_paid_div").hide();
                $(".payment_due_on_div").hide();
                $(".payment_comments_div").show();
                $(".guest_ref_div").show();
            }
            else {
                $(".final_amount_paid_div").show();
                $(".payment_due_on_div").show();
                $(".payment_comments_div").show();
                $(".guest_ref_div").hide();
            }
    });
    $("#Ticket_payment_due_on").keyup(function(e){
        if($("#Ticket_payment_due_on").val() != "") {
            $("#Ticket_final_amount_paid").prop("disabled", true);
            $("#Ticket_final_amount_paid").val(0);
        }
        else {
            $("#Ticket_final_amount_paid").prop("disabled", false);
        }
        
        
    });
});








</script>
    
      
