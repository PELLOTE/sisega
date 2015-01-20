<?php

$this->breadcrumbs = array(
       Yii::app()->user->profesor => Yii::app()->createUrl('academico/panel'),
       GxHtml::encode(Curso::label(2))=> Yii::app()->createUrl('academico/misCursos'),
       GxHtml::valueEx($model->curso)=>Yii::app()->createUrl('academico/verCurso', array('id'=>$model->curso_id)),
       GxHtml::valueEx($model),
);

$this->menu=array(
        array('label'=>Yii::t('app', 'Operations')),
//        array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('listar'), 'icon'=>'list'),
//        array('label'=>Yii::t('app', 'Create') . ' ' . Yii::t('app', 'Calificacion'), 'url'=>array('crearCalificacion', 'id' => $model->id), 'icon'=>'file'),
        array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('editarEvaluacion', 'id' => $model->id), 'icon'=>'pencil'),
        array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('borrarEvaluacion', 'id' => $model->id), 'confirm'=>Yii::t('app', 'Are you sure you want to delete this item?')), 'icon'=>'trash'),
//        array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('administrar'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Calificacion')),
        array('label'=>Yii::t('app', 'Create') . ' ' . Yii::t('app', 'Calificacion'), 'url'=>array('crearCalificacion', 'id' => $model->id), 'icon'=>'file'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)), null); ?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		'id',
//		array(
//			'name' => 'curso',
//			'type' => 'raw',
//			'value' => $model->curso !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->curso)), array('curso/ver', 'id' => GxActiveRecord::extractPkValue($model->curso, true))) : null,
//			),
                'nombre',
		'fecha',
		'observacion',
	),
)); ?>

<h2><?php echo GxHtml::encode($model->getRelationLabel('calificacions')); ?></h2>
<?php $labelCalificacion = Calificacion::model()->attributeLabels(); ?>
<?php $labelAlumno = Alumno::model()->attributeLabels(); ?>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'calificacion-grid',
	'dataProvider' => new CArrayDataProvider($model->calificacions),
        'type'=>'striped bordered condensed',
        'template'=>"{items}{pager}{summary}",
	'columns' => array(
		//'id',
		array(
                        'name'=> $labelAlumno['run'],
                        'value'=>'$data->alumno->run',
                ),
		array(
                        'name'=> $labelAlumno['nombre'],
                        'value'=>'$data->alumno->nombre',
                ),
		array(
                        'name'=> $labelCalificacion['nota'],
                        'value'=>'$data->nota',
                ),
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
//                'template'=>'{update}{delete}',
                'viewButtonUrl'=>'Yii::app()->controller->createUrl("verCalificacion", array("id"=>$data->id))',
                'updateButtonUrl'=>'Yii::app()->controller->createUrl("editarCalificacion", array("id"=>$data->id))',
                'deleteButtonUrl'=>'Yii::app()->controller->createUrl("borrarCalificacion", array("id"=>$data->id))',
          ),                
	),
)); ?>
