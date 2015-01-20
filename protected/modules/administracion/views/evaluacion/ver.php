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
        array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('borrar', 'id' => $model->id), 'confirm'=>Yii::t('app', 'Are you sure you want to delete this item?')), 'icon'=>'trash'),
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
		array(
			'name' => 'curso',
			'type' => 'raw',
			'value' => $model->curso !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->curso)), array('curso/ver', 'id' => GxActiveRecord::extractPkValue($model->curso, true))) : null,
			),
		'fecha',
		'nombre',
		'observacion',
	),
)); ?>

<?php $this->widget('yiiwheels.widgets.grid.WhGroupGridView', array(
	'id' => 'calificacion-grid',
	'dataProvider' => new CArrayDataProvider($model->calificacions,array()),
        'type'=>'striped bordered condensed',
        'template'=>"{summary}{items}{pager}",
	'columns' => array(
		
		array(
				'name'=>'Alumno',
				'value'=>'GxHtml::valueEx($data->alumno)',
				'filter'=>GxHtml::listDataEx(alumno::model()->findAllAttributes(null, true)),
				),
		array(
                    'name'=>'Nota',
                    'value'=>'$data->nota',
                ),
                    
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                    'template'=>'{view}{update}{delete}',
                    'buttons'=>array(
                        'view' => array(
                            'label'=>'Ver Calificacion',
                            'url'=>'Yii::app()->createUrl("administracion/calificacion/ver", array("id"=>$data->id))',
                            ),
                        'update' => array(
                            'label'=>'Editar Calificacion',
                            'url'=>'Yii::app()->createUrl("administracion/calificacion/actualizar", array("id"=>$data->id))',
                            ),
                        'delete' => array(
                            'label'=>'Eliminar Calificacion',
                            'url'=>'Yii::app()->createUrl("administracion/calificacion/borrar", array("id"=>$data->id))',
                            ),
                    ),
                ),   
        ),
)); ?>