<?php

class ActividadController extends GxController {

        public function filters() {
                return array('rights');
        }

	public function actionIndex() {
                $this->redirect(array('listar'));
	}

	public function actionListar() {
		$dataProvider = new CActiveDataProvider('Actividad');
		$this->render('listar', array(
			'dataProvider' => $dataProvider,
		));
	}        
        
	public function actionVer($id) {
		$this->render('ver', array(
			'model' => $this->loadModel($id, 'Actividad'),
		));
	}

	public function actionCrear() {
		$model = new Actividad;

		$this->performAjaxValidation($model, 'actividad-form');

		if (isset($_POST['Actividad'])) {
			$model->setAttributes($_POST['Actividad']);

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
		$model = $this->loadModel($id, 'Actividad');

		$this->performAjaxValidation($model, 'actividad-form');

		if (isset($_POST['Actividad'])) {
			$model->setAttributes($_POST['Actividad']);
                        
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
			$this->loadModel($id, 'Actividad')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('administrar'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionAdministrar() {
                $session = new CHttpSession;
                $session->open();
		$model = new Actividad('search');
		$model->unsetAttributes();

		if (isset($_GET['Actividad'])){
			$model->setAttributes($_GET['Actividad']);
                }

                $session['Actividad_model_search'] = $model;
                
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
             if(isset($session['Actividad_model_search']))
               {
                $model = $session['Actividad_model_search'];
                $model = Actividad::model()->findAll($model->search()->criteria);
               }
               else
                 $model = Actividad::model()->findAll();
             $this->toExcel($model, array('id', 'planificacionSemestral', 'fecha_inicio', 'fecha_termino', 'detalle'), date('Y-m-d-H-i-s'), array(), 'Excel5');
	}
        
        public function actionGenerarPdf() 
	{
             $session=new CHttpSession;
             $session->open();
             if(isset($session['Actividad_model_search']))
               {
                $model = $session['Actividad_model_search'];
                $model = Actividad::model()->findAll($model->search()->criteria);
               }
               else
                 $model = Actividad::model()->findAll();
             $this->toExcel($model, array('id', 'planificacionSemestral', 'fecha_inicio', 'fecha_termino', 'detalle'), date('Y-m-d-H-i-s'), array(), 'PDF');
	}

}