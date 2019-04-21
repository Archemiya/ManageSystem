-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2019-04-22 06:27:55
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

-- --------------------------------------------------------

--
-- 表的结构 `final_paper`
--

CREATE TABLE `final_paper` (
  `topic_id` int(32) NOT NULL,
  `topic_name` varchar(32) COLLATE utf8_bin NOT NULL,
  `student_id` int(32) NOT NULL,
  `student_name` varchar(32) COLLATE utf8_bin NOT NULL,
  `teacher_id` int(32) NOT NULL,
  `teacher_name` varchar(32) COLLATE utf8_bin NOT NULL,
  `backup` varchar(32) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `first_paper_record`
--

CREATE TABLE `first_paper_record` (
  `record_id` int(11) NOT NULL,
  `topic_id` int(32) NOT NULL,
  `topic_name` varchar(32) COLLATE utf8_bin NOT NULL,
  `student_id` int(32) NOT NULL,
  `student_name` varchar(32) COLLATE utf8_bin NOT NULL,
  `teacher_id` int(32) NOT NULL,
  `teacher_name` varchar(32) COLLATE utf8_bin NOT NULL,
  `paper_main` varchar(1024) COLLATE utf8_bin NOT NULL,
  `first_paper_annex_name` varchar(1024) COLLATE utf8_bin DEFAULT NULL,
  `modify_suggestion` varchar(1024) COLLATE utf8_bin DEFAULT NULL,
  `annex_flag` int(11) NOT NULL DEFAULT '0',
  `final_flag` tinyint(8) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `first_report_record`
--

CREATE TABLE `first_report_record` (
  `record_id` int(11) NOT NULL,
  `topic_id` int(32) NOT NULL,
  `topic_name` varchar(32) COLLATE utf8_bin NOT NULL,
  `student_id` int(32) NOT NULL,
  `student_name` varchar(32) COLLATE utf8_bin NOT NULL,
  `teacher_id` int(32) NOT NULL,
  `teacher_name` varchar(32) COLLATE utf8_bin NOT NULL,
  `topic_source` varchar(1024) COLLATE utf8_bin NOT NULL,
  `topic_purpose` varchar(1024) COLLATE utf8_bin NOT NULL,
  `topic_research_status` varchar(1024) COLLATE utf8_bin NOT NULL,
  `topic_main` varchar(1024) COLLATE utf8_bin NOT NULL,
  `topic_difficulty` varchar(1024) COLLATE utf8_bin NOT NULL,
  `topic_schedule` varchar(1024) COLLATE utf8_bin NOT NULL,
  `topic_ref` varchar(1024) COLLATE utf8_bin NOT NULL,
  `first_report_annex_name` varchar(1024) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `modify_suggestion` varchar(1024) COLLATE utf8_bin DEFAULT NULL,
  `annex_flag` int(11) NOT NULL DEFAULT '0',
  `final_flag` tinyint(8) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `first_report_record`
--

INSERT INTO `first_report_record` (`record_id`, `topic_id`, `topic_name`, `student_id`, `student_name`, `teacher_id`, `teacher_name`, `topic_source`, `topic_purpose`, `topic_research_status`, `topic_main`, `topic_difficulty`, `topic_schedule`, `topic_ref`, `first_report_annex_name`, `modify_suggestion`, `annex_flag`, `final_flag`) VALUES
(1, 13, '基于ASP.net技术的网上购物系统研究与设计', 20189230, '杨静怡', 1012, '导师丙', '1', '1', '1', '1', '1', '1', '1', '第一学期课表.docx', '1', 1, 2),
(2, 13, '基于ASP.net技术的网上购物系统研究与设计', 20189230, '杨静怡', 1012, '导师丙', '11                                ', '1                                ', '1                                ', '1                                ', '1                                ', '1                                ', '1                                ', '第二学期课表.docx', NULL, 1, 1),
(3, 1, '基于OpenDNSSEC的DNSSEC安全认证技术的仿真与实现 ', 20189203, '邸梓航', 1007, '许盛伟', '1', '1', '1', '1', '11', '1', '1', '第一学期课表.docx', NULL, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `guidance_record`
--

CREATE TABLE `guidance_record` (
  `topic_id` int(32) NOT NULL,
  `topic_name` varchar(32) COLLATE utf8_bin NOT NULL,
  `student_id` int(32) NOT NULL,
  `student_name` varchar(32) COLLATE utf8_bin NOT NULL,
  `teacher_id` int(32) NOT NULL,
  `teacher_name` varchar(32) COLLATE utf8_bin NOT NULL,
  `backup` varchar(32) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `midterm_report`
--

CREATE TABLE `midterm_report` (
  `record_id` int(32) NOT NULL,
  `topic_id` int(32) NOT NULL,
  `topic_name` varchar(32) COLLATE utf8_bin NOT NULL,
  `student_id` int(32) NOT NULL,
  `student_name` varchar(32) COLLATE utf8_bin NOT NULL,
  `teacher_id` int(32) NOT NULL,
  `teacher_name` varchar(32) COLLATE utf8_bin NOT NULL,
  `current_status` varchar(1024) COLLATE utf8_bin DEFAULT NULL,
  `need_to_complete` varchar(1024) COLLATE utf8_bin DEFAULT NULL,
  `current_problems_and_solutions` varchar(1024) COLLATE utf8_bin DEFAULT NULL,
  `postwork_schedule` varchar(1024) COLLATE utf8_bin DEFAULT NULL,
  `instructions` varchar(1024) COLLATE utf8_bin DEFAULT NULL,
  `midterm_report_annex_name` varchar(1024) COLLATE utf8_bin DEFAULT NULL,
  `annex_flag` int(8) NOT NULL DEFAULT '0',
  `final_flag` int(8) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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

-- --------------------------------------------------------

--
-- 表的结构 `student_grade`
--

CREATE TABLE `student_grade` (
  `id` int(32) NOT NULL,
  `topic_id` int(32) NOT NULL,
  `student_id` int(32) NOT NULL,
  `student_name` varchar(32) COLLATE utf8_bin NOT NULL,
  `first_report_grade` int(32) NOT NULL DEFAULT '0',
  `fp_grade_description` varchar(1024) COLLATE utf8_bin NOT NULL,
  `student_grade` int(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `student_grade`
--

INSERT INTO `student_grade` (`id`, `topic_id`, `student_id`, `student_name`, `first_report_grade`, `fp_grade_description`, `student_grade`) VALUES
(1, 7, 20189219, '黄俊豪', 70, '111', NULL),
(2, 10, 20189220, '余超', 70, '', NULL),
(3, 13, 20189230, '杨静怡', 98, '', NULL),
(4, 11, 20189202, '上官慧羽', 70, '', NULL),
(5, 1, 20189203, '邸梓航', 98, '11', NULL),
(6, 3, 20189205, '黄铸君', 70, '11', NULL),
(7, 9, 20189206, '王子臻', 70, '11', NULL),
(8, 5, 20189218, '冯乾', 70, '11', NULL),
(9, 8, 20189201, '王飞杰', 70, '1', NULL),
(10, 2, 20189204, '张博文', 70, '1', NULL),
(11, 4, 20189210, '牟健', 70, '11', NULL),
(12, 12, 20189216, '鲍政李', 70, '11', NULL),
(13, 6, 20189217, '张鸿羽', 70, '11', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `stu_func_control`
--

CREATE TABLE `stu_func_control` (
  `id` int(11) NOT NULL,
  `topic` int(8) NOT NULL DEFAULT '0',
  `first_report` int(8) NOT NULL DEFAULT '0',
  `midterm_report` int(8) NOT NULL DEFAULT '0',
  `guidance_record` int(8) NOT NULL DEFAULT '0',
  `first_paper_deadline` date DEFAULT NULL,
  `first_paper` int(8) NOT NULL DEFAULT '0',
  `paper_review` int(8) NOT NULL DEFAULT '0',
  `answer_information` int(8) NOT NULL DEFAULT '0',
  `deferred_reply` int(8) NOT NULL DEFAULT '0',
  `second_reply` int(8) NOT NULL DEFAULT '0',
  `reply_record` int(8) NOT NULL DEFAULT '0',
  `final_draft` int(8) NOT NULL DEFAULT '0',
  `inquiry_result` int(8) NOT NULL DEFAULT '0',
  `excellent_paper` int(8) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `stu_func_control`
--

INSERT INTO `stu_func_control` (`id`, `topic`, `first_report`, `midterm_report`, `guidance_record`, `first_paper_deadline`, `first_paper`, `paper_review`, `answer_information`, `deferred_reply`, `second_reply`, `reply_record`, `final_draft`, `inquiry_result`, `excellent_paper`) VALUES
(1, 1, 1, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0);

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

-- --------------------------------------------------------

--
-- 表的结构 `topic`
--

CREATE TABLE `topic` (
  `id` int(32) NOT NULL,
  `name` varchar(32) COLLATE utf8_bin NOT NULL,
  `topic_type` varchar(32) COLLATE utf8_bin NOT NULL,
  `topic_nature` varchar(32) COLLATE utf8_bin NOT NULL,
  `topic_source` varchar(32) COLLATE utf8_bin NOT NULL,
  `topic_workload` varchar(32) COLLATE utf8_bin NOT NULL,
  `topic_difficulty` varchar(32) COLLATE utf8_bin NOT NULL,
  `teacher_name` varchar(32) COLLATE utf8_bin NOT NULL,
  `teacher_id` varchar(32) COLLATE utf8_bin NOT NULL,
  `student_name` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `student_id` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `create_time` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `introduction` text COLLATE utf8_bin NOT NULL,
  `topic_request` text COLLATE utf8_bin NOT NULL,
  `topic_reference` text COLLATE utf8_bin NOT NULL,
  `topic_otherteacher` varchar(32) COLLATE utf8_bin NOT NULL,
  `topic_chosemode` varchar(32) COLLATE utf8_bin NOT NULL,
  `topic_application` varchar(32) COLLATE utf8_bin NOT NULL,
  `topic_suggestion` varchar(1024) COLLATE utf8_bin DEFAULT NULL,
  `topic_ispass` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `topic`
--

INSERT INTO `topic` (`id`, `name`, `topic_type`, `topic_nature`, `topic_source`, `topic_workload`, `topic_difficulty`, `teacher_name`, `teacher_id`, `student_name`, `student_id`, `create_time`, `introduction`, `topic_request`, `topic_reference`, `topic_otherteacher`, `topic_chosemode`, `topic_application`, `topic_suggestion`, `topic_ispass`) VALUES
(1, '基于OpenDNSSEC的DNSSEC安全认证技术的仿真与实现 ', '毕业设计', '工程实践', '自拟', '适中', '一般', '许盛伟', '1007', '邸梓航', '20189203', NULL, 'DNS作为互联网服务的重要基础设施，存在着很严重的安全漏洞，近年针对这些安全漏洞的网络攻击，给网络应用带来了巨大的损失，DNSSEC作为DNS的安全扩展，可以增加DNS应用的安全性。OpenDNSSEC作为DNSSEC的开发、实现、维护工具，也得到了广泛的运用。本课将基于OpenDNSSEC设计、完成并实现DNSSEC的安全认证技术。                                                                ', '学习并掌握了有关计算机网络的理论、基本概念和应用的相关知识。\r\n对互联网的发展及RFC文档的功能有基本的了解。\r\n对常用的网络协议分析软件和网络通信仿真软件有基本的了解和应用能力。                                                                ', '《计算机网络（第7版）》谢希仁\r\nRFC5011                                ', '无                               ', '自由选择', '保密管理', '意见', 1),
(2, '大数据平台授权模型与访问控制技术研究与实现', '毕业设计', '工程实践', '校外立项科研', '适中', '一般', '许盛伟', '1007', '张博文', '20189204', NULL, '为解决Hadoop大数据平台组件的统一授权管理与访问控制问题，本课题设计实现面向Hadoop平台的授权管理与访问控制组件，研究基于策略和用户身份的大数据组件访问权限模型，为Hadoop平台的HDFS、YARN、HBase等大数据平台组件提供一个集中的权限管理机制，通过配置策略来控制用户访问HDFS文件夹、HDFS文件、数据库、表、字段的细粒度权限，支持基于LDAP、文件的用户同步机制，且可扩展，同时权限可与hadoop无缝对接，为大数据平台的安全提供重要支撑。', '掌握信息安全基础知识；\r\n掌握C++和组件开发技术；\r\n具备搭建Hadoop大数据平台的能力。', 'Hadoop大数据平台基础\r\nHadoop大数据平台开发\r\nHadoop平台Eagle、Ranger组件开发', '无', '自由选择', '保密管理', NULL, 1),
(3, '基于ISSE工程建设中的安全管理策略研究', '毕业设计', '工程实践', '自拟', '适中', '一般', '许盛伟', '1007', '黄铸君', '20189205', NULL, '本课题研究ISSE信息系统安全工程中的关键阶段、活动过程、生命周期、基本功能和相关安全需求，基于保密管理相关知识，提出相应的管理方案。基于通用编程语言设计并实现B/S架构的安全管理系统，该系统提供系统管理、系统设置、数据统计、生成报告、打印查询等功能。', '（1）了解ISSE相关的理论知识\r\n（2）具备保密管理专业的理论知识\r\n（3）具备系统设计和实现的能力\r\n（4）熟练掌握通用语言程序设计方法', '（1）ISSE有关知识、理论,《保密管理》《保密管理概论》《IT项目管理》\r\n（2）通用编程语言和数据库方面的工具书、资料\r\n', '无', '自由选择', '保密管理', NULL, 1),
(4, '基于IPv6的RIP协议的安全机制分析与研究', '毕业设计', '工程实践', '自拟', '大', '一般', '冯雁', '1008', '牟健', '20189210', NULL, ' RIP协议是在互联网应用中最为常见的网络路由选择协议，目前使用RIP协议有着3个不同的版本，各个版本均具有不同的安全机制，在IPv6环境下运行的RIP协议被称为RIPng，该协议采用了和RIPv2、v1完全不同的安全机制。本课程对RIPng的安全机制展开分析与研究，并结合对RIPv2、v1安全机制的实现比较其各自的优劣。', '学习并掌握了有关计算机网络的理论、基本概念和应用的相关知识。\r\n对互联网的发展及RFC文档的功能有基本的了解。\r\n对常用的网络协议分析软件和网络通信仿真软件有基本的了解和应用能力。', '《计算机网络（第7版）》谢希仁\r\nRFC2080 ', '无', '自由选择', '保密管理', NULL, 1),
(5, '窃密信道中天线选择算法的研究与实现', '毕业设计', '工程实践', '自拟', '适中', '一般', '冯雁', '1008', '冯乾', '20189218', NULL, '由于MIMO技术的高可靠性、高传输速率，其已经成为无线通信中的关键技术。随之，在MIMO窃密信道中的物理层安全也更值得关注。MIMO技术中包括波束赋形、人工噪声、天线选择等，本课题以天线选择技术为研究重点，研究机器学习在无线通信物理层安全中的应用，也就是选择合适的机器学习算法实现MIMO窃密信道中天线选择，并与传统天线选择算法的对比分析。', '1、良好计算机编程能力、文献处理能力；\r\n2、有编程经验；\r\n3、良好数据处理、分析能力。', '[1] N. Yang et al., “Safeguarding 5G wireless communication networks\r\nusing physical layer security,” IEEE Commun. Mag., vol. 53, no. 4,\r\npp. 20–27, Apr. 2015.\r\n[2] A. D. Wyner, “The wire-tap channel,” Bell Syst. Tech. J., vol. 54, no. 8,\r\npp. 1355–1367, Oct. 1975.\r\n[3] A. Khisti and G. W. Wornell, “Secure transmission with multiple\r\nantennas—Part II: The MIMOME wiretap channel,” IEEE Trans. Inf.\r\nTheory, vol. 56, no. 11', '无', '自由选择', '保密管理', NULL, 1),
(6, '基于MS17-010漏洞的勒索病毒程序设计及实现', '毕业设计', '工程实践', '自拟', '适中', '一般', '冯雁', '1008', '张鸿羽', '20189217', NULL, '高危漏洞MS17-010，又称为“永恒之蓝”(EternalBlue)，是勒索病毒WannaCry使用的关键漏洞，导致世界数百个国家的大量机构和企业遭受大规模攻击，损失之严重为近年来所罕见。本课题旨在研究MS17-010漏洞的原理和攻击技术，同时，模拟特定的攻击场景，设计和实现一个勒索病毒实现攻击。通过本课题的研究，不仅旨在学习漏洞分析和利用技术，更重要的是针对勒索病毒提出相应的修复措施和响应机制。', '1.熟悉Python语言、C语言\r\n2.熟悉常用渗透测试技术', '无', '无', '自由选择', '保密管理', NULL, 1),
(7, 'PNS攻击有效性研究及仿真验证                 ', '毕业设计', '工程实践', '自拟', '适中', '一般', '刘念', '1009', '黄俊豪', '20189219', NULL, '在实际通信系统中，光源等设备的不完美性给通信系统带来了安全隐患，针对使用非理想光源的量子密钥分发系统，采用PNS攻击可以获得通信密钥而不被发现。本课题主要研究在不同通信系统中PNS攻击的有效性，并利用Matlab等软件模拟演示和分析PNS攻击的实际效率。                                                                ', '线性代数\r\n高等数学\r\n密码学基础\r\n编程语言\r\nMatlab                                                                ', '《高等数学》同济大学出版社                                                  ', '无                               ', '自由选择', '保密管理', '1、难度较大，请降低难度\r\n2、请添加参考资料', 1),
(8, '量子遗传算法在网络入侵检测中的应用研究', '毕业设计', '工程实践', '自拟', '适中', '一般', '刘念', '1009', '王飞杰', '20189201', NULL, '	入侵检测是检查系统或网络中是否存在违反安全策略行为和被攻击迹象的关键技术。其中检测的数据集中数据非常庞大，这就需要使用特征选择实现在保证数据完整性的基础上去掉冗余信息，这对于提高系统的检测效率起着重要作用。本课题旨在研究将特征选择问题看待成优化问题，分析现存优化算法所存在的缺点，选择量子优化算法来对特征进行选择，实现消除冗余属性、降低问题规模、提高数据质量、提升处理速度。', '1、良好计算机编程能力、文献处理能力；\r\n2、具有较强学习能力；\r\n3、良好数据处理、分析能力。', '[2]入侵检测中的快速特征选择方法[J]. 郑洪英,侯梅菊,王渝.  计算机工程. 2010(06) \r\n[3]基于KNN算法及禁忌搜索算法的特征选择方法在入侵检测中的应用研究[J]. 张昊,陶然,李志勇,蔡镇河.  电子学报. 2009(07) \r\n[4]入侵数据特征并行选择算法[J]. 于泠,陈波.  电子科技大学学报. 2008(02) \r\n[5]基于免疫粒子群算法的特征选择[J]. 倪霖,郑洪英.  计算机应用. 2007(12) \r\n[6]一种高效的面向轻量级入侵检测系统的特征选择算法[J]. 陈友,沈华伟,李洋,程学旗.  计算机学报. 2007(08) \r\n[7]基于改进多目标遗传算法的入侵检测集成方法(英文)[J]. 俞研,黄皓.  软件学报. 2007(06) \r\n[8]量子遗传算法研究现状[J]. 杨俊安,庄镇泉.  计算机科学. 2003(11) \r\n[9] Quantum-Inspired Evolutionary Algorithm for a Class of Combinatorial Optimization. Kuk-Hyun Han,Jong-Hwan Kim. IEEE Transactions on Evolutionary Computation . 2002\r\n[10] Feature selection: Evaluation, application, and small sample performance. Jain A,Zongker D. IEEE Transactions on Pattern Analysis and Machine Intelligence . 1997\r\n[11] Unsupervised feature selection using feature similarity. Mitra P,Murthy CA,Pal SK. IEEE Transactions on Pattern Analysis and Machine Intelligence . 2002', '无', '自由选择', '保密管理', NULL, 1),
(9, '基于IOCP的高并发服务器的设计与实现', '毕业设计', '工程实践', '自拟', '适中', '一般', '刘念', '1009', '王子臻', '20189206', NULL, '计算机和网络通信技术的快速发展，为高速并发访问提供了可能。IOCP（输入输出完全端口）是支持多个同事并发的异步I/O操作的应用程序编程接口，适合C/S模式网络服务模型。课题研究IOCP基本原理，编程实现一个基于IOCP的高并发服务器，可以以多线程的方式实现了与多个客户端并发进行消息交互。具体研究内容包括：\r\n1.研究IOCP基本原理；\r\n2.基于IOCP机制设计一个高并发服务器；\r\n编程实现服务器和客户端的并发通信。', '计算机网络基础\r\nJava语言开发基础等', '无', '自由选择', '自由选择', '保密管理', NULL, 1),
(10, '基于kali linux的无线网络渗透测试           ', '毕业设计', '工程实践', '自拟', '大', '一般', '刘念', '1009', '余超', '20189220', NULL, '无线网络一方面给用户带来随时上网的便利，而另一方面也使用户面临安全威胁。和有线网络一样，病毒、黑客、蠕虫，木马、间谍软件，随时都在威胁着无线网络的安全，并且无线网络比有线网络更容易遭侵害。本课题将基于kali linux提供的工具，对一个小型无线网络进行渗透测试，以此来理解无线网络的有关协议，并提出针对性的防御措施。                                ', '了解Linux操作系统\r\n对无线网络安全有兴趣\r\n具有较好的英文文献阅读能力                                ', '无                                ', '无                               ', '自由选择', '保密管理', '可适当加大工作量', 1),
(11, 'SERVLET技术实现数据库查询                ', '毕业设计', '工程实践', '自拟', '适中', '一般', '导师甲', '1010', '上官慧羽', '20189202', NULL, '无', '无', '无', '无                               ', '自由选择', '保密管理', NULL, 1),
(12, '基于WEB的多媒体素材管理库的开发与应用', '毕业设计', '工程实践', '自拟', '适中', '一般', '导师乙', '1011', '鲍政李', '20189216', NULL, '无', '无', '无', '无                               ', '自由选择', '保密管理', NULL, 1),
(13, '基于ASP.net技术的网上购物系统研究与设计', '毕业设计', '工程实践', '自拟', '适中', '一般', '导师丙', '1012', '杨静怡', '20189230', NULL, '无', '无', '无', '无                               ', '自由选择', '保密管理', NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `t_func_control`
--

CREATE TABLE `t_func_control` (
  `id` int(8) NOT NULL,
  `topic` int(8) NOT NULL DEFAULT '0',
  `first_report` int(8) NOT NULL DEFAULT '0',
  `first_report_deadline` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `t_func_control`
--

INSERT INTO `t_func_control` (`id`, `topic`, `first_report`, `first_report_deadline`) VALUES
(1, 1, 1, '2019-04-21');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` varchar(8) COLLATE utf8_bin NOT NULL,
  `name` varchar(8) COLLATE utf8_bin NOT NULL,
  `password` varchar(8) COLLATE utf8_bin NOT NULL,
  `gender` varchar(8) COLLATE utf8_bin DEFAULT NULL,
  `grade` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `class` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `major` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `mobile` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `topic_ischose` int(8) NOT NULL DEFAULT '0',
  `permission` varchar(32) COLLATE utf8_bin NOT NULL,
  `special` varchar(32) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `gender`, `grade`, `class`, `major`, `mobile`, `email`, `topic_ischose`, `permission`, `special`) VALUES
('1007', '许盛伟', '123456', '无', '无', '无', '无', '无', '无', 0, 'tutor', 'reviewer'),
('1008', '冯雁', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tutor', 'reviewer'),
('1009', '刘念', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tutor', 'reviewer'),
('1010', '导师甲', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tutor', NULL),
('1011', '导师乙', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tutor', NULL),
('1012', '导师丙', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'tutor', NULL),
('2007', '答辩秘书', '123456', '无', '无', '无', '无', '无', '无', 0, 'secretary', ''),
('20189201', '王飞杰', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'student', NULL),
('20189202', '上官慧羽', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'student', NULL),
('20189203', '邸梓航', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'student', NULL),
('20189204', '张博文', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'student', NULL),
('20189205', '黄铸君', '123456', '男', '研一', '1892', '计算机技术', '15927187255', '956253367@qq.com', 1, 'student', ''),
('20189206', '王子臻', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'student', NULL),
('20189210', '牟健', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'student', NULL),
('20189216', '鲍政李', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'student', NULL),
('20189217', '张鸿羽', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'student', NULL),
('20189218', '冯乾', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'student', NULL),
('20189219', '黄俊豪', '123', '男', '研一', '1892', '计算机技术', '15907948826', '1257546443@qq.com', 1, 'student', NULL),
('20189220', '余超', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'student', NULL),
('20189230', '杨静怡', '123456', '女', '研一', '1892', '计算机技术', '18811355615', '727728448@qq.com', 1, 'student', NULL),
('admin', '系统管理员', 'admin', '无', '无', '无', '无', '无', '无', 0, 'supermanager', '');

--
-- 转储表的索引
--

--
-- 表的索引 `chose_topic_record`
--
ALTER TABLE `chose_topic_record`
  ADD PRIMARY KEY (`record_id`);

--
-- 表的索引 `final_paper`
--
ALTER TABLE `final_paper`
  ADD PRIMARY KEY (`topic_id`);

--
-- 表的索引 `first_paper_record`
--
ALTER TABLE `first_paper_record`
  ADD PRIMARY KEY (`record_id`);

--
-- 表的索引 `first_report_record`
--
ALTER TABLE `first_report_record`
  ADD PRIMARY KEY (`record_id`);

--
-- 表的索引 `guidance_record`
--
ALTER TABLE `guidance_record`
  ADD PRIMARY KEY (`topic_id`);

--
-- 表的索引 `midterm_report`
--
ALTER TABLE `midterm_report`
  ADD PRIMARY KEY (`record_id`);

--
-- 表的索引 `reply_schedule`
--
ALTER TABLE `reply_schedule`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `student_grade`
--
ALTER TABLE `student_grade`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `stu_func_control`
--
ALTER TABLE `stu_func_control`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `task_book`
--
ALTER TABLE `task_book`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- 表的索引 `t_func_control`
--
ALTER TABLE `t_func_control`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `chose_topic_record`
--
ALTER TABLE `chose_topic_record`
  MODIFY `record_id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- 使用表AUTO_INCREMENT `first_paper_record`
--
ALTER TABLE `first_paper_record`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `first_report_record`
--
ALTER TABLE `first_report_record`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `midterm_report`
--
ALTER TABLE `midterm_report`
  MODIFY `record_id` int(32) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `student_grade`
--
ALTER TABLE `student_grade`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用表AUTO_INCREMENT `task_book`
--
ALTER TABLE `task_book`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用表AUTO_INCREMENT `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 限制导出的表
--

--
-- 限制表 `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
