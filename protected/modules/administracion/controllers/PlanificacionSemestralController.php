<?php


class PlanificacionSemestralController extends GxController {

        
        public function actionVerPlanificaciones(){
           
                $model_planificacion = new PlanificacionSemestral('search');
                $model_planificacion->unsetAttributes();
                $tipo = "Planificacion";
                if (isset($_GET['PlanificacionSemestral'])){
			$model_planificacion->setAttributes($_GET['PlanificacionSemestral']);
                }
                $this->render('planificacionSemestral/ver_planificaciones', array(
			'model_planificacion' => $model_planificacion,
                        'tipo' => $tipo,
		));
        }
    
        public function actionCrearPlanificacion(){
            $rango_fecha = CalendarioDocente::obtenerRangoFechas();
            $model_planificacion = new PlanificacionSemestral;
            $model_planificacion->fecha_creacion = date("d/m/Y");
            $model_planificacion->calendario_docente_id = $rango_fecha[2];
            $user_id = Yii::app()->user->id;
            
            
            $this->performAjaxValidation($model_planificacion, 'planificacion-semestral-form');

            if (isset($_POST['PlanificacionSemestral'])) {
                $model_planificacion->setAttributes($_POST['PlanificacionSemestral']);
                $model_planificacion->estado = 'NUEVA'; 
                $rango_semestre = CalendarioDocente::obtenerRangoSemestre($model_planificacion->semestre);
                $model_planificacion->fecha_inicio=$rango_semestre[0];
                $model_planificacion->fecha_termino=$rango_semestre[1];
                $model_planificacion->user_id = $user_id;
                if ($this->validarFechasPlanificacionSemestral($model_planificacion) && $model_planificacion->save()) {
                        $model_planificacion->generarActividades(); 
                    if (Yii::app()->getRequest()->getIsAjaxRequest())
                                Yii::app()->end();
                        else
                                $this->redirect(array('verPlanificacion', 'id' => $model_planificacion->id));
                }
            }
            
		$this->render('planificacionSemestral/crear_planificacion_semestral',array( 
                            'model_planificacion' => $model_planificacion,
                            'rango_fecha' => $rango_fecha,
                        ));
         
       }
        
        public function actionEditarPlanificacion($id){
            $user_id = Yii::app()->user->id;
            $rango_fecha = CalendarioDocente::obtenerRangoFechas();
            $model_planificacion = $this->loadModel($id, 'PlanificacionSemestral');

            $this->performAjaxValidation($model_planificacion, 'planificacion-semestral-form');

            if (isset($_POST['PlanificacionSemestral'])){
                    $model_planificacion->setAttributes($_POST['PlanificacionSemestral']);
                    $model_planificacion->user_id = $user_id;
                    if ($this->validarFechasPlanificacionSemestral($model_planificacion) && $model_planificacion->save()) {
                            $this->redirect(array('verPlanificacion', 'id' => $model_planificacion->id));
                    }
            }
            $this->render('planificacionSemestral/editar_planificacion_semestral', array(
                            'model_planificacion' => $model_planificacion,
                            'rango_fecha' => $rango_fecha
            ));
        }
        
        public function actionVerPlanificacion($id){
            $model_actividad = new Actividad();
            $model_actividad_planificacion = $model_actividad->misActividades($id);
            $model = $this->loadModel($id, 'PlanificacionSemestral');
            $propuesto = TRUE;
            
            if($model->estado == "PROPUESTA")
                $propuesto = FALSE;
                
            $this->render('planificacionSemestral/ver_planificacion_semestral', array(
                    'model' => $model, 
                    'model_actividad_planificacion' => $model_actividad_planificacion,
                    'propuesto' => $propuesto,
            ));
	}
    
        public function actionVerActividades(){
            $model_actividad = new Actividad('search');
            $model_actividad->unsetAttributes();
            $tipo = "Actividad";

		if (isset($_GET['Actividad'])){
			$model_actividad->setAttributes($_GET['Actividad']);
                }
            $this->render('actividad/ver_actividades', array(
                    'model_actividad' => $model_actividad,
                    'tipo' => $tipo,
            ));
        }
        
