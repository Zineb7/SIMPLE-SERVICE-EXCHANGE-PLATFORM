-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 26 jan. 2024 à 00:19
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sns_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `checkhand_list`
--

CREATE TABLE `checkhand_list` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `slected` int(11) NOT NULL,
  `date_clicked` datetime NOT NULL DEFAULT current_timestamp(),
  `post_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `checkhand_list`
--

INSERT INTO `checkhand_list` (`id`, `member_id`, `slected`, `date_clicked`, `post_id`, `status`) VALUES
(22, 8, 0, '2023-07-27 19:37:15', 33, 0),
(23, 8, 0, '2023-07-27 19:37:21', 32, 1),
(26, 8, 0, '2023-07-27 19:37:31', 25, 0),
(32, 4, 0, '2023-07-27 20:03:27', 13, 0),
(35, 4, 0, '2023-07-27 20:03:33', 11, 0),
(51, 4, 0, '2023-07-31 21:01:39', 33, 0),
(52, 4, 1, '2023-07-31 21:01:43', 32, 1),
(63, 4, 0, '2023-07-31 21:47:47', 24, 0),
(73, 4, 0, '2023-07-31 21:57:42', 51, 0),
(84, 4, 1, '2023-07-31 22:37:29', 53, 1),
(90, 4, 0, '2023-07-31 22:38:03', 54, 0),
(103, 4, 1, '2023-08-02 18:55:31', 62, 1),
(104, 4, 1, '2023-08-02 18:58:06', 63, 1),
(105, 4, 4, '2023-08-02 19:11:57', 64, 1),
(106, 4, 4, '2023-08-02 19:18:31', 65, 1),
(109, 7, 1, '2023-08-02 19:47:12', 66, 1),
(110, 7, 1, '2023-08-02 19:47:15', 65, 1),
(111, 7, 0, '2023-08-02 19:47:17', 64, 0),
(112, 7, 0, '2023-08-02 19:47:19', 63, 0),
(113, 4, 1, '2023-08-02 20:10:58', 67, 1),
(114, 4, 1, '2023-08-02 20:34:19', 68, 1),
(116, 4, 1, '2023-08-02 22:01:03', 69, 1),
(117, 4, 1, '2023-08-02 23:18:24', 23, 1),
(119, 4, 1, '2023-08-03 17:49:39', 70, 1),
(120, 4, 0, '2023-08-03 19:18:12', 21, 0),
(121, 4, 1, '2023-08-03 19:49:10', 71, 1),
(122, 4, 1, '2023-08-03 22:03:36', 72, 1),
(124, 4, 1, '2023-08-03 22:07:42', 73, 1),
(125, 4, 1, '2023-08-03 22:11:36', 74, 1),
(126, 4, 1, '2023-08-03 22:24:54', 75, 1),
(127, 4, 1, '2023-08-03 22:35:34', 76, 1),
(128, 4, 1, '2023-08-04 13:19:18', 77, 1),
(129, 4, 1, '2023-08-04 13:20:10', 78, 1),
(132, 4, 1, '2023-08-04 13:28:27', 81, 1),
(133, 4, 1, '2023-08-04 13:37:16', 82, 1),
(134, 4, 1, '2023-08-04 13:46:28', 83, 1),
(135, 4, 1, '2023-08-04 21:32:27', 84, 1),
(137, 7, 1, '2023-08-05 20:29:27', 83, 1),
(138, 7, 1, '2023-08-05 20:29:30', 84, 1),
(139, 7, 0, '2023-08-05 20:29:32', 82, 0),
(140, 7, 0, '2023-08-05 20:29:35', 81, 0),
(141, 4, 1, '2023-08-05 20:39:19', 86, 1),
(144, 7, 0, '2023-08-11 20:01:54', 78, 0),
(147, 10, 1, '2023-08-11 21:56:24', 89, 1),
(148, 4, 0, '2023-08-14 19:29:13', 89, 0),
(149, 7, 0, '2023-08-14 20:10:37', 88, 0),
(151, 7, 0, '2023-08-14 20:10:41', 86, 0),
(152, 7, 0, '2023-08-14 20:10:43', 85, 0),
(153, 7, 1, '2023-08-14 20:11:19', 90, 1),
(156, 10, 1, '2023-08-15 22:25:27', 93, 1),
(157, 4, 1, '2023-08-17 21:12:14', 93, 1),
(158, 4, 0, '2023-08-17 21:12:18', 90, 0),
(159, 7, 1, '2023-08-17 21:29:26', 94, 1),
(161, 11, 1, '2023-09-01 19:30:39', 97, 1),
(162, 4, 0, '2023-09-08 00:32:07', 105, 0),
(164, 15, 1, '2023-09-28 00:21:45', 164, 1),
(165, 18, 1, '2023-09-28 20:27:40', 166, 1),
(166, 15, 1, '2023-10-02 11:33:27', 167, 1);

-- --------------------------------------------------------

--
-- Structure de la table `coin_list`
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
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `coin_list`
--

INSERT INTO `coin_list` (`id`, `sender_id`, `receiver_id`, `post_id`, `coins_exchanged`, `date_created`, `date_updated`, `deadline`, `status`) VALUES
(1, 4, 4, 81, 100, '2023-08-04 14:36:49', '2023-08-04 14:36:49', '2023-08-04 14:36:49', 1),
(2, 4, 4, 82, 100, '2023-08-04 14:37:21', '2023-08-04 14:37:21', '2023-08-04 14:37:21', 1),
(3, 4, 4, 82, 100, '2023-08-04 14:37:26', '2023-08-04 14:37:26', '2023-08-04 14:37:26', 1),
(131, 4, 4, 65, 100, '2023-08-05 19:30:29', '2023-08-05 19:30:29', '2023-08-05 19:30:29', 2),
(132, 4, 4, 64, 100, '2023-08-05 19:32:35', '2023-08-05 19:32:35', '2023-08-05 19:32:35', 2),
(158, 4, 4, 65, 0, '2023-08-05 21:01:23', '2023-08-05 21:01:23', '2023-08-05 21:01:23', 7),
(169, 4, 4, 64, 100, '2023-08-05 21:28:22', '2023-08-05 21:28:22', '2023-08-05 21:28:22', 7),
(170, 4, 7, 84, 100, '2023-08-05 21:30:30', '2023-08-05 21:30:30', '2023-08-05 21:30:30', 1),
(171, 4, 7, 84, 100, '2023-08-05 21:30:35', '2023-08-05 21:30:35', '2023-08-05 21:30:35', 1),
(172, 4, 7, 83, 100, '2023-08-05 21:34:06', '2023-08-05 21:34:06', '2023-08-05 21:34:06', 1),
(173, 4, 7, 83, 100, '2023-08-05 21:34:09', '2023-08-05 21:34:09', '2023-08-05 21:34:09', 1),
(174, 7, 4, 86, 100, '2023-08-05 21:39:44', '2023-08-05 21:39:44', '2023-08-05 21:39:44', 1),
(175, 7, 4, 86, 100, '2023-08-05 21:39:49', '2023-08-05 21:39:49', '2023-08-05 21:39:49', 1),
(180, 4, 7, 86, 100, '2023-08-09 23:00:19', '2023-08-09 23:00:19', '2023-08-09 23:00:19', 7),
(181, 4, 4, 84, 100, '2023-08-09 23:03:56', '2023-08-09 23:03:56', '2023-08-09 23:03:56', 7),
(182, 7, 4, 66, 100, '2023-08-11 19:39:00', '2023-08-11 19:39:00', '2023-08-11 19:39:00', 2),
(183, 7, 4, 83, 100, '2023-08-11 19:41:33', '2023-08-11 19:41:33', '2023-08-11 19:41:33', 7),
(184, 7, 4, 66, 100, '2023-08-11 20:05:29', '2023-08-11 20:05:29', '2023-08-11 20:05:29', 7),
(185, 4, 4, 63, 100, '2023-08-11 21:09:26', '2023-08-11 21:09:26', '2023-08-11 21:09:26', 2),
(186, 4, 4, 63, 100, '2023-08-11 21:09:33', '2023-08-11 21:09:33', '2023-08-11 21:09:33', 7),
(187, 4, 4, 67, 100, '2023-08-11 21:13:38', '2023-08-11 21:13:38', '2023-08-11 21:13:38', 2),
(188, 4, 4, 62, 220, '2023-08-11 22:22:11', '2023-08-11 22:22:11', '2023-08-11 22:22:11', 2),
(190, 9, 10, 89, 100, '2023-08-11 22:56:31', '2023-08-11 22:56:31', '2023-08-11 22:56:31', 1),
(197, 4, 7, 90, 100, '2023-08-14 21:11:42', '2023-08-14 21:11:42', '2023-08-14 21:11:42', 1),
(198, 7, 4, 90, 100, '2023-08-14 21:12:00', '2023-08-14 21:12:00', '2023-08-14 21:12:00', 2),
(209, 4, 7, 90, 100, '2023-08-15 22:14:28', '2023-08-15 22:14:28', '2023-08-15 22:14:28', 3),
(219, 10, 7, 93, 100, '2023-08-15 23:25:44', '2023-08-15 23:25:44', '2023-08-15 23:25:44', 1),
(220, 10, 7, 93, 100, '2023-08-15 23:26:19', '2023-08-15 23:26:19', '2023-08-15 23:26:19', 2),
(221, 10, 7, 93, 100, '2023-08-15 23:26:28', '2023-08-15 23:26:28', '2023-08-15 23:26:28', 3),
(222, 4, 4, 62, 220, '2023-08-16 23:39:46', '2023-08-16 23:39:46', '2023-08-16 23:39:46', 3),
(224, 4, 7, 93, 100, '2023-08-17 22:12:49', '2023-08-17 22:12:49', '2023-08-17 22:12:49', 1),
(225, 7, 10, 94, 100, '2023-08-17 22:29:33', '2023-08-17 22:29:33', '2023-08-17 22:29:33', 1),
(226, 7, 10, 94, 100, '2023-08-17 22:54:51', '2023-08-17 22:54:51', '2023-08-17 22:54:51', 2),
(243, 4, 4, 67, 100, '2023-08-24 19:07:09', '2023-08-24 19:07:09', '2023-08-24 19:07:09', 4),
(252, 4, 4, 63, 100, '2023-09-01 18:58:40', '2023-09-01 18:58:40', '2023-09-01 18:58:40', 6),
(253, 4, 4, 84, 100, '2023-09-01 18:59:20', '2023-09-01 18:59:20', '2023-09-01 18:59:20', 6),
(254, 4, 4, 67, 100, '2023-09-01 19:00:08', '2023-09-01 19:00:08', '2023-09-01 19:00:08', 5),
(256, 7, 4, 86, 100, '2023-09-01 19:02:08', '2023-09-01 19:02:08', '2023-09-01 19:02:08', 6),
(257, 4, 7, 83, 100, '2023-09-01 19:02:18', '2023-09-01 19:02:18', '2023-09-01 19:02:18', 6),
(258, 4, 7, 66, 100, '2023-09-01 19:02:22', '2023-09-01 19:02:22', '2023-09-01 19:02:22', 6),
(259, 11, 10, 97, 100, '2023-09-01 20:31:11', '2023-09-01 20:31:11', '2023-09-01 20:31:11', 1),
(260, 11, 10, 97, 100, '2023-09-01 21:22:41', '2023-09-01 21:22:41', '2023-09-01 21:22:41', 2),
(270, 4, 4, 64, 100, '2023-09-01 22:08:24', '2023-09-01 22:08:24', '2023-09-01 22:08:24', 6),
(271, 4, 4, 65, 100, '2023-09-01 22:08:27', '2023-09-01 22:08:27', '2023-09-01 22:08:27', 6),
(274, 15, 18, 164, 100, '2023-09-28 07:21:53', '2023-09-28 07:21:53', '2023-09-28 07:21:53', 1),
(275, 15, 18, 164, 100, '2023-09-28 07:22:11', '2023-09-28 07:22:11', '2023-09-28 07:22:11', 2),
(293, 4, 7, 93, 100, '2023-09-29 03:17:16', '2023-09-29 03:17:16', '2023-09-29 03:17:16', 7),
(294, 18, 15, 166, 150, '2023-09-29 03:27:50', '2023-09-29 03:27:50', '2023-09-29 03:27:50', 1),
(295, 18, 15, 166, 150, '2023-09-29 03:30:01', '2023-09-29 03:30:01', '2023-09-29 03:30:01', 7),
(296, 15, 18, 167, 220, '2023-10-02 18:33:42', '2023-10-02 18:33:42', '2023-10-02 18:33:42', 1),
(297, 15, 18, 167, 220, '2023-10-02 18:33:56', '2023-10-02 18:33:56', '2023-10-02 18:33:56', 2);

-- --------------------------------------------------------

--
-- Structure de la table `comment_list`
--

CREATE TABLE `comment_list` (
  `id` int(30) NOT NULL,
  `post_id` int(30) NOT NULL,
  `member_id` int(30) NOT NULL,
  `message` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comment_list`
