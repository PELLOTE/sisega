<?php

$this->breadcrumbs = array(
	ActividadUta::label(2),
);

$this->menu = array(
        array('label'=>Yii::t('app', 'Operations')),
        array('label'=>Yii::t('app', 'Create') . ' ' . ActividadUta::label(), 'url' => array('crear'), 'icon'=>'file'),
        array('label'=>Yii::t('app', 'Manage') . ' ' . ActividadUta::label(2), 'url' => array('administrar'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
        array('label'=>Yii::t('app', 'Up'), 'url'=>'javascript:GoUp()', 'icon'=>'arrow-up', 'id'=>'button-up'),
);
?>
<?php echo TbHtml::pageHeader(GxHtml::encode(ActividadUta::label(2)), TbHtml::labelTb('Admin')); ?>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_vista',
)); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/scroll.js'); ?>