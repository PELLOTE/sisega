<?php

$this->breadcrumbs = array(
       Yii::app()->user->profesor => Yii::app()->createUrl('academico/panel'),
       GxHtml::encode(Curso::label(2)) => Yii::app()->createUrl('academico/misCursos'),
       GxHtml::valueEx(Curso::model()->findByPk($model->curso_id))=>Yii::app()->createUrl('academico/verCurso', array('id'=>$model->curso_id)),
       Yii::t('app', 'Libro de Curso'),
);

//$this->menu = array(
//        array('label'=>Yii::t('app', 'Operations')),
//        array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('listar'), 'icon'=>'list'),
//        array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('crear'), 'icon'=>'file'),
//        array('label'=>Yii::t('app', 'Export')),
//        array('label'=>Yii::t('app', 'Export to Excel'), 'url'=>Yii::app()->controller->createUrl('GenerarExcel'), 'linkOptions'=>array('target'=>'_blank'), 'icon'=>'download-alt'),
//        array('label'=>Yii::t('app', 'Other|Others', 2)),
//        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
//);
//?>

<div class="title-menu">
        <?php echo TbHtml::pageHeader(Yii::t('app', 'Libro de Curso') . ' ' . GxHtml::valueEx(Curso::model()->findByPk($model->curso_id)), null); ?>
</div>

<p>
<?php echo Yii::t('app', 'Text Option Search'); ?></p>

<div class="buttons-admin">
<?php 
       echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button btn')).' ';
       echo TbHtml::linkButton(Yii::t('app', 'Export'), array('url'=>Yii::app()->controller->createUrl('GenerarExcelLibroCurso'),'color' => TbHtml::BUTTON_COLOR_PRIMARY, 'icon'=>'white download-alt')).' ';;
       echo TbHtml::linkButton(Yii::t('app', 'Back'), array('url'=>'javascript:history.back()','color' => TbHtml::BUTTON_COLOR_INFO, 'icon'=>'white arrow-left'));
?>
</div>
<div class="search-form">
<?php $this->renderPartial('curso/_busquedaLibroCurso', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

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