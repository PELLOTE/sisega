<?php

class UserController extends GxController {

        public function filters() {
                return array('rights');
        }
        
	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'User'),
		));
	}

	public function actionCreate() {
		$model = new User;
		$this->performAjaxValidation($model, 'user-form');
                $model->activo = true;
		if (isset($_POST['User'])) {
			$model->setAttributes($_POST['User']);
                        if($model->validate()){
                                !empty($model->password)? $model->password = $model->hashPassword($model->password):null;
                                if ($model->save()) {
                                        Rights::assign($model->rol, $model->id);
                                        if (Yii::app()->getRequest()->getIsAjaxRequest())
                                                Yii::app()->end();
                                        else
                                                $this->redirect(array('view', 'id' => $model->id));
                                }
                        }
		}

		$this->render('create', array( 'model' => $model));
	}
        
        public function actionCrearProfesor($id) {
		$model = new User;
		$this->performAjaxValidation($model, 'user-form');
                $model->activo = true;
                
                $model_profesor = $this->loadModel($id, 'Profesor');
                $model->username = $model_profesor->run;
                $model->password = $model->hashPassword($model_profesor->run);
                $model->email = $model_profesor->email;
                $model->rol="Profesor";
                $model->save(false);
                Rights::assign($model->rol, $model->id);
                $model_profesor->user_id=$model->id;
                $model_profesor->save(false);
                
                $this->redirect(array('profesor/ver', 'id' => $id));
		
	}
        
        public function actionCrearAlumno($id) {
		$model = new User;
		$this->performAjaxValidation($model, 'user-form');
                $model->activo = true;
                
                $model_alumno = $this->loadModel($id, 'Alumno');                
                $model->username = $model_alumno->run;
                $model->password = $model->hashPassword($model_alumno->run);
                $model->email = $model_alumno->email;
                $model->rol="Alumno";
                $model->save(false);
                
                Rights::assign($model->rol, $model->id);
                
                $model_alumno->user_id=$model->id;
                $model_alumno->save(false);
                
                $this->redirect(array('alumno/ver', 'id' => $id));
		
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'User');

		$this->performAjaxValidation($model, 'user-form');

		if (isset($_POST['User'])) {
                        $password = $model->password;
			$model->setAttributes($_POST['User']);
			if($password !== $model->password){
				$model->password=$model->hashPassword($model->password);
			}
			if ($model->save()) {
                                foreach(Rights::getAssignedRoles($model->id) as $rol){
                                    Rights::revoke($rol->name, $model->id);
                                }
                                Rights::assign($model->rol, $model->id);
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'User')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('User');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
                $session = new CHttpSession;
                $session->open();
		$model = new User('search');
		$model->unsetAttributes();

		if (isset($_GET['User'])){
			$model->setAttributes($_GET['User']);
                }

                $session['User_model_search'] = $model;
                
		$this->render('admin', array(
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
             if(isset($session['User_model_search']))
               {
                $model = $session['User_model_search'];
                $model = User::model()->findAll($model->search()->criteria);
               }
               else
                 $model = User::model()->findAll();
             
             $this->toExcel($model, array('id', 'username', 'password', 'email'), date('Y-m-d-H-i-s'), array(), 'Excel5');
	}
        
        public function actionGenerarPdf() 
	{
             $session=new CHttpSession;
             $session->open();
             if(isset($session['User_model_search']))
               {
                $model = $session['User_model_search'];
                $model = User::model()->findAll($model->search()->criteria);
               }
               else
                 $model = User::model()->findAll();
             
             $this->toExcel($model, array('id', 'username', 'password', 'email'), date('Y-m-d-H-i-s'), array(), 'PDF');
	}
        
	public function actionChangePassword($id) {
            $model = $this->loadModel($id, 'User');
            if($model->id === Yii::app()->user->id){		
                $model->setScenario('changePassword');                
                $this->performAjaxValidation($model, 'user-change-password');

                if (isset($_POST['User'])) {
                        $model->setAttributes($_POST['User']);
                        if($model->hashPassword($model->password_anterior) === $model->password){
                            if($model->password_nuevo === $model->password_nuevo_repetir){
                                $model->password=$model->hashPassword($model->password_nuevo);
                                if ($model->save()) {
                                    $model->unsetAttributes(array('password_anterior', 'password_nuevo', 'password_nuevo_repetir'));
                                    Yii::app()->user->setFlash('success', '<strong>La contraseña ha sido cambiada exitosamente</strong>');                                    
                                }
                            }else{
                            $model->addError('password_nuevo', 'La nueva contraseña no coinciden.');  
                            $model->addError('password_nuevo_repetir', 'La nueva contraseña no coinciden.');  
                            }
                        }else{
                            $model->addError('password_anterior', 'La contraseña actual es incorrecta.');
                        }
                }
                $this->render('changePassword', array('model' => $model));
            }else{
                throw new CHttpException(403, Yii::t('app', 'You are not authorized to perform this action.'));
            }

	} 
}