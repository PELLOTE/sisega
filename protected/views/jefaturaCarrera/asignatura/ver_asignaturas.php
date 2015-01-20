<?php

$this->breadcrumbs = array(
	$model_asignatura->label(2) => array('verAsignaturas'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
        array('label'=>Yii::t('app', 'Operations')),
        //array('label'=>Yii::t('app', 'List') . ' ' . $model_asignatura->label(2), 'url'=>array('listar'), 'icon'=>'list'),
        array('label'=>Yii::t('app', 'Create') . ' ' . $model_asignatura->label(), 'url'=>array('crearAsignatura'), 'icon'=>'file'),
        array('label'=>Yii::t('app', 'Export')),
        array('label'=>Yii::t('app', 'Export to Excel'), 'url'=>array('GenerarExcel', "tipo" => $tipo), 'linkOptions'=>array('target'=>'_blank'), 'icon'=>'download-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<div class="title-menu">
        <?php echo TbHtml::pageHeader(Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model_asignatura->label(2)), null); ?>
</div>

<p>
<?php echo Yii::t('app', 'Text Option Search'); ?></p>

<div class="buttons-admin">
<?php 
       echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button btn'));
?>
</div>
<div class="search-form">
<?php $this->renderPartial('asignatura/_busqueda', array(
	'model' => $model_asignatura,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'asignatura-grid',
	'dataProvider' => $model_asignatura->search(),
	'filter' => $model_asignatura,
        'type'=>'striped bordered condensed',
        'template'=>"{summary}{items}{pager}",    
	'columns' => array(
		//'id',
		'nombre',
		'semestre',
		'programa',
        array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template'=>'{view}{update}',
                'viewButtonUrl'=>'Yii::app()->controller->createUrl("verAsignatura", array("id"=>$data->id))',
                'updateButtonUrl'=>'Yii::app()->controller->createUrl("editarAsignatura", array("id"=>$data->id))',
                'deleteButtonUrl'=>'Yii::app()->controller->createUrl("borrarAsignatura", array("id"=>$data->id))',
          ),                
	),
)); ?>

<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').slideToggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('asignatura-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>