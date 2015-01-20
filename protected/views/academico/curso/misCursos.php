<?php
$this->breadcrumbs = array(
        Yii::app()->user->profesor => Yii::app()->createUrl('academico/panel'),
	Curso::label(2),
);

$this->menu = array(
//        array('label'=>Yii::t('app', 'Operations')),
//        array('label'=>Yii::t('app', 'Create') . ' ' . Curso::label(), 'url' => array('crear'), 'icon'=>'file'),
//        array('label'=>Yii::t('app', 'Manage') . ' ' . Curso::label(2), 'url' => array('administrar'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
        array('label'=>Yii::t('app', 'Up'), 'url'=>'javascript:GoUp()', 'icon'=>'arrow-up', 'id'=>'button-up'),
);
?>
<?php echo TbHtml::pageHeader(GxHtml::encode(Curso::label(2)), null); ?>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'curso/_cursos',
        'template' => "{items}\n<div class=\"row-fluid\"><div class=\"span6\">{pager}</div><div class=\"span6\">{summary}</div></div>",
        'itemsCssClass'=>'row',
)); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/scroll.js'); ?>