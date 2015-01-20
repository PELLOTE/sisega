<?php

$this->breadcrumbs = array(
	$model->label(1),
	
);

$this->menu=array(
        array('label'=>Yii::t('app', 'Operations')),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)), null); ?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		'id',
                'planificacionSemestral',
		'fecha_inicio',
		'fecha_termino',
		'detalle',
	),
)); ?>

