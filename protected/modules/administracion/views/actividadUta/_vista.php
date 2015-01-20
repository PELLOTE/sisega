<a class="buttonwell" href="<?php echo Yii::app()->controller->createUrl('ver', array('id' => $data->id));?>">
<div class="view well">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
        <?php echo GxHtml::encode($data->id); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('semestre')); ?>:
        <?php echo GxHtml::encode($data->semestre); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('fecha_inicio')); ?>:
        <?php echo GxHtml::encode($data->fecha_inicio); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('fecha_termino')); ?>:
        <?php echo GxHtml::encode($data->fecha_termino); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('detalle')); ?>:
        <?php echo GxHtml::encode($data->detalle); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('calendario_docente_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->calendarioDocente)); ?>
	<br />

</div>
</a>