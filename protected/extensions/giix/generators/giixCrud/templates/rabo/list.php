<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n
\$this->breadcrumbs = array(
	{$this->modelClass}::label(2),
);\n";
?>

$this->menu = array(
        array('label'=>Yii::t('app', 'Operations')),
        array('label'=>Yii::t('app', 'Create') . ' ' . <?php echo $this->modelClass; ?>::label(), 'url' => array('create'), 'icon'=>'file'),
        array('label'=>Yii::t('app', 'Manage') . ' ' . <?php echo $this->modelClass; ?>::label(2), 'url' => array('admin'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
        array('label'=>Yii::t('app', 'Up'), 'url'=>'javascript:GoUp()', 'icon'=>'arrow-up', 'id'=>'button-up'),
);
?>
<?php echo '<?php'; ?> echo TbHtml::pageHeader(GxHtml::encode(<?php echo $this->modelClass; ?>::label(2)), TbHtml::labelTb('Admin')); ?>

<?php echo "<?php"; ?> $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); <?php echo '?>'; ?>

<?php echo '<?php'; ?> Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/scroll.js'); ?>