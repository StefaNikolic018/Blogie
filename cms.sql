-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2020 at 05:36 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) NOT NULL,
  `vremedatum` varchar(50) NOT NULL,
  `korisnickoime` varchar(50) NOT NULL,
  `lozinka` text NOT NULL,
  `ime` varchar(30) NOT NULL,
  `dodao` varchar(30) NOT NULL,
  `zvanje` varchar(20) NOT NULL,
  `bio` varchar(500) NOT NULL,
  `slika` varchar(60) NOT NULL DEFAULT 'avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `vremedatum`, `korisnickoime`, `lozinka`, `ime`, `dodao`, `zvanje`, `bio`, `slika`) VALUES
(12, '2020-06-March 13:17:53', 'Stefan', '$2y$10$SgvhYqMIDmPdiRPSvMWHnuv9JmoB6KrWCtzivDWDo/pNw75BDfyJi', 'Stefan', 'Stefan', 'Web developer', 'Bavim se razvitkom web aplikacija (BackEnd), tehnologije kojima se služim tokom godina rada su :\r\n-PHP,MySql\r\n-Node.JS, MongoDB(Atlas)\r\n-Python (Flask)', 'IMG_20180223_225730_processed.jpg'),
(13, '2020-06-March 13:50:37', 'admin', '$2y$10$kWWKLd.pG0FxxMDieznKde6ry0z39XHpAGWcShtQ00Y5FQmSEL30q', 'stefan', 'Stefan', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `kategorije`
--

CREATE TABLE `kategorije` (
  `id` int(11) NOT NULL,
  `naslov` varchar(50) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `datumvreme` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategorije`
--

INSERT INTO `kategorije` (`id`, `naslov`, `autor`, `datumvreme`) VALUES
(1, 'Tehnologije', 'Stefan', '2020-12-February 17:13:17'),
(2, 'Fitnes', 'Stefan', '2020-12-February 17:16:02'),
(3, 'Putovanje', 'Stefan', '2020-27-February 16:15:02'),
(4, 'Kinematografija', 'Stefan', '2020-06-March 13:51:03'),
(5, 'Vesti', 'admin', '2020-06-March 13:52:34'),
(6, 'Muzika', 'Stefan', '2020-15-March 16:02:03');

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE `komentari` (
  `id` int(10) NOT NULL,
  `vremedatum` varchar(50) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `komentar` varchar(500) NOT NULL,
  `dozvoljenod` varchar(50) NOT NULL,
  `status` varchar(3) NOT NULL,
  `postid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`id`, `vremedatum`, `ime`, `email`, `komentar`, `dozvoljenod`, `status`, `postid`) VALUES
(4, '2020-05-March 13:47:42', 'Stefan', 'stefan@gmail.com', 'Ovo je neki komentar koji sluzi za testiranje prilikom izgradnje stranice', 'Stefan', 'off', 9);

-- --------------------------------------------------------

--
-- Table structure for table `postovi`
--

CREATE TABLE `postovi` (
  `id` int(10) NOT NULL,
  `vremedatum` varchar(15) NOT NULL,
  `naslov` varchar(300) NOT NULL,
  `kategorija` varchar(50) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `slika` varchar(50) NOT NULL,
  `post` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `postovi`
--

INSERT INTO `postovi` (`id`, `vremedatum`, `naslov`, `kategorija`, `autor`, `slika`, `post`) VALUES
(9, '2020-04-March 0', 'MapaPraga', 'Putovanje', 'Stefan', 'seed mapa.png', 'Ovo je mapa SeedShopova koje bi trebali da posetimo... Ali nismo uspeli jer smo posecivali mnogo bolje i lepse stvari, pogotovo mnogo zdravije stvari za nasu psihu i buducnost putovanja koje planiramo zajedno...'),
(10, '2020-04-March 1', 'Tupac discrimination', 'Tehnologije', 'Stefan', 'Tupac discrimination.jpg', 'Diskriminacija po krajskoj osnovi. Izgleda da codecademy vise postovanja pruza za Biggie Smalls-a(sto je u redu), ali zapostavljaju i diskriminisu Tupaka. Sramota!'),
(12, '2020-15-March 1', 'Hadresfild', 'Kinematografija', 'Stefan', 'unnamed.jpg', 'Jedan od boljih filmova koji treba da se pogledaju. Utice na nas rast licnosti i jacanje karaktera u okruzenju u kome smo zaglavljeni.'),
(13, '2020-15-March 1', 'Scent of a woman', 'Kinematografija', 'Stefan', 'scent.jpg', 'Jedan od boljih filmova koje treba svako pogledati. Al Pacino glumi slepog coveka koji je prosao dosta toga u zivotu, i moze nas nauciti lekciji !'),
(14, '2020-15-March 1', 'Young Dolph & Key Glock', 'Muzika', 'Stefan', '1564149704_f7e6e2f864fd7f4720c5240674ac4026.jpg', 'Jedan od jacih albuma u danasnje vreme singlova i spotova!');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategorije`
--
ALTER TABLE `kategorije`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentari`
--
ALTER TABLE `komentari`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postid` (`postid`);

--
-- Indexes for table `postovi`
--
ALTER TABLE `postovi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kategorije`
--
ALTER TABLE `kategorije`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `komentari`
--
ALTER TABLE `komentari`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `postovi`
--
ALTER TABLE `postovi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentari`
--
ALTER TABLE `komentari`
  ADD CONSTRAINT `foreign` FOREIGN KEY (`postid`) REFERENCES `postovi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
