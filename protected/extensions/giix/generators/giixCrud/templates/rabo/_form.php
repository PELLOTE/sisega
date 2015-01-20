<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php $ajax = ($this->enable_ajax_validation) ? 'true' : 'false'; ?>

<?php echo '<?php '; ?>
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => '<?php echo $this->class2id($this->modelClass); ?>-form',
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
        'enableAjaxValidation' => <?php echo $ajax; ?>,
));
<?php echo '?>'; ?>


	<p class="help-block">
		<?php echo "<?php echo Yii::t('app', 'Fields with'); ?> <span class=\"required\">*</span> <?php echo Yii::t('app', 'are required'); ?>"; ?>.
	</p>

	<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

<?php foreach ($this->tableSchema->columns as $column): ?>
<?php if (!$column->autoIncrement): ?>
		<?php echo $this->generateInput($this->modelClass, $column) ."\n"; ?>
<?php endif; ?>
<?php endforeach; ?>   
        
<?php echo "<?php "; ?>
echo TbHtml::formActions(array(
    TbHtml::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'id'=>'buttonStateful', 'data-loading-text'=>  Yii::t('app', 'Loading...'))),
    TbHtml::resetButton(Yii::t('app', 'Reset')),
));
<?php echo '?>'; ?>

<?php echo "<?php \$this->endWidget(); ?>" ?>
        
<?php echo $this->generateScripts(); ?>