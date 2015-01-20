<?php

class m130916_150238_modificacion_bd_constraint_todos_on_delete_cascade extends CDbMigration {

//	public function up()
//	{
//	}
//
//	public function down()
//	{
//		echo "m130916_150238_modificacion_bd_constraint_todos_on_delete_cascade does not support migration down.\n";
//		return false;
//	}
        // Use safeUp/safeDown to do migration with transaction
        public function safeUp() {
                Yii::app()->db->createCommand("
                        SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                        SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                        SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

                        ALTER TABLE `sisega`.`actividad` 
                        DROP FOREIGN KEY `fk_actividad_planificacion_semestral1`;

                        ALTER TABLE `sisega`.`calificacion` 
                        DROP FOREIGN KEY `fk_calificacion_alumno1`,
                        DROP FOREIGN KEY `fk_calificacion_curso1`,
                        DROP FOREIGN KEY `fk_calificacion_evaluacion1`;

                        ALTER TABLE `sisega`.`curso` 
                        DROP FOREIGN KEY `fk_curso_asignatura1`,
                        DROP FOREIGN KEY `fk_curso_profesor1`;

                        ALTER TABLE `sisega`.`curso_tiene_alumno` 
                        DROP FOREIGN KEY `fk_curso_has_alumno_alumno1`,
                        DROP FOREIGN KEY `fk_curso_has_alumno_curso1`;

                        ALTER TABLE `sisega`.`evaluacion` 
                        DROP FOREIGN KEY `fk_evaluacion_curso1`;

                        ALTER TABLE `sisega`.`evaluacion_semestral` 
                        DROP FOREIGN KEY `fk_evaluacion_semestral_alumno1`;

                        ALTER TABLE `sisega`.`plan_actividad` 
                        DROP FOREIGN KEY `fk_plan_actividad_curso1`,
                        DROP FOREIGN KEY `fk_plan_actividad_planificacion_semestral1`;

                        ALTER TABLE `sisega`.`planificacion_semestral` 
                        DROP FOREIGN KEY `fk_planificacion_semestral_calendario_docente1`;

                        ALTER TABLE `sisega`.`actividad` 
                        ADD CONSTRAINT `fk_actividad_planificacion_semestral1`
                          FOREIGN KEY (`planificacion_semestral_id`)
                          REFERENCES `sisega`.`planificacion_semestral` (`id`)
                          ON DELETE CASCADE
                          ON UPDATE NO ACTION;

                        ALTER TABLE `sisega`.`calificacion` 
                        ADD CONSTRAINT `fk_calificacion_alumno1`
                          FOREIGN KEY (`alumno_id`)
                          REFERENCES `sisega`.`alumno` (`id`)
                          ON DELETE CASCADE
                          ON UPDATE NO ACTION,
                        ADD CONSTRAINT `fk_calificacion_curso1`
                          FOREIGN KEY (`curso_id`)
                          REFERENCES `sisega`.`curso` (`id`)
                          ON DELETE CASCADE
                          ON UPDATE NO ACTION,
                        ADD CONSTRAINT `fk_calificacion_evaluacion1`
                          FOREIGN KEY (`evaluacion_id`)
                          REFERENCES `sisega`.`evaluacion` (`id`)
                          ON DELETE CASCADE
                          ON UPDATE NO ACTION;

                        ALTER TABLE `sisega`.`curso` 
                        ADD CONSTRAINT `fk_curso_asignatura1`
                          FOREIGN KEY (`asignatura_id`)
                          REFERENCES `sisega`.`asignatura` (`id`)
                          ON DELETE CASCADE
                          ON UPDATE NO ACTION,
                        ADD CONSTRAINT `fk_curso_profesor1`
                          FOREIGN KEY (`profesor_id`)
                          REFERENCES `sisega`.`profesor` (`id`)
                          ON DELETE CASCADE
                          ON UPDATE NO ACTION;

                        ALTER TABLE `sisega`.`curso_tiene_alumno` 
                        ADD CONSTRAINT `fk_curso_has_alumno_alumno1`
                          FOREIGN KEY (`alumno_id`)
                          REFERENCES `sisega`.`alumno` (`id`)
                          ON DELETE CASCADE
                          ON UPDATE NO ACTION,
                        ADD CONSTRAINT `fk_curso_has_alumno_curso1`
                          FOREIGN KEY (`curso_id`)
                          REFERENCES `sisega`.`curso` (`id`)
                          ON DELETE CASCADE
                          ON UPDATE NO ACTION;

                        ALTER TABLE `sisega`.`evaluacion` 
                        ADD CONSTRAINT `fk_evaluacion_curso1`
                          FOREIGN KEY (`curso_id`)
                          REFERENCES `sisega`.`curso` (`id`)
                          ON DELETE CASCADE
                          ON UPDATE NO ACTION;

                        ALTER TABLE `sisega`.`evaluacion_semestral` 
                        ADD CONSTRAINT `fk_evaluacion_semestral_alumno1`
                          FOREIGN KEY (`alumno_id`)
                          REFERENCES `sisega`.`alumno` (`id`)
                          ON DELETE CASCADE
                          ON UPDATE NO ACTION;

                        ALTER TABLE `sisega`.`plan_actividad` 
                        ADD CONSTRAINT `fk_plan_actividad_curso1`
                          FOREIGN KEY (`curso_id`)
                          REFERENCES `sisega`.`curso` (`id`)
                          ON DELETE CASCADE
                          ON UPDATE NO ACTION,
                        ADD CONSTRAINT `fk_plan_actividad_planificacion_semestral1`
                          FOREIGN KEY (`planificacion_semestral_id`)
                          REFERENCES `sisega`.`planificacion_semestral` (`id`)
                          ON DELETE CASCADE
                          ON UPDATE NO ACTION;

                        ALTER TABLE `sisega`.`planificacion_semestral` 
                        ADD CONSTRAINT `fk_planificacion_semestral_calendario_docente1`
                          FOREIGN KEY (`calendario_docente_id`)
                          REFERENCES `sisega`.`calendario_docente` (`id`)
                          ON DELETE CASCADE
                          ON UPDATE NO ACTION;


                        SET SQL_MODE=@OLD_SQL_MODE;
                        SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                        SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
                        "
                )->execute();
        }

