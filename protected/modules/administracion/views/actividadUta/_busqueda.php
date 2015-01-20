<div class="wide form">
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'search-actividad-uta-form',
	'action'=>Yii::app()->createUrl($this->route),
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
	'method'=>'get',
        'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldControlGroup($model,'id', array('span'=>3, 'maxlength'=>11)); ?>

	<?php echo $form->textFieldControlGroup($model,'semestre', array('span'=>3, 'maxlength'=>11)); ?>

	<?php echo $form->textFieldControlGroup($model,'fecha_inicio', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'fecha_inicio_inicio', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'fecha_inicio_termino', array('span'=>3, 'class'=>'datepicker')); ?>

	<?php echo $form->textFieldControlGroup($model,'fecha_termino', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'fecha_termino_inicio', array('span'=>3, 'class'=>'datepicker')); ?>
	<?php echo $form->textFieldControlGroup($model,'fecha_termino_termino', array('span'=>3, 'class'=>'datepicker')); ?>

	<?php echo $form->textAreaControlGroup($model,'detalle', array('span'=>3, 'rows'=>3)); ?>

	<?php echo $form->dropDownListControlGroup($model,'calendario_docente_id', GxHtml::listDataEx(CalendarioDocente::model()->findAllAttributes(null, true)), array('class'=>'span3 selectpicker', 'empty'=>'', 'placeholder'=> Yii::t('app', 'All') ));?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'icon'=>'white search'));?>
        <?php echo TbHtml::resetButton(Yii::t('app', 'Reset'), array('icon'=>'icon-remove-sign')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
<?php $this->widget('ext.datepicker.Datepicker'); ?>
<?php $this->widget('ext.select2.ESelect2'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/buttonReset.js', CClientScript::POS_END); ?>

