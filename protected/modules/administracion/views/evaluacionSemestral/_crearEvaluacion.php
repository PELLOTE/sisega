
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'evaluacion-semestral-form',
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
        'enableAjaxValidation' => true,
        
));
?>

	<p class="help-block">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'anio', array('span'=>1, 'maxlength'=>11,'disabled'=>false)); ?>
            <?php echo $form->dropDownListControlGroup($model,'semestre', array(1=>'I',2=>'II'), array('span'=>1, 'maxlength'=>11, 'placeHolder'=>'Elija un semestre', 'disabled'=>false)); ?>	
            <?php echo $form->textFieldControlGroup($model,'promedio', array('span'=>1,'maxlength'=>11)); ?>
        
        <?php echo $form->textAreaControlGroup($model,'observacion', array('span'=>3, 'rows'=>3)); ?>

<?php echo TbHtml::formActions(array(
    TbHtml::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'id'=>'buttonStateful', 'data-loading-text'=>  Yii::t('app', 'Loading...'))),
    TbHtml::resetButton(Yii::t('app', 'Reset')),
));
?>
<?php $this->endWidget(); ?>        
<?php $this->widget('ext.select2.ESelect2'); ?>
<?php $this->widget('ext.switch.TbSwitch'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/buttonReset.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/buttonStateful.js', CClientScript::POS_END); ?>
