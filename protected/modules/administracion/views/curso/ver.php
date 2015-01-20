<?php
$this->widget('bootstrap.widgets.TbAlert');
$this->breadcrumbs = array(
        Yii::t('app', $this->module->id) => Yii::app()->createUrl($this->module->baseUrl),  
	$model->label(2) => array('administrar'),
	GxHtml::valueEx($model),
);

$this->menu=array(
        array('label'=>Yii::t('app', 'Operations')),
        array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('crear'), 'icon'=>'file'),
        array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('actualizar', 'id' => $model->id), 'icon'=>'pencil'),
        //array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('borrar', 'id' => $model->id), 'confirm'=>Yii::t('app', 'Are you sure you want to delete this item?')), 'icon'=>'trash'),
        array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('administrar'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Activar') . ' ' . $model->label(), 'url'=>array('activarCurso', 'id' => $model->id), 'icon'=>'thumbs-up'),
        array('label'=>Yii::t('app', 'Terminar') . ' ' . $model->label(), 'url'=>array('terminarCurso', 'id' => $model->id), 'icon'=>'thumbs-down'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)), TbHtml::labelTb('Admin')); ?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		'id',
		array(
			'name' => 'asignatura',
			'type' => 'raw',
			'value' => $model->asignatura !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->asignatura)), array('asignatura/ver', 'id' => GxActiveRecord::extractPkValue($model->asignatura, true))) : null,
			),
		array(
			'name' => 'profesor',
			'type' => 'raw',
			'value' => $model->profesor !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->profesor)), array('profesor/ver', 'id' => GxActiveRecord::extractPkValue($model->profesor, true))) : null,
			),
		'semestre',
		'anio',
		//'nombre',
		array(
                    'name'=>'estado',
                    'value'=>$model->getEtiquetaEstado(),
                    'type'=>'raw',
                ), 

	),
)); ?>

<?php $this->widget('bootstrap.widgets.TbTabs', array(
    'tabs' => array(
        array('label' => 'Alumnos', 'content' => $this->renderPartial('alumnos/administrar', array('model' => new CArrayDataProvider($model->alumnos,array()),'buttons' => 'create'),true,false), 'active' => true),
        array('label' => 'Evaluaciones', 'content' => $this->renderPartial('evaluaciones/administrar', array('model' => new CArrayDataProvider($model->evaluacions,array()),'buttons' => 'create'),true,false)),
        array('label' => 'Plan de Actividades', 'content' => $this->renderPartial('planactividades/administrar', array('model' => new CArrayDataProvider($model->planActividads,array()),'buttons' => 'create'),true,false)),
    ),
)); ?>
