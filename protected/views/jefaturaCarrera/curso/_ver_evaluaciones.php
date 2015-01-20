<?php $this->widget('yiiwheels.widgets.grid.WhGroupGridView', array(
	'id' => 'evaluacion-grid',
	'dataProvider' => $model_evaluacion,
	//'filter' => $model_evaluacion,
        'type'=>'striped bordered condensed',
        'template'=>"{summary}{items}{pager}",
        //'htmlOptions' => array(
        //                        'style' => 'overflow-y:auto;'
        //                                   .'table-layout:fixed;'
        //                                   .'white-space:nowrap;'
        //                                   ),       
	'columns' => array(
		//'id',
		'fecha',
		'observacion',
        ),
)); ?>
