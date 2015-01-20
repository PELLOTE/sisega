<?php

$this->breadcrumbs = array(
	$model_asignatura->label(2) => array('verAsignaturas'),
	GxHtml::valueEx($model_asignatura) => array('verAsignatura', 'id' => GxActiveRecord::extractPkValue($model_asignatura, true)),
	Yii::t('app', 'Update'),
);

$this->menu = array(       
        array('label'=>Yii::t('app', 'Operations')),
        //array('label' => Yii::t('app', 'List') . ' ' . $model_asignatura->label(2), 'url'=>array('listar'), 'icon'=>'list'),
        array('label' => Yii::t('app', 'Create') . ' ' . $model_asignatura->label(), 'url'=>array('crearAsignatura'), 'icon'=>'file'),
        array('label' => Yii::t('app', 'View') . ' ' . $model_asignatura->label(), 'url'=>array('verAsignatura', 'id' => GxActiveRecord::extractPkValue($model_asignatura, true)), 'icon'=>'eye-open'),
        array('label' => Yii::t('app', 'Manage') . ' ' . $model_asignatura->label(2), 'url'=>array('verAsignaturas'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'Update') . ' ' . GxHtml::encode($model_asignatura->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model_asignatura)), null); ?>

<?php
$this->renderPartial('asignatura/_formulario', array(
		'model_asignatura' => $model_asignatura));
?>