<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'plan-actividad-grid',
	'dataProvider' =>$plan_actividad,
	//'filter' => $model,
        'type'=>'striped bordered condensed',
        'template'=>"{items}{pager}{summary}",
        //'htmlOptions' => array(
        //                        'style' => 'overflow-y:auto;'
        //                                   .'table-layout:fixed;'
        //                                   .'white-space:nowrap;'
        //                                   ),       
	'columns' => array(	
               // 'id',
//		array(
//				'name'=>'curso_id',
//				'value'=>'GxHtml::valueEx($data->curso)',
//				'filter'=>GxHtml::listDataEx(Curso::model()->findAllAttributes(null, true)),
//				),
//		array(
//				'name'=>'planificacion_semestral_id',
//				'value'=>'GxHtml::valueEx($data->planificacionSemestral)',
//				'filter'=>GxHtml::listDataEx(PlanificacionSemestral::model()->findAllAttributes(null, true)),
//				),
                'actividad',
		'fecha_inicio',
		'fecha_termino',
		
	),
)); ?>
