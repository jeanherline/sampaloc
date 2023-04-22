-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2023 at 02:45 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bsis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblaccess`
--

CREATE TABLE `tblaccess` (
  `aID` int(11) NOT NULL,
  `aUname` varchar(30) NOT NULL,
  `aPswd` varchar(30) NOT NULL,
  `aType` varchar(20) NOT NULL,
  `aStamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblaccess`
--

INSERT INTO `tblaccess` (`aID`, `aUname`, `aPswd`, `aType`, `aStamp`) VALUES
(10000, 'ernestoroque', 'barangaysampaloc', 'Chairman', '2023-02-16 14:38:10'),
(10001, 'rosariodelarosa', 'delarosa129', 'Kagawad', '2023-02-09 13:13:01'),
(10002, 'reneabraham', 'abrahamlincoln99', 'Kagawad', '2023-02-09 13:13:49'),
(10003, 'procesoroque', 'roque1974', 'Kagawad', '2023-02-09 13:14:56'),
(10004, 'esvetlanatobias', 'tobias', 'Kagawad', '2023-02-09 13:15:22'),
(10005, 'dexterpalopalo', 'palomeonyt', 'Kagawad', '2023-02-09 13:15:47'),
(10006, 'julietachico', 'chicotree03', 'Kagawad', '2023-02-09 13:17:09'),
(10007, 'hernandosantiago', 'covid192020', 'Secretary', '2023-02-10 02:47:34'),
(10008, 'edwincamacho', 'edwin12345', 'Treasurer', '2023-02-09 13:19:30'),
(10009, 'romchellcruz', 'cruz2002', 'SK Chairman', '2023-02-10 03:18:35'),
(10010, 'jiyasantiago', '032903', 'Resident', '2023-02-15 05:28:10'),
(10011, 'jimmy pamintuan', 'jimmz', 'Resident', '2023-02-09 14:46:13'),
(10012, 'reyesmarie', '123456marie', 'Archive', '2023-02-10 03:25:06'),
(10013, 'erzen_alberto', 'erzen03', 'Resident', '2023-02-09 14:45:26'),
(10014, 'donnaprincess', 'donnavalonda', 'Resident', '2023-02-19 06:47:39'),
(10015, 'cess123', 'cess123', 'Resident', '2023-02-14 15:18:35'),
(10016, 'earishpaguio', 'ann2020', 'Resident', '2023-02-09 14:47:47'),
(10017, 'angeloligon', 'ligon18', 'Resident', '2023-02-09 14:48:16'),
(10018, 'beapjoson', 'oct15', 'Rejected', '2023-02-10 04:42:18'),
(10019, 'lianjoson', 'lianjay', 'Restricted', '2023-02-16 16:29:02'),
(10020, 'shielaandrea', 'delacruz123', 'Rejected', '2023-02-10 04:42:45'),
(10021, 'kikovalencia', 'kikoko123', 'Pending', '2023-02-10 03:19:43'),
(10022, 'chloepineda', 'chloep', 'Archive', '2023-02-10 03:25:24'),
(10023, 'andrespaulino', 'paulino123', 'Pending', '2023-02-10 01:34:49'),
(10024, 'kirbymariano', 'kirby9008', 'Restricted', '2023-02-10 03:17:55'),
(10025, 'manuelitolacanilao', 'lacanilaomanuelito', 'Restricted', '2023-02-16 14:34:37'),
(10026, 'lisamallari', 'mallari234', 'Pending', '2023-02-10 01:39:07'),
(10027, 'georgebautista', 'bautista76', 'Rejected', '2023-02-10 04:43:02'),
(10028, 'kiancorpuz', 'kian67', 'Restricted', '2023-02-10 03:17:35'),
(10029, 'juansantos', 'juansantos06', 'Archive', '2023-02-10 03:23:14'),
(10032, 'tester_1', 'Tester_01', 'Pending', '2023-02-19 07:03:13'),
(10035, 'luisito_12', 'Luisito12', 'Resident', '2023-02-19 15:00:24');

-- --------------------------------------------------------

--
-- Table structure for table `tblblotter`
--

CREATE TABLE `tblblotter` (
  `bID` int(11) NOT NULL,
  `bDateR` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `bDateI` datetime NOT NULL,
  `bCompOut` varchar(50) DEFAULT NULL,
  `bPersOut` varchar(50) DEFAULT NULL,
  `bComp` int(11) DEFAULT NULL,
  `bLoc` varchar(50) NOT NULL,
  `bPers` int(11) DEFAULT NULL,
  `bReason` varchar(200) NOT NULL,
  `bAction` varchar(150) NOT NULL,
  `oID` int(11) NOT NULL,
  `bStatus` varchar(20) NOT NULL,
  `bOut` varchar(3) NOT NULL,
  `bStamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblblotter`
--

INSERT INTO `tblblotter` (`bID`, `bDateR`, `bDateI`, `bCompOut`, `bPersOut`, `bComp`, `bLoc`, `bPers`, `bReason`, `bAction`, `oID`, `bStatus`, `bOut`, `bStamp`) VALUES
(41000, '2023-02-18 16:01:39', '2023-02-10 02:44:56', NULL, NULL, 10014, 'Purok 1, Sampaloc, San Rafael', 10025, 'Karaoke Noise at 12AM', 'punishment & apology', 3104, 'Unsolved', '004', '2023-02-18 08:01:39'),
(41001, '2023-02-17 01:40:56', '2023-02-10 03:03:28', NULL, NULL, 10011, 'Purok 3, Sampaloc, San Rafael', 10017, 'Defamation', 'punishment and apology', 3104, 'Solved', '004', '2023-02-16 17:40:56'),
(41002, '2023-02-17 01:41:09', '2023-02-10 03:04:44', NULL, NULL, 10014, 'Purok 2, Sampaloc, San Rafael', 10019, 'Domestic Violence', 'Lawsuit', 3103, 'Solved', '004', '2023-02-16 17:41:09'),
(41003, '2023-02-19 22:33:34', '2023-02-10 03:10:03', NULL, NULL, 10016, 'Purok 5, Sampaloc, San Rafael, Bulacan', 10024, 'Stalking And attempted break in', 'Lawsuit', 3103, 'Unsolved', '004', '2023-02-19 14:33:34'),
(41004, '2023-02-17 01:41:42', '2023-02-10 03:12:40', NULL, NULL, 10015, 'Purok 2, Sampaloc, San Rafael', 10017, 'Domestic Violence', 'Lawsuit and apology', 3108, 'Solved', '004', '2023-02-16 17:41:42'),
(41005, '2023-02-17 01:41:57', '2023-02-10 03:13:41', NULL, NULL, 10017, 'Purok 2, Sampaloc, San Rafael', 10013, 'Noise ', 'Apology ', 3108, 'Solved', '004', '2023-02-16 17:41:57'),
(41006, '2023-02-17 01:42:13', '2023-02-10 03:19:52', NULL, NULL, 10011, 'Purok 2, Sampaloc, San Rafael', 10025, 'Sabong', 'Penalty', 3106, 'Solved', '004', '2023-02-16 17:42:13'),
(41007, '2023-02-17 01:42:51', '2023-02-10 03:21:26', NULL, NULL, 10015, 'Purok 4, Sampaloc, San Rafael', 10028, 'Not disposing trash in proper way', 'Community Service and penalty', 3103, 'Archive', '004', '2023-02-16 17:42:51'),
(41008, '2023-02-18 16:09:25', '2023-02-10 03:24:52', NULL, NULL, 10010, 'Purok 4, Sampaloc, San Rafael', 10028, 'Vehicle Noise every 3AM', 'Tatanggalan ng Makina ang Kotse ng Nasasakdal', 3103, 'Unsolved', '004', '2023-02-18 08:09:25'),
(41009, '2023-02-17 01:43:23', '2023-02-10 03:27:03', NULL, NULL, 10019, 'Purok 4, Sampaloc, San Rafael', 10013, 'Sabong', 'Penalty', 3105, 'Solved', '004', '2023-02-16 17:43:23'),
(41010, '2023-02-17 01:44:27', '2023-02-10 03:27:49', NULL, NULL, 10013, 'Purok 3, Sampaloc, San Rafael', 10024, 'Gambling', 'Penalty', 3106, 'Solved', '004', '2023-02-16 17:44:27'),
(41012, '2023-02-18 16:08:21', '2023-02-16 16:49:00', NULL, NULL, 10015, 'purok 2', 10024, 'Kinain chicken skin ko', 'bibilhan ng isang bucket ng chicken joy', 3106, 'Unsolved', '004', '2023-02-18 08:08:21'),
(41014, '2023-02-18 15:29:26', '2023-02-15 00:28:00', 'Maria Clara Infantes', NULL, NULL, 'purok 9, Barangay Sampaloc, San Rafael', 10024, 'Assault', 'lawsuit', 3104, 'Unsolved', '001', '2023-02-18 07:29:26'),
(41023, '2023-02-18 16:07:46', '2023-02-14 00:35:00', NULL, 'Elias', 10010, 'Barangay Singkamas', NULL, 'Holdap', 'Hinahanap na sa Barangay Kamote', 3105, 'Unsolved', '002', '2023-02-18 08:07:46'),
(41029, '2023-02-18 15:35:48', '2023-02-06 01:13:00', 'Crisostomo Ibarra', 'Padre Damaso', NULL, 'Purok 1, Barangay Sampaloc, San Rafael, Baliwag', 10000, 'Gang War', 'Police Intervention', 3105, 'Unsolved', '003', '2023-02-18 07:35:48'),
(41030, '2023-02-18 00:26:34', '2023-02-06 01:15:00', NULL, NULL, 10016, 'purok 9', 10024, 'Chismis', 'Pinutulan ng dila', 3106, 'Unsolved', '004', '2023-02-17 16:26:34'),
(41031, '2023-02-17 23:51:07', '2023-02-14 17:24:00', 'Pepito Manaloto', NULL, NULL, 'Purok 1, Barangay Sampaloc, San Rafael', 10024, 'Littering', 'Community Service', 3103, 'Solved', '001', '2023-02-17 15:51:07');

-- --------------------------------------------------------

--
-- Table structure for table `tblclearance`
--

CREATE TABLE `tblclearance` (
  `cID` int(11) NOT NULL,
  `cNum` varchar(20) NOT NULL,
  `cFindings` varchar(200) NOT NULL,
  `cPurpose` varchar(100) NOT NULL,
  `cOR` varchar(20) NOT NULL,
  `cAmount` varchar(10) NOT NULL,
  `cStatus` varchar(20) NOT NULL,
  `aID` int(11) NOT NULL,
  `cStamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblclearance`
--

INSERT INTO `tblclearance` (`cID`, `cNum`, `cFindings`, `cPurpose`, `cOR`, `cAmount`, `cStatus`, `aID`, `cStamp`) VALUES
(10000, '2023-001', 'N/A', 'Legal', '89673-78911', '25', 'Approved', 10010, '2023-02-10 04:38:08'),
(10001, '', '', 'Work Application', '', '', 'Pending', 10011, '2023-02-19 07:22:31'),
(10002, '', '', 'Legal', '', '', 'Approved', 10019, '2023-02-10 06:12:53'),
(10003, '', '', 'Job Fair Application', '', '', 'Pending', 10015, '2023-02-19 14:15:10'),
(10004, 'N/A', 'Existing Blotter Record', 'Work', 'N/A', 'N/A', 'Declined', 10025, '2023-02-10 03:52:12'),
(10005, '', '', 'Scholarship', '', '', 'Pending', 10015, '2023-02-19 14:30:36'),
(10006, '2023-001', 'N/A', 'Loan', '13762-28493', '50', 'Approved', 10028, '2023-02-19 15:02:00'),
(10007, '', '', 'Scholarship', '', '', 'Pending', 10013, '2023-02-10 03:41:09'),
(10008, '', '', 'Passport', '', '', 'Pending', 10019, '2023-02-10 03:42:21'),
(10009, '2023-001', '', 'Marriage', '', '', 'Pending', 10025, '2023-02-19 06:59:03'),
(10012, '', '', 'Passport', '', '', 'Pending', 10014, '2023-02-10 03:49:07'),
(10014, '', '', 'Job Application', '', '', 'Pending', 10013, '2023-02-19 08:07:19'),
(10015, '', '', 'Job Application', '', '', 'Pending', 10014, '2023-02-19 13:48:31'),
(10016, '', '', 'Scholarship', '', '', 'Pending', 10013, '2023-02-19 13:48:31'),
(10017, '2023-001', '', 'Job Application', 'N/A', '', 'Approved', 10024, '2023-02-20 01:24:20'),
(10018, '', '', 'Business Application', '', '', 'Pending', 10024, '2023-02-19 14:03:58'),
(10019, '', 'N/A', 'Legal', '', '25', 'Approved', 10019, '2023-02-19 14:05:27'),
(10020, '', '', 'Marriage', '', '', 'Pending', 10019, '2023-02-19 14:05:27');

-- --------------------------------------------------------

--
-- Table structure for table `tblofficials`
--

CREATE TABLE `tblofficials` (
  `oID` int(11) NOT NULL,
  `aID` int(11) NOT NULL,
  `oTermS` date NOT NULL,
  `oTermE` date NOT NULL,
  `oStatus` varchar(20) NOT NULL,
  `oStamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblofficials`
--

INSERT INTO `tblofficials` (`oID`, `aID`, `oTermS`, `oTermE`, `oStatus`, `oStamp`) VALUES
(3100, 10000, '2018-06-30', '2023-10-30', 'Approved', '2023-02-19 15:07:01'),
(3101, 10001, '2018-06-30', '2023-10-30', 'Approved', '2023-02-09 13:30:09'),
(3102, 10002, '2018-06-30', '2023-10-30', 'Approved', '2023-02-09 13:30:48'),
(3103, 10003, '2018-06-30', '2023-10-30', 'Approved', '2023-02-09 13:31:08'),
(3104, 10004, '2018-06-30', '2023-10-30', 'Approved', '2023-02-09 13:31:26'),
(3105, 10005, '2018-06-30', '2023-10-30', 'Approved', '2023-02-09 13:31:41'),
(3106, 10006, '2018-06-30', '2023-10-30', 'Approved', '2023-02-09 13:31:55'),
(3107, 10007, '2018-06-30', '2023-10-30', 'Approved', '2023-02-09 13:32:37'),
(3108, 10008, '2018-06-30', '2023-10-30', 'Approved', '2023-02-09 13:33:05'),
(3109, 10009, '2018-06-30', '2023-10-30', 'Approved', '2023-02-09 13:33:22');

-- --------------------------------------------------------

--
-- Table structure for table `tblpermit`
--

CREATE TABLE `tblpermit` (
  `pID` int(11) NOT NULL,
  `pNum` varchar(20) NOT NULL,
  `pFindings` varchar(200) NOT NULL,
  `pBName` varchar(50) NOT NULL,
  `pBAdd` varchar(60) NOT NULL,
  `pBType` varchar(50) NOT NULL,
  `pOR` varchar(20) NOT NULL,
  `pAmount` varchar(10) NOT NULL,
  `pStatus` varchar(20) NOT NULL,
  `aID` int(11) NOT NULL,
  `pStamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblpermit`
--

INSERT INTO `tblpermit` (`pID`, `pNum`, `pFindings`, `pBName`, `pBAdd`, `pBType`, `pOR`, `pAmount`, `pStatus`, `aID`, `pStamp`) VALUES
(10000, '2023-001', '', 'Theas Bicho', 'Purok 7, Sampaloc, San Rafael Bulacan', 'Food', 'N/A', '500', 'Approved', 10011, '2023-02-20 01:38:41'),
(10001, '', '', 'Jean\'s Tiangge', 'Purok 1, Sampaloc, San Rafael Bulacan', 'General Merchandise', '', '500', 'Pending', 10010, '2023-02-19 08:11:03'),
(10002, '2023-001', 'N/A', 'Hey Brew', 'Purok 3, Sampaloc, San Rafael Bulacan', 'Cafe', 'N/A', '500', 'Approved', 10016, '2023-02-20 01:17:21'),
(10003, '2023-001', 'N/A', 'Jimmz Sari-sari Store', 'Purok 2, Sampaloc, San Rafael Bulacan', 'Sari-sari Store', '12009122', '500', 'Approved', 10011, '2023-02-19 15:20:13'),
(10004, '', '', 'Ukay-ukay ', 'Purok 2, Sampaloc, San Rafael Bulacan', 'Thrift Store', '', '500', 'Pending', 10024, '2023-02-19 08:11:16'),
(10005, '1234-1234', 'N/A', 'Donna&#039;s Coffee Bean', 'Purok 1, Sampaloc, San Rafael Bulacan', 'Cafe', '123-124', '500', 'Approved', 10014, '2023-02-10 06:16:21'),
(10006, 'N/A', 'You have an Existing Blotter Record', 'Totoy\'s Gift Shop', 'Purok 2, Sampaloc, San Rafael Bulacan', 'Gift Shop', 'N/A', 'N/A', 'Declined', 10028, '2023-02-10 03:59:48'),
(10007, '', '', 'Carinderia ni Ine', 'Purok 3, Sampaloc, San Rafael Bulacan', 'Food', '', '500', 'Pending', 10017, '2023-02-19 08:11:31'),
(10008, '2023-001', 'N/A', 'Ligon\'s Motorcycle Parts', 'Purok 5, Sampaloc, San Rafael, Bulacan', 'General Merchandise', 'N/A', '500', 'Approved', 10019, '2023-02-19 15:36:14'),
(10009, 'N/A', 'You have an existing blotter record', 'Lisa\'s Salon', 'Purok 2, Sampaloc, San Rafael Bulacan', 'Salon', 'N/A', 'N/A', 'Declined', 10025, '2023-02-10 04:08:17'),
(10011, '', '', 'Lian\'s Junkshop', 'Purok 1, Sampaloc, San Rafael Bulacan', 'Junkshop', '', '500', 'Pending', 10019, '2023-02-19 08:14:42'),
(10012, '', '', 'Erzen Panederia', 'Purok 4, Sampaloc, San Rafael Bulacan', 'Bakeshop', '', '500', 'Pending', 10013, '2023-02-19 08:14:57'),
(10013, '', 'You have an existing blotter record.', 'Kian Toy Shop', 'Purok 1, Sampaloc, San Rafael Bulacan', 'Business', '', 'N/A', 'Declined', 10028, '2023-02-19 14:31:13'),
(10014, 'N/A', 'Shop building location is scheduled for demolition', 'Kirby\'s Toy Store', 'Purok 4, Sampaloc, San Rafael Bulacan', 'Business', 'N/A', '500', 'Declined', 10024, '2023-02-19 14:09:28'),
(10015, '', 'N/A', 'Puzzle Shop', 'Purok 4, Sampaloc, San Rafael Bulacan', 'Shop', '', '500', 'Approved', 10024, '2023-02-19 14:09:28'),
(10016, '', '', 'Lian Aircon Repair Shop', 'Purok 6, Sampaloc, San Rafael Bulacan', 'Repair shop', '', '500', 'Pending', 10019, '2023-02-19 14:12:22'),
(10017, 'N/A', 'Poultry location is a residential area', 'Lian\'s Poultry', 'Purok 7, Sampaloc, San Rafael Bulacan', 'Farm', 'N/A', 'N/A', 'Declined', 10019, '2023-02-19 14:12:45'),
(10018, '', '', 'Cess&#039; Craft Shop', 'Purok 3, Sampaloc, San Rafael Bulacan', 'Shop', '', '500', 'Pending', 10015, '2023-02-19 14:32:35'),
(10019, '', 'N/A', 'Ale Woodwork', 'Purok 3, Sampaloc, San Rafael Bulacan', 'Woodwork Business', '', '500', 'Approved', 10015, '2023-02-19 14:21:36');

-- --------------------------------------------------------

--
-- Table structure for table `tblresidents`
--

CREATE TABLE `tblresidents` (
  `rID` int(11) NOT NULL,
  `rImage` varchar(100) NOT NULL,
  `rFirst` varchar(50) NOT NULL,
  `rMid` varchar(30) NOT NULL,
  `rLast` varchar(30) NOT NULL,
  `rSuffix` varchar(10) NOT NULL,
  `rBday` date NOT NULL,
  `rBplace` varchar(50) NOT NULL,
  `rAge` varchar(10) NOT NULL,
  `rCivil` varchar(20) NOT NULL,
  `rGender` varchar(20) NOT NULL,
  `rHouse` varchar(10) NOT NULL,
  `rPurok` varchar(10) NOT NULL,
  `rResiding` int(10) NOT NULL,
  `rCedula` int(10) NOT NULL,
  `rVoter` varchar(20) NOT NULL,
  `rPrecinct` varchar(20) NOT NULL,
  `rEmail` varchar(50) NOT NULL,
  `rContact` varchar(20) NOT NULL,
  `rOccup` varchar(30) NOT NULL,
  `aID` int(11) NOT NULL,
  `rStamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblresidents`
--

INSERT INTO `tblresidents` (`rID`, `rImage`, `rFirst`, `rMid`, `rLast`, `rSuffix`, `rBday`, `rBplace`, `rAge`, `rCivil`, `rGender`, `rHouse`, `rPurok`, `rResiding`, `rCedula`, `rVoter`, `rPrecinct`, `rEmail`, `rContact`, `rOccup`, `aID`, `rStamp`) VALUES
(20000, 'ernestoroque.jpg', 'Ernesto', 'Chico', 'Roque', 'Jr.', '1972-10-20', 'San Rafael', '54', 'Married', 'Male', '400, Purok', 'Purok 1', 54, 2145678909, 'Registered', '2315A', 'ernestoroquejr@gmail.com', '09678965100', 'Barangay Chairman', 10000, '2023-02-19 14:35:58'),
(20001, 'rosariodelarosa.jpg', 'Rosario', 'Pineda', 'Dela Rosa', 'N/A', '1972-06-09', 'San Rafael', '51', 'Married', 'Female ', '123', 'Purok 1', 51, 2134567891, 'Registered', '1005A', 'delarosa@gmail.com', '09563421235', 'Barangay Kagawad', 10001, '2023-02-10 05:20:31'),
(20002, 'reneabraham.jpg', 'Rene', 'Rillon', 'Abraham', 'N/A', '1982-07-08', 'San Rafael', '41', 'Married', 'Male', '456', 'Purok 4', 41, 2133456789, 'Registered', '1005A', 'abraham@gmail.com', '0911236750', 'Barangay Kagawad', 10002, '2023-02-10 05:20:31'),
(20003, 'procesoroque.jpg', 'Proceso', 'Chico', 'Roque', 'N/A', '1985-09-23', 'San Rafael', '38', 'Married', 'Male', '401', 'Purok 1', 38, 2144678900, 'Registered', '2005A', 'procesoroque@gmail.com', '09896790100', 'Barangay Kagawad', 10003, '2023-02-10 05:20:31'),
(20004, 'tobias.jpg', 'Esvetlana', 'Hernandez', 'Tobias', 'N/A', '1990-05-20', 'San Rafael', '33', 'Single', 'Female', '115', 'Purok 2', 33, 2144356789, 'Registered', '1003B', 'tobias@gmail.com', '09569003451', 'Barangay Kagawad', 10004, '2023-02-10 05:20:31'),
(20005, '', 'Dexter', 'Abolencia', 'Palopalo', 'N/A', '1991-03-19', 'San Rafael', '31', 'Married', 'Male', '142', 'Purok 2', 16, 2145589065, 'Registered', '1004B', 'palopalo@gmail.com', '09342673090', 'Barangay Kagawad', 10005, '2023-02-19 14:38:35'),
(20006, 'chico.jpg', 'Julieta', 'Calderon', 'Chico', 'N/A', '1965-09-01', 'San Rafael', '58', 'Married', 'Female', '116', 'Purok 2', 58, 2133789675, 'Registered', '1007A', 'chico@gmail.com', '09768945671', 'Barangay Kagawad', 10006, '2023-02-10 05:20:31'),
(20007, 'hernandosantiago.jpg', 'Hernando', 'Lopez', 'Santiago', 'N/A', '1976-10-11', 'San Rafael', '47', 'Married', 'Male', '399', 'Purok 1', 47, 1135678901, 'Registered', '1009B', 'hernandosantiago@gmail.com', '0976899054', 'Barangay Secretary', 10007, '2023-02-10 05:20:31'),
(20008, 'edwincamacho.jpg', 'Edwin', 'Ocampo', 'Camacho', 'N/A', '1970-06-23', 'San Rafael', '53', 'Married', 'Male', '162', 'Purok 4', 53, 2134789013, 'Registered', '1006A', 'edwinc@gmail.com', '09086734512', 'Barangay Treasurer', 10008, '2023-02-10 05:20:31'),
(20009, 'romchellcruz.jpg', 'Romchell', 'Trimivilla', 'Cruz', 'N/A', '2000-08-15', 'San Rafael', '22', 'Single', 'Female', '234', 'Purok 4', 22, 2134456789, 'Registered', '1002B', 'chellcruz@gmail.com', '09764523123', 'Barangay SK Chairwoman', 10009, '2023-02-10 05:20:32'),
(20010, 'unnamed.jpg', 'Jeanherline', 'Lopez', 'Santiago', 'N/A', '2003-03-29', 'San Ildefonso', '19', 'Single', 'Female ', '399', 'Purok 1', 16, 1146780331, 'Registered', '1009B', 'jynerline@gmail.com', '09293010483', 'Student', 10010, '2023-02-20 01:21:57'),
(20011, '59-598005_clip-art-business-man-clipart-man-and-woman.png', 'Jimmy', 'Ignacio', 'Pamintuan', 'Jr.', '1997-11-07', 'San Ildefonso', '25', 'Single', 'Male', '110', 'Purok 2', 21, 1235690011, 'Registered', '1007A', 'jimmz@gmail.com', '09679012311', 'Driver', 10011, '2023-02-10 07:52:02'),
(20012, '', 'Marie', 'Mariano', 'Reyes', 'N/A', '1995-04-10', 'San Rafael', '28', 'Married', 'Female', '100', 'Purok 2', 28, 2135679008, 'Registered', '1004B', 'reyes@gmail.com', '0978901237', 'Fish Vendor', 10012, '2023-02-09 14:59:16'),
(20013, 'download.png', 'Erzen Joi', 'Santiago', 'Alberto', 'N/A', '2003-12-01', 'Maguinao', '19', 'Single', 'Female ', '849', 'Purok 5', 15, 2145878561, 'Registered', '5002C', 'erzen@gmail.com', '09654323991', 'Student', 10013, '2023-02-10 07:52:27'),
(20014, 'download.jpg', 'Donna Princess', 'Renolla', 'Valonda', 'N/A', '1992-08-21', 'San Rafael', '31', 'Single', 'Female', '489', 'Purok 4', 31, 214556891, 'Registered', '1009A', 'donnavalonda@gmail.com', '09876645123', 'Call Center Agent', 10014, '2023-02-16 08:21:34'),
(20015, 'download (1).png', 'Frances Nicolle', 'Mesina', 'Alejandro', 'N/A', '2006-07-09', 'Pulilan', '17', 'Single', 'Female ', '344', 'Purok 5', 1, 2134578901, 'Registered', '5004B', 'alejandro.cessda@gmail.com', '09876534569', 'Student', 10015, '2023-02-19 14:25:46'),
(20016, 'download.jpg', 'Earish Ann ', 'Taruc ', 'Paguio', 'N/A', '2002-05-20', 'San Miguel', '21', 'Single', 'Female ', '223', 'Purok 2', 15, 234489001, 'Registered', '2009A', 'earishann@gmail.com', '09454135441', 'Student', 10016, '2023-02-10 07:53:35'),
(20017, '59-598005_clip-art-business-man-clipart-man-and-woman.png', 'Angelo', 'Dela Cruz', 'Ligon', 'N/A', '2002-10-18', 'San Miguel', '20', 'Single', 'Male', '345', 'Purok 3', 16, 2145789011, 'Registered', '1007B', 'ligonangelo@gmail.com', '09678890123', 'Student', 10017, '2023-02-10 07:54:01'),
(20018, '', 'Bea ', 'Paguio', 'Joson', 'N/A', '2004-10-15', 'San Miguel', '18', 'Single', 'Female', '167', 'Purok 1', 11, 2122457898, 'Registered', '1006B', 'bea@gmail.com', '09674523113', 'Student', 10018, '2023-02-09 15:17:46'),
(20019, '59-598005_clip-art-business-man-clipart-man-and-woman.png', 'Lian', 'Joson', 'Domagtoy', 'N/A', '2007-11-27', 'San Miguel', '15', 'Single', 'Female', '128', 'Purok 1', 11, 1238900011, 'Not Registered', 'N/A', 'liandomagtoy@gmail.com', '09234568912', 'Student', 10019, '2023-02-10 07:54:24'),
(20020, '', 'Shiela Andrea', 'Dela Cruz ', 'Mendez', 'N/A', '1993-10-24', 'San Ildefonso', '30', 'Single', 'Female', '236', 'Purok 2', 25, 2127890001, 'Registered', '1006A', 'shielaandrea@gmail.com', '09765434110', 'Seller ', 10020, '2023-02-09 15:51:26'),
(20021, '', 'Kiko', 'Andres', 'Valencia', 'N/A', '1995-03-21', 'San Ildefonso', '28', 'Single', 'Male', '564', 'Purok 5', 22, 2137890112, 'Registered', '1007A', 'kikovalencia@gmail.com', '09235690116', 'Driver', 10021, '2023-02-09 15:55:29'),
(20022, '', 'Chloe', 'Listana', 'Pineda', 'N/A', '2000-06-13', 'San Miguel', '23', 'Single', 'Female', '321', 'Purok 3', 21, 2137098110, 'Registered', '1002A', 'chloepineda@gmail.com', '09290956701', 'Waitress', 10022, '2023-02-10 01:29:49'),
(20023, '', 'Andres', 'Mendoza', 'Paulino', 'N/A', '2000-02-02', 'Baliwag, Bulacan', '23', 'Single', 'Male', '97', 'Purok 1', 6, 87293514, 'Unregistered', '', 'andres@gmail.com', '09281459876', 'Office Worker', 10023, '2023-02-10 04:16:59'),
(20024, 'download (1).png', 'Kirby', 'Abesa', 'Mariano', 'Jr.', '1978-02-07', 'Malolos, Bulacan', '45', 'Separated', 'Male', '128', 'Purok 2', 3, 98236153, 'Registered', 'N/A', 'kirbymariano@gmail.com', '09123872563', 'N/A', 10024, '2023-02-20 01:24:12'),
(20025, '', 'Manuelito', 'De Jesus', 'Lacanilao', 'N/A', '1980-02-03', 'Baliwag, Bulacan', '43', 'Widowed', 'Male', '145', 'Purok 3', 4, 18362904, 'Registered', '', 'manuel@gmail.com', '02517394561', 'Janitor', 10025, '2023-02-10 04:24:49'),
(20026, '', 'Lisa', 'Perona', 'Mallari', 'N/A', '1996-01-09', 'Manila', '27', 'Single', 'Female', '18', 'Purok 1', 1, 81730193, 'Registered', '', 'lisa@gmail.com', '01638163842', 'Vendor', 10026, '2023-02-10 04:28:01'),
(20027, '', 'George', 'Manuel', 'Bautista', 'Sr.', '1989-04-27', 'Mindoro', '33', 'Married', 'Male', '23', 'Purok 3', 12, 19273542, 'Unregistered', '', 'barisatGeorg@gmail.com', '01729453817', 'Barista', 10027, '2023-02-10 04:33:21'),
(20028, 'download.jpg', 'Kian', 'Cruz', 'Corpuz', 'III', '2002-02-11', 'Baliwag, Bulacan', '21', 'Single', 'Male', '32', 'Purok 5', 1, 28173628, 'Unregistered', 'N/A', 'kiancorpuz@gmail.com', '01726351932', 'Student', 10028, '2023-02-20 01:23:43'),
(20029, '', 'Juan', 'Lozano', 'Santos', 'N/A', '1995-07-07', 'Romblon', '27', 'Single', 'Male', '17', 'Purok 2', 3, 1928362, 'Unregistered', '', 'juansantos@gmail.com', '01928354037', 'Gym Instructor', 10029, '2023-02-10 04:36:15'),
(20032, '', 'TestName', 'N/A', 'TestLname', 'I', '1998-06-19', 'TestBplace', '24', 'Married', 'Others', '044', 'Purok 3', 2, 23610012, 'Registered', 'N/A', 'test@gmail.com', '01738492039', 'TestOccup', 10032, '2023-02-19 07:03:13'),
(20035, '', 'Luisito', 'N/A', 'Villanueva', 'III', '1997-12-19', 'Malolos', '25', 'Married', 'Male', '865', 'Purok 1', 3, 0, 'Registered', 'N/A', 'luisito@gmail.com', '07654763218', 'Professor', 10035, '2023-02-19 15:00:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblaccess`
--
ALTER TABLE `tblaccess`
  ADD PRIMARY KEY (`aID`);

