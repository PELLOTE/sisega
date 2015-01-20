<?php


Yii::import('application.models._base.BaseUser');

class User extends BaseUser
{
        private $salt1 = "d9a0b9a00c671ed6c957f83eb8d39a15838da8e6";
        private $salt2 = "f4ee99d2f64115375f20896c7fe3a40a70ea651e";
        public $password_anterior;
        public $password_nuevo;
        public $password_nuevo_repetir;

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public static function representingColumn() {
            return 'username';
        }
    
        public function rules() {
            return array_merge(parent::rules(), array(
                        array('username, email', 'unique'),
                        array('username, password, email','required'),
                        array('email','email'),
                        array('rol', 'required'),
                        array('password','length','min'=>6,'max'=>45),
                        array('password_anterior, password_nuevo, password_nuevo_repetir', 'length', 'min'=>6, 'max'=>45, 'on'=>'changePassword'),
                        array('password_anterior, password_nuevo, password_nuevo_repetir', 'required', 'on'=>'changePassword'),
                    ));
        }

        public function attributeLabels() {
                 return array_merge(parent::attributeLabels(), array(
                        'password_anterior' => Yii::t('app', 'Current Password'),
                        'password_nuevo' => Yii::t('app', 'New Password'),
                        'password_nuevo_repetir' => Yii::t('app', 'Retype New Password'),
                ));
        }
        
        public function hashPassword($password) {
            return sha1($this->salt1 . $password . $this->salt2);
        }

        public function validatePassword($password) {
            return $this->hashPassword($password) === $this->password;
        }    
        
        public static function getAlumno($user_id){
            if(!isset($user_id)){
                Yii::app()->getUser()->setFlash('info','<i class="icon-exclamation-sign"></i> Este usuario no posee una cuenta de alumno asociada, <b>Comuníquese con Administración.</b>.');
                throw new CHttpException(404, Yii::t('app', 'Este usuario no posee una cuenta de alumno asociada'));
            }
            $model_alumno = Alumno::model()->findByAttributes(array(), 't.user_id=:user_id',array(':user_id'=>$user_id));
            if(!isset($model_alumno)){
                Yii::app()->getUser()->setFlash('info','<i class="icon-exclamation-sign"></i> Este usuario no posee una cuenta de alumno asociada, <b>Comuníquese con Administración.</b>.');
                throw new CHttpException(404, Yii::t('app', 'Este usuario no posee una cuenta de alumno asociada'));
            }else
                return $model_alumno->id; 
        }
    
}