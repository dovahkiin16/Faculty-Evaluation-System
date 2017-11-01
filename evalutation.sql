-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2017 at 03:07 PM
-- Server version: 10.2.6-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evalutation`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `answer` tinyint(4) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `question` varchar(256) NOT NULL,
  `section` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `question`, `section`) VALUES
(1, 'Teacher is prepared for class', 'Explicit Curriculum'),
(2, 'Teacher knows his/her subject', 'Explicit Curriculum'),
(3, 'Teacher is organized and neat', 'Explicit Curriculum'),
(4, 'Teacher plans class time and assignments that help students to problem solve and think critically. Teacher provides activities that make subject matter meaningful.', 'Explicit Curriculum'),
(5, 'Teacher is flexible in accommodating for individual student needs', 'Explicit Curriculum'),
(6, 'Teacher is clear in giving directions and on explaining what is expected on assignments and tests', 'Explicit Curriculum'),
(7, 'Teacher allows you to be active in the classroom learning environment', 'Explicit Curriculum'),
(8, 'Teacher manages the time well', 'Explicit Curriculum'),
(9, 'Teacher is creative in developing activities and lessons. ', 'Explicit Curriculum'),
(10, 'Teacher returns homework in a timely manner', 'Explicit Curriculum'),
(11, 'Teacher encourages students to speak up and be active in the class', 'Explicit Curriculum'),
(12, 'Teacher has clear classroom procedures so students don\'t waste time', 'Explicit Curriculum'),
(13, 'Teacher grades fairly', 'Explicit Curriculum'),
(14, 'I have learned a lot from this teacher about this subject', 'Explicit Curriculum'),
(15, 'Teacher gives me good feedback on homework and projects so that I can improve', 'Explicit Curriculum'),
(16, 'Teacher follows through on what he/she says. You can count on the teacher’s word. ', 'Implicit Curriculum'),
(17, 'Teacher listens and understands students’ point of view; he/she may not agree, but students feel understood.', 'Implicit Curriculum'),
(18, 'Teacher respects the opinions and decisions of students', 'Implicit Curriculum'),
(19, 'Teacher is willing to accept responsibility for his/her own mistakes. ', 'Implicit Curriculum'),
(20, 'Teacher is willing to learn from students. ', 'Implicit Curriculum'),
(21, 'Teacher is sensitive to the needs of students. ', 'Implicit Curriculum'),
(22, 'Teacher’s words and actions match. ', 'Implicit Curriculum'),
(23, 'Teacher is fun to be with. ', 'Implicit Curriculum'),
(24, 'Teacher likes and respects students. ', 'Implicit Curriculum'),
(25, 'Teacher helps you when you ask for help. ', 'Implicit Curriculum'),
(26, 'Teacher is consistent and fair in discipline. ', 'Implicit Curriculum'),
(27, 'I trust this teacher. ', 'Implicit Curriculum'),
(28, 'Teacher tries to model what teacher expects of students', 'Implicit Curriculum'),
(29, 'Teacher is fair and firm in discipline without being too strict. ', 'Implicit Curriculum');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `exam_room_no` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `type` varchar(12) NOT NULL,
  `fname` varchar(64) NOT NULL,
  `lname` varchar(64) NOT NULL,
  `id_number` varchar(64) NOT NULL,
  `pwd` varchar(64) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `confirmed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `type`, `fname`, `lname`, `id_number`, `pwd`, `section_id`, `date_created`, `confirmed`) VALUES
(1, 'admin', 'Mervin', 'Sabandal', '20142014', '$2y$10$a8rZ0iEeWksHTXOkJKMque0b7TcjbaeMjM7WTWxq.2ZuKUQUavUR2', NULL, '2017-10-17 16:00:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`id_number`),
  ADD KEY `section_id` (`section_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`),
  ADD CONSTRAINT `answer_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `answer_ibfk_4` FOREIGN KEY (`teacher_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`),
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
