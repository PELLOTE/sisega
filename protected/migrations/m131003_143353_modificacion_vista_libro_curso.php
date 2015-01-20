<?php

class m131003_143353_modificacion_vista_libro_curso extends CDbMigration
{
	public function up()
	{
                Yii::app()->db->createCommand("
CREATE OR REPLACE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `sisega`.`libro_curso` AS SELECT
	`plan_actividad`.`id` AS `actividad_id`,
	`plan_actividad`.`actividad` AS `actividad`,
	`plan_actividad`.`fecha_inicio` AS `fecha_inicio`,
	`plan_actividad`.`fecha_termino` AS `fecha_termino`,
	`curso`.`id` AS `curso_id`,
	`curso`.`semestre` AS `curso_semestre`,
	`curso`.`anio` AS `curso_anio`,
	`curso`.`nombre` AS `curso_nombre`,
	`evaluacion`.`id` AS `evaluacion_id`,
	`evaluacion`.`fecha` AS `evaluacion_fecha`,
	`evaluacion`.`nombre` AS `evaluacion_nombre`,
	`evaluacion`.`observacion` AS `evaluacion_observacion`,
	`alumno`.`id` AS `alumno_id`,
	`alumno`.`nombre` AS `alumno_nombre`,
	`alumno`.`run` AS `alumno_run`,
	`calificacion`.`id` AS `calificacion_id`,
	`calificacion`.`nota` AS `calificacion_nota`
FROM
	(
		(
			(
				(
					(
						`curso_tiene_alumno`
						JOIN `curso` ON(
							(
								`curso_tiene_alumno`.`curso_id` = `curso`.`id`
							)
						)
					)
					LEFT JOIN `plan_actividad` ON(
						(
							`plan_actividad`.`curso_id` = `curso`.`id`
						)
					)
				)
				LEFT JOIN `evaluacion` ON(
					(
						(
							`evaluacion`.`curso_id` = `curso`.`id`
						)
						AND(
							`evaluacion`.`fecha` BETWEEN `plan_actividad`.`fecha_inicio`
							AND `plan_actividad`.`fecha_termino`
						)
					)
				)
			)
			LEFT JOIN `calificacion` ON(
				(
					(
						`calificacion`.`evaluacion_id` = `evaluacion`.`id`
					)
					AND(
						`calificacion`.`alumno_id` = `curso_tiene_alumno`.`alumno_id`
					)
				)
			)
		)
		JOIN `alumno` ON(
			(
				`curso_tiene_alumno`.`alumno_id` = `alumno`.`id`
			)
		)
	);"
        )->execute();
	}

	public function down()
	{
		Yii::app()->db->createCommand("DROP VIEW IF EXISTS `sisega`.`libro_curso`;")->execute();
		return false;
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
