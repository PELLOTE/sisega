<?php

class CursoController extends GxController {

        public function filters() {
                return array('rights');
        }

	public function actionIndex() {
                $this->redirect(array('listar'));
	}

	public function actionListar() {
		$dataProvider = new CActiveDataProvider('Curso');
		$this->render('listar', array(
			'dataProvider' => $dataProvider,
		));
	}        
        
	public function actionVer($id) {
		$this->render('ver', array(
			'model' => $this->loadModel($id, 'Curso'),
		));
	}
        
        public function actionActivarCurso($id){
            
            $model = $this->loadModel($id, 'Curso');
            $model->estado = "ACTIVO";
            $model->save(true);
            Yii::app()->getUser()->setFlash('success','<i class="icon-ok"></i> El curso ha sido activado satisfactoriamente. ');
            
            $this->redirect(array('ver', 'id' => $model->id));
            
        }
        
        public function actionTerminarCurso($id){
            
            $model = $this->loadModel($id, 'Curso');
            $model->estado = "TERMINADO";
            $model->save(true);
            Yii::app()->getUser()->setFlash('success','<i class="icon-ok"></i> El curso ha sido terminado satisfactoriamente. ');
            
            $this->redirect(array('ver', 'id' => $model->id));
        }

	public function actionCrear() {
		$model = new Curso;

		$this->performAjaxValidation($model, 'curso-form');

		if (isset($_POST['Curso'])) {
			$model->setAttributes($_POST['Curso']);
                        if(isset($model->asignatura))
                            $model->nombre = $model->asignatura->nombre;
                        
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
		$model = $this->loadModel($id, 'Curso');

		$this->performAjaxValidation($model, 'curso-form');

		if (isset($_POST['Curso'])) {
			$model->setAttributes($_POST['Curso']);
                        
                        //$model->estado = ucwords(strtolower($model->estado));
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
			$this->loadModel($id, 'Curso')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('administrar'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionAdministrar() {
                $session = new CHttpSession;
                $session->open();
		$model = new Curso('search');
		$model->unsetAttributes();

		if (isset($_GET['Curso'])){
			$model->setAttributes($_GET['Curso']);
                }

                $session['Curso_model_search'] = $model;
                
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
             if(isset($session['Curso_model_search']))
               {
                $model = $session['Curso_model_search'];
                $model = Curso::model()->findAll($model->search()->criteria);
               }
               else
                 $model = Curso::model()->findAll();
             $this->toExcel($model, array('id', 'asignatura', 'profesor', 'semestre', 'anio', 'estado'), date('Y-m-d-H-i-s'), array(), 'Excel5');
	}
        
        public function actionGenerarPdf() 
	{
             $session=new CHttpSession;
             $session->open();
             if(isset($session['Curso_model_search']))
               {
                $model = $session['Curso_model_search'];
                $model = Curso::model()->findAll($model->search()->criteria);
               }
               else
                 $model = Curso::model()->findAll();
             $this->toExcel($model, array('id', 'asignatura', 'profesor', 'semestre', 'anio', 'estado'), date('Y-m-d-H-i-s'), array(), 'PDF');
	}

}