<?php

Yii::import('application.models._base.BaseAlumno');

class Alumno extends BaseAlumno
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function rules() {
            return array_merge(parent::rules(), array(
                        array('anio_ingreso', 'required'),
                        array('run, email','unique'),
                        array('email','email'),
                    ));
        }     
        
        public static function mis_calificaciones($curso_id,$alumno_id){
            if ($alumno_id == NULL){
                $user_id = Yii::app()->user->getId();
                $alumno_id = Alumno::model()->findByAttributes(array('user_id'=>$user_id))->id;
            }
            
            return Calificacion::calificaciones_alumno($alumno_id,$curso_id);
        }
        
        /**
         * Retorna un criteria para obtener todos los alumnos sin notas.
         * Si se usa en conjunto con el scope Curso, retorna todos los alumnos sin calificación de ese curso
         * @param int $evaluacion_id Evaluacion
         * @return \Alumno
         */
        public function sinCalificacion($evaluacion_id){
            $alumnosConNota = Yii::app()->db->createCommand()
                ->select('alumno_id')
                ->from('calificacion')
                ->where('evaluacion_id=:evaluacion_id', array(':evaluacion_id'=>$evaluacion_id))
                ->queryColumn();
            $criteria = new CDbCriteria;
//            $criteria->together = true;
//            $criteria->with = array('calificacions');
//            $criteria->compare('calificacions.evaluacion_id', $evaluacion_id);
            $criteria->addNotInCondition('t.id', $alumnosConNota);
            $this->getDbCriteria()->mergeWith($criteria);
            return $this;
        }
                
        /**
         * Retorna un criteria para obtener todos los alumnos de un curso
         * @param int $curso_id Curso
         * @return \Alumno
         */
        public function curso($curso_id){
            $criteria = new CDbCriteria;
            $criteria->together = true;
            $criteria->with = array('cursos');
            $criteria->compare('cursos.id', $curso_id);
            $this->getDbCriteria()->mergeWith($criteria);
            return $this;
        }
        /**
         * Retorna un criteria para obtener todos los alumnos reprobados en un semestre y años especifico
         * @param int semestre anio
         * @return \Alumno
         */

        public function reprobado($semestre=1,$anio=2013)
        {
            $criteria = new CDbCriteria;
            $criteria->together = true;
            $criteria->with = array('cursos');
            $criteria->condition='cursos_cursos.estado=:estado AND cursos.semestre=:semestre AND cursos.anio=:anio';
            $criteria->params=array(':estado'=>'REPROBADO', ':semestre'=>$semestre, ':anio'=>$anio);
            $this->getDbCriteria()->mergeWith($criteria);
            return $this;
        }
        
        public static function estado($asignatura_id,$atributo='estado',$alumno_id=NULL){

            $consulta_sql="
                        SELECT
                            asignatura.nombre,
                            curso_tiene_alumno.promedio,
                            curso_tiene_alumno.estado
                        FROM
                            curso_tiene_alumno
                            INNER JOIN curso ON curso_tiene_alumno.curso_id = curso.id
                            INNER JOIN asignatura ON curso.asignatura_id = asignatura.id
                        WHERE
                            curso_tiene_alumno.alumno_id =:alumno_id AND
                            curso.asignatura_id = :asignatura_id
                        ORDER BY
                            curso.id DESC
                        LIMIT 1";
            
            $db = Yii::app()->db;
            $consulta = $db->createCommand($consulta_sql);
            $consulta->bindValue('alumno_id',$alumno_id);
            $consulta->bindValue('asignatura_id',$asignatura_id);
            $resultado=$consulta->queryRow();
           
            if($resultado!=NULL)
                return $resultado[$atributo];
            else
                return "NULO";
            
        }
        
        

}
