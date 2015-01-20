<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error '.$code;
$this->breadcrumbs=array(
	'Atención!',
);
?>
<div class="container-fluid">
    <center>
        <?php echo CHtml::image(Yii::app()->theme->baseUrl.'/images/imagen_uta.png'); ?>
        <?php echo TbHtml::quote($message); ?>   
        <?php echo TbHtml::button(Yii::t('app','Back'), array('onclick'=>'javascript:history.back()', 'color'=>  TbHtml::BUTTON_COLOR_PRIMARY)); ?>
    </center>
        
        
</div>