<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo Yii::app()->language; ?>" lang="<?php echo Yii::app()->language; ?>">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo Yii::app()->charset; ?>" />
	<meta name="language" content="<?php echo Yii::app()->language; ?>" />
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon" /> 
        <?php Yii::app()->bootstrap->register(); ?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/styles.css'); ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

</head>

<body>
  
<div class="container" id="page">
    
 <?php echo CHtml::image(Yii::app()->theme->baseUrl.'/images/imagen_uta.png'); ?>
    <?php
//Render Menu
//$rol = isset(Yii::app()->user->rol)? Yii::app()->user->rol : null; // ***Uso con cautela*** Almacenado en una cookie
$rol = !Yii::app()->user->isGuest?User::model()->findByAttributes(array('id'=>Yii::app()->user->id))->rol:null;
if($rol === null) $this->renderPartial('//layouts/menus/_invitado');
else
switch ($rol){

        case "Administrador":
                $this->renderPartial('//layouts/menus/_admin');
                break;
        case "Profesor":
                $this->renderPartial('//layouts/menus/_academico');
                break;
        case "Alumno":
                $this->renderPartial('//layouts/menus/_alumno');
                break;
        case "Jefe Carrera":
                $this->renderPartial('//layouts/menus/_jefecarrera');
                break;
        case "Coordinador Pedagogico":
                $this->renderPartial('//layouts/menus/_coordinadorpedagogico');
                break;
         case "Coordinador de Area":
                $this->renderPartial('//layouts/menus/_coordinadorarea');
                break;
        default:
                $this->renderPartial('//layouts/menus/_usuario');                
}
?>
        
        <?php $this->widget('bootstrap.widgets.TbBreadcrumb', array(
                'links'=>$this->breadcrumbs,
        )); ?>
           <?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
       
    )); ?>

	<?php echo $content; ?>

	<div class="clear"></div>
        
        <hr>

	<div id="footer">
                Copyright &copy; <?php echo date('Y'); ?> por <?php echo Yii::app()->params['empresa'] ?><br/>
		Todos los derechos reservados.<br/>
		Desarrollado por <a href="http://www.raboit.com/" rel="external">Rabo IT</a>.
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
