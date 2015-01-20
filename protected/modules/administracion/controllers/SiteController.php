<?php

class SiteController extends GxController
{
        public function filters() {
                return array('rights');
        }
        

        public function allowedActions() {
            return 'error';
        }        
        
	public function actionIndex()
	{
                $this->layout='//layouts/column1';
		$this->render('index');
	}
        
	public function actionError()
	{
                $this->layout='//layouts/column1';
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}