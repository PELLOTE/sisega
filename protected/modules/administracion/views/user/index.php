<?php

$this->breadcrumbs = array(
    Yii::t('app', $this->module->id) => Yii::app()->createUrl($this->module->baseUrl),  
    User::label(2),
);

$this->menu = array(
        array('label'=>Yii::t('app', 'Operations')),
        array('label'=>Yii::t('app', 'Create') . ' ' . User::label(), 'url' => array('create'), 'icon'=>'file'),
        array('label'=>Yii::t('app', 'Manage') . ' ' . User::label(2), 'url' => array('admin'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
        array('label'=>Yii::t('app', 'Up'), 'url'=>'javascript:GoUp()', 'icon'=>'arrow-up', 'id'=>'button-up'),
);
?>
<?php echo TbHtml::pageHeader(GxHtml::encode(User::label(2)), TbHtml::labelTb('Admin')); ?>

<?php $this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
)); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/scroll.js'); ?>