<?php

class JefaturaCarreraController extends GxController {
    
        public function actionVerEvaluacionesSemestrales($id){
            
            $model_alumno = Alumno::model()->findByPk($id)->with('evaluacionSemestrals');
            
            $this->render('alumno/ver_evaluaciones_semestrales', array(
			'model_alumno' => $model_alumno,
                        
                ));
        }
        
        public function actionVerAvanceCurricular($id){
                $this->layout='//layouts/column1';
                $records = Asignatura::model()->findAll();
                $asignaturas = array();
                if(count($records) > 0){
                    foreach($records as $record){                        
                        $asignaturas[$record->numero] = (object)$record->attributes;
                    }
                        
                }       
		$this->render('alumno/malla/index', array(
			'asignaturas' => $asignaturas,
                        'modelos'=> $records,
                        'alumno_id'=>$id,
		));
	}
    
        public function actionVerAlumnos(){
            $model_alumnos = new Alumno('search');
            $model_alumnos->unsetAttributes();
            $tipo = "Alumno";

            if (isset($_GET['Alumno'])){
                    $model_alumnos->setAttributes($_GET['Alumno']);
            }

            $this->render('alumno/ver_alumnos', array(
                    'model_alumnos' => $model_alumnos,
                    'tipo' => $tipo,
            ));
        }
        
        public function actionVerAlumno($id,$curso){
            $calificaciones_alumno = Alumno::mis_calificaciones($curso,$id);
            $this->render('alumno/ver_alumno', array(
			'model' => $this->loadModel($id, 'Alumno'),
                        'calificaciones_alumno' => $calificaciones_alumno,
                ));
        }
        
        public function actionVerAsignaturas() {
                $model_asignatura = new Asignatura('search');
		$model_asignatura->unsetAttributes();
                $tipo = "Asignatura";

		if (isset($_GET['Asignatura'])){
			$model_asignatura->setAttributes($_GET['Asignatura']);
                }

                $this->render('asignatura/ver_asignaturas', array(
			'model_asignatura' => $model_asignatura,
                        'tipo' => $tipo,
		));
	}
        
        public function actionCrearAsignatura(){
		$model_asignatura = new Asignatura;

		$this->performAjaxValidation($model_asignatura, 'asignatura-form');

		if (isset($_POST['Asignatura'])) {
			$model_asignatura->setAttributes($_POST['Asignatura']);

			if ($model_asignatura->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('verAsignatura', 'id' => $model_asignatura->id));
			}
		}

