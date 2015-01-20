<?php

$this->breadcrumbs = array(
	//$model->label(2) => array('administrar'),
	GxHtml::valueEx($model),
);

$this->menu=array(
        array('label'=>Yii::t('app', 'Operations')),
        //array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('listar'), 'icon'=>'list'),
        //array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('crear'), 'icon'=>'file'),
        array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('editarActividad', 'id' => $model->id), 'icon'=>'pencil'),
        //array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('borrar', 'id' => $model->id), 'confirm'=>Yii::t('app', 'Are you sure you want to delete this item?')), 'icon'=>'trash'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Ver Planificacion Semestral'), 'url'=>array('verPlanificacion', "id" => $model->planificacion_semestral_id), 'icon'=>'file'),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)), null); ?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		'id',
		array(
			'name' => 'planificacionSemestral',
			'type' => 'raw',
			'value' => $model->planificacionSemestral !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->planificacionSemestral)), array('planificacion/verPlanificacion', 'id' => GxActiveRecord::extractPkValue($model->planificacionSemestral, true))) : null,
			),
		'fecha_inicio',
		'fecha_termino',
		'detalle',
	),
)); ?>

