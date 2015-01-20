<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	//$this->module->id,
        Yii::t('app', $this->module->id)
);
?>
<?php $this->widget('bootstrap.widgets.TbHeroUnit', array(
    'heading' => 'Módulo Administración',
    'content' => '<br>'.
    TbHtml::em('Este módulo no posee lógica de negocio.', array('color' => TbHtml::TEXT_COLOR_ERROR)).
    TbHtml::em('Cualquier dato elimando puede provocar acciones en cadena, por lo tanto use con precaución.', array('color' => TbHtml::TEXT_COLOR_DEFAULT)),
)); ?>