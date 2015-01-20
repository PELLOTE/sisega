<?php

$this->breadcrumbs = array(
	Yii::t('app', 'Update'),
);

$this->menu = array(       
        array('label'=>Yii::t('app', 'Operations')),
        array('label'=>Yii::t('app', 'Cancel'), 'url'=>'javascript:history.back()', 'icon'=>'remove'),
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