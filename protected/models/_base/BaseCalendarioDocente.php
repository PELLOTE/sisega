<?php

/**
 * This is the model base class for the table "calendario_docente".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "CalendarioDocente".
 *
 * Columns in table "calendario_docente" available as properties of the model,
 * followed by relations of table "calendario_docente" available as properties of the model.
 *
 * @property integer $id
 * @property string $inicio_primer_semestre
 * @property string $termino_primer_semestre
 * @property string $inicio_segundo_semestre
 * @property string $termino_segundo_semestre
 * @property integer $anio
 * @property string $estado
 *
 * @property ActividadUta[] $actividadUtas
 * @property PlanificacionSemestral[] $planificacionSemestrals
 */
  
abstract class BaseCalendarioDocente extends GxActiveRecord {

        public $inicio_primer_semestre_inicio;
        public $inicio_primer_semestre_termino;
        public $termino_primer_semestre_inicio;
        public $termino_primer_semestre_termino;
        public $inicio_segundo_semestre_inicio;
        public $inicio_segundo_semestre_termino;
        public $termino_segundo_semestre_inicio;
        public $termino_segundo_semestre_termino;
       
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'calendario_docente';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Calendario Docente|Calendario Docentes', $n);
	}

	public static function representingColumn() {
		return 'inicio_primer_semestre';
	}

	public function rules() {
		return array(
			array('anio', 'numerical', 'integerOnly'=>true),
			array('estado', 'length', 'max'=>45),
			array('inicio_primer_semestre, termino_primer_semestre, inicio_segundo_semestre, termino_segundo_semestre', 'safe'),
			array('inicio_primer_semestre, termino_primer_semestre, inicio_segundo_semestre, termino_segundo_semestre, anio, estado', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, inicio_primer_semestre, termino_primer_semestre, inicio_segundo_semestre, termino_segundo_semestre, anio, estado, inicio_primer_semestre_inicio, inicio_primer_semestre_termino, termino_primer_semestre_inicio, termino_primer_semestre_termino, inicio_segundo_semestre_inicio, inicio_segundo_semestre_termino, termino_segundo_semestre_inicio, termino_segundo_semestre_termino', 'safe', 'on'=>'search'),
		);                        
	}

	public function relations() {
		return array(
			'actividadUtas' => array(self::HAS_MANY, 'ActividadUta', 'calendario_docente_id'),
			'planificacionSemestrals' => array(self::HAS_MANY, 'PlanificacionSemestral', 'calendario_docente_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'inicio_primer_semestre' => Yii::t('app', 'Inicio Primer Semestre'),
			'termino_primer_semestre' => Yii::t('app', 'Termino Primer Semestre'),
			'inicio_segundo_semestre' => Yii::t('app', 'Inicio Segundo Semestre'),
			'termino_segundo_semestre' => Yii::t('app', 'Termino Segundo Semestre'),
			'anio' => Yii::t('app', 'Anio'),
			'estado' => Yii::t('app', 'Estado'),
			'actividadUtas' => null,
			'planificacionSemestrals' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
                $criteria->compare('inicio_primer_semestre', Yii::app()->format->FormatoFechaBD($this->inicio_primer_semestre), true);
                if(!empty($this->inicio_primer_semestre_inicio) && !empty($this->inicio_primer_semestre_termino))   
                        $criteria->addBetweenCondition('inicio_primer_semestre', Yii::app()->format->FormatoFechaBD($this->inicio_primer_semestre_inicio), Yii::app()->format->FormatoFechaBD($this->inicio_primer_semestre_termino));
                $criteria->compare('termino_primer_semestre', Yii::app()->format->FormatoFechaBD($this->termino_primer_semestre), true);
                if(!empty($this->termino_primer_semestre_inicio) && !empty($this->termino_primer_semestre_termino))   
                        $criteria->addBetweenCondition('termino_primer_semestre', Yii::app()->format->FormatoFechaBD($this->termino_primer_semestre_inicio), Yii::app()->format->FormatoFechaBD($this->termino_primer_semestre_termino));
                $criteria->compare('inicio_segundo_semestre', Yii::app()->format->FormatoFechaBD($this->inicio_segundo_semestre), true);
                if(!empty($this->inicio_segundo_semestre_inicio) && !empty($this->inicio_segundo_semestre_termino))   
                        $criteria->addBetweenCondition('inicio_segundo_semestre', Yii::app()->format->FormatoFechaBD($this->inicio_segundo_semestre_inicio), Yii::app()->format->FormatoFechaBD($this->inicio_segundo_semestre_termino));
                $criteria->compare('termino_segundo_semestre', Yii::app()->format->FormatoFechaBD($this->termino_segundo_semestre), true);
                if(!empty($this->termino_segundo_semestre_inicio) && !empty($this->termino_segundo_semestre_termino))   
                        $criteria->addBetweenCondition('termino_segundo_semestre', Yii::app()->format->FormatoFechaBD($this->termino_segundo_semestre_inicio), Yii::app()->format->FormatoFechaBD($this->termino_segundo_semestre_termino));
		$criteria->compare('anio', $this->anio);
		$criteria->compare('estado', $this->estado, true);
                
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
        
        public function behaviors()
        {
            return array('datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior.DateTimeI18NBehavior'));
        }
  
        
}