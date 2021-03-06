<?php

$this->breadcrumbs = array(
	Yii::t('app', 'Manage'),
);

$this->menu = array(
        array('label'=>Yii::t('app', 'Operations')),
        //array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('listar'), 'icon'=>'list'),
        array('label'=>Yii::t('app', 'Create') . ' ' . $model_curso->label(), 'url'=>array('crearCurso'), 'icon'=>'file'),
        array('label'=>Yii::t('app', 'Export')),
        array('label'=>Yii::t('app', 'Export to Excel'), 'url'=>array('GenerarExcel', "tipo" => $tipo), 'linkOptions'=>array('target'=>'_blank'), 'icon'=>'download-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<div class="title-menu">
        <?php echo TbHtml::pageHeader(Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model_curso->label(2)), null); ?>
</div>

<p>
<?php echo Yii::t('app', 'Text Option Search'); ?></p>

<div class="buttons-admin">
<?php 
       echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button btn'));
?>
</div>
<div class="search-form">
<?php $this->renderPartial('curso/_busqueda', array(
	'model' => $model_curso,
)); ?>
</div><!-- search-form -->

<?php $this->widget('yiiwheels.widgets.grid.WhGroupGridView', array(
	'id' => 'curso-grid',
	'dataProvider' => $model_curso->search(),
	'filter' => $model_curso,
        'type'=>'striped bordered condensed',
        'template'=>"{summary}{items}{pager}",
        'columns' => array(
		//'id',
            'anio',
                array( 'name'=>'semestre','header'=>'Semestre', 'value'=>'($data->semestre==1)?"I":"II"' ),
		array(
				'name'=>'asignatura_id',
				'value'=>'GxHtml::valueEx($data->asignatura)',
				'filter'=>GxHtml::listDataEx(Asignatura::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'profesor_id',
				'value'=>'GxHtml::valueEx($data->profesor)',
				'filter'=>GxHtml::listDataEx(Profesor::model()->findAllAttributes(null, true)),
				),
		
//		'nombre',
		array(
                    'name'=>'estado',
                    'value'=>'$data->getEtiquetaEstado()',
                    'type'=>'raw',
                ), 

        array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template'=>'{view}{update}',
                'viewButtonUrl'=>'Yii::app()->controller->createUrl("verCurso", array("id"=>$data->id))',
                'updateButtonUrl'=>'Yii::app()->controller->createUrl("editarCurso", array("id"=>$data->id))',
                //'deleteButtonUrl'=>'Yii::app()->controller->createUrl("borrarCurso", array("id"=>$data->id))',
          ),                
	),
    'mergeColumns' => array('anio','semestre','estado')
)); ?>

<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').slideToggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('curso-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>