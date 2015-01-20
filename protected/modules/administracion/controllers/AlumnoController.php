<?php

class AlumnoController extends GxController {

        public function filters() {
                return array('rights');
        }

	public function actionIndex() {
                $this->redirect(array('listar'));
	}

	public function actionListar() {
		$dataProvider = new CActiveDataProvider('Alumno');
		$this->render('listar', array(
			'dataProvider' => $dataProvider,
		));
	}        
        
	public function actionVer($id) {
		$this->render('ver', array(
			'model' => $this->loadModel($id, 'Alumno'),
		));
	}

	public function actionCrear() {
		$model = new Alumno;

		$this->performAjaxValidation($model, 'alumno-form');

		if (isset($_POST['Alumno'])) {
			$model->setAttributes($_POST['Alumno']);
                        if(User::model()->findByAttributes(array('username'=>$model->run),array('order'=>'id DESC'))){
                            Yii::app()->user->setFlash('error', Yii::t('app','<strong>¡ERROR!</strong> El RUN:'.$model->run .' ya se encuentra registrado'));
                            $this->redirect(array('crear'));
                        }
			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('user/crearAlumno', 'id' => $model->id));
			}
		}

		$this->render('crear', array( 'model' => $model));
	}

	public function actionActualizar($id) {
		$model = $this->loadModel($id, 'Alumno');

		$this->performAjaxValidation($model, 'alumno-form');

		if (isset($_POST['Alumno'])) {
			$model->setAttributes($_POST['Alumno']);
                        
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
			$this->loadModel($id, 'Alumno')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('administrar'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionAdministrar() {
                $session = new CHttpSession;
                $session->open();
		$model = new Alumno('search');
		$model->unsetAttributes();

		if (isset($_GET['Alumno'])){
			$model->setAttributes($_GET['Alumno']);
                }

                $session['Alumno_model_search'] = $model;
                
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
             if(isset($session['Alumno_model_search']))
               {
                $model = $session['Alumno_model_search'];
                $model = Alumno::model()->findAll($model->search()->criteria);
               }
               else
                 $model = Alumno::model()->findAll();
             $this->toExcel($model, array('id', 'nombre', 'run', 'direccion', 'user'), date('Y-m-d-H-i-s'), array(), 'Excel5');
	}
        
        public function actionGenerarPdf() 
	{
             $session=new CHttpSession;
             $session->open();
             if(isset($session['Alumno_model_search']))
               {
                $model = $session['Alumno_model_search'];
                $model = Alumno::model()->findAll($model->search()->criteria);
               }
               else
                 $model = Alumno::model()->findAll();
             $this->toExcel($model, array('id', 'nombre', 'run', 'direccion', 'user'), date('Y-m-d-H-i-s'), array(), 'PDF');
	}
        
	public function actionCrearConCurso() {
		$model = new Alumno;

		$this->performAjaxValidation($model, 'alumno-form');

		if (isset($_POST['Alumno'])) {
			$model->setAttributes($_POST['Alumno']);
			$relatedData = array(
				'cursos' => $_POST['Alumno']['cursos'] === '' ? null : $_POST['Alumno']['cursos'],
				);

			if ($model->saveWithRelated($relatedData)) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('user/crearAlumno', 'id' => $model->id));
			}
		}

		$this->render('crearConCurso', array( 'model' => $model));
	}

	public function actionActualizarConCurso($id) {
		$model = $this->loadModel($id, 'Alumno');

		$this->performAjaxValidation($model, 'alumno-form');

		if (isset($_POST['Alumno'])) {
			$model->setAttributes($_POST['Alumno']);
			$relatedData = array(
				'cursos' => $_POST['Alumno']['cursos'] === '' ? null : $_POST['Alumno']['cursos'],
				);

			if ($model->saveWithRelated($relatedData)) {
				$this->redirect(array('ver', 'id' => $model->id));
			}
		}

		$this->render('actualizarConCurso', array(
				'model' => $model,
				));
	}
        
        public function actionVerAvanceCurricular($id){
                $this->layout='//layouts/column1';
                $records = Asignatura::model()->findAll();
                $asignaturas = array();
                if(count($records) > 0){
                    foreach($records as $record){                        
                        $asignaturas[$record->numero] = (object)$record->attributes;
                    }
                        
                }       
		$this->render('verAvanceCurricular', array(
			'asignaturas' => $asignaturas,
                        'modelos'=> $records,
                        'alumno_id'=>$id,
		));
	}

}