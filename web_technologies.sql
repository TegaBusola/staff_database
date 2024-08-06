-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2024 at 07:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_technologies`
--

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `ID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Position` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`ID`, `FirstName`, `LastName`, `Email`, `Position`) VALUES
(1, 'John', 'Smith', 'john.smith@email.com', 'Professor'),
(2, 'Saara', 'Ali', 'saara.ali@email.com', 'Senior Lecturer'),
(3, 'Joe', 'Goldberg', 'joe.goldberg@email.com', 'Professor'),
(4, 'Kennedy', 'Ryan', 'kennedy.ryan@email.com', 'Senior Lecturer'),
(5, 'Katee', 'Roberts', 'katee.roberts@email.com', 'Professor'),
(6, 'Colleen', 'Hoover', 'colleen.hoover@email.com', 'Reader'),
(7, 'Steve', 'Cavanaugh', 'steve.cavanaugh@email.com', 'Lecturer'),
(8, 'Lee', 'Young', 'lee.young@email.com', 'Reader'),
(9, 'George', 'Elliot', 'george.elliot@email.com', 'Senior Lecturer'),
(10, 'Jane', 'Doe', 'jane.doe@email.com', 'Reader');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
