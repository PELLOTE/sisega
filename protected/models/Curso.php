<?php

Yii::import('application.models._base.BaseCurso');

class Curso extends BaseCurso
{
        public $repColumnsSeparator = ' - ';
    
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
  
        public static function representingColumn() {
		return 'NombreRepresentativo';
	}
        
        public function rules() {
            return array_merge(parent::rules(), array(
                        array('estado', 'required'),
                    ));
        }        
        
        public function getNombre(){
                return Asignatura::model()->findByPk($this->asignatura_id)->nombre;
        }
        
        public function getNombreRepresentativo(){
                if(isset($this->asignatura_id))
                    $nombre = Asignatura::model()->findByPk($this->asignatura_id)->nombre;
                else
                    $nombre = "N/N";
                
                $nombre .= ' ('.$this->semestre.' - '.$this->anio.')';
                return $nombre;
        }
        
        public static function cursos_alumno($alumno_id, $activo){
            
            $criteria=new CDbCriteria(array(
                'with' => array('alumnos'),
                'condition'=>'alumno_id = :alumno_id',
                'order'=>'t.id DESC',
                'limit'=>500,
                'params'=> array(':alumno_id' => $alumno_id),
             ));
            
            $dataProvider=new CActiveDataProvider('Curso',array('criteria'=>$criteria,));	

            return ($dataProvider);
        }
       
        public static function estados(){
                return array('ACTIVO'=>'ACTIVO', 'INACTIVO'=>'INACTIVO');
        }

           public function scopes()
        {
            return array(
                'activos'=>array(
                    'condition'=>"estado='ACTIVO'",
                ),
            );
        }
        
         
                
        public function getPromedio($asignatura_id,$alumno_id,$atributo='promedio'){
           
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
        
        public function getEtiquetaEstado(){

        if($this->estado=="ACTIVO")
            return TbHtml::labelTb($this->estado, array("color" => TbHtml::LABEL_COLOR_SUCCESS));
        else
            return TbHtml::labelTb($this->estado, array("color" => TbHtml::LABEL_COLOR_IMPORTANT));

        }
}
