<?php

class m131023_140913_modificacion_tabla_asignatura_y_nueva_tabla_prerequisitos extends CDbMigration
{
//	public function up()
//	{
//	}
//
//	public function down()
//	{
//		echo "m131023_140913_modificacion_tabla_asignatura_y_nueva_tabla_prerequisitos does not support migration down.\n";
//		return false;
//	}

	
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
            Yii::app()->db->createCommand('ALTER TABLE `sisega`.`asignatura` 
CHANGE COLUMN `nombre` `nombre` VARCHAR(255) NULL DEFAULT NULL ,
CHANGE COLUMN `semestre` `semestre` INT(3) NULL DEFAULT NULL ,
ADD COLUMN `codigo` VARCHAR(45) NULL DEFAULT NULL AFTER `programa`,
ADD COLUMN `numero` INT(3) NULL DEFAULT NULL AFTER `codigo`,
ADD COLUMN `catedra` INT(3) NULL DEFAULT NULL AFTER `numero`,
ADD COLUMN `taller` INT(3) NULL DEFAULT NULL AFTER `catedra`,
ADD COLUMN `laboratorio` INT(3) NULL DEFAULT NULL AFTER `taller`,
ADD COLUMN `tipo_formacion` VARCHAR(100) NULL DEFAULT NULL AFTER `laboratorio`;

CREATE TABLE IF NOT EXISTS `sisega`.`asignatura_prerequisito` (
  `asignatura_id` INT(11) NOT NULL,
  `prerequisito_asignatura_id` INT(11) NOT NULL,
  PRIMARY KEY (`asignatura_id`, `prerequisito_asignatura_id`),
  INDEX `fk_asignatura_has_asignatura_asignatura2_idx` (`prerequisito_asignatura_id` ASC),
  INDEX `fk_asignatura_has_asignatura_asignatura1_idx` (`asignatura_id` ASC),
  CONSTRAINT `fk_asignatura_has_asignatura_asignatura1`
    FOREIGN KEY (`asignatura_id`)
    REFERENCES `sisega`.`asignatura` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_asignatura_has_asignatura_asignatura2`
    FOREIGN KEY (`prerequisito_asignatura_id`)
    REFERENCES `sisega`.`asignatura` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

ALTER TABLE `sisega`.`curso` 
                        ADD COLUMN `posicion` INT(3) NULL DEFAULT NULL;
'
                )->execute();
	}

	public function safeDown()
	{
		echo "m131023_140913_modificacion_tabla_asignatura_y_nueva_tabla_prerequisitos does not support migration down.\n";
		return false;
	}
	
}