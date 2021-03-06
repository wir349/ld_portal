<?php
/* @var $this TicketController */
/* @var $model Ticket */

?>
<h1>Payment Information Form<?php echo $model->ticket_id; ?></h1>


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
            
            console.log(datar);
            
            
        })
        .fail(function() {
            $(".paymentForm").hide();
            alert( "Ticket ID is invalid." );
        });
        
    }); 
  
});








</script>
    
      
