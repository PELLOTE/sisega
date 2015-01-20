<?php

$this->breadcrumbs = array(
        Yii::t('app', $this->module->id) => Yii::app()->createUrl($this->module->baseUrl),  
	$model->label(2) => array('administrar'),
	GxHtml::valueEx($model) => array('ver', 'id' => GxActiveRecord::extractPkValue($model, true)),
	Yii::t('app', 'Update'),
);

$this->menu = array(       
        array('label'=>Yii::t('app', 'Operations')),
        array('label'=>Yii::t('app', 'Cancel'), 'url'=>'javascript:history.back()', 'icon'=>'remove'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'Matricular Alumno'), TbHtml::labelTb('Admin')); ?>

<?php
$this->renderPartial('_formularioMatricula', array(
		'model' => $model));
?>