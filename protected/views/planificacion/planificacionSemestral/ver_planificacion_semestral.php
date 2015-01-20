<?php

$this->breadcrumbs = array(
	$model->label(2) => array('verPlanificaciones'),
	GxHtml::valueEx($model),
);

$this->menu=array(
        array('label'=>Yii::t('app', 'Operations')),
        array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('verPlanificaciones'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Proponer').' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('proponerPlanificacion', 'id' => $model->id), 'confirm'=>Yii::t('app', '¿Deseas proponer esta planificacion semestral?')), 'icon'=>'ok','visible'=>$nuevo),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Crear Actividad'), 'url'=>array('crearActividad', "id" => $model->id), 'icon'=>'file', 'visible'=>$nuevo),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)), null); ?>

<?php $this->widget('bootstrap.widgets.TbAlert'); ?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		//'id',
		array(
			'name' => 'calendarioDocente',
			'type' => 'raw',
			'value' => $model->calendarioDocente !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->calendarioDocente))) : null,
			),
		'fecha_creacion',
		'fecha_proposicion',
		'fecha_respuesta',
                array(
                    'name'=>'estado',
                    'value'=>$model->getEtiquetaEstado(),
                    'type'=>'raw',
                ),
		'semestre',
		'fecha_inicio',
		'fecha_termino',
                //'user_id',
                array(
			'name' => 'user_id',
			'type' => 'raw',
			'value' => $model->user !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->user))) : null,
                ),
	),
)); ?>


<?php $this->widget('yiiwheels.widgets.grid.WhGroupGridView', array(
	'id' => 'actividad-grid',
	'dataProvider' => $model_actividad_planificacion,
	//'filter' => $model_actividad_planificacion,
        'type'=>'striped bordered condensed',
        'template'=>"{summary}{items}{pager}",
        //'htmlOptions' => array(
        //                        'style' => 'overflow-y:auto;'
        //                                   .'table-layout:fixed;'
        //                                   .'white-space:nowrap;'
        //                                   ),       
	'columns' => array(
		//'id',
		/*array(
				'name'=>'planificacion_semestral_id',
				'value'=>'GxHtml::valueEx($data->planificacionSemestral)',
				'filter'=>GxHtml::listDataEx(PlanificacionSemestral::model()->findAllAttributes(null, true)),
				),*/
		'fecha_inicio',
		'fecha_termino',
		'detalle',
        
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                    'template'=>'{view}{update}{delete}',
                    'visible'=>$nuevo,
                    'buttons'=>array(
                        'view' => array(
                            'label'=>'Ver Actividad',
                            'url'=>'Yii::app()->createUrl("planificacion/verActividad", array("id"=>$data->id))',
                            ),
                        'update' => array(
                            'label'=>'Editar Actividad',
                            'url'=>'Yii::app()->createUrl("planificacion/editarActividad", array("id"=>$data->id))',
                            ),
                        'delete' => array(
                            'label'=>'Eliminar Actividad',
                            'url'=>'Yii::app()->createUrl("planificacion/borrarActividad", array("id"=>$data->id))',
                            ),
                    ),
                ),   
        ),
)); ?>