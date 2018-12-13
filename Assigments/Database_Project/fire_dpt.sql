-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 02, 2018 at 10:20 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fire_dpt`
--

-- --------------------------------------------------------

--
-- Table structure for table `certifications`
--

CREATE TABLE `certifications` (
  `certification_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `certification_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certifications`
--

INSERT INTO `certifications` (`certification_id`, `name`, `certification_number`) VALUES
(2, 'Emergency Response', '2'),
(3, 'Windland Forrest', '1');

-- --------------------------------------------------------

--
-- Table structure for table `incident`
--

CREATE TABLE `incident` (
  `incident_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `incident_type` varchar(255) NOT NULL,
  `location` int(11) NOT NULL,
  `station_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `incident`
--

INSERT INTO `incident` (`incident_id`, `date`, `incident_type`, `location`, `station_id`) VALUES
(2, 23, 'wqw', 333, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `item_condition` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `station_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `name`, `brand`, `type`, `description`, `item_condition`, `quantity`, `station_id`) VALUES
(1, 'hose', 'Raw-Hide', 'Single Jacket Mill', 'Designed for prolonged storage and extended service for wash down applications and other light duty service.', 'new', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `involved_party`
--

CREATE TABLE `involved_party` (
  `involved_party_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `driver_license` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `insurance_number` varchar(255) NOT NULL,
  `incident_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `involved_party`
--

INSERT INTO `involved_party` (`involved_party_id`, `name`, `address`, `driver_license`, `phone_number`, `insurance_number`, `incident_id`) VALUES
(3, 'Sebastian Rodriguez', '941 N Sugar Rd, Apt. 812', '31221s', '5073905838', 'wq12', 2);

-- --------------------------------------------------------

--
-- Table structure for table `jurisdiction`
--

CREATE TABLE `jurisdiction` (
  `jurisdiction_id` int(11) NOT NULL,
  `zone_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurisdiction`
--

INSERT INTO `jurisdiction` (`jurisdiction_id`, `zone_name`) VALUES
(1, 'North-West'),
(2, 'South-East');

-- --------------------------------------------------------

--
-- Table structure for table `personnel`
--

CREATE TABLE `personnel` (
  `personnel_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `height` varchar(255) NOT NULL,
  `weight` int(11) NOT NULL,
  `ssn` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `certification_id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`personnel_id`, `name`, `address`, `height`, `weight`, `ssn`, `phone_number`, `shift_id`, `certification_id`, `station_id`) VALUES
(10, 'Sebastian Rodriguez', '941 N Sugar Rd, Apt. 812', '21', 2121, '21212', '5073905838', 1, 2, 1),
(11, 'Rodriguez', '941 N Sugar Rd, Apt. 812', 'qww', 0, 'wqw', '5073905838', 1, 2, 1),
(12, 'Rodriguez', '941 N Sugar Rd, Apt. 812', 'qww', 0, 'wqw', '5073905838', 1, 2, 1),
(13, 'Rodriguez', '941 N Sugar Rd, Apt. 812', 'qww', 0, 'wqw', '5073905838', 1, 2, 1),
(14, 'Daniel Rodriguez', '941 N Sugar Rd, Apt. 812', 'qww', 0, 'wqw', '5073905838', 1, 2, 1),
(15, 'Rodriguez', '941 N Sugar Rd, Apt. 812', 'qww', 0, 'wqw', '5073905838', 1, 2, 1),
(17, 'Juan Banana', '941 N Sugar Rd, Apt. 812', '6.0', 222, '111', '5073905838', 10, 2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `personnel_equipment`
--

CREATE TABLE `personnel_equipment` (
  `personnel_equipment_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `equipment_condition` varchar(255) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `personnel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `shift_id` int(11) NOT NULL,
  `shift_name` varchar(255) NOT NULL,
  `station_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`shift_id`, `shift_name`, `station_id`) VALUES
(1, 'Morning', 1),
(5, 'Afternoon', 1),
(10, 'Morning', 7);

-- --------------------------------------------------------

--
-- Table structure for table `station`
--

CREATE TABLE `station` (
  `station_id` int(11) NOT NULL,
  `station_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `jurisdiction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `station`
--

INSERT INTO `station` (`station_id`, `station_name`, `address`, `jurisdiction_id`) VALUES
(1, 'NW Fire Deputy', '556 N Jackson Ave. Edinburg TX', 1),
(7, 'South-McAllen', '854 S Jackson Ave', 2);

-- --------------------------------------------------------

--
-- Table structure for table `supervisors`
--

CREATE TABLE `supervisors` (
  `supervisor_id` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `personnel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supervisors`
--

INSERT INTO `supervisors` (`supervisor_id`, `rank`, `personnel_id`) VALUES
(4, 1, 10),
(5, 0, 15);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `station_id` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_password`, `station_id`, `admin`) VALUES
(1, 'Mauricio01', '1234', 1, 1),
(2, 'admin', '$2y$10$.cbUiinHlEKOgPT.YBWEvuzj4X.byf95ohKOgnfHyCO9ds5rK5oAO', 1, 1),
(3, 'admin2', '$2y$10$OxwohzcR7qnqIiOxX7SiFuLC4MltS9nVZo8.sjl3CxdLVfZqC.XH2', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicle_id` int(11) NOT NULL,
  `make` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `vin` varchar(255) NOT NULL,
  `mileage` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `license_plate` varchar(255) NOT NULL,
  `station_id` int(11) NOT NULL,
  `in_service` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vehicle_id`, `make`, `model`, `year`, `vin`, `mileage`, `type`, `license_plate`, `station_id`, `in_service`) VALUES
(1, 'Toyota', 'Fire-Truck', 2011, '7287y4dwyi', 89000, 'Truck', '7291827', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certifications`
--
ALTER TABLE `certifications`
  ADD PRIMARY KEY (`certification_id`) USING BTREE;

--
-- Indexes for table `incident`
--
ALTER TABLE `incident`
  ADD PRIMARY KEY (`incident_id`) USING BTREE,
  ADD KEY `station_id` (`station_id`) USING BTREE;

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`) USING BTREE,
  ADD KEY `station_id` (`station_id`) USING BTREE;

--
-- Indexes for table `involved_party`
--
ALTER TABLE `involved_party`
  ADD PRIMARY KEY (`involved_party_id`) USING BTREE,
  ADD KEY `incident_id` (`incident_id`) USING BTREE;

--
-- Indexes for table `jurisdiction`
--
ALTER TABLE `jurisdiction`
  ADD PRIMARY KEY (`jurisdiction_id`) USING BTREE;

--
-- Indexes for table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`personnel_id`) USING BTREE,
  ADD KEY `shift_id` (`shift_id`),
  ADD KEY `certification_id` (`certification_id`),
  ADD KEY `station_id` (`station_id`);

--
-- Indexes for table `personnel_equipment`
--
ALTER TABLE `personnel_equipment`
  ADD PRIMARY KEY (`personnel_equipment_id`) USING BTREE,
  ADD KEY `personel_id` (`personnel_id`) USING BTREE;

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`shift_id`) USING BTREE,
  ADD KEY `station_id` (`station_id`) USING BTREE;

--
-- Indexes for table `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`station_id`) USING BTREE,
  ADD KEY `jurisdiction_id` (`jurisdiction_id`) USING BTREE;

--
-- Indexes for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD PRIMARY KEY (`supervisor_id`) USING BTREE,
  ADD KEY `personnel_id` (`personnel_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`) USING BTREE,
  ADD KEY `station_id` (`station_id`) USING BTREE;

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_id`) USING BTREE,
  ADD KEY `station_id` (`station_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certifications`
--
ALTER TABLE `certifications`
  MODIFY `certification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `incident`
--
ALTER TABLE `incident`
  MODIFY `incident_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `involved_party`
--
ALTER TABLE `involved_party`
  MODIFY `involved_party_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jurisdiction`
--
ALTER TABLE `jurisdiction`
  MODIFY `jurisdiction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `personnel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personnel_equipment`
--
ALTER TABLE `personnel_equipment`
  MODIFY `personnel_equipment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `shift_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `station`
--
ALTER TABLE `station`
  MODIFY `station_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `supervisors`
--
ALTER TABLE `supervisors`
  MODIFY `supervisor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `incident`
--
ALTER TABLE `incident`
  ADD CONSTRAINT `incident_ibfk_1` FOREIGN KEY (`station_id`) REFERENCES `station` (`station_id`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`station_id`) REFERENCES `station` (`station_id`);

--
-- Constraints for table `involved_party`
--
ALTER TABLE `involved_party`
  ADD CONSTRAINT `involved_party_ibfk_1` FOREIGN KEY (`incident_id`) REFERENCES `incident` (`incident_id`);

--
-- Constraints for table `personnel`
--
ALTER TABLE `personnel`
  ADD CONSTRAINT `personnel_ibfk_1` FOREIGN KEY (`shift_id`) REFERENCES `shift` (`shift_id`),
  ADD CONSTRAINT `personnel_ibfk_2` FOREIGN KEY (`certification_id`) REFERENCES `certifications` (`certification_id`),
  ADD CONSTRAINT `personnel_ibfk_3` FOREIGN KEY (`station_id`) REFERENCES `station` (`station_id`);

--
-- Constraints for table `personnel_equipment`
--
ALTER TABLE `personnel_equipment`
  ADD CONSTRAINT `personnel_equipment_ibfk_1` FOREIGN KEY (`personnel_id`) REFERENCES `personnel` (`personnel_id`);

--
-- Constraints for table `shift`
--
ALTER TABLE `shift`
  ADD CONSTRAINT `shift_ibfk_2` FOREIGN KEY (`station_id`) REFERENCES `station` (`station_id`);

--
-- Constraints for table `station`
--
ALTER TABLE `station`
  ADD CONSTRAINT `station_ibfk_3` FOREIGN KEY (`jurisdiction_id`) REFERENCES `jurisdiction` (`jurisdiction_id`);

--
-- Constraints for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD CONSTRAINT `supervisors_ibfk_1` FOREIGN KEY (`personnel_id`) REFERENCES `personnel` (`personnel_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`station_id`) REFERENCES `station` (`station_id`);

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_2` FOREIGN KEY (`station_id`) REFERENCES `station` (`station_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
