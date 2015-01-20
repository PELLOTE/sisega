<?php

$this->breadcrumbs = array(
	$model->calendarioDocente->label(1) => array('calendarioDocente/ver', 'id'=>$model->calendario_docente_id),
	GxHtml::valueEx($model),
);

$this->menu=array(
        array('label'=>Yii::t('app', 'Operations')),
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
		'semestre',
		'fecha_inicio',
		'fecha_termino',
		'detalle',
		array(
			'name' => 'calendarioDocente',
			'type' => 'raw',
			'value' => $model->calendarioDocente !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->calendarioDocente)), array('calendarioDocente/ver', 'id' => GxActiveRecord::extractPkValue($model->calendarioDocente, true))) : null,
			),
	),
)); ?>

