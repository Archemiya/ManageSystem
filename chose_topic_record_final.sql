-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2019-04-22 01:52:57
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
(1, 1, '基于OpenDNSSEC的DNSSEC安全认证技术的仿真与实现 ', 1007, '许盛伟', 20189203, '邸梓航', 1),
(2, 1, '基于OpenDNSSEC的DNSSEC安全认证技术的仿真与实现 ', 1007, '许盛伟', 20189216, '鲍政李', 0),
(3, 1, '基于OpenDNSSEC的DNSSEC安全认证技术的仿真与实现 ', 1007, '许盛伟', 20189201, '王飞杰', 0),
(4, 1, '基于OpenDNSSEC的DNSSEC安全认证技术的仿真与实现 ', 1007, '许盛伟', 20189217, '张鸿羽', 0),
(5, 1, '基于OpenDNSSEC的DNSSEC安全认证技术的仿真与实现 ', 1007, '许盛伟', 20189219, '黄俊豪', 0),
(6, 2, '大数据平台授权模型与访问控制技术研究与实现', 1007, '许盛伟', 20189220, '余超', 0),
(7, 2, '大数据平台授权模型与访问控制技术研究与实现', 1007, '许盛伟', 20189201, '王飞杰', 0),
(8, 2, '大数据平台授权模型与访问控制技术研究与实现', 1007, '许盛伟', 20189202, '上官慧羽', 0),
(9, 2, '大数据平台授权模型与访问控制技术研究与实现', 1007, '许盛伟', 20189204, '张博文', 1),
(10, 2, '大数据平台授权模型与访问控制技术研究与实现', 1007, '许盛伟', 20189216, '鲍政李', 0),
(11, 3, '基于ISSE工程建设中的安全管理策略研究', 1007, '许盛伟', 20189205, '黄铸君', 1),
(12, 4, '基于IPv6的RIP协议的安全机制分析与研究', 1008, '冯雁', 20189210, '牟健', 1),
(13, 5, '窃密信道中天线选择算法的研究与实现', 1008, '冯雁', 20189218, '冯乾', 1),
(14, 6, '基于MS17-010漏洞的勒索病毒程序设计及实现', 1008, '冯雁', 20189217, '张鸿羽', 1),
(15, 7, 'PNS攻击有效性研究及仿真验证                 ', 1009, '刘念', 20189219, '黄俊豪', 1),
(16, 8, '量子遗传算法在网络入侵检测中的应用研究', 1009, '刘念', 20189201, '王飞杰', 1),
(17, 9, '基于IOCP的高并发服务器的设计与实现', 1009, '刘念', 20189206, '王子臻', 1),
(18, 10, '基于kali linux的无线网络渗透测试           ', 1009, '刘念', 20189220, '余超', 1),
(19, 11, 'SERVLET技术实现数据库查询                ', 1010, '导师甲', 20189202, '上官慧羽', 1),
(20, 12, '基于WEB的多媒体素材管理库的开发与应用', 1011, '导师乙', 20189216, '鲍政李', 1),
(21, 13, '基于ASP.net技术的网上购物系统研究与设计', 1012, '导师丙', 20189230, '杨静怡', 1);

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
  MODIFY `record_id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
