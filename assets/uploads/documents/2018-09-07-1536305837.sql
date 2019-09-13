-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 23, 2018 at 02:09 AM
-- Server version: 5.5.51-38.2
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `volive_calltrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `calls`
--

CREATE TABLE IF NOT EXISTS `calls` (
  `id` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `type` varchar(50) NOT NULL COMMENT '1=>incoming call, 2=>out going call, 3=>missed call',
  `from_no` varchar(245) NOT NULL,
  `to_no` varchar(245) NOT NULL,
  `calltime` varchar(245) NOT NULL,
  `endtime` varchar(225) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calls`
--

INSERT INTO `calls` (`id`, `user_id`, `type`, `from_no`, `to_no`, `calltime`, `endtime`, `startdate`, `enddate`, `latitude`, `longitude`) VALUES
(4, 4, '3', '351892083719265', '+919951866584', '15:17:55', '15:17:55', '2018-04-11', '2018-04-11', '17.4376127', '78.4532643'),
(6, 4, '2', '9951866584', '855768689898', '18:49:50', '18:49:53', '2018-04-11', '2018-04-11', '17.4375697', '78.491684'),
(7, 4, '2', '351892083719265', '9160411765', '21:02:31', '21:02:42', '2018-04-11', '2018-04-11', '17.43702896', '78.44361574'),
(8, 4, '1', '351892083719265', '+919160411765', '21:03:07', '21:18:56', '2018-04-11', '2018-04-11', '17.43702896', '78.44361574'),
(79, 4, '2', '9951866584', '+917732092850', '12:04:04', '12:04:23', '2018-04-21', '2018-04-21', '17.4376659', '78.4532854');

-- --------------------------------------------------------

--
-- Table structure for table `calls_forward`
--

