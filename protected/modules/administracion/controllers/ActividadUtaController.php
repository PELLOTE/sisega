<?php

class ActividadUtaController extends GxController {

        public function filters() {
                return array('rights');
        }

	public function actionIndex() {
                $this->redirect(array('listar'));
	}

	public function actionListar() {
		$dataProvider = new CActiveDataProvider('ActividadUta');
		$this->render('listar', array(
			'dataProvider' => $dataProvider,
		));
	}        
        
	public function actionVer($id) {
		$this->render('ver', array(
			'model' => $this->loadModel($id, 'ActividadUta'),
		));
	}

	public function actionCrear($id) {
		$model_calendario = $this->loadModel($id, 'CalendarioDocente');
                $model = new ActividadUta;
                $model->calendario_docente_id = $id;
                
		$this->performAjaxValidation($model, 'actividad-uta-form');

		if (isset($_POST['ActividadUta'])) {
                    $model->setAttributes($_POST['ActividadUta']);
                    
                    if($model->semestre == 1){
                        //echo "1";
                        $model->fecha_inicio = $_POST['ActividadUta']['fecha_inicio_1'];
                        $model->fecha_termino = $_POST['ActividadUta']['fecha_termino_1'];
                        
                    }else{
                        //echo "2";
                        $model->fecha_inicio = $_POST['ActividadUta']['fecha_inicio_2'];
                        $model->fecha_termino = $_POST['ActividadUta']['fecha_termino_2'];
                    }
                    
                    if($this->validarFechasActividadUta($model)){
                        if ($model->save()) {
                                if (Yii::app()->getRequest()->getIsAjaxRequest())
                                        Yii::app()->end();
                                else
                                        $this->redirect(array('calendarioDocente/ver', 'id' => $id));
                        }
                    }
                }

		$this->render('crear', array( 
                               'model' => $model,
                               'model_calendario' => $model_calendario,
                        ));
	}

	public function actionActualizar($id) {
		$model = $this->loadModel($id, 'ActividadUta');
                $model_calendario = $this->loadModel($model->calendario_docente_id, 'CalendarioDocente');
                
                if($model->semestre == 1){
                    $model->fecha_inicio_1  = $model->fecha_inicio;
                    $model->fecha_termino_1 = $model->fecha_termino;
                }else{
                    $model->fecha_inicio_2  = $model->fecha_inicio;
                    $model->fecha_termino_2 = $model->fecha_termino;
                }

		$this->performAjaxValidation($model, 'actividad-uta-form');

		if (isset($_POST['ActividadUta'])) {
			$model->setAttributes($_POST['ActividadUta']);
                        if($model->semestre == 1){
                        
                        $model->fecha_inicio = $_POST['ActividadUta']['fecha_inicio_1'];
                        $model->fecha_termino = $_POST['ActividadUta']['fecha_termino_1'];
                        }else{
                            $model->fecha_inicio = $_POST['ActividadUta']['fecha_inicio_2'];
                            $model->fecha_termino = $_POST['ActividadUta']['fecha_termino_2'];
                        }
                        
                        if($this->validarFechasActividadUta($model)){
                            if ($model->save()) {
                                $this->redirect(array('calendarioDocente/ver', 'id' => $model->calendario_docente_id));
                            }
                        }
		}

		$this->render('actualizar', array(
				'model' => $model,
                                'model_calendario' => $model_calendario,
				));
	}

	public function actionBorrar($id) {
                $model = $this->loadModel($id, 'ActividadUta');
                $calendario_docente_id = $model->calendario_docente_id;
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$model->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('calendarioDocente/ver', 'id' => $calendario_docente_id));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionAdministrar() {
                $session = new CHttpSession;
                $session->open();
		$model = new ActividadUta('search');
		$model->unsetAttributes();

		if (isset($_GET['ActividadUta'])){
			$model->setAttributes($_GET['ActividadUta']);
                }

                $session['ActividadUta_model_search'] = $model;
                
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
             if(isset($session['ActividadUta_model_search']))
               {
                $model = $session['ActividadUta_model_search'];
                $model = ActividadUta::model()->findAll($model->search()->criteria);
               }
               else
                 $model = ActividadUta::model()->findAll();
             $this->toExcel($model, array('id', 'semestre', 'fecha_inicio', 'fecha_termino', 'detalle', 'calendarioDocente'), date('Y-m-d-H-i-s'), array(), 'Excel5');
	}
        
        public function actionGenerarPdf() 
	{
             $session=new CHttpSession;
             $session->open();
             if(isset($session['ActividadUta_model_search']))
               {
                $model = $session['ActividadUta_model_search'];
                $model = ActividadUta::model()->findAll($model->search()->criteria);
               }
               else
                 $model = ActividadUta::model()->findAll();
             $this->toExcel($model, array('id', 'semestre', 'fecha_inicio', 'fecha_termino', 'detalle', 'calendarioDocente'), date('Y-m-d-H-i-s'), array(), 'PDF');
	}
        
         private function validarFechasActividadUta($model){
        $error = false;
            
            if(!Yii::app()->utilidad->compararRangoFechas($model->fecha_inicio, $model->fecha_termino, '<=')){
                    $model->addError('fecha_termino', Yii::t('app', 'La fecha de termino es inferior a la fecha de inicio'));
                    $error = true;
            }
            return !$error;
        }

}