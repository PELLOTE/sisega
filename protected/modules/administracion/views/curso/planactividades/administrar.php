<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'plan-actividad-grid',
	'dataProvider' => $model,
        'type'=>'striped bordered condensed',
        'template'=>"{summary}{items}{pager}",  
	'columns' => array(
		
                array(
                    'name'=>'Fecha Inicio',
                    'value'=>'$data->fecha_inicio',
                ),
                array(
                    'name'=>'Fecha Termino',
                    'value'=>'$data->fecha_termino',
                ),
                array(
                    'name'=>'Actividad',
                    'value'=>'$data->actividad',
                ),
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{view}{update}',
                    'viewButtonUrl'=>'Yii::app()->controller->createUrl("planActividad/ver", array("id"=>$data->id))',
                    'updateButtonUrl'=>'Yii::app()->controller->createUrl("planActividad/actualizar", array("id"=>$data->id))',
                    //'deleteButtonUrl'=>'Yii::app()->controller->createUrl("planActividad/borrar", array("id"=>$data->id))',
                ),                
	),
)); ?>
