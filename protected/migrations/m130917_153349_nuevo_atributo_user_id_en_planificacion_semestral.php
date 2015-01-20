<?php

class m130917_153349_nuevo_atributo_user_id_en_planificacion_semestral extends CDbMigration {

//	public function up()
//	{
//
//	}
//
//	public function down()
//	{
//
//	}
//	
        // Use safeUp/safeDown to do migration with transaction
        public function safeUp() {
                Yii::app()->db->createCommand('ALTER TABLE `sisega`.`planificacion_semestral` 
                        ADD COLUMN `user_id` INT(11) NULL AFTER `fecha_termino`,
                        ADD INDEX `fk_planificacion_semestral_user1_idx` (`user_id` ASC);

                        ALTER TABLE `sisega`.`planificacion_semestral` 
                        ADD CONSTRAINT `fk_planificacion_semestral_user1`
                          FOREIGN KEY (`user_id`)
                          REFERENCES `sisega`.`user` (`id`)
                          ON DELETE SET NULL
                          ON UPDATE NO ACTION;')->execute();
        }

        public function safeDown() {
                Yii::app()->db->createCommand('ALTER TABLE `sisega`.`planificacion_semestral` 
                        DROP FOREIGN KEY `fk_planificacion_semestral_user1`;

                        ALTER TABLE `sisega`.`planificacion_semestral` 
                        DROP COLUMN `user_id`,
                        DROP INDEX `fk_planificacion_semestral_user1_idx` ;')->execute();
        }

}