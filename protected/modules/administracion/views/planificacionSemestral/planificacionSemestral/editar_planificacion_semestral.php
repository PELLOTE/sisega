<?php

$this->breadcrumbs = array(
	$model_planificacion->label(2) => array('verPlanificaciones'),
	GxHtml::valueEx($model_planificacion) => array('ver', 'id' => GxActiveRecord::extractPkValue($model, true)),
	Yii::t('app', 'Update'),
);

$this->menu = array(       
        array('label'=>Yii::t('app', 'Operations')),
        //array('label' => Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('listar'), 'icon'=>'list'),
        array('label' => Yii::t('app', 'Create') . ' ' . $model_planificacion->label(), 'url'=>array('crearPlanificacion'), 'icon'=>'file'),
        array('label' => Yii::t('app', 'View') . ' ' . $model_planificacion->label(), 'url'=>array('verPlanificacion', 'id' => GxActiveRecord::extractPkValue($model_planificacion, true)), 'icon'=>'eye-open'),
        array('label' => Yii::t('app', 'Manage') . ' ' . $model_planificacion->label(2), 'url'=>array('verPlanificaciones'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'Update') . ' ' . GxHtml::encode($model_planificacion->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model_planificacion)), null); ?>

<?php
$this->renderPartial('planificacionSemestral/_formularioPlanificacion', array(
		'model_planificacion' => $model_planificacion,
                'rango_fecha' => $rango_fecha
        ));
?>