<?php

$this->breadcrumbs = array(
        Yii::t('app', $this->module->id) => Yii::app()->createUrl($this->module->baseUrl),  
	'Ver Malla' => array('malla/index', 'id'=>$model->alumno_id),
	Yii::t('app', 'Create'),
);

$this->menu = array(
        array('label'=>Yii::t('app', 'Operations')),
        array('label'=>Yii::t('app', 'Cancel'), 'url'=>'javascript:history.back()', 'icon'=>'remove'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'Create') . ' ' . GxHtml::encode($model->label()), TbHtml::labelTb('Admin')); ?>



<?php
    
$this->renderPartial('_crearEvaluacion', array(
                'model' => $model,));

