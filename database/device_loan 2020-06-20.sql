-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2020 at 03:12 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `device_loan`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'ronie', 'ronie');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `brand` varchar(64) NOT NULL,
  `model` varchar(256) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `brand`, `model`, `price`, `deleted`) VALUES
(1, 'ACER', 'TRAVELMATE TMB118-M-C3ME', '16500.00', 0),
(2, 'ACER', 'TRAVELMATE TMP2410-G2-M-380L', '23800.00', 0),
(3, 'ASD', '34234', '32342342.00', 1),
(4, 'ACER', 'ASPIRE 5 A514-52K-3472', '27499.00', 0),
(5, 'ACER', 'TRAVELMATE TMP249-G3-M-38PF', '27680.00', 0),
(6, 'ACER', 'ASPIRE 5 A514-52KG-339Z ', '30499.00', 0),
(7, 'ACER', 'ASPIRE 3 A315-55G-76YB', '47999.00', 0),
(8, 'ACER', 'TRAVELMATE TMP215-52G-729R', '50000.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(64) NOT NULL,
  `full_name` varchar(64) NOT NULL,
  `device_id` int(11) NOT NULL,
  `months` int(3) NOT NULL,
  `application_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `id` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `contact_no` varchar(128) NOT NULL,
  `email_address` varchar(128) NOT NULL,
  `date_inquired` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`id`, `full_name`, `contact_no`, `email_address`, `date_inquired`) VALUES
(4, 'Luisa Bayulut', '09999147146', 'no-email', '2020-06-17'),
(5, 'Lagrimas Apolonio', '09076450232', 'no-email', '2020-06-17'),
(6, 'De Guzman, Faye', '09169900029', 'no-email', '2020-06-17'),
(7, 'Marical Pempengco', '09498173477', '', '2020-06-17'),
(8, 'Rosary B. Thomas', '09086805657', '', '2020-06-17'),
(9, 'Maria Janela Trinidad', '09434570539', '', '2020-06-17'),
(10, 'Bernadeth Cayanan', '09269568092', '', '2020-06-17'),
(11, 'Cristina M. Serzo', '09093105775', '', '2020-06-18'),
(12, 'Josephine F. Icmat', '09356900116', '', '2020-06-19'),
(13, 'Giazel M. Luna', '09658090548', '', '2020-06-19'),
(14, 'Jenna Mae D.  Mateo', '09350753612', '', '2020-06-19'),
(15, 'Mary Joy O. Romaraog', '0926799755', '', '2020-06-19'),
(16, 'Lady Velante', '09956676040', '', '2020-06-19'),
(17, 'Roger Arcilla', '09157282202', '', '2020-06-19'),
(18, 'Francisca M. Tiqui', '09439107097', '', '2020-06-19');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `class` varchar(12) NOT NULL,
  `application_id` int(11) NOT NULL,
  `payment` int(12) NOT NULL,
  `payment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `class`, `application_id`, `payment`, `payment_date`) VALUES
(1, 'student', 4, 3050, '2020-06-17'),
(3, 'student', 17, 15000, '2020-06-18'),
(4, 'student', 19, 13750, '2020-06-18'),
(5, 'student', 18, 13750, '2020-06-18'),
(6, 'student', 16, 2750, '2020-06-18'),
(7, 'student', 14, 2750, '2020-06-18'),
(8, 'student', 13, 2750, '2020-06-18'),
(9, 'student', 12, 2750, '2020-06-18'),
(10, 'student', 11, 2750, '2020-06-18'),
(11, 'student', 10, 2750, '2020-06-18'),
(12, 'student', 9, 5000, '2020-06-18'),
(13, 'student', 8, 2768, '2020-06-18'),
(14, 'student', 7, 2750, '2020-06-18'),
(15, 'student', 6, 3050, '2020-06-18'),
(16, 'student', 5, 2750, '2020-06-18'),
(17, 'student', 20, 2750, '2020-06-18'),
(21, 'student', 21, 2768, '2020-06-19'),
(22, 'student', 22, 2750, '2020-06-19'),
(23, 'student', 23, 2380, '2020-06-19'),
(24, 'student', 24, 2750, '2020-06-19');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `student_id` varchar(64) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `device_id` int(11) NOT NULL,
  `level` varchar(128) NOT NULL,
  `months` int(2) NOT NULL,
  `application_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `student_id`, `full_name`, `device_id`, `level`, `months`, `application_date`) VALUES
(4, '0118200169', 'Emannuel Joy Taruc', 4, 'basic_education', 10, '2020-06-16'),
(5, '010170018', 'Saskhea Fiona G. Mengote', 4, 'basic_education', 10, '2020-06-16'),
(6, '011901556', 'Brince T. Pakingking', 6, 'basic_education', 10, '2020-06-16'),
(7, '010150089', 'Nathania S. Zabala', 4, 'basic_education', 10, '2020-06-16'),
(8, '011529336', 'Kneiwghkcole Redd Marquez', 5, 'basic_education', 10, '2020-06-16'),
(9, '010150010', 'Knewelle Purple Marquez', 8, 'basic_education', 10, '2020-06-16'),
(10, '010150062', 'Aiden Cyle A. De Jesus', 4, 'basic_education', 10, '2020-06-16'),
(11, '010180165', 'Rolie Jr. D. Cayabyab', 4, 'basic_education', 10, '2020-06-16'),
(12, '0120200151', 'Max Owen Gomez', 4, 'basic_education', 10, '2020-06-16'),
(13, '0115201178', 'Kenneth M. Tabanera', 4, 'basic_education', 10, '2020-06-17'),
(14, '09565272207', 'Kayeshia Marie T. Ricahuerta', 4, 'basic_education', 10, '2020-06-17'),
(16, '0117200529', 'Althea Therese Niña T. Olano', 4, 'basic_education', 10, '2020-06-18'),
(17, '0116201201', 'Emily Renee Sunga', 6, 'basic_education', 10, '2020-06-18'),
(18, '0120200281', 'Gabrielle D. Serrano', 4, 'basic_education', 10, '2020-06-18'),
(19, '0118201270', 'Josh Kirby D. Serrano', 4, 'basic_education', 10, '2020-06-18'),
(20, '011900589', 'LESHNEL MAE V. MONTIBON', 4, 'basic_education', 10, '2020-06-18'),
(21, '0120000001', 'Jinel Irene R. Rivera', 5, 'basic_education', 10, '2020-06-19'),
(22, '012000003', 'Bernadeth A. Cayanan', 4, 'basic_education', 10, '2020-06-19'),
(23, '012000433', 'Reyner Jan S. Dela Cruz', 2, 'basic_education', 10, '2020-06-19'),
(24, '0117200785', 'Mikayla Jade A. Gonzales', 4, 'basic_education', 10, '2020-06-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `device_id` (`device_id`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `device_id` (`device_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`device_id`) REFERENCES `devices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`device_id`) REFERENCES `devices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
