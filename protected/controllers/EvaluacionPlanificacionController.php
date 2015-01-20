<?php

class EvaluacionPlanificacionController extends GxController {

    
    public function actionVerPlanificacionPropuesta(){
        if(PlanificacionSemestral::cargarPlanificacion() != FALSE){
            $model_planificacion_semestral = PlanificacionSemestral::cargarPlanificacion();   
            $model_actividad = new Actividad($model_planificacion_semestral->id);
            $model_actividades_planificacion = $model_actividad->misActividades($model_planificacion_semestral->id);
            $estado = TRUE;

            if($model_planificacion_semestral->estado == "VIGENTE" OR $model_planificacion_semestral->estado == "RECHAZADA"){
                 $estado = FALSE;
            }
            $this->render('ver_planificacion_propuesta', array(
                        'model_planificacion_semestral' => $model_planificacion_semestral, 
                        'model_actividades_planificacion' => $model_actividades_planificacion,
                        'estado' => $estado,
            )); 
        }else{
            Yii::app()->getUser()->setFlash('info','<i class="icon-exclamation-sign"></i> No hay planificaciones semestrales propuestas para evaluar.');
            throw new CHttpException(401, Yii::t('app', 'No hay planificaciones semestrales propuestas para evaluar.'));
        }
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
        $this->redirect(array('verPlanificacionPropuesta'));
    }
    
    public function actionRechazarPlanificacion($id){
        $user_id = Yii::app()->user->id;
        
        $model_planificacion = $this->loadModel($id, 'PlanificacionSemestral');
        $model_planificacion->estado = "RECHAZADA";
        $model_planificacion->fecha_respuesta = date("d/m/Y");
        $model_planificacion->user_id = $user_id;

        $model_planificacion->save(FALSE);
        $this->redirect(array('verPlanificacionPropuesta'));
    }
}
