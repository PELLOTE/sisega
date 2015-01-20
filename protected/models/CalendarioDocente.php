<?php

Yii::import('application.models._base.BaseCalendarioDocente');

class CalendarioDocente extends BaseCalendarioDocente
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
   
	public static function label($n = 1) {
		return Yii::t('app', 'Calendario Academico|Calendarios Academicos', $n);
	}
        
	public static function representingColumn() {
		return 'anio';
	}
        
         public static function obtenerRangoFechas(){
            $criteria= new CDbCriteria();
            $criteria->limit=1;
            $criteria->order="id DESC";

           if($model_calendario_docente = CalendarioDocente::model()->findByAttributes(
                                            array('estado'=> 'VIGENTE'),
                                            $criteria
                                        ))
           {
            return array($model_calendario_docente->inicio_primer_semestre,$model_calendario_docente->termino_segundo_semestre,$model_calendario_docente->id);       
               
           }else{
             return false;  
           }     
        }
        
        public static function obtenerRangoSemestre($semestre=1){
            $criteria= new CDbCriteria();
            $criteria->limit=1;
            $criteria->order="id DESC";

           if($model_calendario_docente = CalendarioDocente::model()->findByAttributes(
                                            array('estado'=> 'VIGENTE'),
                                            $criteria
                                        ))
           {
               if($semestre==1)
                   return array($model_calendario_docente->inicio_primer_semestre,$model_calendario_docente->termino_primer_semestre);       
               else
                   return array($model_calendario_docente->inicio_segundo_semestre,$model_calendario_docente->termino_segundo_semestre);       
           }else{
             return false;  
           }     
        }
        
        public static function obtenerValidarCalendario(){
            $criteria= new CDbCriteria();
            //$criteria->limit=1;
            $criteria->order="id DESC";

           if($model_calendario_docente = CalendarioDocente::model()->findByAttributes(
                                            array('estado'=> 'VIGENTE'),
                                            $criteria
                                        ))
           {
             return false;       
           }else{
             return true;  
           } 
            
        }
        
        public function getEtiquetaEstado(){

        if($this->estado=="VIGENTE")
            return TbHtml::labelTb($this->estado, array("color" => TbHtml::LABEL_COLOR_SUCCESS));
        elseif($this->estado=="NUEVO")
            return TbHtml::labelTb($this->estado, array("color" => TbHtml::LABEL_COLOR_INFO));
        else
            return TbHtml::labelTb($this->estado, array("color" => TbHtml::LABEL_COLOR_IMPORTANT));
        }
}