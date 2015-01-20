
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'alumno-form',
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
        'enableAjaxValidation' => true,
));
?>

	<p class="help-block">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<?php echo $form->textFieldControlGroup($model,'nombre', array('span'=>3, 'maxlength'=>255, 'disabled'=>true)); ?>
		<?php echo $form->textFieldControlGroup($model,'run', array('span'=>3, 'maxlength'=>12, 'disabled'=>true)); ?>
                <?php echo $form->textFieldControlGroup($model,'anio_ingreso', array('span'=>3, 'maxlength'=>11, 'disabled'=>true)); ?></br>
		<?php echo $form->checkBoxListControlGroup($model, 'cursos', GxHtml::encodeEx(GxHtml::listDataEx(Curso::model()->findAllAttributes(null, true)))); ?>

<?php echo TbHtml::formActions(array(
    TbHtml::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'id'=>'buttonStateful', 'data-loading-text'=>  Yii::t('app', 'Loading...'))),
    TbHtml::resetButton(Yii::t('app', 'Reset')),
));
?>
<?php $this->endWidget(); ?>        
<?php $this->widget('ext.select2.ESelect2'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/buttonReset.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/buttonStateful.js', CClientScript::POS_END); ?>
