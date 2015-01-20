<h2><?php // echo GxHtml::encode($model->getRelationLabel('alumnos')); ?></h2>
<?php
//	echo GxHtml::openTag('ul');
//	foreach($model->alumnos as $relatedModel) {
//		echo GxHtml::openTag('li');
//		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('academico/verAlumno', 'id' => GxActiveRecord::extractPkValue($relatedModel, true), 'curso_id' => $model->id));
//		echo GxHtml::closeTag('li');
//	}
//	echo GxHtml::closeTag('ul');
?>
<?php $labelAlumno = Alumno::model()->attributeLabels(); ?>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'alumno-grid',
	'dataProvider' => new CArrayDataProvider($model->alumnos),
        'type'=>'striped bordered condensed',
        'template'=>"{items}{pager}{summary}",
	'columns' => array(
		//'id',
		array(
                        'name'=> $labelAlumno['run'],
                        'value'=>'$data->run',
                ),
		array(
                        'name'=> $labelAlumno['nombre'],
                        'value'=>'$data->nombre',
                ),
        array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template'=>'{view}',
                'viewButtonUrl'=>'Yii::app()->controller->createUrl("verAlumno", array("id"=>$data->id, "curso_id"=>'.$model->id.'))',
          ),                
	),
)); ?>