<?php

Yii::import('application.models._base.BaseActividadUta');

class ActividadUta extends BaseActividadUta
{
        public $fecha_inicio_1;
        public $fecha_termino_1;
        public $fecha_inicio_2;
        public $fecha_termino_2;
        
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
        
        public function attributeLabels() {
		return array(
			'fecha_inicio_1' => Yii::t('app', 'Fecha Inicio'),
			'fecha_termino_1' => Yii::t('app', 'Fecha Termino'),
			'fecha_inicio_2' => Yii::t('app', 'Fecha Inicio'),
			'fecha_termino_2' => Yii::t('app', 'Fecha Termino'),
		);
	}
}