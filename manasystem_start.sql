-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2019-04-22 01:02:09
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
(1, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0);

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
(1, 0, 0, NULL);

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
('20189201', '王飞杰', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'student', NULL),
('20189202', '上官慧羽', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'student', NULL),
('20189203', '邸梓航', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'student', NULL),
('20189204', '张博文', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'student', NULL),
('20189205', '黄铸君', '123456', '男', '研一', '1892', '计算机技术', '15927187255', '956253367@qq.com', 0, 'student', ''),
('20189206', '王子臻', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'student', NULL),
('20189210', '牟健', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'student', NULL),
('20189216', '鲍政李', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'student', NULL),
('20189217', '张鸿羽', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'student', NULL),
('20189218', '冯乾', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'student', NULL),
('20189219', '黄俊豪', '123', '男', '研一', '1892', '计算机技术', '15907948826', '1257546443@qq.com', 0, 'student', NULL),
('20189220', '余超', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'student', NULL),
('20189230', '杨静怡', '123456', '女', '研一', '1892', '计算机技术', '18811355615', '727728448@qq.com', 10, 'student', NULL),
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
  MODIFY `record_id` int(32) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `first_paper_record`
--
ALTER TABLE `first_paper_record`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `first_report_record`
--
ALTER TABLE `first_report_record`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `midterm_report`
--
ALTER TABLE `midterm_report`
  MODIFY `record_id` int(32) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `student_grade`
--
ALTER TABLE `student_grade`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `task_book`
--
ALTER TABLE `task_book`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT;

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
