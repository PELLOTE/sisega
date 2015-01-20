<?php

/**
 * This is the model base class for the table "asignatura_prerequisito".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "AsignaturaPrerequisito".
 *
 * Columns in table "asignatura_prerequisito" available as properties of the model,
 * followed by relations of table "asignatura_prerequisito" available as properties of the model.
 *
 * @property integer $asignatura_id
 * @property integer $prerequisito_asignatura_id
 *
 * @property Asignatura $asignatura
 * @property Asignatura $prerequisitoAsignatura
 */
  
abstract class BaseAsignaturaPrerequisito extends GxActiveRecord {

       
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'asignatura_prerequisito';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Asignatura Prerequisito|Asignatura Prerequisitos', $n);
	}

	public static function representingColumn() {
		return array(
			'asignatura_id',
			'prerequisito_asignatura_id',
		);
	}

	public function rules() {
		return array(
			array('asignatura_id, prerequisito_asignatura_id', 'required'),
			array('asignatura_id, prerequisito_asignatura_id', 'numerical', 'integerOnly'=>true),
			array('asignatura_id, prerequisito_asignatura_id', 'safe', 'on'=>'search'),
		);                        
	}

	public function relations() {
		return array(
			'asignatura' => array(self::BELONGS_TO, 'Asignatura', 'asignatura_id'),
			'prerequisitoAsignatura' => array(self::BELONGS_TO, 'Asignatura', 'prerequisito_asignatura_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'asignatura_id' => null,
			'prerequisito_asignatura_id' => null,
			'asignatura' => null,
			'prerequisitoAsignatura' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('asignatura_id', $this->asignatura_id);
		$criteria->compare('prerequisito_asignatura_id', $this->prerequisito_asignatura_id);
                
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
        
  
        
}