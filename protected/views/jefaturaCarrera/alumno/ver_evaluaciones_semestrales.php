
<?php

$this->breadcrumbs = array(
	//$model->label(2) => array('listar'),
	GxHtml::valueEx($model_alumno),
);

$this->menu=array(
        //array('label'=>Yii::t('app', 'Operations')),
        //array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('listar'), 'icon'=>'list'),
        //array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('crear'), 'icon'=>'file'),
        //array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('actualizar', 'id' => $model->id), 'icon'=>'pencil'),
        //array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('borrar', 'id' => $model->id), 'confirm'=>Yii::t('app', 'Are you sure you want to delete this item?')), 'icon'=>'trash'),
        //array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('administrar'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'View') . ' ' . GxHtml::encode($model_alumno->label()) . ': ' . GxHtml::encode(GxHtml::valueEx($model_alumno)), null); ?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model_alumno,
	'attributes' => array(
		//'id',
		//'nombre',
		'run',
		'direccion',
		/*array(
			'name' => 'user',
			'type' => 'raw',
			'value' => $model->user !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->user)), array('user/ver', 'id' => GxActiveRecord::extractPkValue($model->user, true))) : null,
			),*/
	),
)); ?>


<h2><?php echo GxHtml::encode($model_alumno->getRelationLabel('Evaluaciones Semestrales')); ?></h2>



<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'evaluacion-semestral-grid',
	'dataProvider' => new CArrayDataProvider($model_alumno->evaluacionSemestrals,array()),
	//'filter' => $model,
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
				'name'=>'alumno_id',
				'value'=>'GxHtml::valueEx($data->alumno)',
				'filter'=>GxHtml::listDataEx(Alumno::model()->findAllAttributes(null, true)),
				),*/
                array(
				'name'=>'Año',
				'value'=>'$data->anio',
				),
                array(
				'name'=>'Semestre Academico',
				'value'=>'$data->semestre',
				),
                array(
				'name'=>'Semestre Cursado',
				'value'=>'$data->semestre_cursado',
		),
                array(
				'name'=>'Promedio',
				'value'=>'$data->promedio',
		),
                array(
				'name'=>'Observacion',
				'value'=>'$data->observacion',
		),
		
        ),
)); ?>