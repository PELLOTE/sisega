
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'asignatura-form',
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
        'enableAjaxValidation' => true,
));
?>

	<p class="help-block">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<?php echo $form->textFieldControlGroup($model,'nombre', array('span'=>3, 'maxlength'=>255)); ?>
		<?php echo $form->textFieldControlGroup($model,'semestre', array('span'=>3, 'maxlength'=>3)); ?>
		<?php echo $form->textAreaControlGroup($model,'programa', array('span'=>3, 'rows'=>3)); ?>
		<?php echo $form->textFieldControlGroup($model,'codigo', array('span'=>3, 'maxlength'=>45)); ?>
		<?php echo $form->textFieldControlGroup($model,'numero', array('span'=>3, 'maxlength'=>3)); ?>
		<?php echo $form->textFieldControlGroup($model,'catedra', array('span'=>3, 'maxlength'=>3)); ?>
		<?php echo $form->textFieldControlGroup($model,'taller', array('span'=>3, 'maxlength'=>3)); ?>
		<?php echo $form->textFieldControlGroup($model,'laboratorio', array('span'=>3, 'maxlength'=>3)); ?>
		<?php echo $form->textFieldControlGroup($model,'tipo_formacion', array('span'=>3, 'maxlength'=>100)); ?>

<?php echo TbHtml::formActions(array(
    TbHtml::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'id'=>'buttonStateful', 'data-loading-text'=>  Yii::t('app', 'Loading...'))),
    TbHtml::resetButton(Yii::t('app', 'Reset')),
));
?>
<?php $this->endWidget(); ?>        
<?php $this->widget('ext.select2.ESelect2'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/buttonReset.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/buttonStateful.js', CClientScript::POS_END); ?>
