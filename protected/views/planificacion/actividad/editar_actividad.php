<?php

$this->breadcrumbs = array(
	GxHtml::valueEx($model_actividad) => array('verActividad', 'id' => GxActiveRecord::extractPkValue($model_actividad, true)),
	Yii::t('app', 'Update'),
);

$this->menu = array(       
        array('label'=>Yii::t('app', 'Operations')),
        array('label' => Yii::t('app', 'View') . ' ' . $model_actividad->label(), 'url'=>array('verActividad', 'id' => GxActiveRecord::extractPkValue($model_actividad, true)), 'icon'=>'eye-open'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Ver Planificacion Semestral'), 'url'=>array('verPlanificacion', "id" => $model_actividad->planificacion_semestral_id), 'icon'=>'file'),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'Update') . ' ' . GxHtml::encode($model_actividad->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model_actividad)), null); ?>

<?php
$this->renderPartial('actividad/_formularioActividad', array(
		'model_actividad' => $model_actividad,
                //'rango_fechas' => $rango_fechas,
                'model_planificacion' => $model_planificacion
                ));
?>