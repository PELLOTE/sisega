
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'actividad-form',
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
        'enableAjaxValidation' => true,
));
?>

	<p class="help-block">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model_actividad); ?>

		
		<?php echo $form->textFieldControlGroup($model_actividad,'fecha_inicio', array('span'=>3, 'class'=>'datepicker', 'data-date-start-date'=>$model_planificacion->fecha_inicio, 'data-date-end-date'=>$model_planificacion->fecha_termino)); ?>
		<?php echo $form->textFieldControlGroup($model_actividad,'fecha_termino', array('span'=>3, 'class'=>'datepicker', 'data-date-start-date'=>$model_planificacion->fecha_inicio, 'data-date-end-date'=>$model_planificacion->fecha_termino)); ?>
		<?php echo $form->textAreaControlGroup($model_actividad,'detalle', array('span'=>3, 'rows'=>3)); ?>

<?php echo TbHtml::formActions(array(
    TbHtml::submitButton($model_actividad->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'id'=>'buttonStateful', 'data-loading-text'=>  Yii::t('app', 'Loading...'))),
    TbHtml::resetButton(Yii::t('app', 'Reset')),
));
?>
<?php $this->endWidget(); ?>        
<?php $this->widget('ext.datepicker.Datepicker'); ?>
<?php $this->widget('ext.select2.ESelect2'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/buttonReset.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/buttonStateful.js', CClientScript::POS_END); ?>
