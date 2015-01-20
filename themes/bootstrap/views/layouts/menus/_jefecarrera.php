<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    //'color'=>  TbHtml::NAVBAR_COLOR_INVERSE,
    'display'=>null,
    'collapse'=>true,
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbNav',
            'items'=>array(
                //array('label'=>'Inicio', 'url'=>array('/site/index')),
                  
                array('label'=>'Gestionar Curso', 'url'=>'#', 'items'=>array(
                    array('label'=>'Crear Curso', 'url'=>array('/jefaturaCarrera/crearCurso')),
                    array('label'=>'Administrar Cursos', 'url'=>array('/jefaturaCarrera/verCursos')),
                )),                    
                    
                array('label'=>'Gestionar Asignaturas', 'url'=>'#', 'items'=>array(
                    array('label'=>'Crear Asignatura', 'url'=>array('/jefaturaCarrera/crearAsignatura')),
                    array('label'=>'Administrar Asignaturas', 'url'=>array('/jefaturaCarrera/verAsignaturas')),
                )),
                
                array('label'=>'Alumnos', 'url'=>'#', 'items'=>array(
                    array('label'=>'Ver Alumnos', 'url'=>array('/jefaturaCarrera/verAlumnos')),
                )),
                array('label'=>'Planificacion Semestral', 'url'=>'#', 'items'=>array(
                    array('label'=>'Evaluar Planificacion ', 'url'=>array('/evaluacionPlanificacion/verPlanificacionPropuesta')),
                )),
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