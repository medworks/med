-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 20, 2013 at 01:21 AM
-- Server version: 5.5.32-31.0
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mediateq_mediateq`
--

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(30) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'Site_Theme_Name', 'default'),
(2, 'About_System', '<p style="direction: rtl; text-align: justify;"><span style="font-size: large;">گروه نرم افزاری مدیاتِک با بهره گیری از متخصصین و مهندسین مجرب و متعهد در زمینه تجارت الکترونیک و فنـاوری اطلاعات مفتخر به پیاده سازی و طراحی وب سایت های داینامیک، پرتال، طراحی سایتهای فروشگاهی و تجارت الکترونیک، طراحی سایتهای مدیریت محتوا، طراحی سایتهای بانک اطلاعاتی، طراحی سایتهای فول فلش و سی دی های مالتی مدیا گردیده و آماده انجام پروژه های شرکت ها، سازمان ها، موسسات و اشخاص می باشد.</span><br /><span style="font-size: large;">مدیاتِک تخصص یافته در ارائه خدمات طراحی وب سایت به صورت حرفه ای در دو گونه تجارت های کوچک و بزرگ می باشد. </span><br /><span style="font-size: large;">همچنین افتخار دارد در طی چندین سال کار و تلاش راه حل های جامعی در زمینه های مختلف از قبیل وب سایتهای فروشگاهی، وب سایتهای مدیریت محتوا و داینامیک، eticket و... را جهت سهولت در انجام کارهای شما و پیشرفت تجارت الکترونیک ارائه کند.</span><br /><span style="font-size: large;">شما می توانید با دیدن نمونه کارهای ما از جمله انواع طراحی وب سایت ها و پرتال های پیاده سازی شده برای شرکتها، سیستم های داینامیک و مدیریت محتوا، طراحی وب سایت های اطلاع رسانی، طراحی وب سایت های خبری، طراحی وب سایت شرکت ها، طراحی وب سایت های شخصی، طراحی وب سایت های تبلیغاتی و آگهی، فروشگاه الکترونیک و غیره آشنا شوید.</span></p>'),
(3, 'Site_Title', 'مدیا تِک'),
(4, 'Site_KeyWords', 'مدیا تک - سی ام اس - مدیریت محتوا - طراحی سایت - میزبانی هاست - ثبت دامین - بازار اینترنتی - CMS - Web design - Host - Domain - EMarketing'),
(5, 'Site_Describtion', 'این سایت بر پایه php طراحی شده است - کاملا responsive میباشد - برای تمامی browser ها بهینه شده است'),
(6, 'Admin_Email', 'admin@mediateq.ir'),
(7, 'News_Email', 'news@mediateq.ir'),
(8, 'Contact_Email', 'info@mediateq.ir'),
(9, 'Max_Page_Number', '5'),
(10, 'Max_Post_Number', '5'),
(11, 'FaceBook_Add', 'facebook.com/Mediateq.ir'),
(12, 'Twitter_Add', 'twitter.com/MediateqCo'),
(13, 'Fax_Number', '7613679'),
(14, 'Address', 'مشهد، سه راه فلسطین، ساختمان 202، طبقه اول، واحد 3'),
(15, 'Rss_Add', 'mediateq.ir'),
(16, 'gpluse_Add', 'youtube.com'),
(17, 'Tell_Number', '7666436');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
