<?php

class MallaController extends GxController {

        public function filters() {
                return array('rights');
        }

	public function actionIndex($id) {
                $this->layout='//layouts/column1';
                $records = Asignatura::model()->findAll();
                $asignaturas = array();
                if(count($records) > 0){
                    foreach($records as $record)
                        $asignaturas[$record->numero] = (object)$record->attributes;
                }       
		$this->render('index', array(
			'asignaturas' => $asignaturas,
                        'alumno_id'=>$id,
		));
	}
        

}