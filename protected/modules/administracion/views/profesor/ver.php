<?php

$this->breadcrumbs = array(
        Yii::t('app', $this->module->id) => Yii::app()->createUrl($this->module->baseUrl),  
	$model->label(2) => array('administrar'),
	GxHtml::valueEx($model),
);

$this->menu=array(
        array('label'=>Yii::t('app', 'Operations')),
        array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('crear'), 'icon'=>'file'),
        array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('actualizar', 'id' => $model->id), 'icon'=>'pencil'),
        //array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('borrar', 'id' => $model->id), 'confirm'=>Yii::t('app', 'Are you sure you want to delete this item?')), 'icon'=>'trash'),
        array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('administrar'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)), TbHtml::labelTb('Admin')); ?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		'id',
		'nombre',
                'run',
                'email',
		array(
			'name' => 'user',
			'type' => 'raw',
			'value' => $model->user !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->user)), array('user/view', 'id' => GxActiveRecord::extractPkValue($model->user, true))) : null,
			),
	),
)); ?>

</br><legend>Mis Cursos</legend>

<?php $this->widget('yiiwheels.widgets.grid.WhGroupGridView', array(
	'id' => 'cursos-grid',
	'dataProvider' => new CArrayDataProvider($model->cursos,array()),
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
                    'name'=>'Nombre',
                    'value'=>'$data->nombre',
                ),
                array(
                    'name'=>'Año',
                    'value'=>'$data->anio',
                ),
                array(
                    'name'=>'Semestre',
                    'value'=>'$data->semestre',
                ),
                array(
                    'name'=>'Estado',
                    'value'=>'$data->estado',
                ),
                   
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                    'template'=>'{view}{update}',
                    'buttons'=>array(
                        'view' => array(
                            'label'=>'Ver Curso',
                            'url'=>'Yii::app()->createUrl("administracion/curso/ver", array("id"=>$data->id))',
                            ),
                        'update' => array(
                            'label'=>'Editar Curso',
                            'url'=>'Yii::app()->createUrl("administracion/curso/actualizar", array("id"=>$data->id))',
                            ),
//                        'delete' => array(
//                            'label'=>'Eliminar Curso',
//                            'url'=>'Yii::app()->createUrl("administracion/curso/borrar", array("id"=>$data->id))',
//                            ),
                    ),
                ),   
        ),
)); ?>