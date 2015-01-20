<?php

$this->breadcrumbs = array(
	$model_asignatura->label(2) => array('verAsignaturas'),
	Yii::t('app', 'Create'),
);

$this->menu = array(
        array('label'=>Yii::t('app', 'Operations')),
        //array('label'=>Yii::t('app', 'List') . ' ' . $model_asignatura->label(2), 'url' => array('listar'), 'icon'=>'list'),
        array('label'=>Yii::t('app', 'Manage') . ' ' . $model_asignatura->label(2), 'url' => array('verAsignaturas'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'Create') . ' ' . GxHtml::encode($model_asignatura->label()), null); ?>
<?php
$this->renderPartial('asignatura/_formulario', array(
		'model_asignatura' => $model_asignatura,
		'buttons' => 'create'));
?>