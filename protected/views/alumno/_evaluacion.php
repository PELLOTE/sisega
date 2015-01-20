<h2><?php // echo GxHtml::encode($model->getRelationLabel('evaluacions')); ?></h2>
<?php $labelEvaluacion = Evaluacion::model()->attributeLabels(); ?>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'evaluacion-grid',
	'dataProvider' => new CArrayDataProvider($model->evaluacions),
        'type'=>'striped bordered condensed',
        'template'=>"{items}{pager}{summary}",
	'columns' => array(
		//'id',
		array(
                        'name'=> $labelEvaluacion['nombre'],
                        'value'=>'$data->nombre',
                ),            
		array(
                        'name'=> $labelEvaluacion['fecha'],
                        'value'=>'$data->fecha',
                ),
		array(
                        'name'=> $labelEvaluacion['observacion'],
                        'value'=>'$data->observacion',
                ),              
	),
)); ?>