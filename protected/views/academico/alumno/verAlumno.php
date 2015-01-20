<script>
  function ingresarPromedio()
    {
        <?php echo CHtml::ajax(array(
                'url'=>Yii::app()->createUrl("academico/ingresarPromedio",array('alumno_id'=>$model->id,'curso_id'=>$model_curso->id)),
                'data'=> "js:$(this).serialize()",
                'type'=>'post',
                'dataType'=>'json',
                'success'=>"function(data)
                {
                    if (data.status == 'failure')
                    {
                        $('#promedio_div').html(data.div);
                        $('#promedio_div').show();
                        $('#promedio_div form').submit(ingresarPromedio);
                    }
                    else
                    {
                        $('#promedio_div').html(data.mensaje);
                       
                        setTimeout(\"$('#myModal').modal('hide');\",500);

                     }              
                }",
                ))
        ?>;
        return false;  
    }


</script>

<?php

$this->breadcrumbs = array(
       Yii::app()->user->profesor => Yii::app()->createUrl('academico/panel'),
       GxHtml::encode(Curso::label(2))=> Yii::app()->createUrl('academico/misCursos'),
       GxHtml::valueEx($model_curso)=>Yii::app()->createUrl('academico/verCurso', array('id'=>$model_curso->id)),
       GxHtml::valueEx($model),
);

$this->menu=array(
//        array('label'=>Yii::t('app', 'Operations')),
//        array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('listar'), 'icon'=>'list'),
//        array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('crear'), 'icon'=>'file'),
//        array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('actualizar', 'id' => $model->id), 'icon'=>'pencil'),
//        array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('borrar', 'id' => $model->id), 'confirm'=>Yii::t('app', 'Are you sure you want to delete this item?')), 'icon'=>'trash'),
//        array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('administrar'), 'icon'=>'list-alt'),
        array('label'=>Yii::t('app', 'Other|Others', 2)),
        array('label'=>Yii::t('app', 'Back'), 'url'=>'javascript:history.back()', 'icon'=>'arrow-left'),
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)), null); ?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		'id',
		'nombre',
		'run',
		'direccion',
    array(
      'name' => 'promedio',
      'type' => 'raw',
      'value' => Alumno::estado($model_curso->asignatura_id,'promedio',$model->id),
      ),
//		array(
//			'name' => 'user',
//			'type' => 'raw',
//			'value' => $model->user !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->user)), array('user/ver', 'id' => GxActiveRecord::extractPkValue($model->user, true))) : null,
//			),
	),
)); ?>
<?php
echo TbHtml::linkButton('Ingresar Promedio', array(
                  'icon'=>'ok white',
                  'color' => TbHtml::BUTTON_COLOR_SUCCESS,
                  'onclick'=>'js:ingresarPromedio()',
                  'data-toggle' => 'modal',
                  'data-target' => '#myModal',
                  ))." ";
?>
<h2><?php echo GxHtml::encode($model->getRelationLabel('calificacions')); ?></h2>
<?php $labelCalificacion = Calificacion::model()->attributeLabels(); ?>
<?php // $labelEvaluacion = Evaluacion::model()->attributeLabels(); ?>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'calificacion-grid',
	'dataProvider' => new CArrayDataProvider($model->calificacions),
        'type'=>'striped bordered condensed',
        'template'=>"{items}{pager}{summary}",
	'columns' => array(
		//'id',
		array(
                        'name'=> $model->getRelationLabel('evaluacion'),
                        'value'=>'$data->evaluacion->nombre',
                ),
		array(
                        'name'=> $labelCalificacion['nota'],
                        'value'=>'$data->nota',
                ),
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
               'viewButtonUrl'=>'Yii::app()->controller->createUrl("verCalificacion", array("id"=>$data->id))',
                'updateButtonUrl'=>'Yii::app()->controller->createUrl("editarCalificacion", array("id"=>$data->id))',
                'deleteButtonUrl'=>'Yii::app()->controller->createUrl("borrarCalificacion", array("id"=>$data->id))',
//                'deleteConfirmation'=>Yii::t('app','¿Seguro que desea borrar este elemento?, esto provocará que se eliminen todas las calificaciones asociadas.'),
          ),                
	),
)); ?>

<?php $this->widget('bootstrap.widgets.TbModal', array(
    'id' => 'myModal',
    'header' => 'ingresar Promedio',
    'content' => '<p><div id="promedio_div" ></div></p>',
    
)); ?>