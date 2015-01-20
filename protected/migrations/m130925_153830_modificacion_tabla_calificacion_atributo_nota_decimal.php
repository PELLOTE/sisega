<?php

class m130925_153830_modificacion_tabla_calificacion_atributo_nota_decimal extends CDbMigration
{
	public function up()
	{
            Yii::app()->db->createCommand(
                        'ALTER TABLE `sisega`.`calificacion` 
                        CHANGE COLUMN `nota` `nota` DOUBLE(4,2) NULL DEFAULT NULL;'
                )->execute();
	}

	public function down()
	{
            Yii::app()->db->createCommand(
                        'ALTER TABLE `sisega`.`calificacion` 
                        CHANGE COLUMN `nota` `nota` INT(11) NULL DEFAULT NULL;'
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