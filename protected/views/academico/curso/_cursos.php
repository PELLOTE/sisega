<div class="span3">
        <a class="buttonwell" href="<?php echo Yii::app()->controller->createUrl('academico/verCurso', array('id' => $data->id));?>">
                <div class="view well cuadro">
                        <span>
<?php $asignatura = GxHtml::encode(GxHtml::valueEx($data->asignatura));
        if(strlen($asignatura)<25):?>
                        <h2><?php echo GxHtml::encode(GxHtml::valueEx($data->asignatura)); ?></h2>
<?php elseif(strlen($asignatura)<32): ?>
                        <h3><?php echo GxHtml::encode(GxHtml::valueEx($data->asignatura)); ?></h3>
<?php else: ?>
                        <h4><?php echo GxHtml::encode(GxHtml::valueEx($data->asignatura)); ?></h4>
<?php endif; ?>
                        <h5><?php echo GxHtml::encode($data->getAttributeLabel('semestre')); ?>
                        <?php echo GxHtml::encode($data->semestre); ?> - 
                        <?php echo GxHtml::encode($data->getAttributeLabel('anio')); ?>
                        <?php echo GxHtml::encode($data->anio); ?></h5>
                        </span>
                </div>
        </a>
</div>