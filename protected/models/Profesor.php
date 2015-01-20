<?php

Yii::import('application.models._base.BaseProfesor');

class Profesor extends BaseProfesor
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function rules() {
            return array_merge(parent::rules(), array(
                        array('nombre, run', 'required'),
                        array('email','email'),
                        array('run','unique','message'=>Yii::t('app','El {attribute} ya se encuentra registrado en el sistema')),
                    ));
        }
}