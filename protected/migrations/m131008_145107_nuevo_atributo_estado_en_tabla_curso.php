<?php

class m131008_145107_nuevo_atributo_estado_en_tabla_curso extends CDbMigration
{
	public function up()
	{
            Yii::app()->db->createCommand('ALTER TABLE `sisega`.`curso` 
                        ADD COLUMN `estado` VARCHAR(255) NULL DEFAULT NULL;'
                )->execute();
	}

	public function down()
	{
            Yii::app()->db->createCommand('ALTER TABLE `sisega`.`evaluacion` 
                        DROP COLUMN `estado`;'
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