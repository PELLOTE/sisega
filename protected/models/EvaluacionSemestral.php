<?php

Yii::import('application.models._base.BaseEvaluacionSemestral');

class EvaluacionSemestral extends BaseEvaluacionSemestral
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'alumno_id' => null,
			'semestre' => Yii::t('app', 'Semestre'),
			'anio' => Yii::t('app', 'Anio'),
			'estado' => Yii::t('app', 'Aprobado'),
			'observacion' => Yii::t('app', 'Observacion'),
			'oportunidad' => Yii::t('app', 'Oportunidad'),
			'semestre_cursado' => Yii::t('app', 'Semestre Cursado'),
			'promedio' => Yii::t('app', 'Promedio'),
			'alumno' => null,
		);
	}
        
        public static function estadoEvaluacion($semestre_cursado,$alumno, $url){
            $evaluaciones = EvaluacionSemestral::model()->findAllByAttributes(array(), 't.semestre_cursado=:semestre_cursado AND t.alumno_id=:alumno', array(':semestre_cursado'=>$semestre_cursado, ':alumno'=>$alumno));
            $bandera_aprobado = true;
            
            if(!empty($evaluaciones)){
                foreach ($evaluaciones as $evaluacion) {
                    if($evaluacion->estado){
                        $bandera_aprobado=false;
                       
                        echo TbHtml::labelTb("APROBADO ".$evaluacion->anio, array('color' => TbHtml::LABEL_COLOR_SUCCESS));
                    }else
                        echo TbHtml::labelTb("REPROBADO ".$evaluacion->anio, array('color' => TbHtml::LABEL_COLOR_IMPORTANT)).'<br>';
                }
            }

            if($bandera_aprobado)
                    echo TbHtml::link(TbHtml::labelTb('EVALUAR', array('color' => TbHtml::LABEL_COLOR_INFO)), $url);
                    
        }
        
        
        
        public function beforeSave(){
                if($this->promedio<4)
                    $this->estado=0;
                else
                    $this->estado=1;
                 return true;

        }
}