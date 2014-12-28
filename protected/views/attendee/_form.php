<?php
/* @var $this AttendeeController */
/* @var $model Attendee */
/* @var $form CActiveForm */


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


	
	<?php foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
         }?>
		
	
	
    
        <div class="ticketNo">
            <div class="row">
                    <?php echo $form->labelEx($ticketModel,'ticket_no'); ?>
                    <?php echo $form->textField($ticketModel,'ticket_no',  array('autocomplete'=>'off')); ?>
                    <?php echo $form->error($ticketModel,'ticket_no'); ?>
            </div>
            <div class="row">
                <button class="btn btn-small btn-info" id="checkTicket">Validate Ticket No.</button>
            </div>
                
        
        </div>
    
    
    
    
    
        <div class="phoneNumber">
	<div class="row">
		<?php echo $form->labelEx($model,'Phone Number'); ?>
		<?php echo $form->textField($model,'country_code',  array(
                    'value'=>'+92', 
                    'size'=>4)
                        ); ?>
		<?php echo $form->textField($model,'phone_number',  array(
                    'autocomplete'=>'off',
                    'size'=>11)
                        ); ?>
		<?php //echo $form->error($model,'ticket_no'); ?>
	</div>

        <div class="row">
            <button class="btn btn-small btn-info" id="checkPhoneNumber">Retrieve Contact Information</button>
	</div>
        <br />
        
        </div>
        
        <div class="selectContactInfoType">

	<div class="row">
            <select id="Attendee_attendee_id" name="Attendee[attendee_id]" size="3">
            
                
            </select>
        </div>

	
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'email_address'); ?>
		<?php echo $form->textField($model,'email_address',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'email_address'); ?>
	</div>

	

        <div class="row">
		<?php echo $form->labelEx($model,'date_of_birth'); ?>
		 <?php 
                                    $this->widget( 
                                        'bootstrap.widgets.TbDatePicker', array( 
                                        'model' => $model, 
                                        'value' => $model->date_of_birth,  
                                        'name' => 'Attendee[date_of_birth]',
                                         'options' => array('startView' => 'decade' ,'format' => 'yyyy-mm-dd')
                                             ) 
                                     );
                       
                                    ?> 
		<?php echo $form->error($model,'date_of_birth'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php echo $form->textField($model,'gender',array('size'=>7,'maxlength'=>7)); ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>
            
        <div class="row">
		<?php echo $form->labelEx($model,'area'); ?>
		<?php echo $form->textArea($model,'area',array('rows'=>3,'size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'area'); ?>
	</div>
            
        <div class="row buttons">
		<?php echo CHtml::submitButton('Update',array('class'=>"btn btn-success")); ?>
                <button class="btn btn-danger" id="reset">Reset</button>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
     var currentAttendeesData = '';
$( document ).ready(function() {
    
   
    $('.phoneNumber').hide();
    $('.selectContactInfoType').hide();
    
    
    
    $("#checkTicket").click(function(e){
        e.preventDefault();
        if ( $('#Ticket_ticket_no').val() == '' || $('#Ticket_ticket_no').val().length < 2) {
             alert( "Ticket ID is invalid." );
            return;
        }
       
        $.ajax({
            type: "POST",
            url: baseUrl + "/index.php?r=ticket/validateTicket",
            data: { 'ticket_no': $('#Ticket_ticket_no').val() },
            dataType: 'json'
        })
        .done(function(datar) {
            $('#Ticket_ticket_no').attr('readonly',true);
            clearFields(); clearBox();
            $('.phoneNumber').show();
            console.log(datar);
            
        })
        .fail(function() {
            alert( "Ticket ID is invalid." );
        });


    });
    
    
    
      $("#checkPhoneNumber").click(function(e){
        e.preventDefault();
        if ( $('#Attendee_phone_number').val() == '' || $('#Attendee_phone_number').val().length < 10) {
             alert('Please Enter Complete Number');
            return;
        }
        $.ajax({
            type: "POST",
            url: baseUrl + "/index.php?r=attendee/validatePhone",
            data: { 'country_code': $('#Attendee_country_code').val() , 'phone_number': $('#Attendee_phone_number').val() },
            dataType: 'json'
        })
        .done(function(datar) {
            clearFields();clearBox();
           $('#Attendee_phone_number').attr('readonly',true);
           $('#Attendee_country_code').attr('readonly',true);
            $('.selectContactInfoType').show();
            if ( datar['isNew'] == false) {
                currentAttendeesData = datar['data'];
                for(var attKey in currentAttendeesData ) {
                    $('#Attendee_attendee_id')
                    .append($("<option></option>")
                    .attr("value",attKey)
                    .text(currentAttendeesData[attKey]['name'])); 
                }
            } 
                 $('#Attendee_attendee_id')
                    .append($("<option></option>")
                    .attr("value",0)
                    .text('- New Participant -')); 
            
            
        })
        .fail(function() {
            alert( "Unable to Process Phone Number." );
            $('.selectContactInfoType').show();
        });


    });
    
    
    
     $("#Attendee_attendee_id").change(function(e){
        
            if ( !! e.target.value ) {
                var id = e.target.value;
                if ( !!currentAttendeesData[id] ) {
                    $('#Attendee_name').val(currentAttendeesData[id]['name']);
                    $('#Attendee_email_address').val(currentAttendeesData[id]['email_address']);    
                    $('#Attendee_date_of_birth').val(currentAttendeesData[id]['date_of_birth']);
                    $('#Attendee_area').val(currentAttendeesData[id]['name']);
                    
                } else {
                   clearFields();
                }
            }

    });
  
    

    $("#Attendee_phone_number").keypress(function (e) {
        if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
             $("#checkPhoneNumber").click();
            return false;
        } else {
            return true;
        }
    });
    
    
    function clearFields() {
                    $('#Attendee_name').val('');
                    $('#Attendee_email_address').val('');    
                    $('#Attendee_date_of_birth').val('');
                    $('#Attendee_area').val('');
    }
    
    function clearBox() {
         $('#Attendee_attendee_id')
                        .children().remove();
    }
    
    
    $("#reset").click(function(e){
         e.preventDefault();
        clearFields();
        clearBox();
        $('#Ticket_ticket_no').attr('readonly',false);
        $('#Attendee_phone_number').attr('readonly',false);
        $('#Attendee_country_code').attr('readonly',false);
        $('.selectContactInfoType').hide();
        $('.selectContactInfoType').hide();
        $('.phoneNumber').hide();
       
    });

});








</script>
    