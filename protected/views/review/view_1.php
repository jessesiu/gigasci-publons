<?php
/* @var $this ReviewController */
/* @var $model Review */

$this->breadcrumbs=array(
	'Reviews'=>array('index'),
	$model->id,
);

$this->menu=array(
	
	array('label'=>'Create Review', 'url'=>array('create')),
	array('label'=>'Update Review', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Review', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
        array('label'=>'Mint DOI', 'url'=>array('mint','doi'=>$model->datacite_doi,'url'=>$model->publon_url, 'id'=>$model->id)),
);
?>

<h1>View Review #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'review_name',
		'reviewer_email',
		'reviewer_affiliation',
		'date',
		'privacy',
		'content',
		'source',
		'publication_title',
		'publication_doi',
		'journal',
                'publon_url',
                'datacite_doi',
                'minted',
	),
)); 

?>
