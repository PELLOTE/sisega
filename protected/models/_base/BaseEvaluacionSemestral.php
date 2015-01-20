<?php

/**
 * This is the model base class for the table "evaluacion_semestral".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "EvaluacionSemestral".
 *
 * Columns in table "evaluacion_semestral" available as properties of the model,
 * followed by relations of table "evaluacion_semestral" available as properties of the model.
 *
 * @property integer $id
 * @property integer $alumno_id
 * @property integer $semestre
 * @property integer $anio
 * @property string $estado
 * @property string $observacion
 * @property integer $oportunidad
 * @property integer $semestre_cursado
 * @property double $promedio
 *
 * @property Alumno $alumno
 */
  
abstract class BaseEvaluacionSemestral extends GxActiveRecord {

       
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'evaluacion_semestral';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Evaluacion Semestral|Evaluacion Semestrals', $n);
	}

	public static function representingColumn() {
		return 'estado';
	}

	public function rules() {
		return array(
                        array('alumno_id', 'required'),
			array('promedio, semestre', 'required', 'on'=>'crearEvaluacion'),
			array('alumno_id, semestre, anio, oportunidad, semestre_cursado', 'numerical', 'integerOnly'=>true),
                        array('promedio','numerical','min'=>1,'max'=>7, 'tooSmall'=>Yii::t('app','La nota mínima es un 1.0'), 'tooBig'=>Yii::t('app','La nota máxima es un 7.0')),
			array('estado', 'length', 'max'=>45),
			array('observacion', 'safe'),
			array('semestre, anio, estado, observacion, oportunidad, semestre_cursado, promedio', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, alumno_id, semestre, anio, estado, observacion, oportunidad, semestre_cursado, promedio', 'safe', 'on'=>'search'),
		);                        
	}

	public function relations() {
		return array(
			'alumno' => array(self::BELONGS_TO, 'Alumno', 'alumno_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'alumno_id' => null,
			'semestre' => Yii::t('app', 'Semestre'),
			'anio' => Yii::t('app', 'Anio'),
			'estado' => Yii::t('app', 'Estado'),
			'observacion' => Yii::t('app', 'Observacion'),
			'oportunidad' => Yii::t('app', 'Oportunidad'),
			'semestre_cursado' => Yii::t('app', 'Semestre Cursado'),
			'promedio' => Yii::t('app', 'Promedio'),
			'alumno' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('alumno_id', $this->alumno_id);
		$criteria->compare('semestre', $this->semestre);
		$criteria->compare('anio', $this->anio);
		$criteria->compare('estado', $this->estado, true);
		$criteria->compare('observacion', $this->observacion, true);
		$criteria->compare('oportunidad', $this->oportunidad);
		$criteria->compare('semestre_cursado', $this->semestre_cursado);
		$criteria->compare('promedio', $this->promedio);
                
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
        
  
        
}