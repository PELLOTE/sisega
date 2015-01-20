<?php

class CalificacionController extends GxController {

        public function filters() {
                return array('rights');
        }

	public function actionIndex() {
                $this->redirect(array('listar'));
	}

	public function actionListar() {
		$dataProvider = new CActiveDataProvider('Calificacion');
		$this->render('listar', array(
			'dataProvider' => $dataProvider,
		));
	}        
        
	public function actionVer($id) {
		$this->render('ver', array(
			'model' => $this->loadModel($id, 'Calificacion'),
		));
	}

	public function actionCrear() {
		$model = new Calificacion;

		$this->performAjaxValidation($model, 'calificacion-form');

		if (isset($_POST['Calificacion'])) {
			$model->setAttributes($_POST['Calificacion']);

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
		$model = $this->loadModel($id, 'Calificacion');

		$this->performAjaxValidation($model, 'calificacion-form');

		if (isset($_POST['Calificacion'])) {
			$model->setAttributes($_POST['Calificacion']);
                        
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
			$this->loadModel($id, 'Calificacion')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('administrar'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionAdministrar() {
                $session = new CHttpSession;
                $session->open();
		$model = new Calificacion('search');
		$model->unsetAttributes();

		if (isset($_GET['Calificacion'])){
			$model->setAttributes($_GET['Calificacion']);
                }

                $session['Calificacion_model_search'] = $model;
                
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
             if(isset($session['Calificacion_model_search']))
               {
                $model = $session['Calificacion_model_search'];
                $model = Calificacion::model()->findAll($model->search()->criteria);
               }
               else
                 $model = Calificacion::model()->findAll();
             $this->toExcel($model, array('id', 'alumno', 'evaluacion', 'curso', 'nota'), date('Y-m-d-H-i-s'), array(), 'Excel5');
	}
        
        public function actionGenerarPdf() 
	{
             $session=new CHttpSession;
             $session->open();
             if(isset($session['Calificacion_model_search']))
               {
                $model = $session['Calificacion_model_search'];
                $model = Calificacion::model()->findAll($model->search()->criteria);
               }
               else
                 $model = Calificacion::model()->findAll();
             $this->toExcel($model, array('id', 'alumno', 'evaluacion', 'curso', 'nota'), date('Y-m-d-H-i-s'), array(), 'PDF');
	}

}