<?php

$this->breadcrumbs = array(
	$model->calendarioDocente->label(1) => array('calendarioDocente/ver', 'id'=>$model->calendario_docente_id),
	Yii::t('app', 'Create'),
);

$this->menu = array(       
        array('label'=>Yii::t('app', 'Operations')),
        array('label'=>Yii::t('app', 'Cancel'), 'url' => array('calendarioDocente/ver', 'id'=>$model->calendario_docente_id), 'icon'=>'remove'),
        
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'Create') . ' ' . GxHtml::encode($model->label()), TbHtml::labelTb('Admin')); ?>
<?php
$this->renderPartial('_formulario', array(
		'model' => $model,
                'model_calendario' => $model_calendario,
		'buttons' => 'create'));
?>