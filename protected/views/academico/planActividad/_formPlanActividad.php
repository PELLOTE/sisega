 

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'plan-actividad-form',
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
        'enableAjaxValidation' => true,
));
?>

	<p class="help-block">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<?php echo $form->dropDownListControlGroup($model,'planificacion_semestral_id', GxHtml::listDataEx(PlanificacionSemestral::model()->findAllAttributes(null, true)), array('class'=>'span3 selectpicker', 'empty'=>'', 'placeholder'=> Yii::t('app', 'Select')));?>
		<?php echo $form->textFieldControlGroup($model,'fecha_inicio', array('span'=>3, 'class'=>'datepicker', 'data-date-start-date' => $model_planificacion_semestral->fecha_inicio ,'data-date-end-date'=>$model_planificacion_semestral->fecha_termino)); ?>
		<?php echo $form->textFieldControlGroup($model,'fecha_termino', array('span'=>3, 'class'=>'datepicker', 'data-date-start-date' => $model_planificacion_semestral->fecha_inicio ,'data-date-end-date'=>$model_planificacion_semestral->fecha_termino)); ?>
		<?php echo $form->textFieldControlGroup($model,'actividad', array('span'=>3, 'maxlength'=>255)); ?>

<?php echo TbHtml::formActions(array(
    TbHtml::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'id'=>'buttonStateful', 'data-loading-text'=>  Yii::t('app', 'Loading...'))),
    TbHtml::resetButton(Yii::t('app', 'Reset')),
));
?>
<?php $this->endWidget(); ?>        
<?php $this->widget('ext.datepicker.Datepicker', array('target'=>'.datepicker')); ?>
<?php $this->widget('ext.select2.ESelect2'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/buttonReset.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/buttonStateful.js', CClientScript::POS_END); ?>
<?php // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/datepickerUnidos.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScript('script_pa',
        '$("#'.GxHtml::activeId($model,'planificacion_semestral_id').'").select2("enable", false);',
        CClientScript::POS_READY);?>
   
<?php Yii::app()->clientScript->registerScript('script_dpunidos',
'$("#'.GxHtml::activeId($model,'fecha_inicio').'").on("changeDate", function(e){
    if(!$("#'.GxHtml::activeId($model,'fecha_termino').'").val()){
      $("#'.GxHtml::activeId($model,'fecha_termino').'").datepicker("setStartDate", $(this).val());
  }
  else{
    from = $("#'.GxHtml::activeId($model,'fecha_inicio').'").val().split("/");
    date1 = new Date(from[2], from[1]-1, from[0]);
    from = $("#'.GxHtml::activeId($model,'fecha_termino').'").val().split("/");
    date2 = new Date(from[2], from[1]-1, from[0]);
    if( date2 < date1)  $("#'.GxHtml::activeId($model,'fecha_termino').'").datepicker("update", $(this).val());
    $("#'.GxHtml::activeId($model,'fecha_termino').'").datepicker("setStartDate", $(this).val());
  }
});',
CClientScript::POS_READY);?>