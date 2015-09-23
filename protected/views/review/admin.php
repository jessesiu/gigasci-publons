<?php
/* @var $this ReviewController */
/* @var $model Review */

$this->breadcrumbs=array(
	'Reviews'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Review', 'url'=>array('index')),
	array('label'=>'Create Review', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#review-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Reviews</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'review-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                'publication_doi',
            
                array(
                    'name'=>'publication_title',
                    'htmlOptions'=>array('width'=>'300'),               
                ),
                
                'review_name',
		
		array(
                    'name'=>'date',
                    'htmlOptions' => array('width'=>'300'),
                ),
                'datacite_doi',
                'publon_url',
                array(
                    'name'=>'minted',
                    'filter'=>array('1'=>'Yes','2'=>'No'), 
                    'value'=>'($data->minted==1)? "Yes": "No" ',
                    
                ),
		/*
		'content',
		'source',
		'source_license',
		'publication_title',
		'publication_doi',
		'abstract',
		'url_manuscript',
		'journal',
		'review_doi',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
