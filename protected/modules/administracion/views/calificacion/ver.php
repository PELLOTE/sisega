<?php

$this->breadcrumbs = array(
        Yii::t('app', $this->module->id) => Yii::app()->createUrl($this->module->baseUrl),  
	$model->evaluacion->label(1) => array('evaluacion/ver', 'id'=>$model->evaluacion_id),
	GxHtml::valueEx($model),
);

$this->menu=array(
        array('label'=>Yii::t('app', 'Operations')),
        array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('crear'), 'icon'=>'file'),
        array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('actualizar', 'id' => $model->id), 'icon'=>'pencil'),
        array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('borrar', 'id' => $model->id), 'confirm'=>Yii::t('app', 'Are you sure you want to delete this item?')), 'icon'=>'trash'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)), TbHtml::labelTb('Admin')); ?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		'id',
		array(
			'name' => 'alumno',
			'type' => 'raw',
			'value' => $model->alumno !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->alumno)), array('alumno/ver', 'id' => GxActiveRecord::extractPkValue($model->alumno, true))) : null,
			),
		array(
			'name' => 'evaluacion',
			'type' => 'raw',
			'value' => $model->evaluacion !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->evaluacion)), array('evaluacion/ver', 'id' => GxActiveRecord::extractPkValue($model->evaluacion, true))) : null,
			),
		array(
			'name' => 'curso',
			'type' => 'raw',
			'value' => $model->curso !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->curso)), array('curso/ver', 'id' => GxActiveRecord::extractPkValue($model->curso, true))) : null,
			),
		'nota',
	),
)); ?>

