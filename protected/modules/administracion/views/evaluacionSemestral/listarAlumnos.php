<?php

$this->breadcrumbs = array(
        Yii::t('app', $this->module->id) => Yii::app()->createUrl($this->module->baseUrl),  
	EvaluacionSemestral::label(2),
);

?>
<?php echo TbHtml::pageHeader(GxHtml::encode(EvaluacionSemestral::label(2)), TbHtml::labelTb('Admin')); ?>
<?php echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_VERTICAL,null,'post',array('id' => 'detalle-producto-form',)); ?>
    <fieldset>
        
        <?php echo TbHtml::label('Buscar', 'texto'); ?>
        <?php echo TbHtml::textField('Año', date("Y"),array('value'=>date("Y"), 'id' =>'anio', 'maxlength'=>36, 'placeholder'=>'2013')); ?>
        <?php echo TbHtml::dropDownList('Semestre', Null ,array(1 =>'I Semestre',2 =>'II Semestre'),array('id'=>'semestre')); ?><br>
        <?php echo TbHtml::submitButton('Buscar',array('icon'=>'search white', 'color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
        
    </fieldset>
<?php echo TbHtml::endForm(); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'evaluacion-semestral-grid',
	'dataProvider' =>$dataProvider,	
	'columns' => array(
		'id',		
		'nombre',		
		'run',
		'direccion',
		'anio_ingreso',		
            array(
                'class'=>'CButtonColumn',
                'template' => '{evaluar} ',
                'buttons' => array(
                    'evaluar' => array(
                        'label' => 'Evaluar', 
                        'url' => '$this->grid->controller->createUrl("malla/index", array("id"=>$data->id))', 
                        
                    )

                    )
            )
	),
)); ?>


<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/scroll.js'); ?>
