-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2016 at 01:57 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `diplomski`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_acitivity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('cb5c786681e853c684994a254bb23ad8', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', 1458392227, 'a:7:{s:9:"user_data";s:0:"";s:4:"name";s:12:"AlenPaulić0";s:5:"email";s:11:"alen@net.hr";s:2:"id";s:3:"106";s:9:"user_type";s:5:"admin";s:6:"status";s:10:"Zaposlenik";s:8:"loggedin";b:1;}');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name_client` text NOT NULL,
  `id_client` text NOT NULL,
  `servis_client` text NOT NULL,
  `naziv_servisa` text NOT NULL,
  `id_oruzija_client` text NOT NULL,
  `oruzije_client` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name_client`, `id_client`, `servis_client`, `naziv_servisa`, `id_oruzija_client`, `oruzije_client`, `created`, `modified`) VALUES
(28, 'IvanIvanović0', '174', '62', 'Servis_0', '28', 'pištolj#0', '2015-06-22 21:35:16', '2015-06-24 02:20:30'),
(29, 'IvanIvanović0', '174', '', '', '29', 'pištolj#1', '2015-06-22 21:35:32', '2015-06-22 21:35:32'),
(30, 'DinoHerceg0', '172', '', '', '30', 'pištolj#2', '2015-06-22 21:35:46', '2015-06-24 01:42:08'),
(31, 'IvanIvanović0', '174', '61', 'Servis_1', '31', 'pištolj#3', '2015-06-22 21:40:49', '2015-06-23 19:15:25'),
(32, 'DinoHerceg0', '172', '', '', '32', 'BFG#0', '2015-06-24 01:40:25', '2015-06-24 01:42:08'),
(33, 'MilivojHunter0', '184', '63', 'Servis_1', '33', 'puska#0', '2015-09-16 22:05:35', '2015-09-16 22:08:27'),
(34, 'IvanIvanović1', '186', '64', 'Servis_2', '34', 'pajser#0', '2015-10-05 14:42:03', '2015-10-05 14:46:30');

-- --------------------------------------------------------

--
-- Table structure for table `mechanics`
--

CREATE TABLE IF NOT EXISTS `mechanics` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name_mehanicar` text NOT NULL,
  `servis_mehanicar` text NOT NULL,
  `naziv_servisa` text NOT NULL,
  `status_servisa` text NOT NULL,
  `id_oruzije_mehanicar` text NOT NULL,
  `oruzije_mehanicar` text NOT NULL,
  `id_mehanicar` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `mechanics`
--

INSERT INTO `mechanics` (`id`, `name_mehanicar`, `servis_mehanicar`, `naziv_servisa`, `status_servisa`, `id_oruzije_mehanicar`, `oruzije_mehanicar`, `id_mehanicar`, `created`, `modified`) VALUES
(66, 'PeroPreradović0', '62', 'Servis_0', '', '28', 'pištolj#0', '171', '2015-06-24 02:20:30', '2015-06-24 02:20:30'),
(67, 'MajstorMrkonja0', '63', 'Servis_1', 'GOTOVO', '33', 'puska#0', '185', '2015-09-16 22:08:26', '2015-09-16 22:14:09'),
(68, 'MajstorMrkonja0', '64', 'Servis_2', 'U TIJEKU', '34', 'pajser#0', '185', '2015-10-05 14:46:30', '2015-10-05 14:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `version` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(7);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `naziv` text NOT NULL,
  `id_vlasnika` text NOT NULL,
  `vlasnik` text NOT NULL,
  `id_oruzija` text NOT NULL,
  `oruzije` text NOT NULL,
  `id_servisera` text NOT NULL,
  `serviser` text NOT NULL,
  `pocetak_servisa` date NOT NULL,
  `kraj_servisa` date NOT NULL,
  `status` text NOT NULL,
  `komentar` text NOT NULL,
  `preuzeto` tinyint(1) NOT NULL,
  `datum_preuzimanja` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `naziv`, `id_vlasnika`, `vlasnik`, `id_oruzija`, `oruzije`, `id_servisera`, `serviser`, `pocetak_servisa`, `kraj_servisa`, `status`, `komentar`, `preuzeto`, `datum_preuzimanja`, `created`, `modified`) VALUES
(62, 'Servis_0', '174', 'IvanIvanović0', '28', 'pištolj#0', '171', 'PeroPreradović0', '2015-06-24', '2015-06-24', '', '', 0, '0000-00-00', '2015-06-24 02:20:30', '2015-06-24 02:20:30'),
(63, 'Servis_1', '184', 'MilivojHunter0', '33', 'puska#0', '185', 'MajstorMrkonja0', '2015-09-16', '2015-09-19', 'GOTOVO', 'Komentar.....', 1, '0000-00-00', '2015-09-16 22:08:26', '2015-09-16 22:15:27'),
(64, 'Servis_2', '186', 'IvanIvanović1', '34', 'pajser#0', '185', 'MajstorMrkonja0', '2015-10-05', '2015-10-14', 'U TIJEKU', 'iuhiuhiuh', 0, '0000-00-00', '2015-10-05 14:46:30', '2015-10-05 14:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `password_original` text NOT NULL,
  `name` text NOT NULL,
  `ime` text NOT NULL,
  `prezime` text NOT NULL,
  `user_type` enum('admin','mech','client') NOT NULL,
  `nadleznost` text NOT NULL,
  `status` text NOT NULL,
  `adresa` text NOT NULL,
  `datum_rodjenja` date NOT NULL,
  `JMBG` text NOT NULL,
  `oruzani_broj` text NOT NULL,
  `kontakt_broj` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=187 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `password_original`, `name`, `ime`, `prezime`, `user_type`, `nadleznost`, `status`, `adresa`, `datum_rodjenja`, `JMBG`, `oruzani_broj`, `kontakt_broj`, `created`, `modified`) VALUES
(106, 'alen@net.hr', '82c13dbbdf479eea064b86006ba7ef35', '-', 'AlenPaulić0', 'Alen', 'Paulić', 'admin', 'Šef', 'Zaposlenik', 'V. Nazora 22, Beli Manastir', '1991-06-24', '2147483647', '0', '0915616730', '2015-06-08 13:23:53', '2016-03-19 13:57:02'),
(137, 'mars656@net.hr', 'f0c360c5176e6136877898abd7bf5e22', '', 'MarkoIvanovic2', 'Marko', 'Ivanovic', 'admin', '', 'Bivši zaposlenik', '', '2015-06-20', '0', '0', '', '2015-06-20 22:55:08', '2015-07-02 14:14:19'),
(138, 'mars656@net.hr', '80aca42d2be814d1bbc2e5a4adc2dbd8', '', 'MarkoIvanovic1', 'Marko', 'Ivanovic', 'admin', '', 'Zaposlenik', '', '2015-06-20', '0', '0', '', '2015-06-20 22:55:33', '0000-00-00 00:00:00'),
(146, 'mechanic@net.hr', 'bce627f402ec264011c4dfc3098b2420', '', 'MarioIvanović0', 'Mario', 'Ivanović', 'client', '', 'Nije zaposlenik', '', '2015-06-21', '0', '0', '', '2015-06-21 00:19:53', '2015-06-22 21:38:16'),
(153, 'prolonging1@hotmail.com', 'd19d560b6a9a16a3d714391d5e9eeb61', '', 'DamirPaulić0', 'Damir', 'Paulić', 'admin', '', 'Zaposlenik', '', '2015-06-14', '0', '0', '', '2015-06-21 16:24:14', '2015-06-21 17:03:22'),
(154, 'robin@net.hr', 'a999a4b0bbd9b7e1ef101743a7080b3b', '', 'RobinPaulić0', 'Robin', 'Paulić', 'admin', '', 'Zaposlenik', '', '1993-06-21', '0', '0', '', '2015-06-21 17:57:03', '2015-06-22 21:38:50'),
(165, 'mars654446@net.hr', '45e6de771052a029409ea12a53a33e80', '', 'MarioHerceg0', 'Mario', 'Herceg', 'admin', '', 'Zaposlenik', 'Vladana Desnice 31, Beli Manastir', '2015-06-22', '2147483647', '0', '0934532111', '2015-06-22 00:34:31', '2015-06-22 00:34:31'),
(170, 'prolonging1@net.hr', 'f0c360c5176e6136877898abd7bf5e22', '', 'ĐuroPletikosa0', 'Đuro', 'Pletikosa', 'mech', '', 'Zaposlenik', 'Vladana Desnice 31, Beli Manastir', '1945-06-22', '2343234543234', '0', '0934532111', '2015-06-22 01:33:06', '2015-06-22 16:58:11'),
(171, 'pero@net.hr', 'f0c360c5176e6136877898abd7bf5e22', '', 'PeroPreradović0', 'Pero', 'Preradović', 'mech', '', 'Zaposlenik', 'Augusta Cesarca 12, Beli Manastir', '1960-06-10', '1234567891234', '0', '0934532222', '2015-06-22 16:01:26', '2015-06-23 03:49:10'),
(172, 'dino@net.hr', 'f101bca5fe2fe129d12bda1f9bce1669', '', 'DinoHerceg0', 'Dino', 'Herceg', 'client', '', 'Nije zaposlenik', 'Saruonova 13, Minas-Morgul', '1989-06-22', '6969696969690', '111111', 'nema', '2015-06-22 16:51:24', '2015-06-24 01:42:08'),
(174, 'ivan@net.hr', 'f0c360c5176e6136877898abd7bf5e22', '', 'IvanIvanović0', 'Ivan', 'Ivanović', 'client', '', 'Nije zaposlenik', 'Vladana Desnice 31, Beli Manastir', '1970-06-22', '2343234543234', '056784', '0934532333', '2015-06-22 21:14:30', '2015-06-22 22:22:22'),
(183, '', '75890dea7913a1eac38180ad28f91c04', '', 'grgr0', 'gr', 'gr', 'admin', '', 'Bivši zaposlenik', '', '2015-07-02', '', '', '', '2015-07-02 14:39:32', '2015-07-02 14:42:20'),
(184, 'prolonging@net.hr', 'f0c360c5176e6136877898abd7bf5e22', '', 'MilivojHunter0', 'Milivoj', 'Hunter', 'client', '', 'Nije zaposlenik', 'wert', '1950-09-16', '234234', '123', '2342', '2015-09-16 22:02:52', '2015-09-16 22:14:49'),
(185, 'prolonging@net.hr', 'f0c360c5176e6136877898abd7bf5e22', '', 'MajstorMrkonja0', 'Majstor', 'Mrkonja', 'mech', '', 'Zaposlenik', 'V. Desnice 33', '1930-09-16', '523452345', '', '3333333', '2015-09-16 22:07:26', '2015-09-16 22:13:38'),
(186, 'prolonging@net.hr', 'd6e344d785c14732f6b84c5b942a9782', '', 'IvanIvanović1', 'Ivan', 'Ivanović', 'client', '', 'Nije zaposlenik', 'sdf', '2015-10-05', '2342', '6546', '234', '2015-10-05 14:39:35', '2015-10-05 14:39:35');

-- --------------------------------------------------------

--
-- Table structure for table `weapons`
--

CREATE TABLE IF NOT EXISTS `weapons` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `puni_naziv` text NOT NULL,
  `id_vlasnika` text NOT NULL,
  `vlasnik` text NOT NULL,
  `pripadni_servis` text NOT NULL,
  `naziv_servisa` text NOT NULL,
  `vrsta` text NOT NULL,
  `marka` text NOT NULL,
  `serijski_broj` text NOT NULL,
  `kalibar` text NOT NULL,
  `dodaci` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `weapons`
--

INSERT INTO `weapons` (`id`, `name`, `puni_naziv`, `id_vlasnika`, `vlasnik`, `pripadni_servis`, `naziv_servisa`, `vrsta`, `marka`, `serijski_broj`, `kalibar`, `dodaci`, `created`, `modified`) VALUES
(28, 'pištolj#0', 'pištolj', '174', 'IvanIvanović0', '62', 'Servis_0', '', '', '', '', '', '2015-06-22 21:35:16', '2015-06-24 02:20:30'),
(29, 'pištolj#1', 'pištolj', '174', 'IvanIvanović0', '', '', '', '', '', '', '', '2015-06-22 21:35:32', '2015-06-22 21:35:32'),
(30, 'pištolj#2', 'pištolj', '172', 'DinoHerceg0', '', '', '', '', '', '', '', '2015-06-22 21:35:46', '2015-06-24 01:42:09'),
(31, 'pištolj#3', 'pištolj', '174', 'IvanIvanović0', '61', 'Servis_1', 'pištolj', 'ZBROJOVKA ČEHOSLOVAČKA', '580778', '6,35', '-', '2015-06-22 21:40:49', '2015-06-23 19:15:25'),
(32, 'BFG#0', 'BFG', '172', 'DinoHerceg0', '', '', '', '', '', '', '', '2015-06-24 01:40:24', '2015-06-24 01:42:09'),
(33, 'puska#0', 'puska', '184', 'MilivojHunter0', '63', 'Servis_1', 'wer', 'wer', '234', '33', 'wer', '2015-09-16 22:05:35', '2015-09-16 22:08:27'),
(34, 'pajser#0', 'pajser', '186', 'IvanIvanović1', '64', 'Servis_2', 'hgfh', '6546', 'hgfh', '765', 'wer', '2015-10-05 14:42:03', '2015-10-05 14:46:30');

-- --------------------------------------------------------

--
-- Table structure for table `zaposlenici`
--

CREATE TABLE IF NOT EXISTS `zaposlenici` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `pocetak_rada` date NOT NULL,
  `kraj_rada` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `zaposlenici`
--

INSERT INTO `zaposlenici` (`id`, `name`, `pocetak_rada`, `kraj_rada`, `created`, `modified`) VALUES
(7, 'AlenPaulić0', '2015-06-01', '2015-06-01', '2015-06-01 12:00:00', '2015-06-01 12:00:00'),
(39, 'AlenPaulić0', '2015-06-19', '0000-00-00', '2015-06-19 20:22:39', '0000-00-00 00:00:00'),
(42, 'MarkoIvanovic0', '2015-06-20', '0000-00-00', '2015-06-20 22:55:08', '0000-00-00 00:00:00'),
(43, 'MarkoIvanovic1', '2015-06-20', '0000-00-00', '2015-06-20 22:55:33', '0000-00-00 00:00:00'),
(58, 'DamirPaulić0', '2015-06-21', '0000-00-00', '2015-06-21 16:24:14', '0000-00-00 00:00:00'),
(59, 'RobinPaulić0', '2015-06-21', '0000-00-00', '2015-06-21 17:57:03', '0000-00-00 00:00:00'),
(69, 'MarioHerceg0', '2015-06-22', '0000-00-00', '2015-06-22 00:34:31', '2015-06-22 00:34:31'),
(74, 'ĐuroPletikosa0', '2015-06-22', '0000-00-00', '2015-06-22 01:33:06', '2015-06-22 01:33:06'),
(75, 'PeroPreradović0', '2015-06-22', '0000-00-00', '2015-06-22 16:01:26', '2015-06-22 16:01:26'),
(76, 'MarioIvanović0', '2015-06-22', '0000-00-00', '2015-06-22 21:37:19', '2015-06-22 21:37:19'),
(77, '', '0000-00-00', '2015-07-02', '2015-07-02 14:14:20', '2015-07-02 14:14:20'),
(79, 'grgr0', '2015-07-02', '2015-07-02', '2015-07-02 14:39:32', '2015-07-02 14:42:20'),
(80, 'MajstorMrkonja0', '2015-09-16', '0000-00-00', '2015-09-16 22:07:26', '2015-09-16 22:07:26');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
