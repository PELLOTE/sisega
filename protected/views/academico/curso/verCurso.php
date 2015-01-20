<?php

$this->breadcrumbs = array(
       Yii::app()->user->profesor => Yii::app()->createUrl('academico/panel'),
       GxHtml::encode(Curso::label(2)) => Yii::app()->createUrl('academico/misCursos'),
       GxHtml::valueEx($model),
);

$this->menu=array(
       array('label'=>Yii::t('app', 'Operations')),
//        array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('listar'), 'icon'=>'list'),
        array('label'=>Yii::t('app', 'Crear Plan de Actividad'), 'url'=>array('crearPlanActividad', 'id'=>$model->id), 'icon'=>'file'),
        array('label'=>Yii::t('app', 'Crear Evaluación'), 'url'=>array('crearEvaluacion', 'id'=>$model->id), 'icon'=>'file'),
        array('label'=>Yii::t('app', 'Libro de Curso'), 'url'=>array('libroCurso', 'id'=>$model->id), 'icon'=>'book'),
//        array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('actualizar', 'id' => $model->id), 'icon'=>'pencil'),
//        array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('borrar', 'id' => $model->id), 'confirm'=>Yii::t('app', 'Are you sure you want to delete this item?')), 'icon'=>'trash'),
//        array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('administrar'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
        array('label'=>Yii::t('app', 'Up'), 'url'=>'javascript:GoUp()', 'icon'=>'arrow-up', 'id'=>'button-up'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)), null); ?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		'id',
                'asignatura',
//		array(
//			'name' => 'asignatura',
//			'type' => 'raw',
//			'value' => $model->asignatura !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->asignatura)), array('asignatura/ver', 'id' => GxActiveRecord::extractPkValue($model->asignatura, true))) : null,
//			),
//		array(
//			'name' => 'profesor',
//			'type' => 'raw',
//			'value' => $model->profesor !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->profesor)), array('academico/ver', 'id' => GxActiveRecord::extractPkValue($model->profesor, true))) : null,
//			),
		'semestre',
		'anio',
                array(
                    'name'=>'estado',
                    'value'=>$model->getEtiquetaEstado(),
                    'type'=>'raw',
                ),
	),
)); ?>




<?php $this->widget('bootstrap.widgets.TbTabs', array(
    'tabs' => array(
        array('label'=>GxHtml::encode($model->getRelationLabel('alumnos')), 'content'=>$this->renderPartial('curso/_alumno',  array('model'=>$model),true), 'active'=>true),
        array('label'=>GxHtml::encode($model->getRelationLabel('planActividads')), 'content'=>$this->renderPartial('curso/_planActividad',  array('model'=>$model),true)),
        array('label'=>GxHtml::encode($model->getRelationLabel('evaluacions')), 'content'=> $this->renderPartial('curso/_evaluacion', array('model'=>$model),true)),
    ),
)); ?>


<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/scroll.js'); ?>