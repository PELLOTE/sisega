<?php

$this->breadcrumbs = array(
        Yii::t('app', $this->module->id) => Yii::app()->createUrl($this->module->baseUrl),  
	$model->label(2) => array('administrar'),
	GxHtml::valueEx($model),
);

$this->menu=array(
        array('label'=>Yii::t('app', 'Operations')),
        array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('actualizar', 'id' => GxActiveRecord::extractPkValue($model, true)), 'icon'=>'pencil'),
        //array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('borrar', 'id' => $model->id), 'confirm'=>Yii::t('app', 'Are you sure you want to delete this item?')), 'icon'=>'trash'),
        array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('administrar'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Operaciones Extendidas')),    
        array('label'=>Yii::t('app', 'Matricular Alumno'), 'url'=>array('actualizarConCurso', 'id' => $model->id), 'icon'=>'edit'),
        array('label'=>Yii::t('app', 'Ver Avance Curricular'), 'url'=>array('verAvanceCurricular', 'id' => $model->id), 'icon'=>'th-list'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)), TbHtml::labelTb('Admin')); ?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		'id',
		'nombre',
		'run',
		'direccion',
                'email',
                'anio_ingreso',
		array(
			'name' => 'user',
			'type' => 'raw',
			'value' => $model->user !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->user)), array('user/view', 'id' => GxActiveRecord::extractPkValue($model->user, true))) : null,
			),
	),
)); ?>


<?php $this->widget('bootstrap.widgets.TbTabs', array(
    'tabs' => array(
        array('label' => 'Cursos', 'content' => $this->renderPartial('cursos/administrar', array('model' => new CArrayDataProvider($model->cursos,array()),'buttons' => 'create'),true,false), 'active' => true),
        array('label' => 'Evaluaciones Semestrales', 'content' => $this->renderPartial('evaluacionessemestral/administrar', array('model' => new CArrayDataProvider($model->evaluacionSemestrals,array()),'buttons' => 'create'),true,false)),
        
    ),
)); ?>
