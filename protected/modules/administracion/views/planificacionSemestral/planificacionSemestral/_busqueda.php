<div class="wide form">
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'search-planificacion-semestral-form',
	'action'=>Yii::app()->createUrl($this->route),
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
	'method'=>'get',
        'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldControlGroup($model,'id', array('span'=>3, 'maxlength'=>11)); ?>

	<?php echo $form->dropDownListControlGroup($model,'calendario_docente_id', GxHtml::listDataEx(CalendarioDocente::model()->findAllAttributes(null, true)), array('class'=>'span3 selectpicker', 'empty'=>'', 'placeholder'=> Yii::t('app', 'All') ));?>

	<?php echo $form->textFieldControlGroup($model,'fecha_creacion', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'fecha_creacion_inicio', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'fecha_creacion_termino', array('span'=>3, 'class'=>'datepicker')); ?>

	<?php echo $form->textFieldControlGroup($model,'fecha_proposicion', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'fecha_proposicion_inicio', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'fecha_proposicion_termino', array('span'=>3, 'class'=>'datepicker')); ?>

	<?php echo $form->textFieldControlGroup($model,'fecha_respuesta', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'fecha_respuesta_inicio', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'fecha_respuesta_termino', array('span'=>3, 'class'=>'datepicker')); ?>

	<?php echo $form->textFieldControlGroup($model,'estado', array('span'=>3, 'maxlength'=>45)); ?>

	<?php echo $form->textFieldControlGroup($model,'fecha_inicio', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'fecha_inicio_inicio', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'fecha_inicio_termino', array('span'=>3, 'class'=>'datepicker')); ?>

	<?php echo $form->textFieldControlGroup($model,'fecha_termino', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'fecha_termino_inicio', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'fecha_termino_termino', array('span'=>3, 'class'=>'datepicker')); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'icon'=>'white search'));?>
        <?php echo TbHtml::resetButton(Yii::t('app', 'Reset'), array('icon'=>'icon-remove-sign')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
<?php $this->widget('ext.datepicker.Datepicker'); ?>
<?php $this->widget('ext.select2.ESelect2'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/buttonReset.js', CClientScript::POS_END); ?>

