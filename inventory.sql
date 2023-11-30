-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2023 at 08:34 PM
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
-- Database: `distributor`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `A` varchar(6) DEFAULT NULL,
  `B` varchar(23) DEFAULT NULL,
  `C` varchar(4) DEFAULT NULL,
  `D` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`A`, `B`, `C`, `D`) VALUES
('serial', 'product-name', 'rate', 'Stock'),
('1', 'Chocobar', '615', '257'),
('2', 'CHOCOBAR INSTA', '510', '144'),
('3', 'Shell & Core', '515', '341'),
('4', 'Lolly - Lemon', '425', '293'),
('5', 'Dudh Malai', '425', '197'),
('6', 'Ego', '695', '184'),
('7', 'Mega', '680', '175'),
('8', 'Macho', '680', '382'),
('9', 'Almond Split (Exotic)', '830', '403'),
('10', 'Mango Bar', '608', '219'),
('11', 'Vanilla - Cup', '380', '414'),
('12', 'Black Forest (P. Cup)', '610', '303'),
('13', 'Ice Café (P. Cup)', '610', '212'),
('14', 'French Vanilla (P. Cup)', '610', '252'),
('15', 'DOI (P. CUP)', '610', '350'),
('16', 'SANDWICH ICE CREAM', '396', '428'),
('17', 'Single Sundae', '460', '420'),
('18', 'Mango Magic', '600', '264'),
('19', 'Colours Cone (Mini)', '700', '402'),
('20', 'Cornelli Classic', '575', '363'),
('21', 'Belgian Chocolate', '690', '181'),
('22', 'Vanilla -1/2 Ltr', '120', '126'),
('23', 'Shahi Kulfi - 1/2 L', '155', '101'),
('24', 'Vanilla - 1 Ltr.', '230', '155'),
('25', 'Firni - 1 L', '195', '326'),
('26', 'Kheer Malai - 1 L', '300', '128'),
('27', 'Rash Malai - 1 L', '300', '495'),
('28', 'BUTTER SCOTCH-1 L', '340', '206'),
('29', 'Doi - 1 L', '300', '377'),
('30', 'Nawabi Mithai - 1 L', '300', '181'),
('31', 'Blueberry Yoghurt -1L', '380', '203'),
('32', 'AMBROSIA - 1 L', '340', '481'),
('33', 'Ice Café - 1 L', '255', '344'),
('34', 'French Vanilla - 1 L', '380', '221'),
('35', 'Red Velvet - 1 L', '425', '248'),
('36', 'Double Sunday - 1 L', '300', '449'),
('37', '1 Liter - Cake', '335', '143'),
('38', '1.5 Liter - Cake', '0', '414'),
('39', 'Vanilla - 2 Ltr.', '425', '414'),
('40', 'Vanilla - 5 Ltr.', '1000', '208'),
('41', 'Group B - 5 L', '1600', '468'),
('42', 'Group C - 5 L', '610', '344');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
