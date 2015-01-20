<?php

$this->breadcrumbs = array(
	GxHtml::valueEx($model) => array('ver', 'id' => GxActiveRecord::extractPkValue($model, true)),
	Yii::t('app', 'Update'),
);

$this->menu = array(       
        array('label'=>Yii::t('app', 'Operations')),
        array('label'=>Yii::t('app', 'Cancel'), 'url'=>'javascript:history.back()', 'icon'=>'remove'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'Update') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)), TbHtml::labelTb('Admin')); ?>

<?php
$this->renderPartial('_formulario', array(
		'model' => $model,
                'model_calendario' => $model_calendario));
?>