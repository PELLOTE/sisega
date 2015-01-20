<?php

$this->breadcrumbs = array(
       Yii::app()->user->profesor => Yii::app()->createUrl('academico/panel'),
       GxHtml::encode(Curso::label(2))=> Yii::app()->createUrl('academico/misCursos'),
        GxHtml::valueEx($model->curso)=>Yii::app()->createUrl('academico/verCurso', array('id'=>$model->curso->id)),
	GxHtml::valueEx($model) => array('verEvaluacion', 'id' => GxActiveRecord::extractPkValue($model, true)),
	Yii::t('app', 'Update'),
);

$this->menu = array(       
//        array('label'=>Yii::t('app', 'Operations')),
//        array('label' => Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('listar'), 'icon'=>'list'),
//        array('label' => Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('crear'), 'icon'=>'file'),
//        array('label' => Yii::t('app', 'View') . ' ' . $model->label(), 'url'=>array('ver', 'id' => GxActiveRecord::extractPkValue($model, true)), 'icon'=>'eye-open'),
//        array('label' => Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('administrar'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'Update') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)), null); ?>

<?php
$this->renderPartial('evaluacion/_formEvaluacion', array(
		'model' => $model,
                'model_planificacion_semestral'=> $model_planificacion_semestral));
?>