<a class="buttonwell" href="<?php echo Yii::app()->controller->createUrl('ver', array('id' => $data->id));?>">
<div class="view well">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
        <?php echo GxHtml::encode($data->id); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('curso_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->curso)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('fecha')); ?>:
        <?php echo GxHtml::encode($data->fecha); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('nombre')); ?>:
        <?php echo GxHtml::encode($data->nombre); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('observacion')); ?>:
        <?php echo GxHtml::encode($data->observacion); ?>
	<br />

</div>
</a>