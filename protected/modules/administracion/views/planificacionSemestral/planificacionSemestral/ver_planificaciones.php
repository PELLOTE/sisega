
<?php

$this->breadcrumbs = array(
	//$model->label(2) => array('verPlanificaciones'),
	Yii::t('app', 'Ver Planificaciones'),
);

$this->menu = array(
        array('label'=>Yii::t('app', 'Operations')),
        //array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('listar'), 'icon'=>'list'),
        array('label'=>Yii::t('app', 'Create') . ' ' . $model_planificacion->label(), 'url'=>array('crearPlanificacion'), 'icon'=>'file'),
        array('label'=>Yii::t('app', 'Export')),
        array('label'=>Yii::t('app', 'Export to Excel'), 'url'=>array('GenerarExcel', "tipo" => $tipo), 'linkOptions'=>array('target'=>'_blank'), 'icon'=>'download-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<div class="title-menu">
        <?php echo TbHtml::pageHeader(Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model_planificacion->label(2)), null); ?>
</div>

<p>
<?php echo Yii::t('app', 'Text Option Search'); ?></p>

<div class="buttons-admin">
<?php 
       echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button btn'));
?>
</div>
<div class="search-form">
<?php $this->renderPartial('planificacionSemestral/_busqueda', array(
	'model' => $model_planificacion,
)); ?>
</div><!-- search-form -->

<?php $this->widget('yiiwheels.widgets.grid.WhGroupGridView', array(
	'id' => 'planificacion-semestral-grid',
	'dataProvider' => $model_planificacion->search(),
	'filter' => $model_planificacion,
        'type'=>'striped bordered condensed',
        'template'=>"{summary}{items}{pager}",
        //'htmlOptions' => array(
        //                        'style' => 'overflow-y:auto;'
        //                                   .'table-layout:fixed;'
        //                                   .'white-space:nowrap;'
        //                                   ),       
	'columns' => array(
		//'id',
		array(
				'name'=>'calendario_docente_id',
				'value'=>'GxHtml::valueEx($data->calendarioDocente)',
				'filter'=>GxHtml::listDataEx(CalendarioDocente::model()->findAllAttributes(null, true)),
				),
                'semestre',
		'fecha_creacion',
		'fecha_proposicion',
		'fecha_respuesta',
		array(
                    'name'=>'estado',
                    'value'=>'$data->getEtiquetaEstado()',
                    'type'=>'raw',
                ),
		/*
		'fecha_inicio',
		'fecha_termino',
		*/
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'htmlOptions'=>array('style'=>'width: 50px'),
		'template'=>'{view}',
		'buttons'=>array(
                    'view' => array(
                        'label'=>'Ver Planificacion',
			'url'=>'Yii::app()->controller->createUrl("planificacionSemestral/verPlanificacion", array("id"=>$data->id))',
                        ),
		),
            ),                
	),
        'mergeColumns' => array('calendario_docente_id'),
)); ?>

<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').slideToggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('planificacion-semestral-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
