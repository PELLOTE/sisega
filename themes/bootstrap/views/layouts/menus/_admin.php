<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    //'color'=>  TbHtml::NAVBAR_COLOR_INVERSE,
    'display'=>null,
    'collapse'=>true,
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbNav',

            'items'=>array(                
                               
                array('label'=>'Planificacion', 'url'=>'#', 'items'=>array(
                    array('label'=>'Calendario Academico', 'url'=>array('/administracion/calendarioDocente/administrar')),
                    array('label'=>'Planificacion Semestral', 'url'=>array('/administracion/planificacionSemestral/verPlanificaciones')),
                )),
                               
                array('label'=>'Academicos', 'url'=>'#', 'items'=>array(
                    array('label'=>'Nuevo Academico', 'url'=>array('/administracion/profesor/crear')),
                    array('label'=>'Admin Academicos', 'url'=>array('/administracion/profesor/administrar')),
                )),
                
                array('label'=>'Alumnos', 'url'=>'#', 'items'=>array(
                    array('label'=>'Nuevo Alumno', 'url'=>array('/administracion/alumno/crear')),
                    array('label'=>'Admin Alumnos', 'url'=>array('/administracion/alumno/administrar')),
                    array('label'=>'Evaluacion Semestral', 'url'=>array('/administracion/evaluacionSemestral/listarAlumnos')),
                )),
                                
                array('label'=>'Cursos', 'url'=>'#', 'items'=>array(
                        array('label'=>'Nuevo Curso', 'url'=>array('/administracion/curso/crear')),
                        array('label'=>'Admin Cursos', 'url'=>array('/administracion/curso/administrar')),
                )),
                
                array('label'=>'Asignaturas', 'url'=>'#', 'items'=>array(
                        array('label'=>'Nueva Asignatura', 'url'=>array('/administracion/asignatura/crear')),
                        array('label'=>'Admin Asignaturas', 'url'=>array('/administracion/asignatura/administrar')),
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
                    array('label'=>'Usuarios', 'url'=>array('/administracion/user/index')),
                    //array('label'=>'Roles', 'url'=>array('/rights/authItem/roles')),
                    TbHtml::menuDivider(),
                    array('label'=>'Cambiar Contraseña', 'url'=>array('/user/changePassword/', "id"=>Yii::app()->user->id)),
                )),
            ),
        ),
    ),
)); ?>
