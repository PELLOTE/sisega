<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'evaluacion-form',
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
        'enableAjaxValidation' => true,
));
?>

	<p class="help-block">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<?php echo $form->textFieldControlGroup($model,'fecha', array('span'=>3, 'class'=>'datepicker', 'data-date-start-date'=>$model_planificacion_semestral->fecha_inicio, 'data-date-end-date'=>$model_planificacion_semestral->fecha_termino)); ?>
                <?php echo $form->textFieldControlGroup($model,'nombre', array('span'=>3)); ?>
		<?php echo $form->textAreaControlGroup($model,'observacion', array('span'=>3, 'rows'=>3)); ?>

<?php echo TbHtml::formActions(array(
    TbHtml::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'id'=>'buttonStateful', 'data-loading-text'=>  Yii::t('app', 'Loading...'))),
    TbHtml::resetButton(Yii::t('app', 'Reset')),
));
?>
<?php $this->endWidget(); ?>        
<?php $this->widget('ext.datepicker.Datepicker'); ?>
<?php //$this->widget('ext.select2.ESelect2'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/buttonReset.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/buttonStateful.js', CClientScript::POS_END); ?>
