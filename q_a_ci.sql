-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 22, 2012 at 03:52 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `q&a_ci`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_answers`
--

CREATE TABLE IF NOT EXISTS `tbl_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ans_parent_id` int(11) NOT NULL,
  `ques_id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `ans_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `tbl_answers`
--

INSERT INTO `tbl_answers` (`id`, `ans_parent_id`, `ques_id`, `answer`, `user_id`, `ans_date`) VALUES
(1, 0, 2, 'This is my answer to question 1111  This is my answer to question 1111 This is my answer to question 1111 This is my answer to question 1111', 24, '2012-11-15'),
(2, 0, 3, ' Posted on 2012-11-15 in category11 by user24 Post your Answer\r\n\r\nThe Answer field is required.\r\nEnter your Answer\r\n\r\nThe Answer field is required.', 24, '2012-11-15'),
(3, 0, 2, 'Add borders and rounded corners to the table.', 24, '2012-11-15'),
(4, 3, 2, 'square border is suitable', 24, '2012-11-15'),
(5, 3, 2, 'Round Borrder is Suitable', 24, '2012-11-17'),
(6, 3, 2, 'Round Borrder is Suitable', 24, '2012-11-17'),
(7, 3, 2, '            Triangle is Suitable', 24, '2012-11-17'),
(8, 2, 3, '   asdfasdfasdfasasdffffffffffffffffffffffffffffffffff         ', 24, '2012-11-17'),
(9, 2, 3, '            adfasdfasdfasdfasdf', 24, '2012-11-17'),
(10, 2, 3, ' 111111111111111111111111111111111111      \n     ', 24, '2012-11-17'),
(11, 0, 3, 'this is test\n', 24, '2012-11-17'),
(12, 11, 3, '       22222222222222222222222222222222\n     ', 24, '2012-11-17'),
(13, 11, 3, '       not 22222222222222222222222222\n     ', 24, '2012-11-17'),
(14, 1, 2, 'first reply to ques1111       \n              ', 24, '2012-11-17'),
(15, 1, 2, 'second Reply 222222222222\n              ', 24, '2012-11-17'),
(20, 0, 16, 'Java technology is a high-level programming and a platform independent language. Java is designed to work in the distributed environment on the Internet. Java has a GUI features that  provides you better "look and feel" over the C++  language, moreover it is easier to use than C++ and works on the concept of object-oriented programming model. Java enable us  to play online games, video, audio, chat with people around the world, Banking Application, view 3D image and Shopping Cart.', 28, '2012-11-21'),
(21, 0, 18, 'Hi, I am just learning about the array/pointer duality in C/C++. I couldn''t help wondering, is there a way to pass an array by value? It seems ... incompatible languages with a common subset), it decays into a pointer to its first ...', 1, '2012-11-21'),
(22, 20, 16, 'ok thank you', 24, '2012-11-21'),
(23, 0, 11, 'yah this is not .net', 24, '2012-11-21'),
(24, 0, 11, 'yes this not .net language', 24, '2012-11-21'),
(26, 20, 16, 'asdfasdf', 24, '2012-11-21'),
(27, 20, 16, 'test', 24, '2012-11-21'),
(28, 0, 16, 'hi this is test ', 27, '2012-11-21'),
(29, 0, 3, 'this is test question', 1, '2012-11-22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) NOT NULL DEFAULT '',
  `cat_image` varchar(255) NOT NULL DEFAULT '',
  `cat_date` date NOT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_name` (`cat_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `cat_name`, `cat_image`, `cat_date`) VALUES
(10, 'Java', '/images/category/876d60bef5f6344c5fc75a146dce1b19.JPG', '2012-11-14'),
(11, 'Php', '/images/category/d41262704e9748663b23ffd67cc3d0d4.png', '2012-11-14'),
(12, 'C++', '/images/category/380f48f5872c66d6412cd86923f81663.png', '2012-11-14'),
(13, 'C', '/images/category/831aacd4a57c3c7b08c2202043ce1650.jpg', '2012-11-14'),
(17, 'test', '/images/category/9a9cb42e75790d5b68fb8661d7ad88da.png', '2012-11-21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ques`
--

CREATE TABLE IF NOT EXISTS `tbl_ques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `ques_status` int(11) NOT NULL,
  `ques_title` text NOT NULL,
  `ques_description` text NOT NULL,
  `ques_views` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ques_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `tbl_ques`
--

INSERT INTO `tbl_ques` (`id`, `cat_id`, `ques_status`, `ques_title`, `ques_description`, `ques_views`, `user_id`, `ques_date`) VALUES
(2, 11, 1, 'question', 'question 1111 asdf asdfas d', 62, 24, '2012-11-15'),
(3, 11, 1, 'question', 'question 1111 asdf asdfas d', 41, 24, '2012-11-15'),
(11, 10, 1, 'this is dot net', 'this is dot netthis is dot netthis is dot net', 12, 24, '2012-11-20'),
(16, 10, 1, 'What are the uses of java?', 'Can any one tell me the uses of Java language ?', 29, 27, '2012-11-21'),
(17, 12, 1, 'What are the uses of C++?', 'Can any one Share some advantages of C++', 1, 27, '2012-11-21'),
(18, 13, 1, 'Using Array values ', 'How to pass  Array values in C language', 3, 27, '2012-11-21'),
(19, 11, 1, 'asdfasdf', 'asdfasdf', 11, 1, '2012-11-22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `user_gender` varchar(100) NOT NULL,
  `user_level` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `user_name`, `user_email`, `user_password`, `user_gender`, `user_level`, `date`) VALUES
(1, 'admin', 'admin@localhost', '21232f297a57a5a743894a0e4a801fc3', 'admin', 5, '2012-11-09'),
(24, 'sam', 'sam@mail.com', '5e8ff9bf55ba3508199d22e984129be6', 'male', 0, '2012-11-11'),
(27, 'parker', 'parker@mail.com', '5e8ff9bf55ba3508199d22e984129be6', 'male', 0, '2012-11-20'),
(28, 'john', 'john@mail.com', '5e8ff9bf55ba3508199d22e984129be6', 'male', 0, '2012-11-20');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
