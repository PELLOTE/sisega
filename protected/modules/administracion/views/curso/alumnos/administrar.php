<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'alumno-grid',
	'dataProvider' => $model,
        'type'=>'striped bordered condensed',
        'template'=>"{summary}{items}{pager}",  
	'columns' => array(
		array(
                    'name'=>'Nombre',
                    'value'=>'$data->nombre',
                ),             
                array(
                    'name'=>'Run',
                    'value'=>'$data->run',
                ), 
                
                array(
                    'name'=>'Direccion',
                    'value'=>'$data->direccion',
                ),            
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{view}{update}',
                    'viewButtonUrl'=>'Yii::app()->controller->createUrl("alumno/ver", array("id"=>$data->id))',
                    'updateButtonUrl'=>'Yii::app()->controller->createUrl("alumno/actualizar", array("id"=>$data->id))',
                    //'deleteButtonUrl'=>'Yii::app()->controller->createUrl("alumno/borrar", array("id"=>$data->id))',
                ),                
	),
)); ?>
