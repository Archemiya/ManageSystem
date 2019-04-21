-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2019-04-22 06:14:11
-- 服务器版本： 10.1.38-MariaDB
-- PHP 版本： 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `manasystem`
--

-- --------------------------------------------------------

--
-- 表的结构 `reply_schedule`
--

CREATE TABLE `reply_schedule` (
  `id` int(8) NOT NULL,
  `name` varchar(32) COLLATE utf8_bin NOT NULL,
  `major` varchar(32) COLLATE utf8_bin NOT NULL,
  `group_id` int(8) NOT NULL,
  `permission` varchar(32) COLLATE utf8_bin NOT NULL,
  `special` varchar(8) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `reply_schedule`
--

INSERT INTO `reply_schedule` (`id`, `name`, `major`, `group_id`, `permission`, `special`) VALUES
(1007, '许盛伟', '计算机专业', 1, 'tutor', 'reviewer'),
(1008, '冯雁', '计算机专业', 2, 'tutor', 'reviewer'),
(1009, '刘念', '计算机专业', 3, 'tutor', 'reviewer'),
(1010, '导师甲', '计算机专业', 1, 'tutor', NULL),
(1011, '导师乙', '计算机专业', 2, 'tutor', NULL),
(1012, '导师丙', '计算机专业', 3, 'tutor', NULL),
(20189201, '王飞杰', '计算机专业', 1, 'student', NULL),
(20189202, '上官慧羽', '计算机专业', 2, 'student', NULL),
(20189203, '邸梓航', '计算机专业', 2, 'student', NULL),
(20189204, '张博文', '计算机专业', 1, 'student', NULL),
(20189205, '黄铸君', '计算机专业', 2, 'student', NULL),
(20189206, '王子臻', '计算机专业', 2, 'student', NULL),
(20189210, '牟健', '计算机专业', 1, 'student', NULL),
(20189216, '鲍政李', '计算机专业', 1, 'student', NULL),
(20189217, '张鸿羽', '计算机专业', 1, 'student', NULL),
(20189218, '冯乾', '计算机专业', 2, 'student', NULL),
(20189219, '黄俊豪', '计算机专业', 3, 'student', NULL),
(20189220, '余超', '计算机专业', 3, 'student', NULL),
(20189230, '杨静怡', '计算机专业', 3, 'student', NULL);

--
-- 转储表的索引
--

--
-- 表的索引 `reply_schedule`
--
ALTER TABLE `reply_schedule`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
