<?php

/**
 * This is the model base class for the table "planificacion_semestral".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "PlanificacionSemestral".
 *
 * Columns in table "planificacion_semestral" available as properties of the model,
 * followed by relations of table "planificacion_semestral" available as properties of the model.
 *
 * @property integer $id
 * @property integer $calendario_docente_id
 * @property string $fecha_creacion
 * @property string $fecha_proposicion
 * @property string $fecha_respuesta
 * @property string $estado
 * @property string $fecha_inicio
 * @property string $fecha_termino
 * @property integer $user_id
 * @property integer $semestre
 *
 * @property Actividad[] $actividads
 * @property PlanActividad[] $planActividads
 * @property CalendarioDocente $calendarioDocente
 * @property User $user
 */
  
abstract class BasePlanificacionSemestral extends GxActiveRecord {

        public $fecha_creacion_inicio;
        public $fecha_creacion_termino;
        public $fecha_proposicion_inicio;
        public $fecha_proposicion_termino;
        public $fecha_respuesta_inicio;
        public $fecha_respuesta_termino;
        public $fecha_inicio_inicio;
        public $fecha_inicio_termino;
        public $fecha_termino_inicio;
        public $fecha_termino_termino;
       
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'planificacion_semestral';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Planificacion Semestral|Planificacion Semestrals', $n);
	}

	public static function representingColumn() {
		return 'fecha_creacion';
	}

	public function rules() {
		return array(
			array('calendario_docente_id', 'required'),
			array('calendario_docente_id, user_id, semestre', 'numerical', 'integerOnly'=>true),
			array('estado', 'length', 'max'=>45),
			array('fecha_creacion, fecha_proposicion, fecha_respuesta, fecha_inicio, fecha_termino', 'safe'),
			array('fecha_creacion, fecha_proposicion, fecha_respuesta, estado, fecha_inicio, fecha_termino, user_id, semestre', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, calendario_docente_id, fecha_creacion, fecha_proposicion, fecha_respuesta, estado, fecha_inicio, fecha_termino, user_id, semestre, fecha_creacion_inicio, fecha_creacion_termino, fecha_proposicion_inicio, fecha_proposicion_termino, fecha_respuesta_inicio, fecha_respuesta_termino, fecha_inicio_inicio, fecha_inicio_termino, fecha_termino_inicio, fecha_termino_termino', 'safe', 'on'=>'search'),
		);                        
	}

	public function relations() {
		return array(
			'actividads' => array(self::HAS_MANY, 'Actividad', 'planificacion_semestral_id'),
			'planActividads' => array(self::HAS_MANY, 'PlanActividad', 'planificacion_semestral_id'),
			'calendarioDocente' => array(self::BELONGS_TO, 'CalendarioDocente', 'calendario_docente_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'calendario_docente_id' => null,
			'fecha_creacion' => Yii::t('app', 'Fecha Creacion'),
			'fecha_proposicion' => Yii::t('app', 'Fecha Proposicion'),
			'fecha_respuesta' => Yii::t('app', 'Fecha Respuesta'),
			'estado' => Yii::t('app', 'Estado'),
			'fecha_inicio' => Yii::t('app', 'Fecha Inicio'),
			'fecha_termino' => Yii::t('app', 'Fecha Termino'),
			'user_id' => null,
			'semestre' => Yii::t('app', 'Semestre'),
			'actividads' => null,
			'planActividads' => null,
			'calendarioDocente' => null,
			'user' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('calendario_docente_id', $this->calendario_docente_id);
                $criteria->compare('fecha_creacion', Yii::app()->format->FormatoFechaBD($this->fecha_creacion), true);
                if(!empty($this->fecha_creacion_inicio) && !empty($this->fecha_creacion_termino))   
                        $criteria->addBetweenCondition('fecha_creacion', Yii::app()->format->FormatoFechaBD($this->fecha_creacion_inicio), Yii::app()->format->FormatoFechaBD($this->fecha_creacion_termino));
                $criteria->compare('fecha_proposicion', Yii::app()->format->FormatoFechaBD($this->fecha_proposicion), true);
                if(!empty($this->fecha_proposicion_inicio) && !empty($this->fecha_proposicion_termino))   
                        $criteria->addBetweenCondition('fecha_proposicion', Yii::app()->format->FormatoFechaBD($this->fecha_proposicion_inicio), Yii::app()->format->FormatoFechaBD($this->fecha_proposicion_termino));
                $criteria->compare('fecha_respuesta', Yii::app()->format->FormatoFechaBD($this->fecha_respuesta), true);
                if(!empty($this->fecha_respuesta_inicio) && !empty($this->fecha_respuesta_termino))   
                        $criteria->addBetweenCondition('fecha_respuesta', Yii::app()->format->FormatoFechaBD($this->fecha_respuesta_inicio), Yii::app()->format->FormatoFechaBD($this->fecha_respuesta_termino));
		$criteria->compare('estado', $this->estado, true);
                $criteria->compare('fecha_inicio', Yii::app()->format->FormatoFechaBD($this->fecha_inicio), true);
                if(!empty($this->fecha_inicio_inicio) && !empty($this->fecha_inicio_termino))   
                        $criteria->addBetweenCondition('fecha_inicio', Yii::app()->format->FormatoFechaBD($this->fecha_inicio_inicio), Yii::app()->format->FormatoFechaBD($this->fecha_inicio_termino));
                $criteria->compare('fecha_termino', Yii::app()->format->FormatoFechaBD($this->fecha_termino), true);
                if(!empty($this->fecha_termino_inicio) && !empty($this->fecha_termino_termino))   
                        $criteria->addBetweenCondition('fecha_termino', Yii::app()->format->FormatoFechaBD($this->fecha_termino_inicio), Yii::app()->format->FormatoFechaBD($this->fecha_termino_termino));
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('semestre', $this->semestre);
                
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
        
        public function behaviors()
        {
            return array('datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior.DateTimeI18NBehavior'));
        }
  
        
}