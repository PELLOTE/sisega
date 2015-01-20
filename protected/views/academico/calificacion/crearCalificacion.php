<?php

$this->breadcrumbs = array(
       Yii::app()->user->profesor => Yii::app()->createUrl('academico/panel'),
       GxHtml::encode(Curso::label(2))=> Yii::app()->createUrl('academico/misCursos'),
        GxHtml::valueEx($model->curso)=>Yii::app()->createUrl('academico/verCurso', array('id'=>$model->curso->id)),
        GxHtml::valueEx($model->evaluacion)=>Yii::app()->createUrl('academico/verEvaluacion', array('id'=>$model->evaluacion->id)),
	Yii::t('app', 'Create'). ' ' . $model->label(1),
);

$this->menu = array(
//        array('label'=>Yii::t('app', 'Operations')),
//        array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url' => array('listar'), 'icon'=>'list'),
//        array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('administrar'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        //array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
        array('label' => Yii::t('app', 'Back'), 'url'=>array('verEvaluacion', 'id'=> $model->evaluacion_id), 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'Create') . ' ' . GxHtml::encode($model->label()), null); ?>
<?php
$this->renderPartial('calificacion/_formCalificacion', array(
		'model' => $model,
		'buttons' => 'create'));
?>