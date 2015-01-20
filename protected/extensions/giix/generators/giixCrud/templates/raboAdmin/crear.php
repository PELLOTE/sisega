<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n
\$this->breadcrumbs = array(
	\$model->label(2) => array('listar'),
	Yii::t('app', 'Create'),
);\n";
?>

$this->menu = array(
        array('label'=>Yii::t('app', 'Operations')),
        array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url' => array('listar'), 'icon'=>'list'),
        array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('administrar'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo '<?php'; ?> echo TbHtml::pageHeader(Yii::t('app', 'Create') . ' ' . GxHtml::encode($model->label()), TbHtml::labelTb('Admin')); ?>
<?php echo "<?php\n"; ?>
$this->renderPartial('_formulario', array(
		'model' => $model,
		'buttons' => 'create'));
<?php echo '?>'; ?>