<?php
/* @var $this ReviewController */
/* @var $data Review */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('review_name')); ?>:</b>
	<?php echo CHtml::encode($data->review_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reviewer_email')); ?>:</b>
	<?php echo CHtml::encode($data->reviewer_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reviewer_affiliation')); ?>:</b>
	<?php echo CHtml::encode($data->reviewer_affiliation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('privacy')); ?>:</b>
	<?php echo CHtml::encode($data->privacy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo CHtml::encode($data->content); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('source')); ?>:</b>
	<?php echo CHtml::encode($data->source); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('source_license')); ?>:</b>
	<?php echo CHtml::encode($data->source_license); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publication_title')); ?>:</b>
	<?php echo CHtml::encode($data->publication_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publication_doi')); ?>:</b>
	<?php echo CHtml::encode($data->publication_doi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('abstract')); ?>:</b>
	<?php echo CHtml::encode($data->abstract); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url_manuscript')); ?>:</b>
	<?php echo CHtml::encode($data->url_manuscript); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('journal')); ?>:</b>
	<?php echo CHtml::encode($data->journal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('review_doi')); ?>:</b>
	<?php echo CHtml::encode($data->review_doi); ?>
	<br />

	*/ ?>

</div>