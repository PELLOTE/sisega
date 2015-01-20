<?php

$this->breadcrumbs = array(
       Yii::app()->user->profesor => Yii::app()->createUrl('academico/panel'),
       GxHtml::encode(Curso::label(2)) => Yii::app()->createUrl('academico/misCursos'),
       GxHtml::valueEx(Curso::model()->findByPk($model->curso_id))=>Yii::app()->createUrl('academico/verCurso', array('id'=>$model->curso_id)),
       Yii::t('app', 'Libro de Curso'),
);
?>

<?php $this->widget('yiiwheels.widgets.grid.WhGroupGridView', array(
	'id' => 'libro-curso-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
        'type'=>'striped bordered condensed',
        'template'=>"{summary}{items}{pager}",
        'mergeColumns' => array('actividad', 'fecha_inicio', 'fecha_termino', 'evaluacion_fecha', 'evaluacion_nombre', 'alumno_run', 'alumno_nombre', 'calificacion_nota' ),
        'htmlOptions' => array(
                                'style' => 'overflow-y:auto;'
                                           .'table-layout:fixed;'
                                           .'white-space:nowrap;'
                                           ),       
	'columns' => array(
//		'actividad_id',
		'actividad',
		'fecha_inicio',
		'fecha_termino',
//		'curso_id',
//		'curso_semestre',		
//		'curso_anio',
//		'curso_nombre',
//		'evaluacion_id',
		'evaluacion_fecha',
                'evaluacion_nombre',
//		'evaluacion_observacion',
//		'alumno_id',
		'alumno_run',
		'alumno_nombre',
		'calificacion_nota',
		            
	),
)); ?>

<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').slideToggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('libro-curso-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>