        public function actionCrearActividad($id){
            $model_planificacion = $this->loadModel($id, 'PlanificacionSemestral');
            $model_actividad = new Actividad;
            $model_actividad->planificacion_semestral_id = $model_planificacion->id;
            $rango_fechas = CalendarioDocente::obtenerRangoFechas();
            $this->performAjaxValidation($model_actividad, 'actividad-form');
            if (isset($_POST['Actividad'])) {
                $model_actividad->setAttributes($_POST['Actividad']);
                if ($this->validarFechas($model_actividad, $model_planificacion) && $model_actividad->save()){
                        if (Yii::app()->getRequest()->getIsAjaxRequest())
                                Yii::app()->end();
                        else
                                $this->redirect(array('planificacionSemestral/verPlanificacion', 'id' => $model_planificacion->id));
                }
            }
            $this->render('actividad/crear_actividad', array( 
                'model_actividad' => $model_actividad,
                'model_planificacion' => $model_planificacion,
                'rango_fechas'=>$rango_fechas,
                ));
        }
        
        public function actionEditarActividad($id){
            $model_actividad = $this->loadModel($id, 'Actividad');
            $model_planificacion = $this->loadModel($model_actividad->planificacion_semestral_id, 'PlanificacionSemestral');
            $this->performAjaxValidation($model_actividad, 'actividad-form');
            if (isset($_POST['Actividad'])) {
                    $model_actividad->setAttributes($_POST['Actividad']);
                    if ($this->validarFechas($model_actividad, $model_planificacion) && $model_actividad->save()) {
                            $this->redirect(array('planificacionSemestral/verPlanificacion', 'id' => $model_planificacion->id));
                    }
            }

            $this->render('actividad/editar_actividad', array(
                            'model_actividad' => $model_actividad,
                            'model_planificacion' => $model_planificacion,
                            ));
        }
        
        public function actionVerActividad($id){
            $this->render('actividad/ver_actividad', array(
			'model' => $this->loadModel($id, 'Actividad'), 
                ));
        }
        
        public function filters() {
            return array('rights');
        }
        public function behaviors()
        {
            return array(
                'eexcelview'=>array(
                    'class'=>'ext.eexcelview.EExcelBehavior',
                ),
            );
        }
        
        private function validarFechas($model, $model_planificacion_semestral){
        $error = false;
        if(!Yii::app()->utilidad->compararRangoFechas($model->fecha_inicio, $model_planificacion_semestral->fecha_inicio, '>=')
                or !Yii::app()->utilidad->compararRangoFechas($model->fecha_inicio, $model_planificacion_semestral->fecha_termino, '<=')){
                $model->addError('fecha_inicio', Yii::t('app', 'La fecha de inicio no concuerda con la fecha de inicio de la planificación semestral'));
                $error = true;
        }
        if(!Yii::app()->utilidad->compararRangoFechas($model->fecha_inicio, $model->fecha_termino, '<=')){
                $model->addError('fecha_termino', Yii::t('app', 'La fecha de termino es inferior a la fecha de inicio'));
                $error = true;
        }else{                      
        if(!Yii::app()->utilidad->compararRangoFechas($model->fecha_termino, $model_planificacion_semestral->fecha_termino, '<=')
                or !Yii::app()->utilidad->compararRangoFechas($model->fecha_termino, $model_planificacion_semestral->fecha_inicio, '>=')){
                $model->addError('fecha_termino', Yii::t('app', 'La fecha de termino no concuerda con la fecha de termino de la planificación semestral'));
                $error = true;                                
        }}
        return !$error;
        }
        
        private function validarFechasPlanificacionSemestral($model){
        $error = false;
            if(!Yii::app()->utilidad->compararRangoFechas($model->fecha_inicio, $model->fecha_termino, '!=')){
                    $model->addError('fecha_termino', Yii::t('app', 'Las fechas no pueden ser iguales'));
                    $error = true;
            }
            if(!Yii::app()->utilidad->compararRangoFechas($model->fecha_inicio, $model->fecha_termino, '<=')){
                    $model->addError('fecha_termino', Yii::t('app', 'La fecha de termino es inferior a la fecha de inicio'));
                    $error = true;
            }
            
            
            return !$error;
        }
        
