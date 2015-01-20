<?php

class m130919_063458_nuevo_atributo_tabla_evaluacion_nombre extends CDbMigration
{
	public function up()
	{
            Yii::app()->db->createCommand('ALTER TABLE `sisega`.`evaluacion` 
                        ADD COLUMN `nombre` VARCHAR(255) NULL DEFAULT NULL AFTER `fecha`;'
                )->execute();

	}

	public function down()
	{
                $this->dropColumn('evaluacion', 'nombre');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}