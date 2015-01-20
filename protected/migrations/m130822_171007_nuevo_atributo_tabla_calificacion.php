<?php

class m130822_171007_nuevo_atributo_tabla_calificacion extends CDbMigration
{
	public function up()
	{
            Yii::app()->db->createCommand('
            ALTER TABLE `sisega`.`calificacion` ADD COLUMN `curso_id` INT NULL  AFTER `evaluacion_id` , 
              ADD CONSTRAINT `fk_calificacion_curso1`
              FOREIGN KEY (`curso_id` )
              REFERENCES `sisega`.`curso` (`id` )
              ON DELETE NO ACTION
              ON UPDATE NO ACTION
            , ADD INDEX `fk_calificacion_curso1` (`curso_id` ASC);')->execute();
	}

	public function down()
	{
                Yii::app()->db->createCommand('ALTER TABLE `sisega`.`calificacion` DROP FOREIGN KEY `fk_calificacion_curso1` 
                        ALTER TABLE `sisega`.`calificacion` DROP COLUMN `curso_id` , DROP FOREIGN KEY `fk_calificacion_evaluacion1` 
                        ALTER TABLE `sisega`.`calificacion` 
                          ADD CONSTRAINT `fk_calificacion_evaluacion1`
                          FOREIGN KEY (`evaluacion_id` )
                          REFERENCES `sisega`.`evaluacion` (`id` )
                          ON DELETE NO ACTION
                          ON UPDATE NO ACTION
                        , DROP INDEX `fk_calificacion_curso1`;');
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