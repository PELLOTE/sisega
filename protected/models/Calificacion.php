<?php

Yii::import('application.models._base.BaseCalificacion');

class Calificacion extends BaseCalificacion
{
        public $fecha_evaluacion;
        public $observacion_evaluacion;
        
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
  
        public static function representingColumn() {
		return 'NombreRepresentativo';
	}
                
        public function getNombreRepresentativo(){
                return Alumno::model()->findByPk($this->alumno_id)->nombre;
        }
        
        public static function calificaciones_alumno($alumno_id,$curso_id){
            
            $criteria=new CDbCriteria(array(
                'with' => array('evaluacion'),
                'select'=>'t.id, evaluacion.nombre as nombre , evaluacion.fecha as fecha_evaluacion, evaluacion.observacion as observacion_evaluacion, t.nota',
                'condition'=>'t.alumno_id = :alumno_id and evaluacion.curso_id = :curso_id',
                'order'=>'evaluacion.fecha ASC',
                'params'=> array(':alumno_id' => $alumno_id, ':curso_id'=>$curso_id, ),
             ));
            
            $dataProvider=new CActiveDataProvider('Calificacion',array('criteria'=>$criteria,));	

            return ($dataProvider);
        }
        
}