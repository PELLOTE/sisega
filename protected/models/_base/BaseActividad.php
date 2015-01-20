<?php

/**
 * This is the model base class for the table "actividad".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Actividad".
 *
 * Columns in table "actividad" available as properties of the model,
 * followed by relations of table "actividad" available as properties of the model.
 *
 * @property integer $id
 * @property integer $planificacion_semestral_id
 * @property string $fecha_inicio
 * @property string $fecha_termino
 * @property string $detalle
 *
 * @property PlanificacionSemestral $planificacionSemestral
 */
  
abstract class BaseActividad extends GxActiveRecord {

        public $fecha_inicio_inicio;
        public $fecha_inicio_termino;
        public $fecha_termino_inicio;
        public $fecha_termino_termino;
       
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'actividad';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Actividad|Actividads', $n);
	}

	public static function representingColumn() {
		return 'fecha_inicio';
	}

	public function rules() {
		return array(
			array('planificacion_semestral_id', 'required'),
			array('planificacion_semestral_id', 'numerical', 'integerOnly'=>true),
			array('fecha_inicio, fecha_termino, detalle', 'safe'),
			array('fecha_inicio, fecha_termino, detalle', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, planificacion_semestral_id, fecha_inicio, fecha_termino, detalle, fecha_inicio_inicio, fecha_inicio_termino, fecha_termino_inicio, fecha_termino_termino', 'safe', 'on'=>'search'),
		);                        
	}

	public function relations() {
		return array(
			'planificacionSemestral' => array(self::BELONGS_TO, 'PlanificacionSemestral', 'planificacion_semestral_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'planificacion_semestral_id' => null,
			'fecha_inicio' => Yii::t('app', 'Fecha Inicio'),
			'fecha_termino' => Yii::t('app', 'Fecha Termino'),
			'detalle' => Yii::t('app', 'Detalle'),
			'planificacionSemestral' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('planificacion_semestral_id', $this->planificacion_semestral_id);
                $criteria->compare('fecha_inicio', Yii::app()->format->FormatoFechaBD($this->fecha_inicio), true);
                if(!empty($this->fecha_inicio_inicio) && !empty($this->fecha_inicio_termino))   
                        $criteria->addBetweenCondition('fecha_inicio', Yii::app()->format->FormatoFechaBD($this->fecha_inicio_inicio), Yii::app()->format->FormatoFechaBD($this->fecha_inicio_termino));
                $criteria->compare('fecha_termino', Yii::app()->format->FormatoFechaBD($this->fecha_termino), true);
                if(!empty($this->fecha_termino_inicio) && !empty($this->fecha_termino_termino))   
                        $criteria->addBetweenCondition('fecha_termino', Yii::app()->format->FormatoFechaBD($this->fecha_termino_inicio), Yii::app()->format->FormatoFechaBD($this->fecha_termino_termino));
		$criteria->compare('detalle', $this->detalle, true);
                
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
        
        public function behaviors()
        {
            return array('datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior.DateTimeI18NBehavior'));
        }
  
        
}