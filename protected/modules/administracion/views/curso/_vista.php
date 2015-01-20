<a class="buttonwell" href="<?php echo Yii::app()->controller->createUrl('ver', array('id' => $data->id));?>">
<div class="view well">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
        <?php echo GxHtml::encode($data->id); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('asignatura_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->asignatura)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('profesor_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->profesor)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('semestre')); ?>:
        <?php echo GxHtml::encode($data->semestre); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('anio')); ?>:
        <?php echo GxHtml::encode($data->anio); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('nombre')); ?>:
        <?php echo GxHtml::encode($data->nombre); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('estado')); ?>:
        <?php echo GxHtml::encode($data->estado); ?>
	<br />

</div>
</a>