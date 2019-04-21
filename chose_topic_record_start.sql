-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2019-04-22 01:34:25
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
-- 表的结构 `chose_topic_record`
--

CREATE TABLE `chose_topic_record` (
  `record_id` int(32) NOT NULL,
  `topic_id` int(32) DEFAULT NULL,
  `topic_name` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `teacher_id` int(32) DEFAULT NULL,
  `teacher_name` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `student_id` int(32) DEFAULT NULL,
  `student_name` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `final_flag` int(32) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `chose_topic_record`
--

INSERT INTO `chose_topic_record` (`record_id`, `topic_id`, `topic_name`, `teacher_id`, `teacher_name`, `student_id`, `student_name`, `final_flag`) VALUES
(1, 1, '基于OpenDNSSEC的DNSSEC安全认证技术的仿真与实现 ', 1007, '许盛伟', 20189203, '邸梓航', 0),
(2, 1, '基于OpenDNSSEC的DNSSEC安全认证技术的仿真与实现 ', 1007, '许盛伟', 20189216, '鲍政李', 0),
(3, 1, '基于OpenDNSSEC的DNSSEC安全认证技术的仿真与实现 ', 1007, '许盛伟', 20189201, '王飞杰', 0),
(4, 1, '基于OpenDNSSEC的DNSSEC安全认证技术的仿真与实现 ', 1007, '许盛伟', 20189217, '张鸿羽', 0);

--
-- 转储表的索引
--

--
-- 表的索引 `chose_topic_record`
--
ALTER TABLE `chose_topic_record`
  ADD PRIMARY KEY (`record_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `chose_topic_record`
--
ALTER TABLE `chose_topic_record`
  MODIFY `record_id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
