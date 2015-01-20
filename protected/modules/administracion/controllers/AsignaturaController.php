<?php

class AsignaturaController extends GxController {

        public function filters() {
                return array('rights');
        }

	public function actionIndex() {
                $this->redirect(array('listar'));
	}

	public function actionListar() {
		$dataProvider = new CActiveDataProvider('Asignatura');
		$this->render('listar', array(
			'dataProvider' => $dataProvider,
		));
	}        
        
	public function actionVer($id) {
		$this->render('ver', array(
			'model' => $this->loadModel($id, 'Asignatura'),
		));
	}

	public function actionCrear() {
		$model = new Asignatura;

		$this->performAjaxValidation($model, 'asignatura-form');

		if (isset($_POST['Asignatura'])) {
			$model->setAttributes($_POST['Asignatura']);

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
		$model = $this->loadModel($id, 'Asignatura');

		$this->performAjaxValidation($model, 'asignatura-form');

		if (isset($_POST['Asignatura'])) {
			$model->setAttributes($_POST['Asignatura']);
                        
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
			$this->loadModel($id, 'Asignatura')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('administrar'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionAdministrar() {
                $session = new CHttpSession;
                $session->open();
		$model = new Asignatura('search');
		$model->unsetAttributes();

		if (isset($_GET['Asignatura'])){
			$model->setAttributes($_GET['Asignatura']);
                }

                $session['Asignatura_model_search'] = $model;
                
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
             if(isset($session['Asignatura_model_search']))
               {
                $model = $session['Asignatura_model_search'];
                $model = Asignatura::model()->findAll($model->search()->criteria);
               }
               else
                 $model = Asignatura::model()->findAll();
             $this->toExcel($model, array('id', 'nombre', 'semestre', 'programa'), date('Y-m-d-H-i-s'), array(), 'Excel5');
	}
        
        public function actionGenerarPdf() 
	{
             $session=new CHttpSession;
             $session->open();
             if(isset($session['Asignatura_model_search']))
               {
                $model = $session['Asignatura_model_search'];
                $model = Asignatura::model()->findAll($model->search()->criteria);
               }
               else
                 $model = Asignatura::model()->findAll();
             $this->toExcel($model, array('id', 'nombre', 'semestre', 'programa'), date('Y-m-d-H-i-s'), array(), 'PDF');
	}

}