-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 03, 2013 at 11:26 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mediatec`
--

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) NOT NULL,
  `image` varchar(60) NOT NULL,
  `body` text NOT NULL,
  `ndate` datetime NOT NULL,
  `userid` int(11) NOT NULL,
  `resource` varchar(50) NOT NULL,
  `catname` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `subject`, `image`, `body`, `ndate`, `userid`, `resource`, `catname`) VALUES
(1, 'خبر یک', '/media/newspics/خبر یک.png', '<p><span style="font-family: arial, helvetica, sans-serif; font-size: large;">خبر یک... خبر یک... خبر یک... خبر یک... خبر یک... خبر یک... خبر یک... خبر یک... خبر یک... خبر یک... خبر یک... خبر یک... خبر یک... خبر یک... خبر یک... </span></p>', '2013-06-15 19:10:07', 1, 'عصر ایران', ''),
(2, 'خبر دو', '/media/newspics/خبر دو.png', '<address><span style="font-size: large;">خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... </span></address>', '2013-06-16 19:10:47', 1, 'نارنجی', ''),
(3, 'خبر سه', '/media/newspics/خبر چهار.png', '<p>خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... </p>', '2013-06-17 19:12:55', 1, 'عصر ایران', ''),
(4, 'خبر چهار', '/media/newspics/خبر پنج.png', '<p>خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... </p>', '2013-06-11 19:14:41', 1, 'عصر ایران', ''),
(5, 'خبر پنج', '/media/newspics/خبر شش.png', '<p><span style="font-size: large;">خبر پنج... خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... </span></p>', '2013-06-17 19:16:17', 1, 'عصر ایران', ''),
(6, 'تست 1000', './newspics/slide2.jpg', '<p>hjhjrjy</p>', '2013-07-07 11:43:42', 1, 'امجدی', ''),
(7, 'تست 100', './newspics/slide2.jpg', '<p>fg</p>', '2013-07-07 13:16:19', 1, 'عصر ایران', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
