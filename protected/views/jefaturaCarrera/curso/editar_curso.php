<?php

$this->breadcrumbs = array(
	$model_curso->label(2) => array('verCursos'),
	GxHtml::valueEx($model_curso) => array('verCurso', 'id' => GxActiveRecord::extractPkValue($model_curso, true)),
	Yii::t('app', 'Update'),
);

$this->menu = array(       
        array('label'=>Yii::t('app', 'Operations')),
        //array('label' => Yii::t('app', 'List') . ' ' . $model_curso->label(2), 'url'=>array('listar'), 'icon'=>'list'),
        array('label' => Yii::t('app', 'Create') . ' ' . $model_curso->label(), 'url'=>array('crearCurso'), 'icon'=>'file'),
        array('label' => Yii::t('app', 'View') . ' ' . $model_curso->label(), 'url'=>array('verCurso', 'id' => GxActiveRecord::extractPkValue($model_curso, true)), 'icon'=>'eye-open'),
        array('label' => Yii::t('app', 'Manage') . ' ' . $model_curso->label(2), 'url'=>array('verCursos'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'Update') . ' ' . GxHtml::encode($model_curso->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model_curso)), null); ?>

<?php
$this->renderPartial('curso/_formulario', array(
		'model_curso' => $model_curso));
?>