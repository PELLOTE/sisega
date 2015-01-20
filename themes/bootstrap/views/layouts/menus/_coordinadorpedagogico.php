<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    //'color'=>  TbHtml::NAVBAR_COLOR_INVERSE,
    'display'=>null,
    'collapse'=>true,
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbNav',
            'items'=>array(
                //array('label'=>'Inicio', 'url'=>array('/site/index')),
                    
                array('label'=>'Gestionar Planificaciones', 'url'=>array('planificacion/verPlanificaciones')),
                array('label'=>'Gestionar Actividades', 'url'=>array('planificacion/verActividades')),
                //array('label'=>'Curso', 'url'=>array('/curso/index')),
                //array('label'=>'Asignatura', 'url'=>array('/asignatura/index')),
                //array('label'=>'Calendario Docente', 'url'=>array('/calendarioDocente/index')),
                //array('label'=>'Calificación', 'url'=>array('/calificacion/index')),
                    
                //array('label'=>'Evaluaciones', 'url'=>'#', 'items'=>array(
                  //  array('label'=>'Evaluación', 'url'=>array('/evaluacion/index')),
                   // array('label'=>'Evaluación Semestral', 'url'=>array('/evaluacionSemestral/index')),
                //)),                    
                    
                //array('label'=>'Planes', 'url'=>'#', 'items'=>array(
                  //  array('label'=>'Plan Actividad', 'url'=>array('/planActividad/index')),
                  //  array('label'=>'Planinifcación Semestral', 'url'=>array('/planificacionSemestral/index')),
                //)),
                    
            ),
        ),
        array(
            'class'=>'bootstrap.widgets.TbNav',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
                array('label'=> Yii::app()->user->name, 'items'=>array(
                    array('label'=>'Salir', 'url'=>array('/site/logout')),
                    TbHtml::menuDivider(),
                    array('label'=>'Cambiar Contraseña', 'url'=>array('/user/changePassword/', "id"=>Yii::app()->user->id)),
                )),
            ),
        ),
    ),
)); ?>