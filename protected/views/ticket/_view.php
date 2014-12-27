<?php
/* @var $this TicketController */
/* @var $data Ticket */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ticket_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ticket_id), array('view', 'id'=>$data->ticket_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('event_id')); ?>:</b>
	<?php echo CHtml::encode($data->event_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ticket_no')); ?>:</b>
	<?php echo CHtml::encode($data->ticket_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sold_with_promotion_id')); ?>:</b>
	<?php echo CHtml::encode($data->sold_with_promotion_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('distribution_source_distribution_source_id')); ?>:</b>
	<?php echo CHtml::encode($data->distribution_source_distribution_source_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('attendee_id_given_to')); ?>:</b>
	<?php echo CHtml::encode($data->attendee_id_given_to); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('attendee_check_in_time')); ?>:</b>
	<?php echo CHtml::encode($data->attendee_check_in_time); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('final_amount_paid')); ?>:</b>
	<?php echo CHtml::encode($data->final_amount_paid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_by_user')); ?>:</b>
	<?php echo CHtml::encode($data->updated_by_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_comments')); ?>:</b>
	<?php echo CHtml::encode($data->payment_comments); ?>
	<br />

	*/ ?>

</div>