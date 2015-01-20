<?php

class EvaluacionController extends GxController {

        public function filters() {
                return array('rights');
        }

	public function actionIndex() {
                $this->redirect(array('listar'));
	}

	public function actionListar() {
		$dataProvider = new CActiveDataProvider('Evaluacion');
		$this->render('listar', array(
			'dataProvider' => $dataProvider,
		));
	}        
        
	public function actionVer($id) {
		$this->render('ver', array(
			'model' => $this->loadModel($id, 'Evaluacion'),
		));
	}

	public function actionCrear() {
		$model = new Evaluacion;

		$this->performAjaxValidation($model, 'evaluacion-form');

		if (isset($_POST['Evaluacion'])) {
			$model->setAttributes($_POST['Evaluacion']);

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
		$model = $this->loadModel($id, 'Evaluacion');

		$this->performAjaxValidation($model, 'evaluacion-form');

		if (isset($_POST['Evaluacion'])) {
			$model->setAttributes($_POST['Evaluacion']);
                        
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
			$this->loadModel($id, 'Evaluacion')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('administrar'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionAdministrar() {
                $session = new CHttpSession;
                $session->open();
		$model = new Evaluacion('search');
		$model->unsetAttributes();

		if (isset($_GET['Evaluacion'])){
			$model->setAttributes($_GET['Evaluacion']);
                }

                $session['Evaluacion_model_search'] = $model;
                
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
             if(isset($session['Evaluacion_model_search']))
               {
                $model = $session['Evaluacion_model_search'];
                $model = Evaluacion::model()->findAll($model->search()->criteria);
               }
               else
                 $model = Evaluacion::model()->findAll();
             $this->toExcel($model, array('id', 'curso', 'fecha', 'nombre', 'observacion'), date('Y-m-d-H-i-s'), array(), 'Excel5');
	}
        
        public function actionGenerarPdf() 
	{
             $session=new CHttpSession;
             $session->open();
             if(isset($session['Evaluacion_model_search']))
               {
                $model = $session['Evaluacion_model_search'];
                $model = Evaluacion::model()->findAll($model->search()->criteria);
               }
               else
                 $model = Evaluacion::model()->findAll();
             $this->toExcel($model, array('id', 'curso', 'fecha', 'nombre', 'observacion'), date('Y-m-d-H-i-s'), array(), 'PDF');
	}

}