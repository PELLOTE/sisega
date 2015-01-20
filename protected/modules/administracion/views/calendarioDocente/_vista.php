<a class="buttonwell" href="<?php echo Yii::app()->controller->createUrl('ver', array('id' => $data->id));?>">
<div class="view well">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
        <?php echo GxHtml::encode($data->id); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('inicio_primer_semestre')); ?>:
        <?php echo GxHtml::encode($data->inicio_primer_semestre); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('termino_primer_semestre')); ?>:
        <?php echo GxHtml::encode($data->termino_primer_semestre); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('inicio_segundo_semestre')); ?>:
        <?php echo GxHtml::encode($data->inicio_segundo_semestre); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('termino_segundo_semestre')); ?>:
        <?php echo GxHtml::encode($data->termino_segundo_semestre); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('anio')); ?>:
        <?php echo GxHtml::encode($data->anio); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('estado')); ?>:
        <?php echo GxHtml::encode($data->estado); ?>
	<br />

</div>
</a>