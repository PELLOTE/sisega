<?php

class CalendarioDocenteController extends GxController {

        public function filters() {
                return array('rights');
        }

	public function actionIndex() {
                $this->redirect(array('listar'));
	}

	public function actionListar() {
		$dataProvider = new CActiveDataProvider('CalendarioDocente');
		$this->render('listar', array(
			'dataProvider' => $dataProvider,
		));
	}        
        
	public function actionVer($id) {
                $model = $this->loadModel($id, 'CalendarioDocente');
                $nuevo = TRUE;
                $vigente = TRUE;
                if ($model->estado != "NUEVO")
                    $nuevo = FALSE;   
                
                if ($model->estado != "VIGENTE")
                    $vigente = FALSE;   
                
                
		$this->render('ver', array(
			'model' => $model,
                        'nuevo' => $nuevo,
                        'vigente' => $vigente	
                ));
	}

	public function actionCrear() {
		$model = new CalendarioDocente;
                $model->estado="NUEVO";
		$this->performAjaxValidation($model, 'calendario-docente-form');

		if (isset($_POST['CalendarioDocente'])) {
                    $model->setAttributes($_POST['CalendarioDocente']);
                        $fecha = $_POST['CalendarioDocente']['inicio_primer_semestre'];
                       $dato = explode("/", $fecha);
                       $model->anio =  $dato[2];
                    if($this->validarFechasCalendarioDocente($model)){
                        if ($model->save()) {
                                if (Yii::app()->getRequest()->getIsAjaxRequest())
                                        Yii::app()->end();
                                else
                                        $this->redirect(array('ver', 'id' => $model->id));
                        }
                    }
		}

		$this->render('crear', array( 'model' => $model));
	}
        
        public function actionAceptarCalendario($id){
            
            $model = $this->loadModel($id, 'CalendarioDocente');
            if(CalendarioDocente::obtenerValidarCalendario() == true){
                $model->estado = "VIGENTE";
                $model->save(true);
                Yii::app()->getUser()->setFlash('success','<i class="icon-ok"></i> El calendario docente ha entrado en funcionamiento. ');
            }else{
               Yii::app()->getUser()->setFlash('error','<i class="icon-remove"></i> No se puede aceptar el calendario docente, ya que existe un calendario docente en funcionamiento.');
            }
            
            $this->redirect(array('ver', 'id' => $model->id));
            
        }
        
        public function actionTerminarCalendario($id){
            
            $model = $this->loadModel($id, 'CalendarioDocente');
            
                $model->estado = "NOVIGENTE";
                $model->save(true);
                Yii::app()->getUser()->setFlash('success','<i class="icon-ok"></i> El Calendario Academico ha dejado de funcionar. ');
            
            $this->redirect(array('ver', 'id' => $model->id));
        }

	public function actionActualizar($id) {
		$model = $this->loadModel($id, 'CalendarioDocente');

		$this->performAjaxValidation($model, 'calendario-docente-form');

		if (isset($_POST['CalendarioDocente'])) {
                    $model->setAttributes($_POST['CalendarioDocente']);
                    if($this->validarFechasCalendarioDocente($model)){
                        if ($model->save()) {
                                $this->redirect(array('ver', 'id' => $model->id));
                        }
                    }
		}

		$this->render('actualizar', array(
				'model' => $model,
				));
	}

	public function actionBorrar($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
                    $model = $this->loadModel($id, 'CalendarioDocente');
                    
                    try {
                        $model->delete();
                    } catch (CDbException $e) {
                            throw new CHttpException(400, Yii::t('app', 'No se puede eliminar el calendario docente, consulte a administración'));
                    }
                    
                    

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('administrar'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionAdministrar() {
                $session = new CHttpSession;
                $session->open();
		$model = new CalendarioDocente('search');
		$model->unsetAttributes();

		if (isset($_GET['CalendarioDocente'])){
			$model->setAttributes($_GET['CalendarioDocente']);
                }

                $session['CalendarioDocente_model_search'] = $model;
                
		$this->render('administrar', array(
			'model' => $model,
		));
	}
        
        public function behaviors()
        {
            return array(
                'eexcelview'=>array(
                    'class'=>'ext.eexcelview.EExcelBehavior',
                ),
            );
        }
        
             
        
        public function actionGenerarExcel()
	{	   
             $session=new CHttpSession;
             $session->open();
             if(isset($session['CalendarioDocente_model_search']))
               {
                $model = $session['CalendarioDocente_model_search'];
                $model = CalendarioDocente::model()->findAll($model->search()->criteria);
               }
               else
                 $model = CalendarioDocente::model()->findAll();
             $this->toExcel($model, array('id', 'inicio_primer_semestre', 'termino_primer_semestre', 'inicio_segundo_semestre', 'termino_segundo_semestre', 'anio', 'estado'), date('Y-m-d-H-i-s'), array(), 'Excel5');
	}
        
        public function actionGenerarPdf() 
	{
             $session=new CHttpSession;
             $session->open();
             if(isset($session['CalendarioDocente_model_search']))
               {
                $model = $session['CalendarioDocente_model_search'];
                $model = CalendarioDocente::model()->findAll($model->search()->criteria);
               }
               else
                 $model = CalendarioDocente::model()->findAll();
             $this->toExcel($model, array('id', 'inicio_primer_semestre', 'termino_primer_semestre', 'inicio_segundo_semestre', 'termino_segundo_semestre', 'anio', 'estado'), date('Y-m-d-H-i-s'), array(), 'PDF');
	}
        
        private function validarFechasCalendarioDocente($model){
        $error = false;
            
            //Inicio primer semestre y Termino primer semestre
            if(!Yii::app()->utilidad->compararRangoFechas($model->inicio_primer_semestre, $model->termino_primer_semestre, '!=')){
                    $model->addError('termino_primer_semestre', Yii::t('app', 'Las fechas no pueden ser iguales'));
                    $error = true;
            }
            
            
            if(!Yii::app()->utilidad->compararRangoFechas($model->inicio_primer_semestre, $model->termino_primer_semestre, '<=')){
                    $model->addError('termino_primer_semestre', Yii::t('app', 'La fecha de termino es inferior a la fecha de inicio'));
                    $error = true;
            }
            
            //Inicio segundo semestre y Termino segundo semestre
            if(!Yii::app()->utilidad->compararRangoFechas($model->inicio_segundo_semestre, $model->termino_segundo_semestre, '!=')){
                    $model->addError('termino_segundo_semestre', Yii::t('app', 'Las fechas no pueden ser iguales'));
                    $error = true;
            }
            
            if(!Yii::app()->utilidad->compararRangoFechas($model->inicio_segundo_semestre, $model->termino_segundo_semestre, '<=')){
                    $model->addError('termino_segundo_semestre', Yii::t('app', 'La fecha de termino es inferior a la fecha de inicio'));
                    $error = true;
            }
            
            
            //Termino primer semestre e Inicio segundo semestre
            if(!Yii::app()->utilidad->compararRangoFechas($model->termino_primer_semestre, $model->inicio_segundo_semestre, '<')){
                    $model->addError('inicio_segundo_semestre', Yii::t('app', 'la fecha de termino primer semestre es mayor o igual que la fecha inicio del segundo semestre'));
                    $error = true;
            }
            
            return !$error;
        }

}