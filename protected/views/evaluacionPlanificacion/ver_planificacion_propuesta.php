<br><br>
<?php if($model_planificacion_semestral != FALSE){?>
<?php

$this->breadcrumbs = array(
	//$model->label(2) => array('verPlanificaciones'),
	GxHtml::valueEx($model_planificacion_semestral),
);

$this->menu=array(
        //array('label'=>Yii::t('app', 'Operations')),
        //array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('verPlanificaciones'), 'icon'=>'list-alt'),
        //array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('editarPlanificacion', 'id' => $model->id), 'icon'=>'pencil', 'visible'=>$propuesto),
        //array('label'=>Yii::t('app', 'Crear Actividad'), 'url'=>array('crearActividad', "id" => $model->id), 'icon'=>'file', 'visible'=>$propuesto),
        array('label'=>Yii::t('app', 'Aceptar Planificacion') . ' ' . $model_planificacion_semestral->label(), 'url'=>array('aceptarPlanificacion', 'id' => $model_planificacion_semestral->id), 'icon'=>'ok', 'visible' => $estado),
        array('label'=>Yii::t('app', 'Rechazar Planificacion') . ' ' . $model_planificacion_semestral->label(), 'url'=>array('rechazarPlanificacion', 'id' => $model_planificacion_semestral->id), 'icon'=>'remove', 'visible' => $estado),
        //array('label'=>Yii::t('app', 'Other|Others', 2)),
        //array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'View') . ' ' . GxHtml::encode($model_planificacion_semestral->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model_planificacion_semestral)), null); ?>

<?php $this->widget('bootstrap.widgets.TbAlert'); ?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model_planificacion_semestral,
	'attributes' => array(
		'id',
		array(
			'name' => 'calendarioDocente',
			'type' => 'raw',
			'value' => $model_planificacion_semestral->calendarioDocente !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model_planificacion_semestral->calendarioDocente)), array('calendarioDocente/ver', 'id' => GxActiveRecord::extractPkValue($model_planificacion_semestral->calendarioDocente, true))) : null,
			),
		'fecha_creacion',
		'fecha_proposicion',
		'fecha_respuesta',
               /* array(
                    'name'=>'estado',
                    'value'=>'$data->getEtiquetaEstado()',
                    'type'=>'raw',
                ),*/
		'estado',
		'fecha_inicio',
		'fecha_termino',
                'semestre',
	),
)); ?>


<?php $this->widget('yiiwheels.widgets.grid.WhGroupGridView', array(
	'id' => 'actividad-grid',
	'dataProvider' => $model_actividades_planificacion,
	//'filter' => $model_actividad_planificacion,
        'type'=>'striped bordered condensed',
        'template'=>"{summary}{items}{pager}",
        //'htmlOptions' => array(
        //                        'style' => 'overflow-y:auto;'
        //                                   .'table-layout:fixed;'
        //                                   .'white-space:nowrap;'
        //                                   ),       
	'columns' => array(
		'fecha_inicio',
		'fecha_termino',
		'detalle',
        ),
)); ?>


<?php }else {?>
    No se encuentra una planificacion semestral propuesta.
<?php } ?>
