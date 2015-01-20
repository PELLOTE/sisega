<?php

$this->breadcrumbs = array(
       GxHtml::valueEx($alumno) => array('misCursos'),
       GxHtml::encode(Curso::label(2)) => array('misCursos'),
       GxHtml::valueEx($curso),
);

$this->menu=array(
        array('label'=>Yii::t('app', 'Operations')),
        array('label'=>Yii::t('app', 'Mis Cursos') . ' ' . null, 'url'=>array('misCursos'), 'icon'=>'list'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'Curso') . ': ' . GxHtml::encode(GxHtml::valueEx($curso)), null); ?>


<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $curso,
	'attributes' => array(
//		array(
//			'name' => 'profesor',
//			'type' => 'raw',
//			'value' => $curso->profesor !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($curso->profesor)), array('profesor/ver', 'id' => GxActiveRecord::extractPkValue($curso->profesor, true))) : null,
//			),
                'profesor',
		'semestre',
		'anio',
	),
)); ?>


<?php $this->widget('bootstrap.widgets.TbTabs', array(
    'type'=>'tabs',
    'placement'=>'above', // 'above', 'right', 'below' or 'left'
    'tabs'=>array(
        array('label'=>'Evaluaciones', 'content'=> $this->renderPartial('_evaluacion', array('model'=>$curso),true,false), 'active'=>true),
        array('label'=>'Notas', 'content'=> $this->renderPartial('_ver_calificaciones', array('calificaciones_alumno'=>$calificaciones_alumno),true,false), 'active'=>false),
        array('label'=>'Plan de Actividad', 'content'=>$this->renderPartial('_ver_plan_actividad',  array('plan_actividad'=>$plan_actividad),true,false), 'active'=>false),
    ),
)); ?>