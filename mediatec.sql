-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 26, 2013 at 07:42 AM
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `subject`, `image`, `body`, `ndate`, `userid`, `resource`) VALUES
(1, 'خبر یک', '/media/newspics/خبر یک.png', '<p><span style="font-family: arial, helvetica, sans-serif; font-size: large;">خبر یک... خبر یک... خبر یک... خبر یک... خبر یک... خبر یک... خبر یک... خبر یک... خبر یک... خبر یک... خبر یک... خبر یک... خبر یک... خبر یک... خبر یک... </span></p>', '2013-06-15 19:10:07', 1, 'عصر ایران'),
(2, 'خبر دو', '/media/newspics/خبر دو.png', '<address><span style="font-size: large;">خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... خبر دو... </span></address>', '2013-06-16 19:10:47', 1, 'نارنجی'),
(3, 'خبر سه', '/media/newspics/خبر چهار.png', '<p>خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... خبر سه... </p>', '2013-06-17 19:12:55', 1, 'عصر ایران'),
(4, 'خبر چهار', '/media/newspics/خبر پنج.png', '<p>خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... خبر چهار... </p>', '2013-06-11 19:14:41', 1, 'عصر ایران'),
(5, 'خبر پنج', '/media/newspics/خبر شش.png', '<p><span style="font-size: large;">خبر پنج... خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج...خبر پنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... خبرپنج... </span></p>', '2013-06-17 19:16:17', 1, 'عصر ایران');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(30) NOT NULL,
  `value` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE IF NOT EXISTS `slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(60) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `body` varchar(250) NOT NULL,
  `pos` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `image`, `subject`, `body`, `pos`) VALUES
(1, '/media/slidespics/74ed7f2886aac3dcfae10ef9c0bcc454.jpg', 'اسلاید یک', 'اسلاید یک مربوط به سگ و شغال می باشد.. اسلاید یک مربوط به سگ و شغال می باشد.. اسلاید یک مربوط به سگ و شغال می باشد.. اسلاید یک مربوط به سگ و شغال می باشد.. اسلاید یک مربوط به سگ و شغال می باشد.. اسلاید یک مربوط به سگ و شغال می باشد.. اسلاید یک مربوط ', 3),
(2, '/media/slidespics/bbf02eb7a6975c813440f7eed3eb05a4.jpg', 'اسلاید دو', 'اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده د', 3),
(3, '/media/slidespics/a9374501c8151509d60aec8beea270f6.jpg', 'اسلاید سه', 'اسلاید سه ... اسلاید سه ... اسلاید سه ... اسلاید سه ... اسلاید سه ... اسلاید سه ... اسلاید سه ... اسلاید سه ... اسلاید سه ... اسلاید سه ... اسلاید سه ... اسلاید سه ... اسلاید سه ... اسلاید سه ... اسلاید سه ... اسلاید سه ... اسلاید سه ... اسلاید سه ..', 3),
(4, '/media/slidespics/media.jpg', 'media', 'media................', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `family` varchar(50) NOT NULL,
  `image` varchar(60) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `type` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `family`, `image`, `email`, `username`, `password`, `type`) VALUES
(1, 'مجتبی', 'امجدی', '', 'amjadi.mojtaba@gmail.com', 'moji', '202cb962ac59075b964b07152d234b70', 0),
(2, 'سعید', 'حاتمی', '/media/userspics/.png', 'hatami4510@gmail.com', 'saeid', '4395', 0);

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE IF NOT EXISTS `works` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(50) NOT NULL,
  `image` varchar(60) NOT NULL,
  `body` text NOT NULL,
  `sdate` datetime NOT NULL,
  `fdate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=107 ;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`id`, `subject`, `image`, `body`, `sdate`, `fdate`) VALUES
(100, 'مدیا یک', '/media/workspics/مدیا یک.png', '<p style="direction: rtl;">مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... مدیا یک... </p>', '2013-06-14 14:53:41', '2013-06-15 14:53:41'),
(101, 'مدیا دو', '/media/workspics/مدیا دو.png', '<p style="direction: rtl;">مدیا دو... مدیا دو... مدیا دو... مدیا دو... مدیا دو... مدیا دو... مدیا دو... مدیا دو... مدیا دو... مدیا دو... مدیا دو... مدیا دو... مدیا دو... مدیا دو... مدیا دو... مدیا دو... مدیا دو... مدیا دو... مدیا دو... مدیا دو... مدیا دو... مدیا دو... مدیا دو... مدیا دو... مدیا دو... مدیا دو... مدیا دو... مدیا دو... </p>', '2013-06-15 14:55:45', '2013-06-16 14:55:45'),
(102, 'مدیا سه', '/media/workspics/مدیا سه.png', '<p style="text-align: right;">مدیا سه... <span>مدیا سه... </span><span>مدیا سه... </span><span>مدیا سه... </span><span>مدیا سه... </span><span>مدیا سه... </span><span>مدیا سه... </span><span>مدیا سه... </span><span>مدیا سه... </span><span>مدیا سه... </span><span>مدیا سه... </span><span>مدیا سه... </span><span>مدیا سه... </span><span>مدیا سه... </span><span>مدیا سه... </span><span>مدیا سه... </span><span>مدیا سه... </span><span>مدیا سه... </span><span>مدیا سه... </span><span>مدیا سه... </span><span>مدیا سه... </span><span>مدیا سه... </span><span>مدیا سه... </span><span>مدیا سه... </span><span>مدیا سه... </span><span>مدیا سه... </span></p>', '2013-06-18 15:09:18', '2013-06-19 15:09:18'),
(103, 'مدیا چهار', '/media/workspics/مدیا چهار.png', '<p style="direction: rtl;">مدیا چهار... مدیا چهار... مدیا چهار... مدیا چهار... مدیا چهار... مدیا چهار... مدیا چهار... مدیا چهار... مدیا چهار... مدیا چهار... مدیا چهار... مدیا چهار... مدیا چهار... مدیا چهار... مدیا چهار... مدیا چهار... مدیا چهار... مدیا چهار... مدیا چهار... مدیا چهار... مدیا چهار... مدیا چهار... </p>', '2013-06-11 15:14:16', '2013-06-18 15:14:16'),
(104, 'مدیا پنج', '/media/workspics/مدیا پنج.png', '<p>مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... مدیا پنج... </p>', '2013-06-22 12:55:42', '2013-06-23 12:55:42'),
(106, 'شرکت مدیا', '/media/workspics/شرکت مدیا.jpg', '<h1 style="text-align: right;"><span class="example1" style="font-size: large; font-family: ''comic sans ms'', sans-serif;">201<span style="background-color: #888888;">3-06-</span>1619:<span style="color: #888888;">30:39غعنهفغفغ</span>فغخن</span></h1>', '2013-06-05 21:03:09', '2013-06-30 21:03:09');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
