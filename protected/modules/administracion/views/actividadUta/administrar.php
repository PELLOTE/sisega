<?php

$this->breadcrumbs = array(
	Yii::t('app', 'Manage'),
);

$this->menu = array(
        array('label'=>Yii::t('app', 'Operations')),
        array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('listar'), 'icon'=>'list'),
        array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('crear'), 'icon'=>'file'),
        array('label'=>Yii::t('app', 'Export')),
        array('label'=>Yii::t('app', 'Export to Excel'), 'url'=>Yii::app()->controller->createUrl('GenerarExcel'), 'linkOptions'=>array('target'=>'_blank'), 'icon'=>'download-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<div class="title-menu">
        <?php echo TbHtml::pageHeader(Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)), TbHtml::labelTb('Admin')); ?>
</div>

<p>
<?php echo Yii::t('app', 'Text Option Search'); ?></p>

<div class="buttons-admin">
<?php 
       echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button btn'));
?>
</div>
<div class="search-form">
<?php $this->renderPartial('_busqueda', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'actividad-uta-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
        'type'=>'striped bordered condensed',
        'template'=>"{summary}{items}{pager}",
        //'htmlOptions' => array(
        //                        'style' => 'overflow-y:auto;'
        //                                   .'table-layout:fixed;'
        //                                   .'white-space:nowrap;'
        //                                   ),       
	'columns' => array(
		'id',
		'semestre',
		'fecha_inicio',
		'fecha_termino',
		'detalle',
		array(
				'name'=>'calendario_docente_id',
				'value'=>'GxHtml::valueEx($data->calendarioDocente)',
				'filter'=>GxHtml::listDataEx(CalendarioDocente::model()->findAllAttributes(null, true)),
				),
        array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'viewButtonUrl'=>'Yii::app()->controller->createUrl("ver", array("id"=>$data->id))',
                'updateButtonUrl'=>'Yii::app()->controller->createUrl("actualizar", array("id"=>$data->id))',
                'deleteButtonUrl'=>'Yii::app()->controller->createUrl("borrar", array("id"=>$data->id))',
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
	$.fn.yiiGridView.update('actividad-uta-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>