--
-- Indexes for table `tblblotter`
--
ALTER TABLE `tblblotter`
  ADD PRIMARY KEY (`bID`),
  ADD KEY `bComp` (`bComp`),
  ADD KEY `bPers` (`bPers`),
  ADD KEY `oID` (`oID`);

--
-- Indexes for table `tblclearance`
--
ALTER TABLE `tblclearance`
  ADD PRIMARY KEY (`cID`),
  ADD KEY `tblclearance` (`aID`);

--
-- Indexes for table `tblofficials`
--
ALTER TABLE `tblofficials`
  ADD PRIMARY KEY (`oID`),
  ADD KEY `tblofficials` (`aID`);

--
-- Indexes for table `tblpermit`
--
ALTER TABLE `tblpermit`
  ADD PRIMARY KEY (`pID`),
  ADD KEY `tblpermit` (`aID`);

--
-- Indexes for table `tblresidents`
--
ALTER TABLE `tblresidents`
  ADD PRIMARY KEY (`rID`),
  ADD KEY `tblresidents` (`aID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblaccess`
--
ALTER TABLE `tblaccess`
  MODIFY `aID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10036;

--
-- AUTO_INCREMENT for table `tblblotter`
--
ALTER TABLE `tblblotter`
  MODIFY `bID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41032;

--
-- AUTO_INCREMENT for table `tblclearance`
--
ALTER TABLE `tblclearance`
  MODIFY `cID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10021;

--
-- AUTO_INCREMENT for table `tblofficials`
--
ALTER TABLE `tblofficials`
  MODIFY `oID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3110;

--
-- AUTO_INCREMENT for table `tblpermit`
--
ALTER TABLE `tblpermit`
  MODIFY `pID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10020;

--
-- AUTO_INCREMENT for table `tblresidents`
--
ALTER TABLE `tblresidents`
  MODIFY `rID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20036;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblblotter`
--
ALTER TABLE `tblblotter`
  ADD CONSTRAINT `bComp` FOREIGN KEY (`bComp`) REFERENCES `tblaccess` (`aID`),
  ADD CONSTRAINT `bPers` FOREIGN KEY (`bPers`) REFERENCES `tblaccess` (`aID`),
  ADD CONSTRAINT `oID` FOREIGN KEY (`oID`) REFERENCES `tblofficials` (`oID`);

--
-- Constraints for table `tblclearance`
--
ALTER TABLE `tblclearance`
  ADD CONSTRAINT `tblclearance` FOREIGN KEY (`aID`) REFERENCES `tblaccess` (`aID`);

--
-- Constraints for table `tblofficials`
--
ALTER TABLE `tblofficials`
  ADD CONSTRAINT `tblofficials` FOREIGN KEY (`aID`) REFERENCES `tblaccess` (`aID`);

--
-- Constraints for table `tblpermit`
--
ALTER TABLE `tblpermit`
  ADD CONSTRAINT `tblpermit` FOREIGN KEY (`aID`) REFERENCES `tblaccess` (`aID`);

--
-- Constraints for table `tblresidents`
--
ALTER TABLE `tblresidents`
  ADD CONSTRAINT `tblresidents` FOREIGN KEY (`aID`) REFERENCES `tblaccess` (`aID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