CREATE TABLE IF NOT EXISTS `calls_forward` (
  `id` int(12) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `forward_no` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(10) NOT NULL COMMENT '0=in active,1=active'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dbbackups`
--

CREATE TABLE IF NOT EXISTS `dbbackups` (
  `id` int(12) NOT NULL,
  `backup_url` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dbbackups`
--

INSERT INTO `dbbackups` (`id`, `backup_url`, `created_at`) VALUES
(9, 'assets/uploads/backup-on-2018-04-23-00-07-53.zip', '2018-04-23 05:07:53'),
(10, 'assets/uploads/backup-on-2018-04-23-00-09-16.zip', '2018-04-23 05:09:16'),
(11, 'assets/uploads/backup-on-2018-04-23-00-09-23.zip', '2018-04-23 05:09:23'),
(12, 'assets/uploads/backup-on-2018-04-27-05-58-29.zip', '2018-04-27 10:58:29');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `from_mail` varchar(245) NOT NULL,
  `to_mail` varchar(245) NOT NULL,
  `body` text NOT NULL,
  `maildate` date NOT NULL,
  `mailtime` time NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=>incomming, 2=>out going'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `user_id`, `from_mail`, `to_mail`, `body`, `maildate`, `mailtime`, `type`) VALUES
(1, 4, 'info@twitter.com', 'limat.bhavani@gmail.com', 'Kiara Ane Nenu, BET, jimmy fallon, thaman S, Vinita jain also Tweeted. 14 Your Highlights avatar Mahesh Babu @urstrulyMahesh Another favourite of mine :) reply 640 retweet 3.8K favorite 15K avatar', '2018-05-20', '18:36:22', 1),
(2, 4, 'limat.bhavani@gmail.com', 'bhavaniksvl@gmail.com', 'The plan is to be there for everything Get a #BackupPlan so that life can go on Max Life Online Term Plan Plus (UIN 104N092V03) A non-linked, non-participating, term insurance plan Your #BackupPlan for', '2018-05-18', '17:54:08', 2),
(3, 2, 'Dev joshi <jdev9898@gmail.com>', 'ceo@doorstepdoctor.com, usclients@doorstepdoctor.com, sai@doorstepdoctor.com, ramyahr@doorstepdoctor.com', '', '2018-05-15', '22:56:00', 2),
(4, 3, 'hr@sensacore.com', 'jdev9898@gmail.com', 'Dear Joshi Siddhi, Your password has been reset. To change your greytHR password, click here or paste the following link into your browser: https://sensacore.greythr.com/v2/forgot-password/8aed9ae0-', '2018-05-17', '14:17:11', 1),
(5, 4, 'info@twitter.com', 'limat.bhavani@gmail.com', 'Nrupal Das, Lt Gen HS Panag(R), Rajkumar Hirani, Pawan Kalyan, AyushmannBhava also Tweeted. 14 Your Highlights avatar jimmy fallon @jimmyfallon It&#39;s never too soon to tell someone that you love', '2018-05-21', '16:58:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `email_forward`
--

CREATE TABLE IF NOT EXISTS `email_forward` (
  `id` int(12) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `email_forward` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(10) NOT NULL COMMENT '0=inactive,1=active	'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_forward`
--

INSERT INTO `email_forward` (`id`, `user_id`, `email_forward`, `created_at`, `status`) VALUES
(1, 1, 'test', '2018-04-17 12:39:35', '');

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE IF NOT EXISTS `keys` (
  `id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `key`, `level`, `ignore_limits`, `date_created`) VALUES
(1, '224455', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `from_no` varchar(245) NOT NULL,
  `to_no` varchar(245) NOT NULL,
  `message` text NOT NULL,
  `latitude` varchar(245) NOT NULL,
  `longitude` varchar(245) NOT NULL,
  `time` time DEFAULT NULL,
  `type` int(11) NOT NULL COMMENT '1=>incoming,2=>out going',
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `from_no`, `to_no`, `message`, `latitude`, `longitude`, `time`, `type`, `date`) VALUES
(1, 4, 'IM-001125', '9951866584', 'Online shopping now made easy on your Kotak Credit Card. Simply opt for OTP (One time Password) that will be sent on your registered mobile number each t', '17.4376484', '78.4532709', '13:05:06', 1, '2018-05-18'),
(2, 4, '9951866584', '09003144956', 'PHONEPE-SMS-VERIFY f6c21b0a6553b2cb5eedd8683946e4ae98b507939614e3251085ad8d7b60181c', '17.4375791', '78.4532444', '13:39:15', 2, '2018-05-19'),
(3, 4, '9951866584', '+919908876706', 'bhavaniksvl@gmail.com', '17.4371895', '78.4533472', '14:12:28', 2, '2018-05-20'),
(4, 4, '+919121601993', '9951866584', 'Recharge cheyi \nAppudu msg peduta ', '17.4376249', '78.4532652', '16:28:16', 1, '2018-05-21'),
(5, 4, '9951866584', '+919121601993', 'Free a kada????????????', '17.4376249', '78.4532652', '16:28:57', 2, '2018-05-22');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `messagetype` text NOT NULL,
  `time` varchar(225) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `date` date NOT NULL,
  `status` varchar(2) NOT NULL COMMENT '1=>active, 2=>in active'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `messagetype`, `time`, `date`, `status`) VALUES
(1, 1, 'You have 1 new notification', '16:22:30', '2018-03-30', '1');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(12) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `type` varchar(50) NOT NULL COMMENT '1=>calls,2=>sms,3=>email,4=>gps,5=>empmgt,6=>emplist,7=>control',
  `is_view` varchar(1) NOT NULL DEFAULT '2' COMMENT '1=active,2=disable'
) ENGINE=InnoDB AUTO_INCREMENT=274 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `user_id`, `type`, `is_view`) VALUES
(2, 1, '0', '1'),
(119, 65, '1', '1'),
(120, 65, '2', '1'),
(121, 66, '4', '1'),
(122, 66, '1', '1'),
(123, 66, '2', '1'),
(124, 66, '3', '1'),
(125, 66, '7', '1'),
(139, 67, '1', '1'),
(140, 67, '2', '1'),
(141, 67, '3', '1'),
(142, 67, '4', '1'),
(143, 67, '5', '1'),
(144, 67, '6', '1'),
(145, 67, '7', '1'),
(184, 70, '4', '1'),
(185, 70, '1', '1'),
(186, 70, '2', '1'),
(187, 70, '3', '1'),
(188, 71, '3', '1'),
(189, 71, '5', '1'),
(190, 71, '6', '1'),
(191, 71, '7', '1'),
(192, 72, '4', '1'),
(193, 72, '3', '1'),
(194, 72, '5', '1'),
(211, 73, '1', '1'),
(212, 73, '2', '1'),
(213, 73, '5', '1'),
(214, 73, '6', '1'),
(215, 73, '7', '1'),
(263, 76, '1', '1'),
(264, 76, '2', '1'),
(265, 76, '3', '1'),
(266, 76, '4', '1'),
(267, 76, '5', '1'),
(268, 5, '4', '1'),
(269, 5, '1', '1'),
(270, 5, '2', '1'),
(271, 5, '3', '1'),
(272, 5, '5', '1'),
(273, 5, '6', '1');

