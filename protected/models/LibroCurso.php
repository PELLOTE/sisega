<?php

Yii::import('application.models._base.BaseLibroCurso');

class LibroCurso extends BaseLibroCurso
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function primaryKey(){
            return 'actividad_id';
        }  
        
	public function search($withOrder = false, $order = 'fecha_inicio, evaluacion_fecha') {
		$criteria = new CDbCriteria;
		$criteria->compare('actividad_id', $this->actividad_id);
		$criteria->compare('actividad', $this->actividad, true);
                $criteria->compare('fecha_inicio', Yii::app()->format->FormatoFechaBD($this->fecha_inicio), true);
                if(!empty($this->fecha_inicio_inicio) && !empty($this->fecha_inicio_termino))   
                        $criteria->addBetweenCondition('fecha_inicio', Yii::app()->format->FormatoFechaBD($this->fecha_inicio_inicio), Yii::app()->format->FormatoFechaBD($this->fecha_inicio_termino));
                $criteria->compare('fecha_termino', Yii::app()->format->FormatoFechaBD($this->fecha_termino), true);
                if(!empty($this->fecha_termino_inicio) && !empty($this->fecha_termino_termino))   
                        $criteria->addBetweenCondition('fecha_termino', Yii::app()->format->FormatoFechaBD($this->fecha_termino_inicio), Yii::app()->format->FormatoFechaBD($this->fecha_termino_termino));
		$criteria->compare('curso_id', $this->curso_id);
		$criteria->compare('curso_semestre', $this->curso_semestre);
		$criteria->compare('curso_anio', $this->curso_anio);
		$criteria->compare('curso_nombre', $this->curso_nombre, true);
		$criteria->compare('evaluacion_id', $this->evaluacion_id);
                $criteria->compare('evaluacion_fecha', Yii::app()->format->FormatoFechaBD($this->evaluacion_fecha), true);
                if(!empty($this->evaluacion_fecha_inicio) && !empty($this->evaluacion_fecha_termino))   
                        $criteria->addBetweenCondition('evaluacion_fecha', Yii::app()->format->FormatoFechaBD($this->evaluacion_fecha_inicio), Yii::app()->format->FormatoFechaBD($this->evaluacion_fecha_termino));
		$criteria->compare('evaluacion_nombre', $this->evaluacion_nombre, true);
		$criteria->compare('evaluacion_observacion', $this->evaluacion_observacion, true);
		$criteria->compare('alumno_id', $this->alumno_id);
		$criteria->compare('alumno_nombre', $this->alumno_nombre, true);
		$criteria->compare('alumno_run', $this->alumno_run, true);
		$criteria->compare('calificacion_id', $this->calificacion_id);
		$criteria->compare('calificacion_nota', $this->calificacion_nota);
                $withOrder? $criteria->order = $order : null;
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
                         'sort'=>array(
                                'defaultOrder'=>'t.fecha_inicio, evaluacion_fecha',
                                'multiSort'=>true,
                            ),
                        'pagination'=>array(
                                'pageSize'=>15,
                            ),
		));
	}
        
}