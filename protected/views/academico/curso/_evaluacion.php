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
                        'name'=> $labelEvaluacion['fecha'],
                        'value'=>'$data->fecha',
                ),
		array(
                        'name'=> $labelEvaluacion['nombre'],
                        'value'=>'$data->nombre',
                ),
		array(
                        'name'=> $labelEvaluacion['observacion'],
                        'value'=>'$data->observacion',
                ),
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
                'viewButtonUrl'=>'Yii::app()->controller->createUrl("verEvaluacion", array("id"=>$data->id))',
                'updateButtonUrl'=>'Yii::app()->controller->createUrl("editarEvaluacion", array("id"=>$data->id))',
                'deleteButtonUrl'=>'Yii::app()->controller->createUrl("borrarEvaluacion", array("id"=>$data->id))',
                'deleteConfirmation'=>Yii::t('app','¿Seguro que desea borrar este elemento?, esto provocará que se eliminen todas las calificaciones asociadas.'),
          ),                
	),
)); ?>