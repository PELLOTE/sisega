<?php

$this->breadcrumbs = array(
       Yii::app()->user->profesor => Yii::app()->createUrl('academico/panel'),
       GxHtml::encode(Curso::label(2))=> Yii::app()->createUrl('academico/misCursos'),
        GxHtml::valueEx($model->curso)=>Yii::app()->createUrl('academico/verCurso', array('id'=>$model->curso->id)),
	Yii::t('app', 'Create'). ' ' . $model->label(1),
);

$this->menu = array(
//        array('label'=>Yii::t('app', 'Operations')),
//        array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url' => array('listar'), 'icon'=>'list'),
//        array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('administrar'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
echo Yii::t('app', '<h3>Plan de Actividad del Curso</h3>');
?>

<?php $this->widget('yiiwheels.widgets.grid.WhGroupGridView', array(
	'id' => 'actividad-grid',
	'dataProvider' => new CArrayDataProvider($model->curso->planActividads,array()),
	//'filter' => $model_actividad_planificacion,
        'type'=>'striped bordered condensed',
        'template'=>"{summary}{items}{pager}",
        //'htmlOptions' => array(
        //                        'style' => 'overflow-y:auto;'
        //                                   .'table-layout:fixed;'
        //                                   .'white-space:nowrap;'
        //                                   ),       
	'columns' => array(
		
		array(
                    'name' => 'Fecha Inicio',
                    'value' => '$data->fecha_inicio',
                ),
                
                array(
                    'name' => 'Fecha Termino',
                    'value' => '$data->fecha_termino',
                ),

		array(
                    'name' => 'Actividad',
                    'value' => '$data->actividad',
                ),
        
        ),
)); ?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'Create') . ' ' . GxHtml::encode($model->label()), null); ?>
<?php
$this->renderPartial('evaluacion/_formEvaluacion', array(
		'model' => $model,
                'model_planificacion_semestral'=> $model_planificacion_semestral,
		'buttons' => 'create'));
?>