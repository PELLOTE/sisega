-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 13-11-2013 a las 15:54:27
-- Versión del servidor: 5.5.8
-- Versión de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sisega`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE IF NOT EXISTS `actividad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `planificacion_semestral_id` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_termino` date DEFAULT NULL,
  `detalle` text,
  PRIMARY KEY (`id`),
  KEY `fk_actividad_planificacion_semestral1_idx` (`planificacion_semestral_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Volcar la base de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`id`, `planificacion_semestral_id`, `fecha_inicio`, `fecha_termino`, `detalle`) VALUES
(7, 6, '2013-11-13', '2013-11-14', 'Receso de Fiestas Patrias'),
(8, 6, '2013-11-21', '2013-11-23', 'Semana de optativas'),
(9, 6, '2013-11-14', '2013-11-14', 'Semana de Walking Dead'),
(10, 6, '2013-11-14', '2013-11-14', 'Semana de Walking Dead'),
(11, 6, '2013-11-14', '2013-11-14', 'Semana de Walking Dead'),
(12, 6, '2013-11-14', '2013-11-14', 'Semana de Walking Dead'),
(14, 6, '2013-11-21', '2013-11-21', 'Semana Left 4 Dead 2'),
(15, 6, '2013-11-21', '2013-11-21', 'Semana Left 4 Dead 2'),
(16, 6, '2013-11-21', '2013-11-21', 'Semana Left 4 Dead 2'),
(18, 6, '2013-11-21', '2013-11-21', 'Semana Left 4 Dead 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_uta`
--

CREATE TABLE IF NOT EXISTS `actividad_uta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `semestre` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_termino` date DEFAULT NULL,
  `detalle` text COLLATE utf8_unicode_ci,
  `calendario_docente_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_actividad_uta_calendario_docente1` (`calendario_docente_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `actividad_uta`
--

INSERT INTO `actividad_uta` (`id`, `semestre`, `fecha_inicio`, `fecha_termino`, `detalle`, `calendario_docente_id`) VALUES
(1, 1, '2013-03-04', '2013-11-04', 'Inicio Actividades Universitarias', 2),
(2, 1, '2013-03-04', '2013-03-22', 'Temporada estraordinaria de exámenes, Carrera de Derecho', 2),
(3, 1, '2013-03-11', '2013-03-11', 'Inico de actividades para los alumnos nuevos primer semestre académico 2013. (Semana de Inducción a la Vida Universitaria)', 2),
(4, 2, '2013-08-12', '2013-08-12', 'Inicio de clases 2º semestre año académico 2013 todas las carreras, y reanudación de asignaturas anuales de la Carrera de Derecho', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE IF NOT EXISTS `alumno` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '	',
  `nombre` varchar(255) NOT NULL,
  `run` varchar(12) NOT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `anio_ingreso` int(11) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alumno_user1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id`, `nombre`, `run`, `direccion`, `user_id`, `anio_ingreso`, `email`) VALUES
(1, 'Alumno 1', '11111111-1', '18 de Septiembre 2222', 5, NULL, NULL),
(2, 'Alumno 2', '22222222-2', '19 de Noviembre 3333', NULL, NULL, NULL),
(3, 'Alumno 3', '33333333-3', '20 de Diciembre 4444', NULL, NULL, NULL),
(4, 'Alumno 4', '44444444-4', '21 de Mayo 435', NULL, NULL, NULL),
(5, 'Gonzalo Godoy', '16468949-2', 'limoneros 2432', 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE IF NOT EXISTS `asignatura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `semestre` int(3) DEFAULT NULL,
  `programa` text,
  `codigo` varchar(45) DEFAULT NULL,
  `numero` int(3) DEFAULT NULL,
  `catedra` int(3) DEFAULT NULL,
  `taller` int(3) DEFAULT NULL,
  `laboratorio` int(3) DEFAULT NULL,
  `tipo_formacion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`id`, `nombre`, `semestre`, `programa`, `codigo`, `numero`, `catedra`, `taller`, `laboratorio`, `tipo_formacion`) VALUES
(2, 'Ingeniería de software', 1, NULL, '1', 74, 4, 0, 2, '6'),
(3, 'Bases de datos', 2, NULL, NULL, 64, 4, 0, 2, NULL),
(4, 'Tecnologia Web', 2, NULL, NULL, 63, 2, 0, 4, NULL),
(5, 'Algoritmos y Estructura de Datos', 1, NULL, NULL, 44, 4, 0, 2, 'IA'),
(6, 'Programación Básica', 2, NULL, NULL, 14, 1, 2, 3, NULL),
(7, 'Programación', 1, NULL, NULL, 24, 2, 0, 2, NULL),
(8, 'Calculo I', 1, NULL, NULL, 11, 2, 3, 4, NULL),
(9, 'Calculo II', 2, NULL, NULL, 21, 2, 3, 4, NULL),
(10, 'Algebra I', 1, NULL, NULL, 12, 3, 4, 5, '6'),
(11, 'Introducción a la Ingenieria', 1, NULL, '1', 13, 8, 7, 6, '4'),
(12, 'Algebra II', 2, NULL, NULL, 22, 6, 2, 0, 'CB'),
(13, 'Mecanica Clasica', 2, NULL, NULL, 23, 4, 0, 2, 'CB'),
(14, 'Calculo III', 1, NULL, NULL, 31, 4, 0, 0, 'CB'),
(15, 'Ecuaciones Diferenciales', 1, NULL, NULL, 32, 3, 1, 0, 'CB'),
(16, 'Circuito Electronicos', 1, NULL, NULL, 33, 2, 0, 2, 'CB'),
(17, 'Programación Avanzada', 1, NULL, NULL, 34, 4, 0, 2, 'IA'),
(18, 'Quimica', 1, NULL, NULL, 35, 3, 1, 0, 'CB'),
(19, 'Electivo formación general', 1, NULL, NULL, 36, 3, 0, 0, 'FG'),
(20, 'Electromagnetismo', 2, NULL, NULL, 41, 4, 0, 2, 'CB'),
(21, 'Estadística y probabilidad', 2, NULL, NULL, 42, 3, 1, 0, 'CB'),
(22, 'Sistemas digitales', 2, NULL, NULL, 43, 2, 0, 2, 'CI'),
(23, 'Fundamentos de lenguajes de programación', 2, NULL, NULL, 45, 4, 0, 2, 'IA'),
(24, 'Actitud emprendedora', 1, NULL, NULL, 51, 0, 4, 0, 'FG'),
(25, 'Matematica Discreta', 1, NULL, NULL, 52, 3, 0, 1, 'CB'),
(26, 'Arquitectura de Computadores', 2, NULL, NULL, 53, 2, 0, 2, 'IA'),
(27, 'Taller de técnicas de programación', 1, NULL, NULL, 55, 0, 4, 0, 'IA'),
(28, 'Ingles I', 1, NULL, NULL, 56, 0, 2, 2, 'FG'),
(29, 'Tecnología de objetos', 1, NULL, NULL, 54, 4, 0, 2, 'IA'),
(30, 'Termodinamica', 2, NULL, NULL, 61, 4, 0, 0, 'CI'),
(31, 'Sistema operativo', 2, NULL, NULL, 62, 4, 0, 2, 'IA'),
(32, 'Ingles II', 2, NULL, NULL, 65, 0, 2, 2, 'FG'),
(33, 'Gestión de empresas', 1, NULL, NULL, 71, 3, 1, 0, 'CI'),
(34, 'Comunicación de datos y redes de computadores', 1, NULL, NULL, 72, 4, 0, 2, 'IA'),
(35, 'Sistemas de información', 1, NULL, NULL, 73, 2, 0, 2, 'CI'),
(36, 'Ingles III', 1, NULL, NULL, 75, 0, 2, 2, 'FG'),
(37, 'Preparación y evaluación de proyectos', 2, NULL, NULL, 81, 3, 1, 0, 'CI'),
(38, 'Introducción a la economía', 2, NULL, NULL, 82, 4, 0, 0, 'CI'),
(39, 'Sistemas distribuidos', 2, NULL, NULL, 83, 4, 0, 2, 'IA'),
(40, 'Laboratorio de redes', 2, NULL, NULL, 84, 0, 0, 4, 'IA'),
(41, 'Física contemporanea', 2, NULL, NULL, 85, 4, 0, 0, 'CB'),
(42, 'Ingles IV', 2, NULL, NULL, 86, 0, 2, 2, 'FG'),
(43, 'Compiladores', 1, NULL, NULL, 91, 4, 2, 0, 'IA'),
(44, 'Modelación y simulación de sistemas computacionales', 1, NULL, NULL, 92, 2, 0, 2, 'IA'),
(45, 'Taller de servicios en red', 1, NULL, NULL, 93, 0, 4, 0, 'IA'),
(46, 'Desarrollo proyecto emprendedor', 1, NULL, NULL, 94, 0, 4, 0, 'FG'),
(47, 'Analisis y diseño de algoritmos', 1, NULL, NULL, 95, 4, 0, 0, 'IA'),
(48, 'Electivo formación profesional I', 1, NULL, NULL, 96, 4, 0, 0, 'IA'),
(49, 'Modelos de optimización', 2, NULL, NULL, 101, 3, 1, 0, 'CI'),
(50, 'Inteligencia artificial', 2, NULL, NULL, 102, 4, 0, 0, 'IA'),
(51, 'Aplicaciones distribuidas avanzada', 2, NULL, NULL, 103, 2, 0, 2, 'IA'),
(52, 'Ingeniería de software avanzada', 2, NULL, NULL, 104, 4, 0, 2, 'IA'),
(53, 'Electivo formación general II', 2, NULL, NULL, 105, 3, 0, 0, 'FG'),
(54, 'Taller de proyectos de software', 1, NULL, NULL, 111, 0, 8, 0, 'IA'),
(55, 'Electivo formación profesional II', 1, NULL, NULL, 112, 4, 0, 0, 'IA'),
(56, 'Gestión de seguridad informática', 1, NULL, NULL, 113, 2, 2, 0, 'IA'),
(57, 'Seminario de proyectos informáticos', 1, NULL, NULL, 114, 0, 8, 0, 'CI'),
(58, 'Electivo formación profesional III', 2, NULL, NULL, 121, 4, 0, 0, 'IA'),
(59, 'Actividad de titulación', 2, NULL, NULL, 122, 0, 10, 0, 'IA'),
(60, 'Electivo formación profesional IV', 2, NULL, NULL, 123, 4, 0, 0, 'IA'),
(61, 'Taller de ética profesional y responsabilidad social del informático', 2, NULL, NULL, 124, 0, 3, 0, 'FG');

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `authitem`
--

CREATE TABLE IF NOT EXISTS `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `authitem`
--

INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('Academico.*', 1, NULL, NULL, 'N;'),
('Administrador', 2, NULL, NULL, 'N;'),
('Alumno', 2, 'Alumno', NULL, 'N;'),
('Alumno.MisCursos', 0, NULL, NULL, 'N;'),
('Alumno.VerCurso', 0, NULL, NULL, 'N;'),
('Coordinador de Area', 2, 'Coordinador de Area', NULL, 'N;'),
('Coordinador Pedagogico', 2, 'Coordinador Pedagogico', NULL, 'N;'),
('Invitado', 2, NULL, NULL, 'N;'),
('JefaturaCarrera.*', 1, NULL, NULL, 'N;'),
('Jefe Carrera', 2, 'Jefe de Carrera', NULL, 'N;'),
('Planificacion.*', 1, NULL, NULL, 'N;'),
('Profesor', 2, 'Profesor', NULL, 'N;'),
('Secretaria', 2, 'Secretaria', NULL, 'N;'),
('Usuario', 2, NULL, NULL, 'N;');


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `authitemchild`
--

CREATE TABLE IF NOT EXISTS `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `authitemchild`
--

INSERT INTO `authitemchild` (`parent`, `child`) VALUES
('Profesor', 'Academico.*'),
('Alumno', 'Alumno.MisCursos'),
('Alumno', 'Alumno.VerCurso'),
('Jefe Carrera', 'JefaturaCarrera.*'),
('Coordinador Pedagogico', 'Planificacion.*');


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `authassignment`
--

CREATE TABLE IF NOT EXISTS `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `authassignment`
--

INSERT INTO `authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('Administrador', '1', NULL, 'N;'),
('Alumno', '5', NULL, 'N;'),
('Coordinador de Area', '4', NULL, 'N;'),
('Coordinador Pedagogico', '3', NULL, 'N;'),
('Invitado', '2', NULL, 'N;'),
('Jefe Carrera', '2', NULL, 'N;'),
('Profesor', '6', NULL, 'N;'),
('Secretaria', '7', NULL, 'N;');


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario_docente`
--

CREATE TABLE IF NOT EXISTS `calendario_docente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inicio_primer_semestre` date DEFAULT NULL,
  `termino_primer_semestre` date DEFAULT NULL,
  `inicio_segundo_semestre` date DEFAULT NULL,
  `termino_segundo_semestre` date DEFAULT NULL,
  `anio` int(11) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `calendario_docente`
--

INSERT INTO `calendario_docente` (`id`, `inicio_primer_semestre`, `termino_primer_semestre`, `inicio_segundo_semestre`, `termino_segundo_semestre`, `anio`, `estado`) VALUES
(2, '2013-03-04', '2013-07-12', '2013-07-29', '2013-12-13', 2013, 'VIGENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE IF NOT EXISTS `calificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alumno_id` int(11) NOT NULL,
  `evaluacion_id` int(11) NOT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `nota` double(4,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_calificacion_evaluacion1_idx` (`evaluacion_id`),
  KEY `fk_calificacion_alumno1_idx` (`alumno_id`),
  KEY `fk_calificacion_curso1` (`curso_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcar la base de datos para la tabla `calificacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asignatura_id` int(11) NOT NULL,
  `profesor_id` int(11) NOT NULL,
  `semestre` int(11) DEFAULT NULL,
  `anio` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `posicion` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_curso_profesor1_idx` (`profesor_id`),
  KEY `fk_curso_asignatura1_idx` (`asignatura_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `curso`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_tiene_alumno`
--

CREATE TABLE IF NOT EXISTS `curso_tiene_alumno` (
  `curso_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `promedio` float DEFAULT NULL,
  `semestre` int(11) DEFAULT NULL,
  `anio` int(11) DEFAULT NULL,
  PRIMARY KEY (`curso_id`,`alumno_id`),
  KEY `fk_curso_has_alumno_alumno1_idx` (`alumno_id`),
  KEY `fk_curso_has_alumno_curso1_idx` (`curso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion`
--

CREATE TABLE IF NOT EXISTS `evaluacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `curso_id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `observacion` text,
  PRIMARY KEY (`id`),
  KEY `fk_evaluacion_curso1_idx` (`curso_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcar la base de datos para la tabla `evaluacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion_semestral`
--

CREATE TABLE IF NOT EXISTS `evaluacion_semestral` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alumno_id` int(11) NOT NULL,
  `semestre` int(11) DEFAULT NULL,
  `anio` int(11) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `observacion` text,
  `oportunidad` int(11) DEFAULT NULL,
  `semestre_cursado` int(11) DEFAULT NULL,
  `promedio` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_evaluacion_semestral_alumno1_idx` (`alumno_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `evaluacion_semestral`
--


-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `planificacion_semestral`
--

CREATE TABLE IF NOT EXISTS `planificacion_semestral` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `calendario_docente_id` int(11) NOT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `fecha_proposicion` date DEFAULT NULL,
  `fecha_respuesta` date DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_termino` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `semestre` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_planificacion_semestral_calendario_docente1_idx` (`calendario_docente_id`),
  KEY `fk_planificacion_semestral_user1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcar la base de datos para la tabla `planificacion_semestral`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_actividad`
--

CREATE TABLE IF NOT EXISTS `plan_actividad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `curso_id` int(11) NOT NULL,
  `planificacion_semestral_id` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_termino` date DEFAULT NULL,
  `actividad` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_plan_actividad_planificacion_semestral1_idx` (`planificacion_semestral_id`),
  KEY `fk_plan_actividad_curso1_idx` (`curso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `plan_actividad`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE IF NOT EXISTS `profesor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `run` varchar(12) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_profesor_user1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rights`
--

CREATE TABLE IF NOT EXISTS `rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `rights`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_migration`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `rol` varchar(45) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcar la base de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `rol`, `activo`) VALUES
(1, 'admin', 'c63b447bcee0c5064cac9d264e62114e2d50516e', '', 'Administrador', 1),
(2, 'jefecarrera', 'f724e402d77dc405fb986418dcdc6a115ab345f3', 'jefecarrera@email.com', 'Jefe Carrera', 1),
(3, 'coordinadorpedagogico', 'f724e402d77dc405fb986418dcdc6a115ab345f3', 'coordinador@email.com', 'Coordinador Pedagogico', 1),
(4, 'coordinadorarea', 'f724e402d77dc405fb986418dcdc6a115ab345f3', 'coordinadorarea@email.com', 'Coordinador de Area', 1),
(5, 'alumno', 'f724e402d77dc405fb986418dcdc6a115ab345f3', 'tucocorp@gmail.com', 'Alumno', 1),
(6, 'profesor', 'f724e402d77dc405fb986418dcdc6a115ab345f3', 'profesor@raboit.com', 'Profesor', 1),
(7, 'secretaria', 'f724e402d77dc405fb986418dcdc6a115ab345f3', 'secretaria@uta.cl', 'Secretaria', 1);

-- --------------------------------------------------------

--
-- Estructura para la vista `libro_curso`
--
DROP TABLE IF EXISTS `libro_curso`;

CREATE VIEW `libro_curso` AS select `plan_actividad`.`id` AS `actividad_id`,`plan_actividad`.`actividad` AS `actividad`,`plan_actividad`.`fecha_inicio` AS `fecha_inicio`,`plan_actividad`.`fecha_termino` AS `fecha_termino`,`curso`.`id` AS `curso_id`,`curso`.`semestre` AS `curso_semestre`,`curso`.`anio` AS `curso_anio`,`curso`.`nombre` AS `curso_nombre`,`evaluacion`.`id` AS `evaluacion_id`,`evaluacion`.`fecha` AS `evaluacion_fecha`,`evaluacion`.`nombre` AS `evaluacion_nombre`,`evaluacion`.`observacion` AS `evaluacion_observacion`,`alumno`.`id` AS `alumno_id`,`alumno`.`nombre` AS `alumno_nombre`,`alumno`.`run` AS `alumno_run`,`calificacion`.`id` AS `calificacion_id`,`calificacion`.`nota` AS `calificacion_nota` from (((((`curso_tiene_alumno` join `curso` on((`curso_tiene_alumno`.`curso_id` = `curso`.`id`))) left join `plan_actividad` on((`plan_actividad`.`curso_id` = `curso`.`id`))) left join `evaluacion` on(((`evaluacion`.`curso_id` = `curso`.`id`) and (`evaluacion`.`fecha` between `plan_actividad`.`fecha_inicio` and `plan_actividad`.`fecha_termino`)))) left join `calificacion` on(((`calificacion`.`evaluacion_id` = `evaluacion`.`id`) and (`calificacion`.`alumno_id` = `curso_tiene_alumno`.`alumno_id`)))) join `alumno` on((`curso_tiene_alumno`.`alumno_id` = `alumno`.`id`)));

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `fk_actividad_planificacion_semestral1` FOREIGN KEY (`planificacion_semestral_id`) REFERENCES `planificacion_semestral` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `actividad_uta`
--
ALTER TABLE `actividad_uta`
  ADD CONSTRAINT `fk_actividad_uta_calendario_docente1` FOREIGN KEY (`calendario_docente_id`) REFERENCES `calendario_docente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `fk_alumno_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;


--
-- Filtros para la tabla `authassignment`
--
ALTER TABLE `authassignment`
  ADD CONSTRAINT `AuthAssignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `authitemchild`
--
ALTER TABLE `authitemchild`
  ADD CONSTRAINT `AuthItemChild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `AuthItemChild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD CONSTRAINT `fk_calificacion_alumno1` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_calificacion_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_calificacion_evaluacion1` FOREIGN KEY (`evaluacion_id`) REFERENCES `evaluacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `fk_curso_asignatura1` FOREIGN KEY (`asignatura_id`) REFERENCES `asignatura` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_curso_profesor1` FOREIGN KEY (`profesor_id`) REFERENCES `profesor` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `curso_tiene_alumno`
--
ALTER TABLE `curso_tiene_alumno`
  ADD CONSTRAINT `fk_curso_has_alumno_alumno1` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_curso_has_alumno_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD CONSTRAINT `fk_evaluacion_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evaluacion_semestral`
--
ALTER TABLE `evaluacion_semestral`
  ADD CONSTRAINT `fk_evaluacion_semestral_alumno1` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `planificacion_semestral`
--
ALTER TABLE `planificacion_semestral`
  ADD CONSTRAINT `fk_planificacion_semestral_calendario_docente1` FOREIGN KEY (`calendario_docente_id`) REFERENCES `calendario_docente` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_planificacion_semestral_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Filtros para la tabla `plan_actividad`
--
ALTER TABLE `plan_actividad`
  ADD CONSTRAINT `fk_plan_actividad_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_plan_actividad_planificacion_semestral1` FOREIGN KEY (`planificacion_semestral_id`) REFERENCES `planificacion_semestral` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `fk_profesor_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Filtros para la tabla `rights`
--
ALTER TABLE `rights`
  ADD CONSTRAINT `Rights_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
