<?php

$this->breadcrumbs = array(
	Yii::t('app', 'Create'),
);

$this->menu = array(
        array('label'=>Yii::t('app', 'Operations')),
        array('label'=>Yii::t('app', 'Cancel'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
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