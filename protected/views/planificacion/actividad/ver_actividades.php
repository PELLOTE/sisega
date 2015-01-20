
<?php

$this->breadcrumbs = array(
	Yii::t('app', 'Ver Actividades'),
);

$this->menu = array(
        //array('label'=>Yii::t('app', 'Operations')),
        array('label'=>Yii::t('app', 'Export')),
        array('label'=>Yii::t('app', 'Export to Excel'), 'url'=>array('GenerarExcel', "tipo" => $tipo), 'linkOptions'=>array('target'=>'_blank'), 'icon'=>'download-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<div class="title-menu">
        <?php echo TbHtml::pageHeader(Yii::t('app', 'Ver Actividades'),null); ?>
</div>

<p>
<?php echo Yii::t('app', 'Text Option Search'); ?></p>

<div class="buttons-admin">
<?php 
       echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button btn'));
?>
</div>
<div class="search-form">
<?php $this->renderPartial('actividad/_busqueda', array(
	'model' => $model_actividad,
)); ?>
</div><!-- search-form -->

<?php $this->widget('yiiwheels.widgets.grid.WhGroupGridView', array(
	'id' => 'actividad-grid',
	'dataProvider' => $model_actividad->search(),
	'filter' => $model_actividad,
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
				'name'=>'planificacion_semestral_id',
				'value'=>'GxHtml::valueEx($data->planificacionSemestral)',
				'filter'=>GxHtml::listDataEx(PlanificacionSemestral::model()->findAllAttributes(null, true)),
				),
		'fecha_inicio',
		'fecha_termino',
		'detalle',
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
            'template'=>'{view}{update}',
            'buttons'=>array(
                'view' => array(
                    'label'=>'Ver Actividad',
                    'url'=>'Yii::app()->createUrl("planificacion/verActividad", array("id"=>$data->id))',
                    ),
                'update' => array(
                    'label'=>'Editar Actividad',
                    'url'=>'Yii::app()->createUrl("planificacion/editarActividad", array("id"=>$data->id))',
                    ),
            ),
         ),                 
	),
        'mergeColumns' => array('planificacion_semestral_id'),
)); ?>

<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').slideToggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('actividad-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>