--

INSERT INTO `comment_list` (`id`, `post_id`, `member_id`, `message`, `date_created`, `date_updated`) VALUES
(2, 2, 1, 'Sample 101', '2022-05-03 13:57:13', '2022-05-03 13:57:13'),
(3, 2, 1, '123', '2022-05-03 13:58:12', '2022-05-03 13:58:12'),
(6, 2, 1, 'Comment 123', '2022-05-03 13:58:56', '2022-05-03 13:58:56'),
(10, 1, 2, 'test comment', '2022-05-03 14:29:03', '2022-05-03 14:29:03'),
(11, 11, 1, 'Master pieace', '2022-05-03 15:35:51', '2022-05-03 15:35:51'),
(12, 11, 4, 'nice', '2023-07-14 20:27:23', '2023-07-14 20:27:23'),
(19, 33, 4, 'test', '2023-07-27 20:58:23', '2023-07-27 20:58:23'),
(20, 32, 4, 'test', '2023-07-27 20:58:28', '2023-07-27 20:58:28'),
(21, 1, 4, 'test', '2023-09-08 00:29:53', '2023-09-08 00:29:53'),
(22, 157, 4, '', '2023-09-19 15:53:09', '2023-09-19 15:53:09'),
(23, 164, 15, 'Interessted', '2023-09-27 23:44:41', '2023-09-27 23:44:41');

