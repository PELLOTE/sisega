<?php

class AlumnoController extends GxController {

        public function actionVerAlumnos(){
                $session = new CHttpSession;
                $session->open();
		$model = new Alumno('search');
		$model->unsetAttributes();

		if (isset($_GET['Alumno'])){
			$model->setAttributes($_GET['Alumno']);
                }

                $session['Alumno_model_search'] = $model;
                
		$this->render('verAlumnos', array(
			'model' => $model,
		));
            
        }
    
        /**
         * 
         * @param type $id Curso
         */
        public function actionVerCurso($id){
           $user_id = Yii::app()->user->id;
           $alumno = $this->validarAlumno($id, Yii::t('app', 'Usted no puede ver este curso.'));
           $curso = $this->loadModel($id, 'Curso');
           $calificaciones_alumno = Alumno::mis_calificaciones($curso->id,null);
           $plan_actividad = PlanActividad::plan_actividad_curso($curso->id);
            
           $this->render('ver_curso', array(
			'alumno' => $alumno,
                        'curso' => $curso,
                        'calificaciones_alumno' => $calificaciones_alumno,
                        'plan_actividad' => $plan_actividad,
           ));
        
        }


       public function actionMisCursos(){
           $user_id = Yii::app()->user->id;
           $alumno = Alumno::model()->findByAttributes(array('user_id'=>$user_id),true);
           
            if(!isset($user_id)){
                Yii::app()->getUser()->setFlash('info','<i class="icon-exclamation-sign"></i> Este usuario no posee una cuenta de alumno asociada, <b>Comuníquese con administración.</b>');
                throw new CHttpException(404, Yii::t('app', 'Este usuario no posee una cuenta de alumno asociada'));
            }
            if(!isset($alumno)){
                Yii::app()->getUser()->setFlash('info','<i class="icon-exclamation-sign"></i> Este usuario no posee una cuenta de alumno asociada, <b>Comuníquese con administración.</b>');
                throw new CHttpException(404, Yii::t('app', 'Este usuario no posee una cuenta de alumno asociada'));
            }
            
           
 
           $this->render('mis_cursos', array(
			//'model_alumno' => $model_alumno,
                        'alumno' => $alumno->with('cursos:activos'),
                        'cursos_alumno' => $alumno->cursos,
            ));
           
       }
    

        public function filters() {
                return array('rights');
        }

	public function actionIndex() {
                $this->redirect(array('misCursos'));
	}

   
        
        private function obtenerAlumno(){
                $user_id = Yii::app()->user->id?:null;
                $alumno = Alumno::model()->find('user_id=:user_id', array(':user_id'=>$user_id));                
                if(!isset($alumno)) throw new CHttpException(401, Yii::t('app', 'Usted no es alumno.'));
                return $alumno;
        }

        
        private function validarAlumno($id_curso, $mensaje = null, $retornarCurso = false){     
                $alumno = $this->obtenerAlumno();   
                $curso = $this->loadModel($id_curso, 'Curso');
                $curso_tiene_alumno = CursoTieneAlumno::model()->find('alumno_id=:alumno_id AND curso_id=:curso_id ', array(':alumno_id'=>$alumno->id, ':curso_id'=>$curso->id));
                if($curso_tiene_alumno == null){
                        if($mensaje !== null) throw new CHttpException(401, $mensaje);
                        throw new CHttpException(401, Yii::t('app', 'Usted no está habilitado para realizar esta acción.'));
                
                }
                return $retornarCurso? $curso:$alumno;
        }
        
        public function actionMalla(){
                $this->layout='//layouts/column1';
                $records = Asignatura::model()->findAll();
                $asignaturas = array();
                if(count($records) > 0){
                    foreach($records as $record){                        
                        $asignaturas[$record->numero] = (object)$record->attributes;
                    }
                        
                }       
		$this->render('malla/index', array(
			'asignaturas' => $asignaturas,
                        'modelos'=> $records,
		));
	}
}