<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
//	public function authenticate()
//	{
//		$users=array(
//			// username => password
//			'demo'=>'demo',
//			'admin'=>'admin',
//		);
//		if(!isset($users[$this->username]))
//			$this->errorCode=self::ERROR_USERNAME_INVALID;
//		else if($users[$this->username]!==$this->password)
//			$this->errorCode=self::ERROR_PASSWORD_INVALID;
//		else
//			$this->errorCode=self::ERROR_NONE;
//		return !$this->errorCode;
//	}
        
        const ERROR_USER_BLOQUED=10;
        
        private $_id;
        
        public function authenticate()
        {
            $record=User::model()->findByAttributes(array('username'=>$this->username));
            if($record===null)
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            else if(!$record->validatePassword($this->password))
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            else if($record->activo == 0){
                    $this->errorCode=self::ERROR_USER_BLOQUED;
            }
            else
            {
                $this->_id=$record->id;
                $this->setState('rol', $record->rol);
                $profesor = Profesor::model()->findByAttributes(array('user_id'=>$record->id));
                $profesor? $this->setState('profesor', $profesor->nombre) : $this->setState('profesor', 'Profesor');
                $this->errorCode=self::ERROR_NONE;
            }
            return $this->errorCode;
        }

        public function getId()
        {
            return $this->_id;
        }
        
}