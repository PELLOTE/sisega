<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
//$this->breadcrumbs=array(
//        Yii::t('app', 'Index'),
//);
?>

<?php $this->widget('bootstrap.widgets.TbHeroUnit', array(
    'heading' => 'Bienvenido a '.CHtml::encode(Yii::app()->name),
    'content' => '<p>Sistema de seguimiento de alumnos</p>',
)); ?>