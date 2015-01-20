<?php

/**
 * This is the model base class for the table "alumno".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Alumno".
 *
 * Columns in table "alumno" available as properties of the model,
 * followed by relations of table "alumno" available as properties of the model.
 *
 * @property integer $id
 * @property string $nombre
 * @property string $run
 * @property string $direccion
 * @property integer $user_id
 * @property integer $anio_ingreso
 * @property string $email
 *
 * @property User $user
 * @property Calificacion[] $calificacions
 * @property Curso[] $cursos
 * @property EvaluacionSemestral[] $evaluacionSemestrals
 */
  
abstract class BaseAlumno extends GxActiveRecord {

       
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'alumno';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Alumno|Alumnos', $n);
	}

	public static function representingColumn() {
		return 'nombre';
	}

	public function rules() {
		return array(
			array('nombre, run', 'required'),
			array('user_id, anio_ingreso', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>255),
			array('run', 'length', 'max'=>12),
			array('direccion', 'length', 'max'=>45),
			array('email', 'length', 'max'=>200),
			array('direccion, user_id, anio_ingreso, email', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, nombre, run, direccion, user_id, anio_ingreso, email', 'safe', 'on'=>'search'),
		);                        
	}

	public function relations() {
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'calificacions' => array(self::HAS_MANY, 'Calificacion', 'alumno_id'),
			'cursos' => array(self::MANY_MANY, 'Curso', 'curso_tiene_alumno(alumno_id, curso_id)'),
			'evaluacionSemestrals' => array(self::HAS_MANY, 'EvaluacionSemestral', 'alumno_id'),
		);
	}

	public function pivotModels() {
		return array(
			'cursos' => 'CursoTieneAlumno',
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'nombre' => Yii::t('app', 'Nombre'),
			'run' => Yii::t('app', 'Run'),
			'direccion' => Yii::t('app', 'Direccion'),
			'user_id' => null,
			'anio_ingreso' => Yii::t('app', 'Año Ingreso'),
			'email' => Yii::t('app', 'Email'),
			'user' => null,
			'calificacions' => null,
			'cursos' => null,
			'evaluacionSemestrals' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('nombre', $this->nombre, true);
		$criteria->compare('run', $this->run, true);
		$criteria->compare('direccion', $this->direccion, true);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('anio_ingreso', $this->anio_ingreso);
		$criteria->compare('email', $this->email, true);
                
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
                        'pagination'=>array('pageSize'=>500),
		));
	}
        
  
        
}