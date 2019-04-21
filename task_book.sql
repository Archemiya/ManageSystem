-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2019-04-22 06:19:43
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
-- 表的结构 `task_book`
--

CREATE TABLE `task_book` (
  `id` int(32) NOT NULL,
  `teacher_id` int(32) NOT NULL,
  `teacher_name` varchar(32) COLLATE utf8_bin NOT NULL,
  `student_id` int(32) NOT NULL,
  `student_name` varchar(32) COLLATE utf8_bin NOT NULL,
  `topic_id` int(32) NOT NULL,
  `topic_name` varchar(32) COLLATE utf8_bin NOT NULL,
  `topic_main` varchar(1024) COLLATE utf8_bin NOT NULL,
  `topic_schedule` varchar(1024) COLLATE utf8_bin NOT NULL,
  `topic_ref` varchar(1024) COLLATE utf8_bin NOT NULL,
  `topic_machine` varchar(1024) COLLATE utf8_bin NOT NULL,
  `topic_space` varchar(1024) COLLATE utf8_bin NOT NULL,
  `topic_timetable` varchar(1024) COLLATE utf8_bin NOT NULL,
  `create_time_stamp` date NOT NULL,
  `islook_flag` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `task_book`
--

INSERT INTO `task_book` (`id`, `teacher_id`, `teacher_name`, `student_id`, `student_name`, `topic_id`, `topic_name`, `topic_main`, `topic_schedule`, `topic_ref`, `topic_machine`, `topic_space`, `topic_timetable`, `create_time_stamp`, `islook_flag`) VALUES
(1, 1012, '导师丙', 20189230, '杨静怡', 13, '基于ASP.net技术的网上购物系统研究与设计', '1', '1', '1', '1', '1', '1', '2019-04-22', '1'),
(2, 1007, '许盛伟', 20189203, '邸梓航', 1, '基于OpenDNSSEC的DNSSEC安全认证技术的仿真与实现 ', '1', '1', '1', '1', '1', '1', '2019-04-22', '1'),
(3, 1007, '许盛伟', 20189204, '张博文', 2, '大数据平台授权模型与访问控制技术研究与实现', '1', '1', '1', '1', '1', '1', '2019-04-22', '1'),
(4, 1007, '许盛伟', 20189205, '黄铸君', 3, '基于ISSE工程建设中的安全管理策略研究', '1', '1', '1', '1', '1', '1', '2019-04-22', '1'),
(5, 1008, '冯雁', 20189210, '牟健', 4, '基于IPv6的RIP协议的安全机制分析与研究', '1', '1', '1', '1', '1', '1', '2019-04-22', '1'),
(6, 1008, '冯雁', 20189218, '冯乾', 5, '窃密信道中天线选择算法的研究与实现', '1', '1', '1', '1', '1', '1', '2019-04-22', '1'),
(7, 1008, '冯雁', 20189217, '张鸿羽', 6, '基于MS17-010漏洞的勒索病毒程序设计及实现', '1', '1', '1', '1', '1', '1', '2019-04-22', '1'),
(8, 1009, '刘念', 20189219, '黄俊豪', 7, 'PNS攻击有效性研究及仿真验证                 ', '1', '1', '1', '1', '1', '1', '2019-04-22', '1'),
(9, 1009, '刘念', 20189201, '王飞杰', 8, '量子遗传算法在网络入侵检测中的应用研究', '1', '1', '1', '1', '1', '1', '2019-04-22', '1'),
(10, 1009, '刘念', 20189206, '王子臻', 9, '基于IOCP的高并发服务器的设计与实现', '1', '1', '1', '1', '1', '1', '2019-04-22', '1'),
(11, 1009, '刘念', 20189220, '余超', 10, '基于kali linux的无线网络渗透测试           ', '1', '1', '1', '1', '1', '1', '2019-04-22', '1'),
(12, 1010, '导师甲', 20189202, '上官慧羽', 11, 'SERVLET技术实现数据库查询                ', '1', '1', '1', '1', '1', '1', '2019-04-22', '1'),
(13, 1011, '导师乙', 20189216, '鲍政李', 12, '基于WEB的多媒体素材管理库的开发与应用', '1', '1', '1', '1', '1', '1', '2019-04-22', '1');

--
-- 转储表的索引
--

--
-- 表的索引 `task_book`
--
ALTER TABLE `task_book`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `task_book`
--
ALTER TABLE `task_book`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
