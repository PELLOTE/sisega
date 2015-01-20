<?php

Yii::import('ext.giix.generators.giixCrud._base.BaseGiixCrudCode');

class GiixCrudCode extends BaseGiixCrudCode {
        
        // Exclusivo uso con "Yiistrap"
        
        private $hasDateInput = false;
        private $hasDropDownListInput = false;
        private $hasCheckBoxSoloInput = false;
        
        public function generateInput($modelClass, $column, $search=false){
		if ($column->isForeignKey) {
                        return $this->generateDropDownListInput($modelClass, $column, $search);
		}
		if (strtoupper($column->dbType) == 'TINYINT(1)'
				|| strtoupper($column->dbType) == 'BIT'
				|| strtoupper($column->dbType) == 'BOOL'
				|| strtoupper($column->dbType) == 'BOOLEAN') {
			return $this->generateCheckBoxSoloInput($modelClass, $column, $search);
		} else if (strtoupper($column->dbType) == 'DATE') {
			return $this->generateDateInput($modelClass, $column, $search);
		} else if (stripos($column->dbType, 'TEXT') !== false
				|| stripos($column->dbType, 'BLOB') !== false) {
			return $this->generateTextAreaInput($modelClass, $column, $search);
		} else {
			$passwordI18n = Yii::t('app', 'password');
			$passwordI18n = (isset($passwordI18n) && $passwordI18n !== '') ? '|' . $passwordI18n : '';
			$pattern = '/^(password|pass|passwd|passcode' . $passwordI18n . ')$/i';
			if (preg_match($pattern, $column->name))
				$inputField = 'passwordField';
			else
				$inputField='textField';
                        if($inputField == 'passwordField'){
                                return $this->generatePasswordInput($modelClass, $column, $search);
                        }else{
                                return $this->generateTextFieldInput($modelClass, $column, $search);
                        }
		}
        }

        public function generateDropDownListInput($modelClass, $column, $search=false){
                $this->hasDropDownListInput = true;
                $relation = $this->findRelation($modelClass, $column);
                $relatedModelClass = $relation[3];
                if($search == false)
                        return "<?php echo \$form->dropDownListControlGroup(\$model,'{$column->name}', GxHtml::listDataEx({$relatedModelClass}::model()->findAllAttributes(null, true)), array('class'=>'span3 selectpicker', 'empty'=>'', 'placeholder'=> Yii::t('app', 'Select') ));?>";
                return "<?php echo \$form->dropDownListControlGroup(\$model,'{$column->name}', GxHtml::listDataEx({$relatedModelClass}::model()->findAllAttributes(null, true)), array('class'=>'span3 selectpicker', 'empty'=>'', 'placeholder'=> Yii::t('app', 'All') ));?>";
        }
        
        public function generateCheckBoxSoloInput($modelClass, $column, $search=false){
                $this->hasCheckBoxSoloInput = true;
                if($search == false)
                        return "<div class=\"control-group\">
                        <?php echo \$form->labelEx(\$model,'{$column->name}', array('class'=>'control-label')); ?>
                        <div clas=\"controls\">
                                <?php echo \$form->checkBox(\$model,'{$column->name}', array('class'=>'statuspicker')); ?>
                        </div>
                        <?php echo \$form->error(\$model,'{$column->name}'); ?>
		</div>";
                        
                return "<?php echo \$form->dropDownListControlGroup(\$model,'{$column->name}', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('class'=>'span3 selectpicker', 'empty'=>'', 'placeholder'=>  Yii::t('app', 'All'))); ?>";                
                        
        }
        
        public function generateDateInput($modelClass, $column, $search=false){
                $this->hasDateInput = true;
                return  "<?php echo \$form->textFieldControlGroup(\$model,'{$column->name}', array('span'=>3, 'class'=>'datepicker')); ?>";
        }         
        
        public function generateDateInputByName($name){
                $this->hasDateInput = true;
                return  "<?php echo \$form->textFieldControlGroup(\$model,'{$name}', array('span'=>3, 'class'=>'datepicker')); ?>";
        } 
        
        public function generateTextAreaInput($modelClass, $column, $search=false){
                return  "<?php echo \$form->textAreaControlGroup(\$model,'{$column->name}', array('span'=>3, 'rows'=>3)); ?>";
        }          
        
        public function generatePasswordInput($modelClass, $column, $search=false){
                if ($column->size === null)
                        return  "<?php echo \$form->passwordFieldControlGroup(\$model,'{$column->name}', array('span'=>3)); ?>";
                else
                        return  "<?php echo \$form->passwordFieldControlGroup(\$model,'{$column->name}', array('span'=>3, 'maxlength'=>{$column->size})); ?>";
        }   
        
        public function generateTextFieldInput($modelClass, $column, $search=false){
                if ($column->size === null)
                        return  "<?php echo \$form->textFieldControlGroup(\$model,'{$column->name}', array('span'=>3)); ?>";
                else
                        return  "<?php echo \$form->textFieldControlGroup(\$model,'{$column->name}', array('span'=>3, 'maxlength'=>{$column->size})); ?>";
        }           
        
        public function generateScripts($search = false){
                $scripts = "";
                $scripts .= $this->hasDateInput? "<?php \$this->widget('ext.datepicker.Datepicker'); ?>\n":"";
                if($this->hasCheckBoxSoloInput && !$search) $scripts .= "<?php \$this->widget('ext.switch.TbSwitch'); ?>\n";
                        else $this->hasDropDownListInput = true;
                $scripts .= $this->hasDropDownListInput? "<?php \$this->widget('ext.select2.ESelect2'); ?>\n".
                                                         "<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/buttonReset.js', CClientScript::POS_END); ?>\n":"";
                //Scripts especiales
                $scripts .= !$search? "<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/buttonStateful.js', CClientScript::POS_END); ?>\n":"";
                
                return $scripts;
        }
        
