<a class="buttonwell" href="<?php echo Yii::app()->controller->createUrl('view', array('id' => $data->id));?>">
<div class="view well">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
        <?php echo GxHtml::encode($data->id); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('username')); ?>:
        <?php echo GxHtml::encode($data->username); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('password')); ?>:
        <?php echo GxHtml::encode($data->password); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('email')); ?>:
        <?php echo GxHtml::encode($data->email); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('rol')); ?>:
        <?php echo GxHtml::encode($data->rol); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('activo')); ?>:
        <?php echo GxHtml::encode($data->activo? Yii::t('app', 'Yes') : Yii::t('app', 'No')); ?>
	<br />
</div>
</a>