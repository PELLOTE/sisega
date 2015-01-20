<?php if($rango_fecha != FALSE){?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'planificacion-semestral-form',
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
        'enableAjaxValidation' => true,
));
?>

Calendario Docente vigente (Fecha Inicio: <?php echo $rango_fecha[0];?>, Fecha Termino: <?php echo $rango_fecha[1];?>)
<br><br>
        
    <?php $this->widget('bootstrap.widgets.TbAlert'); ?>

    <p class="help-block">
        <?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
    </p>

	<?php echo $form->errorSummary($model_planificacion); ?>
                <?php echo $form->textFieldControlGroup($model_planificacion,'fecha_creacion', array('span'=>3, 'class'=>'datepicker','disabled' => true)); ?>
                <?php echo $form->dropDownListControlGroup($model_planificacion,'semestre', array(1=>'I Semestre',2=>'II Semestre'), array('class'=>'span3 selectpicker', 'empty'=>'Elija un Semestre' ));?>
		
<?php echo TbHtml::formActions(array(
    TbHtml::submitButton($model_planificacion->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'id'=>'buttonStateful', 'data-loading-text'=>  Yii::t('app', 'Loading...'))),
    TbHtml::resetButton(Yii::t('app', 'Reset')),
));
?>
<?php $this->endWidget(); ?>        
<?php $this->widget('ext.datepicker.Datepicker'); ?>
<?php $this->widget('ext.select2.ESelect2'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/buttonReset.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/buttonStateful.js', CClientScript::POS_END); ?>
<?php }else{?>
        No se encuentra un Calendario Academico Vigente.
<?php }?>