-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2023 at 10:46 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `form`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `airlines` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `departure_date` varchar(50) NOT NULL,
  `return_date` varchar(50) NOT NULL,
  `class` varchar(50) NOT NULL,
  `card_number` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `full_name`, `email`, `phone_number`, `airlines`, `destination`, `departure_date`, `return_date`, `class`, `card_number`) VALUES
(1, 'Normay Pangan', 'normaypangan@gmail.com', '0912892489', 'Philippine Airline', 'New York', '2023-12-18', '2023-12-31', 'First Class', 272741),
(2, 'Rainisia Macabangkit', 'macabangkitrainisia@gmail.com', '091518264', 'Philippine Airline', 'Arizona', '2023-12-10', '2023-12-27', 'Business', 386538),
(3, 'Cally Mochi', 'callyxi85@gmail.com', '213212003', 'Cebu Pacific', 'Washington', '2023-12-11', '2023-12-25', 'Economy', 457386382),
(4, 'Cassey Morales', 'casseydmorales@gmail.com', '0911512650', 'Cebu Pacific', 'New York', '2023-12-17', '2023-12-31', 'First Class', 5828528),
(5, 'Gabriel Macauley', 'gabrielmacauley127@gmail.com', '091268745', 'Air Asia', 'Miami', '2023-12-17', '2023-12-31', 'First Class', 1510864);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `email`, `comment`, `created_at`) VALUES
(1, 'Mark Zuckerberg', 'mark@gmail.com', 'Journey Masters made my travel experience truly unforgettable. From the personalized itinerary to the seamless execution, they exceeded my expectations. I can\'t wait for my next adventure with them!', '2023-12-10 07:15:58'),
(2, 'Elon Musk', 'elonmusk@gmail.com', 'I\'ve traveled with Journey Masters multiple times, and each journey has been a joy. Their attention to detail and commitment to creating \r\nmemorable experiences make them my go-to travel agency.', '2023-12-10 07:17:33'),
(3, 'Anonymous', 'annonymous@gmail.com', 'I\'ve traveled with many agencies, but Journey Masters stands out. Their commitment to creating unique journeys is unmatched. From booking to the actual trip, everything was smooth and enjoyable. Can\'t wait for my next trip with them', '2023-12-10 07:18:25');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tel` int(11) NOT NULL,
  `message` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
