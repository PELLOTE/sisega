<?php

$this->breadcrumbs = array(
	$model->label(2) => array('listar'),
	GxHtml::valueEx($model),
);

$this->menu=array(
        array('label'=>Yii::t('app', 'Operations')),
        //array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('listar'), 'icon'=>'list'),
        array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('crearAsignatura'), 'icon'=>'file'),
        array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('editarAsignatura', 'id' => $model->id), 'icon'=>'pencil'),
        //array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('borrarAsignatura', 'id' => $model->id), 'confirm'=>Yii::t('app', 'Are you sure you want to delete this item?')), 'icon'=>'trash'),
        array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('verAsignaturas'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)), null); ?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		'id',
		'nombre',
		'semestre',
		'programa',
	),
)); ?>

<h2><?php echo GxHtml::encode($model->getRelationLabel('cursos')); ?></h2>

    <?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'curso-grid',
	'dataProvider' => new CArrayDataProvider($model->cursos,array()),
	//'filter' => $model->cursos,
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
				'name'=>'profesor',
				'value'=>'GxHtml::valueEx($data->profesor)',
				'filter'=>GxHtml::listDataEx(Profesor::model()->findAllAttributes(null, true)),
				),
		'semestre',
		'anio',
        array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template'=>'{view}{update}',
                'viewButtonUrl'=>'Yii::app()->controller->createUrl("verCurso", array("id"=>$data->id))',
                'updateButtonUrl'=>'Yii::app()->controller->createUrl("editarCurso", array("id"=>$data->id))',
                //'deleteButtonUrl'=>'Yii::app()->controller->createUrl("borrarCurso", array("id"=>$data->id))',
          ),                
	),
)); ?>