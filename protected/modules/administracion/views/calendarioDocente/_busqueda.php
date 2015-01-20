<div class="wide form">
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'search-calendario-docente-form',
	'action'=>Yii::app()->createUrl($this->route),
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
	'method'=>'get',
        'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldControlGroup($model,'id', array('span'=>3, 'maxlength'=>11)); ?>

	<?php echo $form->textFieldControlGroup($model,'inicio_primer_semestre', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'inicio_primer_semestre_inicio', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'inicio_primer_semestre_termino', array('span'=>3, 'class'=>'datepicker')); ?>

	<?php echo $form->textFieldControlGroup($model,'termino_primer_semestre', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'termino_primer_semestre_inicio', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'termino_primer_semestre_termino', array('span'=>3, 'class'=>'datepicker')); ?>

	<?php echo $form->textFieldControlGroup($model,'inicio_segundo_semestre', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'inicio_segundo_semestre_inicio', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'inicio_segundo_semestre_termino', array('span'=>3, 'class'=>'datepicker')); ?>

	<?php echo $form->textFieldControlGroup($model,'termino_segundo_semestre', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'termino_segundo_semestre_inicio', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'termino_segundo_semestre_termino', array('span'=>3, 'class'=>'datepicker')); ?>

	<?php echo $form->textFieldControlGroup($model,'anio', array('span'=>3, 'maxlength'=>11)); ?>

	<?php echo $form->textFieldControlGroup($model,'estado', array('span'=>3, 'maxlength'=>45)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'icon'=>'white search'));?>
        <?php echo TbHtml::resetButton(Yii::t('app', 'Reset'), array('icon'=>'icon-remove-sign')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
<?php $this->widget('ext.datepicker.Datepicker'); ?>
<?php $this->widget('ext.select2.ESelect2'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/buttonReset.js', CClientScript::POS_END); ?>

