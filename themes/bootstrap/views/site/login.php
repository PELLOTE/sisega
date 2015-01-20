<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - '.Yii::t('app', 'Login');
$this->breadcrumbs=array(
        Yii::t('app', 'Login'),
);
?>

<h1><?php echo Yii::t('app', 'Login'); ?></h1>

<p><?php echo Yii::t('app', 'Please fill out the following form with your login credentials:'); ?></p>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note"><?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.</p>

	<?php echo $form->textFieldControlGroup($model,'username'); ?>

	<?php echo $form->passwordFieldControlGroup($model,'password'); ?>

	<?php echo $form->checkBoxControlGroup($model,'rememberMe'); ?>

        <?php echo TbHtml::formActions(array(
            TbHtml::submitButton(Yii::t('app', 'Login'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'id'=>'buttonStateful', 'data-loading-text'=>  Yii::t('app', 'Loading...'))),
            TbHtml::resetButton(Yii::t('app', 'Reset')),
        )); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->
