<?php $this->widget('yiiwheels.widgets.grid.WhGroupGridView', array(
	'id' => 'alumno-grid',
	'dataProvider' => new CArrayDataProvider($model->alumnos,array()),
	//'filter' => $model,
        'type'=>'striped bordered condensed',
        'template'=>"{summary}{items}{pager}",
        //'htmlOptions' => array(
        //                        'style' => 'overflow-y:auto;'
        //                                   .'table-layout:fixed;'
        //                                   .'white-space:nowrap;'
        //                                   ),       
	'columns' => array(
		//'id',
        	'run',
                'nombre',   
                'direccion',
	array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
            'template'=>'{view}',
            'buttons'=>array(
                'view' => array(
                                'label'=>'Ver Alumno',
                                'url'=>'Yii::app()->createUrl("jefaturaCarrera/verAlumno", array("id"=>$data->id, "curso"=>'.$model->id.'))',
                ),
            ),

        ),                 
	),
)); ?>

