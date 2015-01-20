<a class="buttonwell" href="<?php echo Yii::app()->controller->createUrl('ver', array('id' => $data->id));?>">
<div class="view well">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
        <?php echo GxHtml::encode($data->id); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('calendario_docente_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->calendarioDocente)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:
        <?php echo GxHtml::encode($data->fecha_creacion); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('fecha_proposicion')); ?>:
        <?php echo GxHtml::encode($data->fecha_proposicion); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('fecha_respuesta')); ?>:
        <?php echo GxHtml::encode($data->fecha_respuesta); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('estado')); ?>:
        <?php echo GxHtml::encode($data->estado); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('fecha_inicio')); ?>:
        <?php echo GxHtml::encode($data->fecha_inicio); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('fecha_termino')); ?>:
        <?php echo GxHtml::encode($data->fecha_termino); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('user_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->user)); ?>
	<br />
	*/ ?>

</div>
</a>