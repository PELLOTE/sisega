<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n
\$this->breadcrumbs = array(
	\$model->label(2) => array('list'),
	Yii::t('app', 'Manage'),
);\n";
?>

$this->menu = array(
        array('label'=>Yii::t('app', 'Operations')),
        array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('list'), 'icon'=>'list'),
        array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create'), 'icon'=>'file'),
        array('label'=>Yii::t('app', 'Export')),
        array('label'=>Yii::t('app', 'Export to Excel'), 'url'=>Yii::app()->controller->createUrl('GenerarExcel'), 'linkOptions'=>array('target'=>'_blank'), 'icon'=>'download-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<div class="title-menu">
        <?php echo '<?php'; ?> echo TbHtml::pageHeader(Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)), TbHtml::labelTb('Admin')); ?>
</div>

<p>
<?php echo "<?php echo Yii::t('app', 'Text Option Search'); ?>"; ?>
</p>

<div class="buttons-admin">
<?php echo "<?php"; ?> 
       echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button btn'));
?>
</div>
<div class="search-form">
<?php echo "<?php \$this->renderPartial('_search', array(
	'model' => \$model,
)); ?>\n"; ?>
</div><!-- search-form -->

<?php echo '<?php'; ?> $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => '<?php echo $this->class2id($this->modelClass); ?>-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
        'type'=>'striped bordered condensed',
        'template'=>"{summary}{items}{pager}",
        //'htmlOptions' => array(
        //                        'style' => 'overflow-y:auto;'
        //                                   .'table-layout:fixed;'
        //                                   .'white-space:nowrap;'
        //                                   ),       
	'columns' => array(
<?php
$count = 0;
foreach ($this->tableSchema->columns as $column) {
	if (++$count == 7)
		echo "\t\t/*\n";
	echo "\t\t" . $this->generateGridViewColumn($this->modelClass, $column).",\n";
}
if ($count >= 7)
	echo "\t\t*/\n";
?>
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
          ),                
	),
)); ?>

<?php echo "<?php\n"; ?>
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').slideToggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('<?php echo $this->class2id($this->modelClass); ?>-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>