-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-12-2014 a las 00:49:00
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `projectrsa`
--
CREATE DATABASE IF NOT EXISTS `projectrsa` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projectrsa`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `careers`
--

CREATE TABLE IF NOT EXISTS `careers` (
`id` int(11) NOT NULL,
  `code` varchar(5) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` int(11) NOT NULL,
  `date` date NOT NULL,
  `comment` varchar(300) NOT NULL,
  `user` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `courses`
--

INSERT INTO `courses` (`id`, `name`) VALUES
(1, 'Programación I'),
(2, 'Programación II'),
(3, 'Programación III'),
(4, 'Diseño de Aplicaciones Web'),
(5, 'Programación en Ambiente Web I'),
(6, 'Programación en Ambiente Web II'),
(7, 'Aplicación de Base de Datos'),
(8, 'Fundamentos de Base de Datos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
`id` int(11) NOT NULL,
  `duration` varchar(10) NOT NULL,
  `description` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `course_id` int(11) NOT NULL,
  `grade` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project_technologies`
--

CREATE TABLE IF NOT EXISTS `project_technologies` (
  `project_id` int(11) NOT NULL,
  `technology_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE IF NOT EXISTS `role` (
`id` int(11) NOT NULL,
  `detail` varchar(200) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`id`, `detail`) VALUES
(1, 'Administrador'),
(2, 'Director de Carrera'),
(3, 'Profesor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `skills`
--

CREATE TABLE IF NOT EXISTS `skills` (
`id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `skills`
--

INSERT INTO `skills` (`id`, `name`) VALUES
(1, 'Programacion'),
(2, 'Pensamiento Critico'),
(3, 'Resolucion de Problemas'),
(4, 'Estrategias de aprendizaje'),
(5, 'Coordinacion'),
(6, 'Manejo de tiempo'),
(7, 'Matematicas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `students`
--

CREATE TABLE IF NOT EXISTS `students` (
`id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `idn` int(9) NOT NULL,
  `photo` longtext NOT NULL,
  `englishlvl` varchar(20) NOT NULL,
  `career_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='idn = identification number' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `students_comments`
--

CREATE TABLE IF NOT EXISTS `students_comments` (
  `student_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `students_projects`
--

CREATE TABLE IF NOT EXISTS `students_projects` (
  `student_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `students_skills`
--

CREATE TABLE IF NOT EXISTS `students_skills` (
  `student_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `technologies`
--

CREATE TABLE IF NOT EXISTS `technologies` (
`id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `technologies`
--

INSERT INTO `technologies` (`id`, `name`) VALUES
(1, 'PHP'),
(2, 'Java'),
(3, 'HTML'),
(4, 'C#'),
(5, 'JavaScript'),
(6, 'Git'),
(7, 'RoR'),
(8, 'MySQL'),
(9, 'Oracle');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `user` varchar(150) NOT NULL,
  `role` int(11) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `cedula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visits`
--

CREATE TABLE IF NOT EXISTS `visits` (
`id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `visits_number` int(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `visits`
--

INSERT INTO `visits` (`id`, `name`, `visits_number`) VALUES
(1, 'Programacion', 0),
(2, 'Pensamiento Critico', 0),
(3, 'Resolucion de Problemas', 0),
(4, 'Estrategias de aprendizaje', 0),
(5, 'Coordinacion', 0),
(6, 'Manejo de tiempo', 0),
(7, 'Matematicas', 0),
(8, 'PHP', 0),
(9, 'Java', 0),
(10, 'HTML', 0),
(11, 'C#', 0),
(12, 'JavaScript', 0),
(13, 'Git', 0),
(14, 'RoR', 0),
(15, 'MySQL', 0),
(16, 'Oracle', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `careers`
--
ALTER TABLE `careers`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `courses`
--
ALTER TABLE `courses`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `projects`
--
ALTER TABLE `projects`
 ADD PRIMARY KEY (`id`), ADD KEY `project_course` (`course_id`);

--
-- Indices de la tabla `project_technologies`
--
ALTER TABLE `project_technologies`
 ADD PRIMARY KEY (`project_id`,`technology_id`), ADD KEY `project_id` (`project_id`), ADD KEY `technology_id` (`technology_id`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `skills`
--
ALTER TABLE `skills`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `students`
--
ALTER TABLE `students`
 ADD PRIMARY KEY (`id`), ADD KEY `career_id` (`career_id`);

--
-- Indices de la tabla `students_comments`
--
ALTER TABLE `students_comments`
 ADD PRIMARY KEY (`student_id`,`comment_id`), ADD KEY `student_id` (`student_id`), ADD KEY `comment_id` (`comment_id`);

--
-- Indices de la tabla `students_projects`
--
ALTER TABLE `students_projects`
 ADD PRIMARY KEY (`student_id`,`project_id`), ADD KEY `student_id` (`student_id`), ADD KEY `project_id` (`project_id`);

--
-- Indices de la tabla `students_skills`
--
ALTER TABLE `students_skills`
 ADD PRIMARY KEY (`student_id`,`skill_id`), ADD KEY `student_id` (`student_id`), ADD KEY `skill_id` (`skill_id`);

--
-- Indices de la tabla `technologies`
--
ALTER TABLE `technologies`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD KEY `role` (`role`);

--
-- Indices de la tabla `visits`
--
ALTER TABLE `visits`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `careers`
--
ALTER TABLE `careers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `courses`
--
ALTER TABLE `courses`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `projects`
--
ALTER TABLE `projects`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `skills`
--
ALTER TABLE `skills`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `students`
--
ALTER TABLE `students`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `technologies`
--
ALTER TABLE `technologies`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `visits`
--
ALTER TABLE `visits`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `projects`
--
ALTER TABLE `projects`
ADD CONSTRAINT `course_id_project` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `project_technologies`
--
ALTER TABLE `project_technologies`
ADD CONSTRAINT `project_id_project_technologies` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `technology_id_project_technologies` FOREIGN KEY (`technology_id`) REFERENCES `technologies` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `students`
--
ALTER TABLE `students`
ADD CONSTRAINT `student_career` FOREIGN KEY (`career_id`) REFERENCES `careers` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `students_comments`
--
ALTER TABLE `students_comments`
ADD CONSTRAINT `comment_id_students_comments` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `student_id_students_comments` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `students_projects`
--
ALTER TABLE `students_projects`
ADD CONSTRAINT `project_id_students_projects` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `student_id_students_projects` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `students_skills`
--
ALTER TABLE `students_skills`
ADD CONSTRAINT `skill_id_students_skills` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `student_id_students_skills` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
