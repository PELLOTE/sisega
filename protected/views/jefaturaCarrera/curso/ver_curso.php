<?php

$this->breadcrumbs = array(
	$model->label(2) => array('verCursos'),
	GxHtml::valueEx($model),
);

$this->menu=array(
        array('label'=>Yii::t('app', 'Operations')),
        //array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('listar'), 'icon'=>'list'),
        array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('crearCurso'), 'icon'=>'file'),
        array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('editarCurso', 'id' => $model->id), 'icon'=>'pencil'),
        //array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('borrarCurso', 'id' => $model->id), 'confirm'=>Yii::t('app', 'Are you sure you want to delete this item?')), 'icon'=>'trash'),
        array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('verCursos'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ': ' . GxHtml::encode(GxHtml::valueEx($model)), null); ?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		'id',
		array(
			'name' => 'asignatura',
			'type' => 'raw',
			'value' => $model->asignatura !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->asignatura)), array('jefaturaCarrera/verAsignatura', 'id' => GxActiveRecord::extractPkValue($model->asignatura, true))) : null,
			),
		'profesor',
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
    'type'=>'tabs',
    'placement'=>'above', // 'above', 'right', 'below' or 'left'
    'tabs'=>array(
        array('label'=>'Alumnos', 'content'=>$this->renderPartial('curso/_ver_alumnos',  array('model'=>$model),true), 'active' => true),
        array('label'=>'Plan de Actividad', 'content'=>$this->renderPartial('curso/_ver_plan_actividad',  array('model_plan_actividad'=>$model_plan_actividad),true)),
        array('label'=>'Evaluaciones', 'content'=> $this->renderPartial('curso/_ver_evaluaciones', array('model_evaluacion'=>$model_evaluacion),true)),
    ),
)); ?>