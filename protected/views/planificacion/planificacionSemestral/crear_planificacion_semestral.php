<?php

$this->breadcrumbs = array(
	$model_planificacion->label(2) => array('verPlanificaciones'),
	Yii::t('app', 'Create'),
);

$this->menu = array(
        //array('label'=>Yii::t('app', 'Operations')),
        //array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url' => array('listar'), 'icon'=>'list'),
        array('label'=>Yii::t('app', 'Manage') . ' ' . $model_planificacion->label(2), 'url' => array('verPlanificaciones'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'Create') . ' ' . GxHtml::encode($model_planificacion->label()), null); ?>
<?php
$this->renderPartial('planificacionSemestral/_formularioPlanificacion', array(
		'model_planificacion' => $model_planificacion,
                'rango_fecha' => $rango_fecha,
		'buttons' => 'create'));
?>