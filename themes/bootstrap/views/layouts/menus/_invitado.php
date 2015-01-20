<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    //'color'=>  TbHtml::NAVBAR_COLOR_INVERSE,
    'display'=>null,
    'collapse'=>true,
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbNav',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
                array('label'=>'Ingresar', 'url'=>array('/site/login')),
            ),
        ),
    ),
)); ?>