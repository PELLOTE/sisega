<?php

$this->breadcrumbs = array(
	$model->label(2) => array('administrar'),
	GxHtml::valueEx($model),
);

$this->menu=array(
        array('label'=>Yii::t('app', 'Operations')),
        array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('administrar'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('crear'), 'icon'=>'file'),
        array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('actualizar', 'id' => $model->id), 'icon'=>'pencil'),
        //array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('borrar', 'id' => $model->id), 'confirm'=>Yii::t('app', 'Are you sure you want to delete this item?')), 'icon'=>'trash'),
        array('label'=>Yii::t('app', 'Aceptar Calendario'), 'url'=>'#', 'linkOptions' => array('submit' => array('aceptarCalendario', 'id' => $model->id), 'confirm'=>Yii::t('app', '¿Deseas aceptar este calendario docente?')), 'icon'=>'thumbs-up'),
        array('label'=>Yii::t('app', 'Terminar Calendario'), 'url'=>'#', 'linkOptions' => array('submit' => array('terminarCalendario', 'id' => $model->id), 'confirm'=>Yii::t('app', '¿Deseas terminar este calendario docente?')), 'icon'=>'thumbs-down'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Agregar Actividad'), 'url'=>array('actividadUta/crear', 'id' => $model->id), 'icon'=>'plus'),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>


<?php echo TbHtml::pageHeader(Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)), TbHtml::labelTb('Admin')); ?>

<?php $this->widget('bootstrap.widgets.TbAlert'); ?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		'id',
		'inicio_primer_semestre',
		'termino_primer_semestre',
		'inicio_segundo_semestre',
		'termino_segundo_semestre',
		'anio',
		array(
                    'name'=>'estado',
                    'value'=>$model->getEtiquetaEstado(),
                    'type'=>'raw',
                ),
	),
)); ?>

<?php $this->widget('yiiwheels.widgets.grid.WhGroupGridView', array(
	'id' => 'actividaduta-grid',
	'dataProvider' => new CArrayDataProvider($model->actividadUtas,array('pagination'=>false)),
        'type'=>'striped bordered condensed',
        'template'=>"{summary}{items}{pager}",
        'columns' => array(
		//'id',
		/*array(
				'name'=>'planificacion_semestral_id',
				'value'=>'GxHtml::valueEx($data->planificacionSemestral)',
				'filter'=>GxHtml::listDataEx(PlanificacionSemestral::model()->findAllAttributes(null, true)),
				),*/
		array(
                    'name'=>'Semestre',
                    'value'=>'$data->semestre',
                ),
            
                array(
                    'name'=>'Fecha Inicio',
                    'value'=>'$data->fecha_inicio',
                ),
		array(
                    'name'=>'Fecha Termino',
                    'value'=>'$data->fecha_termino',
                ),
		array(
                    'name'=>'Detalle',
                    'value'=>'$data->detalle',
                ),
        
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                    'template'=>'{view}{update}{delete}',
                    //'visible' =>$nuevo,
                    'buttons'=>array(
                        'view' => array(
                            'label'=>'Ver Actividad',
                            'url'=>'Yii::app()->createUrl("administracion/actividadUta/ver", array("id"=>$data->id))',
                            ),
                        'update' => array(
                            'label'=>'Editar Actividad',
                            'url'=>'Yii::app()->createUrl("administracion/actividadUta/actualizar", array("id"=>$data->id))',
                            ),
                        'delete' => array(
                            'label'=>'Eliminar Actividad',
                            'url'=>'Yii::app()->createUrl("administracion/actividadUta/borrar", array("id"=>$data->id))',
                            ),
                    ),
                ),   
        ),
        'mergeColumns' => array('Semestre')
)); ?>
