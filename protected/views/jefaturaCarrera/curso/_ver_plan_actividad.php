<?php $this->widget('yiiwheels.widgets.grid.WhGroupGridView', array(
	'id' => 'plan-actividad-grid',
	'dataProvider' =>$model_plan_actividad,
	//'filter' => $model,
        'type'=>'striped bordered condensed',
        'template'=>"{summary}{items}{pager}",
        //'htmlOptions' => array(
        //                        'style' => 'overflow-y:auto;'
        //                                   .'table-layout:fixed;'
        //                                   .'white-space:nowrap;'
        //                                   ),       
	'columns' => array(	
               // 'id',
		array(
				'name'=>'planificacion_semestral_id',
				'value'=>'GxHtml::valueEx($data->planificacionSemestral)',
				'filter'=>GxHtml::listDataEx(PlanificacionSemestral::model()->findAllAttributes(null, true)),
				),
		'fecha_inicio',
		'fecha_termino',
		'actividad',
	),
)); ?>
