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
                    'name'=>'Año',
                    'value'=>'$data->anio',
                ),
                array(
                    'name'=>'Semestre',
                    'value'=>'$data->semestre',
                ),
                
                array(
                    'name'=>'Estado',
                    'value'=>'$data->estado',
                ), 
                
                            
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{view}{update}',
                    'viewButtonUrl'=>'Yii::app()->controller->createUrl("curso/ver", array("id"=>$data->id))',
                    'updateButtonUrl'=>'Yii::app()->controller->createUrl("curso/actualizar", array("id"=>$data->id))',
                    //'deleteButtonUrl'=>'Yii::app()->controller->createUrl("curso/borrar", array("id"=>$data->id))',
                ),                
	),
)); ?>
