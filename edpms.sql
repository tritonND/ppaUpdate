-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2017 at 01:14 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edpms`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `mp`()
BEGIN
DROP TEMPORARY TABLE IF EXISTS tt1;
CREATE TEMPORARY TABLE tt1 (SELECT (CONTRACTOR) FROM projectdetails GROUP BY CONTRACTOR) ;
SELECT count(CONTRACTOR) FROM tt1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `myProc`()
BEGIN
    DROP TEMPORARY TABLE IF EXISTS ttab, t3, t2;
    create TEMPORARY TABLE IF NOT EXISTS ttab (SELECT projectdetails.PROJECTID, projectdetails.PROCURINGENTITY, projectdetails.CONTRACTSUM,
                                                 (SELECT SUM(AMOUNT) from certificates WHERE projectdetails.PROJECTID = certificates.PROJECTID GROUP BY certificates.PROJECTID) as cAmount,
                                                 (SELECT SUM(AMOUNT) from variations WHERE projectdetails.PROJECTID = variations.PROJECTID GROUP BY variations.PROJECTID ) as vAmount
                                               FROM projectdetails
                                                 JOIN variations ON projectdetails.PROJECTID = variations.PROJECTID OR variations.PROJECTID = "aa111"
                                                 JOIN certificates ON projectdetails.PROJECTID = certificates.PROJECTID
                                               GROUP BY projectdetails.PROJECTID) ;
    (SELECT PROCURINGENTITY, SUM(CONTRACTSUM) as CSUM1, SUM(cAmount) as CAMOUNT, SUM(vAmount) as VAMOUNT from ttab GROUP BY PROCURINGENTITY);

  END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `myProc1`()
BEGIN
     DROP TEMPORARY TABLE IF EXISTS ttab;
     create TEMPORARY TABLE IF NOT EXISTS ttab (SELECT projectdetails.PROJECTID, projectdetails.LGA, projectdetails.CONTRACTSUM,
                                                  (SELECT SUM(AMOUNT) from certificates WHERE projectdetails.PROJECTID = certificates.PROJECTID GROUP BY certificates.PROJECTID) as cAmount,
                                                  (SELECT SUM(AMOUNT) from variations WHERE projectdetails.PROJECTID = variations.PROJECTID GROUP BY variations.PROJECTID ) as vAmount
                                                FROM projectdetails
                                                  JOIN variations ON projectdetails.PROJECTID = variations.PROJECTID OR variations.PROJECTID = "aa111"
                                                  JOIN certificates ON projectdetails.PROJECTID = certificates.PROJECTID OR certificates.PROJECTID = "aa111"
                                                GROUP BY projectdetails.PROJECTID) ;
     (SELECT LGA, SUM(CONTRACTSUM) as CSUM1, SUM(cAmount) as CAMOUNT, SUM(vAmount) as VAMOUNT from ttab GROUP BY LGA);

   END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `myProc2`(IN `val` VARCHAR(4))
BEGIN
     DROP TEMPORARY TABLE IF EXISTS ttab;
     create TEMPORARY TABLE IF NOT EXISTS ttab (SELECT projectdetails.PROJECTID, projectdetails.LGA, projectdetails.CONTRACTSUM, YEAR(projectdetails.DATEOFAWARD) as yr,
                                                  (SELECT SUM(AMOUNT) from certificates WHERE projectdetails.PROJECTID = certificates.PROJECTID GROUP BY certificates.PROJECTID) as cAmount,
                                                  (SELECT SUM(AMOUNT) from variations WHERE projectdetails.PROJECTID = variations.PROJECTID GROUP BY variations.PROJECTID ) as vAmount
                                                FROM projectdetails
                                                  JOIN variations ON projectdetails.PROJECTID = variations.PROJECTID OR variations.PROJECTID = "aa111"
                                                  JOIN certificates ON projectdetails.PROJECTID = certificates.PROJECTID OR certificates.PROJECTID = "aa111"
                                                GROUP BY projectdetails.PROJECTID) ;
     (SELECT LGA, SUM(CONTRACTSUM) as CSUM1, SUM(cAmount) as CAMOUNT, SUM(vAmount) as VAMOUNT from ttab WHERE yr = val GROUP BY LGA);

   END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `myProc3`(IN `val` VARCHAR(4))
BEGIN
     DROP TEMPORARY TABLE IF EXISTS ttab;
     create TEMPORARY TABLE IF NOT EXISTS ttab (SELECT projectdetails.PROJECTID, projectdetails.PROCURINGENTITY, projectdetails.CONTRACTSUM, YEAR(projectdetails.DATEOFAWARD) as yr,
            (SELECT SUM(AMOUNT) from certificates WHERE projectdetails.PROJECTID = certificates.PROJECTID GROUP BY certificates.PROJECTID) as cAmount,
           (SELECT SUM(AMOUNT) from variations WHERE projectdetails.PROJECTID = variations.PROJECTID GROUP BY variations.PROJECTID ) as vAmount
          FROM projectdetails
    JOIN variations ON projectdetails.PROJECTID = variations.PROJECTID OR variations.PROJECTID = "aa111"
                                                  JOIN certificates ON projectdetails.PROJECTID = certificates.PROJECTID OR certificates.PROJECTID = "aa111"
                                                GROUP BY projectdetails.PROJECTID) ;
     (SELECT PROCURINGENTITY, SUM(CONTRACTSUM) as CSUM1, SUM(cAmount) as CAMOUNT, SUM(vAmount) as VAMOUNT from ttab WHERE yr = val GROUP BY PROCURINGENTITY LIMIT 2);

   END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `myProc4`()
BEGIN
    DROP TEMPORARY TABLE IF EXISTS ttab;
    create TEMPORARY TABLE IF NOT EXISTS ttab (SELECT projectdetails.PROJECTID, projectdetails.CONTRACTOR, projectdetails.CONTRACTSUM,
    (SELECT SUM(AMOUNT) from certificates WHERE projectdetails.PROJECTID = certificates.PROJECTID GROUP BY certificates.PROJECTID) as cAmount,
    (SELECT SUM(AMOUNT) from variations WHERE projectdetails.PROJECTID = variations.PROJECTID GROUP BY variations.PROJECTID ) as vAmount
    FROM projectdetails
    JOIN variations ON projectdetails.PROJECTID = variations.PROJECTID OR variations.PROJECTID = "aa111"
    JOIN certificates ON projectdetails.PROJECTID = certificates.PROJECTID OR certificates.PROJECTID = "aa111"
    GROUP BY projectdetails.PROJECTID) ;
    (SELECT CONTRACTOR, SUM(CONTRACTSUM) as CSUM1, SUM(cAmount) as CAMOUNT, SUM(vAmount) as VAMOUNT from ttab GROUP BY CONTRACTOR);

  END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `myProc5`(IN `val` VARCHAR(255))
BEGIN
SELECT projectdetails.PROJECTID,  projectdetails.TITLE , projectdetails.CONTRACTOR, projectdetails.CONTRACTSUM, certificates.AMOUNT AS cAmount, variations.AMOUNT AS vAmount
FROM projectdetails
  JOIN variations ON projectdetails.PROJECTID = variations.PROJECTID OR variations.PROJECTID = "aa111"
  JOIN certificates ON projectdetails.PROJECTID = certificates.PROJECTID OR certificates.PROJECTID = "aa111"
WHERE projectdetails.CONTRACTOR = val
GROUP BY projectdetails.PROJECTID;
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

CREATE TABLE IF NOT EXISTS `audit_trail` (
  `ID` int(11) NOT NULL,
  `FNAME` varchar(255) NOT NULL,
  `USER` varchar(100) NOT NULL,
  `ACTION` varchar(255) NOT NULL,
  `TIME_STAMP` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=828 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audit_trail`
--

