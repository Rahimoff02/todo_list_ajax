-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 03, 2023 at 01:42 PM
-- Server version: 10.5.15-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u387328485_faiqo`
--

-- --------------------------------------------------------

--
-- Table structure for table `mytapsiriq`
--

CREATE TABLE `mytapsiriq` (
  `id` int(11) NOT NULL,
  `tapsiriq` varchar(255) NOT NULL,
  `gelecek` date NOT NULL,
  `saat` time NOT NULL,
  `user_id` int(11) NOT NULL,
  `tarix` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mytapsiriq`
--

INSERT INTO `mytapsiriq` (`id`, `tapsiriq`, `gelecek`, `saat`, `user_id`, `tarix`) VALUES
(155, 'Imameliyle gorus', '2022-11-24', '16:09:00', 1, '2022-11-20 13:09:13'),
(156, 'test', '2022-11-20', '13:18:00', 1, '2022-11-20 13:17:14'),
(157, 'Ali ile gorush', '2022-11-23', '18:38:00', 24, '2022-11-22 18:38:42'),
(158, 'dsadas', '2022-11-25', '19:09:00', 1, '2022-11-24 19:07:32'),
(163, 'Kinoya', '2023-01-30', '05:30:00', 33, '2023-01-25 11:27:21'),
(164, 'Futbol oynamaq', '2023-01-25', '04:28:00', 33, '2023-01-25 11:28:07'),
(165, 'Dostlarla gorush', '2023-01-25', '12:30:00', 33, '2023-01-25 11:29:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `ad` varchar(20) NOT NULL,
  `soyad` varchar(20) NOT NULL,
  `telefon` varchar(30) NOT NULL,
  `email` varchar(35) NOT NULL,
  `parol` varchar(70) NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'images/user.png',
  `tarix` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ad`, `soyad`, `telefon`, `email`, `parol`, `foto`, `tarix`) VALUES
(1, 'Faiq', 'Rehimov', '+99455-674-87-34', 'rehimov.faiq15@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'images/1668868339.png', '2022-11-19 14:40:33'),
(24, 'Ali', 'Mammadov', '+994502151645', 'ali189_1999@mail.ru', 'f865b53623b121fd34ee5426c792e5c33af8c227', 'images/user.png', '2022-11-22 14:38:16'),
(27, 'orxan', 'panahov', '0514880030', 'orxan.panahli@mail.ru', '7b52009b64fd0a2a49e6d8a939753077792b0554', 'images/user.png', '2022-12-14 09:14:35'),
(28, 'Mark', 'Zukkenberg', '0501110101', 'mark.zukkenber@mail.ru', '8cb2237d0679ca88db6464eac60da96345513964', 'images/user.png', '2022-12-14 09:16:10'),
(33, 'Vusal', 'Seyidli', '+994507770717', 'vusal@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'images/user.png', '2023-01-25 07:26:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mytapsiriq`
--
ALTER TABLE `mytapsiriq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mytapsiriq`
--
ALTER TABLE `mytapsiriq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
