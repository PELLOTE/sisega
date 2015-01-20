<?php
$this->breadcrumbs = array(
        Yii::t('app', $this->module->id) => Yii::app()->createUrl($this->module->baseUrl), 
	'Malla curricular',
);
?>

<?php echo TbHtml::pageHeader(Yii::t('app', 'Malla Curricular'), null); ?>

<?php //print_r($asignaturas);?>
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
    <tbody>
    <?php for($i = 1; $i <7; $i++ ): ?>
    <tr class="celda">
        <?php for($j=1; $j<=12; $j++):
        $pos =  $j . $i;
        if(array_key_exists($pos, $asignaturas)):?>
        <td  class="<?php echo Alumno::estado($asignaturas[$pos]->id,'estado', $alumno_id); ?>">
            <a rel="tooltip" data-original-title="<?php echo GxHtml::encodeEx($asignaturas[$pos]->nombre); ?>">
                <?php echo Yii::app()->utilidad->acortarTexto($asignaturas[$pos]->nombre, 9); ?><br>
                <?php echo (Alumno::estado($asignaturas[$pos]->id,'promedio',  $alumno_id)=="NULO")? "--" : Alumno::estado($asignaturas[$pos]->id,'promedio',  $alumno_id); ?><br>
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
    'header' => 'MODAL',
    'content' => '<div id="contenido"></div>',
    'footer' => array(
        TbHtml::button('OK', array('data-dismiss' => 'modal', 'color' => TbHtml::BUTTON_COLOR_PRIMARY)),
     ),
)); ?>