	public function generateDetailViewAttribute($modelClass, $column, $view='view') {
		if (!$column->isForeignKey) {
			if (strtoupper($column->dbType) == 'TINYINT(1)'
					|| strtoupper($column->dbType) == 'BIT'
					|| strtoupper($column->dbType) == 'BOOL'
					|| strtoupper($column->dbType) == 'BOOLEAN') {
				return "'{$column->name}:boolean'";
			} else
				return "'{$column->name}'";
		} else {
			// Find the relation name for this column.
			$relation = $this->findRelation($modelClass, $column);
			$relationName = $relation[0];
			$relatedModelClass = $relation[3];
			$relatedControllerName = strtolower($relatedModelClass[0]) . substr($relatedModelClass, 1);

			return "array(
			'name' => '{$relationName}',
			'type' => 'raw',
			'value' => \$model->{$relationName} !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx(\$model->{$relationName})), array('{$relatedControllerName}/{$view}', 'id' => GxActiveRecord::extractPkValue(\$model->{$relationName}, true))) : null,
			)";
		}
	}
        
/* *********************************************************************************************** */        
        
	public function generateActiveField($modelClass, $column) {
		if ($column->isForeignKey) {
			$relation = $this->findRelation($modelClass, $column);
			$relatedModelClass = $relation[3];
			return "echo \$form->dropDownList(\$model, '{$column->name}', GxHtml::listDataEx({$relatedModelClass}::model()->findAllAttributes(null, true)))";
		}

		if (strtoupper($column->dbType) == 'TINYINT(1)'
				|| strtoupper($column->dbType) == 'BIT'
				|| strtoupper($column->dbType) == 'BOOL'
				|| strtoupper($column->dbType) == 'BOOLEAN') {
			return "echo \$form->checkBox(\$model, '{$column->name}')";
		} else if (strtoupper($column->dbType) == 'DATE') {
			return "\$form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => \$model,
			'attribute' => '{$column->name}',
			'value' => \$model->{$column->name},
                        'language' => Yii::app()->language,    
			'options' => array(
				'showButtonPanel' => true,
                                'changeMonth' => true,
				'changeYear' => true,
				'dateFormat' => Yii::app()->locale->dateFormat,
				),
			));\n";
		} else if (stripos($column->dbType, 'text') !== false) { // Start of CrudCode::generateActiveField code.
			return "echo \$form->textArea(\$model, '{$column->name}')";
		} else {
			$passwordI18n = Yii::t('app', 'password');
			$passwordI18n = (isset($passwordI18n) && $passwordI18n !== '') ? '|' . $passwordI18n : '';
			$pattern = '/^(password|pass|passwd|passcode' . $passwordI18n . ')$/i';
			if (preg_match($pattern, $column->name))
				$inputField = 'passwordField';
			else
				$inputField='textField';

			if ($column->type !== 'string' || $column->size === null)
				return "echo \$form->{$inputField}(\$model, '{$column->name}')";
			else
				return "echo \$form->{$inputField}(\$model, '{$column->name}', array('maxlength' => {$column->size}))";
		} // End of CrudCode::generateActiveField code.
	}
        
 	public function generateActiveFieldCalendar($name) {
			return "\$form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => \$model,
			'attribute' => '{$name}',
			'value' => \$model->{$name},
                        'language' => Yii::app()->language,    
			'options' => array(
				'showButtonPanel' => true,
                                'changeMonth' => true,
				'changeYear' => true,
				'dateFormat' => Yii::app()->locale->dateFormat,
				),
			));\n";
	}  
        
	public function generateGridViewColumn($modelClass, $column) {
		if (!$column->isForeignKey) {
			// Boolean or bit.
			if (strtoupper($column->dbType) == 'TINYINT(1)'
					|| strtoupper($column->dbType) == 'BIT'
					|| strtoupper($column->dbType) == 'BOOL'
					|| strtoupper($column->dbType) == 'BOOLEAN') {
				return "array(
					'name' => '{$column->name}',
					'value' => '(\$data->{$column->name} == 0) ? Yii::t(\\'app\\', \\'No\\') : Yii::t(\\'app\\', \\'Yes\\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					)";
			} else // Common column.
				return "'{$column->name}'";
		} else { // FK.
			// Find the related model for this column.
			$relation = $this->findRelation($modelClass, $column);
			$relationName = $relation[0];
			$relatedModelClass = $relation[3];
			return "array(
				'name'=>'{$column->name}',
				'value'=>'GxHtml::valueEx(\$data->{$relationName})',
				'filter'=>GxHtml::listDataEx({$relatedModelClass}::model()->findAllAttributes(null, true)),
				)";
		}
	}
        
	public function generateSearchField($modelClass, $column) {
		if (!$column->isForeignKey) {
			// Boolean or bit.
			if (strtoupper($column->dbType) == 'TINYINT(1)'
					|| strtoupper($column->dbType) == 'BIT'
					|| strtoupper($column->dbType) == 'BOOL'
					|| strtoupper($column->dbType) == 'BOOLEAN')
				return "echo \$form->dropDownList(\$model, '{$column->name}', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All')))";
			else // Common column. generateActiveField method will add 'echo' when necessary.
				return $this->generateActiveField($this->modelClass, $column);
		} else { // FK.
			// Find the related model for this column.
			$relation = $this->findRelation($modelClass, $column);
			$relatedModelClass = $relation[3];
			return "echo \$form->dropDownList(\$model, '{$column->name}', GxHtml::listDataEx({$relatedModelClass}::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All')))";
		}
	}

}