<?php

$this->breadcrumbs = array(
       GxHtml::valueEx($alumno) => array('misCursos'),
       GxHtml::encode(Curso::label(2)),
);

$this->menu=array(
        //array('label'=>Yii::t('app', 'Operations')),
        //array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('VerAvanceCurricular'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'Mis Cursos') , null); ?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $alumno,
	'attributes' => array(
		//'id',
		'nombre',
		'run',
		'direccion',
//		array(
//			'name' => 'user',
//			'type' => 'raw',
//			'value' => $model->user !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->user)), array('user/ver', 'id' => GxActiveRecord::extractPkValue($model->user, true))) : null,
//			),
	),
)); ?>

<?php 
$this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'calificaciones-grid',
	'dataProvider' => new CArrayDataProvider($cursos_alumno,array()),
	//'filter' => $model,
        'type'=>'striped bordered condensed',
        'template'=>"{summary}{items}{pager}",
	'columns' => array(
		//'id',
		//'semestre',
                //'nombre',
		array(
			'name' => Asignatura::label(),
			'type' => 'raw',
			'value' => 'GxHtml::valueEx($data->asignatura)',
			),
		array(
			'name' => Profesor::label(),
			'type' => 'raw',
			'value' => '$data->profesor',
			),
             array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'htmlOptions'=>array('style'=>'width: 50px'),
		'template'=>'{view}',
		'buttons'=>array(
                    'view' => array(
                        'label'=>'Ver Curso',
			'url'=>'Yii::app()->createUrl("alumno/verCurso", array("id"=>$data->id))',
                        ),
		),
            ), 
        ),
));
?>

