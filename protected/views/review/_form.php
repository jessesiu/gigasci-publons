<?php
/* @var $this ReviewController */
/* @var $model Review */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'review-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'review_name'); ?>
		<?php echo $form->textField($model,'review_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'review_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reviewer_email'); ?>
		<?php echo $form->textField($model,'reviewer_email',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'reviewer_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reviewer_affiliation'); ?>
		<?php echo $form->textField($model,'reviewer_affiliation',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'reviewer_affiliation'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'journal'); ?>
		<?php echo $form->textField($model,'journal',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'journal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		
                <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
  'model'=>$model,
  'attribute'=>'date',
  'value'=>$model->date,
  // additional javascript options for the date picker plugin
  'options'=>array(
    'showAnim'=>'fold',
    'showButtonPanel'=>true,
    'dateFormat'=>'yy-mm-dd',
    
   ),
));?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'privacy'); ?>
		<?php echo $form->textField($model,'privacy',array('size'=>50,'maxlength'=>50, 'value'=>'Show the reviewer reviews this article (open)')); ?>
		<?php echo $form->error($model,'privacy'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('size'=>60,'rows' => 6, 'cols' => 100)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'source'),"<font color=red size='1pt'> If the review is publicly available please provide the URL to credit the source </font><br>"; ?>
		<?php echo $form->textField($model,'source',array('size'=>100,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'source'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'publication_title'); ?>
		<?php echo $form->textArea($model,'publication_title',array('size'=>60,'maxlength'=>2000,'rows' => 4, 'cols' => 100)); ?>
		<?php echo $form->error($model,'publication_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'publication_doi'); ?>
		<?php echo $form->textField($model,'publication_doi',array('size'=>100,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'publication_doi'); ?>
	</div>


	<div class="row">
		<?php echo '<font font-weight= "bolder" font-size="0.9">Manuscript draft version URL&nbsp&nbsp&nbsp&nbspreviewed version </font>',$form->checkBox($model,'draftURLcheck',array('id'=>'1','onclick'=>'check(this.id)')),"<br>";  ?>
		<?php echo $form->textField($model,'draftURL',array('size'=>100,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'draftURL'); ?>
	</div>
        <div class="row">
		<?php echo '<font font-weight= "bolder" font-size="0.9">Manuscript revised version 1 URL&nbsp&nbsp&nbsp&nbspreviewed version </font>',$form->checkBox($model,'revisedURL1check',array('id'=>'2','onclick'=>'check(this.id)')),"<br>";  ?>
		<?php echo $form->textField($model,'revisedURL1',array('size'=>100,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'revisedURL1'); ?>
	</div>
        <div class="row">
                <?php echo '<font font-weight= "bolder" font-size="0.9">Manuscript revised version 2 URL&nbsp&nbsp&nbsp&nbspreviewed version </font>',$form->checkBox($model,'revisedURL2check',array('id'=>'3','onclick'=>'check(this.id)')),"<br>";  ?>

		<?php echo $form->textField($model,'revisedURL2',array('size'=>100,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'revisedURL2'); ?>
	</div>
        <div class="row">
		<?php echo '<font font-weight= "bolder" font-size="0.9">Manuscript revised version 3 URL&nbsp&nbsp&nbsp&nbspreviewed version </font>',$form->checkBox($model,'revisedURL3check',array('id'=>'1','onclick'=>'check(this.id)')),"<br>";  ?>

		<?php echo $form->textField($model,'revisedURL3',array('size'=>100,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'revisedURL3'); ?>
	</div>
	
        
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
<script type="text/javascript" src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
function check(id){
    var flag=0;
    for(var i=1;i<5;i++)
    {
       if(document.getElementById(i).checked==true){
        flag++;
    }
    if(flag>1)
    {
        alert('You checked more than one reviewed version !!!!');
        document.getElementById(id).checked=false;
        break;
    }
        
        
    }
}
</script><!-- form -->