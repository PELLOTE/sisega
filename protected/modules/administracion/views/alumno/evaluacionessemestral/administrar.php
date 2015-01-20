<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'alumno-grid',
	'dataProvider' => $model,
        'type'=>'striped bordered condensed',
        'template'=>"{summary}{items}{pager}",  
	'columns' => array(
		array(
                    'name'=>'Año',
                    'value'=>'$data->anio',
                ),             
                array(
                    'name'=>'Semestre',
                    'value'=>'$data->semestre',
                ),
                array(
                    'name'=>'Semestre Cursado',
                    'value'=>'$data->semestre_cursado',
                ),
                array(
                    'name'=>'Oportunidad',
                    'value'=>'$data->oportunidad',
                ),
                array(
                    'name'=>'Promedio',
                    'value'=>'$data->promedio',
                ),
                array(
                    'name'=>'Observacion',
                    'value'=>'$data->observacion',
                ),
                
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{view}{update}',
                    'viewButtonUrl'=>'Yii::app()->controller->createUrl("evaluacionsemestral/ver", array("id"=>$data->id))',
                    'updateButtonUrl'=>'Yii::app()->controller->createUrl("evaluacionsemestral/actualizar", array("id"=>$data->id))',
                    //'deleteButtonUrl'=>'Yii::app()->controller->createUrl("evaluacionsemestral/borrar", array("id"=>$data->id))',
                ),                
	),
)); ?>
