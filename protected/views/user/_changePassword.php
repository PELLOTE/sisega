<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'user-change-password',
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
        'enableAjaxValidation' => true,
));
?>
<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
    ));
?>
	<p class="help-block">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>
        
        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->passwordFieldControlGroup($model,'password_anterior', array('span'=>3, 'maxlength'=>45)); ?>
        <?php echo $form->passwordFieldControlGroup($model,'password_nuevo', array('span'=>3, 'maxlength'=>45)); ?>
        <?php echo $form->passwordFieldControlGroup($model,'password_nuevo_repetir', array('span'=>3, 'maxlength'=>45)); ?>

<?php echo TbHtml::formActions(array(
            TbHtml::submitButton(Yii::t('app', 'Save'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'id'=>'buttonStateful', 'data-loading-text'=>  Yii::t('app', 'Loading...'))),
            TbHtml::resetButton(Yii::t('app', 'Reset')),
        ));
?>

<?php $this->endWidget(); ?>    
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/buttonStateful.js', CClientScript::POS_END); ?>