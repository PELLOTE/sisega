<?php
class PlanActividadController extends GxController {

        public function filters() {
                return array('rights');
        }

	public function actionIndex() {
                $this->redirect(array('listar'));
	}

	public function actionListar() {
		$dataProvider = new CActiveDataProvider('PlanActividad');
		$this->render('listar', array(
			'dataProvider' => $dataProvider,
		));
	}        
        
	public function actionVer($id) {
		$this->render('ver', array(
			'model' => $this->loadModel($id, 'PlanActividad'),
		));
	}

	public function actionCrear() {
		$model = new PlanActividad;

		$this->performAjaxValidation($model, 'plan-actividad-form');

		if (isset($_POST['PlanActividad'])) {
			$model->setAttributes($_POST['PlanActividad']);

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
		$model = $this->loadModel($id, 'PlanActividad');

		$this->performAjaxValidation($model, 'plan-actividad-form');

		if (isset($_POST['PlanActividad'])) {
			$model->setAttributes($_POST['PlanActividad']);
                        
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
			$this->loadModel($id, 'PlanActividad')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('administrar'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionAdministrar() {
                $session = new CHttpSession;
                $session->open();
		$model = new PlanActividad('search');
		$model->unsetAttributes();

		if (isset($_GET['PlanActividad'])){
			$model->setAttributes($_GET['PlanActividad']);
                }

                $session['PlanActividad_model_search'] = $model;
                
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
             if(isset($session['PlanActividad_model_search']))
               {
                $model = $session['PlanActividad_model_search'];
                $model = PlanActividad::model()->findAll($model->search()->criteria);
               }
               else
                 $model = PlanActividad::model()->findAll();
             $this->toExcel($model, array('id', 'curso', 'planificacionSemestral', 'fecha_inicio', 'fecha_termino', 'actividad'), date('Y-m-d-H-i-s'), array(), 'Excel5');
	}
        
        public function actionGenerarPdf() 
	{
             $session=new CHttpSession;
             $session->open();
             if(isset($session['PlanActividad_model_search']))
               {
                $model = $session['PlanActividad_model_search'];
                $model = PlanActividad::model()->findAll($model->search()->criteria);
               }
               else
                 $model = PlanActividad::model()->findAll();
             $this->toExcel($model, array('id', 'curso', 'planificacionSemestral', 'fecha_inicio', 'fecha_termino', 'actividad'), date('Y-m-d-H-i-s'), array(), 'PDF');
	}

}