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
	GxHtml::valueEx(\$model) => array('ver', 'id' => GxActiveRecord::extractPkValue(\$model, true)),
	Yii::t('app', 'Update'),
);\n";
?>

$this->menu = array(       
        array('label'=>Yii::t('app', 'Operations')),
        array('label' => Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('listar'), 'icon'=>'list'),
        array('label' => Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('crear'), 'icon'=>'file'),
        array('label' => Yii::t('app', 'View') . ' ' . $model->label(), 'url'=>array('ver', 'id' => GxActiveRecord::extractPkValue($model, true)), 'icon'=>'eye-open'),
        array('label' => Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('administrar'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo '<?php'; ?> echo TbHtml::pageHeader(Yii::t('app', 'Update') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)), TbHtml::labelTb('Admin')); ?>

<?php echo "<?php\n"; ?>
$this->renderPartial('_formulario', array(
		'model' => $model));
?>