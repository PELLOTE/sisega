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

	public function actionCrear() {
		$model = new ActividadUta;

		$this->performAjaxValidation($model, 'actividad-uta-form');

		if (isset($_POST['ActividadUta'])) {
			$model->setAttributes($_POST['ActividadUta']);

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
		$model = $this->loadModel($id, 'ActividadUta');

		$this->performAjaxValidation($model, 'actividad-uta-form');

		if (isset($_POST['ActividadUta'])) {
			$model->setAttributes($_POST['ActividadUta']);
                        
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
			$this->loadModel($id, 'ActividadUta')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('administrar'));
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

}