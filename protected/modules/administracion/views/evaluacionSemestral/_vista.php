<a class="buttonwell" href="<?php echo Yii::app()->controller->createUrl('ver', array('id' => $data->id));?>">
<div class="view well">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
        <?php echo GxHtml::encode($data->id); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('alumno_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->alumno)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('semestre')); ?>:
        <?php echo GxHtml::encode($data->semestre); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('semestre_cursado')); ?>:
        <?php echo GxHtml::encode($data->semestre_cursado); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('anio')); ?>:
        <?php echo GxHtml::encode($data->anio); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('estado')); ?>:
        <?php echo GxHtml::encode($data->estado); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('observacion')); ?>:
        <?php echo GxHtml::encode($data->observacion); ?>
	<br />

</div>
</a>