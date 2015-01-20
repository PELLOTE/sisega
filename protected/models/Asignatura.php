<?php

Yii::import('application.models._base.BaseAsignatura');

class Asignatura extends BaseAsignatura
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        public function rules() {
            return array_merge(parent::rules(), array(
                        array('nombre, semestre, programa, codigo, numero, catedra, taller, laboratorio, tipo_formacion', 'required'),
                        array('nombre','unique'),
                        array('semestre','in','range'=>range(1,2),'message'=>'El semestre solo puede tomar valores 1 o 2.'),
                    ));
        }
}