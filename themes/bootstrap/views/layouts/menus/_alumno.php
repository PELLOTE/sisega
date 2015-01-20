<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    //'color'=>  TbHtml::NAVBAR_COLOR_INVERSE,
    'display'=>null,
    'collapse'=>true,
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbNav',
            'items'=>array(
                array('label'=>'Mis Cursos', 'url'=>array('/alumno/misCursos')),
                array('label'=>'Malla', 'url'=>array('/alumno/malla')),
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