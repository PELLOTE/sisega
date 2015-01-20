<?php

$this->breadcrumbs = array(
	//$model->label(2) => array('listar'),
	GxHtml::valueEx($model),
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

<?php echo TbHtml::pageHeader(Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ': ' . GxHtml::encode(GxHtml::valueEx($model)), null); ?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
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

<h2><?php echo GxHtml::encode($model->getRelationLabel('calificacions')); ?></h2>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'calificaciones-grid',
	'dataProvider' => $calificaciones_alumno,
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
		array(
				'name'=>'fecha_evaluacion',
				'value'=>'Yii::app()->format->FormatoFechaApp($data->fecha_evaluacion)',
				),
                
                'observacion_evaluacion',
                'nota'
        ),
)); ?>

<h2><?php echo GxHtml::encode($model->getRelationLabel('Evaluacion Semestral')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->evaluacionSemestrals as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('evaluacionSemestral/ver', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?>


