<?php
/**
 * This is the template for generating a controller class file for CRUD feature.
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>

class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseControllerClass; ?> {

<?php 
	$authpath = 'ext.giix.generators.giixCrud.templates.default.auth.';
	Yii::app()->controller->renderPartial($authpath . $this->authtype);
?>

	public function actionIndex() {
                $this->redirect(array('listar'));
	}

	public function actionListar() {
		$dataProvider = new CActiveDataProvider('<?php echo $this->modelClass; ?>');
		$this->render('listar', array(
			'dataProvider' => $dataProvider,
		));
	}        
        
	public function actionVer($id) {
		$this->render('ver', array(
			'model' => $this->loadModel($id, '<?php echo $this->modelClass; ?>'),
		));
	}

	public function actionCrear() {
		$model = new <?php echo $this->modelClass; ?>;

<?php if ($this->enable_ajax_validation): ?>
		$this->performAjaxValidation($model, '<?php echo $this->class2id($this->modelClass)?>-form');
<?php endif; ?>

		if (isset($_POST['<?php echo $this->modelClass; ?>'])) {
			$model->setAttributes($_POST['<?php echo $this->modelClass; ?>']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('ver', 'id' => $model-><?php echo $this->tableSchema->primaryKey; ?>));
			}
		}

		$this->render('crear', array( 'model' => $model));
	}

	public function actionActualizar($id) {
		$model = $this->loadModel($id, '<?php echo $this->modelClass; ?>');

<?php if ($this->enable_ajax_validation): ?>
		$this->performAjaxValidation($model, '<?php echo $this->class2id($this->modelClass)?>-form');
<?php endif; ?>

		if (isset($_POST['<?php echo $this->modelClass; ?>'])) {
			$model->setAttributes($_POST['<?php echo $this->modelClass; ?>']);
                        
			if ($model->save()) {
				$this->redirect(array('ver', 'id' => $model-><?php echo $this->tableSchema->primaryKey; ?>));
			}
		}

		$this->render('actualizar', array(
				'model' => $model,
				));
	}

	public function actionBorrar($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, '<?php echo $this->modelClass; ?>')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('administrar'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionAdministrar() {
                $session = new CHttpSession;
                $session->open();
		$model = new <?php echo $this->modelClass; ?>('search');
		$model->unsetAttributes();

		if (isset($_GET['<?php echo $this->modelClass; ?>'])){
			$model->setAttributes($_GET['<?php echo $this->modelClass; ?>']);
                }

                $session['<?php echo $this->modelClass; ?>_model_search'] = $model;
                
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
        
<?php $variables = ''; ?>             
<?php foreach ($this->tableSchema->columns as $column): ?>
<?php if (!$column->isForeignKey): ?>
<?php $variables .= '\'' . $column->name . '\'' . ', '; ?>
<?php else: ?>
<?php $relations = $this->findRelation($this->modelClass, $column); ?>
<?php $relationName = $relations[0]; ?>
<?php $variables .= '\'' . $relationName . '\''. ', '; ?>
<?php endif; ?>
<?php endforeach; ?>
<?php $variables = substr($variables, 0, -2); ?>
        
        public function actionGenerarExcel()
	{	   
             $session=new CHttpSession;
             $session->open();
             if(isset($session['<?php echo $this->modelClass; ?>_model_search']))
               {
                $model = $session['<?php echo $this->modelClass; ?>_model_search'];
                $model = <?php echo $this->modelClass; ?>::model()->findAll($model->search()->criteria);
               }
               else
                 $model = <?php echo $this->modelClass; ?>::model()->findAll();
             $this->toExcel($model, array(<?php echo $variables; ?>), date('Y-m-d-H-i-s'), array(), 'Excel5');
	}
        
        public function actionGenerarPdf() 
	{
             $session=new CHttpSession;
             $session->open();
             if(isset($session['<?php echo $this->modelClass; ?>_model_search']))
               {
                $model = $session['<?php echo $this->modelClass; ?>_model_search'];
                $model = <?php echo $this->modelClass; ?>::model()->findAll($model->search()->criteria);
               }
               else
                 $model = <?php echo $this->modelClass; ?>::model()->findAll();
             $this->toExcel($model, array(<?php echo $variables; ?>), date('Y-m-d-H-i-s'), array(), 'PDF');
	}

//-------------------------------------------------------------------------------------------------------------        
        
	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, '<?php echo $this->modelClass; ?>'),
		));
	}

	public function actionCreate() {
		$model = new <?php echo $this->modelClass; ?>;

<?php if ($this->enable_ajax_validation): ?>
		$this->performAjaxValidation($model, '<?php echo $this->class2id($this->modelClass)?>-form');
<?php endif; ?>

		if (isset($_POST['<?php echo $this->modelClass; ?>'])) {
			$model->setAttributes($_POST['<?php echo $this->modelClass; ?>']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model-><?php echo $this->tableSchema->primaryKey; ?>));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, '<?php echo $this->modelClass; ?>');

<?php if ($this->enable_ajax_validation): ?>
		$this->performAjaxValidation($model, '<?php echo $this->class2id($this->modelClass)?>-form');
<?php endif; ?>

		if (isset($_POST['<?php echo $this->modelClass; ?>'])) {
			$model->setAttributes($_POST['<?php echo $this->modelClass; ?>']);
                        
			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model-><?php echo $this->tableSchema->primaryKey; ?>));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, '<?php echo $this->modelClass; ?>')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

        //Index
	public function actionList() {
		$dataProvider = new CActiveDataProvider('<?php echo $this->modelClass; ?>');
                //$this->render('index', array(
		$this->render('list', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
                $session = new CHttpSession;
                $session->open();
		$model = new <?php echo $this->modelClass; ?>('search');
		$model->unsetAttributes();

		if (isset($_GET['<?php echo $this->modelClass; ?>'])){
			$model->setAttributes($_GET['<?php echo $this->modelClass; ?>']);
                }

                $session['<?php echo $this->modelClass; ?>_model_search'] = $model;
                
		$this->render('admin', array(
			'model' => $model,
		));
	}
}