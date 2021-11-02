-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 13, 2021 at 02:39 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `courses`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name_course` varchar(255) NOT NULL,
  `code_course` varchar(255) NOT NULL,
  `cao_points` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `image_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name_course`, `code_course`, `cao_points`, `start_date`, `image_id`) VALUES
(1, 'Accounting', 'CW948', '319', '2021-10-05', 1),
(2, 'Accounting and Finance', 'DK810', '307', '2021-10-05', 2),
(3, 'Aerospace Engineering', 'CW568', '359', '2021-10-05', 3),
(4, 'Agri-Food Production', 'DK882', '342', '2021-10-05', 4),
(5, 'Creative Media', 'DK769', '209', '2021-10-05', 5),
(6, 'Culinary Arts', 'DK753', '192', '2021-10-05', 6);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `file_name`) VALUES
(1, 'assets/img/college_01.png'),
(2, 'assets/img/college_02.png'),
(3, 'assets/img/college_03.png'),
(4, 'assets/img/college_04.png'),
(5, 'assets/img/college_05.png'),
(6, 'assets/img/college_06.png'),
(7, 'assets/img/college_07.png'),
(8, 'assets/img/college_08.png'),
(9, 'assets/img/college_09.png'),
(10, 'assets/img/college_10.png'),
(11, 'assets/img/college_11.png'),
(12, 'assets/img/college_12.png'),
(13, 'assets/img/college_13.png'),
(14, 'assets/img/college_14.png'),
(15, 'assets/img/college_15.png'),
(16, 'assets/img/college_16.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_image_fk` (`image_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `course_image_fk` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
