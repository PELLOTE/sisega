<?php

class m130912_045235_modificacion_columna_evaluacion extends CDbMigration
{
	public function up()
	{
            Yii::app()->db->createCommand('ALTER TABLE `sisega`.`evaluacion` 
                CHANGE COLUMN `observacion` `observacion` TEXT NULL DEFAULT NULL;'
                )->execute();
	}

	public function down()
	{
            Yii::app()->db->createCommand('ALTER TABLE `sisega`.`evaluacion` 
                CHANGE COLUMN `observacion` `observacion` INT(11) NULL DEFAULT NULL;'
                )->execute();
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