<?php

$this->breadcrumbs = array(
       Yii::app()->user->profesor => Yii::app()->createUrl('academico/panel'),
       GxHtml::encode(Curso::label(2))=> Yii::app()->createUrl('academico/misCursos'),
       GxHtml::valueEx($model->evaluacion->curso)=>Yii::app()->createUrl('academico/verCurso', array('id'=>$model->evaluacion->curso->id)),
       GxHtml::valueEx($model->evaluacion)=>Yii::app()->createUrl('academico/verEvaluacion', array('id'=>$model->evaluacion->id)),
       GxHtml::valueEx($model),
);

$this->menu=array(
        array('label'=>Yii::t('app', 'Operations')),
//        array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('academico/listarCalificacion'), 'icon'=>'list'),
//        array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('academico/crearCalificacion'), 'icon'=>'file'),
        array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('academico/editarCalificacion', 'id' => $model->id), 'icon'=>'pencil'),
        array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('academico/borrarCalificacion', 'id' => $model->id), 'confirm'=>Yii::t('app', 'Are you sure you want to delete this item?')), 'icon'=>'trash'),
//        array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('administrar'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)), null); ?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		'id',
		array(
			'name' => 'alumno',
			'type' => 'raw',
			'value' => $model->alumno !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->alumno)), array('academico/verAlumno', 'id' => GxActiveRecord::extractPkValue($model->alumno, true), 'curso_id' => GxActiveRecord::extractPkValue($model->curso, true))) : null,
			),
		array(
			'name' => 'evaluacion',
			'type' => 'raw',
			'value' => $model->evaluacion !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->evaluacion)), array('academico/verEvaluacion', 'id' => GxActiveRecord::extractPkValue($model->evaluacion, true), 'curso_id'=>$model->evaluacion->curso_id)) : null,
			),
		array(
			'name' => 'curso',
			'type' => 'raw',
			'value' => $model->curso !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->curso)), array('academico/verCurso', 'id' => GxActiveRecord::extractPkValue($model->curso, true))) : null,
			),
		'nota',
	),
)); ?>

