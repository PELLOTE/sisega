<?php

$this->breadcrumbs = array(
	$model_curso->label(2) => array('verCursos'),
	Yii::t('app', 'Create'),
);

$this->menu = array(
        array('label'=>Yii::t('app', 'Operations')),
        //array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url' => array('listar'), 'icon'=>'list'),
        array('label'=>Yii::t('app', 'Manage') . ' ' . $model_curso->label(2), 'url' => array('verCursos'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'Create') . ' ' . GxHtml::encode($model_curso->label()), null); ?>
<?php
$this->renderPartial('curso/_formulario', array(
		'model_curso' => $model_curso,
		'buttons' => 'create'));
?>