		$this->render('asignatura/crear_asignatura', array( 'model_asignatura' => $model_asignatura));
	}
        
        public function actionEditarAsignatura($id) {
		$model_asignatura = $this->loadModel($id, 'Asignatura');

		$this->performAjaxValidation($model_asignatura, 'asignatura-form');

		if (isset($_POST['Asignatura'])){
			$model_asignatura->setAttributes($_POST['Asignatura']);
                        
			if ($model_asignatura->save()) {
				$this->redirect(array('verAsignatura', 'id' => $model_asignatura->id));
			}
		}
                
                $this->render('asignatura/editar_asignatura', array(
				'model_asignatura' => $model_asignatura,
				));
	}
        
        public function actionVerAsignatura($id) {
                $model = Asignatura::model()->findByPk($id)->with('cursos');
		$this->render('asignatura/ver_asignatura', array(
			'model' => $model,
		));
	}
        /*
         * 
         * REQUERIMIENTO 03 EXTENDIDO
         * NO SE DEBE PERMITIR BORRAR USUARIOS NO ADMINISTRADOR
         * 
         * 
         
        public function actionBorrarAsignatura($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Asignatura')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('verAsignaturas'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}
         */
        public function actionVerCursos() {
                $model_curso = new Curso();
                //$model_curso = Curso::model()->findAll(array('order'=>'asigantura_id',));
                $model_curso->unsetAttributes();
                $tipo = "Curso";

		if (isset($_GET['Curso'])){
			$model_curso->setAttributes($_GET['Curso']);
                }

                $this->render('curso/ver_cursos', array(
			'model_curso' => $model_curso,
                        'tipo' => $tipo,
		));
        }
        
        public function actionCrearCurso() {
		$model_curso = new Curso;
                
		$this->performAjaxValidation($model_curso, 'curso-form');

		if (isset($_POST['Curso'])) {
                    $model_curso->setAttributes($_POST['Curso']);
                    
                    if($model_curso->validate()){
                        $model_curso->estado = ucwords(strtolower($model_curso->estado));
                        
                        if(isset($model_curso->asignatura))
                            $model_curso->nombre = $model_curso->asignatura->nombre;
                        
                        if ($model_curso->save()) {
                            
                            if (Yii::app()->getRequest()->getIsAjaxRequest())
                                    Yii::app()->end();
                            else
                                    $this->redirect(array('verCurso', 'id' => $model_curso->id));
                        }
                    }
                } 

		$this->render('curso/crear_curso', array( 'model_curso' => $model_curso));
	}
        
        public function actionEditarCurso($id) {
            $model_curso = $this->loadModel($id, 'Curso');

            $this->performAjaxValidation($model_curso, 'curso-form');

            if(isset($_POST['Curso'])) {
                    $model_curso->setAttributes($_POST['Curso']);
                    $model_curso->estado = ucwords(strtolower($model_curso->estado));
                    if($model_curso->validate()){
                            if ($model_curso->save()) {
                                    $this->redirect(array('verCurso', 'id' => $model_curso->id));
                            }
                    }
            }

            $this->render('curso/editar_curso', array(
                            'model_curso' => $model_curso,
                            ));
	}
        
        public function actionVerCurso($id) {

                $model = Curso::model()->findByPk($id)->with('alumnos');
                $model_plan_actividad = PlanActividad::plan_actividad_curso($model->id);
                $model_evaluacion = Evaluacion::evaluacion_curso($model->id);
                
                $this->render('curso/ver_curso', array(
			'model' => $model,
                        'model_evaluacion' => $model_evaluacion,
                        'model_plan_actividad' => $model_plan_actividad,
                ));
	}
        
        /* 
         * REQUERIMIENTO 03 EXTENDIDO
         * NO SE DEBE PERMITIR BORRAR USUARIOS NO ADMINISTRADOR
         * 
         
        public function actionBorrarCurso($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Curso')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('verCursos'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}
        */
        public function filters() {
            return array('rights');
        }
        public function behaviors()
        {
            return array(
                'eexcelview'=>array(
                    'class'=>'ext.eexcelview.EExcelBehavior',
                ),
            );
        }
        
        public function actionGenerarExcel($tipo)
	{	   
             $session=new CHttpSession;
             $session->open();
             
             if($tipo == "Alumno"){
                if(isset($session['Alumno_model_search'])){
                  $model = $session['Alumno_model_search'];
                  $model = Alumno::model()->findAll($model->search()->criteria);
                 }
                 else
                   $model = Alumno::model()->findAll();
                 $this->toExcel($model, array('id', 'nombre', 'run', 'direccion'), date('Y-m-d-H-i-s'), array(), 'Excel5');   

             }else if($tipo == "Asignatura"){
                if(isset($session['Asignatura_model_search']))
                {
                 $model = $session['Asignatura_model_search'];
                 $model = Asignatura::model()->findAll($model->search()->criteria);
                }
                else
                  $model = Asignatura::model()->findAll();
                $this->toExcel($model, array('id', 'nombre', 'semestre', 'programa'), date('Y-m-d-H-i-s'), array(), 'Excel5');

             }else if($tipo == "Curso"){
                if(isset($session['Curso_model_search']))
                {
                 $model = $session['Curso_model_search'];
                 $model = Curso::model()->findAll($model->search()->criteria);
                }
                else
                  $model = Curso::model()->findAll();
                $this->toExcel($model, array('id', 'asignatura', 'profesor', 'semestre', 'anio', 'nombre'), date('Y-m-d-H-i-s'), array(), 'Excel5');
             }
             
	}
}