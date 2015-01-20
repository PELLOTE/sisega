-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 13-03-2014 a las 11:43:34
-- Versión del servidor: 5.1.41
-- Versión de PHP: 5.3.1

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `actividad`
--


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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Volcar la base de datos para la tabla `actividad_uta`
--

INSERT INTO `actividad_uta` (`id`, `semestre`, `fecha_inicio`, `fecha_termino`, `detalle`, `calendario_docente_id`) VALUES
(1, 1, '0000-00-00', '0000-00-00', 'Temporada estraordinaria de exámenes, Carrera de Derecho', 1),
(2, 1, '0000-00-00', '0000-00-00', 'Inico de actividades para los alumnos nuevos primer semestre académico 2013. (Semana de Inducción a la Vida Universitaria)', 1),
(3, 1, '0000-00-00', '0000-00-00', 'Inicio de clases para todos los alumnos primer semestre académico 2013', 1),
(4, 1, '0000-00-00', '0000-00-00', 'Recepción por parte de la Federación de Estudiantes a los alumnos nuevos (Semana Mechona)', 1),
(5, 1, '0000-00-00', '0000-00-00', 'Vence plazo de matrícula y de regularización de situación financiera de alumnos nuevos y antiguos', 1),
(6, 1, '0000-00-00', '0000-00-00', 'Temporada ordinaria de exámenes, asignaturas semestrales carrera de Derecho', 1),
(7, 1, '0000-00-00', '0000-00-00', 'Térmivo de clases primer semestre académico 2013, todas las carreras', 1),
(8, 1, '0000-00-00', '0000-00-00', 'Semana de últimas evaluaciones, excepto carrera de Derecho. Temporada extraordinaria de exámenes, asignaturas semestrales carrera de Derecho.', 1),
(9, 1, '0000-00-00', '0000-00-00', 'Período de vacaciones alumnos de pregrado, todas las carreras.', 1),
(10, 1, '0000-00-00', '0000-00-00', 'Semana de pruebas optativas.', 1),
(11, 2, '0000-00-00', '0000-00-00', 'Inicio de clases 2º semestre año académico 2013 todas las carreras, y reanudación de asignaturas anuales de la Carrera de Derecho.', 1),
(12, 2, '0000-00-00', '0000-00-00', 'Receso de Fiestas Patrias', 1),
(13, 2, '0000-00-00', '0000-00-00', 'Celebración semana universitaria', 1),
(14, 2, '0000-00-00', '0000-00-00', 'Término clases de Carrera de Derecho', 1),
(15, 2, '0000-00-00', '0000-00-00', 'Semana de últimas evaluaciones, excepto carrera de Derecho', 1),
(16, 2, '0000-00-00', '0000-00-00', 'Inicio período de vacaciones alumnos de pregrado, todas las carreras, excepto carrera de Derecho.', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id`, `nombre`, `run`, `direccion`, `user_id`, `anio_ingreso`, `email`) VALUES
(1, 'alumno', '12312345-5', 'Test #123', 5, 2014, 'alumno@uta.cl');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- Volcar la base de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`id`, `nombre`, `semestre`, `programa`, `codigo`, `numero`, `catedra`, `taller`, `laboratorio`, `tipo_formacion`) VALUES
(2, 'Ingeniería de software', 1, NULL, '1', 74, 4, 0, 2, '6'),
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
(60, 'Electivo formación profesional IV', 2, NULL, NULL, 123, 4, 0, 0, 'IA');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `authassignment`
--

INSERT INTO `authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('Administrador', '1', NULL, 'N;'),
('Alumno', '11', NULL, 'N;'),
('Profesor', '10', NULL, 'N;'),
('Alumno', '9', NULL, 'N;'),
('Profesor', '8', NULL, 'N;'),
('Secretaria', '7', NULL, 'N;'),
('Coordinador de Area', '6', NULL, 'N;'),
('Alumno', '5', NULL, 'N;'),
('Profesor', '4', NULL, 'N;'),
('Coordinador Pedagogico', '3', NULL, 'N;'),
('Jefe Carrera', '2', NULL, 'N;');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `authitem`
--

INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('Academico.*', 1, NULL, NULL, 'N;'),
('Academico.MisCursos', 0, NULL, NULL, 'N;'),
('Academico.VerCurso', 0, NULL, NULL, 'N;'),
('Administrador', 2, NULL, NULL, 'N;'),
('Alumno', 2, 'Alumno', NULL, 'N;'),
('Alumno.Malla', 0, NULL, NULL, 'N;'),
('Alumno.MisCursos', 0, NULL, NULL, 'N;'),
('Alumno.VerCurso', 0, NULL, NULL, 'N;'),
('Coordinador de Area', 2, 'Coordinador de Area', NULL, 'N;'),
('Coordinador Pedagogico', 2, 'Coordinador Pedagogico', NULL, 'N;'),
('Invitado', 2, NULL, NULL, 'N;'),
('JefaturaCarrera.*', 1, NULL, NULL, 'N;'),
('Jefe Carrera', 2, 'Jefe de Carrera', NULL, 'N;'),
('Planificacion.*', 1, NULL, NULL, 'N;'),
('Profesor', 2, 'Profesor', NULL, 'N;'),
('Profesor.*', 1, NULL, NULL, 'N;'),
('Secretaria', 2, 'Secretaria', NULL, 'N;'),
('Usuario', 2, NULL, NULL, 'N;'),
('User.ChangePassword', 0, NULL, NULL, 'N;');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `authitemchild`
--

CREATE TABLE IF NOT EXISTS `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `authitemchild`
--

INSERT INTO `authitemchild` (`parent`, `child`) VALUES
('Alumno', 'Alumno.Malla'),
('Alumno', 'Alumno.MisCursos'),
('Alumno', 'Alumno.VerCurso'),
('Coordinador Pedagogico', 'Planificacion.*'),
('Jefe Carrera', 'JefaturaCarrera.*'),
('Profesor', 'Academico.*'),
('Usuario', 'Alumno'),
('Usuario', 'Coordinador de Area'),
('Usuario', 'Coordinador Pedagogico'),
('Usuario', 'Jefe Carrera'),
('Usuario', 'Profesor'),
('Usuario', 'Secretaria'),
('Usuario', 'User.ChangePassword');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `calendario_docente`
--

INSERT INTO `calendario_docente` (`id`, `inicio_primer_semestre`, `termino_primer_semestre`, `inicio_segundo_semestre`, `termino_segundo_semestre`, `anio`, `estado`) VALUES
(1, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 2013, 'VIGENTE');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `calificacion`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asignatura_id` int(11) DEFAULT NULL,
  `profesor_id` int(11) DEFAULT NULL,
  `semestre` int(11) DEFAULT NULL,
  `anio` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `posicion` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_curso_profesor1_idx` (`profesor_id`),
  KEY `fk_curso_asignatura1_idx` (`asignatura_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`curso_id`,`alumno_id`),
  KEY `fk_curso_has_alumno_alumno1_idx` (`alumno_id`),
  KEY `fk_curso_has_alumno_curso1_idx` (`curso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `curso_tiene_alumno`
--


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `evaluacion_semestral`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_curso`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sisega`.`libro_curso` AS select `sisega`.`plan_actividad`.`id` AS `actividad_id`,`sisega`.`plan_actividad`.`actividad` AS `actividad`,`sisega`.`plan_actividad`.`fecha_inicio` AS `fecha_inicio`,`sisega`.`plan_actividad`.`fecha_termino` AS `fecha_termino`,`sisega`.`curso`.`id` AS `curso_id`,`sisega`.`curso`.`semestre` AS `curso_semestre`,`sisega`.`curso`.`anio` AS `curso_anio`,`sisega`.`curso`.`nombre` AS `curso_nombre`,`sisega`.`evaluacion`.`id` AS `evaluacion_id`,`sisega`.`evaluacion`.`fecha` AS `evaluacion_fecha`,`sisega`.`evaluacion`.`nombre` AS `evaluacion_nombre`,`sisega`.`evaluacion`.`observacion` AS `evaluacion_observacion`,`sisega`.`alumno`.`id` AS `alumno_id`,`sisega`.`alumno`.`nombre` AS `alumno_nombre`,`sisega`.`alumno`.`run` AS `alumno_run`,`sisega`.`calificacion`.`id` AS `calificacion_id`,`sisega`.`calificacion`.`nota` AS `calificacion_nota` from (((((`sisega`.`curso_tiene_alumno` join `sisega`.`curso` on((`sisega`.`curso_tiene_alumno`.`curso_id` = `sisega`.`curso`.`id`))) left join `sisega`.`plan_actividad` on((`sisega`.`plan_actividad`.`curso_id` = `sisega`.`curso`.`id`))) left join `sisega`.`evaluacion` on(((`sisega`.`evaluacion`.`curso_id` = `sisega`.`curso`.`id`) and (`sisega`.`evaluacion`.`fecha` between `sisega`.`plan_actividad`.`fecha_inicio` and `sisega`.`plan_actividad`.`fecha_termino`)))) left join `sisega`.`calificacion` on(((`sisega`.`calificacion`.`evaluacion_id` = `sisega`.`evaluacion`.`id`) and (`sisega`.`calificacion`.`alumno_id` = `sisega`.`curso_tiene_alumno`.`alumno_id`)))) join `sisega`.`alumno` on((`sisega`.`curso_tiene_alumno`.`alumno_id` = `sisega`.`alumno`.`id`)));

--
-- Volcar la base de datos para la tabla `libro_curso`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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

--
-- Volcar la base de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`id`, `nombre`, `user_id`, `run`, `email`) VALUES
(1, 'profesor', 4, '12312345-k', 'profesor@uta.cl');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rights`
--

CREATE TABLE IF NOT EXISTS `rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `rights`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_migration`
--

CREATE TABLE IF NOT EXISTS `tbl_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `tbl_migration`
--

INSERT INTO `tbl_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1378957851),
('m130822_160554_modificacion_tablas_curso_y_asignatura', 1378957853),
('m130822_171007_nuevo_atributo_tabla_calificacion', 1378957854),
('m130912_045235_modificacion_columna_evaluacion', 1378961704),
('m130916_150238_modificacion_bd_constraint_todos_on_delete_cascade', 1379433390),
('m130917_153349_nuevo_atributo_user_id_en_planificacion_semestral', 1379433390),
('m130917_153522_nueva_vista_libro_curso', 1379433391),
('m130919_063458_nuevo_atributo_tabla_evaluacion_nombre', 1379572607),
('m130925_153830_modificacion_tabla_calificacion_atributo_nota_decimal', 1380123703),
('m131003_143353_modificacion_vista_libro_curso', 1383850422),
('m131008_145107_nuevo_atributo_estado_en_tabla_curso', 1383850423),
('m131023_140913_modificacion_tabla_asignatura_y_nueva_tabla_prerequisitos', 1383850423);

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
(1, 'admin', 'c63b447bcee0c5064cac9d264e62114e2d50516e', NULL, 'Administrador', 1),
(2, 'jefecarrera', '1b95ce124e93c18918b03ceede43329bf3a1e045', 'jefecarrera@uta.cl', 'Jefe Carrera', 1),
(3, 'coordinadorpedagogico', '1b95ce124e93c18918b03ceede43329bf3a1e045', 'coordinadorpedagogico@uta.cl', 'Coordinador Pedagogico', 1),
(4, 'profesor', '1b95ce124e93c18918b03ceede43329bf3a1e045', 'profesor@uta.cl', 'Profesor', 1),
(5, 'alumno', '1b95ce124e93c18918b03ceede43329bf3a1e045', 'alumno@uta.cl', 'Alumno', 1),
(6, 'coordinadorarea', '1b95ce124e93c18918b03ceede43329bf3a1e045', 'coordinadorarea@uta.cl', 'Coordinador de Area', 1),
(7, 'secretaria', '1b95ce124e93c18918b03ceede43329bf3a1e045', 'secretaria@uta.cl', 'Secretaria', 1);

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `fk_actividad_planificacion_semestral1` FOREIGN KEY (`planificacion_semestral_id`) REFERENCES `planificacion_semestral` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_curso_asignatura1` FOREIGN KEY (`asignatura_id`) REFERENCES `asignatura` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_curso_profesor1` FOREIGN KEY (`profesor_id`) REFERENCES `profesor` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `curso_tiene_alumno`
--
ALTER TABLE `curso_tiene_alumno`
  ADD CONSTRAINT `fk_curso_has_alumno_alumno1` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_curso_has_alumno_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD CONSTRAINT `fk_evaluacion_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evaluacion_semestral`
--
ALTER TABLE `evaluacion_semestral`
  ADD CONSTRAINT `fk_evaluacion_semestral_alumno1` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `planificacion_semestral`
--
ALTER TABLE `planificacion_semestral`
  ADD CONSTRAINT `fk_planificacion_semestral_calendario_docente1` FOREIGN KEY (`calendario_docente_id`) REFERENCES `calendario_docente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_planificacion_semestral_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Filtros para la tabla `plan_actividad`
--
ALTER TABLE `plan_actividad`
  ADD CONSTRAINT `fk_plan_actividad_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_plan_actividad_planificacion_semestral1` FOREIGN KEY (`planificacion_semestral_id`) REFERENCES `planificacion_semestral` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `fk_profesor_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
