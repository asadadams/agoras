-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 16, 2016 at 01:25 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `agoras_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `agoras_frorums`
--

CREATE TABLE IF NOT EXISTS `agoras_frorums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_name` varchar(40) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `agoras_frorums`
--

INSERT INTO `agoras_frorums` (`id`, `forum_name`, `description`) VALUES
(1, 'KNUST', 'Discuss what is happening on #KNUST Campus'),
(2, 'UG', 'Discuss what is happening on #UG(Legon) Campus'),
(3, 'Music', 'All about music '),
(4, 'Fashion', 'All about fashion'),
(5, 'Movies', 'All about movies'),
(6, 'Maths', 'Maths discussions '),
(7, 'Science ', 'Science discussions '),
(8, 'General ', 'ANYTHING'),
(9, 'Television ', 'All about television shows'),
(10, 'Sports', 'Everything about sports here');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_post` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` datetime NOT NULL,
  `notification` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `follow_agoras`
--

CREATE TABLE IF NOT EXISTS `follow_agoras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `forum_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `follow_customforums`
--

CREATE TABLE IF NOT EXISTS `follow_customforums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `forum_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `follow_users`
--

CREATE TABLE IF NOT EXISTS `follow_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `notification` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL,
  `read_val` int(11) NOT NULL,
  `deletedby_sender` int(11) NOT NULL,
  `deletedby_receiver` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `username` varchar(90) NOT NULL,
  `title` varchar(90) NOT NULL,
  `text` text NOT NULL,
  `forum` varchar(90) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE IF NOT EXISTS `userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `profile_pic` text NOT NULL,
  `bio` text NOT NULL,
  `location` varchar(80) NOT NULL,
  `twitter` varchar(80) NOT NULL,
  `facebook` varchar(80) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `website` varchar(80) NOT NULL,
  `interested` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`id`, `user_id`, `profile_pic`, `bio`, `location`, `twitter`, `facebook`, `mobile`, `website`, `interested`) VALUES
(1, 1, 'kudAqiO94e/Twitter54c7910_jpg.jpg', 'My name is Asad Adams and the co-founder and C.E.O of a startup computer firm, Softvision Inc. I am also a programmer and head of the engineering team at Softvision Inc. I know HTML5, CSS3, Javascript, Jquery, PHP , a little bit of Java and android development. You can follow me on twitter', 'Kumasi', 'asadadams', 'asadadams', '0242928745', 'www.mediaplaygh.com', 'JQuery,VisualBasic,Java FX,Electronics');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(90) NOT NULL,
  `date` date NOT NULL,
  `hashkey` varchar(60) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `date`, `hashkey`, `status`) VALUES
(1, 'asadadams', 'clarkpeace.adams@gmail.com', '324925db8934e011b19bae0a5947aa1b', '2016-02-14', '5277144b27ee457960f64ad927e54654', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_forums`
--

CREATE TABLE IF NOT EXISTS `user_forums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` int(11) NOT NULL,
  `forum_name` varchar(40) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
