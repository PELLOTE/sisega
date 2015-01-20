<?php

$this->breadcrumbs = array(
        Yii::t('app', $this->module->id) => Yii::app()->createUrl($this->module->baseUrl),  
	$model->label(2) => array('admin'),
	GxHtml::valueEx($model) => array('view', 'id' => GxActiveRecord::extractPkValue($model, true)),
	Yii::t('app', 'Update'),
);

$this->menu = array(       
        array('label'=>Yii::t('app', 'Operations')),
        array('label' => Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index'), 'icon'=>'list'),
        array('label' => Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create'), 'icon'=>'file'),
        array('label' => Yii::t('app', 'View') . ' ' . $model->label(), 'url'=>array('view', 'id' => GxActiveRecord::extractPkValue($model, true)), 'icon'=>'eye-open'),
        array('label' => Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'Update') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)), TbHtml::labelTb('Admin')); ?>

<?php
$this->renderPartial('_form', array(
		'model' => $model));
?>