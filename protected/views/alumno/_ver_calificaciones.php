
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'calificaciones-grid',
	'dataProvider' => $calificaciones_alumno,
	//'filter' => $model,
        'type'=>'striped bordered condensed',
        'template'=>"{items}{pager}{summary}",
        //'htmlOptions' => array(
        //                        'style' => 'overflow-y:auto;'
        //                                   .'table-layout:fixed;'
        //                                   .'white-space:nowrap;'
        //                                   ),       
	'columns' => array(
		//'id',
		array(
				'name'=>'Evaluación',
				'value'=>'$data->evaluacion->nombre',
				),
		array(
				'name'=>'fecha_evaluacion',
				'value'=>'Yii::app()->format->FormatoFechaApp($data->fecha_evaluacion)',
				),
                
//                'observacion_evaluacion',
                'nota'
        ),
)); ?>

