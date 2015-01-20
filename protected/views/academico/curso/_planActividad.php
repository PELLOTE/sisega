<h2><?php // echo GxHtml::encode($model->getRelationLabel('planActividads')); ?></h2>
<?php $labelPlanActividad = PlanActividad::model()->attributeLabels(); ?>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'plan-actividad-grid',
	'dataProvider' => new CArrayDataProvider($model->planActividads),
        'type'=>'striped bordered condensed',
        'template'=>"{items}{pager}{summary}",
	'columns' => array(
		//'id',
		array(
                        'name'=> $labelPlanActividad['actividad'],
                        'value'=>'$data->actividad',
                ),
		array(
                        'name'=> $labelPlanActividad['fecha_inicio'],
                        'value'=>'$data->fecha_inicio',
                ),
		array(
                        'name'=> $labelPlanActividad['fecha_termino'],
                        'value'=>'$data->fecha_termino',
                ),
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
                'template'=>'{view}{update}',
                'viewButtonUrl'=>'Yii::app()->controller->createUrl("verPlanActividad", array("id"=>$data->id))',
                'updateButtonUrl'=>'Yii::app()->controller->createUrl("editarPlanActividad", array("id"=>$data->id))',
                ),                
	),
)); ?>