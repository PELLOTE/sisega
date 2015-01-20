
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'curso-form',
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
        'enableAjaxValidation' => true,
));
?>

	<p class="help-block">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model_curso); ?>

		<?php echo $form->dropDownListControlGroup($model_curso,'asignatura_id', GxHtml::listDataEx(Asignatura::model()->findAllAttributes(null, true)), array('class'=>'span3 selectpicker', 'empty'=>'', 'placeholder'=> Yii::t('app', 'Select') ));?>
		<?php echo $form->dropDownListControlGroup($model_curso,'profesor_id', GxHtml::listDataEx(Profesor::model()->findAllAttributes(null, true)), array('class'=>'span3 selectpicker', 'empty'=>'', 'placeholder'=> Yii::t('app', 'Select') ));?>
		<?php echo $form->dropDownListControlGroup($model_curso, 'semestre', array('1' => '1', '2' => '2')); ?>
		<?php echo $form->textFieldControlGroup($model_curso,'anio', array('span'=>3, 'maxlength'=>11)); ?>
                <?php echo $form->dropDownListControlGroup($model_curso,'estado', Curso::estados(), array('class'=>'span3 selectpicker', 'empty'=>'', 'placeholder'=> Yii::t('app', 'Select') ));?>
<?php echo TbHtml::formActions(array(
    TbHtml::submitButton($model_curso->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'id'=>'buttonStateful', 'data-loading-text'=>  Yii::t('app', 'Loading...'))),
    TbHtml::resetButton(Yii::t('app', 'Reset')),
));
?>
<?php $this->endWidget(); ?>        
<?php $this->widget('ext.select2.ESelect2'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/buttonReset.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/buttonStateful.js', CClientScript::POS_END); ?>
