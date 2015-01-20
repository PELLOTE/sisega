<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'evaluacion-grid',
	'dataProvider' => $model,
        'type'=>'striped bordered condensed',
        'template'=>"{summary}{items}{pager}",  
	'columns' => array(
		array(
                    'name'=>'Nombre',
                    'value'=>'$data->nombre',
                ),
                array(
                    'name'=>'Fecha',
                    'value'=>'$data->fecha',
                ),
                array(
                    'name'=>'Observacion',
                    'value'=>'$data->observacion',
                ),
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{view}{update}',
                    'viewButtonUrl'=>'Yii::app()->controller->createUrl("evaluacion/ver", array("id"=>$data->id))',
                    'updateButtonUrl'=>'Yii::app()->controller->createUrl("evaluacion/actualizar", array("id"=>$data->id))',
                    //'deleteButtonUrl'=>'Yii::app()->controller->createUrl("evaluacion/borrar", array("id"=>$data->id))',
                ),                
	),
)); ?>
