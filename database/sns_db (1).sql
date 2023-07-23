-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2023 at 09:57 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sns_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkhand_list`
--

CREATE TABLE `checkhand_list` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `slected` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `coin_list`
--

CREATE TABLE `coin_list` (
  `id` int(30) NOT NULL,
  `sender_id` int(30) NOT NULL,
  `receiver_id` int(30) NOT NULL,
  `post_id` int(30) NOT NULL,
  `coins_exchanged` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deadline` datetime DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'available' CHECK (`status` in ('available','not available','completed'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comment_list`
--

CREATE TABLE `comment_list` (
  `id` int(30) NOT NULL,
  `post_id` int(30) NOT NULL,
  `member_id` int(30) NOT NULL,
  `message` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment_list`
--

INSERT INTO `comment_list` (`id`, `post_id`, `member_id`, `message`, `date_created`, `date_updated`) VALUES
(2, 2, 1, 'Sample 101', '2022-05-03 13:57:13', '2022-05-03 13:57:13'),
(3, 2, 1, '123', '2022-05-03 13:58:12', '2022-05-03 13:58:12'),
(6, 2, 1, 'Comment 123', '2022-05-03 13:58:56', '2022-05-03 13:58:56'),
(10, 1, 2, 'test comment', '2022-05-03 14:29:03', '2022-05-03 14:29:03'),
(11, 11, 1, 'Master pieace', '2022-05-03 15:35:51', '2022-05-03 15:35:51'),
(12, 11, 4, 'nice', '2023-07-14 20:27:23', '2023-07-14 20:27:23');

-- --------------------------------------------------------

--
-- Table structure for table `like_list`
--

CREATE TABLE `like_list` (
  `post_id` int(30) NOT NULL,
  `member_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `like_list`
--

INSERT INTO `like_list` (`post_id`, `member_id`) VALUES
(2, 1),
(2, 2),
(1, 2),
(3, 1),
(11, 4),
(2, 4),
(1, 3),
(29, 8),
(28, 8),
(27, 8);

-- --------------------------------------------------------

--
-- Table structure for table `member_list`
--

CREATE TABLE `member_list` (
  `id` int(30) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=Pending, 1=Approved, 2 = Denied, 3=Blocked',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `coin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member_list`
--

INSERT INTO `member_list` (`id`, `firstname`, `middlename`, `lastname`, `email`, `password`, `avatar`, `status`, `date_created`, `date_updated`, `coin`) VALUES
(1, 'Mark', 'D', 'Cooper', 'mcooper@sample.com', 'c7162ff89c647f444fcaa5c635dac8c3', 'uploads/member/1.png?v=1651542663', 0, '2022-05-03 09:51:03', '2023-07-20 21:12:05', 1),
(2, 'Claire', 'D', 'Blake', 'cblake@sample.com', '4744ddea876b11dcb1d169fadf494418', 'uploads/member/2.png?v=1651559268', 0, '2022-05-03 14:27:48', '2023-07-20 21:12:11', 2),
(3, 'ZINEB', NULL, 'CHAFIKI', 'zinebchafiki7@gmail.com', 'ZEY123', NULL, 0, '2023-07-14 18:21:38', '2023-07-20 21:12:14', 3),
(4, 'ZINEB', '', 'CHAFIKI', 'zinebchafiki1@gmail.com', 'cfdbd131c899b6347a8262e79061cdc0', NULL, 0, '2023-07-14 20:26:41', '2023-07-14 20:26:41', 0),
(5, 'test', '', 'zey', 'test@gmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', NULL, 0, '2023-07-16 22:13:04', '2023-07-20 21:12:25', 5),
(6, 'test1', '', 'zey1', 'test1@gmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', NULL, 0, '2023-07-16 22:15:17', '2023-07-16 22:15:17', 0),
(7, 'test3', '', 'test3', 'test3@gmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'uploads/member/7.png?v=1689542837', 0, '2023-07-16 22:27:17', '2023-07-16 22:27:17', 0),
(8, 'xfg', 'sd', 'dfg', 'admin2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'uploads/member/8.png?v=1689927353', 0, '2023-07-21 10:15:53', '2023-07-21 10:15:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `member_meta`
--

CREATE TABLE `member_meta` (
  `member_id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `options_list`
--

CREATE TABLE `options_list` (
  `id` int(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `coin_value` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `options_list`
--

INSERT INTO `options_list` (`id`, `name`, `coin_value`) VALUES
(1, 'CAR', 100),
(2, 'MOTOCYCLE', 120);

-- --------------------------------------------------------

--
-- Table structure for table `post_list`
--

CREATE TABLE `post_list` (
  `id` int(30) NOT NULL,
  `member_id` int(30) NOT NULL,
  `caption` text NOT NULL,
  `upload_path` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `coin_value` int(30) NOT NULL DEFAULT 0,
  `tag` text DEFAULT NULL,
  `options` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=Pending, 1=Approved, 2=Denied, 3=Blocked'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post_list`
--

INSERT INTO `post_list` (`id`, `member_id`, `caption`, `upload_path`, `date_created`, `date_updated`, `coin_value`, `tag`, `options`, `status`) VALUES
(1, 1, 'Sample Post 101', 'uploads/posts/202205030001/', '2022-05-03 11:13:02', '2023-07-16 19:01:34', 100, NULL, NULL, 0),
(2, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras laoreet accumsan sem, vel egestas diam eleifend sit amet. Praesent egestas ullamcorper nunc. \r\n\r\nMaecenas nibh diam, porta vitae pulvinar a, vulputate at turpis. Vivamus dui lectus, hendrerit vel augue nec, porta maximus mi. Integer tincidunt maximus dictum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aliquam id maximus erat.', 'uploads/posts/202205030002/', '2022-05-03 11:56:51', '2023-07-16 19:01:37', 200, NULL, NULL, 0),
(3, 2, 'Vestibulum nibh enim, porttitor lobortis sapien in, lacinia mollis nisi. Fusce aliquam magna sed ullamcorper faucibus. Ut fermentum sem ultrices mattis dictum. Aliquam erat volutpat. Sed varius erat non porttitor tristique. Fusce non ornare turpis. Nulla lacinia eleifend nulla quis tristique. Nulla quis mollis augue, eget convallis felis. Sed porttitor, leo a varius scelerisque, metus enim sodales lorem, ac convallis diam quam ac sem. Nulla consequat aliquam egestas. Nullam turpis turpis, tempor vitae ligula vitae, interdum consequat enim.', 'uploads/posts/202205030003/', '2022-05-03 14:29:41', '2023-07-16 19:01:40', 300, NULL, NULL, 0),
(11, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc aliquam enim eget rutrum elementum. Aliquam pretium urna eu massa tempus, in tempus felis efficitur. Integer ex tellus, porta at nisi et, auctor tempor nisi. Proin pulvinar ac tortor blandit tempor. Suspendisse ut aliquam felis. Morbi eleifend egestas rhoncus. Integer eu velit ullamcorper nisl dignissim commodo vel et sapien. Vestibulum ultricies ligula quis congue faucibus. Cras vitae aliquet mauris. Nunc vitae magna ut eros pulvinar rhoncus nec et justo. Morbi id magna sit amet sem fermentum laoreet. Duis condimentum ante non fermentum feugiat.', 'uploads/posts/202205030006/', '2022-05-03 15:35:36', '2023-07-16 19:01:44', 150, NULL, NULL, 0),
(21, 8, 'ttt', 'uploads/posts/202307210010/', '2023-07-21 23:02:49', '2023-07-21 23:02:49', 66, 'der', ',', 0),
(22, 8, 'rrr', 'uploads/posts/202307210011/', '2023-07-21 23:05:27', '2023-07-21 23:05:27', 99, 'fghfgh;5455', ',', 0),
(23, 8, 'sdsd', 'uploads/posts/202307210012/', '2023-07-21 23:09:33', '2023-07-21 23:09:33', 88, '999', ';', 0),
(24, 8, 'ert', 'uploads/posts/202307210013/', '2023-07-21 23:10:29', '2023-07-21 23:10:29', 99, '78', 'options_list;', 0),
(25, 8, 'ii', 'uploads/posts/202307210014/', '2023-07-21 23:12:04', '2023-07-21 23:12:04', 22, '45', '', 0),
(26, 8, '88', 'uploads/posts/202307210015/', '2023-07-21 23:13:24', '2023-07-21 23:13:24', 9, '55', '1options_list1;2options_list2;', 0),
(27, 8, 'tyt', 'uploads/posts/202307210016/', '2023-07-21 23:14:27', '2023-07-21 23:14:27', 8, '7587', '1;', 0),
(28, 8, 'tt', 'uploads/posts/202307210017/', '2023-07-21 23:14:53', '2023-07-21 23:14:53', 88, '66', '1;2;', 0),
(29, 8, 'te', 'uploads/posts/202307230001/', '2023-07-23 21:02:25', '2023-07-23 21:02:25', 220, 'sf', '1;2;', 0);

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Simple Social Networking Site'),
(6, 'short_name', 'InstaMage - PHP'),
(11, 'logo', 'uploads/logo.png?v=1651540223'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover.png?v=1651540931');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', NULL, 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatars/1.png?v=1649834664', NULL, 1, '2021-01-20 14:02:37', '2022-04-13 15:24:24'),
(3, 'John', NULL, 'Smith', 'jsmith', '1254737c076cf867dc53d60a0364f38e', 'uploads/avatars/3.png?v=1650527149', NULL, 2, '2022-04-21 15:45:49', '2022-04-21 15:46:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkhand_list`
--
ALTER TABLE `checkhand_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coin_list`
--
ALTER TABLE `coin_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `comment_list`
--
ALTER TABLE `comment_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `like_list`
--
ALTER TABLE `like_list`
  ADD KEY `post_id` (`post_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `member_list`
--
ALTER TABLE `member_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_meta`
--
ALTER TABLE `member_meta`
  ADD KEY `individual_id` (`member_id`);

--
-- Indexes for table `options_list`
--
ALTER TABLE `options_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_list`
--
ALTER TABLE `post_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkhand_list`
--
ALTER TABLE `checkhand_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coin_list`
--
ALTER TABLE `coin_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment_list`
--
ALTER TABLE `comment_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `member_list`
--
ALTER TABLE `member_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `options_list`
--
ALTER TABLE `options_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post_list`
--
ALTER TABLE `post_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coin_list`
--
ALTER TABLE `coin_list`
  ADD CONSTRAINT `coin_list_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `member_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `coin_list_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `member_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `coin_list_ibfk_3` FOREIGN KEY (`post_id`) REFERENCES `post_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `comment_list`
--
ALTER TABLE `comment_list`
  ADD CONSTRAINT `member_id_fk_cl` FOREIGN KEY (`member_id`) REFERENCES `member_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `post_id_fk_cl` FOREIGN KEY (`post_id`) REFERENCES `post_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `like_list`
--
ALTER TABLE `like_list`
  ADD CONSTRAINT `member_id_fk_ll` FOREIGN KEY (`member_id`) REFERENCES `member_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `post_id_fk_ll` FOREIGN KEY (`post_id`) REFERENCES `post_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `member_meta`
--
ALTER TABLE `member_meta`
  ADD CONSTRAINT `member_id_fk_mm` FOREIGN KEY (`member_id`) REFERENCES `member_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `post_list`
--
ALTER TABLE `post_list`
  ADD CONSTRAINT `member_id_fk_pl` FOREIGN KEY (`member_id`) REFERENCES `member_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
