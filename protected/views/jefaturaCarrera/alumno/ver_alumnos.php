<?php

$this->breadcrumbs = array(
	Yii::t('app', 'Manage'),
);

$this->menu = array(
        
        array('label'=>Yii::t('app', 'Export')),
        array('label'=>Yii::t('app', 'Export to Excel'), 'url'=>array('GenerarExcel', "tipo" => $tipo), 'linkOptions'=>array('target'=>'_blank'), 'icon'=>'download-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<div class="title-menu">
        <?php echo TbHtml::pageHeader(Yii::t('app', 'View') . ' ' . GxHtml::encode($model_alumnos->label(2)), null); ?>
</div>

<p>
<?php echo Yii::t('app', 'Text Option Search'); ?></p>

<div class="buttons-admin">
<?php 
       echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button btn'));
?>
</div>
<div class="search-form">
<?php $this->renderPartial('alumno/_busqueda', array(
	'model' => $model_alumnos,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'alumno-grid',
	'dataProvider' => $model_alumnos->search(),
	'filter' => $model_alumnos,
        'type'=>'striped bordered condensed',
        'template'=>"{summary}{items}{pager}",
        //'htmlOptions' => array(
        //                        'style' => 'overflow-y:auto;'
        //                                   .'table-layout:fixed;'
        //                                   .'white-space:nowrap;'
        //                                   ),       
	'columns' => array(
		//'id',
		'nombre',
		'run',
		'direccion',
		/*array(
                    'name'=>'user_id',
                    'value'=>'GxHtml::valueEx($data->user)',
                    'filter'=>GxHtml::listDataEx(User::model()->findAllAttributes(null, true)),
		),*/
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                    'template'=>'{evaluacion} {view}',
                    'buttons'=>array(
                        'view' => array(
					'label'=>'Ver Avance Curricular',
					'url'=>'Yii::app()->createUrl("jefaturaCarrera/verAvanceCurricular", array("id"=>$data->id))',
			),
                        'evaluacion' => array(
					'label'=>'Ver Evaluaciones',
                                        'icon'=>'list-alt',
					'url'=>'Yii::app()->createUrl("jefaturaCarrera/verEvaluacionesSemestrales", array("id"=>$data->id))',
			),
                    ),
				
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
	$.fn.yiiGridView.update('alumno-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>