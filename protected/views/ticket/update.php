<?php
/* @var $this TicketController */
/* @var $model Ticket */

?>
<h1>Update Ticket <?php echo $model->ticket_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'saved'=>$saved)); ?>