INSERT INTO `audit_trail` (`ID`, `FNAME`, `USER`, `ACTION`, `TIME_STAMP`) VALUES
(20, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-22 08:11:29'),
(21, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-22 08:18:28'),
(44, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-23 08:07:57'),
(45, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-23 08:10:37'),
(46, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed Project Details By LGA', '2017-05-23 08:13:01'),
(47, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 08:32:09'),
(48, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed Project Sum By LGA', '2017-05-23 08:33:15'),
(49, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 08:33:29'),
(50, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 08:33:39'),
(51, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 08:33:54'),
(52, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 08:35:25'),
(53, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed Project Details By LGA', '2017-05-23 08:37:58'),
(54, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 08:39:16'),
(55, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed All Consultants and Contractors Directory', '2017-05-23 08:48:34'),
(56, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed All Consultants and Contractors Directory', '2017-05-23 08:48:58'),
(57, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed All Consultants and Contractors Directory', '2017-05-23 08:49:01'),
(58, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 08:49:04'),
(59, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 08:53:12'),
(60, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Projects Report', '2017-05-23 08:55:01'),
(61, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed Project Details By LGA', '2017-05-23 08:55:09'),
(62, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed All Consultants and Contractors Directory', '2017-05-23 08:55:12'),
(63, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Projects Report', '2017-05-23 08:55:14'),
(65, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 08:56:15'),
(66, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed Project Sum By LGA', '2017-05-23 08:56:27'),
(67, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 08:56:59'),
(68, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed Project Sum By LGA', '2017-05-23 08:57:02'),
(69, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed Project Sum By LGA', '2017-05-23 08:57:15'),
(70, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed Project Sum By LGA', '2017-05-23 08:57:21'),
(71, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed Project Sum By LGA', '2017-05-23 08:57:24'),
(72, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 08:57:26'),
(74, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 08:58:52'),
(75, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed Project Sum By LGA', '2017-05-23 09:00:45'),
(76, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-23 09:00:55'),
(77, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 09:01:00'),
(78, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-23 09:01:13'),
(80, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 09:01:21'),
(81, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed Project Sum By LGA', '2017-05-23 09:01:31'),
(83, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed All Projects financial Records', '2017-05-23 09:01:39'),
(84, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-23 09:02:08'),
(85, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed All Projects financial Records', '2017-05-23 09:02:34'),
(86, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-23 09:03:00'),
(94, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-23 10:33:43'),
(96, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed Project Sum By LGA', '2017-05-23 10:45:08'),
(103, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 13:52:05'),
(104, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed Project Sum By LGA', '2017-05-23 13:53:32'),
(105, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 13:54:17'),
(106, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-23 13:54:55'),
(107, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-23 13:56:01'),
(108, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed Project Sum By LGA', '2017-05-23 13:56:19'),
(109, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed Project Sum By LGA', '2017-05-23 13:56:22'),
(110, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed Project Sum By LGA', '2017-05-23 13:56:26'),
(111, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-23 13:57:14'),
(112, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Projects Report', '2017-05-23 13:57:16'),
(113, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-05-23 14:06:40'),
(114, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-05-23 14:06:50'),
(115, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-05-23 14:21:53'),
(116, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-05-23 14:22:43'),
(117, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 14:54:15'),
(118, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed All Projects Report', '2017-05-23 14:56:23'),
(119, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 14:57:00'),
(120, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 14:58:48'),
(121, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 14:59:22'),
(122, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed Project Sum By LGA', '2017-05-23 14:59:40'),
(123, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 15:00:10'),
(124, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed All Projects Report', '2017-05-23 15:00:26'),
(125, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 15:01:30'),
(126, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 15:01:53'),
(127, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed All Projects financial Records', '2017-05-23 15:02:00'),
(128, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 15:02:07'),
(129, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 15:02:57'),
(130, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 15:03:12'),
(131, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed All Projects Report', '2017-05-23 15:03:17'),
(132, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 15:03:42'),
(133, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed All Projects financial Records', '2017-05-23 15:04:10'),
(134, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 15:04:14'),
(135, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed Project Details By LGA', '2017-05-23 15:04:42'),
(136, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 15:04:52'),
(137, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-23 15:05:10'),
(138, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed Project Details By LGA', '2017-05-23 15:05:28'),
(139, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-24 07:59:36'),
(140, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Projects Report', '2017-05-24 07:59:46'),
(141, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed Project Details By LGA', '2017-05-24 08:01:15'),
(142, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Projects Report', '2017-05-24 08:01:43'),
(143, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed Project Details By LGA', '2017-05-24 08:02:57'),
(144, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-24 08:08:59'),
(145, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Projects Report', '2017-05-24 08:09:41'),
(146, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Projects Report', '2017-05-24 08:17:03'),
(147, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Projects Report', '2017-05-24 08:17:10'),
(148, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed Project Details By LGA', '2017-05-24 08:17:18'),
(149, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Projects Report', '2017-05-24 08:17:32'),
(150, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-24 08:18:49'),
(151, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Projects Report', '2017-05-24 08:18:55'),
(152, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-24 08:20:45'),
(153, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Consultants', '2017-05-24 08:20:57'),
(154, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-24 08:21:22'),
(155, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-05-24 08:22:08'),
(156, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-24 08:22:16'),
(157, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-24 08:22:19'),
(158, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-24 08:22:20'),
(159, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-05-24 08:22:24'),
(160, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed Project Sum By LGA', '2017-05-24 08:22:48'),
(161, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-05-24 08:25:19'),
(162, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-05-24 08:25:27'),
(163, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-24 08:26:57'),
(164, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-24 08:28:34'),
(165, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-24 08:31:18'),
(166, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-24 08:32:45'),
(167, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed All Projects Report', '2017-05-24 08:33:10'),
(168, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed All Projects Report', '2017-05-24 08:33:36'),
(169, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-24 08:35:07'),
(170, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-24 08:38:34'),
(171, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-24 08:38:49'),
(172, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed All Projects financial Records', '2017-05-24 08:38:53'),
(173, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-24 08:39:10'),
(174, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed All Projects financial Records', '2017-05-24 08:39:24'),
(175, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-24 08:49:43'),
(176, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-24 08:49:59'),
(177, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-24 08:50:34'),
(178, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed Project Sum By LGA', '2017-05-24 08:50:38'),
(179, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-24 08:50:47'),
(180, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed All Projects Report', '2017-05-24 08:50:51'),
(181, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed All Projects financial Records', '2017-05-24 08:51:06'),
(182, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed All Projects Report', '2017-05-24 08:52:10'),
(183, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-24 08:52:22'),
(184, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed All Projects financial Records', '2017-05-24 08:52:29'),
(185, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-24 08:52:37'),
(186, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed All Projects financial Records', '2017-05-24 08:52:45'),
(187, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-24 08:54:17'),
(188, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-24 09:35:54'),
(189, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-24 09:42:37'),
(190, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-24 09:42:56'),
(191, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-24 10:58:38'),
(192, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Projects Report', '2017-05-24 11:01:16'),
(193, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed All Projects financial Records', '2017-05-24 11:04:19'),
(194, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed All Projects financial Records', '2017-05-24 11:09:33'),
(195, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Projects Report', '2017-05-24 11:11:22'),
(196, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed Project Details By LGA', '2017-05-24 11:18:52'),
(197, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Projects Report', '2017-05-24 11:19:14'),
(198, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed Project Details By LGA', '2017-05-24 11:20:01'),
(199, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed Project Sum By LGA', '2017-05-24 11:20:15'),
(200, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-24 11:36:51'),
(201, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-24 11:52:06'),
(202, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-24 12:03:41'),
(203, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-24 12:04:04'),
(204, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-24 12:06:30'),
(205, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed All Projects financial Records', '2017-05-24 12:08:01'),
(206, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-24 12:08:16'),
(207, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-24 12:09:18'),
(208, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-24 12:09:44'),
(209, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-24 12:11:27'),
(210, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed All Projects financial Records', '2017-05-24 12:11:46'),
(211, '', '', 'viewed All Projects financial Records', '2017-05-24 12:14:26'),
(212, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-24 12:14:44'),
(213, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed All Projects financial Records', '2017-05-24 12:15:10'),
(214, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed All Projects financial Records', '2017-05-24 12:15:30'),
(215, '', '', 'viewed All Projects financial Records', '2017-05-24 12:16:47'),
(216, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-24 12:17:29'),
(217, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Projects Report', '2017-05-24 12:17:39'),
(218, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-24 13:33:30'),
(219, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-05-24 13:35:57'),
(220, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-05-24 13:47:49'),
(221, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-05-24 13:49:52'),
(222, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-05-24 13:50:03'),
(223, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-05-24 13:50:11'),
(224, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-05-24 14:03:18'),
(225, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-05-24 14:03:44'),
(226, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-24 14:38:31'),
(227, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Changed Password', '2017-05-24 14:42:32'),
(228, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Projects Report', '2017-05-24 14:42:43'),
(229, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Projects Report', '2017-05-24 14:43:02'),
(230, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Projects Report', '2017-05-24 14:44:12'),
(231, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Projects Report', '2017-05-24 14:44:18'),
(232, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Projects Report', '2017-05-24 14:44:54'),
(233, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-24 14:47:51'),
(234, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Changed Password', '2017-05-24 14:50:03'),
(235, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Projects Report', '2017-05-24 14:50:15'),
(236, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Projects Report', '2017-05-24 14:50:29'),
(237, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-25 08:50:09'),
(238, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-25 08:53:29'),
(239, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed Project Sum By LGA', '2017-05-25 08:53:48'),
(240, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-25 08:55:04'),
(241, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed All Projects Report', '2017-05-25 08:56:36'),
(242, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed All Projects financial Records', '2017-05-25 08:57:02'),
(243, '', '', 'Viewed Dashboard.', '2017-05-25 12:33:13'),
(244, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-25 13:21:52'),
(245, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed All Projects financial Records', '2017-05-25 13:22:00'),
(246, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-25 13:22:09'),
(247, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-25 13:23:36'),
(248, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Added Certificate', '2017-05-25 14:08:23'),
(249, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Added Certificate', '2017-05-25 14:16:36'),
(250, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Added Certificate', '2017-05-25 14:17:56'),
(251, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-25 14:19:45'),
(252, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed Project Details By LGA', '2017-05-25 14:21:53'),
(253, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-25 14:24:35'),
(254, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-26 08:37:27'),
(255, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-26 08:40:05'),
(256, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed Project Details By LGA', '2017-05-26 08:40:20'),
(257, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-26 08:41:30'),
(258, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed All Projects financial Records', '2017-05-26 08:41:35'),
(259, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-26 08:41:49'),
(260, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed Project Sum By LGA', '2017-05-26 08:41:58'),
(261, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-26 08:42:27'),
(262, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed Project Sum By LGA', '2017-05-26 08:42:37'),
(263, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-26 08:42:40'),
(264, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed All Consultants and Contractors Directory', '2017-05-26 08:42:47'),
(265, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-26 08:42:54'),
(266, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed All Projects financial Records', '2017-05-26 08:48:00'),
(267, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed Project Sum By LGA', '2017-05-26 08:49:22'),
(268, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed All Consultants and Contractors Directory', '2017-05-26 08:49:44'),
(269, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed All Projects Report', '2017-05-26 08:50:00'),
(270, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed All Projects Report', '2017-05-26 08:50:31'),
(271, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed All Projects Report', '2017-05-26 08:50:33'),
(272, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed All Projects Report', '2017-05-26 08:50:35'),
(273, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-26 12:09:42'),
(274, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 09:00:44'),
(275, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed All Projects Report', '2017-05-30 09:02:17'),
(276, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 09:02:26'),
(277, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 09:02:34'),
(278, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 09:07:55'),
(279, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed All Projects financial Records', '2017-05-30 09:08:00'),
(280, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 09:08:11'),
(281, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed All Projects financial Records', '2017-05-30 09:08:14'),
(282, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 09:08:21'),
(283, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 09:08:32'),
(284, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed Project Sum By LGA', '2017-05-30 09:08:37'),
(285, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 09:08:43'),
(286, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-30 15:18:41'),
(287, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 15:53:01'),
(288, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 15:53:40'),
(289, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed All Projects Report', '2017-05-30 15:54:17'),
(290, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 15:54:27'),
(291, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed Project Details By LGA', '2017-05-30 15:55:17'),
(292, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 15:55:23'),
(293, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed All Projects financial Records', '2017-05-30 15:55:29'),
(294, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 15:55:47'),
(295, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-30 16:14:34'),
(296, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-05-30 16:22:29'),
(297, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-05-30 16:23:13'),
(298, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 16:23:25'),
(299, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-05-30 16:23:35'),
(300, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-05-30 16:24:30'),
(301, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 16:24:43'),
(302, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 16:25:29'),
(303, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 16:26:58'),
(304, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 16:28:30'),
(305, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 16:30:26'),
(306, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 16:32:30'),
(307, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 16:34:46'),
(308, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 16:36:39'),
(309, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed Project Details By LGA', '2017-05-30 16:37:49'),
(310, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 16:37:55'),
(311, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed All Projects financial Records', '2017-05-30 16:38:05'),
(312, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 16:38:16'),
(313, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 16:38:42'),
(314, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed Project Sum By LGA', '2017-05-30 16:38:59'),
(315, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 16:39:06'),
(316, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-05-30 16:43:48'),
(317, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-30 16:46:05'),
(318, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-30 16:47:03'),
(319, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-30 16:47:59'),
(320, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-30 16:50:06'),
(321, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-05-30 16:53:42'),
(322, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-05-30 16:55:09'),
(323, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-05-30 16:57:05'),
(324, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-05-30 17:03:27'),
(325, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed Project Sum By LGA', '2017-05-30 17:03:41'),
(326, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-05-30 17:07:56'),
(327, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-05-30 17:08:44'),
(328, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-05-30 17:09:47'),
(329, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-30 17:10:41'),
(330, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 17:11:19'),
(331, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed Project Details By LGA', '2017-05-30 17:13:33'),
(332, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 17:14:13'),
(333, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 17:18:58'),
(334, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed Project Sum By LGA', '2017-05-30 17:19:24'),
(335, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed All Projects Report', '2017-05-30 17:19:49'),
(336, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed All Projects financial Records', '2017-05-30 17:20:14'),
(337, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed Project Details By LGA', '2017-05-30 17:21:43'),
(338, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed All Projects Report', '2017-05-30 17:22:02'),
(339, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-30 17:23:35'),
(340, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed Project Sum By LGA', '2017-05-30 17:25:57'),
(341, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed Project Sum By LGA', '2017-05-30 17:29:22'),
(342, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed All Consultants and Contractors Directory', '2017-05-30 17:33:02'),
(343, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 17:34:48'),
(344, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 17:36:59'),
(345, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-05-30 17:40:46'),
(346, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed All Projects Report', '2017-05-30 17:41:07'),
(347, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'viewed All Projects financial Records', '2017-05-30 17:41:53'),
(348, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed Project Sum By LGA', '2017-05-30 17:42:19'),
(349, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed Project Sum By LGA', '2017-05-30 17:43:43'),
(350, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-31 08:56:48'),
(351, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-31 09:04:48'),
(352, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-31 09:08:55'),
(353, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed All Consultants and Contractors Directory', '2017-05-31 09:09:22'),
(354, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed All Projects financial Records', '2017-05-31 09:09:48'),
(355, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed All Projects financial Records', '2017-05-31 09:11:49'),
(356, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-31 09:36:11'),
(357, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-31 09:40:05'),
(358, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-31 09:45:49'),
(359, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-31 09:48:28'),
(360, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-31 09:51:37'),
(361, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-31 09:53:13'),
(362, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-31 09:54:00'),
(363, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-31 09:54:17'),
(364, 'Ndukwe', 'endy.odoo@gmail.com', 'Added Certificate', '2017-05-31 10:24:47'),
(365, 'Ndukwe', 'endy.odoo@gmail.com', 'Added Certificate', '2017-05-31 10:30:00'),
(366, 'Ndukwe', 'endy.odoo@gmail.com', 'Added Certificate', '2017-05-31 10:32:28'),
(367, 'Ndukwe', 'endy.odoo@gmail.com', 'Added Certificate', '2017-05-31 10:36:22'),
(368, 'Ndukwe', 'endy.odoo@gmail.com', 'Added Certificate', '2017-05-31 10:37:02'),
(369, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-31 10:38:18'),
(370, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-31 10:38:27'),
(371, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-31 10:40:06'),
(372, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-05-31 10:40:15'),
(373, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Projects Report', '2017-05-31 10:40:40'),
(374, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-05-31 10:42:32'),
(375, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-31 10:43:02'),
(376, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-31 11:18:53'),
(377, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-31 12:03:34'),
(378, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-05-31 12:08:20'),
(379, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-05-31 12:11:30'),
(380, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-05 11:33:01'),
(381, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-05 11:34:09'),
(382, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-05 11:41:28'),
(383, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-06-05 11:41:44'),
(384, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-05 11:42:55'),
(385, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-06-05 11:43:01'),
(386, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-05 15:14:01'),
(387, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-06-05 15:14:45'),
(388, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Consultants and Contractors Directory', '2017-06-05 15:20:12'),
(389, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed Project Sum By LGA', '2017-06-05 15:23:19'),
(390, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed Project Sum By LGA', '2017-06-05 15:25:44'),
(391, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed Project Sum By LGA', '2017-06-05 15:26:10'),
(392, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed Project Details By LGA', '2017-06-05 15:35:00'),
(393, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-06 08:45:57'),
(394, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-06-06 08:46:04'),
(395, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-06 09:00:17'),
(396, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-06-06 09:00:53'),
(397, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-06-06 09:01:08'),
(398, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-06 09:02:10'),
(399, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-06-06 09:03:08'),
(400, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-06 09:03:11'),
(401, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Contractors', '2017-06-06 09:05:39'),
(402, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Projects Report', '2017-06-06 09:05:55'),
(403, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Projects Report', '2017-06-06 09:06:10'),
(404, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Projects Report', '2017-06-06 09:06:15'),
(405, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-06 10:33:04'),
(406, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-06 10:35:11'),
(407, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-06 10:37:13'),
(408, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-06-06 10:37:34'),
(409, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-06-06 10:50:56'),
(410, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-06-06 11:09:03'),
(411, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-06-06 11:09:51'),
(412, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-06-06 11:21:03'),
(413, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-06-06 11:21:32'),
(414, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-06-06 11:24:21'),
(415, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-06-06 11:28:31'),
(416, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-06-06 11:38:24'),
(417, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-06-06 12:41:07'),
(418, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-06 12:57:53'),
(419, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-06-06 12:59:19'),
(420, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-06-06 13:04:45'),
(421, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-07 14:10:26'),
(422, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-07 14:11:37'),
(423, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-06-07 14:11:40'),
(424, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-06-07 14:14:17'),
(425, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-06-07 14:17:36'),
(426, 'Queen', 'bamidelequeen@yahoo.com', 'Viewed All Contractors', '2017-06-12 13:16:22'),
(427, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-13 08:55:40'),
(428, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-13 08:56:20'),
(429, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:57:07'),
(430, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:58:13'),
(431, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:58:13'),
(432, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:21'),
(433, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:22'),
(434, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:23'),
(435, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:23'),
(436, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:24'),
(437, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:25'),
(438, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:26'),
(439, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:27'),
(440, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:27'),
(441, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:28'),
(442, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:29'),
(443, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:30'),
(444, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:30'),
(445, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:31'),
(446, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:32'),
(447, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:33'),
(448, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:34'),
(449, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:35'),
(450, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:36'),
(451, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:37'),
(452, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:37'),
(453, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:38'),
(454, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:39'),
(455, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:40'),
(456, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:41'),
(457, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:42'),
(458, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:43'),
(459, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:44'),
(460, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:44'),
(461, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:45'),
(462, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:46'),
(463, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:46'),
(464, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:47'),
(465, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:49'),
(466, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:50'),
(467, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 08:59:50'),
(468, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 09:00:51'),
(469, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 09:00:51'),
(470, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 09:01:54'),
(471, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-13 09:01:54'),
(472, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Consultants', '2017-06-13 09:02:32'),
(473, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Consultants', '2017-06-13 09:02:39'),
(474, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Consultants', '2017-06-13 09:02:40'),
(475, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-13 09:04:27'),
(476, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-13 09:04:27'),
(477, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-06-13 09:14:44'),
(478, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-06-13 09:14:45'),
(479, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-13 09:16:07'),
(480, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-13 09:16:07'),
(481, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-06-13 09:16:17'),
(482, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-06-13 09:16:18'),
(483, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed Project Details By LGA', '2017-06-13 09:17:03'),
(484, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed Project Details By LGA', '2017-06-13 09:17:04'),
(485, '', '', 'Viewed Dashboard.', '2017-06-13 11:25:01'),
(486, 'Queen', 'bamidelequeen@yahoo.com', 'Viewed All Contractors', '2017-06-13 11:25:51'),
(487, 'Queen', 'bamidelequeen@yahoo.com', 'Viewed All Contractors', '2017-06-13 11:25:51'),
(488, 'Queen', 'bamidelequeen@yahoo.com', 'Viewed All Consultants', '2017-06-13 11:26:34'),
(489, 'Queen', 'bamidelequeen@yahoo.com', 'Viewed All Consultants', '2017-06-13 11:26:34'),
(490, 'Queen', 'bamidelequeen@yahoo.com', 'Viewed All Contractors', '2017-06-13 11:52:30'),
(491, 'Queen', 'bamidelequeen@yahoo.com', 'Viewed All Contractors', '2017-06-13 11:52:31'),
(492, 'Queen', 'bamidelequeen@yahoo.com', 'Viewed All Consultants', '2017-06-13 11:55:10'),
(493, 'Queen', 'bamidelequeen@yahoo.com', 'Viewed All Consultants', '2017-06-13 11:55:10'),
(494, 'Queen', 'bamidelequeen@yahoo.com', 'Viewed All Contractors', '2017-06-13 12:14:49'),
(495, 'Queen', 'bamidelequeen@yahoo.com', 'Viewed All Contractors', '2017-06-13 12:14:50'),
(496, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-19 10:09:13'),
(497, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-19 10:09:13'),
(498, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-19 10:10:25'),
(499, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-19 10:12:06'),
(500, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-19 10:13:10'),
(501, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-19 10:13:27'),
(502, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-19 10:13:27'),
(503, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-19 13:57:06'),
(504, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-19 13:57:06'),
(505, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed Project Sum By LGA', '2017-06-19 13:59:17'),
(506, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed Project Sum By LGA', '2017-06-19 13:59:17'),
(507, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed Project Details By LGA', '2017-06-19 13:59:56'),
(508, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed Project Details By LGA', '2017-06-19 13:59:56'),
(509, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Consultants and Contractors Directory', '2017-06-19 14:00:06'),
(510, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Consultants and Contractors Directory', '2017-06-19 14:00:06'),
(511, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-19 14:01:26'),
(512, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-19 14:01:26'),
(513, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-06-19 14:01:46'),
(514, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-06-19 14:01:46'),
(515, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed Project Details By LGA', '2017-06-19 14:19:04'),
(516, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed Project Details By LGA', '2017-06-19 14:19:04'),
(517, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-19 14:19:23'),
(518, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-06-19 14:19:31'),
(519, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-06-19 14:19:31'),
(520, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-19 14:19:46'),
(521, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-19 14:20:21'),
(522, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed Project Sum By LGA', '2017-06-19 14:20:29'),
(523, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed Project Sum By LGA', '2017-06-19 14:20:29'),
(524, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-19 14:20:39'),
(525, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-19 14:21:20'),
(526, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-19 14:21:20'),
(527, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Consultants and Contractors Directory', '2017-06-19 14:24:42'),
(528, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Consultants and Contractors Directory', '2017-06-19 14:24:42'),
(529, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Consultants', '2017-06-19 14:25:11'),
(530, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Consultants', '2017-06-19 14:25:12'),
(531, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-06-20 08:23:14'),
(532, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-06-20 08:23:14'),
(533, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-06-20 08:24:08'),
(534, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-06-20 08:24:08'),
(535, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed Project Details By LGA', '2017-06-20 08:25:49'),
(536, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed Project Details By LGA', '2017-06-20 08:25:50'),
(537, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed All Projects financial Records', '2017-06-20 08:26:04'),
(538, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed All Projects financial Records', '2017-06-20 08:26:04'),
(539, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed All Projects financial Records', '2017-06-20 08:30:40'),
(540, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed All Projects financial Records', '2017-06-20 08:30:41'),
(541, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed All Projects financial Records', '2017-06-20 08:30:58'),
(542, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed All Projects financial Records', '2017-06-20 08:30:59'),
(543, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-06-20 08:31:15'),
(544, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-06-20 08:31:57'),
(545, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-06-20 08:31:57'),
(546, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed All Projects financial Records', '2017-06-20 08:32:59'),
(547, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed All Projects financial Records', '2017-06-20 08:33:00'),
(548, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed Project Details By LGA', '2017-06-20 08:33:21'),
(549, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed Project Details By LGA', '2017-06-20 08:33:21'),
(550, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed All Consultants and Contractors Directory', '2017-06-20 08:33:49'),
(551, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'viewed All Consultants and Contractors Directory', '2017-06-20 08:33:50'),
(552, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Consultants', '2017-06-20 08:34:03'),
(553, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed All Consultants', '2017-06-20 08:34:03'),
(554, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-20 09:41:28'),
(555, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-20 09:41:28'),
(556, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-20 09:42:05'),
(557, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-20 09:42:05'),
(558, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed Project Sum By LGA', '2017-06-20 09:42:18'),
(559, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed Project Sum By LGA', '2017-06-20 09:42:18'),
(560, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-20 09:42:22'),
(561, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-20 09:42:22'),
(562, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-06-20 09:49:47'),
(563, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Projects financial Records', '2017-06-20 09:49:48'),
(564, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed Project Sum By LGA', '2017-06-20 09:50:01'),
(565, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed Project Sum By LGA', '2017-06-20 09:50:01'),
(566, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Consultants and Contractors Directory', '2017-06-20 09:50:22'),
(567, 'Ndukwe', 'endy.odoo@gmail.com', 'viewed All Consultants and Contractors Directory', '2017-06-20 09:50:22'),
(568, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-20 10:15:39'),
(569, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-20 11:06:58'),
(570, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-20 11:06:58'),
(571, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-20 11:07:57'),
(572, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed Dashboard.', '2017-06-20 11:07:57'),
(573, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-20 11:08:36'),
(574, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Contractors', '2017-06-20 11:08:37'),
(575, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-06-20 11:24:48'),
(576, 'Ndukwe', 'endy.odoo@gmail.com', 'Viewed All Projects Report', '2017-06-20 11:24:48'),
(577, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-06-20 12:16:47'),
(578, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Viewed Dashboard.', '2017-06-20 12:16:47'),
(579, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Added Certificate', '2017-06-20 12:30:56'),
(580, 'Osazuwa', 'osazuwa.noruwa@gmail.com', 'Added Certificate', '2017-06-20 12:34:57'),
(581, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-06-20 15:03:21'),
(582, 'osahon okungbowa', 'o.osahon@edostate.gov.ng', 'Viewed Dashboard.', '2017-06-20 15:03:21'),
(583, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-21 12:57:56'),
(584, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-21 12:57:58'),
(585, 'Dokhare', 'josephdokhare@gmail.com', 'viewed All Projects financial Records', '2017-06-21 12:58:27'),
(586, 'Dokhare', 'josephdokhare@gmail.com', 'viewed All Projects financial Records', '2017-06-21 12:58:27'),
(587, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-22 09:10:09'),
(588, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-22 09:10:11'),
(589, 'Dokhare', 'josephdokhare@gmail.com', 'Created a User', '2017-06-22 09:41:42'),
(590, 'Dokhare', 'josephdokhare@gmail.com', 'Created a User', '2017-06-22 09:41:50'),
(591, 'Dokhare', 'josephdokhare@gmail.com', 'Created a User', '2017-06-22 09:41:59'),
(592, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-22 10:23:49');
INSERT INTO `audit_trail` (`ID`, `FNAME`, `USER`, `ACTION`, `TIME_STAMP`) VALUES
(593, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-22 10:23:50'),
(594, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-22 10:36:45'),
(595, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-22 10:36:48'),
(596, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-22 10:37:29'),
(597, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-22 10:37:31'),
(598, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-22 10:50:41'),
(599, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-22 10:50:43'),
(600, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-22 10:52:30'),
(601, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-22 10:52:31'),
(602, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-22 10:53:55'),
(603, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-22 10:53:57'),
(604, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-06-22 10:55:44'),
(605, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-06-22 10:55:44'),
(606, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-22 10:59:31'),
(607, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-22 10:59:33'),
(608, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-23 11:01:12'),
(609, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-23 11:01:15'),
(610, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-23 12:57:00'),
(611, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-23 12:57:02'),
(612, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-23 13:28:57'),
(613, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-23 13:28:59'),
(614, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-29 10:22:04'),
(615, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-29 10:22:06'),
(616, 'Dokhare', 'josephdokhare@gmail.com', 'Approved a Certificate', '2017-06-29 10:23:01'),
(617, 'Dokhare', 'josephdokhare@gmail.com', 'Added Variations', '2017-06-29 10:23:15'),
(618, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-30 11:21:32'),
(619, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-30 11:21:36'),
(620, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-30 13:39:19'),
(621, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-30 13:39:22'),
(622, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-30 14:36:20'),
(623, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-30 14:36:22'),
(624, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-06-30 14:36:35'),
(625, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 11:44:28'),
(626, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 11:44:32'),
(627, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 11:45:45'),
(628, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 11:45:46'),
(629, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 12:09:12'),
(630, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 12:09:14'),
(631, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 12:09:29'),
(632, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 13:09:21'),
(633, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 13:09:22'),
(634, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 13:09:29'),
(635, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 13:19:32'),
(636, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 13:19:33'),
(637, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 13:19:46'),
(638, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 13:35:24'),
(639, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 13:35:26'),
(640, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 13:35:37'),
(641, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 13:35:39'),
(642, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 13:35:40'),
(643, 'Dokhare', 'josephdokhare@gmail.com', 'Created a User', '2017-07-04 14:51:11'),
(644, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 15:00:47'),
(645, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 15:00:48'),
(646, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 15:03:11'),
(647, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 15:03:12'),
(648, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 15:03:21'),
(649, 'Dokhare', 'josephdokhare@gmail.com', 'Created a User', '2017-07-04 15:06:15'),
(650, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 15:06:47'),
(651, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 15:06:49'),
(652, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 15:06:54'),
(653, 'Dokhare', 'josephdokhare@gmail.com', 'viewed All Projects financial Records', '2017-07-04 15:25:27'),
(654, 'Dokhare', 'josephdokhare@gmail.com', 'viewed All Projects financial Records', '2017-07-04 15:25:28'),
(655, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 15:53:01'),
(656, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 15:53:02'),
(657, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 15:54:12'),
(658, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-04 15:55:12'),
(659, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-06 09:40:47'),
(660, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-06 09:40:49'),
(661, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 10:00:13'),
(662, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 10:00:13'),
(663, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 10:05:24'),
(664, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 10:05:24'),
(665, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 10:07:59'),
(666, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 10:08:47'),
(667, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 10:13:35'),
(668, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 10:16:06'),
(669, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 10:18:13'),
(670, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 10:21:33'),
(671, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 10:31:00'),
(672, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 10:31:10'),
(673, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 10:59:20'),
(674, '', '', 'Viewed All Projects Report', '2017-07-06 10:59:58'),
(675, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-06 11:00:10'),
(676, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-06 11:00:12'),
(677, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 11:00:18'),
(678, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 11:02:00'),
(679, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 11:02:58'),
(680, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 11:03:03'),
(681, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 11:03:13'),
(682, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 11:06:52'),
(683, 'Dokhare', 'josephdokhare@gmail.com', 'viewed All Projects financial Records', '2017-07-06 11:37:12'),
(684, 'Dokhare', 'josephdokhare@gmail.com', 'viewed All Projects financial Records', '2017-07-06 11:37:12'),
(685, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 11:50:04'),
(686, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 11:55:45'),
(687, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 12:07:10'),
(688, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 12:08:28'),
(689, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 12:44:12'),
(690, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 12:44:45'),
(691, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 12:46:35'),
(692, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 12:47:56'),
(693, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 12:48:35'),
(694, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 13:01:40'),
(695, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 13:03:26'),
(696, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 13:03:30'),
(697, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 13:05:18'),
(698, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 13:13:02'),
(699, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 13:13:24'),
(700, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 13:13:27'),
(701, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 13:13:30'),
(702, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 13:13:53'),
(703, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 13:14:04'),
(704, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 13:14:19'),
(705, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 13:14:41'),
(706, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 13:14:49'),
(707, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Contractors', '2017-07-06 13:49:47'),
(708, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Contractors', '2017-07-06 13:49:47'),
(709, 'Dokhare', 'josephdokhare@gmail.com', 'viewed Project Details By LGA', '2017-07-06 13:50:02'),
(710, 'Dokhare', 'josephdokhare@gmail.com', 'viewed Project Details By LGA', '2017-07-06 13:50:02'),
(711, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 13:51:01'),
(712, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 13:51:04'),
(713, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 13:51:06'),
(714, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 13:51:10'),
(715, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 13:51:15'),
(716, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 13:51:20'),
(717, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 13:51:23'),
(718, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 13:53:02'),
(719, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Contractors', '2017-07-06 13:53:18'),
(720, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Contractors', '2017-07-06 13:53:18'),
(721, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 13:58:28'),
(722, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-06 13:58:29'),
(723, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-10 08:35:33'),
(724, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-10 08:35:35'),
(725, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 08:35:52'),
(726, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 08:36:12'),
(727, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 08:36:31'),
(728, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 08:36:48'),
(729, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 08:42:01'),
(730, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 08:42:16'),
(731, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 08:45:25'),
(732, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-10 09:01:11'),
(733, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-10 09:01:14'),
(734, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 09:01:36'),
(735, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 09:01:55'),
(736, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 09:09:53'),
(737, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 09:10:14'),
(738, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 09:10:23'),
(739, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 09:10:26'),
(740, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 10:00:03'),
(741, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 10:00:08'),
(742, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 10:07:01'),
(743, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 10:07:07'),
(744, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 10:07:10'),
(745, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 10:08:18'),
(746, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 10:25:54'),
(747, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 10:29:58'),
(748, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 10:30:01'),
(749, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 10:30:16'),
(750, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 10:30:19'),
(751, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 10:30:26'),
(752, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 10:31:46'),
(753, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 10:42:09'),
(754, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 10:42:16'),
(755, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 10:42:23'),
(756, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 10:42:27'),
(757, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 10:42:38'),
(758, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 10:42:39'),
(759, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-10 10:55:31'),
(760, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-10 10:55:33'),
(761, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 11:01:02'),
(762, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 11:02:42'),
(763, 'JOSEPH', 'josephlight@gmail.com', 'Viewed All Projects Report', '2017-07-10 11:03:22'),
(764, 'JOSEPH', 'josephlight@gmail.com', 'Viewed All Projects Report', '2017-07-10 11:05:42'),
(765, 'JOSEPH', 'josephlight@gmail.com', 'Viewed All Projects Report', '2017-07-10 11:06:22'),
(766, 'JOSEPH', 'josephlight@gmail.com', 'Viewed All Projects Report', '2017-07-10 11:06:51'),
(767, 'JOSEPH', 'josephlight@gmail.com', 'Viewed All Projects Report', '2017-07-10 11:07:06'),
(768, 'JOSEPH', 'josephlight@gmail.com', 'Viewed All Projects Report', '2017-07-10 11:07:11'),
(769, 'JOSEPH', 'josephlight@gmail.com', 'Viewed All Projects Report', '2017-07-10 11:07:14'),
(770, 'JOSEPH', 'josephlight@gmail.com', 'Viewed All Projects Report', '2017-07-10 11:07:21'),
(771, 'JOSEPH', 'josephlight@gmail.com', 'Viewed All Projects Report', '2017-07-10 11:08:39'),
(772, 'JOSEPH', 'josephlight@gmail.com', 'Viewed All Projects Report', '2017-07-10 11:09:35'),
(773, 'JOSEPH', 'josephlight@gmail.com', 'Viewed All Projects Report', '2017-07-10 11:09:39'),
(774, 'JOSEPH', 'josephlight@gmail.com', 'Viewed All Projects Report', '2017-07-10 11:09:48'),
(775, 'JOSEPH', 'josephlight@gmail.com', 'Viewed All Projects Report', '2017-07-10 11:10:50'),
(776, 'JOSEPH', 'josephlight@gmail.com', 'Viewed All Projects Report', '2017-07-10 11:10:56'),
(777, 'JOSEPH', 'josephlight@gmail.com', 'Viewed All Projects Report', '2017-07-10 11:11:21'),
(778, 'JOSEPH', 'josephlight@gmail.com', 'Viewed All Projects Report', '2017-07-10 11:11:36'),
(779, 'JOSEPH', 'josephlight@gmail.com', 'Viewed All Projects Report', '2017-07-10 11:19:42'),
(780, 'JOSEPH', 'josephlight@gmail.com', 'Viewed All Projects Report', '2017-07-10 11:19:51'),
(781, 'JOSEPH', 'josephlight@gmail.com', 'Viewed All Projects Report', '2017-07-10 11:20:06'),
(782, 'JOSEPH', 'josephlight@gmail.com', 'Viewed All Projects Report', '2017-07-10 11:29:02'),
(783, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-10 11:31:26'),
(784, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-10 11:31:27'),
(785, 'Dokhare', 'josephdokhare@gmail.com', 'Added Variations', '2017-07-10 11:31:55'),
(786, 'Dokhare', 'josephdokhare@gmail.com', 'Added Variations', '2017-07-10 11:32:13'),
(787, 'Dokhare', 'josephdokhare@gmail.com', 'Added Variations', '2017-07-10 11:32:59'),
(788, 'Dokhare', 'josephdokhare@gmail.com', 'Added Certificate', '2017-07-10 11:33:36'),
(789, 'Dokhare', 'josephdokhare@gmail.com', 'Added Certificate', '2017-07-10 11:33:44'),
(790, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 11:34:22'),
(791, 'Dokhare', 'josephdokhare@gmail.com', 'Added Variations', '2017-07-10 11:38:07'),
(792, 'Dokhare', 'josephdokhare@gmail.com', 'Added Variations', '2017-07-10 11:40:52'),
(793, 'Dokhare', 'josephdokhare@gmail.com', 'Added Variations', '2017-07-10 11:43:45'),
(794, 'Dokhare', 'josephdokhare@gmail.com', 'Added Variations', '2017-07-10 11:44:37'),
(795, 'Dokhare', 'josephdokhare@gmail.com', 'Added Variations', '2017-07-10 11:44:48'),
(796, 'Dokhare', 'josephdokhare@gmail.com', 'Added Variations', '2017-07-10 11:47:11'),
(797, 'Dokhare', 'josephdokhare@gmail.com', 'Added Variations', '2017-07-10 11:50:42'),
(798, 'Dokhare', 'josephdokhare@gmail.com', 'Added Variations', '2017-07-10 11:51:24'),
(799, 'Dokhare', 'josephdokhare@gmail.com', 'Added Variations', '2017-07-10 11:52:10'),
(800, 'Dokhare', 'josephdokhare@gmail.com', 'Added Variations', '2017-07-10 11:52:22'),
(801, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 11:53:30'),
(802, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 11:53:40'),
(803, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 11:53:47'),
(804, 'Dokhare', 'josephdokhare@gmail.com', 'Added Certificate', '2017-07-10 12:39:23'),
(805, 'Dokhare', 'josephdokhare@gmail.com', 'Approved a Certificate', '2017-07-10 12:40:19'),
(806, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-10 13:22:51'),
(807, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-10 13:22:53'),
(808, 'Dokhare', 'josephdokhare@gmail.com', 'Approved a Certificate', '2017-07-10 13:24:42'),
(809, 'Dokhare', 'josephdokhare@gmail.com', 'Approved a Certificate', '2017-07-10 13:27:39'),
(810, 'Dokhare', 'josephdokhare@gmail.com', 'Approved a Certificate', '2017-07-10 13:49:02'),
(811, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 13:49:28'),
(812, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 13:49:45'),
(813, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-10 13:49:51'),
(814, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-11 11:04:27'),
(815, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-11 11:04:29'),
(816, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-11 11:05:40'),
(817, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Contractors', '2017-07-11 11:07:24'),
(818, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Contractors', '2017-07-11 11:07:25'),
(819, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-11 11:08:28'),
(820, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-11 11:09:09'),
(821, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed All Projects Report', '2017-07-11 11:09:16'),
(822, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-11 11:10:59'),
(823, 'Dokhare', 'josephdokhare@gmail.com', 'Viewed Dashboard.', '2017-07-11 11:11:00'),
(824, 'Dokhare', 'josephdokhare@gmail.com', 'viewed Project Details By LGA', '2017-07-11 11:12:39'),
(825, 'Dokhare', 'josephdokhare@gmail.com', 'viewed Project Details By LGA', '2017-07-11 11:12:39'),
(826, 'Dokhare', 'josephdokhare@gmail.com', 'viewed All Projects financial Records', '2017-07-11 11:12:59'),
(827, 'Dokhare', 'josephdokhare@gmail.com', 'viewed All Projects financial Records', '2017-07-11 11:12:59');

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE IF NOT EXISTS `budget` (
  `ID` int(11) NOT NULL,
  `PROJECTID` varchar(100) NOT NULL,
  `SECTOR` varchar(100) NOT NULL,
  `SUBSECTOR` varchar(100) NOT NULL,
  `BUDGETHEAD` varchar(100) NOT NULL,
  `BUDGETSUBHEAD` varchar(100) NOT NULL,
  `COMMENT` varchar(100) NOT NULL,
  `APPROPRIATION` float NOT NULL,
  `SUBSECTORALLOCATION` float NOT NULL,
  `SUPPLEMENTARYPROVISION` float NOT NULL,
  `SUBSECTORPERCENTAGE` int(11) NOT NULL,
  `AAYEAR` varchar(10) NOT NULL,
  `SPYEAR` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE IF NOT EXISTS `certificates` (
  `ID` int(11) NOT NULL,
  `PROJECTID` varchar(100) NOT NULL,
  `REQID` varchar(100) DEFAULT NULL,
  `CERTNUMBER` varchar(100) NOT NULL,
  `DATEISSUED` date NOT NULL,
  `AMOUNT` double NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `URL` varchar(200) DEFAULT NULL,
  `MDA` varchar(255) NOT NULL,
  `LGA` varchar(255) NOT NULL,
  `ACTIVE` int(11) NOT NULL DEFAULT '0',
  `ORACLENUMBER` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`ID`, `PROJECTID`, `REQID`, `CERTNUMBER`, `DATEISSUED`, `AMOUNT`, `STATUS`, `URL`, `MDA`, `LGA`, `ACTIVE`, `ORACLENUMBER`) VALUES
(1, 'AGHP0001', 'rq111', 'AGHP0001-MOBILISATION', '2017-07-04', 400000, 'paid', NULL, '', '', 0, 'WERTYUIOP12345'),
(2, 'AGHP0002', '', 'AGHP0002-MOBILISATION', '2017-07-04', 1000, 'paid', NULL, '', '', 1, NULL),
(3, 'AGHP0003', 'reqfinal11', 'AGHP0003-MOBILISATION', '2017-07-04', 10000, 'paid', NULL, '', '', 0, NULL),
(4, 'AGOV0004', 'REQ12121', 'AGOV0004-MOBILISATION', '2017-07-04', 1000000, 'paid', NULL, '', '', 0, NULL),
(5, 'AGHP0005', 'endndn', 'AGHP0005-MOBILISATION', '2017-07-10', 10000, 'paid', NULL, '', '', 1, 'ASDFGHJKL123'),
(6, 'AGHP0001', NULL, '123654', '2017-07-18', 12500, 'issued', 'photos/59635807eeac010587Chrysanthemum.jpg', 'Government House and Protocol', 'Egor', 0, NULL),
(7, 'AGHP0001', NULL, 'josbencert', '2017-07-10', 12000, 'paid', 'photos/Lighthouse.jpg', 'Government House and Protocol', 'Egor', 0, 'dfghjklghj45612');

-- --------------------------------------------------------

--
-- Table structure for table `geodata`
--

CREATE TABLE IF NOT EXISTS `geodata` (
  `contractor` varchar(255) DEFAULT NULL,
  `projname` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `geodata`
--

INSERT INTO `geodata` (`contractor`, `projname`, `location`, `lat`, `lng`) VALUES
('Bizmax LTD', 'Upgrade of Central hospital', 'Benin City', '5.9795381', '6.028842'),
('Ray Royal Construction', 'Road Project', 'Ugbor', '6.3247901', '6.00386339'),
('SCC Construction', 'School Project', 'Sabo', '7.038118', '6.113162'),
('Arab Contractors', 'Building Airport', 'Ekpoma', '5.998408', '5.926784'),
('Julius Berger', 'Building Annex', 'Ilah', '6.629249', '6.576590'),
('RCC', 'Palace Renovation', 'Warreke', '5.9795333', '6.100211'),
('Beex and Sons', 'Upgrade of Central hospital', 'Benin City', '5.893195', '5.972119'),
('Ray Royal Construction', 'Road Project', 'Ugbor', '6.338958', '5.644698'),
('SCC Construction', 'School Project', 'Sabo', '6.834353', '6.067827'),
('Julius Berger', 'Hospital Upgrade', 'Urhonigbe', '7.459114', '6.017454'),
('Local Contractor', 'Road Dualization', 'Auchi', '6.579211', '6.581627'),
('Arab Contractors', 'Building Airport', 'Ekpoma', '6.133653', '5.518766'),
('Julius Berger', 'Market Complex', 'Ilah', '6.969373', '5.841151'),
('RCC', 'Community Market Renovation', 'Warreke', '6.559194', '6.032566');

-- --------------------------------------------------------

--
-- Table structure for table `polylines`
--

CREATE TABLE IF NOT EXISTS `polylines` (
  `lat` varchar(8) DEFAULT NULL,
  `lng` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `polylines`
--

INSERT INTO `polylines` (`lat`, `lng`) VALUES
('7.561269', '6.076813'),
('7.57216', '6.030121'),
('7.54221', '6.005402'),
('7.517704', '5.988922'),
('7.506812', '5.966949'),
('7.498643', '5.931244'),
('7.479581', '5.925751'),
('7.457794', '5.923004'),
('7.441454', '5.93399'),
('7.43056', '5.953217'),
('7.411495', '5.953217'),
('7.386982', '5.947723'),
('7.367915', '5.947723'),
('7.346123', '5.95871'),
('7.329778', '5.964203'),
('7.307985', '5.95047'),
('7.280741', '5.936737'),
('7.269843', '5.914764'),
('7.250771', '5.901031'),
('7.228974', '5.879059'),
('7.201726', '5.870819'),
('7.179926', '5.865326'),
('7.149949', '5.85434'),
('7.11452', '5.835114'),
('7.068185', '5.821381'),
('7.054557', '5.802155'),
('7.043653', '5.785675'),
('7.010942', '5.777435'),
('6.980954', '5.769196'),
('6.953691', '5.769196'),
('6.929153', '5.780182'),
('6.907341', '5.785675'),
('6.880073', '5.769196'),
('6.871893', '5.749969'),
('6.852805', '5.744476'),
('6.828261', '5.738983'),
('6.798262', '5.730743'),
('6.773716', '5.722504'),
('6.751896', '5.711517'),
('6.740986', '5.684052'),
('6.735531', '5.659332'),
('6.762806', '5.626373'),
('6.757352', '5.601654'),
('6.732803', '5.582428'),
('6.716437', '5.557709'),
('6.713709', '5.541229'),
('6.803717', '5.511017'),
('6.830988', '5.543976'),
('6.869166', '5.50827'),
('6.871893', '5.458832'),
('6.87462', '5.39566'),
('6.871893', '5.343475'),
('6.871893', '5.310516'),
('6.871893', '5.272064'),
('6.871893', '5.233612'),
('6.871893', '5.200653'),
('6.858259', '5.18692'),
('6.833716', '5.18692'),
('6.811898', '5.17868'),
('6.784626', '5.153961'),
('6.768261', '5.134735'),
('6.749169', '5.115509'),
('6.72462', '5.104523'),
('6.700071', '5.08255'),
('6.648239', '5.079803'),
('6.629142', '5.071564'),
('6.612772', '5.077057'),
('6.590945', '5.09079'),
('6.574575', '5.110016'),
('6.550017', '5.115509'),
('6.525459', '5.123749'),
('6.503628', '5.118256'),
('6.489983', '5.107269'),
('6.465422', '5.096283'),
('6.446318', '5.085297'),
('6.427213', '5.07431'),
('6.405378', '5.071564'),
('6.372624', '5.063324'),
('6.361705', '5.013885'),
('6.342597', '5.002899'),
('6.312569', '4.997406'),
('6.287999', '4.983673'),
('6.266158', '4.989166'),
('6.257967', '5.024872'),
('6.247046', '5.046844'),
('6.222473', '5.049591'),
('6.214282', '5.055084'),
('6.20336', '5.068817'),
('6.197899', '5.093536'),
('6.186977', '5.104523'),
('6.165132', '5.104523'),
('6.143286', '5.115509'),
('6.121439', '5.115509'),
('6.113246', '5.151215'),
('6.105053', '5.170441'),
('6.09686', '5.192413'),
('6.066817', '5.217133'),
('6.034042', '5.225372'),
('5.995802', '5.225372'),
('5.963022', '5.225372'),
('5.932972', '5.225372'),
('5.916581', '5.236359'),
('5.916581', '5.272064'),
('5.946631', '5.30777'),
('6.028579', '5.348969'),
('6.023117', '5.370941'),
('6.014922', '5.387421'),
('6.017654', '5.442352'),
('6.014922', '5.464325'),
('5.998533', '5.489044'),
('5.982144', '5.50827'),
('5.965754', '5.530243'),
('6.020385', '5.565948'),
('6.034042', '5.607147'),
('6.044967', '5.659332'),
('6.036773', '5.681305'),
('6.028579', '5.695038'),
('6.017654', '5.700531'),
('6.001265', '5.72525'),
('5.995802', '5.744476'),
('5.982144', '5.763702'),
('5.97668', '5.788422'),
('5.954827', '5.810394'),
('5.922045', '5.832367'),
('5.911117', '5.851593'),
('5.894725', '5.862579'),
('5.881064', '5.884552'),
('5.870136', '5.898285'),
('5.842813', '5.884552'),
('5.812757', '5.876312'),
('5.793629', '5.873566'),
('5.779966', '5.890045'),
('5.758105', '5.898285'),
('5.741708', '5.895538'),
('5.747174', '5.936737'),
('5.75264', '5.966949'),
('5.755372', '6.002655'),
('5.766303', '6.035614'),
('5.818222', '6.090546'),
('5.856475', '6.131744'),
('5.900189', '6.189423'),
('6.003996', '6.216888'),
('6.034042', '6.181183'),
('6.091398', '6.128998'),
('6.135093', '6.093292'),
('6.236125', '6.076813'),
('6.337137', '6.060333'),
('6.342597', '6.090546'),
('6.326218', '6.145477'),
('6.301649', '6.15097'),
('6.282539', '6.172943'),
('6.271618', '6.194916'),
('6.326218', '6.230621'),
('6.339867', '6.260834'),
('6.367164', '6.302032'),
('6.39446', '6.345978'),
('6.413566', '6.395416'),
('6.432671', '6.447601'),
('6.457234', '6.48056'),
('6.484525', '6.516266'),
('6.492712', '6.551971'),
('6.484525', '6.606903'),
('6.47088', '6.637115'),
('6.517272', '6.667328'),
('6.629142', '6.642609'),
('6.705526', '6.606903'),
('6.825534', '6.612396'),
('6.910067', '6.650848'),
('6.972776', '6.681061'),
('7.076362', '6.672821'),
('7.139048', '6.716766'),
('7.204451', '6.678314'),
('7.275292', '6.626129'),
('7.275292', '6.579437'),
('7.264394', '6.546478'),
('7.248047', '6.513519'),
('7.245322', '6.491547'),
('7.340675', '6.464081'),
('7.384258', '6.378937'),
('7.386982', '6.343231'),
('7.465964', '6.26358'),
('7.455071', '6.225128'),
('7.427837', '6.17569'),
('7.416942', '6.145477'),
('7.449624', '6.104279'),
('7.558547', '6.104279'),
('7.563465', '6.068771');

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE IF NOT EXISTS `progress` (
  `ID` int(11) NOT NULL,
  `PROJECTID` varchar(100) NOT NULL,
  `COMMENTS` varchar(500) NOT NULL,
  `MARKS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projectdetails`
--

CREATE TABLE IF NOT EXISTS `projectdetails` (
  `ID` int(11) NOT NULL,
  `PROJECTID` varchar(100) NOT NULL,
  `REQID` varchar(100) DEFAULT NULL,
  `PROCURINGENTITY` varchar(100) NOT NULL,
  `TITLE` varchar(100) NOT NULL,
  `DESCRIPTION` varchar(500) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `REMARKS` varchar(200) NOT NULL,
  `LOCATION` varchar(200) NOT NULL,
  `LGA` varchar(30) NOT NULL,
  `DATEOFAWARD` date NOT NULL,
  `DURATIONOFCONTRACT` varchar(100) NOT NULL,
  `EXPECTEDCOMPLETIONDATE` date NOT NULL,
  `AGREEDMOBILIZATION` double NOT NULL,
  `CONTRACTSUM` double NOT NULL,
  `CONTRACTOR` varchar(250) NOT NULL,
  `CONSULTANT` varchar(250) NOT NULL,
  `SECTOR` varchar(50) NOT NULL,
  `SUBSECTOR` varchar(100) NOT NULL,
  `ACTIVE` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projectdetails`
--

INSERT INTO `projectdetails` (`ID`, `PROJECTID`, `REQID`, `PROCURINGENTITY`, `TITLE`, `DESCRIPTION`, `STATUS`, `REMARKS`, `LOCATION`, `LGA`, `DATEOFAWARD`, `DURATIONOFCONTRACT`, `EXPECTEDCOMPLETIONDATE`, `AGREEDMOBILIZATION`, `CONTRACTSUM`, `CONTRACTOR`, `CONSULTANT`, `SECTOR`, `SUBSECTOR`, `ACTIVE`) VALUES
(1, 'AGHP0001', 'rq111', 'Government House and Protocol', 'JDJDJJ', 'KDKDKDK ', 'Starting', 'KDKDK', 'KDDKKDKDK', 'Egor', '2017-07-04', '1 Year 3 Months', '2017-07-20', 400000, 120000, 'OAKHART GLOBAL LIMITED', 'RAPH ADEGHE & COMPANY', 'Administration Sector', 'Government House and Protocol', 1),
(2, 'AGHP0002', '', 'Government House and Protocol', 'second one', 'djdjdj', 'Starting', 'dkdk', 'kdkdkd', 'Egor', '2017-07-04', '1 Year 1 Month', '2017-07-04', 1000, 1000000, 'ABSOLUTE FITNESS EQUIPMENT LTD', 'KLINAX SERVICING COMPANY', 'Administration Sector', 'Government House and Protocol', 1),
(3, 'AGHP0003', 'reqfinal11', 'Government House and Protocol', 'kdkd dkdk', 'kdkdkdk dkdk', 'Starting', 'kdkdk', 'kdkdkd dkdk', 'Egor', '2017-07-04', '1 Year 2 Months', '2017-07-04', 10000, 20000, 'ABSOLUTE FITNESS EQUIPMENT LTD', 'RAPH ADEGHE & COMPANY', 'Administration Sector', 'Government House and Protocol', 1),
(4, 'AGOV0004', 'REQ12121', 'Office of the Governor (Deputy Governor''s Office)', 'GOOD PROJECT', ' NO NEW THING SHA', 'Starting', 'GOOD', 'ENWAN', 'Egor', '2017-07-04', '2 Years 4 Months', '2017-07-18', 1000000, 12000000, 'ABSOLUTE FITNESS EQUIPMENT LTD', 'YAHAYA SULE & CO', 'Administration Sector', 'Community Development', 0),
(5, 'AGHP0005', 'endndn', 'Government House and Protocol', 'ndndjjd djdj', 'jdjd djdj ', 'Starting', 'kdjdjdj', 'ndjdjdjdj djdjdjdj', 'Egor', '2017-07-10', '2 Years 4 Months', '2017-07-10', 10000, 12000, 'KINETIC INFRASTRUCTURE NIG LTD', 'BARNKSFORTE GLOBAL LTD', 'Administration Sector', 'Government House and Protocol', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sectors`
--

CREATE TABLE IF NOT EXISTS `sectors` (
  `ID` int(11) NOT NULL,
  `SECTOR` varchar(100) NOT NULL,
  `SUBSECTOR` varchar(200) NOT NULL,
  `CODE` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sectors`
--

INSERT INTO `sectors` (`ID`, `SECTOR`, `SUBSECTOR`, `CODE`) VALUES
(1, 'Administration Sector', 'Office of the Governor (Deputy Governor''s Office)', 'AGOV'),
(2, 'Administration Sector', 'Edo State Public Procurement Agency (EDPPA)', 'APPA'),
(3, 'Administration Sector', 'Office the Secretary to the State Government', 'ASSG'),
(4, 'Administration Sector', 'Directorate of Cabinent', 'ADOC'),
(5, 'Administration Sector', 'Liaison Office Lagos', 'ALOL'),
(6, 'Administration Sector', 'Liaison Office Abuja', 'ALOA'),
(7, 'Administration Sector', 'Edo State Pensions Board', 'AEPB'),
(8, 'Administration Sector', 'Directorate of Central Administration', 'ADCA'),
(9, 'Administration Sector', 'Government House and Protocol', 'AGHP'),
(10, 'Administration Sector', 'Edo State House of Assembly', 'AEHA'),
(11, 'Administration Sector', 'Edo State House of Assembly Service Commission', 'AEHC'),
(12, 'Administration Sector', 'Ministry of Information and Orientation', 'AMIO'),
(13, 'Administration Sector', 'Community Development', 'ASCD'),
(14, 'Administration Sector', 'Office of the Head of Service', 'AHOS'),
(15, 'Administration Sector', 'Ministry of Establishment and Special Duties', 'AESD'),
(16, 'Administration Sector', 'Office of the Auditor-General (State)', 'AAGS'),
(17, 'Administration Sector', 'Office of the Auditor-General (Local Govt)', 'AAGL'),
(18, 'Administration Sector', 'Civil Service Commission', 'ACSC'),
(19, 'Administration Sector', 'Edo State Independent Electoral Commission', 'AIEC'),
(20, 'Administration Sector', 'Ministry of Investment and Public Private Partnership', 'AIPP'),
(21, 'Administration Sector', 'Public Private Partnership - PPP', 'APPP'),
(22, 'Administration Sector', 'Poverty Alleviation Programme', 'APAP'),
(23, 'Economic Sector', 'Ministry of Agriculture', 'EAGR'),
(24, 'Economic Sector', 'Livestock', 'ELIV'),
(25, 'Economic Sector', 'Fisheries', 'EFIS'),
(26, 'Economic Sector', 'Forestry', 'EFOR'),
(27, 'Economic Sector', 'Ministry of Finance', 'EFIN'),
(28, 'Economic Sector', 'Office of Accountant General', 'EOAG'),
(29, 'Economic Sector', 'Board of Internal Revenue (BIR)', 'EBIR'),
(30, 'Economic Sector', 'Edo State Investment Promotion Council', 'EIPC'),
(31, 'Economic Sector', 'Ministry of Commerce and Industry', 'ECOM'),
(32, 'Economic Sector', 'Directorate of Information Technology (ICT) Agency', 'EICT'),
(33, 'Economic Sector', 'Ministry of Transport', 'ETRA'),
(34, 'Economic Sector', 'Ministry of Energy', 'EENE'),
(35, 'Economic Sector', 'Rural Electrification Board', 'EREB'),
(36, 'Economic Sector', 'Edo State Urban Water Board', 'EUWB'),
(37, 'Economic Sector', 'Ministry of Oil and Gas', 'EOAG'),
(38, 'Economic Sector', 'Oil Producing Areas Development Commission', 'EOPA'),
(39, 'Economic Sector', 'Ministry of Works', 'EWRK'),
(40, 'Economic Sector', 'Edo State Rapid Response Agency', 'ERRA'),
(41, 'Economic Sector', 'Ministry of Arts, Culture and Tourism', 'EART'),
(42, 'Economic Sector', 'Ministry of Budget, Planning and Economic Development', 'EBUD'),
(43, 'Economic Sector', 'Other Capital Projects - Government Counterpart Cash Contribution Fund (GCCC)', 'EPRO'),
(44, 'Economic Sector', 'Milleniun Development goals - mdgs', 'EMDG'),
(45, 'Economic Sector', 'Ministry of Housing and Urban Development (Admin Building)', 'EHOU'),
(46, 'Economic Sector', 'Edo state development property authorities', 'EDPA'),
(47, 'Economic Sector', 'Ministry of Land and Survey', 'ELAN'),
(48, 'Law and Justice Sector', 'Edo State Judicial Service Commission', 'LJSC'),
(49, 'Law and Justice Sector', 'Ministry of Justice', 'LJUS'),
(50, 'Law and Justice Sector', 'Law Reform Commission', 'LREF'),
(51, 'Law and Justice Sector', 'High Court of Justice', 'LCOU'),
(52, 'Law and Justice Sector', 'Customary Court of Appeal', 'LCUS'),
(53, 'Social Sector', 'Minstry of Youths and Sports Development', 'SYOU'),
(54, 'Social Sector', 'Minstry of Women Affairs and Social Development', 'SWOM'),
(55, 'Social Sector', 'PHYSICALLY CHALLENGED PERSONS', 'SPCP'),
(56, 'Social Sector', 'Ministry of Secondary, Technical and Tertiary Education', 'SSTT'),
(57, 'Social Sector', 'Ministry of Basic  Education', 'SBAS'),
(58, 'Social Sector', 'Ministry of Health', 'SHEA'),
(59, 'Social Sector', 'Ministry of Environment', 'SENV'),
(60, 'Social Sector', 'Ministry of Local Government and Chieftancy Affairs', 'SLOC'),
(61, 'Social Sector', 'Local Government Service Commission', 'SLGC'),
(1, 'Administration Sector', 'Office of the Governor (Deputy Governor''s Office)', 'AGOV'),
(2, 'Administration Sector', 'Edo State Public Procurement Agency (EDPPA)', 'APPA'),
(3, 'Administration Sector', 'Office the Secretary to the State Government', 'ASSG'),
(4, 'Administration Sector', 'Directorate of Cabinent', 'ADOC'),
(5, 'Administration Sector', 'Liaison Office Lagos', 'ALOL'),
(6, 'Administration Sector', 'Liaison Office Abuja', 'ALOA'),
(7, 'Administration Sector', 'Edo State Pensions Board', 'AEPB'),
(8, 'Administration Sector', 'Directorate of Central Administration', 'ADCA'),
(9, 'Administration Sector', 'Government House and Protocol', 'AGHP'),
(10, 'Administration Sector', 'Edo State House of Assembly', 'AEHA'),
(11, 'Administration Sector', 'Edo State House of Assembly Service Commission', 'AEHC'),
(12, 'Administration Sector', 'Ministry of Information and Orientation', 'AMIO'),
(13, 'Administration Sector', 'Community Development', 'ASCD'),
(14, 'Administration Sector', 'Office of the Head of Service', 'AHOS'),
(15, 'Administration Sector', 'Ministry of Establishment and Special Duties', 'AESD'),
(16, 'Administration Sector', 'Office of the Auditor-General (State)', 'AAGS'),
(17, 'Administration Sector', 'Office of the Auditor-General (Local Govt)', 'AAGL'),
(18, 'Administration Sector', 'Civil Service Commission', 'ACSC'),
(19, 'Administration Sector', 'Edo State Independent Electoral Commission', 'AIEC'),
(20, 'Administration Sector', 'Ministry of Investment and Public Private Partnership', 'AIPP'),
(21, 'Administration Sector', 'Public Private Partnership - PPP', 'APPP'),
(22, 'Administration Sector', 'Poverty Alleviation Programme', 'APAP'),
(23, 'Economic Sector', 'Ministry of Agriculture', 'EAGR'),
(24, 'Economic Sector', 'Livestock', 'ELIV'),
(25, 'Economic Sector', 'Fisheries', 'EFIS'),
(26, 'Economic Sector', 'Forestry', 'EFOR'),
(27, 'Economic Sector', 'Ministry of Finance', 'EFIN'),
(28, 'Economic Sector', 'Office of Accountant General', 'EOAG'),
(29, 'Economic Sector', 'Board of Internal Revenue (BIR)', 'EBIR'),
(30, 'Economic Sector', 'Edo State Investment Promotion Council', 'EIPC'),
(31, 'Economic Sector', 'Ministry of Commerce and Industry', 'ECOM'),
(32, 'Economic Sector', 'Directorate of Information Technology (ICT) Agency', 'EICT'),
(33, 'Economic Sector', 'Ministry of Transport', 'ETRA'),
(34, 'Economic Sector', 'Ministry of Energy', 'EENE'),
(35, 'Economic Sector', 'Rural Electrification Board', 'EREB'),
(36, 'Economic Sector', 'Edo State Urban Water Board', 'EUWB'),
(37, 'Economic Sector', 'Ministry of Oil and Gas', 'EOAG'),
(38, 'Economic Sector', 'Oil Producing Areas Development Commission', 'EOPA'),
(39, 'Economic Sector', 'Ministry of Works', 'EWRK'),
(40, 'Economic Sector', 'Edo State Rapid Response Agency', 'ERRA'),
(41, 'Economic Sector', 'Ministry of Arts, Culture and Tourism', 'EART'),
(42, 'Economic Sector', 'Ministry of Budget, Planning and Economic Development', 'EBUD'),
(43, 'Economic Sector', 'Other Capital Projects - Government Counterpart Cash Contribution Fund (GCCC)', 'EPRO'),
(44, 'Economic Sector', 'Milleniun Development goals - mdgs', 'EMDG'),
(45, 'Economic Sector', 'Ministry of Housing and Urban Development (Admin Building)', 'EHOU'),
(46, 'Economic Sector', 'Edo state development property authorities', 'EDPA'),
(47, 'Economic Sector', 'Ministry of Land and Survey', 'ELAN'),
(48, 'Law and Justice Sector', 'Edo State Judicial Service Commission', 'LJSC'),
(49, 'Law and Justice Sector', 'Ministry of Justice', 'LJUS'),
(50, 'Law and Justice Sector', 'Law Reform Commission', 'LREF'),
(51, 'Law and Justice Sector', 'High Court of Justice', 'LCOU'),
(52, 'Law and Justice Sector', 'Customary Court of Appeal', 'LCUS'),
(53, 'Social Sector', 'Minstry of Youths and Sports Development', 'SYOU'),
(54, 'Social Sector', 'Minstry of Women Affairs and Social Development', 'SWOM'),
(55, 'Social Sector', 'PHYSICALLY CHALLENGED PERSONS', 'SPCP'),
(56, 'Social Sector', 'Ministry of Secondary, Technical and Tertiary Education', 'SSTT'),
(57, 'Social Sector', 'Ministry of Basic  Education', 'SBAS'),
(58, 'Social Sector', 'Ministry of Health', 'SHEA'),
(59, 'Social Sector', 'Ministry of Environment', 'SENV'),
(60, 'Social Sector', 'Ministry of Local Government and Chieftancy Affairs', 'SLOC'),
(61, 'Social Sector', 'Local Government Service Commission', 'SLGC'),
(1, 'Administration Sector', 'Office of the Governor (Deputy Governor''s Office)', 'AGOV'),
(2, 'Administration Sector', 'Edo State Public Procurement Agency (EDPPA)', 'APPA'),
(3, 'Administration Sector', 'Office the Secretary to the State Government', 'ASSG'),
(4, 'Administration Sector', 'Directorate of Cabinent', 'ADOC'),
(5, 'Administration Sector', 'Liaison Office Lagos', 'ALOL'),
(6, 'Administration Sector', 'Liaison Office Abuja', 'ALOA'),
(7, 'Administration Sector', 'Edo State Pensions Board', 'AEPB'),
(8, 'Administration Sector', 'Directorate of Central Administration', 'ADCA'),
(9, 'Administration Sector', 'Government House and Protocol', 'AGHP'),
(10, 'Administration Sector', 'Edo State House of Assembly', 'AEHA'),
(11, 'Administration Sector', 'Edo State House of Assembly Service Commission', 'AEHC'),
(12, 'Administration Sector', 'Ministry of Information and Orientation', 'AMIO'),
(13, 'Administration Sector', 'Community Development', 'ASCD'),
(14, 'Administration Sector', 'Office of the Head of Service', 'AHOS'),
(15, 'Administration Sector', 'Ministry of Establishment and Special Duties', 'AESD'),
(16, 'Administration Sector', 'Office of the Auditor-General (State)', 'AAGS'),
(17, 'Administration Sector', 'Office of the Auditor-General (Local Govt)', 'AAGL'),
(18, 'Administration Sector', 'Civil Service Commission', 'ACSC'),
(19, 'Administration Sector', 'Edo State Independent Electoral Commission', 'AIEC'),
(20, 'Administration Sector', 'Ministry of Investment and Public Private Partnership', 'AIPP'),
(21, 'Administration Sector', 'Public Private Partnership - PPP', 'APPP'),
(22, 'Administration Sector', 'Poverty Alleviation Programme', 'APAP'),
(23, 'Economic Sector', 'Ministry of Agriculture', 'EAGR'),
(24, 'Economic Sector', 'Livestock', 'ELIV'),
(25, 'Economic Sector', 'Fisheries', 'EFIS'),
(26, 'Economic Sector', 'Forestry', 'EFOR'),
(27, 'Economic Sector', 'Ministry of Finance', 'EFIN'),
(28, 'Economic Sector', 'Office of Accountant General', 'EOAG'),
(29, 'Economic Sector', 'Board of Internal Revenue (BIR)', 'EBIR'),
(30, 'Economic Sector', 'Edo State Investment Promotion Council', 'EIPC'),
(31, 'Economic Sector', 'Ministry of Commerce and Industry', 'ECOM'),
(32, 'Economic Sector', 'Directorate of Information Technology (ICT) Agency', 'EICT'),
(33, 'Economic Sector', 'Ministry of Transport', 'ETRA'),
(34, 'Economic Sector', 'Ministry of Energy', 'EENE'),
(35, 'Economic Sector', 'Rural Electrification Board', 'EREB'),
(36, 'Economic Sector', 'Edo State Urban Water Board', 'EUWB'),
(37, 'Economic Sector', 'Ministry of Oil and Gas', 'EOAG'),
(38, 'Economic Sector', 'Oil Producing Areas Development Commission', 'EOPA'),
(39, 'Economic Sector', 'Ministry of Works', 'EWRK'),
(40, 'Economic Sector', 'Edo State Rapid Response Agency', 'ERRA'),
(41, 'Economic Sector', 'Ministry of Arts, Culture and Tourism', 'EART'),
(42, 'Economic Sector', 'Ministry of Budget, Planning and Economic Development', 'EBUD'),
(43, 'Economic Sector', 'Other Capital Projects - Government Counterpart Cash Contribution Fund (GCCC)', 'EPRO'),
(44, 'Economic Sector', 'Milleniun Development goals - mdgs', 'EMDG'),
(45, 'Economic Sector', 'Ministry of Housing and Urban Development (Admin Building)', 'EHOU'),
(46, 'Economic Sector', 'Edo state development property authorities', 'EDPA'),
(47, 'Economic Sector', 'Ministry of Land and Survey', 'ELAN'),
(48, 'Law and Justice Sector', 'Edo State Judicial Service Commission', 'LJSC'),
(49, 'Law and Justice Sector', 'Ministry of Justice', 'LJUS'),
(50, 'Law and Justice Sector', 'Law Reform Commission', 'LREF'),
(51, 'Law and Justice Sector', 'High Court of Justice', 'LCOU'),
(52, 'Law and Justice Sector', 'Customary Court of Appeal', 'LCUS'),
(53, 'Social Sector', 'Minstry of Youths and Sports Development', 'SYOU'),
(54, 'Social Sector', 'Minstry of Women Affairs and Social Development', 'SWOM'),
(55, 'Social Sector', 'PHYSICALLY CHALLENGED PERSONS', 'SPCP'),
(56, 'Social Sector', 'Ministry of Secondary, Technical and Tertiary Education', 'SSTT'),
(57, 'Social Sector', 'Ministry of Basic  Education', 'SBAS'),
(58, 'Social Sector', 'Ministry of Health', 'SHEA'),
(59, 'Social Sector', 'Ministry of Environment', 'SENV'),
(60, 'Social Sector', 'Ministry of Local Government and Chieftancy Affairs', 'SLOC'),
(61, 'Social Sector', 'Local Government Service Commission', 'SLGC');

-- --------------------------------------------------------

--
-- Table structure for table `supervisors`
--

CREATE TABLE IF NOT EXISTS `supervisors` (
  `ID` int(11) NOT NULL,
  `TYPE` varchar(50) NOT NULL,
  `FULLNAME` varchar(100) NOT NULL,
  `ADDRESS` varchar(200) NOT NULL,
  `PHONE` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `SPECIALISATION` varchar(100) NOT NULL,
  `COMPANYNAME` varchar(200) NOT NULL,
  `PHOTO` varchar(200) NOT NULL,
  `CAC` varchar(100) NOT NULL,
  `ACTIVE` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supervisors`
--

INSERT INTO `supervisors` (`ID`, `TYPE`, `FULLNAME`, `ADDRESS`, `PHONE`, `EMAIL`, `SPECIALISATION`, `COMPANYNAME`, `PHOTO`, `CAC`, `ACTIVE`) VALUES
(0, 'Contractor', 'SERGE HATOUM', '73,BOUNDARY ROAD, GRAND FLOOR, GRA, BENIN CITY, EDO STATE.', '09029753989', 'info@kineticinfrastructure.ng', 'CIVIL ENGINEERING', 'KINETIC INFRASTRUCTURE NIG LTD', 'passports/58eb32ccc59df135105252Penguins.jpg', '1384169', 1),
(1, 'Contractor', 'ANDREW OKOLO', '128, AMINU KANO CRESCENT WUSE 2, ABUJA', '08074603646', 'aokolo@aol.com', 'CIVIL/STRUCTURAL ENGINEERING', 'ABSOLUTE FITNESS EQUIPMENT LTD', 'passports/58eb38b077fd9554555269', '985506', 1),
(2, 'Contractor', 'Okpeahior Cyril A.', 'No 1 OKPEAHIOR LANE, OFF DOMINION ROAD, OKO ADP, BENIN CITY', '07031807117', 'okpcyril@gmail.com', 'CIVIL ENGINEERING', 'OAKHART GLOBAL LIMITED', 'passports/58eb49023d41a2034662111', '941043', 1),
(3, 'Contractor', 'Iokesh Kaushik', '1682 SANUSI FAFUNWA ST, 8TH FLOOR, VICTORIA ISLAND, LAGOS STATE', '08153947800', 'iokesh.kaushik@hitech-company.com', 'CIVIL ENGINEERING & CONSTRUCTION', 'HITECH CONSTRUCTION COMPANY LTD', 'passports/58eb5050d1ace1739195103', '113108', 1),
(4, 'Contractor', 'Festus Oriekhi', 'No 47B AIKHIONBARE STREET, GRA, BENIN CITY', '07060799401', 'admin@hartland.org', 'CIVIL ENGINEERING & CONSTRUCTION', 'HARTLAND NIG LTD', 'passports/58eb50ca1f452602329375', '280974', 1),
(5, 'Contractor', 'Linda Eromosele', '73 OGUNU ROAD, WARRI , DELTA STATE', '08132222220', 'info@raycon.net', 'CIVIL ENGINEERING & CONSTRUCTION', 'RAYCON NIG LTD', 'passports/58eb514e206701788256259', '10263', 1),
(6, 'Contractor', 'ERIC EBOZELE', 'KM 3 NPA-DSC EXPRESSWAY EKPAN WARRI , DELTA STATE', '08037906725', 'gladtrico@gmail.com', 'CIVIL ENGINEERING & CONSTRUCTION', 'GLADTRICO INTERNATIONAL LTD', 'passports/58eb5219af1c1396434667', '287891', 1),
(7, 'Contractor', 'EMMA OKOIBHOLE', '2, OFUMWEGBE ST, OFF 1ST EAST CIRCULAR RD, BEHIND USAMA IVORY HOTEL, BENIN CITY.', '+2348039700161', 'glerintlltd1@yahoo.com', 'ELECTRICITY', 'GLER INTERNATIONAL LIMITED', 'passports/58eba6bc9004b1266739018', '776061', 1),
(8, 'Contractor', 'GIDEON EGHOBAMIEN', '1, NOSAKHARE STREET, OFF UPPER MISSION RD, NEW BENIN, BENIN  CITY.\r\n', '08035804596', 'gideoneghobamien@gmail.com', 'SUPPLIER OF GOODS & CONSTRUCTION', 'GIDEON NOSAKHARE ENTERPRISES LTD', 'passports/58ff0eae6fb0e1346967412', 'RC.1126872', 1),
(9, 'Contractor', 'TAWA IDUBOR', '105, AKPAKPAVA STREET, BENIN CITY \r\n', '08068863181', 'beangeloz@yahoo.com', ' PHARMACEUTICAL ', 'FAITH CHEMIST', 'passports/58ff0f9e93021205861278', 'RC.778131', 1),
(11, 'Contractor', 'DUNU DONATUS', '15, WILMER STREET ILUPEJU, LAGOS\r\n', '08025990533', 'maydonpharma@yahoo.com', ' PHARMACEUTICAL ', 'MAYDON PHARMACEUTICAL & CHEMICAL COMPANY LTD', 'passports/58ff10a87946b1412226314', 'RC.258837', 1),
(12, 'Contractor', 'IFEANYI EZEUGO', '24B, COURT ROAD NEAR CENTRAL POLICE STATION AND AREA COMMAND, ONITSHA, ANAMBRA STATE\r\n', '08032385171', 'faithlink2000@yahoo.com', ' PHARMACEUTICAL ', 'ST. LUKES PHARMACEUTICAL LTD', 'passports/58ff116f75fce154952208', 'RC.201922', 1),
(13, 'Contractor', 'UGWU NNAAEMEKA', '4A/4B, MEDICAL ROAD PHASE VI TRANS EKULU, ENUGU STATE\r\n', '08090193888', 'nemelpharma@gmail.com', ' PHARMACEUTICAL ', 'NEMEL PHARMACEUTICAL LTD', 'passports/58ff120d8eddc618501754', 'RC.423705', 1),
(14, 'Contractor', 'IDEMILI OSSY', '3, JAMES WATT ROAD OFF AKPAKPAVA ROAD, BENIN CITY\r\n', '08035648967', 'info@generixglobal.com', ' PHARMACEUTICAL ', 'GENERIX GLOBAL INVESTMENT LTD', 'passports/58ff12e2b9a261338115110', 'RC.441089', 1),
(15, 'Contractor', 'STELLA C. OKOLI', 'PLOT 3C, BLOCK A,  ASWANI MARKET ROAD ISOLO, LAGOS STATE\r\n', '08037582236', 'customerservice@emzorpharma.com', ' PHARMACEUTICAL ', 'EMZOR PHARMACEUTICAL & INDUS. LTD', 'passports/58ff138038373886513966', 'RC.61894', 1),
(16, 'Contractor', 'MOSES C. AZUIKE', '11, FATAI ATERE WAY, MATORI,MUSHIN , LAGOS STATE\r\n', '08024782046', 'mail@uniquepharm.com', ' PHARMACEUTICAL ', 'UNIQUE PHARMACEUTICAL LTD', 'passports/58ff13f5615ed429279674', 'RC.75681', 1),
(17, 'Contractor', 'UNUIGBE ISONAH', '71, IGUN STREET, OFF AGBADO MARKET ROAD, BENIN CITY\r\n', '08135645439', 'admap_uniben@yahoo.com', ' PHARMACEUTICAL ', 'GABISO PHARMACY', 'passports/58ff14abc194b1403509835', 'ED.58525', 1),
(18, 'Contractor', 'EMMANUEL AGBA', 'KM 10, LASU-IGANDO ROAD EGAN TOWN , IGANDO, LAGOS STATE\r\n', '08130460755', 'tyonex@yahoo.com', ' PHARMACEUTICAL ', 'TYONEX NIG. LTD', 'passports/58ff1605be42f1423386242', 'RC.319526', 1),
(19, 'Contractor', 'UZOMA EZEOKE', '14B, JOY AVENUE AJAO ESTATE, LAGOS STATE\r\n', '08065195409', 'magnus@zolonhealthcare.com', ' PHARMACEUTICAL ', 'ZOLON HEALTHCARE LTD', 'passports/58ff16a82caeb368842059', 'RC.783831', 1),
(20, 'Contractor', 'PRINCE CHRISTOPHER NEBE', '1, CRYSTAL GLASS CLOSE AMUNO- ODOFIN, LAGOS STATE\r\n', '08023526222', 'phanatex-industries@yahoo.com', ' PHARMACEUTICAL ', 'PHAMATEX INDUSTRIES LTD', 'passports/58ff1714e185a231064212', 'RC.902848', 1),
(21, 'Contractor', 'FAMOUS OSARIEMEN ODIGIE', '5, HUDSON LANE, OFF AKPAKPAVA STREET, BENIN CITY\r\n', '08036666837', 'anjuwekat@yahoo.com', ' PHARMACEUTICAL ', 'ANJOUS UKU EWEKO AND CO', 'passports/58ff17a0719fe928583199', 'BN.101359', 1),
(22, 'Contractor', 'HUSSEN OSHIOBUGIE', '9, AKPAKPAVA ROAD, BENIN CITY\r\n', '08033062732', 'husstorm@yahoo.com', ' PHARMACEUTICAL ', 'HUSSTORM TECHNOLOGY LTD', 'passports/58ff181f4019b98813478', 'RC.812163', 1),
(23, 'Contractor', 'BHOJWANI SHYAM.B', 'BLOCK A, 7TH FLOOR FLAT A5, EKO COURT COMPLEX, KOFO ABAYOMI STREET, VICTORIA ISLAND, LAGOS STATE\r\n', '08053256665', 'sampharm@hyperie.com', ' PHARMACEUTICAL ', 'SAM PHARMACEUTICAL LTD', 'passports/58ff1c2ca76fb273962828', 'RC.9354', 1),
(24, 'Contractor', 'OISAKEDE OLAJIDE CHRIS', '24, LUCKY WAY IWOGBAN QUARTERS IKPOBA HILL, BENIN CITY', '08184109583', 'drucicare@gmail.com', ' PHARMACEUTICAL ', 'DRUCICARE NIG LTD', 'passports/58ff1ca10b509818085439', 'RC.85501', 1),
(25, 'Contractor', 'LINDA IBOI', '71 SAPELE ROAD, BENIN CITY\r\n', '08037143716', 'fiboi@yahoo.com', ' PHARMACEUTICAL ', 'FLOWELL PHARMA NIG. LTD', 'passports/58ff1d0154abb993846950', 'RC.493915', 1),
(26, 'Contractor', 'ROSE YEUNG', 'PLOT 2 & 4 AMUWO-ODOFIN INDUSTRIAL SCHEME , LAGOS STATE\r\n', '08065924868', 'ybamigbala@yahoo.com', ' PHARMACEUTICAL ', 'ASSENE-LABOREX LTD', 'passports/58ff1db59066d411331107', 'RC.1035819', 1),
(27, 'Contractor', 'ADENIYI OBALOLU OJO', 'IYA-OBA HOUSE, 10 DELE ASHIRU STREET, ILE-AKARI ESTATE, ISOLO, LAGOS STATE\r\n', '08078111500', 'info@merithealthcare.co.ng', ' PHARMACEUTICAL ', 'MERIT HEALTHCARE LTD', 'passports/58ff1e56704c3221635626', 'RC.623566', 1),
(28, 'Contractor', 'MARIAN O. LAWAL', '56, IBB WAY, AKIM, CALABAR, CROSS RIVERS STATE\r\n', '08032247956', 'rabanastores@yahoo.com', ' PHARMACEUTICAL ', 'RABANA PHARMACY LTD', 'passports/58ff1f4a210422084926038', 'RC.157790', 1),
(29, 'Contractor', 'EZIKE THEODORE EMENAM', 'PLOT 3, BILLY WAY OREGUN INDUSTRIAL ESTATE ALAUSA IKEJA, LAGOS STATE\r\n', '08036922870', 'microlabnigeria2010@gmail.com', ' PHARMACEUTICAL ', 'MICRO NOVA PHARMACEUTICAL LTD', 'passports/58ff1fdc0a98b2107003308', 'RC.754487', 1),
(30, 'Contractor', 'JOHN OKPEKE', '2, NYERERE STREET, NARAYI HIGH, KADUNA STATE\r\n', '08034773211', 'tamphar@gmail.com', ' PHARMACEUTICAL ', 'TAMAR AND PHAREZ NIG LTD', 'passports/58ff20778b40a1158777970', 'RC.952046', 1),
(31, 'Contractor', 'KAYODE AJISAFE', 'PLOT 6, OCHENDO HOUSE , GUINNESS ROAD,  OGBA IKEJA, LAGOS STATE\r\n', '08053596236', 'info.nigeria@megawecare.com', ' PHARMACEUTICAL ', 'MEGA LIFESCIENCE NIG LTD', 'passports/58ff215621ee2605970265', 'RC.428337', 1),
(32, 'Contractor', 'FEMI AJAYI', '16B, SEHINDE CALISTO STREET OSHODI, LAGOS STATE\r\n', '08033021938', 'layiabidoye@gmail.com', ' PHARMACEUTICAL ', 'LAIDER INTERNATIONAL(WEST AFRICA) LTD', 'passports/58ff2201a44891591702865', 'RC.279917', 1),
(33, 'Contractor', 'CHIBUIKE AGARUWA', '34/36, ASSOCIATION AVENUE ILUPEJU, LAGOS STATE\r\n', '07013489734', 'info@euromedlimited.com', ' PHARMACEUTICAL ', 'EUROMED LIMITED', 'passports/58ff2265bec10508900359', 'RC.327146', 1),
(34, 'Contractor', 'GEOFREY I. OKEKE', '1, OBA MARKET ROAD, BENIN CITY \r\n', '08023159146', 'gio.supreme@yahoo.com', ' PHARMACEUTICAL ', 'GIO SUPREME PHARM, CO LTD', 'passports/58ff22e2c9e91996251144', 'RC.98233', 1),
(35, 'Contractor', 'GBOTOSO ISAAC OLADIMEJI', '3, AE AKINSANYA STREET ILUPEJU, LAGOS STATE\r\n', '08057626879', 'globalhealthcareng@gmail.com', ' PHARMACEUTICAL ', 'GLOBAL HEALTHCARE LTD', 'passports/58ff235b13fd91115772625', 'RC.322523', 1),
(36, 'Contractor', 'EBUKA Z. OKAFOR', '13B, SUNNY JIGIDE STREET OGUDU, LAGOS STATE\r\n', '08150651200', 'info@vixang.com', ' PHARMACEUTICAL ', 'VIXA PHARM.COMPANY LTD', 'passports/58ff23cdb946f68675305', 'RC.330511', 1),
(37, 'Contractor', 'EMMANUEL UMENWA', '12, ADEWALE CRESENT OFF EWENLA STREET, OSHODI APAPA, LAGOS STATE\r\n', '08129008556', 'geneith@geneithpharm.com', ' PHARMACEUTICAL ', 'GENEITH PHARMACEUTICAL LTD', 'passports/58ff2444b2d762101379470', 'RC.372901', 1),
(38, 'Contractor', 'JOGINDER LALVANI', '372, IKORODU ROAD MARYLAND, LAGOS STATE\r\n', '07013485520', 'therapeutic@yahoo.com', ' PHARMACEUTICAL ', 'THERAPEUTIC LABORATORIES NIG. LTD', 'passports/58ff24c49c620257818485', 'RC.24732', 1),
(39, 'Contractor', 'OSITA IDEMILI', '88, FORESTRY ROAD, BENIN CITY\r\n', '07012123728', 'ossyidemili2007@yahoo.com', ' PHARMACEUTICAL ', 'OSKAJAY NIG LTD', 'passports/58ff2532f3fe2393687123', 'RC.100637', 1),
(40, 'Contractor', 'FELIX OHIWEREI', '268, IKORODU ROAD. OBANIKORO, LAGOS STATE\r\n', '08129841636', 'info@fidson.com', ' PHARMACEUTICAL ', 'FIDSON HEALTHCARE PLC', 'passports/58ff25cf242cb1224781420', 'RC.267435', 1),
(41, 'Contractor', 'CHUKWUKA ANTHONY', '2, OKUNFOLAMI STREET, ANTHONY VILLAGE, LAGOS STATE\r\n', '07066484587', 'anihchristian9@gmail.com', ' PHARMACEUTICAL ', 'SEAGREEN PHARMACEUTICAL LTD', 'passports/58ff268f4dc87747024859', 'RC.870725', 1),
(42, 'Contractor', 'OGBEBOR AISIEN JOE', '188, SAPELE ROAD, BENIN CITY\r\n', '08023399027', 'edopharm09@yahoo.com', ' PHARMACEUTICAL ', 'EDO PHARMACEUTICAL LTD', 'passports/58ff270da9548153483144', 'RC.11806', 1),
(43, 'Consultant', 'CHRIS ORODE', 'J227/256, IKOTA SHOPPING COMPLEX LEKKI LAGOS\n', '08039600517', 'ceo.chartered@yahoo.com', 'ACCOUNTING/AUDIT', 'C.E. ORODE & COMPANY(CHARTERED ACCOUNTANT)', 'passports/58ff2fea185c1869399072', 'RC.929448', 1),
(44, 'Contractor', 'FEMI MATHEW', '6, AKPAKPAVA STREET, BENIN CITY\r\n', '08033238925', 'cmfemi@yahoo.com', 'SUPPLY/CONSTRUCTION', 'STARFEM NIG LTD', 'passports/58ff30a6d009e1532253759', 'RC.823175', 1),
(45, 'Contractor', 'CHUKWEMEKA OKAFOR LIVINUS', '13, DAUDU  OLAWOLE STREET, IFAKO GBAGADA, LAGOS STATE\r\n', '08034932234', 'pharmifovictor@yahoo.com', 'PHARMACEUTICAL', 'AWARD GLOBAL COMPANY LTD', 'passports/58ff3140c37c3529902798', 'RC.470147', 1),
(46, 'Consultant', 'JONATHAN OSHIEGBU IGBINEDION', '18A, UPPER ADESUWA ROAD, GRA BENIN CITY\r\n', '08063891337', 'jigbinedion@yahoo.com', 'LAUNDRY/CLEANING SERVICES', 'KLINAX SERVICING COMPANY', 'passports/58ff324bc535e741094324', 'BN.028807', 1),
(48, 'Consultant', 'ADEDAYO BANKOLE', '5, ATAKPAME STREET, WUSE 2, ABUJA\r\n', '08022222428', 'abe@barnksfortegroup.org', 'INFORMATION TECHNOLOGY SERVICES', 'BARNKSFORTE GLOBAL LTD', 'passports/5900858881b7a1676034640', 'RC.940786', 1),
(49, 'Contractor', 'MARTINS IGBONACHO', '8, OBOKUN STREET, OFF COKAR ROAD, ILUPEJU, LAGOS STATE', '08096588665', 'altinezvisions@yahoo.com', 'PHARMACEUTICAL', 'AL-TINEZ  PHARMACEUTICAL LTD', 'passports/59008653c95501254042012', 'RC.370753', 1),
(50, 'Contractor', 'IFIJEH AUXTEEN', '13, FATAI ATERE WAY, MATORI, LAGOS STATE\r\n', '08057597104', 'anilkumar@wwcvl.com', 'PHARMACEUTICAL', 'WORLDWIDE COMPANY VENTURES LTD', 'passports/590086ea3dbe7254942739', 'RC. 325074', 1),
(51, 'Contractor', 'JOSEPH IKPEA ', '7, LIGARI ROAD, SABON TASHA, KADUNA STATE\r\n', '08033145576', 'abumec@yahoo.com', 'PHARMACEUTICAL', 'ABUMEC PHARMACEUTICAL LTD', 'passports/590087732ea961538544927', 'RC. 130375', 1),
(52, 'Contractor', 'PETER OBADAN', '39, AIGUOBASIMWIN CRESENT, GRA, BENIN CITY\r\n', '08037254195', 'pobadan@gmail.com', 'SUPPLY/CONSTRUCTION', 'GLOPET NIG LIMITED', 'passports/590087fc0d310305630413', 'RC.27900', 1),
(53, 'Contractor', 'DONATUS DOZIE', 'SUITE 2, HILLTOP PLAZA , 13, GWANI STREET, WUSE, ABUJA\r\n', '08033183383', 'dozieanddoziespharm@yahoo.com', 'PHARMACEUTICAL', 'DOZIE & DOZIE PHARMACEUTICAL NIG LTD', 'passports/590088944066a732406670', 'RC.159387', 1),
(54, 'Contractor', 'COLLINS IRIAJEN', '31B, ADEYEMI ADEOYE STREET, BY WASIMI HEALTH CENTER, MARYLAND, LAGOS STATE', '08087041708', 'ochyco@yahoo.com', 'PHARMACEUTICAL', 'KORLYNS PHARMACEUTICAL LTD', 'passports/59008932b6bc91977438436', 'RC.442280', 1),
(55, 'Contractor', 'OSADOLOR OSAGIE', '43, OYEMWEN STREET, BENIN CITY\r\n', '08075993766', 'visitnomagbon@yahoo.com', 'PHARMACEUTICAL', 'NOMAGBON PHARM. LTD', 'passports/59008cdbba5ff43998971', 'RC.78105', 1),
(56, 'Contractor', 'IFEANYI OKOYE', '35, NKWUBOR ROAD, EMENE, ENUGU STATE\r\n', '08063388367', 'info@juhelnigeria.com', 'PHARMACEUTICAL', 'JUHEL NIGERIA LTD', 'passports/59008d73c481b1279173693', 'RC.104648', 1),
(57, 'Contractor', 'AMBROSE B. C. ORJIAKO', '1, HENRY CARR STREET, IKEJA, LAGOS STATE\r\n', '08020555716', 'ancillajeff@yahoo.com', 'PHARMACEUTICAL', 'NEIMETH INTERNATIONAL  PHARM PLC', 'passports/59008e1e529451788852872', 'RC.1557', 1),
(58, 'Contractor', 'AUGUSTINE NZOBIWE', '387, AGEGE MOTOR ROAD, MUSHIN, LAGOS STATE\r\n', '08031392864', 'info@oculuspharma-ng.com', 'PHARMACEUTICAL', 'OCULUS PHARMACARE LTD', 'passports/59008ea598af8895228075', 'RC.322110', 1),
(59, 'Contractor', 'STEVE KISITO OJESEBHOLO', '49, UGBOWO- LAGOS ROAD, BENIN CITY\r\n', '08056245344', 'samisibor777@yahoo.com', 'PHARMACEUTICAL', 'NEW CHANCE INVESTMENTS LTD', 'passports/59008f50c264b893622257', 'RC.346493', 1),
(60, 'Consultant', 'RAPHEAL ADEGHE', '190, USELU- LAGOS ROAD, BENIN CITY\r\n', '08037112764', 'raphadeghe@yahoo.com', 'ACCOUNTING/AUDIT', 'RAPH ADEGHE & COMPANY', 'passports/59008fcb3f6d6118822660', 'BN.041676', 1),
(61, 'Consultant', 'YAHAYA SULE', '5, EGUADASE STREET, OFF AKPAKPAVA STREET, BENIN CITY\r\n', '08052574777', 'yahayasos@yahoo.com', 'ACCOUNTING/AUDIT', 'YAHAYA SULE & CO', 'passports/59009086e2437600178650', 'ED.59447', 1),
(62, 'Contractor', 'OLELE MARGARET', '11A, OSBORNE ROAD, IKOYI, LAGOS STATE\r\n', '08087349347', 'okechukwu.agbo@pfizer.com', 'PHARMACEUTICAL', 'PFIZER SPECIALTIES LTD', 'passports/5900912899b9b1236939369', 'RC.234198', 1),
(63, 'Contractor', 'ANYAEGBULAM UCHENNA', '7, CALABAR STREET, FEGGE, ONITSHA, ANAMBRA STATE\r\n', '08032959204', 'chez.salesteam@gmail.com', 'PHARMACEUTICAL', 'CHEZ RESOURCES PHARM LTD', 'passports/590091da57e66939829154', 'RC. 693451', 1),
(64, 'Consultant', 'CHRISTOPHER AWILI', '8, AKPAKPAVA ROAD, BENIN CITY\r\n', '08035024275', 'chrisawili@yahoo.com', 'CHARTERED ACCOUNTANT', 'CHRIS AWILI & CO (CHARTTERED ACCOUNTANT) ', 'passports/590092966cb24224144561', 'BN. 037943', 1),
(65, 'Contractor', 'SULEMAN YAHAYA', '25, IGBINOBA STREET, OFF OHOVBE ROAD BY AGBOR PARK, IKPOBA HILL, BENIN CITY\r\n', '08033382541', 'emoedu19@gmail.com', 'PHARMACEUTICAL', 'MAHYESSAN NIG ENTERPRISE', 'passports/590093376cbb02002515720', 'BN. 030223', 1),
(66, 'Contractor', 'ABDULRAHMAN MUHHAMED', '8, ORONSAYE STREET, OFF OKHORO ROAD, BENIN CITY\r\n', '08056217439', 'muhammedabdul37@gmail.com', 'CIVIL ENGINEERING CONSTRUCTION', 'ABDUL AHMED ENTERPRISES LTD', 'passports/590094251882f1914703703', 'RC. 721512', 1),
(67, 'Contractor', 'BRAIMAH MOHHAMED', '4, DIO OBASEKI AVENUE, OFF EKENWAN ROAD BENIN CITY\r\n', '08032646096', 'musamuhammed66@gmail.com', 'CIVIL ENGINEERING CONSTRUCTION', 'A. O OHIKHENA & ASSOCIATES NIG LTD', 'passports/590094cb139fc691728703', 'RC. 701695', 1),
(68, 'Contractor', 'JULIUS OGBA', '19, AGBADO STREET, OFF AKPAKPAVA ROAD, BENIN CITY\r\n', '08055651934', 'ogbapress@yahoo.com', 'PRINTING', 'J. OGBA INT LTD ', 'passports/590097bdd4998787468503', 'RC. 1313862', 1),
(69, 'Contractor', 'ABDULRAHMAN MUHHAMED', '2, NOSA AVENUE, OFF REUBEN AGHO, GAPIONA OFF AIRPORT ROAD, BENIN CITY\r\n', '08086803300', 'muhammeddusy@gmail.com', 'CIVIL ENGINEERING CONSTRUCTION', 'REFINED GOLDEN ABM NIG LTD', 'passports/5900991c53c9d1230482649', 'RC. 846213', 1),
(70, 'Contractor', 'IYOKE TEMPLE', '47/49, ABARANJE ROAD, IKOTUN,  LAGOS STATE\r\n', '08060309054', 'beemightytemple@gmail.com', 'MEDICAL EQUIPMENTS', 'BEE MIGHTY G.T LTD', 'passports/590099c0a340e1510120350', 'RC.607917', 1),
(71, 'Consultant', 'MOSES BABAWANDE', '37, FORESTRY ROAD, BENIN CITY\r\n', '08032312910', 'mbabawande@yahoo.com', 'CHARTERED ACCOUNTANT', 'MOSES BABAWANDE & CO (CHATTERED ACCOUNTANT)', 'passports/59009a5982b3c1175205148', 'EK. 313', 1),
(72, 'Contractor', 'BALOGUN SEGUN', '8, IST EAST CIRCULAR ROAD, BENIN CITY\r\n', '08054474060', 'segunbalogun59@yahoo.co.uk', 'PRINTING', 'JOESEG ASSOCIATES', 'passports/59009aeed4b422129305188', '471235', 1),
(73, 'Contractor', 'MORRISON ERIBO', '56b Erie Street, Off Sokpomba Road, Benin City', '08035618856', 'eribo.printers@gmail.com', 'Printing', 'ERIBO PRINTERS LIMITED', 'passports/59009b2ea680d794110464', '', 1),
(74, 'Contractor', 'STEVE OWA', '41, SAPELE ROAD, BENIN CITY\r\n', '08037149031', 'steveowa@yahoo.com', 'CIVIL ENGINEERING CONSTRUCTION', 'ANSTEK NIG LTD', 'passports/5901db8794f231891040809', 'RC. 409878', 1),
(75, 'Contractor', 'EFOSA ERIBO', 'KM 4, BENIN/ SAPELE ROAD, BENIN CITY\r\n', '08023368101', 'efman0000@yahoo.com', 'PRINTING', 'NORA GRAFIX LTD', 'passports/5901dc3d7b83c529077317', 'RC. 1106490', 1),
(76, 'Contractor', 'EZEKIEL AKAEHORNEN', '90, IGUN STREET, BENIN CITY\r\n', '08057431546', 'jacrox@yahoo.com', 'PRINTING', 'JACROX INVESTMENT LTD', 'passports/5901dcdb63ab81304974600', 'RC. 377113', 1),
(77, 'Consultant', 'DANIEL OLOWU', '29, OLOMODE STREET, ALAGOMEJI YABA, LAGOS STATE\r\n', '08033031687', 'danolowu@yahoo.com', 'CHARTERED ACCOUNTANT', 'DANIEL OLOWU & CO (CHATTERED ACCOUNTANT)', 'passports/5901dd90a46a21944967142', 'LAZ. 006240', 1),
(78, 'Contractor', 'AMABETARE BIU', '4, ADJOMO AVENUE, OFF AIRPORT ROAD, UGBORIKOKO WARRI, DELTA STATE \r\n', '08063564659', 'tarebiv@ao1.com', 'MEDICAL EQUIPMENTS', 'TARERE VENTURES LTD', 'passports/5901de2bbb5d81891709674', 'RC. 498373', 1),
(79, 'Contractor', 'GLORIA ERIGBUEM', '14, ESIGIE STREET, BENIN CITY\r\n', '08037271502', 'nnekag67@yahoo.com', 'MEDICAL EQUIPMENTS', 'GLONNEKA COMPANY', 'passports/5901dec19cf1e1152957597', 'BN. 028842', 1),
(80, 'Contractor', 'IKPONMWOSA ENABULELE ', '29, EXOTI STREET, OFF AIRPORT ROAD, BENIN CITY\r\n', '09029099048', 'spiritman.ie@gmail.com', 'PHARMACEUTICAL', 'GREENFIRST NIG VENTURES', 'passports/5901df622f67b15852599', 'ED. 64492', 1),
(81, 'Contractor', 'EDWARD AGHEDO', '4, UWASOTA STREET, BENIN CITY\r\n', '08027111313', 'noemail@gmail.com', 'PRINTING', 'EDDYPACK AND PRINTING LTD', 'passports/5901dfdd4c0891967631317', 'RC. 25930', 1),
(82, 'Contractor', 'OLUSEYE AGBOOLA', '381G, TITILAYO ADEDOYIN OMOLE PHASE 1, IKEJA, LAGOS STATE\r\n', '08038133776', 'dortemagventures@yahoo.com', 'PHARMACEUTICAL & MEDICAL EQUIPMENTS', 'DORTEMAG VENTURES LTD', 'passports/5901e095757611388033695', 'RC. 243757', 1),
(83, 'Contractor', 'AZHINOTO IKPAH', 'SUITE 5B, 17 /19 BOYLE ONIKAN, LAGOS STATE\r\n', '08125107317', 'hesspharma@yahoo.com', 'PHARMACEUTICAL', 'HESSPHARM LTD', 'passports/5901e13e737192129407412', 'RC. 1118762', 1),
(84, 'Consultant', 'WILSON OKORO', '2, ESEZOBO LONGE STREET, OFF FIRST UGBOR ROAD, BENIN CITY\r\n', '08037120532', 'wilsonokoro@yahoo.com', 'CHARTERED ACCOUNTANT', 'OKORO WILSON & CO', 'passports/5901e1b91395c2145197085', 'BN. 000967', 1),
(85, 'Consultant', 'AYO EVANS DIRISU', '25, OSAKUE STREET, OFF AERODROME CLOSE, BENIN CITY\r\n', '08034360864', 'domose01@yahoo.com', 'CHARTERED ACCOUNTANT', 'EVANS DIRISU AND COMPANY(CHARTERED ACCOUNTANT)', 'passports/5901e239ee4201641184490', 'RC. 710057', 1),
(86, 'Consultant', 'ADESOLA ADEWUNMI', 'PLOT 10, ASABI COLE STREET, ALAUSA, LAGOS STATE\r\n', '08038312357', 'soladewumi@yahoo.com', 'CHARTERED ACCOUNTANT', 'ADESOLA ADEWUMI & COMPANY', 'passports/5901e2ed48918681462945', 'LAZ. 058232', 1),
(87, 'Contractor', 'EMMANUEL OBUIKWU', '7, OGBUNABALI ROAD, PORT HARCOURT, RIVERS STATE\r\n', '08033121761', 'info@kerrymancomputers.com', 'TELECOMMMUNICATION EQUIPMENTS', 'KERRYMAN COMPUTERS & COMMUNICATION COMPANY', 'passports/5901e3d673f9c1517276801', 'RC. 470450', 1),
(88, 'Contractor', 'ABEL OLANREWAJU ADELEKE', 'KM 3, ILLAH ROAD, GOVERNMENT HOUSE, ASABA, DELTA STATE\r\n', '07088955505', 'peculiarconsult2009@yahoo.com', 'CIVIL ENGINEERING CONSTRUCTION', 'PERCULIAR ULTIMATE CONCERNS LTD', 'passports/5901e4786922b1627846038', 'RC. 739820', 1),
(89, 'Contractor', 'VINCENT AJEDE ', 'PLOT 11, APAPA- OSHODI EXPRESS WAY, COCONUT BUS STOP, LAGOS STATE\r\n', '08033150399', 'solar-energy2002@yahoo.com', 'SUPPLY & INSTALLATION SOLAR ENERGY', 'SOLAR ENERGY ADVANCED POWER SYSTEM', 'passports/5901e52e135a2289886649', 'RC. 318299', 1),
(90, 'Contractor', 'AMUMEGAL PETER', '116, BENIN AUCHI ROAD, ADUWAWA, BENIN CITY\r\n', '08032247956', 'ayo_olowojoba@yahoo.com', 'STRUCTURAL AND MECHANICAL ENGINEERING', 'PAGIP TECHNICAL COMPANY LIMITED', 'passports/5901e5b47f8cb949996352', 'RC. 600292', 1),
(91, 'Contractor', 'OMOREGIE LAWRENCE', '76, MISSION ROAD, BENIN CITY\r\n', '08086250515', 'kingsartcreations@yahoo.com', 'CIVIL ENGINEERING CONSTRUCTION', 'CZARS GLOBAL CONSTRUCTION COMPANY', 'passports/5901e6228ca8b833402337', 'RC. 1002426', 1),
(92, 'Contractor', 'FATAI DIRISU', '2, HILLARY STREET, OKO GRA, BENIN CITY\r\n', '08033200147', 'dirisufatai@gmail.com', 'CIVIL ENGINEERING CONSTRUCTION', 'FAAKFY NIG LTD', 'passports/5901e691d73eb1257305568', 'RC. 731181', 1),
(93, 'Contractor', 'JOHN IKERODAH', '18B, OSA STREET, OFF OWINA STREET OFF AGHO, EKEHUAN ROAD, BENIN CITY\r\n', '08137582933', 'joyak15@yahoo.com', 'CIVIL ENGINEERING CONSTRUCTION', 'JOYAK JANAIVA NIG LTD', 'passports/5901e72bf09c5682338772', 'RC. 393275', 1),
(94, 'Contractor', 'EMEKA OKECHUKWU', '8, IBIYEMI STREET, OFF ISOLO WAY AJAO ESTATE, ISOLO, LAGOS STATE\r\n', '07068297836', 'oyeka.25leonard@yahoo.com', 'PHARMACEUTICAL', 'MIRAL PHARM LTD', 'passports/5901e7abc147a985593042', 'RC. 987895', 1),
(95, 'Contractor', 'AMARA CHIKWENDU', '29, ADENIYI JONES AVENUE, IKEJA, LAGOS STATE\r\n', '08129937001', 'healthline.ng@gmail.com', 'PHARMACEUTICAL', 'HEALTHLINE LIMITED', 'passports/5901e815e95751480109883', 'RC. 786858', 1),
(96, 'Contractor', 'CORNELIS VINK', '14, CHIVITA AVENUE, ASAO ESTATE, IKEJA, LAGOS STATE\r\n', '08183746243', 'osas_kess4luv@yahoo.com', 'PHARMACEUTICAL', 'CHI PHARMACEUTICAL LTD', 'passports/5901e8867050676530054', 'RC. 300051', 1),
(97, 'Contractor', 'OSEWA SAMSON', '24, ABIMBOLA HOUSE, ABIMBOLA STREET, IYANA ISOLO, LAGOS STATE\r\n', '08033160727', 'hanwant.amora@sunpharma.com', 'PHARMACEUTICAL', 'RANBAXY NIGERIA LTD ', 'passports/5901e990afff61609242435', 'RC. 95102', 1),
(98, 'Contractor', 'HERBERT ODIONYE', '6, YUSUF OYERO STREET, KETU, LAGOS STATE\r\n', '08054872123', 'tricarepharma@yahoo.com', 'PHARMACEUTICAL', 'TRICARE PHARM NIG. LTD', 'passports/5901ea5214116371713362', 'RC. 838511', 1),
(99, 'Contractor', 'DAN-ISAH', '42, EDOKPOLOR FACTORY RODD, AKA JEMILA ROAD, BENIN CITY\r\n', '08023544591', 'isotracnigltd6@gmail.com', 'TELECOMMMUNICATION EQUIPMENTS', 'ISOTRAC NIGERIA LIMITED', 'passports/5901eae06998f1343872421', 'RC. 115567', 1),
(100, 'Contractor', 'OLALEKAN QUADRI', 'LIFE GATE PLAZA OPPOSITE SUIDIT OIL, SOKA BUS STOP, LAGOS -IBADAN EXPRESS WAY, IBADAN, OYO STATE\r\n', '08036082370', 'quadirifumi@gmail.com', 'PRINTING ', 'LIFE GATE PUBLISHING COMPANY LTD', 'passports/5901eb941fd3e609549048', 'RC. 493512', 1),
(101, 'Contractor', 'OSAKUE AGBONTAEN', '194, IKORODU ROAD, PALM-GROVE, LAGOS STATE\r\n', '08023124291', 'ppaaidsltd@yahoo.com', 'PRINTING', 'PRINTING AND PACKAGING AIDS (NIGERIA) LTD', 'passports/5901ec1fca8cd95299632', 'RC. 120316', 1),
(102, 'Contractor', 'ADEBISI ADEBUTU', 'PLOT B , BLOCK 7, INDUSTRIAL CRESENT ILUPEJU, LAGOS STATE\r\n', '08107250631', 'lucien.kancelcounsel@arbicon.ng', 'CIVIL ENGINEERING CONSTRUCTION', 'ARBICO PLC', 'passports/5901eca3b3053208269800', 'RC. 1702', 1),
(103, 'Contractor', 'SYVESTER OBEAHON', '10, MECHANIC ROAD, IKPOBA HILL, BENIN CITY\r\n', '07065476546', 'omoobeahon@yahoo.com', 'PRINTING', 'OMO OBEAHON NIG LTD', 'passports/5901ed0b50caf1226324520', 'RC. 1324814', 1),
(104, 'Contractor', 'ABOU JAOUDE SALIM', '64, NOUAKCHOTI STREET, ZONE 1, ABUJA \r\n', '07032108082', 'info@sagetolimited.com', 'CIVIL ENGINEERING CONSTRUCTION', 'SAGETO LIMITED', 'passports/5901ed87be7c52011640002', 'RC. 197213', 1),
(105, 'Contractor', 'TANIA KHALAF', 'PLOT 527, SHEHU YARADUA WAY, KADO DISTRICT, ABUJA\r\n', '08152525208', 'contact@aknigeria.com', 'CIVIL ENGINEERING CONSTRUCTION', 'A & K CONSTRUCTION LTD', 'passports/5901ee09a2db31406865656', 'RC. 444264', 1),
(106, 'Contractor', 'ADEKUNLE SOLA', '122, BODE THOMAS STREET, SURULERE, LAGOS STATE\r\n', '08034381003', 'sola@tenkingslimited.com', 'CIVIL ENGINEERING CONSTRUCTION', 'TEN KINGS LIMITED', 'passports/5901eebdc04481981803600', 'RC. 370552', 1),
(107, 'Contractor', 'DOLLY IMADE', '57, SARIKI AVENUE, IKEJA, LAGOS STATE\r\n', '08077412481', 'jonosaventures@gmail.com', 'CIVIL ENGINEERING CONSTRUCTION', 'JONOSA VENTURES NIG LTD', 'passports/5901ef4114acc828695646', 'RC. 274780', 1),
(108, 'Contractor', 'IMAD AOUN', '1, OLOFUN PALACE ROAD, IFON, ONDO STATE\r\n', '08035667217', 'serena.nigeria@yahoo.com', 'CIVIL ENGINEERING CONSTRUCTION', 'SERENA ROCK LIMITED', 'passports/5901ef9d767201526895773', 'RC. 716249', 1),
(109, 'Contractor', 'JOY AISOWIEREN', '168, SILUKO ROAD, BENIN CITY\r\n', '07037637861', 'joysoloconstltd@gmail.com', 'CIVIL ENGINEERING CONSTRUCTION', 'JOYSOLO AND GENERAL CONTRACTOR LIMITED', 'passports/5901efefd2a47399945752', 'RC. 922746', 1),
(110, 'Contractor', 'TERNGU GBAA', 'PLOT 016, ATOM KPERA ROAD, MAKURDI, BENUE STATE\r\n', '08035149663', 'aquaprobe2014@gmail.com', 'WATER & MINNING ENGINEERING ', 'AQUA PROBE NIGERIA LIMITED', 'passports/5901f0809d0181831751614', 'RC. 980104', 1),
(111, 'Contractor', 'DR. JOSEPH EBHOHIMEN', '17K CLOSE, OFF 3RD AVENUE GOWON ESTATE, EGBEDA, LAGOS STATE\r\n', '08033410141', 'ebhojoe@yahoo.com', 'MEDICAL EQUIPMENTS', 'AFRIQUE MEDICAL SUPPLIES CO. LTD', 'passports/5901f103749621263438339', 'RC. 271587', 1),
(112, 'Contractor', 'DAVID OGIEVA', '21, NOUAKCHOTT ST. ZONE 1, ABUJA\r\n', '08037869138', 'obesanigerialimited@yahoo.com', 'CIVIL ENGINEERING CONSTRUCTION', 'OBESA NIGERIA LIMITED', 'passports/5901f1528f3892146688235', 'RC. 139870', 1),
(113, 'Contractor', 'IREDIA EDOSOMWA', '4, SALAWE STREET. OFF IHAMA ROAD, GRA, BENIN CITY\r\n', '08038716396', 'noemail@gmail.com', 'CONSTRUCTION ENGINEERING ', 'IREDOS NIGERIA LIMITED', 'passports/5901f1cf782351759839343', 'RC. 412767', 1),
(114, 'Contractor', 'BASHIR MOMOH', 'HOUSE 42, NOUAKCHOTT STREET. ZONE 1, ABUJA\r\n', '08106587288', 'bnegbenebor.banarc@yahoo.com', 'CONSTRUCTION ENGINEERING ', 'BANARC GLOBAL INTEGRATED', 'passports/5901f24f5f360484941860', 'RC. 1009662', 1),
(115, 'Contractor', 'ENUANE CHUKS PETER', '149, JEBBA ROAD, SANGO, ILORIN, KWARA STATE\r\n', '08039293042', 'chukskupen@yahoo.com', 'BUILDING CONSTRUCTION ENGINEERING ', 'KUPEN CONSTRUCTION ENGINEERING CONSULT LIMITED', 'passports/5901f2a168553730126536', 'RC. 483399', 1),
(116, 'Contractor', 'MUHAMMED ALI', '36/38, URUBI STREET, BENIN CITY\r\n', '08035729515', 'muhammedfurnitures@yahoo.com', 'SUPPLY OF FURNITURES', 'MUHAMMED FURNITURE COMPANY LIMITED', 'passports/5901f2f87a57f467941789', 'RC. 459407', 1),
(117, 'Contractor', 'EMMANUEL EZEALLA', '44, MISSION ROAD, BENIN CITY\r\n', '08038204557', 'noemail@gmail.com', 'SUPPLY OF STATIONERIES', 'EMANICK EZEALLA NIGERIA ENTERPRISES', 'passports/5901f38fc4291177285970', 'RC. 661100', 1),
(118, 'Contractor', 'AKAEHORMEN EZEKIEL', '90, IGUN STREET, BENIN CITY\r\n', '08057431546', 'mipeggltd@gmail.com', 'PRINTING AND PUBLISHING', 'MIPEGG GLOBAL RESOURCES LIMITED', 'passports/5901f41ead6731502213149', 'RC.1101446', 1),
(119, 'Contractor', 'ADEYEMI OYINDAMOLA', '5B, OYO CLOSE, PARK VIEW, IKOYI, LAGOS STATE\r\n', '08160084517', 'info@stillearthltd.com', 'CIVIL/ STRUCTURAL ENGINEERING', 'STILL EARTH LTD', 'passports/5901f4bb981c7636922477', 'RC.877035', 1),
(120, 'Contractor', 'AGBONKHESE THOMAS', '73, MURTALA MUHAMMED WAY, BENIN CITY\r\n', '08037789355', 'tomwhiteinvestmentng@gmail.com', 'CIVIL ENGINEERING CONSTRUCTION', 'TOM WHITE INVESTMENT NIG LTD', 'passports/5901f517b4fe01469124258', 'RC.695874', 1),
(121, 'Contractor', 'GILES OMEZI', '21, BOYIE STRRET, LAGOS STATE\r\n', '08079928312', 'gomezi@laterite.co.uk', 'CONSTRUCTION ENGINEERING ', 'STRATA DESIGN AND BUILD LIMITED', 'passports/5901f59809dd7904025375', 'RC.1328785', 1),
(122, 'Contractor', 'MUKESH MEHTA', 'PLOT 122-132, AFPRINT INDUSTRIAL ESTATE, IYANA-ISOLO, LAGOS STATE\r\n', '08056292409', 'info@phillipsnigeria.com', 'PHARMACEUTICAL', 'PHILLIPS PHARMACEUTICAL NIG LTD', 'passports/5901f6c9c357d153330708', 'RC.627835', 1),
(123, 'Contractor', 'BENOY BERRY', '239/241, 3RD FLOOR, IKORODU ROAD, NEAR TOWN PLANNING JUNCTION, ILUPEJI, LAGOS STATE\r\n', '08113138138', 'mn@contecglobal.com', 'INFORMATION TECHNOLOGY SERVICES', 'CONTEC GLOBAL INFOTECH LTD', 'passports/5903336c8b1e0829957139', 'RC. 813003', 1),
(124, 'Contractor', 'BRIGHT EWHAREKUKO', '51, ADENIYI ROAD, SAPELE, DELTA STATE\r\n', '07069839616', 'orotobo@att.net', 'CIVIL ENGINEERING CONSTRUCTION', 'OROTOBO NIG LTD', 'passports/590335183733c1392049647', 'RC. 817528', 1),
(125, 'Consultant', 'BENJAMIN UBIDO', '5, ISREAL LAWANI, OFF COUNTRY HOME ROAD, BENIN CITY\r\n', '08114887594', 'elizaxbleet@gmail.com', 'CIVIL ENGINEERING CONSTRUCTION', 'ELIZAXBLEET NIG. LTD', 'passports/59033894eaf8c501181096', 'RC. 12944060', 1),
(126, 'Contractor', 'CHRIS AKALONU', 'IST FLOOR, OBA MARKET OFFICE COMPLEX, BENIN CITY\r\n', '08074468453', 'chrisndiribe@gmail.com', 'SUPPLY OF STATIONERIES', 'KANNY CHRIS AND COMPANY', 'passports/591d98b92e3e72064070969', ' 794309', 1),
(127, 'Contractor', 'COLLINS OHIZU', '3, MISSION ROAD, BENIN CITY\r\n', '08038951711', 'noemail@gmail.com', 'SUPPLY OF STATIONERIES AND INDUSTRIAL CHEMICALS', 'O. N. COLLINS COMMERCIAL ENTERPRISES', 'passports/591d997e22f0b786940056', '803067', 1),
(128, 'Contractor', 'YOUSUF .M. JAAFAR', 'SUITE 18, BLOCK B LAND, ARK PLAZA, MAITAMA, ABUJA\r\n', '08033056254', 'eaglescientific@yahoo.co.uk', 'LABORATORY EQUIPMENT', 'EAGLE SCIENTIFIC AND LABORATORY EQUIPMENT LIMITED', 'passports/591d9c184bf401910164419', '120252', 1),
(129, 'Contractor', 'OMERE MICHAEL OSAYANDE', '15, EFOMO LANE, OFF SECOND EAST CIRCULAR ROAD, BENIN CITY\r\n', '08037915500', 'omeremike5010@gmail.com', 'PRINTING', 'MICHAEL OLIVE (NIG) ENTERPRISES', 'passports/591d9cdcd2d231983131830', 'BN. 035287', 1),
(130, 'Contractor', 'FRANCIS AYAOSI', '1, INDEPENDENCE STREET, BACK OF 40 EKEHUAN RD OPP GENERAL FILLING STATION, BENIN CITY\r\n', '08033917606', 'ayaosimotors456@gmail.com', 'SUPPLY AND REPAIRS OF VEHICLES', 'AYAOSI MOTORS', 'passports/591d9daea4ab91671562055', 'BN. 031925', 1),
(131, 'Contractor', 'AMEGOR AGUANOMWAN', '95, SILUKO ROAD, BENIN CITY\r\n', '08038222299', 'svekhator43@gamil.com', 'TRADING AND BUILDING CONSTRUCTION', 'A.G-ZION LIMITED', 'passports/591d9f3153630738522842', 'RC. 59981', 1),
(132, 'Contractor', 'OGGAR TAIYE', '22, LUTHER STREET, LAGOS ISLAND, LAGOS STATE\r\n', '08033074823', 'layojat2001@yahoo.com', 'LABORATORY EQUIPMENT', 'LAYO-JAT NIG LIMITED', 'passports/591d9fb82ff361093759314', '418000', 1),
(133, 'Contractor', 'OSAZE OSAKUE', 'PUBLISHING HOUSE, 21, IMAFIDON STREET, OFF URUMWON ROAD, EGOR, BENIN CITY\r\n', '08057860851', 'triuphantinchrist@hotmail.com', 'PRINTING AND SUPPLY OF STATIONARIES', 'TRIUMPHANT PRINTING AND PUBLISHING HOUSE', 'passports/591da0bc0b296822387484', 'BN. 014312', 1),
(134, 'Contractor', 'AKINWOLE TALABI', 'PLOT 1652 SAKA JOJO STREET OFF IDEJO STREET, VICTORIA ISLAND, LAGOS STATE.', '08034553900', 'niyi@strathmore.ng.com', 'TRANSPORT & TRADING', 'STRATHMORE CONULT', 'passports/59229400c3cee126396602', 'BN2258776', 1),
(135, 'Contractor', 'WARRICK OZOR', '20, AKINREMI STREET, ANIFOWOSHE, IKEJA , LAGOS STATE', '08138881504', 'ganicksatl@gmail.com', 'INFORMATION TECHNOLOGY', 'WARRICKS AND GENICKS INTERNATIONAL', 'passports/592294bb22174184642207', '1120150', 1),
(136, 'Contractor', 'EHIOROBO RICHARD ILAWE', '3, DAWSON ROAD, BENIN CITY', '08058773084', 'rawellegacy@yahoo.com', 'PRINTING AND PUBLISHING', 'RAWEL FORTUNE RESOURCES', 'passports/593fc5fb0e3941574172203', 'BN. 032053', 1),
(137, 'Contractor', 'OKPE GABRIEL EMMANUEL', '1, ANKPA ROAD, AGBATU OTUKPA, BENUE STATE\r\n', '08036514993', 'lawrence.onuche@yahoo.com', 'CIVIL ENGINEERING CONSTRUCTION', 'STARDUST CONTRUCTION WORKS LIMITED', 'passports/593fc66d77e56452318615', 'RC. 1366080', 1),
(138, 'Consultant', 'ENGR. JOHNBULLEY IGBRE', '35, OSHUNTOKUN AVENUE, OLD BODIJA, IBADAN, OYO STATE\r\n', '08034097935', 'etteharobenin@yahoo.com', 'CIVIL ENGINEERING CONSTRUCTION', 'ETTEH ARO AND PARTNERS', 'passports/593fc6ee87367686987129', '140152 & IBZ-030850', 1),
(139, 'Contractor', 'SUNNY E. OTUOKPAIKHIAN', '85, MISSION ROAD, BENIN CITY\r\n', '08056127721', 'noemail@gmail.com', 'INFORMATION COMMUNICATION TECHNOLOGY SERVICES', 'ROGI COMMUNICATION LIMITED', 'passports/593fc77a0b7e5711658019', 'RC. 668830', 1),
(140, 'Contractor', 'JOYCE LAWANI ', '11, IYEWARE STREET, OFF UPPER UWA, BENIN CITY\r\n', '08036066712', 'damagzes@yahoo.com', 'CIVIL ENGINEERING CONSTRUCTION', 'HELTOM PROJECTS LIMITED', 'passports/593fc8209b01c250198746', 'RC. 469642', 1),
(141, 'Contractor', 'GANI AUDU', '154B, IKPOBA SLOPE, BENIN CITY\r\n', '08036998829', 'gani4nana@yahoo.com', 'SUPPLIER OF GOODS & EQUIPMENTS', 'SATA MOTORS LIMITED', 'passports/593fc8a4bfd3e1004633079', 'RC. 699984', 1),
(142, 'Contractor', 'ADEYEMI ADEJO GABRIEL', '33, ADA GEORGE ROAD, PORT HARCOURT, RIVERS STATE\r\n', '08069274774', 'emamednyere@yahoo.com', 'CIVIL ENGINEERING CONSTRUCTION', 'EMAMED NIGERIA LIMITED', 'passports/593fc92511f29984495406', 'RC. 249184', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supervisors1`
--

CREATE TABLE IF NOT EXISTS `supervisors1` (
  `ID` int(11) NOT NULL,
  `TYPE` varchar(50) NOT NULL,
  `FULLNAME` varchar(100) NOT NULL,
  `ADDRESS` varchar(200) NOT NULL,
  `PHONE` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `SPECIALISATION` varchar(100) NOT NULL,
  `COMPANYNAME` varchar(200) NOT NULL,
  `PHOTO` varchar(200) NOT NULL,
  `CAC` varchar(100) NOT NULL,
  `ACTIVE` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `supervisors1`
--

INSERT INTO `supervisors1` (`ID`, `TYPE`, `FULLNAME`, `ADDRESS`, `PHONE`, `EMAIL`, `SPECIALISATION`, `COMPANYNAME`, `PHOTO`, `CAC`, `ACTIVE`) VALUES
(0, 'Contractor', 'SERGE HATOUM', '73,BOUNDARY ROAD, GRAND FLOOR, GRA, BENIN CITY, EDO STATE.', '09029753989', 'info@kineticinfrastructure.ng', 'CIVIL ENGINEERING', 'KINETIC INFRASTRUCTION NIG LTD', 'passports/58eb32ccc59df135105252Penguins.jpg', '1384169', 1),
(0, 'Contractor', 'SERGE HATOUM', '73,BOUNDARY ROAD, GRAND FLOOR, GRA, BENIN CITY, EDO STATE.', '09029753989', 'info@kineticinfrastructure.ng', 'CIVIL ENGINEERING', 'KINETIC INFRASTRUCTION NIG LTD', 'passports/58eb32e97037c1923627797Penguins.jpg', '1384169', 1),
(0, 'Contractor', 'SERGE HATOUM', '73,BOUNDARY ROAD, GRAND FLOOR, GRA, BENIN CITY, EDO STATE.', '09029753989', 'info@kineticinfrastructure.ng', 'CIVIL ENGINEERING', 'KINETIC INFRASTRUCTION NIG LTD', 'passports/58eb3330a34d91463643170Penguins.jpg', '1384169', 1),
(0, 'Contractor', 'SERGE HATOUM', '73, BOUNDARY ROAD, GRAND FLOOR, GRA , BENIN CITY', '09029753989', 'info@kineticinfrestructure.ng', 'CIVIL ENGINEERING', 'KINETIC INFRESTRUCTION NIG LTD', 'passports/58eb35bea4155587911146Koala.jpg', '1384169', 1),
(0, 'Contractor', 'ANDREW OKOLO', '128, AMINU KANO CRESCENT WUSE 2, ABUJA', '08074603646', 'noemail@gmail.com', 'CIVIL/STRUCTURAL ENGINEERING', 'ABSOLUTE FITNESS EQUIPMENT LTD', 'passports/58eb38b077fd9554555269', '985506', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL,
  `FIRSTNAME` varchar(100) NOT NULL,
  `OTHERNAMES` varchar(100) NOT NULL,
  `USERNAME` varchar(100) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `USERTYPE` varchar(100) NOT NULL,
  `CODE` varchar(200) NOT NULL,
  `PRIVILEGES` varchar(200) NOT NULL,
  `UID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `FIRSTNAME`, `OTHERNAMES`, `USERNAME`, `PASSWORD`, `USERTYPE`, `CODE`, `PRIVILEGES`, `UID`) VALUES
(0, 'osahon okungbowa', 'dennis', 'o.osahon@edostate.gov.ng', '5f4dcc3b5aa765d61d8327deb882cf99', 'director', 'ac033592669757d498c3b0c64799777b', 'createproject,updateproject,dashboard,updateprogress,supervisors,users,qa,reporting,sysadmin,', 1),
(0, 'Lambert', 'Ugorji', 'l.ugorji@edostate.gov.ng', '5f4dcc3b5aa765d61d8327deb882cf99', 'director', 'f66a3795639d5ab77dd2c77c336176e4', 'dashboard,qa,reporting,', 2),
(0, 'Osazuwa', 'Noruwa', 'osazuwa.noruwa@gmail.com', '1902323180d1a8b9fb37efe2c9abd3e6', 'director', '77c52fd7361ee795f0bba0929caeba01', 'createproject,updateproject,dashboard,supervisors,reporting,', 3),
(0, 'Henry', 'Idogun', 'imogiemhe@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'director', 'a59dabc0e703fa723284d2c1c510e333', 'createproject,updateproject,dashboard,updateprogress,supervisors,users,qa,reporting,sysadmin,', 4),
(0, 'Jimoh', 'Aliu', 'momohjimohaliu5@yahoo.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'staff', '8b6279deae68bc4074531691c40838b0', 'createproject,updateproject,supervisors,', 5),
(0, 'Ndukwe', 'Onugu', 'endy.odoo@gmail.com', '8c8d77114016f7a65a9f5532e7ba1860', 'director', '0b7a25f491b1250923f02f5cd8ccdaaa', 'createproject,updateproject,dashboard,updateprogress,supervisors,users,reporting,sysadmin,', 6),
(0, 'Queen', 'Omigie', 'bamidelequeen@yahoo.com', '5b0e6a7b085757705b21c320d64ebf27', 'staff', 'e61340af3965d2f4d0be2a063f628851', 'createproject,updateproject,supervisors,', 7),
(0, 'Samuel', 'Salami', 'gainsamuel17@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'staff', '13a5dd3826ad2bce9b2b05e4af5fe5e0', 'createproject,updateproject,supervisors,', 8),
(0, 'Dokhare', 'Joseph', 'josephdokhare@gmail.com', '875f26fdb1cecf20ceb4ca028263dec6', 'AGHP', '122654823a3d5e07cd3ccd4349cba2b1', 'dashboard,sysadmin,reporting', 9),
(0, 'Gov. Godwin ', 'Obaseki', 'gov@edostate.ng', '7c6a180b36896a0a8c02787eeafb0e4c', 'governor', 'e541d0a2fdee4064c1b59a9c36a13a41', 'dashboard,reporting,', 10),
(0, 'Tijani', ' ', 'tj@edostate.ng', '7c6a180b36896a0a8c02787eeafb0e4c', 'director', 'bbf6e07ad0619c57f1d1657b53ae659c', 'dashboard,reporting,', 11),
(0, 'JOSEPH', 'LIGHT', 'josephlight@gmail.com', '875f26fdb1cecf20ceb4ca028263dec6', 'APPA', '9668e005ea420e02be3b12221149ff2c', 'createproject,', 12),
(0, 'JOSEPH', 'LIGHT', 'josephlight2@gmail.com', '875f26fdb1cecf20ceb4ca028263dec6', 'APPA', '0e924338d852859e6def6d446ac3ac77', '', 13),
(0, 'josben', 'dokhare', 'josben@gmail.com', '875f26fdb1cecf20ceb4ca028263dec6', 'AEHA', '131423b26d3bdfe9e90494244a66cb26', '', 14),
(0, 'ITOHAN', 'JOSEPH', 'it@gmail.com', '875f26fdb1cecf20ceb4ca028263dec6', 'ALL', '2577f7c73721a0b22570e51903b008b5', '', 15);

-- --------------------------------------------------------

--
-- Table structure for table `variations`
--

CREATE TABLE IF NOT EXISTS `variations` (
  `ID` int(11) NOT NULL,
  `PROJECTID` varchar(100) NOT NULL,
  `DATEISSUED` date NOT NULL,
  `AMOUNT` double NOT NULL,
  `COMMENTS` varchar(500) DEFAULT NULL,
  `MDA` varchar(255) DEFAULT NULL,
  `LGA` varchar(255) DEFAULT NULL,
  `ACTIVE` int(11) NOT NULL DEFAULT '0',
  `URL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `variations`
--

INSERT INTO `variations` (`ID`, `PROJECTID`, `DATEISSUED`, `AMOUNT`, `COMMENTS`, `MDA`, `LGA`, `ACTIVE`, `URL`) VALUES
(1, 'AGHP0001', '2017-07-10', 20000, 'new variation', 'Government House and Protocol', 'Egor', 1, 'variations/59635b2f127f414609Chrysanthemum.jpg'),
(2, 'AGHP0002', '2017-07-10', 50000, 'nill', 'Government House and Protocol', 'Egor', 0, 'variations/59635c01e66d110870Koala.jpg'),
(3, 'AGHP0001', '2017-06-12', 100000, '55000', 'Government House and Protocol', 'Egor', 1, 'variations/59635c2c2142e32520Jellyfish.jpg'),
(4, 'AGHP0001', '2017-07-12', 1000, 'cement', 'Government House and Protocol', 'Egor', 0, 'variations/Lighthouse.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `uniquecert` (`CERTNUMBER`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `projectdetails`
--
ALTER TABLE `projectdetails`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UID`);

--
-- Indexes for table `variations`
--
ALTER TABLE `variations`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_trail`
--
ALTER TABLE `audit_trail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=828;
--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `projectdetails`
--
ALTER TABLE `projectdetails`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `supervisors`
--
ALTER TABLE `supervisors`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=143;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `variations`
--
ALTER TABLE `variations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
