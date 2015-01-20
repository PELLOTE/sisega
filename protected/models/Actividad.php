<?php

Yii::import('application.models._base.BaseActividad');

class Actividad extends BaseActividad
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function misActividades($planificacion_semestral_id){
            $criteria=new CDbCriteria(array(
            'condition'=>'planificacion_semestral_id = :planificacion_semestral_id',
            'order'=>'id ASC',
            'params'=> array(':planificacion_semestral_id' => $planificacion_semestral_id),
                    ));
            $dataProvider=new CActiveDataProvider('Actividad',array('criteria'=>$criteria,));	

            return ($dataProvider);
        }
        
        
}