        public function actionGenerarExcel($tipo)
	{	   
             
             $session=new CHttpSession;
             $session->open();
             if($tipo == "Planificacion"){
               if(isset($session['PlanificacionSemestral_model_search'])){
                   $model = $session['PlanificacionSemestral_model_search'];
                   $model = PlanificacionSemestral::model()->findAll($model->search()->criteria);
               }
               else
                 $model = PlanificacionSemestral::model()->findAll();
               $this->toExcel($model, array('id', 'calendarioDocente', 'fecha_creacion', 'fecha_proposicion', 'fecha_respuesta', 'estado', 'fecha_inicio', 'fecha_termino'), date('Y-m-d-H-i-s'), array(), 'Excel5');
                
             }else if($tipo == "Actividad"){
               if(isset($session['Actividad_model_search'])){
                   $model = $session['Actividad_model_search'];
                   $model = Actividad::model()->findAll($model->search()->criteria);
               }
               else
                 $model = Actividad::model()->findAll();
               $this->toExcel($model, array('id', 'planificacionSemestral', 'fecha_inicio', 'fecha_termino', 'detalle'), date('Y-m-d-H-i-s'), array(), 'Excel5'); 
                 
             }
             
	}
        
        public function actionBorrarActividad($id) {
                $model_actividad = $this->loadModel($id, 'Actividad');
                $planificacion_semestral = $model_actividad->planificacion_semestral_id;
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$model_actividad->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('verPlanificacion', 'id'=>$planificacion_semestral));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}
                
        public function actionProponerPlanificacion($id){
            $model_planificacion = $this->loadModel($id, 'PlanificacionSemestral');
            $model_planificacion->estado = "PROPUESTA";
            $model_planificacion->fecha_proposicion = date("d/m/Y");
            $model_planificacion->user_id = Yii::app()->user->id;
            
            $model_planificacion->save(FALSE);
            $this->redirect(array('verPlanificacion', 'id' => $model_planificacion->id));
            
        }
        
        public function actionAceptarPlanificacion($id){
            $user_id = Yii::app()->user->id;

            $model_planificacion = $this->loadModel($id, 'PlanificacionSemestral');
            $semestre = $model_planificacion->semestre;

            if(!$model = PlanificacionSemestral::model()->vigentes()->semestre($semestre)->findAll()){
                $model_planificacion->estado = "VIGENTE";
                $model_planificacion->fecha_respuesta = date("d/m/Y");
                $model_planificacion->user_id = $user_id;
                $model_planificacion->save(TRUE);
                Yii::app()->getUser()->setFlash('success','<i class="icon-ok"></i> La planificacion semestral ha entrado en funcionamiento. ');  
            }else{
                Yii::app()->getUser()->setFlash('error','<i class="icon-remove"></i> No se puede validar la planificacion semestral, proque ya existe una planificacion en funcionamiento.');
            }
            $this->redirect(array('verPlanificacion', 'id'=>$id));
        }
        
        public function actionRechazarPlanificacion($id){
            $user_id = Yii::app()->user->id;

            $model_planificacion = $this->loadModel($id, 'PlanificacionSemestral');
            $model_planificacion->estado = "RECHAZADA";
            $model_planificacion->fecha_respuesta = date("d/m/Y");
            $model_planificacion->user_id = $user_id;

            $model_planificacion->save(FALSE);
            $this->redirect(array('verPlanificacion', 'id'=>$id));
        }
        
        public function actionActivarPlanificacion($id){
            $user_id = Yii::app()->user->id;

            $model_planificacion = $this->loadModel($id, 'PlanificacionSemestral');
            $semestre = $model_planificacion->semestre;

            if(!$model = PlanificacionSemestral::model()->vigentes()->semestre($semestre)->findAll()){
                $model_planificacion->estado = "NUEVO";
                $model_planificacion->user_id = $user_id;
                $model_planificacion->save(TRUE);
                Yii::app()->getUser()->setFlash('success','<i class="icon-ok"></i> La planificacion semestral ha cambiado de estado a <b>NUEVO</b>. ');  
            }else{
                Yii::app()->getUser()->setFlash('error','<i class="icon-remove"></i> No se puede validar la planificación semestral, porque ya existe una planificacion en funcionamiento.');
            }
            $this->redirect(array('verPlanificacion', 'id'=>$id));
        }
        
        public function actionFinalizarPlanificacion($id){
            $model_planificacion = $this->loadModel($id, 'PlanificacionSemestral');
            $model_planificacion->estado = "FINALIZADO";
            $model_planificacion->user_id = Yii::app()->user->id;
            $model_planificacion->save(TRUE);
            $this->redirect(array('verPlanificacion', 'id' => $model_planificacion->id));
            
        }
}