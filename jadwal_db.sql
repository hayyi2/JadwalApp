-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 28, 2018 at 11:37 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `now_jadwal_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accompaniment`
--

DROP TABLE IF EXISTS `accompaniment`;
CREATE TABLE IF NOT EXISTS `accompaniment` (
  `accompaniment_id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule_student_id` int(11) NOT NULL,
  `volunteer_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `student_status` int(1) NOT NULL,
  `volunteer_status` int(1) NOT NULL,
  `review` int(1) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`accompaniment_id`),
  KEY `schedule_student_id` (`schedule_student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=271 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accompaniment`
--

INSERT INTO `accompaniment` (`accompaniment_id`, `schedule_student_id`, `volunteer_id`, `date`, `student_status`, `volunteer_status`, `review`, `updated_at`) VALUES
(248, 15, 15, '2018-03-28', 0, 0, 0, '2018-03-28 17:54:54'),
(249, 16, 13, '2018-03-28', 0, 0, 0, '2018-03-28 17:54:54'),
(250, 17, 12, '2018-03-28', 0, 0, 0, '2018-03-28 17:54:54'),
(251, 30, 13, '2018-03-28', 0, 0, 0, '2018-03-28 17:54:54'),
(252, 31, 12, '2018-03-28', 0, 0, 0, '2018-03-28 17:54:54'),
(253, 32, 15, '2018-03-28', 0, 0, 0, '2018-03-28 17:54:54'),
(254, 18, 14, '2018-03-29', 0, 0, 0, '2018-03-28 17:54:54'),
(255, 19, 13, '2018-03-29', 0, 0, 0, '2018-03-28 17:54:54'),
(256, 33, 14, '2018-03-29', 0, 0, 0, '2018-03-28 17:54:54'),
(257, 20, 15, '2018-03-30', 0, 0, 0, '2018-03-28 17:54:54'),
(258, 13, 12, '2018-04-02', 0, 0, 0, '2018-03-28 17:54:54'),
(259, 14, 14, '2018-04-02', 0, 0, 0, '2018-03-28 17:54:54'),
(260, 29, 14, '2018-04-02', 0, 0, 0, '2018-03-28 17:54:54'),
(261, 15, 15, '2018-04-04', 0, 0, 0, '2018-03-28 17:54:54'),
(262, 16, 13, '2018-04-04', 0, 0, 0, '2018-03-28 17:54:54'),
(263, 17, 12, '2018-04-04', 0, 0, 0, '2018-03-28 17:54:54'),
(264, 30, 13, '2018-04-04', 0, 0, 0, '2018-03-28 17:54:54'),
(265, 31, 12, '2018-04-04', 0, 0, 0, '2018-03-28 17:54:54'),
(266, 32, 15, '2018-04-04', 0, 0, 0, '2018-03-28 17:54:54'),
(267, 18, 14, '2018-04-05', 0, 0, 0, '2018-03-28 17:54:54'),
(268, 19, 13, '2018-04-05', 0, 0, 0, '2018-03-28 17:54:54'),
(269, 33, 14, '2018-04-05', 0, 0, 0, '2018-03-28 17:54:54'),
(270, 20, 15, '2018-04-06', 0, 0, 0, '2018-03-28 17:54:54');

-- --------------------------------------------------------

--
-- Stand-in structure for view `accompaniment_input`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `accompaniment_input`;
CREATE TABLE IF NOT EXISTS `accompaniment_input` (
`accompaniment_id` int(11)
,`volunteer_id` int(11)
,`date` date
,`schedule_student_id` int(11)
,`start_at` time
,`end_at` time
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `accompaniment_mentah`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `accompaniment_mentah`;
CREATE TABLE IF NOT EXISTS `accompaniment_mentah` (
`accompaniment_id` int(11)
,`schedule_student_id` int(11)
,`volunteer_id` int(11)
,`date` date
,`student_id` int(11)
,`full_name` varchar(50)
,`nick_name` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `accompaniment_view`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `accompaniment_view`;
CREATE TABLE IF NOT EXISTS `accompaniment_view` (
`accompaniment_id` int(11)
,`schedule_student_id` int(11)
,`volunteer_id` int(11)
,`date` date
,`student_status` int(1)
,`volunteer_status` int(1)
,`review` int(1)
,`updated_at` datetime
,`student_id` int(11)
,`start_at` time
,`end_at` time
,`day` int(1)
,`room` varchar(100)
,`courses` varchar(100)
,`full_name` varchar(50)
,`nick_name` varchar(50)
,`volunteer_full_name` varchar(50)
,`volunteer_nick_name` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `admin_view`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `admin_view`;
CREATE TABLE IF NOT EXISTS `admin_view` (
`user_id` int(11)
,`username` varchar(100)
,`full_name` varchar(50)
,`nick_name` varchar(50)
,`last_login` datetime
,`login_count` int(11)
,`created_at` datetime
);

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

DROP TABLE IF EXISTS `faculties`;
CREATE TABLE IF NOT EXISTS `faculties` (
  `faculty_id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_name` varchar(100) NOT NULL,
  PRIMARY KEY (`faculty_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`faculty_id`, `faculty_name`) VALUES
