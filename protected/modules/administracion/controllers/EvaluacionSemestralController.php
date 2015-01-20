<?php

class EvaluacionSemestralController extends GxController {
	
    public function actionListarAlumnos()
	{
        $this->layout='//layouts/column1';
        $semestre=1; $anio=intval(date("Y"));
        
        if(isset($_POST['Semestre']))
            $semestre=intval($_POST['Semestre']);
        
        if(isset($_POST['Año']))
                $anio=intval($_POST['Año']);
        
        
	$dataProvider = new CActiveDataProvider(Alumno::model()->reprobado($semestre,$anio));
		$this->render('listarAlumnos', array(
			'dataProvider' => $dataProvider,
                        
		));
	}

	public function actionEvaluar($id,$semestre_cursado=1)
	{
                
		$model = new EvaluacionSemestral("crearEvaluacion");		
		$this->performAjaxValidation($model, 'evaluacion-semestral-form');
                $model->alumno_id=$id;
                $model->anio = date("Y");
                $model->semestre_cursado = $semestre_cursado;

		if (isset($_POST['EvaluacionSemestral'])) {
			$model->setAttributes($_POST['EvaluacionSemestral']);
			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('malla/index', 'id' => $id));
			}
		}
		$this->render('crearEvaluacion', array( 
                                                        'model' => $model, 
                                                    ));
	}

//--------------------------------------------------------------------------------------------------------
        public function filters() {
                return array('rights');
        }

	public function actionIndex() {
                $this->redirect(array('listar'));
	}

	public function actionListar() {
		$dataProvider = new CActiveDataProvider('EvaluacionSemestral');
		$this->render('listar', array(
			'dataProvider' => $dataProvider,
		));
	}        
        
	public function actionVer($id) {
		$this->render('ver', array(
			'model' => $this->loadModel($id, 'EvaluacionSemestral'),
		));
	}

	public function actionCrear() {
		$model = new EvaluacionSemestral;
		
		$this->performAjaxValidation($model, 'evaluacion-semestral-form');

		if (isset($_POST['EvaluacionSemestral'])) {
			$model->setAttributes($_POST['EvaluacionSemestral']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('ver', 'id' => $model->id));
			}
		}

		$this->render('crear', array( 'model' => $model));
	}

	public function actionActualizar($id) {
		$model = $this->loadModel($id, 'EvaluacionSemestral');

		$this->performAjaxValidation($model, 'evaluacion-semestral-form');

		if (isset($_POST['EvaluacionSemestral'])) {
			$model->setAttributes($_POST['EvaluacionSemestral']);
                        
			if ($model->save()) {
				$this->redirect(array('ver', 'id' => $model->id));
			}
		}

		$this->render('actualizar', array(
				'model' => $model,
				));
	}

	public function actionBorrar($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'EvaluacionSemestral')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('administrar'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionAdministrar() {
                $session = new CHttpSession;
                $session->open();
		$model = new EvaluacionSemestral('search');
		$model->unsetAttributes();

		if (isset($_GET['EvaluacionSemestral'])){
			$model->setAttributes($_GET['EvaluacionSemestral']);
                }

                $session['EvaluacionSemestral_model_search'] = $model;
                
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
             if(isset($session['EvaluacionSemestral_model_search']))
               {
                $model = $session['EvaluacionSemestral_model_search'];
                $model = EvaluacionSemestral::model()->findAll($model->search()->criteria);
               }
               else
                 $model = EvaluacionSemestral::model()->findAll();
             $this->toExcel($model, array('id', 'alumno', 'semestre_academico', 'semestre_cursado', 'anio_cursado', 'estado', 'observacion'), date('Y-m-d-H-i-s'), array(), 'Excel5');
	}
        
        public function actionGenerarPdf() 
	{
             $session=new CHttpSession;
             $session->open();
             if(isset($session['EvaluacionSemestral_model_search']))
               {
                $model = $session['EvaluacionSemestral_model_search'];
                $model = EvaluacionSemestral::model()->findAll($model->search()->criteria);
               }
               else
                 $model = EvaluacionSemestral::model()->findAll();
             $this->toExcel($model, array('id', 'alumno', 'semestre_academico', 'semestre_cursado', 'anio_cursado', 'estado', 'observacion'), date('Y-m-d-H-i-s'), array(), 'PDF');
	}

}