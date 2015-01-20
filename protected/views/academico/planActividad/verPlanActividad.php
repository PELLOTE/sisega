<?php

$this->breadcrumbs = array(
       Yii::app()->user->profesor => Yii::app()->createUrl('academico/panel'),
       GxHtml::encode(Curso::label(2))=> Yii::app()->createUrl('academico/misCursos'),
        GxHtml::valueEx($model->curso)=>Yii::app()->createUrl('academico/verCurso', array('id'=>$model->curso->id)),
        GxHtml::valueEx($model),
);

$this->menu=array(
        array('label'=>Yii::t('app', 'Operations')),
//        array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('listarPlanActividad'), 'icon'=>'list'),
//        array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('crearPlanActividad'), 'icon'=>'file'),
        array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('editarPlanActividad', 'id' => $model->id), 'icon'=>'pencil'),
//        array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('borrarPlanActividad', 'id' => $model->id), 'confirm'=>Yii::t('app', 'Are you sure you want to delete this item?')), 'icon'=>'trash'),
//        array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('administrarPlanActividad'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
//        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
        array('label'=>Yii::t('app', 'Back'), 'url'=>Yii::app()->createUrl('academico/verCurso', array('id'=>$model->curso->id)), 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)), null); ?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		'id',
		array(
			'name' => 'curso',
			'type' => 'raw',
			'value' => $model->curso !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->curso)), array('verCurso', 'id' => GxActiveRecord::extractPkValue($model->curso, true))) : null,
			),
		array(
			'name' => 'planificacionSemestral',
			'type' => 'raw',
			'value' => $model->planificacionSemestral !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->planificacionSemestral)), array('planificacionSemestral/ver', 'id' => GxActiveRecord::extractPkValue($model->planificacionSemestral, true))) : null,
			),
		'fecha_inicio',
		'fecha_termino',
		'actividad',
	),
)); ?>

