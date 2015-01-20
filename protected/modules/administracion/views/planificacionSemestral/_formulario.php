
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'planificacion-semestral-form',
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
        'enableAjaxValidation' => true,
));
?>

	<p class="help-block">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<?php echo $form->dropDownListControlGroup($model,'calendario_docente_id', GxHtml::listDataEx(CalendarioDocente::model()->findAllAttributes(null, true)), array('class'=>'span3 selectpicker', 'empty'=>'', 'placeholder'=> Yii::t('app', 'Select') ));?>
		<?php echo $form->textFieldControlGroup($model,'fecha_creacion', array('span'=>3, 'class'=>'datepicker')); ?>
		<?php echo $form->textFieldControlGroup($model,'fecha_proposicion', array('span'=>3, 'class'=>'datepicker')); ?>
		<?php echo $form->textFieldControlGroup($model,'fecha_respuesta', array('span'=>3, 'class'=>'datepicker')); ?>
		<?php echo $form->textFieldControlGroup($model,'estado', array('span'=>3, 'maxlength'=>45)); ?>
                <?php echo $form->dropDownListControlGroup($model,'semestre', array(1=>'I Semestre',2=>'II Semestre'), array('class'=>'span3 selectpicker', 'empty'=>'Elija un Semestre', 'placeholder'=> Yii::t('app', 'Select') ));?>
		<?php echo $form->textFieldControlGroup($model,'fecha_inicio', array('span'=>3, 'class'=>'datepicker')); ?>
		<?php echo $form->textFieldControlGroup($model,'fecha_termino', array('span'=>3, 'class'=>'datepicker')); ?>
		<?php echo $form->dropDownListControlGroup($model,'user_id', GxHtml::listDataEx(User::model()->findAllAttributes(null, true)), array('class'=>'span3 selectpicker', 'empty'=>'', 'placeholder'=> Yii::t('app', 'Select') ));?>

<?php echo TbHtml::formActions(array(
    TbHtml::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'id'=>'buttonStateful', 'data-loading-text'=>  Yii::t('app', 'Loading...'))),
    TbHtml::resetButton(Yii::t('app', 'Reset')),
));
?>
<?php $this->endWidget(); ?>        
<?php $this->widget('ext.datepicker.Datepicker'); ?>
<?php $this->widget('ext.select2.ESelect2'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/buttonReset.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/buttonStateful.js', CClientScript::POS_END); ?>
