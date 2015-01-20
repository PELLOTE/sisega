
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'user-form',
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
        'enableAjaxValidation' => true,
));
?>

	<p class="help-block">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<?php echo $form->textFieldControlGroup($model,'username', array('span'=>3, 'maxlength'=>128, 'autocomplete'=>'off')); ?>
		<?php echo $form->passwordFieldControlGroup($model,'password', array('span'=>3, 'maxlength'=>128, 'autocomplete'=>'off')); ?>
		<?php echo $form->textFieldControlGroup($model,'email', array('span'=>3, 'maxlength'=>128)); ?>
                <?php echo $form->dropDownListControlGroup($model,'rol', Rights::getAuthItemSelectOptions(2), array('class'=>'span3 selectpicker', 'empty'=>'', 'placeholder'=> Yii::t('app', 'Select') ));?>
                <div class="control-group">
                        <?php echo $form->labelEx($model,'activo', array('class'=>'control-label')); ?>
                        <div clas="controls">
                                <?php echo $form->checkBox($model,'activo', array('class'=>'statuspicker')); ?>
                        </div>
                        <?php echo $form->error($model,'activo'); ?>
                </div>


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
