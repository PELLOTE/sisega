<?php
$this->breadcrumbs = array(
        Yii::app()->user->profesor => Yii::app()->createUrl('academico/panel'),
	Curso::label(2),
);
?>
<script type="text/javascript">
function cargar_datos(url){

    <?php echo CHtml::ajax(array(
            'url'=>'js:url',
            'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'fallido')
                {
                    $('#contenido').html(data.div);
                    $('#contenido form').submit(function(event){ cargar_datos(url); return false;});
                }
                return false;
            }",
            ))?>
    return false; 
 
} 

function ingresar_eval(url){
    alert(url);
    return false;
}
</script>
<?php echo TbHtml::pageHeader(Yii::t('app', 'Malla Curricular'), null); ?>

<table class="table table-bordered malla">
    <thead>
            <th>I</th>
            <th>II</th>
            <th>III</th>
            <th>VI</th>
            <th>V</th>
            <th>VI</th>
            <th>VII</th>
            <th>VIII</th>
            <th>IX</th>
            <th>X</th>
            <th>XI</th>
            <th>XII</th>            
    </thead>
     <tfoot>
    <tr>
      <td> <?php EvaluacionSemestral::estadoEvaluacion(1,$alumno_id,Yii::app()->controller->createUrl("evaluacionSemestral/evaluar", array('id'=>$alumno_id,'semestre_cursado'=>1)));?></a></td>
      <td> <?php EvaluacionSemestral::estadoEvaluacion(2,$alumno_id,Yii::app()->controller->createUrl("evaluacionSemestral/evaluar", array('id'=>$alumno_id,'semestre_cursado'=>2)));?></a></td>
      <td> <?php EvaluacionSemestral::estadoEvaluacion(3,$alumno_id,Yii::app()->controller->createUrl("evaluacionSemestral/evaluar", array('id'=>$alumno_id,'semestre_cursado'=>3)));?></a></td>
      <td> <?php EvaluacionSemestral::estadoEvaluacion(4,$alumno_id,Yii::app()->controller->createUrl("evaluacionSemestral/evaluar", array('id'=>$alumno_id,'semestre_cursado'=>4)));?></a></td>
      <td> <?php EvaluacionSemestral::estadoEvaluacion(5,$alumno_id,Yii::app()->controller->createUrl("evaluacionSemestral/evaluar", array('id'=>$alumno_id,'semestre_cursado'=>5)));?></a></td>
      <td> <?php EvaluacionSemestral::estadoEvaluacion(6,$alumno_id,Yii::app()->controller->createUrl("evaluacionSemestral/evaluar", array('id'=>$alumno_id,'semestre_cursado'=>6)));?></a></td>
      <td> <?php EvaluacionSemestral::estadoEvaluacion(7,$alumno_id,Yii::app()->controller->createUrl("evaluacionSemestral/evaluar", array('id'=>$alumno_id,'semestre_cursado'=>7)));?></a></td>
      <td> <?php EvaluacionSemestral::estadoEvaluacion(8,$alumno_id,Yii::app()->controller->createUrl("evaluacionSemestral/evaluar", array('id'=>$alumno_id,'semestre_cursado'=>8)));?></a></td>
      <td> <?php EvaluacionSemestral::estadoEvaluacion(9,$alumno_id,Yii::app()->controller->createUrl("evaluacionSemestral/evaluar", array('id'=>$alumno_id,'semestre_cursado'=>9)));?></a></td>
      <td> <?php EvaluacionSemestral::estadoEvaluacion(10,$alumno_id,Yii::app()->controller->createUrl("evaluacionSemestral/evaluar", array('id'=>$alumno_id,'semestre_cursado'=>10)));?></a></td>
      <td> <?php EvaluacionSemestral::estadoEvaluacion(11,$alumno_id,Yii::app()->controller->createUrl("evaluacionSemestral/evaluar", array('id'=>$alumno_id,'semestre_cursado'=>11)));?></a></td>
      <td> <?php EvaluacionSemestral::estadoEvaluacion(12,$alumno_id,Yii::app()->controller->createUrl("evaluacionSemestral/evaluar", array('id'=>$alumno_id,'semestre_cursado'=>12)));?></a></td>
      
      
      
      
    </tr>
  </tfoot>
    <tbody>
    <?php for($i = 1; $i <7; $i++ ): ?>
    <tr class="celda">
        <?php for($j=1; $j<=12; $j++):
        $pos =  $j . $i;
        if(array_key_exists($pos, $asignaturas)):?>
        <td class="<?php echo Alumno::estado($asignaturas[$pos]->id,'estado',$alumno_id); ?>">
            <a rel="tooltip" data-original-title="<?php echo GxHtml::encodeEx($asignaturas[$pos]->nombre); ?>">
                <?php echo Yii::app()->utilidad->acortarTexto($asignaturas[$pos]->nombre, 9); ?><br>
                <?php echo (Alumno::estado($asignaturas[$pos]->id,'promedio')=="NULO")? "--" : Alumno::estado($asignaturas[$pos]->id,'promedio'); ?><br>
                <?php echo "({$asignaturas[$pos]->catedra},{$asignaturas[$pos]->taller},{$asignaturas[$pos]->laboratorio})"; ?>
            </a>
        </td>
            <?php else: ?>
                <td></td>
            <?php endif; ?>        
        <?php endfor; ?>
        
    </tr>
    </tbody>
<?php endfor; ?>  
</table>
<br>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/scroll.js'); ?>

<?php $this->widget('bootstrap.widgets.TbModal', array(
    'id' => 'modal',
    'header' => 'EVALUACION SEMESTRAL',
    'content' => '<div id="contenido"></div>',
    
)); ?>