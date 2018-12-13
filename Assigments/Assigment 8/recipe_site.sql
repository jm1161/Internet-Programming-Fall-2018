-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2018 at 05:40 PM
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
-- Database: `recipe_site`
--

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE `recipe` (
  `id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `prep_time` int(11) NOT NULL,
  `total_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`id`, `image_url`, `name`, `description`, `prep_time`, `total_time`) VALUES
(3, 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxMTEhUTExMWFhUXGBgYGRgXGR8dGBogGBoYGhodGhsaHyggGxolHRcdITMiJSkrLi4uHR8zODMtNygtLisBCgoKDg0OGxAQGzAmICYtLS0tLzAtLS0tLy0tLS0tLS0tLS0tLS0tLS8tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLf/AABEIAJ8BPgMBEQACEQEDEQH/', 'Spaghetti and Meatballs', 'You have spaghetti pasta and have small balls of meat mixed with some tomato sauce.', 30, 60),
(4, 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxQTEhUTExMWFRUXGB0bGRgYFxgaHRgdGRoXGB0YHRgYHSggHR0lGxgXITEiJSkrLi4uFx8zODMtNygtLisBCgoKDg0OGhAQGy0mICYtLS0yLi0tLS0vLS0tLS0tLS8vLy0tLS0tLS0tLS0tLS0tLS0tLS0uLS0tLS0tLS0tLf/AABEIAOEA4QMBIgACEQEDEQH/', 'Guacamole', 'A paste of avocado mixed with diced tomatoes and a hint of cilantro and some lime juice.\r\n', 5, 10),
(5, 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxMTEhUTExMWFhUXGBgYGBgYGBgXGxgYHRcXGBgaGhcYHSggGholGxcXITEiJSkrLi4uFx8zODMtNygtLisBCgoKDg0OGxAQGy0mICUvLS0tLzUtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLf/AABEIALcBEwMBEQACEQEDEQH/', 'Cheese Enchiladas', 'Corn tortillas folded with a filler with chili and beans, smothered with american cheese on the top and cocked on the oven', 60, 120),
(6, 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxMTEhUTExMWFhUXGRoaGRgXGB0YHhoYGBgaGh0iHx4YHSggGx0lGxgYIzEhJSkrLi4uGB8zODMtNygtLisBCgoKDg0OGhAQGy0mICYtLS8wLy0tLS8tMDItLTUvLy4rKy4vLy0vLTUyLS0vLS0tLS0tKy8tLS0tLS01LS0tLf/AABEIAKgBLAMBIgACEQEDEQH/', 'Frito Pie', 'Corn Frito Lays mixed with some chili and beans and some american cheese.', 10, 15),
(7, 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxMTEhUTExMWFhUXGRgYGRgYGBggGRkfGxkYGB4dGxodHSggHxomGxsdITIhJSkrLi4uHR8zODMtNygtLisBCgoKDg0OGxAQGzclICYvLzAvMi4tLTUtLS0vNS8tMC84LS0rLS8tMC8tLS8rLy0tLS0tLy8tLy0vLS0tLS0tLf/AABEIARMAtwMBIgACEQEDEQH/', 'Chicken Fajitas', 'Slices of chicken breast seared in the grill good for a low carb diet also known as keto diet.', 45, 60);

-- --------------------------------------------------------

--
-- Table structure for table `steps`
--

CREATE TABLE `steps` (
  `id` int(11) NOT NULL,
  `step_number` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `recipe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `steps`
--

INSERT INTO `steps` (`id`, `step_number`, `description`, `recipe_id`) VALUES
(1, 1, 'Boil pasta in a pot with water and lots of salt', 3),
(2, 2, 'Cook  the meatballs', 3),
(3, 3, 'Cook the marinara sauce', 3),
(4, 4, 'Mix all together ', 3),
(5, 5, 'Serve in a plate', 3),
(6, 1, 'Open the avocado.', 4),
(7, 2, 'Scoop the insides  into a bowl', 4),
(8, 3, 'Smash the avocado', 4),
(9, 4, 'Add tomato diced and cilantro', 4),
(10, 5, 'Serve.', 4),
(11, 1, 'Cook the tortillas', 5),
(12, 2, 'Cook the filler', 5),
(13, 3, 'Fill and fold the tortilla', 5),
(14, 4, 'Heat in the oven', 5),
(15, 5, 'Serve', 5),
(16, 1, 'Open Frito lays chips bags', 6),
(17, 2, 'Cook chili and beans on stove', 6),
(18, 3, 'Pour chili and beans mixture into Frito lays chips', 6),
(19, 4, 'Mix well', 6),
(20, 5, 'Serve', 6),
(21, 1, 'Slice chicken breast into slices', 7),
(22, 2, 'Cook them in a stove', 7),
(23, 3, 'Add some lime juice', 7),
(24, 4, 'Mix well', 7),
(25, 5, 'Serve', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `steps`
--
ALTER TABLE `steps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `steps`
--
ALTER TABLE `steps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `steps`
--
ALTER TABLE `steps`
  ADD CONSTRAINT `steps_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
