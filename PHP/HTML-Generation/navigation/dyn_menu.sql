-- phpMyAdmin SQL Dump
-- version 3.3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 30, 2010 at 05:04 PM
-- Server version: 5.0.91
-- PHP Version: 5.2.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `finalwebsi_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `dyn_menu`
--

CREATE TABLE IF NOT EXISTS `dyn_menu` (
  `id` int(11) NOT NULL auto_increment,
  `label` varchar(50) NOT NULL default '',
  `link_url` varchar(100) NOT NULL default '#',
  `parent_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `dyn_menu`
--

INSERT INTO `dyn_menu` (`id`, `label`, `link_url`, `parent_id`) VALUES
(1, 'Web Development', '', 0),
(2, 'Content Creation', '', 0),
(3, 'PHP Jobs', '/php_web_development_jobs.php', 1),
(4, 'OSCommerce projects', '/php_web_development_jobs.php', 1),
(5, 'Technical Writing Jobs', '/php_web_development_jobs.php', 2),
(6, 'Forum Posting', '/php_web_development_jobs.php', 2),
(7, 'Design and Artwork', '', 0),
(8, 'Blog Design Projects', '/php_web_development_jobs.php', 7),
(9, 'Freelance Website Design', '/php_web_development_jobs.php', 7),
(10, 'Sales and Marketing', '', 0),
(11, 'Internet Marketing Consulting', '/php_web_development_jobs.php', 10),
(12, 'Leads Generation Services', '/php_web_development_jobs.php', 10);
