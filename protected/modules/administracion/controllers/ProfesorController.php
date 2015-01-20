<?php

class ProfesorController extends GxController {

        public function filters() {
                return array('rights');
        }

	public function actionIndex() {
                $this->redirect(array('listar'));
	}

	public function actionListar() {
		$dataProvider = new CActiveDataProvider('Profesor');
		$this->render('listar', array(
			'dataProvider' => $dataProvider,
		));
	}        
        
	public function actionVer($id) {
		$this->render('ver', array(
			'model' => $this->loadModel($id, 'Profesor'),
		));
	}

	public function actionCrear() {
		$model = new Profesor;

		$this->performAjaxValidation($model, 'profesor-form');

		if (isset($_POST['Profesor'])) {
			$model->setAttributes($_POST['Profesor']);
                        if(User::model()->findByAttributes(array('username'=>$model->run),array('order'=>'id DESC'))){
                            Yii::app()->user->setFlash('error', Yii::t('app','<strong>¡ERROR!</strong> El RUN:'.$model->run .' ya se encuentra registrado'));
                            $this->redirect(array('crear'));
                        }
			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('user/crearProfesor', 'id' => $model->id));
			}
		}

		$this->render('crear', array( 'model' => $model));
	}

	public function actionActualizar($id) {
		$model = $this->loadModel($id, 'Profesor');

		$this->performAjaxValidation($model, 'profesor-form');

		if (isset($_POST['Profesor'])) {
			$model->setAttributes($_POST['Profesor']);
                        
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
			$this->loadModel($id, 'Profesor')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('administrar'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionAdministrar() {
                $session = new CHttpSession;
                $session->open();
		$model = new Profesor('search');
		$model->unsetAttributes();

		if (isset($_GET['Profesor'])){
			$model->setAttributes($_GET['Profesor']);
                }

                $session['Profesor_model_search'] = $model;
                
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
             if(isset($session['Profesor_model_search']))
               {
                $model = $session['Profesor_model_search'];
                $model = Profesor::model()->findAll($model->search()->criteria);
               }
               else
                 $model = Profesor::model()->findAll();
             $this->toExcel($model, array('id', 'nombre', 'user'), date('Y-m-d-H-i-s'), array(), 'Excel5');
	}
        
        public function actionGenerarPdf() 
	{
             $session=new CHttpSession;
             $session->open();
             if(isset($session['Profesor_model_search']))
               {
                $model = $session['Profesor_model_search'];
                $model = Profesor::model()->findAll($model->search()->criteria);
               }
               else
                 $model = Profesor::model()->findAll();
             $this->toExcel($model, array('id', 'nombre', 'user'), date('Y-m-d-H-i-s'), array(), 'PDF');
	}
        
        public function actionCrearEvaluacion($id) {        
                $this->validarProfesor($id, Yii::t('app', 'Usted no puede crear una evaluación para este curso.'));  
                $model = new Evaluacion;
                $model->curso_id = $id;
                
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

		$this->render('evaluacion/crearEvaluacion', array( 'model' => $model));
	}

}