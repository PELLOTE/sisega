<a class="buttonwell" href="<?php echo Yii::app()->controller->createUrl('ver', array('id' => $data->id));?>">
<div class="view well">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
        <?php echo GxHtml::encode($data->id); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('alumno_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->alumno)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('evaluacion_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->evaluacion)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('curso_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->curso)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('nota')); ?>:
        <?php echo GxHtml::encode($data->nota); ?>
	<br />

</div>
</a>