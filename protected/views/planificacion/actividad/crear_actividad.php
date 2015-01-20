<?php

$this->breadcrumbs = array(
	//$model_actividad->label(2) => array('verActividades'),
	Yii::t('app', 'Create'),
);

$this->menu = array(
        array('label'=>Yii::t('app', 'Operations')),
        //array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url' => array('listar'), 'icon'=>'list'),
        array('label'=>Yii::t('app', 'Manage') . ' ' . $model_actividad->label(2), 'url' => array('verActividades'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Ver Planificacion Semestral'), 'url'=>array('verPlanificacion', "id" => $model_actividad->planificacion_semestral_id), 'icon'=>'file'),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'Create') . ' ' . GxHtml::encode($model_actividad->label()), null); ?>
<?php
$this->renderPartial('actividad/_formularioActividad', array(
		'model_actividad' => $model_actividad,
                'rango_fechas' => $rango_fechas,
                'model_planificacion' => $model_planificacion,
		'buttons' => 'create'));
?>