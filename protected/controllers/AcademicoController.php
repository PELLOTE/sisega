<?php

class AcademicoController extends GxController {

public function actionIngresarPromedio($alumno_id,$curso_id)
{

    
  
   $model = CursoTieneAlumno::model()->findByAttributes(array('alumno_id'=> $alumno_id,'curso_id'=>$curso_id),true);

    if (isset($_POST['CursoTieneAlumno']) ){

            $model->setAttributes($_POST['CursoTieneAlumno']);
                      
                  if ($_POST['CursoTieneAlumno']['promedio'] >= 4){    
                    $model->estado="APROBADO";
                 }else{

                    $model->estado="REPROBADO";
                 }
            
     
        if( $model->save()){


             if(Yii::app()->request->isAjaxRequest){

                    echo CJSON::encode(array('status'=>'success','mensaje'=>'INGRESADO EXITOSAMENTE DEL PROMEDIO', 'div'=>$this->renderPartial('_ingresarPromedio', array('model'=>$model),true)));
                    exit;               
                } 

            
        }else{

            if(Yii::app()->request->isAjaxRequest){

                    echo CJSON::encode(array('status'=>'failure','mensaje'=>'PROMEDIO NO INGRESADO', 'div'=>$this->renderPartial('_ingresarPromedio', array('model'=>$model),true)));
                    exit;               
                } 
        } 
    

                                     
        }      
            if (Yii::app()->request->isAjaxRequest)
                {
                    echo CJSON::encode(array('status'=>'failure', 'div'=>$this->renderPartial('_ingresarPromedio', array('model' => $model,),true)));
                    exit;               
                }
    
}



//-------------------------------------------------------------------------------------------------------------------
        public function filters() {
                return array('rights');
        }

	public function actionIndex() {
                $this->redirect(array('misCursos'));
	}

        public function actionPanel(){
                //$profesor = $this->obtenerProfesor();
                $this->redirect(array('misCursos'));
        }
        
        public function actionMisCursos(){
            
                $profesor = $this->obtenerProfesor();
                $dataProvider=new CActiveDataProvider('Curso', array(
                    'criteria'=>array(
                        'condition'=>'estado = "ACTIVO" and profesor_id='.$profesor->id,
                        'order'=>'anio DESC, semestre DESC',
                    ),
                    'pagination'=>array(
                        'pageSize'=>20,
                    ),
                ));
		$this->render('curso/misCursos', array(
			'dataProvider' => $dataProvider,
		));
        }
        
        /**
         * 
         * @param int $id Curso
         */
	public function actionLibroCurso($id) {
                $this->validarProfesor($id, Yii::t('app', 'Usted no puede ver el libro de este curso.'), true);
                $this->layout='column1';
                $session = new CHttpSession;
                $session->open();
		$model = new LibroCurso('search');
		$model->unsetAttributes();

		if (isset($_GET['LibroCurso'])){
			$model->setAttributes($_GET['LibroCurso']);
                }
                $model->curso_id = $id;
                $session['LibroCurso_model_search'] = $model;
                
		$this->render('curso/libroCurso', array(
			'model' => $model,
		));
	}
        
        /**
         * 
         * @param int $id Curso
         */
        public function actionVerCurso($id){
                $model = $this->validarProfesor($id, Yii::t('app', 'Usted no puede ver este curso.'), true);
		$this->render('curso/verCurso', array(
			'model' => $model,
		));
        }
        
        /**
         * 
         * @param int $id Curso
         */
	public function actionListarPlanActividad($id) {
                $this->validarProfesor($id, Yii::t('app', 'Usted no puede ver los planes de actividades.'));
		$dataProvider = new CActiveDataProvider('PlanActividad', array(
                    'criteria'=>array(
                        'condition'=>'curso_id='.$id,
                        'order'=>'id',
                    ),
                    'countCriteria'=>array(
                        'condition'=>'curso_id='.$id,
                        // 'order' and 'with' clauses have no meaning for the count query
                    ),
                    'pagination'=>array(
                        'pageSize'=>20,
                    ),
                ));
		$this->render('planActividad/listarPlanActividad', array(
			'dataProvider' => $dataProvider,
		));
	}            
        
        /**
         * 
         * @param int $id PlanActvidad
         */
	public function actionVerPlanActividad($id) {
                $model = $this->loadModel($id, 'PlanActividad');
                $this->validarProfesor($model->curso_id, Yii::t('app', 'Usted no puede ver este plan de actividad.'));
                
		$this->render('planActividad/verPlanActividad', array(
			'model' => $model,
		));
	}        
        