-- --------------------------------------------------------

--
-- Structure de la table `like_list`
--

CREATE TABLE `like_list` (
  `post_id` int(30) NOT NULL,
  `member_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `like_list`
--

INSERT INTO `like_list` (`post_id`, `member_id`) VALUES
(2, 1),
(2, 2),
(1, 2),
(3, 1),
(11, 4),
(2, 4),
(25, 4),
(23, 4),
(13, 4),
(3, 4),
(3, 4),
(22, 4),
(33, 4),
(32, 4),
(21, 4),
(83, 4),
(90, 7),
(94, 4),
(93, 4),
(97, 11),
(164, 15);

-- --------------------------------------------------------

--
-- Structure de la table `member_list`
--

CREATE TABLE `member_list` (
  `id` int(30) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text NOT NULL DEFAULT 'uploads/member/2.png?v=1651559268',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=Pending, 1=Approved, 2 = Denied, 3=Blocked',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `coin` int(11) NOT NULL DEFAULT 1000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `member_list`
--

INSERT INTO `member_list` (`id`, `firstname`, `middlename`, `lastname`, `email`, `password`, `avatar`, `status`, `date_created`, `date_updated`, `coin`) VALUES
(1, 'Mark', 'D', 'Cooper', 'mcooper@sample.com', 'c7162ff89c647f444fcaa5c635dac8c3', 'uploads/member/1.png?v=1651542663', 0, '2022-05-03 09:51:03', '2023-07-20 17:11:58', 100),
(2, 'Claire', 'D', 'Blake', 'cblake@sample.com', '4744ddea876b11dcb1d169fadf494418', 'uploads/member/2.png?v=1651559268', 0, '2022-05-03 14:27:48', '2023-07-20 17:12:03', 200),
(3, 'ZINEB', NULL, 'CHAFIKI', 'zinebchafiki7@gmail.com', 'ZEY123', '', 0, '2023-07-14 18:21:38', '2023-07-20 17:12:07', 100),
(4, 'ZINEB', '', 'CHAFIKI', 'zinebchafiki1@gmail.com', 'cfdbd131c899b6347a8262e79061cdc0', '', 0, '2023-07-14 20:26:41', '2023-09-28 20:17:16', 395),
(5, 'test', '', 'zey', 'test@gmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', '', 0, '2023-07-16 22:13:04', '2023-07-20 17:12:17', 20),
(6, 'test1', '', 'zey1', 'test1@gmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', '', 0, '2023-07-16 22:15:17', '2023-07-20 17:12:21', 50),
(7, 'test3', '', 'test3', 'test3@gmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'uploads/member/7.png?v=1689542837', 0, '2023-07-16 22:27:17', '2023-09-28 20:17:16', 1125),
(8, 'test', '', 'test', 'testtest@gmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'uploads/member/8.png?v=1690483014', 0, '2023-07-27 19:36:54', '2023-07-27 19:36:54', 0),
(9, 'zey', '', 'zey', 'zey@gmail.com', 'e9ae6e386d9b73a6b99fd527511af19d', '', 0, '2023-08-11 21:54:53', '2023-08-11 22:02:14', 925),
(10, 'sos', '', 'sos', 'sos@gmail.com', 'bbc2703de876f9ae1e59309a298125a1', 'uploads/member/1.png?v=1651542668', 0, '2023-08-11 21:55:31', '2023-09-26 20:48:48', 800),
(11, 'september', '', 'september', 'september@gmail.com', '7812e8b74f6837fba66f86fe86688a2b', '', 0, '2023-09-01 19:30:19', '2023-09-01 20:39:46', 75),
(15, 'October', '', 'October', 'oct@gmail.com', 'b59c67bf196a4758191e42f76670ceba', 'uploads/member/1.png?v=1651542663', 0, '2023-09-26 22:30:22', '2023-10-01 23:14:15', 1000),
(18, 'Chafiki', '', 'ZINEB', 'zinebchafiki11@gmail.com', 'b59c67bf196a4758191e42f76670ceba', 'uploads/member/2.png?v=1651559268', 0, '2023-09-26 23:20:15', '2023-10-02 11:33:42', 780);

-- --------------------------------------------------------

--
-- Structure de la table `member_meta`
--

CREATE TABLE `member_meta` (
  `member_id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `options_list`
--

CREATE TABLE `options_list` (
  `id` int(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `coin_value` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `options_list`
--

INSERT INTO `options_list` (`id`, `name`, `coin_value`) VALUES
(1, 'CAR', 100),
(2, 'MOTOCYCLE', 120);

-- --------------------------------------------------------

--
-- Structure de la table `post_list`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `post_list`
--

INSERT INTO `post_list` (`id`, `member_id`, `caption`, `upload_path`, `date_created`, `date_updated`, `coin_value`, `tag`, `options`, `status`) VALUES
(1, 1, 'Sample Post 101', 'uploads/posts/202205030001/', '2022-05-03 11:13:02', '2023-07-16 19:01:34', 100, NULL, NULL, 0),
(2, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras laoreet accumsan sem, vel egestas diam eleifend sit amet. Praesent egestas ullamcorper nunc. \r\n\r\nMaecenas nibh diam, porta vitae pulvinar a, vulputate at turpis. Vivamus dui lectus, hendrerit vel augue nec, porta maximus mi. Integer tincidunt maximus dictum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aliquam id maximus erat.', 'uploads/posts/202205030002/', '2022-05-03 11:56:51', '2023-07-16 19:01:37', 200, NULL, NULL, 0),
(3, 2, 'Vestibulum nibh enim, porttitor lobortis sapien in, lacinia mollis nisi. Fusce aliquam magna sed ullamcorper faucibus. Ut fermentum sem ultrices mattis dictum. Aliquam erat volutpat. Sed varius erat non porttitor tristique. Fusce non ornare turpis. Nulla lacinia eleifend nulla quis tristique. Nulla quis mollis augue, eget convallis felis. Sed porttitor, leo a varius scelerisque, metus enim sodales lorem, ac convallis diam quam ac sem. Nulla consequat aliquam egestas. Nullam turpis turpis, tempor vitae ligula vitae, interdum consequat enim.', 'uploads/posts/202205030003/', '2022-05-03 14:29:41', '2023-07-16 19:01:40', 300, NULL, NULL, 0),
(11, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc aliquam enim eget rutrum elementum. Aliquam pretium urna eu massa tempus, in tempus felis efficitur. Integer ex tellus, porta at nisi et, auctor tempor nisi. Proin pulvinar ac tortor blandit tempor. Suspendisse ut aliquam felis. Morbi eleifend egestas rhoncus. Integer eu velit ullamcorper nisl dignissim commodo vel et sapien. Vestibulum ultricies ligula quis congue faucibus. Cras vitae aliquet mauris. Nunc vitae magna ut eros pulvinar rhoncus nec et justo. Morbi id magna sit amet sem fermentum laoreet. Duis condimentum ante non fermentum feugiat.', 'uploads/posts/202205030006/', '2022-05-03 15:35:36', '2023-07-16 19:01:44', 150, NULL, NULL, 0),
(13, 7, 'test3', 'uploads/posts/202307160001/', '2023-07-16 22:28:17', '2023-07-20 20:49:29', 200, NULL, NULL, 0),
(21, 4, 'test', 'uploads/posts/202307200005/', '2023-07-20 20:05:08', '2023-07-20 20:49:34', 300, NULL, NULL, 0),
(22, 4, 'test', 'uploads/posts/202307200009/', '2023-07-20 20:05:24', '2023-07-20 20:49:37', 400, NULL, NULL, 0),
(23, 4, 'test222', 'uploads/posts/202307200010/', '2023-07-20 20:06:11', '2023-08-02 23:18:29', 500, NULL, NULL, 1),
(24, 4, 'test', 'uploads/posts/202307200011/', '2023-07-20 22:25:03', '2023-07-20 22:25:03', 100, 'sunset', NULL, 0),
(25, 4, 'TEST', 'uploads/posts/202307210017/', '2023-07-21 22:28:37', '2023-07-21 22:28:37', 100, 'sunset', '1;2;', 0),
(32, 4, 'What is Lorem Ipsum?\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhat is Lorem Ipsum?\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'uploads/posts/202307240006/', '2023-07-24 22:22:07', '2023-07-24 22:22:07', 220, 'epson epsun emsi', '1;2;', 0),
(33, 4, 'Why do we use it?\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'uploads/posts/202307250001/', '2023-07-25 19:36:43', '2023-07-25 19:36:43', 100, '', '1;', 0),
(51, 4, ',jhgffgvhb', 'uploads/posts/202307310003/', '2023-07-31 21:50:11', '2023-07-31 21:50:11', 100, '', '1;', 0),
(53, 4, 'idowskjbdshuvcjio ', 'uploads/posts/202307310005/', '2023-07-31 22:33:33', '2023-08-01 16:29:56', 100, '', '1;', 0),
(54, 4, 'gfdfghjnk', 'uploads/posts/202307310006/', '2023-07-31 22:37:41', '2023-07-31 22:37:41', 120, '', '2;', 0),
(55, 4, 'testikomplù', 'uploads/posts/202308010001/', '2023-08-01 14:38:27', '2023-08-01 14:38:27', 120, 'sunset sun holidays ', '2;', 0),
(62, 4, 'hello word', 'uploads/posts/202308020001/', '2023-08-02 18:53:08', '2023-08-02 18:55:36', 220, 'sunset', '1;2;', 1),
(63, 4, 'okay', 'uploads/posts/202308020002/', '2023-08-02 18:58:03', '2023-08-02 18:58:11', 100, '', '1;', 1),
(64, 4, 'hello', 'uploads/posts/202308020003/', '2023-08-02 19:11:50', '2023-08-02 19:12:00', 100, '', '1;', 1),
(65, 4, 'red', 'uploads/posts/202308020004/', '2023-08-02 19:18:28', '2023-08-02 19:18:35', 100, '', '1;', 1),
(66, 4, 'rele', 'uploads/posts/202308020005/', '2023-08-02 19:39:20', '2023-08-02 19:39:27', 100, '', '1;', 1),
(67, 4, 'red', 'uploads/posts/202308020006/', '2023-08-02 20:10:54', '2023-08-02 20:11:02', 100, '', '1;', 1),
(68, 4, 'hey', 'uploads/posts/202308020007/', '2023-08-02 20:32:15', '2023-08-02 20:37:57', 100, '', '1;', 1),
(69, 4, 'red', 'uploads/posts/202308020008/', '2023-08-02 20:42:09', '2023-08-02 21:31:01', 100, '', '1;', 1),
(70, 4, 'redgdsdcwf2023', 'uploads/posts/202308030001/', '2023-08-02 23:25:56', '2023-08-02 23:26:09', 100, 'sunset', '1;', 1),
(71, 4, 'test', 'uploads/posts/202308030002/', '2023-08-03 19:49:07', '2023-08-03 19:49:18', 100, '', '1;', 1),
(72, 4, 'fjdxjnd', 'uploads/posts/202308030003/', '2023-08-03 22:03:33', '2023-08-03 22:03:40', 100, '', '1;', 1),
(73, 4, 'sqg', 'uploads/posts/202308030004/', '2023-08-03 22:07:39', '2023-08-03 22:07:45', 100, '', '1;', 1),
(74, 4, 'jnsx', 'uploads/posts/202308030005/', '2023-08-03 22:11:34', '2023-08-03 22:13:32', 100, '', '1;', 1),
(75, 4, 'red', 'uploads/posts/202308030006/', '2023-08-03 22:24:51', '2023-08-03 22:24:57', 100, '', '1;', 1),
(76, 4, 'frf', 'uploads/posts/202308030007/', '2023-08-03 22:35:31', '2023-08-03 22:35:38', 100, '', '1;', 1),
(77, 4, 'red', 'uploads/posts/202308040001/', '2023-08-04 13:19:14', '2023-08-04 13:19:21', 100, '', '1;', 1),
(78, 4, '\"resdsvf', 'uploads/posts/202308040002/', '2023-08-04 13:20:07', '2023-08-04 13:20:14', 100, '', '1;', 1),
(81, 4, 'hello', 'uploads/posts/202308040003/', '2023-08-04 13:28:24', '2023-08-04 13:28:33', 100, '', '1;', 1),
(82, 4, 'kdkd', 'uploads/posts/202308040004/', '2023-08-04 13:37:14', '2023-08-04 13:37:21', 100, '', '1;', 1),
(83, 4, 'rdx', 'uploads/posts/202308040005/', '2023-08-04 13:46:24', '2023-08-04 13:46:32', 100, '', '1;', 1),
(84, 4, 'test 04', 'uploads/posts/202308040006/', '2023-08-04 21:32:23', '2023-08-04 21:32:31', 100, '', '1;', 1),
(85, 4, 'Sample post 2', 'uploads/posts/202308040007/', '2023-08-04 21:33:52', '2023-08-04 21:33:52', 100, '', '1;', 0),
(86, 7, 'test 3', 'uploads/posts/202308050001/', '2023-08-05 20:39:04', '2023-08-05 20:39:44', 100, '', '1;', 1),
(88, 4, 'sbwdfn', 'uploads/posts/202308110002/', '2023-08-11 21:28:49', '2023-08-11 21:28:49', 100, '', '1;', 0),
(89, 9, 'sos', 'uploads/posts/202308110003/', '2023-08-11 21:56:16', '2023-08-11 21:56:31', 100, '', '1;', 1),
(90, 4, '14 / 08', 'uploads/posts/202308140001/', '2023-08-14 20:11:12', '2023-08-14 20:11:41', 100, '', '1;', 1),
(93, 7, '18/08 TEST3', 'uploads/posts/202308150003/', '2023-08-15 22:25:09', '2023-08-15 22:25:44', 100, 'sunset', '1;', 1),
(94, 10, 'red', 'uploads/posts/202308170001/', '2023-08-17 21:29:18', '2023-08-17 21:29:33', 100, '', '1;', 1),
(96, 10, '01/09', 'uploads/posts/202309010001/', '2023-09-01 19:29:30', '2023-09-01 19:29:30', 100, '', '1;', 0),
(97, 10, '01/09', 'uploads/posts/202309010002/', '2023-09-01 19:29:37', '2023-09-01 19:31:11', 100, '', '1;', 1),
(98, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'uploads/posts/202309070001/', '2023-09-07 20:43:53', '2023-09-07 20:43:53', 100, 'car service', '1;', 0),
(99, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'uploads/posts/202309070002/', '2023-09-07 20:43:54', '2023-09-07 20:43:54', 100, 'car service', '1;', 0),
(100, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'uploads/posts/202309070003/', '2023-09-07 20:43:55', '2023-09-07 20:43:55', 100, 'car service', '1;', 0),
(101, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'uploads/posts/202309070004/', '2023-09-07 20:43:55', '2023-09-07 20:43:55', 100, 'car service', '1;', 0),
(102, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'uploads/posts/202309070005/', '2023-09-07 20:47:51', '2023-09-07 20:47:51', 100, 'car service', '1;', 0),
(103, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'uploads/posts/202309070006/', '2023-09-07 20:48:10', '2023-09-07 20:48:10', 100, 'car service', '1;', 0),
(104, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'uploads/posts/202309070007/', '2023-09-07 20:48:29', '2023-09-07 20:48:29', 100, 'car service', '1;', 0),
(105, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'uploads/posts/202309070008/', '2023-09-07 20:48:30', '2023-09-07 20:48:30', 100, 'car service', '1;', 0),
(106, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'uploads/posts/202309070009/', '2023-09-07 20:48:30', '2023-09-07 20:48:30', 100, 'car service', '1;', 0),
(123, 4, 'red', 'uploads/posts/202309070026/', '2023-09-07 21:29:05', '2023-09-07 21:29:05', 0, '', '', 0),
(124, 4, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'uploads/posts/202309070027/', '2023-09-07 21:33:26', '2023-09-07 21:33:26', 100, 'car service', '1;', 0),
(125, 4, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'uploads/posts/202309070028/', '2023-09-07 21:33:27', '2023-09-07 21:33:27', 100, 'car service', '1;', 0),
(130, 4, 'red', 'uploads/posts/202309080001/', '2023-09-08 00:39:21', '2023-09-08 00:39:21', 90, '', '1;', 0),
(131, 4, 'test', 'uploads/posts/202309190001/', '2023-09-19 14:25:15', '2023-09-19 14:25:15', 0, NULL, '', 0),
(132, 4, 'test', 'uploads/posts/202309190002/', '2023-09-19 14:25:17', '2023-09-19 14:25:17', 0, NULL, '', 0),
(133, 4, 'redt', 'uploads/posts/202309190003/', '2023-09-19 14:38:05', '2023-09-19 14:38:05', 100, 'car service', '1;', 0),
(134, 4, 'red', 'uploads/posts/202309190004/', '2023-09-19 14:38:27', '2023-09-19 14:38:27', 120, 'sunset', '2;', 0),
(135, 4, 'red', 'uploads/posts/202309190005/', '2023-09-19 14:38:29', '2023-09-19 14:38:29', 120, 'sunset', '2;', 0),
(136, 4, 'red', 'uploads/posts/202309190006/', '2023-09-19 14:41:24', '2023-09-19 14:41:24', 120, 'sunset', '2;', 0),
(137, 4, 'red', 'uploads/posts/202309190007/', '2023-09-19 14:41:25', '2023-09-19 14:41:25', 120, 'sunset', '2;', 0),
(138, 4, 'red', 'uploads/posts/202309190008/', '2023-09-19 14:42:42', '2023-09-19 14:42:42', 120, 'sunset', '2;', 0),
(139, 4, 'red', 'uploads/posts/202309190009/', '2023-09-19 14:42:43', '2023-09-19 14:42:43', 120, 'sunset', '2;', 0),
(140, 4, 'image', 'uploads/posts/202309190010/', '2023-09-19 14:43:23', '2023-09-19 14:43:23', 120, 'sunset', '2;', 0),
(141, 4, 'image', 'uploads/posts/202309190011/', '2023-09-19 14:43:24', '2023-09-19 14:43:24', 120, 'sunset', '2;', 0),
(142, 4, 'red', 'uploads/posts/202309190012/', '2023-09-19 14:58:55', '2023-09-19 14:58:55', 120, 'car service', '2;', 0),
(143, 4, 'ed', 'uploads/posts/202309190013/', '2023-09-19 15:13:48', '2023-09-19 15:13:48', 120, 'car service', '2;', 0),
(144, 4, 'ed', 'uploads/posts/202309190014/', '2023-09-19 15:13:49', '2023-09-19 15:13:49', 120, 'car service', '2;', 0),
(145, 4, 'red', 'uploads/posts/202309190015/', '2023-09-19 15:17:56', '2023-09-19 15:17:56', 0, 'sunset', '1;', 0),
(146, 4, 'e', 'uploads/posts/202309190016/', '2023-09-19 15:19:10', '2023-09-19 15:19:10', 100, 'car service', '1;', 0),
(147, 4, 'red', 'uploads/posts/202309190017/', '2023-09-19 15:21:36', '2023-09-19 15:21:36', 120, 'car service', '2;', 0),
(148, 4, 'red', 'uploads/posts/202309190018/', '2023-09-19 15:21:37', '2023-09-19 15:21:37', 120, 'car service', '2;', 0),
(149, 4, '', 'uploads/posts/202309190019/', '2023-09-19 15:23:08', '2023-09-19 15:23:08', 0, '', '', 0),
(150, 4, 're', 'uploads/posts/202309190020/', '2023-09-19 15:24:26', '2023-09-19 15:24:26', 120, 'car service', '2;', 0),
(151, 4, 'red', 'uploads/posts/202309190021/', '2023-09-19 15:26:21', '2023-09-19 15:26:21', 0, 'car service', '', 0),
(152, 4, 'azertyuikl', 'uploads/posts/202309190022/', '2023-09-19 15:28:14', '2023-09-19 15:28:14', 120, 'sunset', '2;', 0),
(153, 4, 'red', 'uploads/posts/202309190023/', '2023-09-19 15:31:00', '2023-09-19 15:31:00', 12, 'sunset', '2;', 0),
(154, 4, 'red2024', 'uploads/posts/202309190024/', '2023-09-19 15:40:52', '2023-09-19 15:40:52', 220, 'car service', '1;2;', 0),
(155, 4, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\r\n\r\n', 'uploads/posts/202309190025/', '2023-09-19 15:43:08', '2023-09-19 15:43:08', 220, 'car service', '1;2;', 0),
(156, 4, 'test', 'uploads/posts/202309190026/', '2023-09-19 15:46:30', '2023-09-19 15:46:30', 10000, 'sunset', '1;', 0),
(157, 4, 'test', 'uploads/posts/202309190027/', '2023-09-19 15:50:37', '2023-09-19 15:50:37', 100000, 'car service', '1;', 0),
(158, 4, 'zey', 'uploads/posts/202309190028/', '2023-09-19 15:59:14', '2023-09-19 15:59:14', 1200, 'car service', '2;', 0),
(159, 4, 'zey', 'uploads/posts/202309190029/', '2023-09-19 16:00:41', '2023-09-19 16:00:41', 2200, 'car service', '1;2;', 0),
(160, 4, 'red', 'uploads/posts/202309190030/', '2023-09-19 16:07:54', '2023-09-19 16:07:54', 10000, 'car service', '1;', 0),
(161, 4, 'red', 'uploads/posts/202309190031/', '2023-09-19 16:25:10', '2023-09-19 16:25:10', 1000, 'sunset', '1;', 0),
(162, 4, 'red', 'uploads/posts/202309190032/', '2023-09-19 16:27:17', '2023-09-19 16:27:17', 1200, 'car service', '2;', 0),
(164, 18, 'Je recherche un service de voiture avec chauffeur pour un événement spécial qui se déroulera le 02/10/2023. J\'aurais besoin d\'une voiture confortable et élégante pour me conduire à l\'événement et me ramener à la maison après. L\'événement aura lieu à casa hotef farah et je prévois d\'avoir besoin du service pendant environ 2 heures.', 'uploads/posts/202309280001/', '2023-09-27 23:18:17', '2023-09-28 00:18:42', 100, '#VoitureAvecChauffeur #ÉvénementSpécial #Transport #Confort #Élégance #ServiceDeChauffeur', '1;', 1),
(165, 18, 'Je recherche un service de voiture avec chauffeur pour un événement spécial qui se déroulera le 03/10/2023. J\'aurais besoin d\'une voiture confortable et élégante pour me conduire à l\'événement et me ramener à la maison après. L\'événement aura lieu à casa hotef farah et je prévois d\'avoir besoin du service pendant environ 2 heures.', 'uploads/posts/202309290001/', '2023-09-28 20:27:00', '2023-09-28 20:27:00', 150, 'car service', '1;', 0),
(166, 15, 'Je recherche un service de voiture avec chauffeur pour un événement spécial qui se déroulera le 04/10/2023. J\'aurais besoin d\'une voiture confortable et élégante pour me conduire à l\'événement et me ramener à la maison après. L\'événement aura lieu à casa hotef farah et je prévois d\'avoir besoin du service pendant environ 3 heures.', 'uploads/posts/202309290002/', '2023-09-28 20:27:34', '2023-09-28 20:27:50', 150, 'car service', '1;', 1),
(167, 18, 'test', 'uploads/posts/202310020001/', '2023-10-02 11:32:49', '2023-10-02 11:33:42', 220, 'car service', '1;2;', 1);

-- --------------------------------------------------------

--
-- Structure de la table `service_ratings`
--

CREATE TABLE `service_ratings` (
  `id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `date_rated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Simple Service Exchange Platform'),
(6, 'short_name', 'TalentTrade'),
(11, 'logo', 'uploads/logo.png?v=1651540223'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover.png?v=1651540931');

-- --------------------------------------------------------

--
-- Structure de la table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `coins_exchanged` int(11) NOT NULL,
  `transaction_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', NULL, 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatars/1.png?v=1649834664', NULL, 1, '2021-01-20 14:02:37', '2022-04-13 15:24:24'),
(3, 'Samir', '', 'Smith', 'jsmith', '1254737c076cf867dc53d60a0364f38e', 'uploads/avatars/3.png?v=1650527149', NULL, 1, '2022-04-21 15:45:49', '2023-09-28 23:14:16');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `checkhand_list`
--
ALTER TABLE `checkhand_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_checkhand_list_post_id` (`post_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Index pour la table `coin_list`
--
ALTER TABLE `coin_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Index pour la table `comment_list`
--
ALTER TABLE `comment_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Index pour la table `like_list`
--
ALTER TABLE `like_list`
  ADD KEY `post_id` (`post_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Index pour la table `member_list`
--
ALTER TABLE `member_list`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `member_meta`
--
ALTER TABLE `member_meta`
  ADD KEY `individual_id` (`member_id`);

--
-- Index pour la table `options_list`
--
ALTER TABLE `options_list`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `post_list`
--
ALTER TABLE `post_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Index pour la table `service_ratings`
--
ALTER TABLE `service_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provider_id` (`provider_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Index pour la table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `checkhand_list`
--
ALTER TABLE `checkhand_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT pour la table `coin_list`
--
ALTER TABLE `coin_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=298;

--
-- AUTO_INCREMENT pour la table `comment_list`
--
ALTER TABLE `comment_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `member_list`
--
ALTER TABLE `member_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `options_list`
--
ALTER TABLE `options_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `post_list`
--
ALTER TABLE `post_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT pour la table `service_ratings`
--
ALTER TABLE `service_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `checkhand_list`
--
ALTER TABLE `checkhand_list`
  ADD CONSTRAINT `checkhand_list_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member_list` (`id`),
  ADD CONSTRAINT `fk_checkhand_list_post_id` FOREIGN KEY (`post_id`) REFERENCES `post_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `coin_list`
--
ALTER TABLE `coin_list`
  ADD CONSTRAINT `coin_list_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `member_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `coin_list_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `member_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `coin_list_ibfk_3` FOREIGN KEY (`post_id`) REFERENCES `post_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `comment_list`
--
ALTER TABLE `comment_list`
  ADD CONSTRAINT `member_id_fk_cl` FOREIGN KEY (`member_id`) REFERENCES `member_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `post_id_fk_cl` FOREIGN KEY (`post_id`) REFERENCES `post_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `like_list`
--
ALTER TABLE `like_list`
  ADD CONSTRAINT `member_id_fk_ll` FOREIGN KEY (`member_id`) REFERENCES `member_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `post_id_fk_ll` FOREIGN KEY (`post_id`) REFERENCES `post_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `member_meta`
--
ALTER TABLE `member_meta`
  ADD CONSTRAINT `member_id_fk_mm` FOREIGN KEY (`member_id`) REFERENCES `member_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `post_list`
--
ALTER TABLE `post_list`
  ADD CONSTRAINT `member_id_fk_pl` FOREIGN KEY (`member_id`) REFERENCES `member_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `service_ratings`
--
ALTER TABLE `service_ratings`
  ADD CONSTRAINT `service_ratings_ibfk_1` FOREIGN KEY (`provider_id`) REFERENCES `member_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `service_ratings_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `member_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
