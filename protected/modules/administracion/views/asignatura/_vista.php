<a class="buttonwell" href="<?php echo Yii::app()->controller->createUrl('ver', array('id' => $data->id));?>">
<div class="view well">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
        <?php echo GxHtml::encode($data->id); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('nombre')); ?>:
        <?php echo GxHtml::encode($data->nombre); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('semestre')); ?>:
        <?php echo GxHtml::encode($data->semestre); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('programa')); ?>:
        <?php echo GxHtml::encode($data->programa); ?>
	<br />

</div>
</a>