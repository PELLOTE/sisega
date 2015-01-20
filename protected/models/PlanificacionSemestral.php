<?php

Yii::import('application.models._base.BasePlanificacionSemestral');

class PlanificacionSemestral extends BasePlanificacionSemestral
{
        public $repColumnsSeparator = ' - ';
    
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
	public static function representingColumn() {
		return array('fecha_inicio', 'fecha_termino');
	}
        
        public static function obtenerRangoFecha(){
            $criteria= new CDbCriteria();
            $criteria->condition="estado='VIGENTE'";
            $criteria->limit=2;
            $criteria->order="id DESC";
            $model_planificacion_semestral = PlanificacionSemestral::model()->findByAttributes(array(),$criteria);
            
            return array($model_planificacion_semestral->fecha_inicio,$model_planificacion_semestral->fecha_termino,$model_planificacion_semestral->id);    
        }
        
        public static function cargarPlanificacion(){
            $criteria= new CDbCriteria();
            $criteria->limit=1;
            $criteria->order="id DESC";
            $model_planificacion_semestral = PlanificacionSemestral::model()->findByAttributes(
                                            array('estado'=> 'PROPUESTA'),
                                            $criteria
                                        );
          if(isset($model_planificacion_semestral))
          {
             return $model_planificacion_semestral;    
              
          }else{
             return false;  
          }
            
            
        }
        
        /**
         * Agrega al criteria del modelo que la planificacion semestral sea vigente
         * @return PlanificacionSemestral
         */
        public function vigente($anio=2013,$semestre=1){
            $criteria= new CDbCriteria();
            $criteria->with=array('calendarioDocente');
            $criteria->together=true;
            $criteria->compare('anio',$anio);            
            $criteria->compare('t.estado', 'VIGENTE');

            $criteria->compare('semestre',$semestre);
            $criteria->order="t.id DESC";
            $this->getDbCriteria()->mergeWith($criteria);
            return $this;
        }
        
        /**
         * Retorna un unico modelo con la planificacion semestral vigente
         * @return PlanificacionSemestral
         */
        public static function obtenerVigente(){
            //$model = NULL;
            $criteria= new CDbCriteria();
            $criteria->compare('estado', 'VIGENTE');
            $criteria->order="id DESC";
            $model = PlanificacionSemestral::model()->find($criteria);
            return $model;
        }
        /**
         * Función que hereda las actividades relacionadas al calendario docente
         * @return boolean
         */
        public function generarActividades() {
           $model_calendario = CalendarioDocente::model()->findByPk($this->calendario_docente_id);
           
           if(isset($model_calendario)):
               foreach ($model_calendario->actividadUtas as $actividad ):
                    if($actividad->semestre==$this->semestre){
                        $actividad_planificacion = new Actividad;
                        $actividad_planificacion->planificacion_semestral_id=$this->id;
                        $actividad_planificacion->fecha_inicio=$actividad->fecha_inicio;
                        $actividad_planificacion->fecha_termino=$actividad->fecha_termino;
                        $actividad_planificacion->detalle=$actividad->detalle;
                        $actividad_planificacion->save(true);
                    }
               endforeach;
           endif;
        }
        
         /**
         * Función que busca todas las planificaciones con el estado VIGENTE, PROPUESTA
         * @return boolean
         */
        
        public static function obtenerValidarPlanificacion($semestre){
            $criteria= new CDbCriteria();
            //$criteria->limit=1;
            $criteria->order="id DESC";
            

           if($model_planificacion = PlanificacionSemestral::model()->findByAttributes(
                                    array('estado'=> 'PROPUESTA','estado'=> 'VIGENTE'),
                                    array('condition'=>'semestre=:semestre', 
                                     'params'=>array(':semestre'=>$semestre)
                                    ),$criteria))
           {
             return false;       
           }else{
             return true;  
           } 
            
        }
        
        public function scopes(){
            return array(
                'vigentes'=>array(
                    'condition'=>"estado='VIGENTE'",
                ),
            );
            
        }
        
        /**
         * Funcion para filtrar la busqueda por semestre
         * @param type $semestre
         * @return \PlanificacionSemestral
         * 
         */
        public function semestre($semestre)
        {
            $this->getDbCriteria()->mergeWith(array(
                'condition'=>"semestre=:semestre",
                'params'=>array(':semestre'=>$semestre),
            ));
            return $this;
        }
        
        public function getEtiquetaEstado(){

        if($this->estado=="VIGENTE")
            return TbHtml::labelTb($this->estado, array("color" => TbHtml::LABEL_COLOR_SUCCESS));
        elseif($this->estado=="NUEVO")
            return TbHtml::labelTb($this->estado, array("color" => TbHtml::LABEL_COLOR_INFO));
        elseif($this->estado=="PROPUESTA")
            return TbHtml::labelTb($this->estado, array("color" => TbHtml::LABEL_COLOR_WARNING));
        elseif($this->estado=="RECHAZADA")
            return TbHtml::labelTb($this->estado, array("color" => TbHtml::LABEL_COLOR_IMPORTANT));
        elseif($this->estado=="FINALIZADO")
            return TbHtml::labelTb($this->estado, array("color" => TbHtml::LABEL_COLOR_INFO));
        else
            return TbHtml::labelTb($this->estado, array("color" => TbHtml::LABEL_COLOR_IMPORTANT));

        }

}
