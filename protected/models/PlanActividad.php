<?php

Yii::import('application.models._base.BasePlanActividad');

class PlanActividad extends BasePlanActividad
{
        public $repColumnsSeparator = ' - ';
    
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
	public static function representingColumn() {
                return 'actividad';
	}        
        
        public function rules(){
            return array_merge(parent::rules(), array(
                        array('fecha_inicio, fecha_termino, actividad', 'required'),
                    ));
        }
        
        public static function plan_actividad_curso($curso_id){
            $criteria=new CDbCriteria(array(
            'condition'=>'curso_id = :curso_id',
            'order'=>'fecha_inicio ASC',
            'limit'=>500,
            'params'=> array(':curso_id' => $curso_id)));
            $dataProvider=new CActiveDataProvider('PlanActividad',array('criteria'=>$criteria));	

            return ($dataProvider);
            
        }
}