(6, 'Fakultas satu'),
(7, 'Fakultas Dua'),
(8, 'Fakultas Tiga');

-- --------------------------------------------------------

--
-- Stand-in structure for view `faculty_view`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `faculty_view`;
CREATE TABLE IF NOT EXISTS `faculty_view` (
`faculty_id` int(11)
,`faculty_name` varchar(100)
,`majors_id` int(11)
,`majors_name` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

DROP TABLE IF EXISTS `majors`;
CREATE TABLE IF NOT EXISTS `majors` (
  `majors_id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_id` int(11) NOT NULL,
  `majors_name` varchar(100) NOT NULL,
  PRIMARY KEY (`majors_id`),
  KEY `faculty_id` (`faculty_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`majors_id`, `faculty_id`, `majors_name`) VALUES
(6, 6, 'Jurusan Satu'),
(7, 6, 'Jurusan Dua'),
(10, 6, 'Jurusan Tiga'),
(11, 7, 'Jurusan Empat'),
(12, 7, 'Jurusan Lima'),
(13, 7, 'Jurusan Enam'),
(14, 8, 'Jurusan Tujuh'),
(15, 8, 'Jurusan Delapan'),
(16, 8, 'Jurusan Sembilan');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
CREATE TABLE IF NOT EXISTS `options` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `option_key` varchar(100) NOT NULL,
  `option_value` text NOT NULL,
  PRIMARY KEY (`option_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_id`, `option_key`, `option_value`) VALUES
(1, 'app_name', 'Penjadwalan App'),
(2, 'app_description', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, quisquam dolore similique repudiandae? Repellat, atque culpa nihil deserunt quae quibusdam veniam ratione! Voluptas quo culpa eum rem, beatae numquam asperiores.'),
(3, 'start_use', '2018'),
(4, 'end_use', '2020'),
(5, 'max_volunteer', '4');

-- --------------------------------------------------------

--
-- Stand-in structure for view `pendampingan_laporan`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `pendampingan_laporan`;
CREATE TABLE IF NOT EXISTS `pendampingan_laporan` (
`date` varchar(7)
,`belum_datang` decimal(23,0)
,`mendampingi` decimal(23,0)
,`izin` decimal(23,0)
,`tidak_datang` decimal(23,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `permit`
--

DROP TABLE IF EXISTS `permit`;
CREATE TABLE IF NOT EXISTS `permit` (
  `permit_id` int(11) NOT NULL AUTO_INCREMENT,
  `accompaniment_id` int(11) NOT NULL,
  `student` int(1) NOT NULL,
  `clarification` text NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`permit_id`),
  KEY `accompaniment_id` (`accompaniment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `permit_view`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `permit_view`;
CREATE TABLE IF NOT EXISTS `permit_view` (
`permit_id` int(11)
,`student` int(1)
,`clarification` text
,`created_at` datetime
,`accompaniment_id` int(11)
,`schedule_student_id` int(11)
,`volunteer_id` int(11)
,`date` date
,`student_id` int(11)
,`full_name` varchar(50)
,`nick_name` varchar(50)
,`volunteer_full_name` varchar(50)
,`volunteer_nick_name` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `schedule_student`
--

DROP TABLE IF EXISTS `schedule_student`;
CREATE TABLE IF NOT EXISTS `schedule_student` (
  `schedule_student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `start_at` time NOT NULL,
  `end_at` time NOT NULL,
  `day` int(1) NOT NULL,
  `room` varchar(100) NOT NULL,
  `courses` varchar(100) NOT NULL,
  PRIMARY KEY (`schedule_student_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule_student`
--

INSERT INTO `schedule_student` (`schedule_student_id`, `student_id`, `start_at`, `end_at`, `day`, `room`, `courses`) VALUES
(13, 7, '07:00:00', '10:10:00', 1, 'MC 4.8', 'Pemograman Linier'),
(14, 7, '10:15:00', '12:55:00', 1, 'MC 4.9', 'Pengantar Rancob'),
(15, 7, '07:30:00', '10:10:00', 3, 'MC 4.9', 'Statistika Non Parametrik'),
(16, 7, '10:15:00', '12:00:00', 3, 'MC 3.8', 'Dasar-Dasar Pemrograman'),
(17, 7, '13:00:00', '15:40:00', 3, 'MC 4.6', 'Matematika II'),
(18, 7, '07:00:00', '10:10:00', 4, 'MC 2.1', 'Statistika Matematika I'),
(19, 7, '10:15:00', '12:55:00', 4, 'MC 4.6', 'Ekonomrika'),
(20, 7, '07:30:00', '10:10:00', 5, 'BM 2.1', 'Proses Stokastik'),
(29, 9, '14:45:00', '16:25:00', 1, 'GB 2.1', 'Statistika'),
(30, 9, '07:00:00', '08:40:00', 3, 'A 1.2', 'Ekologi Pertanian'),
(31, 9, '10:30:00', '12:10:00', 3, 'A 1.2', 'Dasar Ilmu Tanah'),
(32, 9, '14:45:00', '16:25:00', 3, 'A 3.2', 'Botani'),
(33, 9, '13:00:00', '14:00:00', 4, 'A 1.5', 'Klimatologi');

-- --------------------------------------------------------

--
-- Stand-in structure for view `schedule_student_view`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `schedule_student_view`;
CREATE TABLE IF NOT EXISTS `schedule_student_view` (
`student_id` int(11)
,`user_id` int(11)
,`username` varchar(100)
,`full_name` varchar(50)
,`nick_name` varchar(50)
,`majors_id` int(11)
,`class_of_college` year(4)
,`no_hp` varchar(15)
,`faculty_name` varchar(100)
,`majors_name` varchar(100)
,`schedule_student_id` int(11)
,`start_at` time
,`end_at` time
,`day` int(1)
,`room` varchar(100)
,`courses` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `schedule_volunteer`
--

DROP TABLE IF EXISTS `schedule_volunteer`;
CREATE TABLE IF NOT EXISTS `schedule_volunteer` (
  `schedule_volunteer_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `start_at` time NOT NULL,
  `end_at` time NOT NULL,
  `day` int(1) NOT NULL,
  `clarification` text NOT NULL,
  PRIMARY KEY (`schedule_volunteer_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule_volunteer`
--

INSERT INTO `schedule_volunteer` (`schedule_volunteer_id`, `student_id`, `start_at`, `end_at`, `day`, `clarification`) VALUES
(10, 12, '15:50:00', '17:45:00', 1, 'Kuliah'),
(11, 12, '09:20:00', '11:00:00', 2, 'Kuliah'),
(12, 12, '07:30:00', '09:10:00', 3, 'Kuliah'),
(13, 12, '09:20:00', '11:00:00', 4, 'Kuliah'),
(14, 12, '15:15:00', '17:45:00', 4, 'Kuliah'),
(15, 12, '07:00:00', '15:00:00', 5, 'Kuliah'),
(16, 13, '07:00:00', '09:30:00', 1, 'Kuliah'),
(17, 13, '09:30:00', '11:59:00', 1, 'Kuliah'),
(18, 13, '15:20:00', '17:49:00', 1, 'Kuliah'),
(19, 13, '09:30:00', '15:30:00', 2, 'Kuliah'),
(20, 13, '12:25:00', '15:19:00', 3, 'Kuliah'),
(21, 13, '15:00:00', '17:49:00', 4, 'Kuliah'),
(22, 13, '08:40:00', '11:09:00', 5, 'Kuliah'),
(23, 14, '06:30:00', '08:10:00', 1, 'Kuliah'),
(24, 14, '08:20:00', '10:00:00', 2, 'Kuliah'),
(25, 14, '08:20:00', '10:00:00', 3, 'Kuliah'),
(26, 14, '10:10:00', '14:00:00', 3, 'Kuliah'),
(27, 14, '10:10:00', '11:50:00', 4, 'Kuliah'),
(28, 14, '09:00:00', '10:40:00', 5, 'Kuliah'),
(29, 15, '07:00:00', '11:10:00', 1, 'Kuliah'),
(30, 15, '15:30:00', '17:10:00', 1, 'Kuliah'),
(31, 15, '13:00:00', '16:20:00', 2, 'Kuliah'),
(33, 15, '11:10:00', '12:50:00', 3, 'Kuliah'),
(34, 15, '10:20:00', '16:20:00', 4, 'Kuliah'),
(35, 15, '13:00:00', '15:30:00', 5, 'Kuliah');

-- --------------------------------------------------------

--
-- Stand-in structure for view `schedule_volunteer_group`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `schedule_volunteer_group`;
CREATE TABLE IF NOT EXISTS `schedule_volunteer_group` (
`student_id` int(11)
,`user_id` int(11)
,`username` varchar(100)
,`full_name` varchar(50)
,`nick_name` varchar(50)
,`no_hp` varchar(15)
,`schedule_volunteer_id` int(11)
,`start_at` time
,`end_at` time
,`day` int(1)
,`clarification` text
,`created_at` datetime
,`day1` varchar(258)
,`day2` varchar(258)
,`day3` varchar(258)
,`day4` varchar(258)
,`day5` varchar(258)
,`day6` varchar(258)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `schedule_volunteer_view`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `schedule_volunteer_view`;
CREATE TABLE IF NOT EXISTS `schedule_volunteer_view` (
`student_id` int(11)
,`user_id` int(11)
,`username` varchar(100)
,`full_name` varchar(50)
,`nick_name` varchar(50)
,`last_login` datetime
,`login_count` int(11)
,`majors_id` int(11)
,`class_of_college` year(4)
,`no_hp` varchar(15)
,`token` varchar(50)
,`faculty_id` int(11)
,`faculty_name` varchar(100)
,`majors_name` varchar(100)
,`schedule_volunteer_id` int(11)
,`start_at` time
,`end_at` time
,`day` int(1)
,`clarification` text
,`created_at` datetime
);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `majors_id` int(11) NOT NULL,
  `type` int(1) NOT NULL,
  `class_of_college` year(4) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `token` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`student_id`),
  KEY `user_id` (`user_id`),
  KEY `majors_id` (`majors_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `user_id`, `majors_id`, `type`, `class_of_college`, `no_hp`, `token`) VALUES
(7, 15, 6, 1, 2015, '123', NULL),
(9, 17, 10, 1, 2015, '123', NULL),
(12, 20, 14, 2, 2015, '1231', ''),
(13, 21, 7, 2, 2015, '123', ''),
(14, 22, 6, 2, 2015, '1231', ''),
(15, 23, 12, 2, 2015, '123', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `student_view`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `student_view`;
CREATE TABLE IF NOT EXISTS `student_view` (
`student_id` int(11)
,`user_id` int(11)
,`username` varchar(100)
,`full_name` varchar(50)
,`nick_name` varchar(50)
,`last_login` datetime
,`login_count` int(11)
,`majors_id` int(11)
,`class_of_college` year(4)
,`no_hp` varchar(15)
,`token` varchar(50)
,`faculty_id` int(11)
,`faculty_name` varchar(100)
,`majors_name` varchar(100)
,`created_at` datetime
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `nick_name` varchar(50) NOT NULL,
  `capability` int(1) NOT NULL,
  `last_login` datetime NOT NULL,
  `login_count` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `full_name`, `nick_name`, `capability`, `last_login`, `login_count`, `created_at`) VALUES
(1, 'admin', 'fc35090073d42c191306faf2c3114f6c6162ab9a64821232f2', 'Keroro Gunsou', 'Gunsou', 2, '2018-03-28 17:46:39', 43, '2018-01-27 11:11:20'),
(7, 'mimin', 'fc35090073d42c191306faf2c3114f6c6162ab9a64821232f2', 'Admin Dua', 'mimin', 2, '2018-01-27 23:43:58', 5, '2018-01-27 16:54:12'),
(15, '123451', 'fc35090073d42c191306faf2c3114f6c6162ab9a64821232f2', 'Aditya Ilham Pratama', 'Aditya', 1, '0000-00-00 00:00:00', 0, '2018-01-30 22:14:29'),
(17, '123453', 'fc35090073d42c191306faf2c3114f6c6162ab9a64821232f2', 'Krishna Sekar Larasati', 'Sekar', 1, '0000-00-00 00:00:00', 0, '2018-01-30 22:16:37'),
(20, '1231', 'fc35090073d42c191306faf2c3114f6c6162ab9a64821232f2', 'Febrina Fitria Ningrum', 'Febrina', 1, '0000-00-00 00:00:00', 0, '2018-01-30 22:54:13'),
(21, '1232', 'fc35090073d42c191306faf2c3114f6c6162ab9a64821232f2', 'Ghani Ilham Prawiradijaya', 'Ghani', 1, '0000-00-00 00:00:00', 0, '2018-01-30 22:54:55'),
(22, '1233', 'fc35090073d42c191306faf2c3114f6c6162ab9a64821232f2', 'Rahmana Ilmi Hakim', 'Rahmana', 1, '0000-00-00 00:00:00', 0, '2018-01-30 22:55:32'),
(23, '1234', 'fc35090073d42c191306faf2c3114f6c6162ab9a64821232f2', 'Farida Rosalinda', 'Farida', 1, '0000-00-00 00:00:00', 0, '2018-01-31 22:48:51');

-- --------------------------------------------------------

--
-- Stand-in structure for view `volunteer_resume`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `volunteer_resume`;
CREATE TABLE IF NOT EXISTS `volunteer_resume` (
`student_id` int(11)
,`user_id` int(11)
,`full_name` varchar(50)
,`nick_name` varchar(50)
,`mendampingi` decimal(23,0)
,`izin` decimal(23,0)
,`tidak_datang` decimal(23,0)
,`min_review` int(1)
,`max_review` int(1)
,`avg_review` decimal(14,4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `volunteer_view`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `volunteer_view`;
CREATE TABLE IF NOT EXISTS `volunteer_view` (
`student_id` int(11)
,`user_id` int(11)
,`username` varchar(100)
,`full_name` varchar(50)
,`nick_name` varchar(50)
,`last_login` datetime
,`login_count` int(11)
,`majors_id` int(11)
,`class_of_college` year(4)
,`no_hp` varchar(15)
,`token` varchar(50)
,`faculty_id` int(11)
,`faculty_name` varchar(100)
,`majors_name` varchar(100)
,`created_at` datetime
);

-- --------------------------------------------------------

--
-- Structure for view `accompaniment_input`
--
DROP TABLE IF EXISTS `accompaniment_input`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `accompaniment_input`  AS  select `accompaniment`.`accompaniment_id` AS `accompaniment_id`,`accompaniment`.`volunteer_id` AS `volunteer_id`,`accompaniment`.`date` AS `date`,`schedule_student`.`schedule_student_id` AS `schedule_student_id`,`schedule_student`.`start_at` AS `start_at`,`schedule_student`.`end_at` AS `end_at` from (`accompaniment` join `schedule_student` on((`accompaniment`.`schedule_student_id` = `schedule_student`.`schedule_student_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `accompaniment_mentah`
--
DROP TABLE IF EXISTS `accompaniment_mentah`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `accompaniment_mentah`  AS  select `accompaniment`.`accompaniment_id` AS `accompaniment_id`,`accompaniment`.`schedule_student_id` AS `schedule_student_id`,`accompaniment`.`volunteer_id` AS `volunteer_id`,`accompaniment`.`date` AS `date`,`students`.`student_id` AS `student_id`,`users`.`full_name` AS `full_name`,`users`.`nick_name` AS `nick_name` from ((`accompaniment` join `students` on((`accompaniment`.`volunteer_id` = `students`.`student_id`))) join `users` on((`users`.`user_id` = `students`.`user_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `accompaniment_view`
--
DROP TABLE IF EXISTS `accompaniment_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `accompaniment_view`  AS  select `accompaniment`.`accompaniment_id` AS `accompaniment_id`,`accompaniment`.`schedule_student_id` AS `schedule_student_id`,`accompaniment`.`volunteer_id` AS `volunteer_id`,`accompaniment`.`date` AS `date`,`accompaniment`.`student_status` AS `student_status`,`accompaniment`.`volunteer_status` AS `volunteer_status`,`accompaniment`.`review` AS `review`,`accompaniment`.`updated_at` AS `updated_at`,`schedule_student`.`student_id` AS `student_id`,`schedule_student`.`start_at` AS `start_at`,`schedule_student`.`end_at` AS `end_at`,`schedule_student`.`day` AS `day`,`schedule_student`.`room` AS `room`,`schedule_student`.`courses` AS `courses`,`student_view`.`full_name` AS `full_name`,`student_view`.`nick_name` AS `nick_name`,`volunteer`.`full_name` AS `volunteer_full_name`,`volunteer`.`nick_name` AS `volunteer_nick_name` from (((`accompaniment` join `schedule_student` on((`accompaniment`.`schedule_student_id` = `schedule_student`.`schedule_student_id`))) join `student_view` on((`schedule_student`.`student_id` = `student_view`.`student_id`))) join `volunteer_view` `volunteer` on((`accompaniment`.`volunteer_id` = `volunteer`.`student_id`))) order by `accompaniment`.`updated_at` desc ;

-- --------------------------------------------------------

--
-- Structure for view `admin_view`
--
DROP TABLE IF EXISTS `admin_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `admin_view`  AS  select `users`.`user_id` AS `user_id`,`users`.`username` AS `username`,`users`.`full_name` AS `full_name`,`users`.`nick_name` AS `nick_name`,`users`.`last_login` AS `last_login`,`users`.`login_count` AS `login_count`,`users`.`created_at` AS `created_at` from `users` where (`users`.`capability` = 2) ;

-- --------------------------------------------------------

--
-- Structure for view `faculty_view`
--
DROP TABLE IF EXISTS `faculty_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `faculty_view`  AS  select `faculties`.`faculty_id` AS `faculty_id`,`faculties`.`faculty_name` AS `faculty_name`,`majors`.`majors_id` AS `majors_id`,`majors`.`majors_name` AS `majors_name` from (`faculties` left join `majors` on((`majors`.`faculty_id` = `faculties`.`faculty_id`))) order by `faculties`.`faculty_id` ;

-- --------------------------------------------------------

--
-- Structure for view `pendampingan_laporan`
--
DROP TABLE IF EXISTS `pendampingan_laporan`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `pendampingan_laporan`  AS  select date_format(`accompaniment`.`date`,'%Y-%m') AS `date`,sum(if(((`accompaniment`.`volunteer_status` <> '4') and (`accompaniment`.`volunteer_status` <> '3') and (`accompaniment`.`volunteer_status` <> '5')),1,0)) AS `belum_datang`,sum(if((`accompaniment`.`volunteer_status` = '4'),1,0)) AS `mendampingi`,sum(if((`accompaniment`.`volunteer_status` = 3),1,0)) AS `izin`,sum(if((`accompaniment`.`volunteer_status` = 5),1,0)) AS `tidak_datang` from `accompaniment` group by date_format(`accompaniment`.`date`,'%Y-%m') ;

-- --------------------------------------------------------

--
-- Structure for view `permit_view`
--
DROP TABLE IF EXISTS `permit_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `permit_view`  AS  select `permit`.`permit_id` AS `permit_id`,`permit`.`student` AS `student`,`permit`.`clarification` AS `clarification`,`permit`.`created_at` AS `created_at`,`accompaniment_view`.`accompaniment_id` AS `accompaniment_id`,`accompaniment_view`.`schedule_student_id` AS `schedule_student_id`,`accompaniment_view`.`volunteer_id` AS `volunteer_id`,`accompaniment_view`.`date` AS `date`,`accompaniment_view`.`student_id` AS `student_id`,`accompaniment_view`.`full_name` AS `full_name`,`accompaniment_view`.`nick_name` AS `nick_name`,`accompaniment_view`.`volunteer_full_name` AS `volunteer_full_name`,`accompaniment_view`.`volunteer_nick_name` AS `volunteer_nick_name` from (`permit` join `accompaniment_view` on((`accompaniment_view`.`accompaniment_id` = `permit`.`accompaniment_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `schedule_student_view`
--
DROP TABLE IF EXISTS `schedule_student_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `schedule_student_view`  AS  select `student_view`.`student_id` AS `student_id`,`student_view`.`user_id` AS `user_id`,`student_view`.`username` AS `username`,`student_view`.`full_name` AS `full_name`,`student_view`.`nick_name` AS `nick_name`,`student_view`.`majors_id` AS `majors_id`,`student_view`.`class_of_college` AS `class_of_college`,`student_view`.`no_hp` AS `no_hp`,`student_view`.`faculty_name` AS `faculty_name`,`student_view`.`majors_name` AS `majors_name`,`schedule_student`.`schedule_student_id` AS `schedule_student_id`,`schedule_student`.`start_at` AS `start_at`,`schedule_student`.`end_at` AS `end_at`,`schedule_student`.`day` AS `day`,`schedule_student`.`room` AS `room`,`schedule_student`.`courses` AS `courses` from (`student_view` left join `schedule_student` on((`student_view`.`student_id` = `schedule_student`.`student_id`))) order by `student_view`.`student_id`,`schedule_student`.`day`,`schedule_student`.`start_at` ;

-- --------------------------------------------------------

--
-- Structure for view `schedule_volunteer_group`
--
DROP TABLE IF EXISTS `schedule_volunteer_group`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `schedule_volunteer_group`  AS  select `schedule_volunteer_view`.`student_id` AS `student_id`,`schedule_volunteer_view`.`user_id` AS `user_id`,`schedule_volunteer_view`.`username` AS `username`,`schedule_volunteer_view`.`full_name` AS `full_name`,`schedule_volunteer_view`.`nick_name` AS `nick_name`,`schedule_volunteer_view`.`no_hp` AS `no_hp`,`schedule_volunteer_view`.`schedule_volunteer_id` AS `schedule_volunteer_id`,`schedule_volunteer_view`.`start_at` AS `start_at`,`schedule_volunteer_view`.`end_at` AS `end_at`,`schedule_volunteer_view`.`day` AS `day`,`schedule_volunteer_view`.`clarification` AS `clarification`,`schedule_volunteer_view`.`created_at` AS `created_at`,ifnull(replace(replace(replace(concat('[',group_concat(if((`schedule_volunteer_view`.`day` = 1),concat('{','"start_at": "',`schedule_volunteer_view`.`start_at`,'",','"end_at": "',`schedule_volunteer_view`.`end_at`,'"','}'),'-') separator ','),']'),',-',''),'-,',''),'-',''),'[]') AS `day1`,ifnull(replace(replace(replace(concat('[',group_concat(if((`schedule_volunteer_view`.`day` = 2),concat('{','"start_at": "',`schedule_volunteer_view`.`start_at`,'",','"end_at": "',`schedule_volunteer_view`.`end_at`,'"','}'),'-') separator ','),']'),',-',''),'-,',''),'-',''),'[]') AS `day2`,ifnull(replace(replace(replace(concat('[',group_concat(if((`schedule_volunteer_view`.`day` = 3),concat('{','"start_at": "',`schedule_volunteer_view`.`start_at`,'",','"end_at": "',`schedule_volunteer_view`.`end_at`,'"','}'),'-') separator ','),']'),',-',''),'-,',''),'-',''),'[]') AS `day3`,ifnull(replace(replace(replace(concat('[',group_concat(if((`schedule_volunteer_view`.`day` = 4),concat('{','"start_at": "',`schedule_volunteer_view`.`start_at`,'",','"end_at": "',`schedule_volunteer_view`.`end_at`,'"','}'),'-') separator ','),']'),',-',''),'-,',''),'-',''),'[]') AS `day4`,ifnull(replace(replace(replace(concat('[',group_concat(if((`schedule_volunteer_view`.`day` = 5),concat('{','"start_at": "',`schedule_volunteer_view`.`start_at`,'",','"end_at": "',`schedule_volunteer_view`.`end_at`,'"','}'),'-') separator ','),']'),',-',''),'-,',''),'-',''),'[]') AS `day5`,ifnull(replace(replace(replace(concat('[',group_concat(if((`schedule_volunteer_view`.`day` = 6),concat('{','"start_at": "',`schedule_volunteer_view`.`start_at`,'",','"end_at": "',`schedule_volunteer_view`.`end_at`,'"','}'),'-') separator ','),']'),',-',''),'-,',''),'-',''),'[]') AS `day6` from `schedule_volunteer_view` group by `schedule_volunteer_view`.`student_id` order by rand() ;

-- --------------------------------------------------------

--
-- Structure for view `schedule_volunteer_view`
--
DROP TABLE IF EXISTS `schedule_volunteer_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `schedule_volunteer_view`  AS  select `volunteer_view`.`student_id` AS `student_id`,`volunteer_view`.`user_id` AS `user_id`,`volunteer_view`.`username` AS `username`,`volunteer_view`.`full_name` AS `full_name`,`volunteer_view`.`nick_name` AS `nick_name`,`volunteer_view`.`last_login` AS `last_login`,`volunteer_view`.`login_count` AS `login_count`,`volunteer_view`.`majors_id` AS `majors_id`,`volunteer_view`.`class_of_college` AS `class_of_college`,`volunteer_view`.`no_hp` AS `no_hp`,`volunteer_view`.`token` AS `token`,`volunteer_view`.`faculty_id` AS `faculty_id`,`volunteer_view`.`faculty_name` AS `faculty_name`,`volunteer_view`.`majors_name` AS `majors_name`,`schedule_volunteer`.`schedule_volunteer_id` AS `schedule_volunteer_id`,`schedule_volunteer`.`start_at` AS `start_at`,`schedule_volunteer`.`end_at` AS `end_at`,`schedule_volunteer`.`day` AS `day`,`schedule_volunteer`.`clarification` AS `clarification`,`volunteer_view`.`created_at` AS `created_at` from (`volunteer_view` left join `schedule_volunteer` on((`volunteer_view`.`student_id` = `schedule_volunteer`.`student_id`))) order by `volunteer_view`.`student_id`,`schedule_volunteer`.`day`,`schedule_volunteer`.`start_at` ;

-- --------------------------------------------------------

--
-- Structure for view `student_view`
--
DROP TABLE IF EXISTS `student_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `student_view`  AS  select `students`.`student_id` AS `student_id`,`users`.`user_id` AS `user_id`,`users`.`username` AS `username`,`users`.`full_name` AS `full_name`,`users`.`nick_name` AS `nick_name`,`users`.`last_login` AS `last_login`,`users`.`login_count` AS `login_count`,`students`.`majors_id` AS `majors_id`,`students`.`class_of_college` AS `class_of_college`,`students`.`no_hp` AS `no_hp`,`students`.`token` AS `token`,`faculty_view`.`faculty_id` AS `faculty_id`,`faculty_view`.`faculty_name` AS `faculty_name`,`faculty_view`.`majors_name` AS `majors_name`,`users`.`created_at` AS `created_at` from ((`users` join `students` on((`users`.`user_id` = `students`.`user_id`))) join `faculty_view` on((`faculty_view`.`majors_id` = `students`.`majors_id`))) where (`students`.`type` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `volunteer_resume`
--
DROP TABLE IF EXISTS `volunteer_resume`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `volunteer_resume`  AS  select `volunteer_view`.`student_id` AS `student_id`,`volunteer_view`.`user_id` AS `user_id`,`volunteer_view`.`full_name` AS `full_name`,`volunteer_view`.`nick_name` AS `nick_name`,sum(if((`accompaniment`.`volunteer_status` = '4'),1,0)) AS `mendampingi`,sum(if((`accompaniment`.`volunteer_status` = 3),1,0)) AS `izin`,sum(if((`accompaniment`.`volunteer_status` = 5),1,0)) AS `tidak_datang`,min(`accompaniment`.`review`) AS `min_review`,max(`accompaniment`.`review`) AS `max_review`,avg(`accompaniment`.`review`) AS `avg_review` from (`volunteer_view` join `accompaniment` on((`accompaniment`.`volunteer_id` = `volunteer_view`.`student_id`))) group by `volunteer_view`.`student_id` ;

-- --------------------------------------------------------

--
-- Structure for view `volunteer_view`
--
DROP TABLE IF EXISTS `volunteer_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `volunteer_view`  AS  select `students`.`student_id` AS `student_id`,`users`.`user_id` AS `user_id`,`users`.`username` AS `username`,`users`.`full_name` AS `full_name`,`users`.`nick_name` AS `nick_name`,`users`.`last_login` AS `last_login`,`users`.`login_count` AS `login_count`,`students`.`majors_id` AS `majors_id`,`students`.`class_of_college` AS `class_of_college`,`students`.`no_hp` AS `no_hp`,`students`.`token` AS `token`,`faculty_view`.`faculty_id` AS `faculty_id`,`faculty_view`.`faculty_name` AS `faculty_name`,`faculty_view`.`majors_name` AS `majors_name`,`users`.`created_at` AS `created_at` from ((`users` join `students` on((`users`.`user_id` = `students`.`user_id`))) join `faculty_view` on((`faculty_view`.`majors_id` = `students`.`majors_id`))) where (`students`.`type` = 2) ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accompaniment`
--
ALTER TABLE `accompaniment`
  ADD CONSTRAINT `accompaniment_ibfk_1` FOREIGN KEY (`schedule_student_id`) REFERENCES `schedule_student` (`schedule_student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `majors`
--
ALTER TABLE `majors`
  ADD CONSTRAINT `majors_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`faculty_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permit`
--
ALTER TABLE `permit`
  ADD CONSTRAINT `permit_ibfk_1` FOREIGN KEY (`accompaniment_id`) REFERENCES `accompaniment` (`accompaniment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule_student`
--
ALTER TABLE `schedule_student`
  ADD CONSTRAINT `schedule_student_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule_volunteer`
--
ALTER TABLE `schedule_volunteer`
  ADD CONSTRAINT `schedule_volunteer_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_4` FOREIGN KEY (`majors_id`) REFERENCES `majors` (`majors_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
