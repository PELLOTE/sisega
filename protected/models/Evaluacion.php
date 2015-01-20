<?php

Yii::import('application.models._base.BaseEvaluacion');

class Evaluacion extends BaseEvaluacion
{
	public $repColumnsSeparator = ' - ';

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public static function representingColumn() {
		return array('nombre');
	}
         
        
        
        public function rules() {
            return array_merge(parent::rules(), array(
                        array('fecha, nombre', 'required'),
                    ));
        }
        
        public static function evaluacion_curso($curso_id){
            $criteria=new CDbCriteria(array(
            'condition'=>'curso_id = :curso_id',
            'order'=>'id DESC',
            'limit'=>500,
            'params'=> array(':curso_id' => $curso_id),
                    ));
            $dataProvider=new CActiveDataProvider('Evaluacion',array('criteria'=>$criteria,));	

            return ($dataProvider);
        }
}