-- --------------------------------------------------------

--
-- Table structure for table `sms_forward`
--

CREATE TABLE IF NOT EXISTS `sms_forward` (
  `id` int(12) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `forward_no` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(10) NOT NULL COMMENT '0=in active,1=active'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

CREATE TABLE IF NOT EXISTS `tracking` (
  `id` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tracking`
--

INSERT INTO `tracking` (`id`, `user_id`, `date`, `time`, `latitude`, `longitude`, `address`) VALUES
(1, 4, '0000-00-00', '2018-05-23 06:23:43', '17.4376149', '78.4532642', '7-1-28/4/4, Park Ave Rd, Leelanagar, Ameerpet, Hyderabad, Telangana 500016, India'),
(2, 3, '2018-04-11', '2018-05-23 06:14:29', '17.4376145', '78.4532642', '7-1-28/4/4, Park Ave Rd, Leelanagar, Ameerpet, Hyderabad, Telangana 500016, India'),
(3, 2, '2018-04-11', '2018-05-23 06:14:33', '17.4376016', '78.4532654', '7-1-28/4/4, Park Ave Rd, Leelanagar, Ameerpet, Hyderabad, Telangana 500016, India'),
(4, 4, '2018-04-11', '2018-05-23 06:14:38', '17.4376016', '78.4532654', '7-1-28/4/4, Park Ave Rd, Leelanagar, Ameerpet, Hyderabad, Telangana 500016, India'),
(5, 4, '2018-04-11', '2018-05-23 06:14:42', '17.4376761', '78.4532522', '7-1-28/4/4, Park Ave Rd, Leelanagar, Ameerpet, Hyderabad, Telangana 500016, India'),
(6, 5, '2018-04-11', '2018-05-23 06:14:46', '17.4375982', '78.4532624', '7-1-28/4/4, Park Ave Rd, Leelanagar, Ameerpet, Hyderabad, Telangana 500016, India');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) unsigned NOT NULL,
  `emp_number` varchar(100) NOT NULL,
  `emp_name` varchar(500) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `mobile_verify` int(1) NOT NULL DEFAULT '0',
  `image` varchar(500) NOT NULL,
  `auth_level` tinyint(3) unsigned NOT NULL COMMENT '9=>admin, 1=> user, 6=> sub admin',
  `status` varchar(10) NOT NULL DEFAULT '0' COMMENT '0=in active,1=active',
  `passwd` varchar(60) NOT NULL,
  `passwd_recovery_code` varchar(60) DEFAULT NULL,
  `passwd_recovery_date` datetime DEFAULT NULL,
  `passwd_modified_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `device` varchar(20) NOT NULL,
  `token` varchar(500) NOT NULL,
  `is_gps` int(1) NOT NULL DEFAULT '1' COMMENT '0=disabled,1=active',
  `is_call` int(1) NOT NULL DEFAULT '1' COMMENT '0=disabled,1=active',
  `is_sms` int(1) NOT NULL DEFAULT '1' COMMENT '0=disabled,1=active',
  `is_email` int(1) DEFAULT '1' COMMENT '0=disabled,1=active',
  `type_of_user` varchar(50) NOT NULL COMMENT 'admin, user, sub admin',
  `emp_position` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `emp_number`, `emp_name`, `email`, `mobile`, `mobile_verify`, `image`, `auth_level`, `status`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `device`, `token`, `is_gps`, `is_call`, `is_sms`, `is_email`, `type_of_user`, `emp_position`) VALUES
(1, 'CIS000300', 'admin', 'admin@yopmail.com', '+9669632587410', 0, '9a6546d6b2b3e71fb18c076fdbb36862.jpg', 9, '1', 'QWRtaW5AMTIz', NULL, NULL, NULL, '2018-04-10 07:08:03', '2018-03-14 10:23:26', 'android', 'dsfvdg', 1, 1, 1, 1, 'admin', ''),
(2, 'DSLKFF234324', 'codehumna', 'codehumna@gmail.com', '9553306672', 0, 'a8d16e862d0ca4cc8f3581f28a69e640.jpg', 1, '1', 'RW1wQDEyMw==', NULL, NULL, NULL, '2018-04-21 01:29:05', '2018-04-12 02:33:48', 'android', 'dsfvdg', 1, 1, 1, 1, 'user', 'DSFS'),
(3, '4357049', 'STAFF CONNECT', 'staff@gmail.com', '9553306678', 0, 'd723cbc0e78c1db33734a3bbc06cd746.jpg', 1, '1', 'RW1wQDEyMw==', NULL, NULL, NULL, '2018-04-12 05:43:16', '2018-04-12 05:39:35', 'android', 'dtaSavX7h3w:APA91bG9tkF6k_LxC5dbHpqvEYBBYEDTadMn2m2Csu23V4pXRjwkgOt-dIwrRmw9ZifBMeBclNbHkK1LRPtnHtTvZcnvHUgL5gi0xRcN0DjSncVXy08pxpcC8TzBy8tmE25vpHY0XzBP', 1, 1, 1, 1, 'user', 'CTO'),
(4, 'Volive123', 'Arush', 'arush@gmail.com', '7732092850', 0, 'butterfly_-_Copy_(2).jpg', 1, '1', 'RW1wQDEyMw==', NULL, NULL, NULL, NULL, '2018-05-04 01:50:44', '', '', 1, 1, 1, 1, 'user', 'TL'),
(5, '123456', 'Ayesha', 'ayesha@gmail.com', '7894561230', 0, 'assets/uploads/admin/e712638fab2a7bcf1d06966241202b1c.jpg', 6, '1', 'QWRtaW4jMTIz', NULL, NULL, NULL, NULL, '2018-05-23 00:50:37', '', '', 1, 1, 1, 1, 'subadmin', 'Developer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calls`
--
ALTER TABLE `calls`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `calls_forward`
--
ALTER TABLE `calls_forward`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `dbbackups`
--
ALTER TABLE `dbbackups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `email_forward`
--
ALTER TABLE `email_forward`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sms_forward`
--
ALTER TABLE `sms_forward`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tracking`
--
ALTER TABLE `tracking`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `mobile` (`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calls`
--
ALTER TABLE `calls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT for table `calls_forward`
--
ALTER TABLE `calls_forward`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `dbbackups`
--
ALTER TABLE `dbbackups`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `email_forward`
--
ALTER TABLE `email_forward`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=274;
--
-- AUTO_INCREMENT for table `sms_forward`
--
ALTER TABLE `sms_forward`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tracking`
--
ALTER TABLE `tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `calls_forward`
--
ALTER TABLE `calls_forward`
ADD CONSTRAINT `calls_forward_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `email_forward`
--
ALTER TABLE `email_forward`
ADD CONSTRAINT `email_forward_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sms_forward`
--
ALTER TABLE `sms_forward`
ADD CONSTRAINT `sms_forward_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