        public function safeDown() {
                Yii::app()->db->createCommand("
                        SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                        SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                        SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

                        ALTER TABLE `sisega`.`actividad` 
                        DROP FOREIGN KEY `fk_actividad_planificacion_semestral1`;

                        ALTER TABLE `sisega`.`calificacion` 
                        DROP FOREIGN KEY `fk_calificacion_alumno1`,
                        DROP FOREIGN KEY `fk_calificacion_curso1`,
                        DROP FOREIGN KEY `fk_calificacion_evaluacion1`;

                        ALTER TABLE `sisega`.`curso` 
                        DROP FOREIGN KEY `fk_curso_asignatura1`,
                        DROP FOREIGN KEY `fk_curso_profesor1`;

                        ALTER TABLE `sisega`.`curso_tiene_alumno` 
                        DROP FOREIGN KEY `fk_curso_has_alumno_alumno1`,
                        DROP FOREIGN KEY `fk_curso_has_alumno_curso1`;

                        ALTER TABLE `sisega`.`evaluacion` 
                        DROP FOREIGN KEY `fk_evaluacion_curso1`;

                        ALTER TABLE `sisega`.`evaluacion_semestral` 
                        DROP FOREIGN KEY `fk_evaluacion_semestral_alumno1`;

                        ALTER TABLE `sisega`.`plan_actividad` 
                        DROP FOREIGN KEY `fk_plan_actividad_curso1`,
                        DROP FOREIGN KEY `fk_plan_actividad_planificacion_semestral1`;

                        ALTER TABLE `sisega`.`planificacion_semestral` 
                        DROP FOREIGN KEY `fk_planificacion_semestral_calendario_docente1`;

                        ALTER TABLE `sisega`.`actividad` 
                        ADD CONSTRAINT `fk_actividad_planificacion_semestral1`
                          FOREIGN KEY (`planificacion_semestral_id`)
                          REFERENCES `sisega`.`planificacion_semestral` (`id`)
                          ON DELETE NO ACTION
                          ON UPDATE NO ACTION;

                        ALTER TABLE `sisega`.`calificacion` 
                        ADD CONSTRAINT `fk_calificacion_alumno1`
                          FOREIGN KEY (`alumno_id`)
                          REFERENCES `sisega`.`alumno` (`id`)
                          ON DELETE NO ACTION
                          ON UPDATE NO ACTION,
                        ADD CONSTRAINT `fk_calificacion_curso1`
                          FOREIGN KEY (`curso_id`)
                          REFERENCES `sisega`.`curso` (`id`)
                          ON DELETE NO ACTION
                          ON UPDATE NO ACTION,
                        ADD CONSTRAINT `fk_calificacion_evaluacion1`
                          FOREIGN KEY (`evaluacion_id`)
                          REFERENCES `sisega`.`evaluacion` (`id`)
                          ON DELETE NO ACTION
                          ON UPDATE NO ACTION;

                        ALTER TABLE `sisega`.`curso` 
                        ADD CONSTRAINT `fk_curso_asignatura1`
                          FOREIGN KEY (`asignatura_id`)
                          REFERENCES `sisega`.`asignatura` (`id`)
                          ON DELETE NO ACTION
                          ON UPDATE NO ACTION,
                        ADD CONSTRAINT `fk_curso_profesor1`
                          FOREIGN KEY (`profesor_id`)
                          REFERENCES `sisega`.`profesor` (`id`)
                          ON DELETE NO ACTION
                          ON UPDATE NO ACTION;

                        ALTER TABLE `sisega`.`curso_tiene_alumno` 
                        ADD CONSTRAINT `fk_curso_has_alumno_alumno1`
                          FOREIGN KEY (`alumno_id`)
                          REFERENCES `sisega`.`alumno` (`id`)
                          ON DELETE NO ACTION
                          ON UPDATE NO ACTION,
                        ADD CONSTRAINT `fk_curso_has_alumno_curso1`
                          FOREIGN KEY (`curso_id`)
                          REFERENCES `sisega`.`curso` (`id`)
                          ON DELETE NO ACTION
                          ON UPDATE NO ACTION;

                        ALTER TABLE `sisega`.`evaluacion` 
                        ADD CONSTRAINT `fk_evaluacion_curso1`
                          FOREIGN KEY (`curso_id`)
                          REFERENCES `sisega`.`curso` (`id`)
                          ON DELETE NO ACTION
                          ON UPDATE NO ACTION;

                        ALTER TABLE `sisega`.`evaluacion_semestral` 
                        ADD CONSTRAINT `fk_evaluacion_semestral_alumno1`
                          FOREIGN KEY (`alumno_id`)
                          REFERENCES `sisega`.`alumno` (`id`)
                          ON DELETE NO ACTION
                          ON UPDATE NO ACTION;

                        ALTER TABLE `sisega`.`plan_actividad` 
                        ADD CONSTRAINT `fk_plan_actividad_curso1`
                          FOREIGN KEY (`curso_id`)
                          REFERENCES `sisega`.`curso` (`id`)
                          ON DELETE NO ACTION
                          ON UPDATE NO ACTION,
                        ADD CONSTRAINT `fk_plan_actividad_planificacion_semestral1`
                          FOREIGN KEY (`planificacion_semestral_id`)
                          REFERENCES `sisega`.`planificacion_semestral` (`id`)
                          ON DELETE NO ACTION
                          ON UPDATE NO ACTION;

                        ALTER TABLE `sisega`.`planificacion_semestral` 
                        ADD CONSTRAINT `fk_planificacion_semestral_calendario_docente1`
                          FOREIGN KEY (`calendario_docente_id`)
                          REFERENCES `sisega`.`calendario_docente` (`id`)
                          ON DELETE NO ACTION
                          ON UPDATE NO ACTION;


                        SET SQL_MODE=@OLD_SQL_MODE;
                        SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                        SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
                        "
                )->execute();          
        }

}