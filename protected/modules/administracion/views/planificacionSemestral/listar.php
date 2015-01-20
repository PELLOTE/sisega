<?php

$this->breadcrumbs = array(
        Yii::t('app', $this->module->id) => Yii::app()->createUrl($this->module->baseUrl),  
	PlanificacionSemestral::label(2),
);

$this->menu = array(
        array('label'=>Yii::t('app', 'Operations')),
        array('label'=>Yii::t('app', 'Create') . ' ' . PlanificacionSemestral::label(), 'url' => array('crear'), 'icon'=>'file'),
        array('label'=>Yii::t('app', 'Manage') . ' ' . PlanificacionSemestral::label(2), 'url' => array('administrar'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
        array('label'=>Yii::t('app', 'Up'), 'url'=>'javascript:GoUp()', 'icon'=>'arrow-up', 'id'=>'button-up'),
);
?>
<?php echo TbHtml::pageHeader(GxHtml::encode(PlanificacionSemestral::label(2)), TbHtml::labelTb('Admin')); ?>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_vista',
)); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/scroll.js'); ?>