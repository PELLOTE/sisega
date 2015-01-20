<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'evaluacion-semestral-form',
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
        'enableAjaxValidation' => true,
        //'enableClientValidation'=> false,
));
?>

	<p class="help-block">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<?php echo $form->textFieldControlGroup($model,'alumno_id', GxHtml::listDataEx(Alumno::model()->findAllAttributes(null, true)), array('class'=>'span3 selectpicker', 'disabled'=>true, 'placeholder'=> Yii::t('app', 'Select') ));?>
		<?php #echo $form->textFieldControlGroup($model,'semestre_cursado', array('span'=>3, 'disabled'=>true, 'maxlength'=>11)); ?>
                <?php echo $form->textFieldControlGroup($model,'semestre', array('span'=>3, 'maxlength'=>11)); ?>
		<?php echo $form->textFieldControlGroup($model,'anio', array('span'=>3, 'maxlength'=>11)); ?>
		<?php #echo $form->textFieldControlGroup($model,'estado', array('span'=>3, 'maxlength'=>45)); ?>
		<?php echo $form->textFieldControlGroup($model,'promedio', array('span'=>3, 'maxlength'=>11)); ?>
		<?php echo $form->textAreaControlGroup($model,'observacion', array('span'=>3, 'rows'=>3)); ?>

<?php echo TbHtml::formActions(array(
    TbHtml::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'id'=>'buttonStateful', 'data-loading-text'=>  Yii::t('app', 'Loading...'))),
    TbHtml::resetButton(Yii::t('app', 'Reset')),
));
?>
<?php $this->endWidget(); ?>        
<?php $this->widget('ext.select2.ESelect2'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/buttonReset.js', CClientScript::POS_END); ?>
