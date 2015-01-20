<?php 
Yii::app()->clientScript->registerScript('tipo_semestre','
    function tipo_semestre(value){
        if(value=="1"){
            $("#primero").show();
            $("#segundo").hide();
        }else{
            $("#primero").hide();
            $("#segundo").show();
        }
    }
',CClientScript::POS_END);

Yii::app()->clientScript->registerScript('ready','
    $(function () {
    var valor=$("#semestre :selected").val();
    if(valor=="1"){
        $("#segundo").hide();
        $("#primero").show();
        
    }else {
        $("#primero").hide();
        $("#segundo").show();        
    }
  });
    
',CClientScript::POS_READY);
?>



<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'actividad-uta-form',
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
        'enableAjaxValidation' => true,
));
?>

	<p class="help-block">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>
            
		<?php echo $form->dropDownListControlGroup($model, 'semestre', array('1' => '1', '2' => '2'), array('id'=>'semestre','onclick'=>'tipo_semestre(this.value)')); ?>
                <div id="primero">
                    <?php echo $form->textFieldControlGroup($model,'fecha_inicio_1', array('span'=>3, 'class'=>'datepicker', 'data-date-start-date'=>$model_calendario->inicio_primer_semestre, 'data-date-end-date'=>$model_calendario->termino_primer_semestre)); ?>
                    <?php echo $form->textFieldControlGroup($model,'fecha_termino_1', array('span'=>3, 'class'=>'datepicker', 'data-date-start-date'=>$model_calendario->inicio_primer_semestre, 'data-date-end-date'=>$model_calendario->termino_primer_semestre)); ?>
                </div>
                <div id="segundo">
                    <?php echo $form->textFieldControlGroup($model,'fecha_inicio_2', array('span'=>3, 'class'=>'datepicker', 'data-date-start-date'=>$model_calendario->inicio_segundo_semestre, 'data-date-end-date'=>$model_calendario->termino_segundo_semestre)); ?>
                    <?php echo $form->textFieldControlGroup($model,'fecha_termino_2', array('span'=>3, 'class'=>'datepicker', 'data-date-start-date'=>$model_calendario->inicio_segundo_semestre, 'data-date-end-date'=>$model_calendario->termino_segundo_semestre)); ?>
                </div>
                <?php echo $form->textAreaControlGroup($model,'detalle', array('span'=>3, 'rows'=>3)); ?>
		
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
