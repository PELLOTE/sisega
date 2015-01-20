<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<div class="wide form">
<?php echo '<?php '; ?>
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'search-<?php echo $this->class2id($this->modelClass);?>-form',
	'action'=>Yii::app()->createUrl($this->route),
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
	'method'=>'get',
        'htmlOptions'=>array('class'=>'well'),
)); ?>

<?php foreach($this->tableSchema->columns as $column): ?>
<?php
	$field = $this->generateInputField($this->modelClass, $column, true);
	if (strpos($field, 'password') !== false)
		continue;
?>
	<?php echo $this->generateInput($this->modelClass, $column, true) . "\n"; ?>
<?php if(strtoupper($column->dbType) == 'DATE'){ ?>
	<?php echo $this->generateDateInputByName($column->name."_inicio") . "\n"; ?>
	<?php echo $this->generateDateInputByName($column->name."_termino"). "\n"; ?>
<?php } ?>

<?php endforeach; ?>
        <div class="form-actions">
        <?php echo "<?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'icon'=>'white search'));?>\n"; ?>
        <?php echo "<?php echo TbHtml::resetButton(Yii::t('app', 'Reset'), array('icon'=>'icon-remove-sign')); ?>\n"; ?>
        </div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- search-form -->
<?php echo $this->generateScripts(true); ?>

