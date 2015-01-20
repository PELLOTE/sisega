<div class="wide form">
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'search-libro-curso-form',
	'action'=>Yii::app()->createUrl($this->route),
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
	'method'=>'get',
        'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php // echo $form->textFieldControlGroup($model,'actividad_id', array('span'=>3, 'maxlength'=>11)); ?>

	<?php echo $form->textFieldControlGroup($model,'actividad', array('span'=>3, 'maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'fecha_inicio', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'fecha_inicio_inicio', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'fecha_inicio_termino', array('span'=>3, 'class'=>'datepicker')); ?>

	<?php echo $form->textFieldControlGroup($model,'fecha_termino', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'fecha_termino_inicio', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'fecha_termino_termino', array('span'=>3, 'class'=>'datepicker')); ?>

	<?php // echo $form->textFieldControlGroup($model,'curso_id', array('span'=>3, 'maxlength'=>11)); ?>

	<?php // echo $form->textFieldControlGroup($model,'curso_semestre', array('span'=>3, 'maxlength'=>11)); ?>

	<?php // echo $form->textFieldControlGroup($model,'curso_anio', array('span'=>3, 'maxlength'=>11)); ?>

	<?php // echo $form->textFieldControlGroup($model,'curso_nombre', array('span'=>3, 'maxlength'=>255)); ?>

	<?php // echo $form->textFieldControlGroup($model,'evaluacion_id', array('span'=>3, 'maxlength'=>11)); ?>

	<?php echo $form->textFieldControlGroup($model,'evaluacion_fecha', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'evaluacion_fecha_inicio', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'evaluacion_fecha_termino', array('span'=>3, 'class'=>'datepicker')); ?>

        <?php echo $form->textAreaControlGroup($model,'evaluacion_nombre', array('span'=>3, 'rows'=>3)); ?>
        
	<?php echo $form->textAreaControlGroup($model,'evaluacion_observacion', array('span'=>3, 'rows'=>3)); ?>

	<?php // echo $form->textFieldControlGroup($model,'alumno_id', array('span'=>3, 'maxlength'=>11)); ?>

	<?php echo $form->textFieldControlGroup($model,'alumno_run', array('span'=>3, 'maxlength'=>12)); ?>

	<?php echo $form->textFieldControlGroup($model,'alumno_nombre', array('span'=>3, 'maxlength'=>255)); ?>

	<?php // echo $form->textFieldControlGroup($model,'calificacion_id', array('span'=>3, 'maxlength'=>11)); ?>

	<?php echo $form->textFieldControlGroup($model,'calificacion_nota', array('span'=>3, 'maxlength'=>4)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'icon'=>'white search'));?>
        <?php echo TbHtml::resetButton(Yii::t('app', 'Reset'), array('icon'=>'icon-remove-sign')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
<?php $this->widget('ext.datepicker.Datepicker'); ?>
<?php $this->widget('ext.select2.ESelect2'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/buttonReset.js', CClientScript::POS_END); ?>

