-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2019-04-05 16:40:17
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
  `recode_id` int(32) NOT NULL,
  `topic_id` int(32) DEFAULT NULL,
  `topic_name` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `teacher_id` int(32) DEFAULT NULL,
  `teacher_name` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `student_id` int(32) DEFAULT NULL,
  `student_name` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `final_flag` int(32) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `stu_func_control`
--

CREATE TABLE `stu_func_control` (
  `id` int(11) NOT NULL,
  `topic` int(8) NOT NULL DEFAULT '0',
  `task_book` int(8) NOT NULL DEFAULT '0',
  `first_report` int(8) NOT NULL DEFAULT '0',
  `midterm_report` int(8) NOT NULL DEFAULT '0',
  `guidance_record` int(8) NOT NULL DEFAULT '0',
  `first_draft` int(8) NOT NULL DEFAULT '0',
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

INSERT INTO `stu_func_control` (`id`, `topic`, `task_book`, `first_report`, `midterm_report`, `guidance_record`, `first_draft`, `paper_review`, `answer_information`, `deferred_reply`, `second_reply`, `reply_record`, `final_draft`, `inquiry_result`, `excellent_paper`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

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
(9, 1007, '许盛伟', 20189230, '杨静怡', 1, '大数据平台授权模型与访问控制技术研究与实现', '主要内容：为解决Hadoop大数据平台组件的统一授权管理与访问控制问题，本课题设计实现面向Hadoop平台的授权管理与访问控制组件，研究基于策略和用户身份的大数据组件访问权限模型，为Hadoop平台的HDFS、YARN、HBase等大数据平台组件提供一个集中的权限管理机制，通过配置策略来控制用户访问HDFS文件夹、HDFS文件、数据库、表、字段的细粒度权限，支持基于LDAP、文件的用户同步机制，且可扩展，同时权限可与hadoop无缝对接，为大数据平台的安全提供重要支撑。 主要要求：本文要求在充分调研分析国内外有关大数据平台授权模型与访问控制技术研究现状基础上，研究设计Hadoop大数据平台组件的统一授权管理与访问控制，采用Ranger、Eagle等开源框架研究实现Hadoop平台的授权管理、访问控制与行为审计等功能。 ', '（1）资料收集与开题准备：2018.12-2019.2 \r\n（2）开题答辩与方案完善：2019.2-2019.3 \r\n（3）技术研究与总体设计：2019.3-2019.4 \r\n（4）系统开发与测试：2019.4-2019.5 \r\n（5）撰写学位论文与准备答辩：2019.5-2019.6', '《GB/T xxxx大数据安全管理指南》 \r\n《GB/T xxxx信息安全技术 数据交易服务安全要求》\r\n《GBT 35274-2017 信息安全技术 大数据服务安全能力要求》 \r\n《信息安全技术 数据安全能力成熟度模型》 \r\n《GBT 7027-2002 信息分类和编码的基本原则与方法》 \r\n《GBT 19715.1-2005 信息技术信息技术安全管理指南第1部分：信息技术安全概念和模型》 \r\n政务大数据安全组件设计方案', '高性能计算机2台及互联网环境', '具备互联网和局域网环境的实验室', '每周一、二、三、四、五下午14:00至17:00', '2019-04-03', '1');

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
(1, '大数据平台授权模型与访问控制技术研究与实现           ', '毕业设计', '工程实践', '校外立项科研', '适中', '一般', '许盛伟', '1007', '', '', NULL, '为解决Hadoop大数据平台组件的统一授权管理与访问控制问题，本课题设计实现面向Hadoop平台的授权管理与访问控制组件，研究基于策略和用户身份的大数据组件访问权限模型，为Hadoop平台的HDFS、YARN、HBase等大数据平台组件提供一个集中的权限管理机制，通过配置策略来控制用户访问HDFS文件夹、HDFS文件、数据库、表、字段的细粒度权限，支持基于LDAP、文件的用户同步机制，且可扩展，同时权限可与hadoop无缝对接，为大数据平台的安全提供重要支撑。为解决Hadoop大数据平台组件的统一授权管理与访问控制问题，本课题设计实现面向Hadoop平台的授权管理与访问控制组件，研究基于策略和用户身份的大数据组件访问权限模型，为Hadoop平台的HDFS、YARN、HBase等大数据平台组件提供一个集中的权限管理机制，通过配置策略来控制用户访问HDFS文件夹、HDFS文件、数据库、表、字段的细粒度权限，支持基于LDAP、文件的用户同步机制，且可扩展，同时权限可与hadoop无缝对接，为大数据平台的安全提供重要支撑。为解决Hadoop大数据平台组件的统一授权管理与访问控制问题，本课题设计实现面向Hadoop平台的授权管理与访问控制组件，研究基于策略和用户身份的大数据组件访问权限模型，为Hadoop平台的HDFS、YARN、HBase等大数据平台组件提供一个集中的权限管理机制，通过配置策略来控制用户访问HDFS文件夹、HDFS文件、数据库、表、字段的细粒度权限，支持基于LDAP、文件的用户同步机制，且可扩展，同时权限可与hadoop无缝对接，为大数据平台的安全提供重要支撑。为解决Hadoop大数据平台组件的统一授权管理与访问控制问题，本课题设计实现面向Hadoop平台的授权管理与访问控制组件，研究基于策略和用户身份的大数据组件访问权限模型，为Hadoop平台的HDFS、YARN、HBase等大数据平台组件提供一个集中的权限管理机制，通过配置策略来控制用户访问HDFS文件夹、HDFS文件、数据库、表、字段的细粒度权限，支持基于LDAP、文件的用户同步机制，且可扩展，同时权限可与hadoop无缝对接，为大数据平台的安全提供重要支撑。为解决Hadoop大数据平台组件的统一授权管理与访问控制问题，本课题设计实现面向Hadoop平台的授权管理与访问控制组件，研究基于策略和用户身份的大数据组件访问权限模型，为Hadoop平台的HDFS、YARN、HBase等大数据平台组件提供一个集中的权限管理机制，通过配置策略来控制用户访问HDFS文件夹、HDFS文件、数据库、表、字段的细粒度权限，支持基于LDAP、文件的用户同步机制，且可扩展，同时权限可与hadoop无缝对接，为大数据平台的安全提供重要支撑。                                ', '掌握信息安全基础知识；\r\n掌握C++和组件开发技术；\r\n具备搭建Hadoop大数据平台的能力。                                ', 'Hadoop大数据平台基础\r\nHadoop大数据平台开发\r\nHadoop平台Eagle、Ranger组件开发                                ', '无                               ', '自由选择', '保密管理[0402]', '1.修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见\r\n2.修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见\r\n3.修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见\r\n4.修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见修改意见', 1),
(2, '基于Linux的网络嗅探器', '毕业设计', '工程实践', '校外立项科研', '适中', '简单', '许盛伟', '1007', '', '', NULL, '无', 'Linux基础', '无', '无', '自由选择', '保密管理[0402]', '', 0),
(3, '基于Apache+MySQL+PHP实现的酒店管理系统', '毕业设计', '工程实践', '校外立项科研', '适中', '一般', '许盛伟', '1007', '', '', NULL, '无', 'PHP基础\r\n数据库基础', '无', '无', '自由选择', '保密管理[0402]', '', 0),
(4, '基于WEB的多媒体素材管理库的开发与应用', '毕业设计', '工程实践', '校外立项科研', '适中', '一般', '许盛伟', '1007', '', '', NULL, '无', '无', '无', '无', '自由选择', '保密管理[0402]', '', 0),
(5, '基于WEB的多媒体素材管理库的开发与应用', '毕业设计', '工程实践', '校外立项科研', '适中', '一般', '许盛伟', '1007', '', '', NULL, '无', '无', '无', '无', '自由选择', '保密管理[0402]', '', 0),
(6, 'KTV点歌系统的论文', '毕业设计', '工程实践', '校外立项科研', '适中', '一般', '许盛伟', '1007', '', '', NULL, '无', '无', '无', '无', '自由选择', '保密管理[0402]', '', 0),
(7, '基于VB的小型停车场管理系统论文', '毕业设计', '工程实践', '校外立项科研', '适中', '一般', '冯雁', '1008', NULL, NULL, NULL, '无', '无', '无', '无', '自由选择', '保密管理[0402]', '', 0),
(8, '学生宿舍信息管理系统论文', '毕业设计', '工程实践', '校外立项科研', '适中', '一般', '冯雁', '1008', NULL, NULL, NULL, '无', '无', '无', '无', '自由选择', '保密管理[0402]', '', 0),
(9, '计算机组成原理网站', '毕业设计', '工程实践', '校外立项科研', '适中', '一般', '冯雁', '1008', NULL, NULL, NULL, '无', '无', '无', '无', '自由选择', '保密管理[0402]', '', 0),
(10, '电子书店管理系统', '毕业设计', '工程实践', '校外立项科研', '适中', '一般', '冯雁', '1008', NULL, NULL, NULL, '无', '无', '无', '无', '自由选择', '保密管理[0402]', '', 0),
(11, '网上求职招聘系统', '毕业设计', '工程实践', '校外立项科研', '适中', '一般', '刘念', '1009', NULL, NULL, NULL, '无', '', '无', '无', '自由选择', '保密管理[0402]', '', 0),
(12, '车辆故障管理系统', '毕业设计', '工程实践', '校外立项科研', '适中', '一般', '刘念', '1009', NULL, NULL, NULL, '无', '无', '无', '无', '自由选择', '保密管理[0402]', '', 0),
(13, '网络教学平台-教师子系统', '毕业设计', '工程实践', '校外立项科研', '适中', '一般', '刘念', '1009', NULL, NULL, NULL, '无', '无', '无', '无', '自由选择', '保密管理[0402]', '', 0),
(14, '教学进度管理系统', '毕业设计', '工程实践', '校外立项科研', '适中', '一般', '刘念', '1009', NULL, NULL, NULL, '无', '无', '无', '无', '自由选择', '保密管理[0402]', '', 0),
(15, '基于OpenDNSSEC的DNSSEC安全认证技术的仿真与实现', '毕业设计', '工程实践', '自拟', '适中', '难', '刘念', '1009', NULL, NULL, NULL, 'DNS作为互联网服务的重要基础设施，存在着很严重的安全漏洞，近年针对这些安全漏洞的网络攻击，给网络应用带来了巨大的损失，DNSSEC作为DNS的安全扩展，可以增加DNS应用的安全性。OpenDNSSEC作为DNSSEC的开发、实现、维护工具，也得到了广泛的运用。本课将基于OpenDNSSEC设计、完成并实现DNSSEC的安全认证技术。', '学习并掌握了有关计算机网络的理论、基本概念和应用的相关知识。\r\n对互联网的发展及RFC文档的功能有基本的了解。\r\n对常用的网络协议分析软件和网络通信仿真软件有基本的了解和应用能力。', '《计算机网络（第7版）》谢希仁\r\nRFC5011', '无', '自由选择', '保密管理', '', 0),
(16, '大数据平台授权模型与访问控制技术研究与实现           ', '毕业设计', '工程实践', '自拟', '小', '易', '许盛伟', '1007', NULL, NULL, NULL, '2', '2', '2', '1', '自由选择', '保密管理', NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `t_func_control`
--

CREATE TABLE `t_func_control` (
  `id` int(8) NOT NULL,
  `topi` int(8) NOT NULL DEFAULT '0',
  `task_book` int(8) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `t_func_control`
--

INSERT INTO `t_func_control` (`id`, `topi`, `task_book`) VALUES
(1, 0, 0);

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
  `permission` varchar(32) COLLATE utf8_bin NOT NULL,
  `special` varchar(32) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `gender`, `grade`, `class`, `major`, `mobile`, `email`, `permission`, `special`) VALUES
('1007', '许盛伟', '123456', '无', '无', '无', '无', '无', '无', 'tutor', 'reviewer'),
('1008', '冯雁', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 'tutor', NULL),
('1009', '刘念', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 'tutor', NULL),
('2007', '答辩秘书', '123456', '无', '无', '无', '无', '无', '无', 'secretary', ''),
('20189203', '邸梓航', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 'student', NULL),
('20189205', '黄铸君', '123456', '男', '研一', '1892', '计算机技术', '15927187255', '956253367@qq.com', 'student', ''),
('20189216', '鲍政李', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 'student', NULL),
('20189218', '冯乾', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 'student', NULL),
('20189219', '黄俊豪', '123', '男', '研一', '1892', '计算机技术', '15907948826', '1257546443@qq.com', 'student', NULL),
('20189230', '杨静怡', '123456', '女', '研一', '1892', '计算机技术', '18811355615', '727728448@qq.com', 'student', NULL),
('admin', '系统管理员', 'admin', '无', '无', '无', '无', '无', '无', 'supermanager', '');

--
-- 转储表的索引
--

--
-- 表的索引 `chose_topic_record`
--
ALTER TABLE `chose_topic_record`
  ADD PRIMARY KEY (`recode_id`);

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
  MODIFY `recode_id` int(32) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `task_book`
--
ALTER TABLE `task_book`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用表AUTO_INCREMENT `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
