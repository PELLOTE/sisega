<?php

class m130822_160554_modificacion_tablas_curso_y_asignatura extends CDbMigration
{
//	public function up()
//	{
//	}
//
//	public function down()
//	{
//		echo "m130822_160554_modificacion_tablas_curso_y_asignatura does not support migration down.\n";
//		return false;
//	}

	
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
//                $this->addColumn('curso', 'nombre', 'varchar(255)');
                Yii::app()->db->createCommand('
                        ALTER TABLE `sisega`.`curso` ADD COLUMN `nombre` VARCHAR(255) NULL DEFAULT NULL AFTER `anio`;
                        ALTER TABLE `sisega`.`asignatura` CHANGE COLUMN `nombre` `nombre` VARCHAR(255) NULL DEFAULT NULL;
                        ')->execute();
	}

	public function safeDown()
	{
                $this->dropColumn('curso', 'nombre');
                $this->alterColumn('asignatura', 'nombre', 'varchar(100)');
	}
	
}