        /**
         * 
         * @param int $id Curso
         */
	public function actionCrearPlanActividad($id){
                //$this->layout='//layouts/column1';
                $this->validarProfesor($id, Yii::t('app', 'Usted no puede crear un plan de actividad para este curso.'));
                $model = new PlanActividad;
                $model_curso= $this->loadModel($id, 'Curso');
                $model->curso_id = $id;
                
                $model_planificacion_semestral = PlanificacionSemestral::model()->vigente($model_curso->anio,$model_curso->semestre)->find();
                if($model_planificacion_semestral != null){
                    $model->planificacion_semestral_id = $model_planificacion_semestral->id;
                }else{
                    $model_planificacion_semestral = PlanificacionSemestral::model();
                    Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_WARNING,
                    Yii::t('app', '<h4>¡Atención!</h4> No se ha definido una '.PlanificacionSemestral::label().', por lo que no va a poder crear un '. PlanActividad::label() .'.'));
 
                }
                
		$this->performAjaxValidation($model, 'plan-actividad-form');
		if (isset($_POST['PlanActividad'])) {
			$model->setAttributes($_POST['PlanActividad']);
                        $model->planificacion_semestral_id = $model_planificacion_semestral->id;
			if ($this->validarFechas($model, $model_planificacion_semestral) && $model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('verCurso', 'id' => $id));
                                }
		}

		$this->render('planActividad/crearPlanActividad', array( 'model' => $model, 'model_planificacion_semestral' => $model_planificacion_semestral));
	}

        /**
         * 
         * @param int $id PlanActividad
         */
	public function actionEditarPlanActividad($id) {
                $model = $this->loadModel($id, 'PlanActividad');
                $this->validarProfesor($model->curso->id, Yii::t('app', 'Usted no puede editar este plan de actividad para este curso.'));
                $model->curso_id = $model->curso->id;
                
                $model_planificacion_semestral = PlanificacionSemestral::obtenerVigente();
                $model->planificacion_semestral_id = $model_planificacion_semestral->id;
                
		$this->performAjaxValidation($model, 'plan-actividad-form');

		if (isset($_POST['PlanActividad'])) {
			$model->setAttributes($_POST['PlanActividad']);
                        $model->planificacion_semestral_id = $model_planificacion_semestral->id;
			if ($this->validarFechas($model, $model_planificacion_semestral) && $model->save()) {
				$this->redirect(array('verPlanActividad', 'id' => $id));
			}
		}

		$this->render('planActividad/editarPlanActividad', array(
				'model' => $model,
                                'model_planificacion_semestral' => $model_planificacion_semestral
				));
	}

        /**
         * 
         * @param int $id PlanActividad
         * @throws CHttpException
         */
	public function actionBorrarPlanActividad($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
                        $model = $this->loadModel($id, 'PlanActividad');
                        $this->validarProfesor($model->curso_id, Yii::t('app', 'Usted no puede borrar este plan de actividad'));
                        $model->delete();
			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('verCurso', 'id' => $model->curso_id));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}        
        
        /**
         * 
         * @param int $id Evaluación
         */
        public function actionVerEvaluacion($id){
                $model = $this->loadModel($id, 'Evaluacion');
                $this->validarProfesor($model->curso_id, Yii::t('app', 'Usted no puede ver esta evaluación.'));                
		$this->render('evaluacion/verEvaluacion', array(
			'model' => $model,
		));
        }
        
        /**
         * 
         * @param int $id Curso
         */
	public function actionCrearEvaluacion($id) {        
                $this->validarProfesor($id, Yii::t('app', 'Usted no puede crear una evaluación para este curso.'));  
                $model = new Evaluacion;
                $model->curso_id = $id;
                
                $model_curso= $this->loadModel($id, 'Curso');
                $model_planificacion_semestral = PlanificacionSemestral::model()->vigente($model_curso->anio,$model_curso->semestre)->find();
                
                if(!isset($model_planificacion_semestral)){
                    
                    Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_INFO,
                    Yii::t('app', '<h4>¡Atención!</h4> No se ha definido una '.PlanificacionSemestral::label().', por lo que no va a poder crear una '. Evaluacion::label() .'.'));
                    throw new CHttpException(404, Yii::t('app', 'No se ha definido una '.PlanificacionSemestral::label().', por lo que no va a poder crear una '. Evaluacion::label() .'.'));
                }
                
		$this->performAjaxValidation($model, 'evaluacion-form');

		if (isset($_POST['Evaluacion'])) {
			$model->setAttributes($_POST['Evaluacion']);
                        
                            if ($model->save()) {
                                    if (Yii::app()->getRequest()->getIsAjaxRequest())
                                            Yii::app()->end();
                                    else
                                            $this->redirect(array('verEvaluacion', 'id' => $model->id));
                            }
		}

		$this->render('evaluacion/crearEvaluacion', array( 'model' => $model, 'model_planificacion_semestral'=> $model_planificacion_semestral ));
	}

        /**
         * 
         * @param int $id Evaluación
         */
	public function actionEditarEvaluacion($id) {
		$model = $this->loadModel($id, 'Evaluacion');
                $this->validarProfesor($model->curso_id, Yii::t('app', 'Usted no puede editar esta evaluación para este curso.'));   
                
		$this->performAjaxValidation($model, 'evaluacion-form');
                
                $model_curso= $this->loadModel($model->curso_id, 'Curso');
                $model_planificacion_semestral = PlanificacionSemestral::model()->vigente($model_curso->anio,$model_curso->semestre)->find();

		if (isset($_POST['Evaluacion'])) {
			$model->setAttributes($_POST['Evaluacion']);
                        
			if ($model->save()) {
				$this->redirect(array('verEvaluacion', 'id' => $model->id));
			}
		}

		$this->render('evaluacion/editarEvaluacion', array(
				'model' => $model,
                                'model_planificacion_semestral'=> $model_planificacion_semestral
				));
	}
        
        /**
         * 
         * @param int $id Evaluación
         * @throws CHttpException
         */
	public function actionBorrarEvaluacion($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$model = $this->loadModel($id, 'Evaluacion');
                        $curso_id = $model->curso_id;
                        $this->validarProfesor($curso_id, Yii::t('app', 'Usted no puede borrar esta evaluación para este curso.'));
                        $model->delete();
			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('verCurso', 'id' => $curso_id));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}
        
        /**
         * 
         * @param int $id Calificación
         */
	public function actionVerCalificacion($id) {
                $model = $this->loadModel($id, 'Calificacion');
                $this->validarProfesor($model->curso_id, Yii::t('app', 'Usted no puede ver esta calificación.'));   
		$this->render('calificacion/verCalificacion', array(
			'model' => $model,
		));
	}

        /**
         * 
         * @param int $id Evaluacion
         */
	public function actionCrearCalificacion($id) {
                $model_evaluacion = $this->loadModel($id, 'Evaluacion');
                $this->validarProfesor($model_evaluacion->curso_id, Yii::t('app', 'Usted no puede crear una calificación para esta evaluación.'));  
		$model = new Calificacion;
                $model->evaluacion_id = $model_evaluacion->id;
                $model->curso_id = $model_evaluacion->curso_id;
//                $model_alumnos = Alumnos::sinCalificacion($id);
		$this->performAjaxValidation($model, 'calificacion-form');

		if (isset($_POST['Calificacion'])) {
			$model->setAttributes($_POST['Calificacion']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('verEvaluacion', 'id' => $model->evaluacion_id));
			}
		}

		$this->render('calificacion/crearCalificacion', array( 'model' => $model));
	}
        /**
         * 
         * @param int $id Calificación
         */
	public function actionEditarCalificacion($id) {
		$model = $this->loadModel($id, 'Calificacion');
                $this->validarProfesor($model->curso_id, Yii::t('app', 'Usted no puede actualizar una calificación para esta evaluación.'));  
		$this->performAjaxValidation($model, 'calificacion-form');

		if (isset($_POST['Calificacion'])) {
			$model->setAttributes($_POST['Calificacion']);
                        
			if ($model->save()) {
				$this->redirect(array('verEvaluacion', 'id' => $model->evaluacion_id));
			}
		}

		$this->render('calificacion/editarCalificacion', array(
				'model' => $model,
				));
	}
        /**
         * 
         * @param int $id Calificación
         * @throws CHttpException
         */
	public function actionBorrarCalificacion($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$model = $this->loadModel($id, 'Calificacion');
                        $evaluacion_id = $model->evaluacion_id;
                        $curso_id = $model->curso_id;
                        $this->validarProfesor($curso_id, Yii::t('app', 'Usted no puede borrar una calificación para esta evaluación.'));
                        $model->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('verEvaluacion', 'id' => $evaluacion_id));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}        
        
        /**
         * 
         * @param int $id Curso
         */
	public function actionListarAlumno($id) {
                $this->validarProfesor($id, Yii::t('app', 'Usted no puede ver los alumnos de este curso.'));  
		$dataProvider = new CActiveDataProvider(Alumno::model()->curso($id));
                //$dataProvider = Alumno::model()->curso($id)->search();
		$this->render('alumno/listarAlumno', array(
			'dataProvider' => $dataProvider,
		));
	}        
        

        /**
         * ¡¡¡¡Vista del Alumno en Alpha (no se ha probado)!!!!
         * @param int $id Alumno
         * @param int $curso_id Curso
         * @throws CHttpException
         */
	public function actionVerAlumno($id, $curso_id) {
                $model_curso = $this->validarProfesor($curso_id, Yii::t('app', 'Usted no puede ver este alumno de este curso.'), true);  
                foreach($model_curso->alumnos as $alumno){
                        if($alumno->id == $id){
                                $this->render('alumno/verAlumno', array(
                                        'model' => $this->loadModel($id, 'Alumno'),
                                        'model_curso' => $model_curso
                                ));
                                return;
                        }
                }
                throw new CHttpException(401, Yii::t('app', 'Usted no puede ver este alumno de este curso.'));
	}

        /**
         * Retorna el profesor asociado al usuario
         * @return Profesor
         * @throws CHttpException
         */
        private function obtenerProfesor(){
                $user_id = Yii::app()->user->id?:null;
                $profesor = Profesor::model()->find('user_id=:user_id', array(':user_id'=>$user_id));                
                if(!isset($profesor)) {
                    Yii::app()->getUser()->setFlash('info','<i class="icon-exclamation-sign"></i> Su usuario no tiene un Profesor relacionado, <b>Comuníquese con administración</b>.');
                    throw new CHttpException(401, Yii::t('app', 'Su usuario no tiene un Profesor relacionado.'));
                
                }
                return $profesor;
        }

        /**
         * Valida el profesor y retorna por defecto profesor, si retornarCurso es true, retorna curso.
         * @param int $id_curso Curso
         * @param string $mensaje Enviar con Yii::t('app',$mensaje); para su traducción
         * @param bool $retornarCurso
         * @return Curso|Profesor
         * @throws CHttpException
         */
        private function validarProfesor($id_curso, $mensaje = null, $retornarCurso = false){    
                $profesor = $this->obtenerProfesor();   
                $curso = $this->loadModel($id_curso, 'Curso');

                if($curso->profesor_id != $profesor->id){
                        if($mensaje !== null) throw new CHttpException(401, $mensaje);
                        throw new CHttpException(401, Yii::t('app', 'Usted no está habilitado para realizar esta acción.'));
                
                }
                return $retornarCurso? $curso:$profesor;
        }
        
        /**
         * Verifica las fechas del plan de actvidad según la planificación de actividad vigente
         * @param PlanActividad $model
         * @param PlanificacionSemestral $model_planificacion_semestral
         * @return bool true si es valido, false si es invalido
         */
        private function validarFechas($model, $model_planificacion_semestral){
                $error = false;
                if(!Yii::app()->utilidad->compararRangoFechas($model->fecha_inicio, $model_planificacion_semestral->fecha_inicio, '>=')
                        or !Yii::app()->utilidad->compararRangoFechas($model->fecha_inicio, $model_planificacion_semestral->fecha_termino, '<=')){
                        $model->addError('fecha_inicio', Yii::t('app', 'La fecha de inicio no concuerda con la fecha de inicio de la planificación semestral'));
                        $error = true;
                }
                if(!Yii::app()->utilidad->compararRangoFechas($model->fecha_inicio, $model->fecha_termino, '<=')){
                        $model->addError('fecha_termino', Yii::t('app', 'La fecha de termino es inferior a la fecha de inicio'));
                        $error = true;
                }else{                      
                if(!Yii::app()->utilidad->compararRangoFechas($model->fecha_termino, $model_planificacion_semestral->fecha_termino, '<=')
                        or !Yii::app()->utilidad->compararRangoFechas($model->fecha_termino, $model_planificacion_semestral->fecha_inicio, '>=')){
                        $model->addError('fecha_termino', Yii::t('app', 'La fecha de termino no concuerda con la fecha de termino de la planificación semestral'));
                        $error = true;                                
                }}
                return !$error;
        }
        
        public function actionGenerarExcelLibroCurso()
	{	   
             $session=new CHttpSession;
             $session->open();
             if(isset($session['LibroCurso_model_search']))
               {
                $model = $session['LibroCurso_model_search'];
                $this->validarProfesor($model->curso_id, Yii::t('app', 'Usted no puede generar un excel de este libro de curso.'));  
                $model = LibroCurso::model()->findAll($model->search(true)->criteria);
               }
               else
                 throw new CHttpException(401, Yii::t('app', 'Usted no está habilitado para realizar esta acción.'));
             $this->toExcel($model, array('actividad', 'fecha_inicio', 'fecha_termino', 'curso_semestre', 'curso_anio', 'curso_nombre', 'evaluacion_fecha', 'evaluacion_nombre', 'evaluacion_observacion', 'alumno_run', 'alumno_nombre', 'calificacion_nota'), date('Y-m-d-H-i-s'), array(), 'Excel5');
	}        
        
        public function behaviors()
        {
            return array(
                'eexcelview'=>array(
                    'class'=>'ext.eexcelview.EExcelBehavior',
                ),
            );
        }        
        
}
