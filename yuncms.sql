-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 05 月 14 日 13:31
-- 服务器版本: 5.1.41
-- PHP 版本: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `yuncms`
--

-- --------------------------------------------------------

--
-- 表的结构 `cms_admin`
--

CREATE TABLE IF NOT EXISTS `cms_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `groupid` tinyint(4) NOT NULL DEFAULT '1',
  `username` char(10) NOT NULL,
  `password` char(32) NOT NULL,
  `realname` char(10) NOT NULL,
  `lastlogin_time` int(10) unsigned NOT NULL,
  `lastlogin_ip` char(15) NOT NULL,
  `iflock` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usename` (`username`),
  KEY `groupid` (`groupid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理员信息表' AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `cms_admin`
--

INSERT INTO `cms_admin` (`id`, `groupid`, `username`, `password`, `realname`, `lastlogin_time`, `lastlogin_ip`, `iflock`) VALUES
(1, 1, 'admin', '168a73655bfecefdb15b14984dd2ad60', '王洋', 1400068652, '192.168.0.114', 0),
(8, 3, 'test', '168a73655bfecefdb15b14984dd2ad60', '测试', 0, '', 0),
(9, 4, '刘明', 'c80a9a5155fd952bc086f08d6b5babe8', '刘明', 1400073601, '192.168.0.109', 0),
(10, 4, '张牧', 'e1135db59e8094f65b19358749f5ba4e', '张牧', 1400069261, '192.168.0.107', 0),
(11, 4, '李鸥鸥', 'c80a9a5155fd952bc086f08d6b5babe8', '李鸥鸥', 0, '', 0),
(12, 4, '田向阳', 'f10d59d24ae0c985037a0fcc1b011fc0', '田向阳', 1400069299, '192.168.0.102', 0),
(13, 4, '肖琼', 'd9db6412229cf7a772a481be7dbeb0d9', '肖琼', 1400068858, '192.168.0.114', 0),
(14, 4, '李文婷', 'ec0ce0ff16f63d0aed06b6740f3bf852', '李文婷', 0, '', 0),
(15, 4, '李睿璇', '0b8af941154b88e3043954d325aec529', '李睿璇', 0, '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `cms_company`
--

CREATE TABLE IF NOT EXISTS `cms_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login_email` varchar(50) NOT NULL COMMENT '公司邮箱',
  `password` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT '公司名称',
  `logo` varchar(100) NOT NULL COMMENT '公司logo',
  `quality` varchar(100) NOT NULL COMMENT '公司性质',
  `scale` varchar(100) NOT NULL COMMENT '公司规模',
  `phone` varchar(30) NOT NULL COMMENT '公司电话',
  `industry` varchar(100) NOT NULL COMMENT '所属行业',
  `on_industry` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL COMMENT '地址',
  `websites` varchar(100) NOT NULL COMMENT '网址',
  `introduce` text NOT NULL COMMENT '简介',
  `ctime` int(11) NOT NULL COMMENT '注册时间',
  `regip` varchar(16) NOT NULL COMMENT 'IP',
  `lasttime` int(11) NOT NULL COMMENT '最后登陆时间',
  `lastip` varchar(16) NOT NULL COMMENT '最后登陆IP',
  `license` varchar(100) NOT NULL COMMENT '公司营业执照',
  `is_active` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否激活',
  `is_init` tinyint(2) NOT NULL COMMENT '是否完善资料',
  `is_auth` tinyint(2) NOT NULL COMMENT '是否认证',
  `recmd` tinyint(2) NOT NULL COMMENT '推荐',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `cms_company`
--

INSERT INTO `cms_company` (`id`, `login_email`, `password`, `name`, `logo`, `quality`, `scale`, `phone`, `industry`, `on_industry`, `address`, `websites`, `introduce`, `ctime`, `regip`, `lasttime`, `lastip`, `license`, `is_active`, `is_init`, `is_auth`, `recmd`) VALUES
(1, '862820606@qq.com', 'df85a226d7e42ef723f21c4c48352b1a', '云作坊', '20140404/thumb_1396624421.png', ',000000,100054,100057', ',000000,100060,100063', '0731-89676708', 's638,s40,s42,s20', '计算机软件+互联网+通信+保险', '长沙理工大学', 'http://wy.yunstudio.net/', '    大学生科技交流平台是一个科技学术交友的平台，并兼有科技交流、名师检索、资料下载、赛事预览、在线报名等功能。 立足于服务学生，以增强在校大学生科技创新与学术交流的氛围为宗旨，以提高大学生的科技创新素质为目标。在线组队，在线交友，在竞争中锻炼自我， 在合作中提升能力。同时加强对科技学术类赛事的管理，提高研究工作实效，推动在校大学生的科技创新活动的开展。 沟通是进步的桥梁，合作是发展的阶梯， 全校的科技学术爱好者齐聚一堂。资料下载、发帖、组队、求名师一气呵成，为我们的科技创新拓宽了视野、提供了空间、觅得了挚友、奠定了基础， 在我们的成功之路上迈出了关键的一步！关注大学生科技交流平台，带给你不一样的精彩。\r\n<br>\r\n<br>\r\n<br>好吧', 0, '', 1399970668, '', '20140404/thumb_1396625120.png', 1, 1, 0, 1),
(2, '4464@qq.com', '6f670965787abc2569acf4317e164117', '百度', 'NoPic.png', ',000000,100054,100057', ',000000,100060,100063', '', 's779,s776,s782,s783', '游戏设备维修+游戏策划+游戏单片机编程+三维动画制作+', '', '', '大百度', 1396581151, 'unknown', 1396581151, 'unknown', '', 1, 0, 0, 1),
(5, '1@qq.com', 'df85a226d7e42ef723f21c4c48352b1a', '腾讯', '20140403/20140403212752_42453.jpg', ',000000,100054,100058', ',000000,100060,100065', '', 's332,s701,s216,s4,s464', '网络营销顾问+电子商务/网店/商城+计算机培训教师+电脑美工+硬件测试+', '长沙理工大学创业园305', 'www.yunstudio.net', '        你好', 1396525138, 'unknown', 1396525138, 'unknown', 'NoPic.gif', 1, 0, 0, 1),
(9, '8@145.com', 'c5328c77ea43ab0bca5d9382b6a32b28', '阿里', 'NoPic.png', ',000000,100054,100056', ',000000,100060,100062', '', 's395,s112,s109', '铸造工+磨工+钳工+', '腾讯', '', '   大公司', 1396581425, 'unknown', 1396581425, 'unknown', '', 1, 0, 0, 0),
(10, '88@145.com', '2c6a35e9dc69c6ab51b46d9fed40db32', '网易', 'NoPic.png', ',000000,100054,100056', ',000000,100060,100063', '', 's419,s514,s517', '测绘技术+培训总监/经理+培训助理+', '', '', '  ', 1396581496, 'unknown', 1396581496, 'unknown', '', 1, 0, 0, 0),
(11, '88487@145.com', 'ae6f2e3e31a29197db07615cc8144247', '360', 'NoPic.png', ',000000,100054,100055', ',000000,100060,100062', '', 's400,s213,s525,s398', 'QE工程师+电器工程师+数码产品开发+PIE工程师+', '', '', '  大公司', 1396581592, 'unknown', 1396581592, 'unknown', '', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cms_company_fans`
--

CREATE TABLE IF NOT EXISTS `cms_company_fans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL COMMENT '会员id',
  `cid` int(11) NOT NULL COMMENT '企业id',
  `score` float NOT NULL COMMENT '会员在该企业下学分值',
  `ctime` int(11) NOT NULL COMMENT '关注时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=78 ;

--
-- 转存表中的数据 `cms_company_fans`
--

INSERT INTO `cms_company_fans` (`id`, `mid`, `cid`, `score`, `ctime`) VALUES
(68, 5, 1, 0, 1397478476),
(67, 5, 5, 0, 1397478476),
(64, 1, 1, 0, 1397230672),
(63, 1, 5, 0, 1397230672),
(65, 33, 5, 0, 1397281522),
(69, 43, 1, 0, 1397982242),
(70, 43, 2, 0, 1397982244),
(71, 43, 5, 0, 1397982246),
(72, 43, 9, 0, 1397982246),
(73, 6, 2, 0, 1397984967),
(76, 6, 1, 0, 1399692800),
(77, 6, 5, 0, 1399692801);

-- --------------------------------------------------------

--
-- 表的结构 `cms_company_recruit`
--

CREATE TABLE IF NOT EXISTS `cms_company_recruit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL COMMENT '企业id',
  `name` varchar(50) NOT NULL COMMENT '岗位名称',
  `city` varchar(100) NOT NULL COMMENT '工作城市',
  `sort` varchar(100) NOT NULL COMMENT '所属行业',
  `money` varchar(100) NOT NULL COMMENT '每月薪水',
  `content` text NOT NULL COMMENT '工作内容和要求:',
  `validity` int(5) NOT NULL COMMENT '有效期',
  `ctime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `cms_company_recruit`
--


-- --------------------------------------------------------

--
-- 表的结构 `cms_feed`
--

CREATE TABLE IF NOT EXISTS `cms_feed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL COMMENT '会员id',
  `fid` int(11) DEFAULT NULL COMMENT '原心情id',
  `fmid` int(11) DEFAULT NULL COMMENT '原心情发布者id',
  `oid` int(11) DEFAULT NULL COMMENT '最开始的心情id',
  `is_audit` int(11) NOT NULL DEFAULT '1' COMMENT '是否审核,0否1是',
  `feed_content` text NOT NULL COMMENT '心情内容',
  `feed_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '动态类型,0原创1评论2转发3回复',
  `comment_count` int(11) NOT NULL DEFAULT '0' COMMENT '评论数',
  `repost_count` int(11) NOT NULL DEFAULT '0' COMMENT '转发数',
  `praise_count` int(11) NOT NULL DEFAULT '0' COMMENT '赞数',
  `ctime` int(11) NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- 转存表中的数据 `cms_feed`
--

INSERT INTO `cms_feed` (`id`, `mid`, `fid`, `fmid`, `oid`, `is_audit`, `feed_content`, `feed_type`, `comment_count`, `repost_count`, `praise_count`, `ctime`) VALUES
(1, 33, -1, -1, -1, 1, '任务板块谈论会议，很激烈呀<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/68/dadadenglong_thumb.gif" height="22" width="22" />', 0, 2, 7, 1, 1399192918),
(2, 5, -1, -1, -1, 1, '明天很美好，今天要努力~~', 0, 0, 1, 0, 1399193823),
(3, 33, 2, 5, 2, 1, '你说的不赖[互粉][囧]', 2, 0, 0, 0, 1399194830),
(4, 5, 1, 33, 1, 1, '看起来好好玩啊', 1, 0, 0, 0, 1399195015),
(7, 33, 5, 5, 5, 1, '怎么不显示表情呢<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/7a/shenshou_thumb.gif" height="22" width="22" />', 1, 0, 0, 0, 1399195116),
(13, 33, 4, 33, 1, 1, '回复蒲精:那是必须的', 3, 0, 0, 0, 1399196706),
(12, 5, 1, 33, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/c9/geili_thumb.gif" height="22" width="22" /><img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/c9/geili_thumb.gif" height="22" width="22" />', 2, 0, 0, 0, 1399196642),
(14, 7, -1, -1, -1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/19/heia_thumb.gif" height="22" width="22" />', 0, 3, 2, 0, 1399274907),
(15, 7, 14, 7, 14, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/a0/kbsa_thumb.gif" height="22" width="22" />', 1, 0, 0, 0, 1399274951),
(26, 33, 14, 7, 14, 1, '好吧', 1, 0, 0, 0, 1399283902),
(37, 33, 14, 7, 14, 1, '评论+转发<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/c9/geili_thumb.gif" height="22" width="22" />', 2, 1, 0, 1, 1399297114),
(33, 43, 1, 33, 1, 1, '你们搞的都不错啊<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/7a/shenshou_thumb.gif" height="22" width="22" />', 2, 0, 0, 0, 1399289939),
(38, 33, 14, 7, 14, 1, '评论+转发<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/c9/geili_thumb.gif" height="22" width="22" />', 1, 0, 0, 0, 1399297114),
(41, 33, -1, -1, -1, 1, '今天很好<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/6a/laugh.gif" height="22" width="22" />', 0, 0, 0, 0, 1399430054),
(40, 33, 37, 33, 37, 1, '再转一次', 1, 0, 0, 0, 1399297227),
(42, 33, -1, -1, -1, 1, '今天糖糖回来啦\n', 0, 0, 0, 0, 1399433020),
(44, 43, -1, -1, -1, 1, '小伙子搞的不赖啊', 0, 2, 8, 0, 1399535942),
(45, 43, 44, 43, 44, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/3f/ltzhuanfa_thumb.gif" height="22" width="22" />', 2, 0, 0, 0, 1399535999),
(46, 43, 44, 43, 44, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/3f/ltzhuanfa_thumb.gif" height="22" width="22" />', 1, 0, 0, 0, 1399535999),
(48, 33, 44, 43, 44, 1, '小伙子确实不赖', 1, 0, 0, 0, 1399536464),
(50, 33, 44, 43, 44, 1, '小伙子确实不赖啊<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/1b/m_thumb.gif" height="22" width="22" />', 2, 0, 0, 0, 1399545582),
(54, 33, 45, 43, 44, 1, '搞的不赖<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/70/vw_thumb.gif" height="22" width="22" />', 2, 0, 0, 0, 1399546122),
(55, 33, -1, -1, -1, 1, '今天任务组会议<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/70/vw_thumb.gif" height="22" width="22" />', 0, 0, 1, 0, 1399549700),
(56, 33, 55, 33, 55, 1, '给力', 2, 0, 0, 0, 1399549729),
(57, 6, -1, -1, -1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/58/mb_thumb.gif" height="22" width="22" />', 0, 0, 0, 0, 1399692712);

-- --------------------------------------------------------

--
-- 表的结构 `cms_feedback`
--

CREATE TABLE IF NOT EXISTS `cms_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `ctime` int(11) NOT NULL,
  `is_reply` tinyint(2) NOT NULL COMMENT '是否回复',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `cms_feedback`
--

INSERT INTO `cms_feedback` (`id`, `content`, `email`, `ctime`, `is_reply`) VALUES
(10, '档案有问题啊', '825075713@qq.com', 1399958003, 0),
(9, '坑马蒂厄', '825075713@qq.com', 1399957941, 0),
(8, '坑爹', '825075713@qq.com', 1399957917, 0),
(7, '师傅的说法', '825075713@qq.com', 1399957873, 0),
(11, '有问题啊', '825075713@qq.com', 1399958025, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cms_feedback_pic`
--

CREATE TABLE IF NOT EXISTS `cms_feedback_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_id` int(11) NOT NULL COMMENT '反馈的id',
  `picture` varchar(200) NOT NULL COMMENT '图片',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `cms_feedback_pic`
--


-- --------------------------------------------------------

--
-- 表的结构 `cms_feed_digg`
--

CREATE TABLE IF NOT EXISTS `cms_feed_digg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL COMMENT '用户uid',
  `feed_id` int(11) NOT NULL COMMENT '心情id',
  `ctime` int(11) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `cms_feed_digg`
--

INSERT INTO `cms_feed_digg` (`id`, `mid`, `feed_id`, `ctime`) VALUES
(3, 33, 37, 1399361771),
(2, 5, 1, 1399196104);

-- --------------------------------------------------------

--
-- 表的结构 `cms_feed_notify`
--

CREATE TABLE IF NOT EXISTS `cms_feed_notify` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `mid` int(11) NOT NULL COMMENT '用户ID',
  `fid` int(11) NOT NULL COMMENT '心情ID',
  `type` tinyint(2) NOT NULL COMMENT '1,赞.2评论.3,转发',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `cms_feed_notify`
--

INSERT INTO `cms_feed_notify` (`id`, `mid`, `fid`, `type`) VALUES
(1, 5, 8, 1),
(2, 33, 1, 1),
(3, 33, 37, 1);

-- --------------------------------------------------------

--
-- 表的结构 `cms_feed_pic`
--

CREATE TABLE IF NOT EXISTS `cms_feed_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `fid` int(11) NOT NULL COMMENT '心情ID',
  `url` varchar(200) NOT NULL COMMENT '地址',
  `thumb_url` varchar(200) NOT NULL COMMENT '缩略图地址',
  `ctime` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `cms_feed_pic`
--

INSERT INTO `cms_feed_pic` (`id`, `fid`, `url`, `thumb_url`, `ctime`) VALUES
(3, 1, '9961399192917.jpg', 'thumb_9961399192917.jpg', 1399192918),
(4, 14, '9271399274902.jpg', 'thumb_9271399274902.jpg', 1399274907),
(6, 44, '5501399535926.gif', 'thumb_5501399535926.gif', 1399535942),
(7, 55, '9521399549694.jpg', 'thumb_9521399549694.jpg', 1399549700),
(8, 57, '7811399692693.jpg', 'thumb_7811399692693.jpg', 1399692712);

-- --------------------------------------------------------

--
-- 表的结构 `cms_fragment`
--

CREATE TABLE IF NOT EXISTS `cms_fragment` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `sign` varchar(255) NOT NULL COMMENT '前台调用标记',
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `cms_fragment`
--

INSERT INTO `cms_fragment` (`id`, `title`, `sign`, `content`) VALUES
(2, '精英人脉圈', 'adtwo', '<span style="white-space:normal;">迅速拓展圈子，打响个人品牌。</span>\r\n<p>\r\n</p>'),
(1, '认证真实度', 'adone', '真实头像+高完整度档案+站内外好友确认，身份可信度多重保证'),
(3, '猎头/HR', 'adthree', '无需专门制作、投递简历，与人才需求方基于信任成为深交'),
(4, '职业/商业机会', 'adfour', '50%+对接中层管理者、20%+与企业家和高管交流的机会。');

-- --------------------------------------------------------

--
-- 表的结构 `cms_group`
--

CREATE TABLE IF NOT EXISTS `cms_group` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `power` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `cms_group`
--

INSERT INTO `cms_group` (`id`, `name`, `power`) VALUES
(1, '超级管理员', '-1'),
(2, '普通管理员', '277,283,1,2,4,5,6,7,8,9,228,10,11,12,13,14,15,16,157,158,174,268,288'),
(3, 'test', '277,283,1,2,4,5,6,7,8,9,228'),
(4, '任务管理员', '277,1,2,6,7,228,328,3,304,305,10,11,12,15,16,157,158,174,288,17,22,23,24,25,26,27,28,29,85,182,245,292,293,296,325,30,31,230,231,234,236,237,251,301,159,188,189,190,229,238,239,240,243,244,267,283,330,331,332,333,334,314,315,316,336,337,338,339,340,341,342,343');

-- --------------------------------------------------------

--
-- 表的结构 `cms_link`
--

CREATE TABLE IF NOT EXISTS `cms_link` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL COMMENT '类型',
  `norder` int(5) NOT NULL COMMENT '排序',
  `name` varchar(30) NOT NULL COMMENT '站点名',
  `url` varchar(40) NOT NULL COMMENT '站点地址',
  `picture` varchar(80) NOT NULL COMMENT '本地logo',
  `logourl` varchar(50) NOT NULL COMMENT '远程logo',
  `siteowner` varchar(30) NOT NULL COMMENT '站点所有者',
  `info` varchar(300) NOT NULL COMMENT '介绍',
  `ispass` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `cms_link`
--

INSERT INTO `cms_link` (`id`, `type`, `norder`, `name`, `url`, `picture`, `logourl`, `siteowner`, `info`, `ispass`) VALUES
(2, 1, 0, '云作坊', 'http://www.yunstudio.net', '20140319/20140319011136_36106.jpg', '', '云作坊', '', 1),
(6, 1, 0, '科技交流平台', 'http://www.kjjlpt.com', '20140319/20140319010853_28083.png', '', '', '', 1),
(8, 1, 0, 'yuncms', 'http://cms.yunstudio.net', '20140319/20140319012016_73229.png', '', '王洋', '', 1),
(9, 1, 0, '中公公务员网', 'http://www.offcn.com/', 'youlink.gif', '', '', '', 1),
(10, 1, 0, '职场问答', 'http://www.kjjlpt.com', 'youlink.gif', '', '', '', 1),
(11, 1, 0, '长理掌上通', 'http://www.kjjlpt.com', 'youlink.gif', '', '', '', 1),
(12, 1, 0, '长沙理工大学', 'http://www.csust.edu.cn/pub/cslgdx/index', 'youlink.gif', '', '', '', 1),
(13, 2, 2, '百度', '', '20140403/20140403094445_90947.jpg', '', '蒲精  UI设计师', '91频道是个能提供给大家提供企业粘合度的大学生交友平台！', 1),
(14, 2, 10, '腾讯', '', '20140403/20140403100400_51336.jpg', '', '王洋  系统架构师', '91频道提供给你不一样的舞台！', 1),
(15, 2, 3, '长沙理工大学', '', '20140403/20140403095346_92158.jpg', '', '田向阳   书记', '在91频道结识的好友都是专业背景、职业履历近似的，大 家讨论的话题很对工作很有帮助，由此也建立起高度互信 的关系。', 1),
(16, 2, 4, '易迅网', '', '20140403/20140403101059_24268.jpg', 'http://www.kjjlpt.com/face/customavatars/000/00/15', '田玉方 资深设计师', '目前的岗位要求需要我更好地提升自己，在91频道可以有的放矢看到很多精英教育资讯展 示，我还获得了优惠的机会！', 1),
(17, 3, 0, '中山大学', '', '20140403/20140403101235_16240.jpg', '', '', '', 1),
(18, 3, 0, '武汉大学', '', '20140403/20140403101442_49092.jpg', '', '', '', 1),
(19, 3, 0, '清华大学', '', '20140403/20140403101501_57974.jpg', '', '', '', 1),
(20, 3, 1, '南京航天航空大学', '', '20140403/20140403101546_20277.jpg', '', '', '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `cms_login_logs`
--

CREATE TABLE IF NOT EXISTS `cms_login_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(2) NOT NULL COMMENT '1：会员2：企业',
  `uid` int(11) NOT NULL COMMENT '登陆者id,包括会员和企业',
  `ip` varchar(15) NOT NULL COMMENT '登陆ip',
  `ctime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=359 ;

--
-- 转存表中的数据 `cms_login_logs`
--

INSERT INTO `cms_login_logs` (`id`, `type`, `uid`, `ip`, `ctime`) VALUES
(1, 1, 1, 'unknown', 1395761877),
(2, 1, 1, 'unknown', 1395764787),
(3, 1, 1, 'unknown', 1395765079),
(4, 1, 1, 'unknown', 1395765243),
(5, 1, 1, 'unknown', 1395799315),
(6, 1, 1, 'unknown', 1395799511),
(7, 1, 1, 'unknown', 1395799519),
(8, 1, 1, 'unknown', 1395800568),
(9, 1, 1, 'unknown', 1395800859),
(10, 1, 1, 'unknown', 1395801469),
(11, 1, 1, 'unknown', 1396102157),
(12, 1, 1, 'unknown', 1396146553),
(13, 1, 1, 'unknown', 1396157713),
(14, 1, 1, 'unknown', 1396157792),
(15, 1, 1, 'unknown', 1396158018),
(16, 1, 1, 'unknown', 1396161875),
(17, 1, 1, 'unknown', 1396229371),
(18, 1, 1, 'unknown', 0),
(19, 1, 1, 'unknown', 1396238260),
(20, 1, 1, 'unknown', 1396238282),
(21, 1, 1, 'unknown', 1396238415),
(22, 1, 1, 'unknown', 1396238496),
(23, 1, 1, 'unknown', 1396238532),
(24, 1, 1, 'unknown', 1396240201),
(25, 1, 1, 'unknown', 1396250457),
(26, 1, 1, 'unknown', 1396267409),
(27, 1, 1, 'unknown', 1396269864),
(28, 2, 2, 'unknown', 1396270676),
(29, 2, 2, 'unknown', 1396270845),
(30, 1, 1, 'unknown', 1396271609),
(31, 2, 2, 'unknown', 1396271626),
(32, 2, 2, 'unknown', 1396271970),
(33, 2, 2, 'unknown', 1396272001),
(34, 2, 2, 'unknown', 1396272009),
(35, 2, 2, 'unknown', 1396272302),
(36, 2, 2, 'unknown', 1396272379),
(37, 2, 2, 'unknown', 1396272555),
(38, 1, 1, 'unknown', 1396273873),
(41, 2, 1, 'unknown', 1396279358),
(40, 1, 1, 'unknown', 1396278486),
(42, 2, 1, 'unknown', 1396352645),
(43, 2, 1, 'unknown', 1396366757),
(44, 2, 1, 'unknown', 1396494403),
(45, 2, 1, 'unknown', 1396581969),
(46, 2, 1, 'unknown', 1396596282),
(47, 2, 1, 'unknown', 1396596598),
(48, 2, 1, 'unknown', 1396596647),
(49, 2, 1, 'unknown', 1396596734),
(50, 2, 1, 'unknown', 1396596785),
(51, 2, 1, 'unknown', 1396617296),
(52, 2, 1, 'unknown', 1396622707),
(53, 2, 1, 'unknown', 1396625578),
(54, 2, 1, 'unknown', 1396662117),
(55, 2, 1, 'unknown', 1396662160),
(56, 2, 1, 'unknown', 1396662195),
(57, 1, 33, 'unknown', 1396663309),
(58, 2, 1, 'unknown', 1396685977),
(59, 1, 33, 'unknown', 1396685995),
(60, 1, 33, 'unknown', 1396686019),
(61, 1, 33, 'unknown', 1396700877),
(62, 1, 33, 'unknown', 1396859670),
(63, 2, 1, 'unknown', 1396861475),
(64, 2, 1, 'unknown', 1396871705),
(65, 2, 1, 'unknown', 1396878341),
(66, 2, 1, 'unknown', 1396882267),
(67, 1, 33, 'unknown', 1396882289),
(68, 2, 1, 'unknown', 1396885450),
(69, 2, 1, 'unknown', 1396889044),
(70, 2, 1, 'unknown', 1396922008),
(71, 2, 1, 'unknown', 1396957987),
(72, 1, 33, 'unknown', 1397137478),
(73, 1, 33, 'unknown', 1397138671),
(74, 2, 1, 'unknown', 1397150935),
(75, 2, 1, 'unknown', 1397151848),
(76, 1, 33, 'unknown', 1397179355),
(77, 1, 33, 'unknown', 1397182081),
(78, 1, 33, 'unknown', 1397182114),
(79, 1, 33, 'unknown', 1397202448),
(80, 2, 1, 'unknown', 1397227143),
(81, 1, 33, 'unknown', 1397227433),
(82, 1, 33, 'unknown', 1397227734),
(83, 1, 1, 'unknown', 1397230586),
(84, 1, 33, 'unknown', 1397231553),
(85, 1, 33, 'unknown', 1397232217),
(86, 1, 33, 'unknown', 1397265440),
(87, 1, 33, 'unknown', 1397266044),
(88, 1, 33, 'unknown', 1397266092),
(89, 1, 33, 'unknown', 1397272533),
(90, 1, 33, 'unknown', 1397273533),
(91, 1, 33, 'unknown', 1397276525),
(92, 1, 33, 'unknown', 1397278244),
(93, 1, 33, 'unknown', 1397280027),
(94, 1, 33, 'unknown', 1397281517),
(95, 1, 33, 'unknown', 1397301731),
(96, 1, 33, 'unknown', 1397301774),
(97, 2, 1, 'unknown', 1397306681),
(98, 2, 1, 'unknown', 1397306762),
(99, 1, 33, 'unknown', 1397307513),
(100, 2, 1, 'unknown', 1397308649),
(101, 1, 33, 'unknown', 1397317079),
(102, 1, 33, 'unknown', 1397353669),
(103, 2, 1, 'unknown', 1397354263),
(104, 1, 33, 'unknown', 1397355165),
(105, 1, 33, 'unknown', 1397363011),
(106, 1, 33, 'unknown', 1397374189),
(107, 1, 33, 'unknown', 1397378065),
(108, 2, 1, 'unknown', 1397379385),
(109, 2, 1, 'unknown', 1397379419),
(110, 1, 33, 'unknown', 1397379601),
(111, 1, 33, 'unknown', 1397379615),
(112, 1, 33, 'unknown', 1397384263),
(113, 1, 33, 'unknown', 1397385678),
(114, 1, 33, 'unknown', 1397385870),
(115, 1, 33, 'unknown', 1397386485),
(116, 1, 33, 'unknown', 1397389338),
(117, 1, 33, 'unknown', 1397389464),
(118, 2, 1, 'unknown', 1397390038),
(119, 2, 1, 'unknown', 1397390109),
(120, 1, 33, 'unknown', 1397390115),
(121, 2, 1, 'unknown', 1397390128),
(122, 1, 33, 'unknown', 1397390458),
(123, 1, 33, 'unknown', 1397390489),
(124, 1, 33, 'unknown', 1397391288),
(125, 1, 33, 'unknown', 1397398887),
(126, 1, 33, 'unknown', 1397401656),
(127, 1, 33, 'unknown', 1397452801),
(128, 1, 33, 'unknown', 1397469358),
(129, 1, 5, 'unknown', 1397473633),
(130, 1, 6, 'unknown', 1397476313),
(131, 1, 7, 'unknown', 1397476412),
(132, 1, 8, 'unknown', 1397476609),
(133, 1, 43, 'unknown', 1397476637),
(134, 1, 44, 'unknown', 1397476663),
(135, 1, 5, 'unknown', 1397477045),
(136, 1, 33, 'unknown', 1397483434),
(137, 1, 6, 'unknown', 1397484234),
(138, 1, 33, 'unknown', 1397491879),
(139, 2, 1, 'unknown', 1397525227),
(140, 1, 33, 'unknown', 1397525249),
(141, 1, 5, 'unknown', 1397544862),
(142, 1, 6, 'unknown', 1397545171),
(143, 1, 5, 'unknown', 1397547491),
(144, 1, 6, 'unknown', 1397548435),
(145, 1, 7, 'unknown', 1397551422),
(146, 1, 33, 'unknown', 1397565549),
(147, 1, 33, 'unknown', 1397614820),
(148, 1, 33, 'unknown', 1397637894),
(149, 1, 33, 'unknown', 1397638484),
(150, 1, 5, 'unknown', 1397639719),
(151, 1, 33, 'unknown', 1397647855),
(152, 2, 1, 'unknown', 1397648424),
(153, 1, 33, 'unknown', 1397648478),
(154, 1, 43, 'unknown', 1397649461),
(155, 1, 33, 'unknown', 1397655626),
(156, 1, 33, 'unknown', 1397659081),
(157, 1, 33, 'unknown', 1397697342),
(158, 1, 33, 'unknown', 1397697650),
(159, 1, 44, 'unknown', 1397703108),
(160, 1, 5, 'unknown', 1397721129),
(161, 1, 44, 'unknown', 1397725099),
(162, 2, 1, 'unknown', 1397725846),
(163, 1, 33, 'unknown', 1397725971),
(164, 1, 5, 'unknown', 1397726050),
(165, 1, 33, 'unknown', 1397726172),
(166, 2, 1, 'unknown', 1397726535),
(167, 1, 33, 'unknown', 1397732632),
(168, 1, 7, 'unknown', 1397732989),
(169, 1, 33, 'unknown', 1397736935),
(170, 1, 33, 'unknown', 1397745137),
(171, 1, 33, 'unknown', 1397747179),
(172, 1, 33, 'unknown', 1397782588),
(173, 1, 5, 'unknown', 1397793626),
(174, 1, 33, 'unknown', 1397805378),
(175, 1, 43, 'unknown', 1397805423),
(176, 1, 8, 'unknown', 1397805623),
(177, 1, 33, 'unknown', 1397875756),
(178, 1, 33, 'unknown', 1397878024),
(179, 1, 5, 'unknown', 1397878951),
(180, 1, 33, 'unknown', 1397885229),
(181, 1, 8, 'unknown', 1397885935),
(182, 1, 33, 'unknown', 1397891145),
(183, 1, 33, 'unknown', 1397908919),
(184, 1, 5, 'unknown', 1397910449),
(185, 1, 33, 'unknown', 1397957640),
(186, 1, 7, 'unknown', 1397960567),
(187, 1, 33, 'unknown', 1397962187),
(188, 1, 43, '192.168.0.104', 1397963944),
(189, 1, 33, 'unknown', 1397964516),
(190, 1, 33, 'unknown', 1397964608),
(191, 1, 43, 'unknown', 1397971925),
(192, 1, 44, 'unknown', 1397972368),
(193, 1, 33, 'unknown', 1397973145),
(194, 1, 33, 'unknown', 1397979461),
(195, 1, 33, '192.168.0.112', 1397979913),
(196, 1, 8, '192.168.0.113', 1397979947),
(197, 1, 8, '192.168.0.113', 1397980510),
(198, 1, 33, '192.168.0.112', 1397980561),
(199, 1, 8, '192.168.0.113', 1397980596),
(200, 1, 8, '192.168.0.113', 1397980825),
(201, 1, 44, '192.168.0.109', 1397981573),
(202, 1, 33, 'unknown', 1397981965),
(203, 1, 43, '192.168.0.104', 1397982142),
(204, 1, 7, '192.168.0.106', 1397982578),
(205, 1, 6, '192.168.0.108', 1397984570),
(206, 1, 6, '192.168.0.108', 1397984683),
(207, 1, 8, '192.168.0.113', 1397986047),
(208, 1, 33, 'unknown', 1398047709),
(209, 1, 33, 'unknown', 1398049303),
(210, 1, 33, 'unknown', 1398050621),
(211, 1, 33, 'unknown', 1398051610),
(212, 1, 33, 'unknown', 1398051667),
(213, 1, 33, 'unknown', 1398068064),
(214, 1, 33, 'unknown', 1398068155),
(215, 1, 33, 'unknown', 1398068698),
(216, 1, 33, 'unknown', 1398148495),
(217, 1, 43, 'unknown', 1398152207),
(218, 1, 5, 'unknown', 1398167835),
(219, 1, 6, 'unknown', 1398169370),
(220, 1, 33, 'unknown', 1398228162),
(221, 1, 5, 'unknown', 1398228535),
(222, 1, 43, 'unknown', 1398228825),
(223, 1, 43, '192.168.0.109', 1398244271),
(224, 1, 43, '192.168.0.109', 1398254408),
(225, 1, 6, '192.168.0.105', 1398255100),
(226, 1, 6, '192.168.0.105', 1398255318),
(227, 2, 1, '192.168.0.105', 1398255514),
(228, 2, 1, '192.168.0.105', 1398256170),
(229, 1, 33, 'unknown', 1398260150),
(230, 1, 33, 'unknown', 1398404288),
(231, 1, 33, '192.168.0.112', 1398412270),
(232, 1, 33, 'unknown', 1398413083),
(233, 1, 33, 'unknown', 1398432592),
(234, 1, 33, 'unknown', 1398476883),
(235, 1, 33, 'unknown', 1398478252),
(236, 1, 33, 'unknown', 1398497537),
(237, 1, 33, 'unknown', 1398502034),
(238, 1, 5, 'unknown', 1398502777),
(239, 1, 33, 'unknown', 1398511452),
(240, 1, 44, 'unknown', 1398511914),
(241, 1, 6, 'unknown', 1398518076),
(242, 1, 5, 'unknown', 1398519230),
(243, 1, 44, 'unknown', 1398519390),
(244, 1, 33, 'unknown', 1398684205),
(245, 1, 43, 'unknown', 1398684332),
(246, 1, 33, 'unknown', 1398684350),
(247, 1, 33, 'unknown', 1398745684),
(248, 1, 5, 'unknown', 1398748866),
(249, 1, 33, 'unknown', 1398750628),
(250, 1, 7, 'unknown', 1398751229),
(251, 1, 43, 'unknown', 1398751413),
(252, 1, 44, 'unknown', 1398751458),
(253, 1, 33, 'unknown', 1398755610),
(254, 2, 1, 'unknown', 1398758605),
(255, 1, 33, 'unknown', 1398759196),
(256, 2, 1, 'unknown', 1398761598),
(257, 1, 33, 'unknown', 1398768048),
(258, 1, 33, 'unknown', 1398771084),
(259, 1, 33, 'unknown', 1398859989),
(260, 1, 33, 'unknown', 1398862356),
(261, 1, 33, 'unknown', 1398922211),
(262, 1, 33, 'unknown', 1398926767),
(263, 1, 33, 'unknown', 1398936376),
(264, 1, 33, 'unknown', 1398938150),
(265, 1, 33, 'unknown', 1398938977),
(266, 1, 33, 'unknown', 1398939011),
(267, 1, 5, 'unknown', 1398945733),
(268, 1, 5, 'unknown', 1398946324),
(269, 1, 33, 'unknown', 1399008945),
(270, 1, 33, 'unknown', 1399009475),
(271, 1, 33, 'unknown', 1399014322),
(272, 1, 33, 'unknown', 1399033569),
(273, 1, 33, 'unknown', 1399092991),
(274, 1, 5, 'unknown', 1399095892),
(275, 1, 33, 'unknown', 1399095920),
(276, 1, 33, 'unknown', 1399108574),
(277, 1, 33, 'unknown', 1399181644),
(278, 1, 5, 'unknown', 1399183336),
(279, 1, 6, 'unknown', 1399190804),
(280, 1, 7, 'unknown', 1399190852),
(281, 1, 43, 'unknown', 1399191067),
(282, 1, 8, 'unknown', 1399191099),
(283, 1, 6, 'unknown', 1399191127),
(284, 1, 44, 'unknown', 1399191222),
(285, 1, 5, 'unknown', 1399191357),
(286, 1, 33, 'unknown', 1399192975),
(287, 1, 33, 'unknown', 1399198488),
(288, 1, 33, 'unknown', 1399201305),
(289, 1, 5, 'unknown', 1399201611),
(290, 1, 33, 'unknown', 1399254994),
(291, 1, 33, 'unknown', 1399272066),
(292, 1, 7, '192.168.0.108', 1399274847),
(293, 1, 6, '192.168.0.107', 1399275295),
(294, 1, 33, 'unknown', 1399276254),
(295, 1, 33, 'unknown', 1399288393),
(296, 1, 43, 'unknown', 1399289913),
(297, 1, 6, 'unknown', 1399290570),
(298, 1, 33, 'unknown', 1399290590),
(299, 1, 6, 'unknown', 1399290613),
(300, 1, 33, 'unknown', 1399295625),
(301, 1, 33, 'unknown', 1399296061),
(302, 1, 33, 'unknown', 1399357363),
(303, 1, 33, 'unknown', 1399357383),
(304, 1, 33, 'unknown', 1399426674),
(305, 1, 33, 'unknown', 1399432269),
(306, 1, 33, 'unknown', 1399442235),
(307, 1, 33, 'unknown', 1399445312),
(308, 1, 33, 'unknown', 1399531380),
(309, 1, 43, '192.168.0.110', 1399531952),
(310, 1, 7, '192.168.0.108', 1399534794),
(311, 1, 33, 'unknown', 1399535130),
(312, 1, 6, '192.168.0.107', 1399535627),
(313, 1, 43, '192.168.0.110', 1399536305),
(314, 1, 33, 'unknown', 1399539715),
(315, 1, 33, 'unknown', 1399544823),
(316, 1, 33, 'unknown', 1399546223),
(317, 1, 33, 'unknown', 1399548037),
(318, 1, 33, '192.168.0.106', 1399549042),
(319, 1, 33, 'unknown', 1399549099),
(320, 1, 33, '192.168.0.106', 1399549484),
(321, 1, 8, '192.168.0.106', 1399549937),
(322, 1, 33, '192.168.0.106', 1399550001),
(323, 1, 33, 'unknown', 1399617703),
(324, 1, 33, 'unknown', 1399619608),
(325, 1, 33, 'unknown', 1399619966),
(326, 1, 5, 'unknown', 1399621585),
(327, 1, 46, '192.168.0.122', 1399627714),
(328, 1, 33, 'unknown', 1399627870),
(329, 1, 8, '192.168.0.106', 1399633051),
(330, 1, 33, 'unknown', 1399642006),
(331, 1, 33, 'unknown', 1399642301),
(332, 1, 6, '192.168.0.107', 1399692626),
(333, 1, 8, '192.168.0.106', 1399706498),
(334, 1, 33, 'unknown', 1399708682),
(335, 1, 33, 'unknown', 1399710934),
(336, 1, 8, '192.168.0.106', 1399711028),
(337, 1, 8, '192.168.0.106', 1399713915),
(338, 1, 6, 'unknown', 1399721506),
(339, 1, 33, 'unknown', 1399722588),
(340, 2, 1, 'unknown', 1399723115),
(341, 1, 33, 'unknown', 1399882763),
(342, 1, 33, 'unknown', 1399889079),
(343, 1, 33, 'unknown', 1399891891),
(344, 1, 33, 'unknown', 1399949567),
(345, 1, 33, 'unknown', 1399954810),
(346, 1, 33, 'unknown', 1399959535),
(347, 2, 1, 'unknown', 1399966502),
(348, 1, 33, 'unknown', 1399968414),
(349, 2, 1, 'unknown', 1399968942),
(350, 1, 33, 'unknown', 1399968995),
(351, 2, 1, 'unknown', 1399969502),
(352, 1, 33, 'unknown', 1399969681),
(353, 2, 1, 'unknown', 1399970668),
(354, 1, 33, 'unknown', 1399972314),
(355, 1, 33, 'unknown', 1399985342),
(356, 1, 8, '192.168.0.102', 1399988447),
(357, 1, 33, 'unknown', 1400049277),
(358, 1, 33, 'unknown', 1400061356);

-- --------------------------------------------------------

--
-- 表的结构 `cms_member`
--

CREATE TABLE IF NOT EXISTS `cms_member` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `login_email` varchar(30) NOT NULL COMMENT '登陆邮箱',
  `password` varchar(60) NOT NULL,
  `uname` varchar(30) NOT NULL COMMENT '用户名',
  `first_letter` char(1) NOT NULL COMMENT '用户名称的首字母',
  `ctime` int(11) NOT NULL,
  `regip` varchar(16) NOT NULL,
  `lasttime` int(11) NOT NULL,
  `lastip` varchar(15) NOT NULL,
  `is_active` tinyint(1) NOT NULL COMMENT '是否激活',
  `is_init` tinyint(1) NOT NULL COMMENT '是否初始化用户资料',
  `last_feed_id` int(11) NOT NULL COMMENT '最后发表心情id',
  `last_feed_time` int(11) NOT NULL COMMENT '最后发表心情时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- 转存表中的数据 `cms_member`
--

INSERT INTO `cms_member` (`id`, `login_email`, `password`, `uname`, `first_letter`, `ctime`, `regip`, `lasttime`, `lastip`, `is_active`, `is_init`, `last_feed_id`, `last_feed_time`) VALUES
(1, 'yunstudio2012@qq.com', 'd707c24bd27660ca7d65870027fb9218', 'admin', 'a', 1372135503, '', 1397230586, '', 1, 0, 0, 0),
(33, '825075713@qq.com', 'df85a226d7e42ef723f21c4c48352b1a', '王洋', 'W', 1396279141, '', 1400061356, '', 1, 0, 0, 0),
(5, '1161499602@qq.com', 'df85a226d7e42ef723f21c4c48352b1a', '蒲精', 'P', 1395580185, '', 1399621585, '', 1, 0, 0, 0),
(6, '1095620719@qq.com', 'df85a226d7e42ef723f21c4c48352b1a', '唐娜', 'T', 1395581194, '', 1399721506, '', 1, 0, 0, 0),
(7, '1103349641@qq.com', 'df85a226d7e42ef723f21c4c48352b1a', '赵杰', 'Z', 1395581233, '', 1399534794, '', 1, 0, 0, 0),
(8, '113771910@qq.com', 'df85a226d7e42ef723f21c4c48352b1a', '田向阳', 'T', 1395581267, '', 1399988447, '', 1, 0, 0, 0),
(43, 'tianyufang@qq.com', 'df85a226d7e42ef723f21c4c48352b1a', '田玉方', 'T', 1397473278, '', 1399536305, '', 1, 0, 0, 0),
(44, '1085195131@qq.com', 'df85a226d7e42ef723f21c4c48352b1a', '易武', 'Y', 1397473574, '', 1399191222, '', 1, 0, 0, 0),
(46, 'jiayouxuning@126.com', '1151d6a7c36588031a69dbd6dec10686', '徐宁', 'X', 1399626848, '192.168.0.122', 1399627714, '192.168.0.122', 1, 0, 0, 0),
(47, '591259573@qq.com', 'e947df9b9c75758ff497f8b031c019b8', '李鸥鸥', 'L', 1399636615, '192.168.0.106', 1399636615, '192.168.0.106', 1, 0, 0, 0),
(48, '842370156@qq.com', '3f81740f650c59d075fa49497e228361', '张牧', 'Z', 1399639078, '192.168.0.112', 1399639078, '192.168.0.112', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cms_member_card`
--

CREATE TABLE IF NOT EXISTS `cms_member_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `send_id` int(11) NOT NULL COMMENT '发送申请人id',
  `rece_id` int(11) NOT NULL COMMENT '接受者id',
  `status` tinyint(2) NOT NULL COMMENT '1：等待确认2：成功',
  `remark` varchar(15) NOT NULL COMMENT '备注信息',
  `ctime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

--
-- 转存表中的数据 `cms_member_card`
--

INSERT INTO `cms_member_card` (`id`, `send_id`, `rece_id`, `status`, `remark`, `ctime`) VALUES
(66, 44, 6, 2, '', 1399276183),
(83, 5, 82, 1, '', 1399201614),
(95, 33, 46, 1, '', 1399628087),
(20, 5, 44, 1, '', 1397726157),
(21, 5, 6, 2, '', 1397726159),
(73, 33, 72, 1, '', 1398519151),
(99, 33, 43, 1, '', 1399719165),
(48, 43, 5, 2, '', 1398519363),
(49, 43, 6, 2, '', 1397964097),
(50, 43, 7, 2, '', 1397964098),
(51, 43, 8, 2, '', 1399633098),
(52, 43, 44, 1, '', 1397964102),
(67, 44, 7, 1, '', 1397981788),
(68, 33, 8, 2, '', 1399549945),
(69, 6, 7, 1, '', 1397984706),
(75, 5, 74, 1, '', 1398519258),
(76, 5, 48, 1, '', 1398519363),
(78, 33, 77, 1, '', 1398684266),
(96, 33, 7, 1, '', 1399628185),
(81, 33, 80, 1, '', 1398751249),
(84, 6, 66, 1, '', 1399276183),
(85, 33, 79, 1, '', 1399432332),
(86, 8, 68, 1, '', 1399549945),
(100, 6, 33, 2, '', 1399721529),
(98, 6, 0, 1, '', 1399693790);

-- --------------------------------------------------------

--
-- 表的结构 `cms_member_card_group`
--

CREATE TABLE IF NOT EXISTS `cms_member_card_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '创建者id',
  `name` varchar(15) NOT NULL COMMENT '组名',
  `ctime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `cms_member_card_group`
--


-- --------------------------------------------------------

--
-- 表的结构 `cms_member_card_group_link`
--

CREATE TABLE IF NOT EXISTS `cms_member_card_group_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `follow_group_id` int(11) NOT NULL COMMENT '关注组id',
  `fid` int(11) NOT NULL COMMENT '被关注者id',
  `mid` int(11) NOT NULL COMMENT '关注者id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `cms_member_card_group_link`
--


-- --------------------------------------------------------

--
-- 表的结构 `cms_member_check`
--

CREATE TABLE IF NOT EXISTS `cms_member_check` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `con_num` int(11) NOT NULL COMMENT '连续签到次数',
  `total_num` int(11) NOT NULL COMMENT '总签到次数',
  `ctime` int(11) NOT NULL COMMENT '签到时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `cms_member_check`
--


-- --------------------------------------------------------

--
-- 表的结构 `cms_member_gold`
--

CREATE TABLE IF NOT EXISTS `cms_member_gold` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL COMMENT '用户id',
  `gold` int(11) NOT NULL COMMENT '91币总值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `cms_member_gold`
--


-- --------------------------------------------------------

--
-- 表的结构 `cms_member_group`
--

CREATE TABLE IF NOT EXISTS `cms_member_group` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(30) NOT NULL,
  `notallow` text NOT NULL,
  `user_group_icon` varchar(120) NOT NULL COMMENT ' 用户组图标名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `cms_member_group`
--

INSERT INTO `cms_member_group` (`id`, `group_name`, `notallow`, `user_group_icon`) VALUES
(6, '普通会员', 'yun', '05.gif'),
(4, '超级会员', '', '03.gif'),
(2, '新手上路', '', '02.gif'),
(8, '高级会员', '', '07.gif'),
(10, '测试分组', '', '0');

-- --------------------------------------------------------

--
-- 表的结构 `cms_member_group_link`
--

CREATE TABLE IF NOT EXISTS `cms_member_group_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '会员id',
  `user_group_id` int(11) NOT NULL COMMENT '会员组id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- 转存表中的数据 `cms_member_group_link`
--

INSERT INTO `cms_member_group_link` (`id`, `uid`, `user_group_id`) VALUES
(1, 1, 4),
(9, 33, 2),
(4, 5, 2),
(5, 6, 2),
(6, 7, 2),
(7, 8, 2),
(20, 44, 2),
(19, 43, 2),
(22, 46, 2),
(23, 47, 2),
(24, 48, 2);

-- --------------------------------------------------------

--
-- 表的结构 `cms_member_login`
--

CREATE TABLE IF NOT EXISTS `cms_member_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(2) NOT NULL COMMENT '1是学生2是企业',
  `mid` int(11) NOT NULL COMMENT '会员id',
  `weibo_key` varchar(100) NOT NULL COMMENT '微博key',
  `token` varchar(50) NOT NULL COMMENT '账号激活码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- 转存表中的数据 `cms_member_login`
--

INSERT INTO `cms_member_login` (`id`, `type`, `mid`, `weibo_key`, `token`) VALUES
(6, 1, 1, '2.0013nXHC08XTmOad0f0ea1aeS92HDD', ''),
(28, 1, 34, '', '4f841e6731e00c00306b070f183c58f8'),
(29, 1, 35, '', 'ce9dd3f2d80e6955d3e732915f00d992'),
(27, 2, 4, '', '870a83659c581c8675ac7da91a3ba794'),
(30, 1, 36, '', '3017210f049e5153c10f1a1788f76561'),
(31, 1, 37, '', '709a01e425cabca6d0f6b7c983e7fa52'),
(32, 1, 38, '', '32d7582269e37e8afdafc9deab8a9758'),
(33, 1, 39, '', '84abf35bff3a04a854cbece00450a1fe'),
(34, 1, 40, '', 'b576c6d37bff966f74caa11ae6621f11'),
(35, 1, 41, '', 'a0b2b06e136830f69d8d2511727c6fde'),
(36, 2, 5, '', '5e6d055cff851ae9a62d754cdf990fe8'),
(37, 2, 6, '', 'ef9246f8e9630b64f4d87db154c24f17'),
(38, 2, 7, '', '93d3fc0400d4a439469411ffe85038f4'),
(39, 2, 8, '', '06314da474c8cb36d1724daf0e3987c4'),
(40, 2, 9, '', 'afa9f739298d5e18b3e241c553c5c201'),
(41, 2, 10, '', '9dc4b93e39fb640fb3849837c1b61955'),
(42, 2, 11, '', '748aa180e88f082056090250455f72bb'),
(44, 1, 46, '', 'e7d2d9dc8a32229f145798f63b926a05'),
(45, 1, 47, '', '0411e34f6fa3f5a2bd5e3dc7473b97a8'),
(46, 1, 48, '', 'd5c770d3f3402031cf1afccf9fa72be6');

-- --------------------------------------------------------

--
-- 表的结构 `cms_member_profile`
--

CREATE TABLE IF NOT EXISTS `cms_member_profile` (
  `mid` int(20) NOT NULL COMMENT 'member表的id外键',
  `sex` tinyint(1) NOT NULL COMMENT '1男2女',
  `location` varchar(80) NOT NULL COMMENT '籍贯',
  `school` varchar(50) NOT NULL COMMENT '学校',
  `qq` varchar(20) NOT NULL COMMENT '联系方式',
  `tel` varchar(11) NOT NULL COMMENT '电话',
  `city` varchar(30) DEFAULT NULL COMMENT '所在城市',
  `major` varchar(20) NOT NULL COMMENT '专业',
  `major_type` varchar(40) DEFAULT NULL COMMENT '专业类别',
  `education` varchar(10) DEFAULT NULL COMMENT '学历',
  `start_time` int(11) NOT NULL COMMENT '入学时间',
  `end_time` int(11) NOT NULL COMMENT '毕业时间',
  `interest` text COMMENT '兴趣',
  `skill` text COMMENT '专长',
  `honour` text COMMENT '所获荣誉',
  `introduce` text NOT NULL COMMENT '关于我',
  FULLTEXT KEY `skill` (`skill`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='档案表';

--
-- 转存表中的数据 `cms_member_profile`
--

INSERT INTO `cms_member_profile` (`mid`, `sex`, `location`, `school`, `qq`, `tel`, `city`, `major`, `major_type`, `education`, `start_time`, `end_time`, `interest`, `skill`, `honour`, `introduce`) VALUES
(33, 1, '安徽,合肥', '长沙理工大学', '825075713', '14789998264', '湖南,长沙', '计算机科学与技术', '经济学,经济学相关类', '1', 1314806400, 1435680000, '招聘,兼职,找投资,投资项目,商务活动', 'linux,编程,php,mysql', NULL, '云作坊网络开发团队主管，开发了以《大学生科技交流平台》为核心的自主产品，科技立项一等奖，挑战杯校二等奖，创新实验项目。探索 出自主项目为主，商业项目为辅的团队发展模式。长沙理工大学第二届十佳自强之星，优秀毕业生。'),
(43, 1, '湖北,恩施', '长沙理工大学', '137244230', '18373137187', '湖南,长沙', '数字媒体艺术', '文学,艺术相关类', '3', 1314806400, 1435680000, NULL, NULL, NULL, '我是91频道的'),
(44, 1, '湖南,岳阳', '长沙理工大学', '1085195131', '15574873872', '湖南,长沙', '计算机', '工学,网络工程相关类', '3', 1347206400, 1397923200, NULL, NULL, NULL, ''),
(8, 1, '贵州,遵义', '长沙理工大学', '113771910', '13517494496', '湖南,长沙', '汉语言文学', '文学,中国语言文学相关类', '3', 568656000, 694627200, NULL, NULL, NULL, '柴米油盐酱醋茶，琴棋书画诗酒花'),
(7, 0, '', '长沙理工大学', '', '', NULL, '计算机科学与技术', '工学,计算机相关类', '3', 979574400, 1484064000, NULL, NULL, NULL, ''),
(6, 1, '湖南,株洲', '西南交大', '1095620719', '15507482673', '湖南,长沙', '计算机科学与技术', '历史学,历史学相关类', '3', 1315065600, 1263830400, NULL, NULL, NULL, '从事财务工作6年，其中2年管理经验，4年的外资全盘账务处理经验。擅长精确核算收入、成本利润。对进出口医疗卫浴、IT、旅游等行业的税务政策及工作都非常熟悉。'),
(5, 0, '江西,南昌', '北京大学', '4545', '1223', '湖南,长沙', '计算机', '经济学,财政学相关类', '3', -30268800, 1925481600, NULL, NULL, NULL, '我是长沙理工大学蒲精。'),
(45, 0, '', '', '', '', NULL, '', NULL, NULL, 0, 0, NULL, NULL, NULL, ''),
(46, 1, '黑龙江,黑河', '长沙理工大学', '619572606', '13667377194', '湖南,长沙', '港口航道与海岸工程', '工学,水利相关类', '3', 1283270400, 1404144000, NULL, NULL, NULL, '大学期间参加云作坊网络开发团队'),
(47, 0, '', '', '', '', NULL, '', NULL, NULL, 0, 0, NULL, NULL, NULL, ''),
(48, 0, '', '', '', '', NULL, '', NULL, NULL, 0, 0, NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- 表的结构 `cms_member_tag`
--

CREATE TABLE IF NOT EXISTS `cms_member_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL COMMENT '用户id',
  `tid` varchar(100) NOT NULL COMMENT '标签id，-1是自定义',
  `name` varchar(20) NOT NULL COMMENT '标签名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=114 ;

--
-- 转存表中的数据 `cms_member_tag`
--

INSERT INTO `cms_member_tag` (`id`, `mid`, `tid`, `name`) VALUES
(82, 33, '-1', 'php'),
(81, 33, '100085', '办公自动化'),
(80, 33, '100082', '市场拓展'),
(94, 43, '100101', '领导力'),
(93, 43, '100097', '精通互联网'),
(83, 33, '-1', 'asp'),
(40, 5, '100087', '逻辑分析'),
(41, 5, '100081', '商务谈判'),
(42, 5, '100089', '创新能力'),
(43, 5, '100091', 'photoshop'),
(112, 6, '100082', '市场拓展'),
(113, 6, '100091', 'photoshop'),
(90, 43, '100104', 'flash'),
(76, 6, '100106', 'access'),
(84, 33, '-1', '.net'),
(91, 43, '100115', '项目管理'),
(92, 43, '100093', '团队合作'),
(88, 6, '100086', '沟通协调'),
(58, 7, '100091', 'photoshop'),
(59, 7, '100087', '逻辑分析'),
(60, 7, '100088', '表达能力'),
(61, 7, '100098', '电话接待'),
(62, 7, '100096', '文件管理'),
(63, 7, '-1', 'php'),
(89, 43, '100094', '学习能力'),
(66, 8, '100088', '表达能力'),
(67, 8, '100098', '电话接待'),
(68, 7, '100077', 'excel'),
(69, 7, '100078', 'powerpoint'),
(70, 43, '100091', 'photoshop'),
(71, 43, '100100', '执行力'),
(72, 43, '-1', '运动'),
(95, 33, '100086', '沟通协调'),
(96, 46, '100083', '英语'),
(97, 46, '100093', '团队合作'),
(98, 6, '100078', 'powerpoint'),
(99, 6, '100087', '逻辑分析'),
(100, 6, '100088', '表达能力'),
(101, 6, '100089', '创新能力'),
(102, 6, '100081', '商务谈判'),
(103, 6, '100084', '公文写作'),
(104, 6, '100090', '目标管理'),
(105, 6, '100076', 'word'),
(106, 6, '100077', 'excel'),
(107, 6, '100103', 'visio'),
(108, 6, '100096', '文件管理'),
(109, 6, '100104', 'flash'),
(111, 6, '100080', 'outlook');

-- --------------------------------------------------------

--
-- 表的结构 `cms_message_content`
--

CREATE TABLE IF NOT EXISTS `cms_message_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `list_id` int(11) NOT NULL COMMENT '私信id',
  `from_uid` int(11) NOT NULL COMMENT '发信人id',
  `content` text NOT NULL COMMENT '内容',
  `ctime` int(11) NOT NULL COMMENT '时间',
  `is_read` tinyint(2) NOT NULL COMMENT '是否已读',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- 转存表中的数据 `cms_message_content`
--

INSERT INTO `cms_message_content` (`id`, `list_id`, `from_uid`, `content`, `ctime`, `is_read`) VALUES
(40, 14, 7, '赵杰第二条', 1398751307, 0),
(39, 14, 7, '哈哈', 1398751267, 0),
(38, 13, 33, '恩呢。。。', 1398750843, 0),
(37, 13, 33, '我跟', 1398750816, 0),
(36, 13, 33, '好遥远', 1398750792, 0),
(35, 13, 5, '好吧', 1398750018, 0),
(42, 15, 44, '我是易武', 1398751473, 0),
(43, 16, 5, '我去。。', 1399108323, 0),
(45, 16, 43, '我擦', 1399536336, 0),
(46, 17, 8, 'Hello', 1399549992, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cms_message_list`
--

CREATE TABLE IF NOT EXISTS `cms_message_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '私信id',
  `from_mid` int(11) NOT NULL COMMENT '私信发起者ID',
  `rece_mid` int(11) NOT NULL COMMENT '接收者id',
  `ctime` int(11) NOT NULL COMMENT '时间',
  `last_message` text NOT NULL COMMENT '最新的一条会话',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `cms_message_list`
--

INSERT INTO `cms_message_list` (`id`, `from_mid`, `rece_mid`, `ctime`, `last_message`) VALUES
(15, 44, 33, 1398751473, '我是易武'),
(14, 7, 33, 1398751399, '好友有意义'),
(13, 5, 33, 1398750843, '恩呢。。。'),
(16, 5, 43, 1399108323, '我去。。'),
(17, 8, 33, 1399549992, 'Hello');

-- --------------------------------------------------------

--
-- 表的结构 `cms_message_member`
--

CREATE TABLE IF NOT EXISTS `cms_message_member` (
  `list_id` int(11) NOT NULL COMMENT '私信id',
  `member_id` int(11) NOT NULL COMMENT '参与私信用户id',
  `new` smallint(8) NOT NULL COMMENT '未读消息数',
  `message_num` int(11) NOT NULL COMMENT '消息总数(通信双方)',
  `ctime` int(11) NOT NULL COMMENT '该参与者最后会话时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_message_member`
--

INSERT INTO `cms_message_member` (`list_id`, `member_id`, `new`, `message_num`, `ctime`) VALUES
(13, 33, 1, 4, 1398750843),
(13, 5, 3, 4, 1398750843),
(14, 7, 0, 3, 1398751399),
(14, 33, 3, 3, 1398751399),
(15, 44, 0, 1, 0),
(15, 33, 1, 1, 1398751473),
(16, 5, 0, 1, 0),
(16, 43, 1, 1, 1399108323),
(17, 8, 0, 1, 0),
(17, 33, 1, 1, 1399549992);

-- --------------------------------------------------------

--
-- 表的结构 `cms_method`
--

CREATE TABLE IF NOT EXISTS `cms_method` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rootid` int(10) unsigned NOT NULL,
  `pid` float unsigned NOT NULL,
  `operate` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ifmenu` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否菜单显示',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=345 ;

--
-- 转存表中的数据 `cms_method`
--

INSERT INTO `cms_method` (`id`, `rootid`, `pid`, `operate`, `name`, `ifmenu`) VALUES
(1, 1, 0, 'admin', '后台登陆管理', 1),
(2, 1, 1, 'index', '管理员管理', 1),
(4, 1, 1, 'admindel', '管理员删除', 0),
(5, 1, 1, 'adminedit', '管理员编辑', 0),
(6, 1, 1, 'adminlock', '管理员锁定', 0),
(7, 1, 1, 'group', '权限管理', 1),
(8, 1, 1, 'groupedit', '管理组编辑', 0),
(9, 1, 1, 'groupdel', '管理组删除', 0),
(10, 10, 0, 'news', '资讯管理', 1),
(11, 10, 10, 'index', '已有资讯', 1),
(12, 10, 10, 'add', '添加资讯', 1),
(13, 10, 10, 'edit', '资讯编辑', 0),
(14, 10, 10, 'del', '资讯删除', 0),
(15, 10, 10, 'lock', '资讯锁定', 0),
(16, 10, 10, 'recmd', '资讯推荐', 0),
(17, 17, 0, 'dbback', '数据库管理', 1),
(18, 17, 17, 'index', '数据库备份', 1),
(19, 17, 17, 'recover', '备份恢复', 0),
(20, 17, 17, 'detail', '备份详细', 0),
(21, 17, 17, 'del', '备份删除', 0),
(22, 22, 0, 'index', '后台面板', 0),
(23, 22, 22, 'index', '后台首页', 0),
(24, 22, 22, 'login', '登陆', 0),
(25, 22, 22, 'logout', '退出登陆', 0),
(26, 22, 22, 'verify', '验证码', 0),
(27, 22, 22, 'welcome', '服务器环境', 0),
(28, 28, 0, 'set', '全局设置', 1),
(29, 28, 28, 'index', '网站设置', 1),
(30, 30, 0, 'sort', '分类管理', 1),
(31, 30, 30, 'index', '栏目列表', 1),
(33, 30, 30, 'del', '分类删除', 0),
(335, 0, 0, 'appmanage', '应用管理', 1),
(85, 28, 28, 'menuname', '后台功能', 1),
(159, 150, 150, 'images_upload', '图片批量上传', 0),
(158, 10, 10, 'FileManagerJson', '编辑器上传管理', 0),
(157, 10, 10, 'UploadJson', '编辑器上传', 0),
(174, 10, 10, 'cutcover', '封面图剪切', 0),
(236, 30, 30, 'PageUploadJson', '单页上传', 0),
(235, 30, 30, 'pageedit', '单页编辑', 0),
(234, 30, 30, 'pageadd', '添加单页栏目', 0),
(231, 30, 30, 'newsedit', '文章栏目编辑', 0),
(230, 30, 30, 'newsadd', '添加文章栏目', 0),
(182, 28, 28, 'clear', '网站缓存', 1),
(188, 188, 0, 'link', '友情链接', 1),
(189, 188, 188, 'index', '链接列表', 1),
(190, 188, 188, 'add', '添加链接', 1),
(191, 188, 188, 'edit', '链接编辑', 0),
(192, 188, 188, 'del', '链接删除', 0),
(328, 1, 1, 'adminnow', '账户管理', 1),
(229, 188, 188, 'lock', '锁定', 0),
(237, 30, 30, 'PageFileManagerJson', '单页上传管理', 0),
(238, 238, 0, 'fragment', '碎片管理', 1),
(239, 238, 238, 'index', '碎片列表', 1),
(240, 238, 238, 'add', '碎片添加', 1),
(241, 238, 238, 'edit', '碎片编辑', 0),
(242, 238, 238, 'del', '碎片删除', 0),
(243, 238, 238, 'UploadJson', '编辑器上传', 0),
(244, 238, 238, 'FileManagerJson', '编辑器上传管理', 0),
(245, 28, 28, 'tpchange', '前台模板', 1),
(251, 30, 30, 'pluginadd', '添加应用栏目', 0),
(252, 30, 30, 'pluginedit', '应用栏目编辑', 0),
(267, 258, 258, 'file', '文件上传', 0),
(288, 10, 10, 'colchange', '资讯转移栏目', 0),
(283, 283, 0, 'member', '会员管理', 1),
(292, 28, 28, 'tplist', '模板文件列表', 0),
(293, 28, 28, 'tpadd', '模板文件添加', 0),
(294, 28, 28, 'tpedit', '模板文件编辑', 0),
(295, 28, 28, 'tpdel', '删除模板文件', 0),
(296, 28, 28, 'tpgetcode', '获取模板内容', 0),
(301, 30, 30, 'add', '添加栏目', 1),
(304, 3, 3, 'placelist', '内容定位列表', 1),
(305, 3, 3, 'placeadd', '添加内容定位', 1),
(306, 3, 3, 'placeedit', '定位编辑', 0),
(307, 3, 3, 'placedel', '定位删除', 0),
(331, 283, 283, 'member/adminmember', '会员管理', 0),
(228, 1, 1, 'adminadd', '添加管理员', 1),
(3, 3, 0, 'place', '定位管理', 1),
(330, 283, 283, 'admingroup/index', '会员组管理', 0),
(314, 314, 0, 'files', '附件管理', 1),
(315, 314, 314, 'index', '文件列表', 1),
(316, 314, 314, 'del', '删除文件', 0),
(324, 28, 28, 'email', '邮件设置', 1),
(325, 28, 28, 'dobadword', '关键词过滤', 0),
(332, 283, 283, 'adminmember/active', '待激活用户', 0),
(333, 283, 283, 'adminmember/sendAll', '群发邮件', 0),
(334, 283, 283, 'adminmember/send_allmsg', '群发私信', 0),
(277, 0, 0, 'company', '企业管理', 1),
(336, 336, 0, 'feedback', '反馈管理', 1),
(337, 336, 336, 'index', '反馈列表', 1),
(338, 336, 336, 'unreply', '未处理反馈', 1),
(339, 339, 0, 'task', '任务管理', 1),
(340, 339, 339, 'index', '基本任务', 1),
(341, 339, 339, 'add', '增加基本任务', 1),
(342, 339, 339, 'custom', '企业特定任务', 1),
(343, 339, 339, 'edit', '编辑基本任务', 0),
(344, 339, 339, 'del', '删除任务', 0);

-- --------------------------------------------------------

--
-- 表的结构 `cms_news`
--

CREATE TABLE IF NOT EXISTS `cms_news` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `sort` varchar(350) NOT NULL COMMENT '类别',
  `account` char(15) NOT NULL COMMENT '发布者账户',
  `title` varchar(60) NOT NULL COMMENT '标题',
  `places` varchar(100) NOT NULL,
  `color` varchar(7) NOT NULL COMMENT '标题颜色',
  `picture` varchar(80) NOT NULL,
  `keywords` varchar(300) NOT NULL COMMENT '关键字',
  `description` varchar(600) NOT NULL,
  `content` text NOT NULL COMMENT '内容',
  `method` varchar(100) NOT NULL COMMENT '方法',
  `tpcontent` varchar(100) NOT NULL COMMENT '模板',
  `norder` int(4) NOT NULL COMMENT '排序',
  `recmd` tinyint(1) NOT NULL COMMENT '推荐',
  `hits` int(10) NOT NULL COMMENT '点击量',
  `ispass` tinyint(1) NOT NULL,
  `origin` varchar(30) NOT NULL COMMENT '来源',
  `addtime` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `sort` (`sort`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- 转存表中的数据 `cms_news`
--

INSERT INTO `cms_news` (`id`, `sort`, `account`, `title`, `places`, `color`, `picture`, `keywords`, `description`, `content`, `method`, `tpcontent`, `norder`, `recmd`, `hits`, `ispass`, `origin`, `addtime`) VALUES
(23, ',000000,100028,100036', 'admin', '激情', '100', '#E53333', '20140309/thumb_20140309144706_30440.jpg', '哈哈', '哈哈', '哈', 'news/content', 'news_content', 0, 0, 30, 1, '原创', 1394346935),
(24, ',000000,100028,100036', 'admin', '果敢', '100', '#00D5FF', '20140309/thumb_thumb_thumb_20140309144918_26526.jpg', '果敢', '果敢', '果敢<img src="http://localhost/Yuncms/public/kindeditor/plugins/emoticons/images/31.gif" border="0" alt="" />', 'news/content', 'news_content', 0, 0, 30, 1, '果敢', 1394347730),
(25, ',000000,100028,100036', 'admin', '执着', '100', '', '20140309/thumb_thumb_20140309183130_90592.jpg', '执着', '执着', '执着', 'news/content', 'news_content', 0, 0, 34, 1, '原创', 1394361075),
(26, ',000000,100028,100036', 'admin', '超越', '100', '#B8D100', '20140309/thumb_thumb_thumb_thumb_20140309183155_88695.jpg', '超越', '超越', '超越梦想<img src="http://localhost/Yuncms/public/kindeditor/plugins/emoticons/images/0.gif" border="0" alt="" />', 'news/content', 'news_content', 0, 0, 31, 1, '原创', 1394361101),
(34, ',000000,100028,100036', 'admin', '测试', '', '', 'NoPic.gif', 'ce', 'ce', 'ce&nbsp;', 'news/content', '', 0, 0, 30, 1, '原创', 1397215035);

-- --------------------------------------------------------

--
-- 表的结构 `cms_notify_email`
--

CREATE TABLE IF NOT EXISTS `cms_notify_email` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL COMMENT '1会员2企业-1系统',
  `uid` int(10) NOT NULL,
  `email` varchar(250) NOT NULL,
  `title` varchar(250) NOT NULL,
  `body` text NOT NULL,
  `ctime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- 转存表中的数据 `cms_notify_email`
--

INSERT INTO `cms_notify_email` (`id`, `type`, `uid`, `email`, `title`, `body`, `ctime`) VALUES
(1, 0, 3, 'yunstudio2012@qq.com', 'why', '怎么啦<img src="http://localhost/Yuncms/public/kindeditor/plugins/emoticons/images/5.gif" border="0" alt="" />', 1395242900),
(2, 0, 2, '862820606@qq.com', '群发测试', '群发测试', 1395305979),
(3, 0, 3, 'yunstudio2012@qq.com', '群发测试', '群发测试', 1395305979),
(4, 0, 1, '862820606@qq.com', '所有人', '所有人', 1395308667),
(5, 0, 2, '862820606@qq.com', '所有人', '所有人', 1395308667),
(6, 0, 3, 'yunstudio2012@qq.com', '所有人', '所有人', 1395308667),
(7, 0, 1, 'yunstudio2012@qq.com', '下周任务', '<p>\r\n	&nbsp; &nbsp; <span style="font-size:14px;">本周主要让后台新加入的两个成员了解后台开发，<span style="font-size:14px;line-height:21px;">现在已经基本熟悉，</span>同时前端开发正式开始，下周的任务主要是：</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">1.赵杰：编写home模块</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">2.唐娜：个人档案模块</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">3.张旭：跟上我们开发的节奏，美工及前端的其他成员由其负责安排工作</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">4.每个成员多交流，下周希望项目进展快一点，大家加油！</span>\r\n</p>', 1396184203),
(8, 0, 3, 'tianyufang@qq.com', '下周任务', '<p>\r\n	&nbsp; &nbsp; <span style="font-size:14px;">本周主要让后台新加入的两个成员了解后台开发，<span style="font-size:14px;line-height:21px;">现在已经基本熟悉，</span>同时前端开发正式开始，下周的任务主要是：</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">1.赵杰：编写home模块</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">2.唐娜：个人档案模块</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">3.张旭：跟上我们开发的节奏，美工及前端的其他成员由其负责安排工作</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">4.每个成员多交流，下周希望项目进展快一点，大家加油！</span>\r\n</p>', 1396184203),
(9, 0, 5, '1161499602@qq.com', '下周任务', '<p>\r\n	&nbsp; &nbsp; <span style="font-size:14px;">本周主要让后台新加入的两个成员了解后台开发，<span style="font-size:14px;line-height:21px;">现在已经基本熟悉，</span>同时前端开发正式开始，下周的任务主要是：</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">1.赵杰：编写home模块</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">2.唐娜：个人档案模块</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">3.张旭：跟上我们开发的节奏，美工及前端的其他成员由其负责安排工作</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">4.每个成员多交流，下周希望项目进展快一点，大家加油！</span>\r\n</p>', 1396184203),
(10, 0, 6, '1095620719@qq.com', '下周任务', '<p>\r\n	&nbsp; &nbsp; <span style="font-size:14px;">本周主要让后台新加入的两个成员了解后台开发，<span style="font-size:14px;line-height:21px;">现在已经基本熟悉，</span>同时前端开发正式开始，下周的任务主要是：</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">1.赵杰：编写home模块</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">2.唐娜：个人档案模块</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">3.张旭：跟上我们开发的节奏，美工及前端的其他成员由其负责安排工作</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">4.每个成员多交流，下周希望项目进展快一点，大家加油！</span>\r\n</p>', 1396184203),
(11, 0, 7, '1103349641@qq.com', '下周任务', '<p>\r\n	&nbsp; &nbsp; <span style="font-size:14px;">本周主要让后台新加入的两个成员了解后台开发，<span style="font-size:14px;line-height:21px;">现在已经基本熟悉，</span>同时前端开发正式开始，下周的任务主要是：</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">1.赵杰：编写home模块</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">2.唐娜：个人档案模块</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">3.张旭：跟上我们开发的节奏，美工及前端的其他成员由其负责安排工作</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">4.每个成员多交流，下周希望项目进展快一点，大家加油！</span>\r\n</p>', 1396184203),
(12, 0, 8, '113771910@qq.com', '下周任务', '<p>\r\n	&nbsp; &nbsp; <span style="font-size:14px;">本周主要让后台新加入的两个成员了解后台开发，<span style="font-size:14px;line-height:21px;">现在已经基本熟悉，</span>同时前端开发正式开始，下周的任务主要是：</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">1.赵杰：编写home模块</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">2.唐娜：个人档案模块</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">3.张旭：跟上我们开发的节奏，美工及前端的其他成员由其负责安排工作</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">4.每个成员多交流，下周希望项目进展快一点，大家加油！</span>\r\n</p>', 1396184203),
(13, 0, 9, '1085195131@qq.com', '下周任务', '<p>\r\n	&nbsp; &nbsp; <span style="font-size:14px;">本周主要让后台新加入的两个成员了解后台开发，<span style="font-size:14px;line-height:21px;">现在已经基本熟悉，</span>同时前端开发正式开始，下周的任务主要是：</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">1.赵杰：编写home模块</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">2.唐娜：个人档案模块</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">3.张旭：跟上我们开发的节奏，美工及前端的其他成员由其负责安排工作</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">4.每个成员多交流，下周希望项目进展快一点，大家加油！</span>\r\n</p>', 1396184203),
(14, 0, 28, '825075713@qq.com', '下周任务', '<p>\r\n	&nbsp; &nbsp; <span style="font-size:14px;">本周主要让后台新加入的两个成员了解后台开发，<span style="font-size:14px;line-height:21px;">现在已经基本熟悉，</span>同时前端开发正式开始，下周的任务主要是：</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">1.赵杰：编写home模块</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">2.唐娜：个人档案模块</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">3.张旭：跟上我们开发的节奏，美工及前端的其他成员由其负责安排工作</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">4.每个成员多交流，下周希望项目进展快一点，大家加油！</span>\r\n</p>', 1396184203),
(15, 0, 31, 'sunscheung@163.com', '下周任务', '<p>\r\n	&nbsp; &nbsp; <span style="font-size:14px;">本周主要让后台新加入的两个成员了解后台开发，<span style="font-size:14px;line-height:21px;">现在已经基本熟悉，</span>同时前端开发正式开始，下周的任务主要是：</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">1.赵杰：编写home模块</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">2.唐娜：个人档案模块</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">3.张旭：跟上我们开发的节奏，美工及前端的其他成员由其负责安排工作</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">4.每个成员多交流，下周希望项目进展快一点，大家加油！</span>\r\n</p>', 1396184203),
(16, 0, 32, '452563788@qq.com', '下周任务', '<p>\r\n	&nbsp; &nbsp; <span style="font-size:14px;">本周主要让后台新加入的两个成员了解后台开发，<span style="font-size:14px;line-height:21px;">现在已经基本熟悉，</span>同时前端开发正式开始，下周的任务主要是：</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">1.赵杰：编写home模块</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">2.唐娜：个人档案模块</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">3.张旭：跟上我们开发的节奏，美工及前端的其他成员由其负责安排工作</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">4.每个成员多交流，下周希望项目进展快一点，大家加油！</span>\r\n</p>', 1396184203),
(19, -1, -1, 'yunstudio2012@qq.com', '处理邮寄', '处理邮寄', 1396185180),
(18, -1, -1, 'yunstudio2012@qq.com', '你好', '邮寄回复测试', 1396184356),
(20, -1, -1, 'yunstudio2012@qq.com', '你好', '邮寄回复', 1396185325),
(21, 0, 1, '862820606@qq.com', '你好', '年后', 1396532566),
(22, 1, 1, '', '你好', '12', 1396532980),
(23, 1, 5, '', '你好', '12', 1396532980),
(24, 1, 1, '862820606@qq.com', 'ff', 'ff', 1396533006),
(25, 1, 5, '1@qq.com', 'ff', 'ff', 1396533006);

-- --------------------------------------------------------

--
-- 表的结构 `cms_notify_message`
--

CREATE TABLE IF NOT EXISTS `cms_notify_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL COMMENT '通知类型',
  `uid` int(11) NOT NULL COMMENT '接收者id',
  `title` varchar(250) NOT NULL,
  `body` text NOT NULL,
  `ctime` int(11) NOT NULL,
  `is_read` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否已读',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `cms_notify_message`
--

INSERT INTO `cms_notify_message` (`id`, `type`, `uid`, `title`, `body`, `ctime`, `is_read`) VALUES
(9, 'system', 2, '大家好', '大家好<img src="http://localhost/Yuncms/public/kindeditor/plugins/emoticons/images/13.gif" border="0" alt="" />', 1395368348, 0),
(8, 'system', 1, '大家好', '大家好<img src="http://localhost/Yuncms/public/kindeditor/plugins/emoticons/images/13.gif" border="0" alt="" />', 1395368348, 0),
(7, 'system', 1, '欢迎你', '欢迎你注册', 1395368304, 0),
(10, 'system', 3, '大家好', '大家好<img src="http://localhost/Yuncms/public/kindeditor/plugins/emoticons/images/13.gif" border="0" alt="" />', 1395368348, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cms_page`
--

CREATE TABLE IF NOT EXISTS `cms_page` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sort` varchar(350) NOT NULL,
  `content` text NOT NULL,
  `edittime` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `cms_page`
--

INSERT INTO `cms_page` (`id`, `sort`, `content`, `edittime`) VALUES
(3, ',000000,100028,100033', '关于我们', '2014-02-27 14:28:57');

-- --------------------------------------------------------

--
-- 表的结构 `cms_place`
--

CREATE TABLE IF NOT EXISTS `cms_place` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `norder` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=103 ;

--
-- 转存表中的数据 `cms_place`
--

INSERT INTO `cms_place` (`id`, `name`, `norder`) VALUES
(100, '首页banner', 0),
(101, '首页幻灯', 0);

-- --------------------------------------------------------

--
-- 表的结构 `cms_sort`
--

CREATE TABLE IF NOT EXISTS `cms_sort` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '模型类别',
  `path` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `deep` int(5) unsigned NOT NULL DEFAULT '1' COMMENT '深度',
  `norder` tinyint(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `ifmenu` tinyint(1) NOT NULL COMMENT '是否前台显示',
  `method` varchar(100) NOT NULL COMMENT '模型方法',
  `tplist` varchar(100) NOT NULL COMMENT '列表模板',
  `keywords` varchar(255) NOT NULL COMMENT '描述',
  `description` varchar(300) NOT NULL COMMENT '描述',
  `url` varchar(100) NOT NULL COMMENT '外部链接',
  PRIMARY KEY (`id`),
  FULLTEXT KEY `path` (`path`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100117 ;

--
-- 转存表中的数据 `cms_sort`
--

INSERT INTO `cms_sort` (`id`, `type`, `path`, `name`, `deep`, `norder`, `ifmenu`, `method`, `tplist`, `keywords`, `description`, `url`) VALUES
(100028, 1, ',000000', '新闻资讯', 1, 0, 1, 'news/index', 'news_index,news_content', '资讯信息', '资讯信息', '10'),
(100029, 1, ',000000,100028', '最新动态', 2, 0, 1, 'news/index', 'news_index,news_content', '最新动态', '最新动态', '10'),
(100033, 3, ',000000,100028', '关于我们', 2, 0, 1, 'page/index', 'page_index', '关于我们', '关于我们', ''),
(100034, 1, ',000000,100028', '最近公告', 2, 0, 1, 'news/index', 'news_index,news_content', '最近公告', '最近公告', '10'),
(100036, 1, ',000000,100028', '作坊文化', 2, 0, 0, 'news/index', 'news_index,news_content', '作坊文化', '作坊文化', '10'),
(100037, 5, ',000000', '个人标签', 1, 0, 0, '', '', '', '', ''),
(100038, 5, ',000000,100037', '第一组', 2, 0, 0, '', '', '', '', ''),
(100074, 5, ',000000,100037', '第二组', 2, 0, 0, '', '', '', '', ''),
(100075, 5, ',000000,100037', '第三组', 2, 0, 0, '', '', '', '', ''),
(100076, 5, ',000000,100037,100038', 'word', 3, 0, 0, '', '', '', '', ''),
(100077, 5, ',000000,100037,100038', 'excel', 3, 0, 0, '', '', '', '', ''),
(100078, 5, ',000000,100037,100038', 'powerpoint', 3, 0, 0, '', '', '', '', ''),
(100091, 5, ',000000,100037,100038', 'photoshop', 3, 0, 0, '', '', '', '', ''),
(100080, 5, ',000000,100037,100038', 'outlook', 3, 0, 0, '', '', '', '', ''),
(100081, 5, ',000000,100037,100038', '商务谈判', 3, 0, 0, '', '', '', '', ''),
(100084, 5, ',000000,100037,100038', '公文写作', 3, 0, 0, '', '', '', '', ''),
(100083, 5, ',000000,100037,100038', '英语', 3, 0, 0, '', '', '', '', ''),
(100082, 5, ',000000,100037,100038', '市场拓展', 3, 0, 0, '', '', '', '', ''),
(100054, 5, ',000000', '公司性质', 1, 0, 0, '', '', '', '', ''),
(100055, 5, ',000000,100054', '外资·合资', 2, 0, 0, '', '', '', '', ''),
(100056, 5, ',000000,100054', '私营·股份制企业', 2, 0, 0, '', '', '', '', ''),
(100057, 5, ',000000,100054', '国有企业', 2, 0, 0, '', '', '', '', ''),
(100058, 5, ',000000,100054', '非营利·事业单位', 2, 0, 0, '', '', '', '', ''),
(100059, 5, ',000000,100054', '其他', 2, 0, 0, '', '', '', '', ''),
(100060, 5, ',000000', '公司规模', 1, 0, 0, '', '', '', '', ''),
(100061, 5, ',000000,100060', '1 - 49人', 2, 0, 0, '', '', '', '', ''),
(100062, 5, ',000000,100060', '50 - 99人', 2, 0, 0, '', '', '', '', ''),
(100063, 5, ',000000,100060', '100 - 499人', 2, 0, 0, '', '', '', '', ''),
(100064, 5, ',000000,100060', '500 - 999人', 2, 0, 0, '', '', '', '', ''),
(100065, 5, ',000000,100060', '1000人以上', 2, 0, 0, '', '', '', '', ''),
(100066, 5, ',000000', 'footer导航', 1, 0, 0, '', '', '', '', ''),
(100067, 5, ',000000,100066', '关于91频道', 2, 0, 0, '', '', '', '', ''),
(100068, 5, ',000000,100066', '联系我们', 2, 0, 0, '', '', '', '', 'http://wy.yunstudio.net'),
(100069, 5, ',000000,100066', '对外合作', 2, 0, 0, '', '', '', '', ''),
(100070, 5, ',000000,100066', '招贤纳士', 2, 0, 0, '', '', '', '', ''),
(100071, 5, ',000000,100066', '服务条款', 2, 0, 0, '', '', '', '', ''),
(100072, 5, ',000000,100066', '关注我们', 2, 0, 0, '', '', '', '', 'http://weibo.com/yunstudio2/'),
(100073, 5, ',000000,100066', '问题建议', 2, 0, 0, '', '', '', '', ''),
(100085, 5, ',000000,100037,100038', '办公自动化', 3, 0, 0, '', '', '', '', ''),
(100086, 5, ',000000,100037,100038', '沟通协调', 3, 0, 0, '', '', '', '', ''),
(100087, 5, ',000000,100037,100038', '逻辑分析', 3, 0, 0, '', '', '', '', ''),
(100088, 5, ',000000,100037,100038', '表达能力', 3, 0, 0, '', '', '', '', ''),
(100089, 5, ',000000,100037,100038', '创新能力', 3, 0, 0, '', '', '', '', ''),
(100090, 5, ',000000,100037,100038', '目标管理', 3, 0, 0, '', '', '', '', ''),
(100092, 5, ',000000,100037,100074', '时间管理', 3, 0, 0, '', '', '', '', ''),
(100093, 5, ',000000,100037,100074', '团队合作', 3, 0, 0, '', '', '', '', ''),
(100094, 5, ',000000,100037,100074', '学习能力', 3, 0, 0, '', '', '', '', ''),
(100095, 5, ',000000,100037,100074', '压力管理', 3, 0, 0, '', '', '', '', ''),
(100096, 5, ',000000,100037,100074', '文件管理', 3, 0, 0, '', '', '', '', ''),
(100097, 5, ',000000,100037,100074', '精通互联网', 3, 0, 0, '', '', '', '', ''),
(100098, 5, ',000000,100037,100074', '电话接待', 3, 0, 0, '', '', '', '', ''),
(100099, 5, ',000000,100037,100074', '人际关系维护', 3, 0, 0, '', '', '', '', ''),
(100100, 5, ',000000,100037,100074', '执行力', 3, 0, 0, '', '', '', '', ''),
(100101, 5, ',000000,100037,100074', '领导力', 3, 0, 0, '', '', '', '', ''),
(100102, 5, ',000000,100037,100074', 'wps', 3, 0, 0, '', '', '', '', ''),
(100103, 5, ',000000,100037,100074', 'visio', 3, 0, 0, '', '', '', '', ''),
(100104, 5, ',000000,100037,100074', 'flash', 3, 0, 0, '', '', '', '', ''),
(100105, 5, ',000000,100037,100074', 'mindmap', 3, 0, 0, '', '', '', '', ''),
(100106, 5, ',000000,100037,100074', 'access', 3, 0, 0, '', '', '', '', ''),
(100107, 5, ',000000,100037,100074', 'dreamwaver', 3, 0, 0, '', '', '', '', ''),
(100108, 5, ',000000,100037,100075', 'spss', 3, 0, 0, '', '', '', '', ''),
(100109, 5, ',000000,100037,100075', '心理咨询', 3, 0, 0, '', '', '', '', ''),
(100110, 5, ',000000,100037,100075', '法律咨询', 3, 0, 0, '', '', '', '', ''),
(100111, 5, ',000000,100037,100075', '工程预算', 3, 0, 0, '', '', '', '', ''),
(100112, 5, ',000000,100037,100075', '行政文秘', 3, 0, 0, '', '', '', '', ''),
(100113, 5, ',000000,100037,100075', '市场营销', 3, 0, 0, '', '', '', '', ''),
(100114, 5, ',000000,100037,100075', '网络营销', 3, 0, 0, '', '', '', '', ''),
(100115, 5, ',000000,100037,100075', '项目管理', 3, 0, 0, '', '', '', '', ''),
(100116, 5, ',000000,100037,100075', '国际商务', 3, 0, 0, '', '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `cms_task_base`
--

CREATE TABLE IF NOT EXISTS `cms_task_base` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goal` varchar(200) NOT NULL COMMENT '任务目的',
  `name` varchar(200) NOT NULL COMMENT '任务名称',
  `content` text NOT NULL COMMENT '任务内容',
  `reminder` varchar(200) NOT NULL COMMENT '任务提示',
  `way` varchar(200) NOT NULL COMMENT '完成途径',
  `certification_way` varchar(250) NOT NULL COMMENT '认证方式',
  `obtain_gold` int(11) NOT NULL COMMENT '完成任务获得的91币',
  `consume_gold` int(11) NOT NULL COMMENT '领取任务消耗91币',
  `score` float NOT NULL COMMENT '任务学分值',
  `ctime` int(11) NOT NULL,
  `author` varchar(50) NOT NULL COMMENT '作者',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- 转存表中的数据 `cms_task_base`
--

INSERT INTO `cms_task_base` (`id`, `goal`, `name`, `content`, `reminder`, `way`, `certification_way`, `obtain_gold`, `consume_gold`, `score`, `ctime`, `author`) VALUES
(1, '  对公司的熟知度（一）', '测试任务', '', '    可从公司网站、主流媒体报道、\r\n其他宣传材料获取有关信息', '', '', 0, 0, 1, 1399710784, '田向阳'),
(4, '   加强面对面沟通的能力', '面试（一）', '在三个月内参加一次面试，面试完成后写出面试的具体情况及对自己面试情况的具体评价（涉及到具体问题），并给自己打分（总分100分）。文档中请提供面试的职位、公司、具体联系方式。', '   可通过应届生求职网http://www.yingjiesheng.com/等寻找面试机会，面试前请认真准备个人简历。参加面试、写出面试具体情况与自我评价、给自己评分\r\n提交文档、', '测试', '测试', 2, 2, 1, 1399710780, '田向阳'),
(6, ' 人际交往能力（二）', '认识新朋友（二）', '在一月内的时间内认识三位新朋友并完成向每为联系人借阅一本书籍，阅读后归还联系人。', '       ', '根据91频道提供的同校10名联系人名单和联系方式，领取任务者主动和联系人联系，借阅书籍，完成读后感，获得联系人对领取任务者的书面评价并和联系人合影、', '上传相关材料（或清晰的图片）', 0, 0, 0, 1399714213, '田向阳'),
(5, '   学会如何取得陌生人的信任', '向陌生人推销一件你自己的物品', '系统将随机提供您的三位校友，你可向三位中的任意一位推销一样自己的物品，写出任务完成的整个过程及心得，并提供成交照片。', '   可通过微博、校内网等找寻自己与陌生人的徽关系，取得他（她）信任。提供的物品最好是对方所需要的，以减少成效难度。', '提供任务完成的过程及自己的心得、提交成交照片\r\n', '提交文档、照片', 0, 0, 0, 1399987980, '李鸥鸥'),
(9, '  了解企业概况、企业文化、业务、社会评价等，培养应聘者的信息收集能力、报告写作能力及对该企业的认同感和归属感。', '企业情况调查报告', '在规定的时间内完成企业情况调查报告', '  1.可通过企业官网、市场调查、实地走访等方式收集企业    \r\n   的相关信息。2.报告内容可包括：企业概况、企业文化、社会评价、应聘者\r\n   对该企业的认知和合理化建议等。', '设计问卷及访谈提纲，记录访谈笔记、拍摄走访照片，完成2000字左右的调查报告\r\n', '上传报告及相关材料', 0, 0, 0, 1399986798, '张牧'),
(10, '培养考察应聘者的商务谈判技巧、组织能力、口头表达能力。', '商务谈判技巧小课堂', '在规定的时间内学习了解基本的商务谈判技巧，并自己主办一场商务谈判技巧小课堂，教授身边的同学了解商务谈判技巧。\r\n', ' 1.可通过网络视频、查阅书籍等方式了解商务谈判过程及技巧。 2.召集同学5名以上(可召集领取了相同任务的同学)组织一场小型课堂，把自己了解的相关知识教授给大家。', '完成一篇500字以上的学习报告(包括商务谈判的技巧和谈判时的注意事项等），录制讲课录音，拍摄课堂情况照片。', '上传学习报告、影音材料', 0, 0, 0, 1400073139, '张牧'),
(11, '  培养考察应聘者的自学能力、办公软件使用能力', '变身EXCEL达人', '在规定的时间内学习了解办公常用的EXCEL技巧，总结已会的技巧名称，并由自己选题、完成一份EXCEL表格。', '  可通过网络、书籍等方式学习EXCEL相关知识', '完成一篇500字以上的简要技巧总结；自己选择原始数据信息，自由设置完成EXCEL表格的要求，完成一份EXCEL表格。', '上传技巧总结报告、EXCEL原始数据、表格要求、及完成后的  \r\n       EXCEL表格', 0, 0, 0, 1399986773, '张牧'),
(12, '  培养考察应聘者的办公软件使用能力、时间管理能力', '假期生活汇报PPT制作', '在规定的时间内学习了解常用的PPT制作技巧，并根据假期生\r\n活制作一个汇报演示稿。\r\n', '  可通过网络、书籍等方式学习EXCEL相关知识，并将假  \r\n    期生活按学习、实践等各方面进行汇报\r\n', '完成假期生活汇报PPT', '上传假期生活汇报PPT', 0, 0, 0, 1399986762, '张牧'),
(13, '  培养应聘者的信息收集能力、报告写作能力，特别是西方礼仪方\r\n       面的知识。\r\n', '给主管拟一份西式宴会注意事项列表', '在规定的时间内学习参加西式宴会的各种礼仪及注意事项，完成\r\n    注意事项列表。\r\n', '  可按赴宴前、赴宴中、赴宴后及其它方面来总结。', '通过书籍、网络等了解收集相关知识信息。', '上传注意事项列表', 0, 0, 0, 1399986751, '张牧'),
(14, '  培养应聘者的应变能力、表达能力及心理素质及简历制作能力，\r\n       增长面试经验。\r\n', '招聘面试', '在规定的时间内学习掌握参加面试的技巧及注意事项后参加一次\r\n    招聘面试\r\n', '  了解面试时常问问题及回答方法、面试着装注意事项等。', '选公司、投简历、参加面试并把面试时的问题和自己的答案整理成文档。', '上传简历、面试照片、上传面试时的问题及答案文档。', 0, 0, 0, 1399986740, '张牧'),
(15, '  培养应聘者的人际交往能力、沟通能力、组织能力及策划能力。', '组织学生活动', '在规定的时间内策划一项有意义的学生活动，并召集7人以上组  \r\n    织实施。\r\n', '  ：可以是辩论赛、演讲比赛等。', '可通过91频道的交友平台寻找同城需要完成该任务的同学，也可以与同校同学一起策划组织。', '上传活动策划、活动照片及参与人员的91账号及活动总结。', 0, 0, 0, 1399986731, '张牧'),
(16, '  扩展应聘者的综合素质，培养其性格的外向性', '才艺展示', '在规定的时间内参加一次校内或校外的才艺展示。', '  可以是乐器、唱歌、舞蹈、相声小品等表演形式。\r\n', '可参加校内、校外的文艺演出、文体竞赛等活动。', '上传活动照片及视频，请活动主办方下一份书面证明，并盖章。', 0, 0, 0, 1399986721, '张牧'),
(17, '  扩展应聘者的外语能力，培养其自主学习能力。', '简单掌握一门小语种', '在规定的时间内学习企业规定的一门小语种。', '  达到初级水平，可以进行日常对话即可。', '', '上传用该门小语种完成一段自我介绍并录成视频、及等级考试\r\n    证书。', 0, 0, 0, 1399986711, '张牧'),
(18, '  锻炼应聘者的沟通能力、同理心、服务意识及社会责任感。', '养老院（福利院）做义工', '在一段时间内去养老院、福利院做义工。', '  联系所在城市的某个养老院或福利院，定期去做义务劳动  \r\n       或与老人孩子聊天互动。\r\n', '写一篇5000字左右的实践感想。', '上传实践感想一篇、做义工时与老人或与儿童在一起时的照片。', 0, 0, 0, 1399986700, '张牧'),
(19, '  培养考察应聘者的合作能力、协调能力、观察能力。', '多人穿大鞋', '组织参加多人穿大鞋游戏。', '  在操场或空旷的场地，准备两块长2米宽20厘米左右的\r\n木板、两条4米长的长绳，把参与活动者（4个以上)的左右脚分别固定在两 \r\n块木板上，进行齐步走的游戏，多余一人为旁观者，负责协调及喊口号。\r\n', '寻找活动参与者，组织完成活动，并写一篇500字的感想。\r\n', '上传活动照片及感想。', 0, 0, 0, 1399986673, '张牧'),
(20, '  培养考察应聘者的合作能力、协调能力、策划能力。', '公司周年庆典筹备工作计划方案', '为即将来临的公司庆典策划筹备方案', '  方案可包括对外宣传、拟定会议文字资料、确定奖品礼品\r\n    规格种类及选购、文艺演出、租用设备及会场布置、预算、邀请嘉宾等。\r\n', '写一份详细的计划书。', '上传计划书。', 0, 0, 0, 1399986665, '张牧'),
(21, '  培养考察应聘者的说服能力、人际交往能力、PS等图片工具应\r\n    用能力。\r\n', '微笑展示活动', '征集微笑照片，利用PS等图片工具拼接成一幅图片，在选定区\r\n域进行展示，并通过发放与主题相关的宣传单等方式让人们感受到微笑带来\r\n的美好。\r\n', '  可从认识或不认识的人中征集，并说服大家常微笑并保持\r\n    一个积极健康的生活态度。\r\n', '写一份活动策划书、准备微笑展示活动的照片、宣传单等。', '上传策划书、活动照片、宣传单等资料', 0, 0, 0, 1399986657, '张牧'),
(22, ' 培养考察应聘者的说服能力、沟通能力。2 ', '角色扮演：劝阻在无烟场合的吸烟者', '和另一位同学进行较色扮演游戏，一个演说服者、一个演吸烟者，五分钟内说服者要说服在公共无烟场合吸烟者不要吸烟，后可调换角色。', '   自设情景和对话内容。吸烟者要尽量采取不配合的态度，说服者要有理有据，动之以情晓之以理，不与吸烟者产生矛盾的前提下说服之不要吸烟。\r\n', '录制分钟内的该情景对话对话视频或者音频。', '上传情景对话文档、影音材料等。', 0, 0, 0, 1400072331, '张牧'),
(23, '  培养考察应聘者的表达能力、沟通能力', '我是促销员', '在促销季做一次促销员。', '  学习掌握推销的技巧及与客户的沟通能力，在商场促销季\r\n    应聘担任促销员若干天数。\r\n', '结束促销工作后写一份促销工作总结。', '上传促销工作总结及促销照片等。', 0, 0, 0, 1399986618, '张牧'),
(24, '  培养考察应聘者的沟通能力和自我认知能力。', '帮我找缺点', '寻找自己的缺点和不足。', '  向熟悉自己的老师和同学3-5人征求对自己的批评意\r\n见。\r\n', '写一份自我缺点的认知报告，包括改善途径。', '上传任职报告，及谈话时的照片、录音等记录。', 0, 0, 0, 1399986610, '张牧'),
(25, '  培养考察应聘者的合作能力、沟通能力。写作能力。', '合作的经历汇报', ' 把一个你与别人合作的经历写成书面报告。', '  回忆一个你认为最能体现你合作精神的真实经历写成书面\r\n    报告，体现出你是如何与他人合作，在过程中的经验教训等。\r\n', '写一份合作经历书面报告。', '：上传书面报告', 0, 0, 0, 1399986601, '张牧'),
(26, '  培养考察应聘者的写作能力、发现问题能力。', '拟定开会守则及考核办法', '根据开会时常常出现的各种问题拟定一个部门开会守则及考核办\r\n    法。\r\n', '  上传守则及考核办法。', '制定出一份开会守则和考核办法。\r\n', '', 0, 0, 0, 1399986590, '张牧'),
(27, '  培养考察应聘者发现问题能力、信息处理能力。', '客户满意度调查', '根据关注企业的产品设计出客户满意度调查问卷，并随机发放 \r\n    100分进行市场调查后进行数据分析。\r\n', '  可从商品的包装、质量、性能、售后服务等方面拟定，发\r\n    放问卷的形式可采用网络发放也可采用实地发放。\r\n', '制定调查问卷及数据分析报告。\r\n', '上传调查问卷和数据分析报告。', 0, 0, 0, 1399986572, '张牧'),
(28, '          培养考察应聘者解决问题的能力、沟通协调能力。\r\n', '解决矛盾小能手', '在身边发现较难化解的冲突与矛盾，并帮助找到矛盾所在，帮忙\r\n    解决处理。\r\n', '          可找到同学之间、朋友之间、或亲人之间的矛盾，也可以\r\n    是自己与别人发生的矛盾。\r\n', '将矛盾所在、解决过程整理后写一份矛盾处理报告。\r\n', '上传报告。', 0, 0, 0, 1399986563, '张牧'),
(29, ' 了解学生收集数据的能力', '数据收集', '以您所在的高校为总体，收集“愿意参加志愿服务发展现状”相关的信息', ' 可通过问卷调查（实体调查、网络调查）、高校相关部门找寻数据信息、高校相关部门的访谈、文献搜集等相关方式进行数据收集。\r\n', '将各种调查方式与调查结果整理。', '提交详细文档（问卷调查需提供问卷、相关访谈需提供访谈记录、文献搜集需注明参考文献）', 0, 0, 0, 1399987120, '李鸥鸥'),
(30, ' 考察实践能力（计划能力、组织能力、协调能力、宣传能力）', '“爱心大行动”', '动员同学朋友参加义卖，义卖的商品可以是批发的商品、自己的二手物品或是企业捐赠的产品，义卖的收入捐助贫困山区失学儿童或本地福利院。', ' 事先做好动员工作，并与被捐助方取得联系', '提供计划书、义卖过程与捐助时的照片、记录义卖过程中遇到的困难及解决的方式及自己的心得感受。', '提交照片、上传文档', 0, 0, 0, 1399987481, '李鸥鸥'),
(31, ' 提升社会责任感', '参加志愿服务', '参加社会实践的志愿服务，如暑期三下乡、敬老院或社区志愿服务、乡村支教等。记录感受与心得，另附照片', ' 积极关注志愿服务相关的信息', '自主寻找志愿服务的方式，并记录志愿服务期间的感受与心得\r\n', '提交感受与心得的文档、并附照片', 0, 0, 0, 1399987539, '李鸥鸥'),
(32, '了解撰写通知的基本方法，培养应聘者公文撰写能力', '撰写会议通知', '在某某公司要在元旦举行公司十年庆典活动，请你以该公司的名义给员工写一份参加庆典的通知。\r\n', ' 写明庆典的时间地点、事项、要求等。\r\n', '学写通知稿的基本要求，并完成该活动通知。\r\n', '上传活动通知稿。', 0, 0, 0, 1399987619, '张牧'),
(33, ' 寻求长辈对自己的意见与建议', '认识自己', '寻找一到两位自己以前的老师，至少是三年以前教过自己的老师。引导老师回忆对自己当年的印象，说出自己的某些不足。对比老师的谈话，找出自己仍然存在的问题及已经改进的方面。', ' 寻找一位与自己长期有联系的老师，或者是对自己印象深刻的老师。找一个安静、轻松的环境。', '寻找一位老师，从老师那里得到一些意见与建议', '上传谈话后的心得感受', 0, 0, 0, 1399987677, '李鸥鸥'),
(34, ' 检验你与合作者的相互信任程度', '盲人与哑人', '选取一段路程复杂并且你不熟悉的的路段，哑人协助盲人走过这段路。要求：由你扮演盲人，邀请两位同伴，一位扮演哑人，一位负责拍摄整个过程。最后写出心得。', ' 需用布遮住盲人的眼睛。哑人全程不得发出声音，拍摄者不能提供任何帮助。', '选取较为复杂的路段，包括地形复杂，人员复杂等。哑人协助盲人走完全程。', '上传视频、文档', 0, 0, 0, 1399987730, '李鸥鸥'),
(35, ' 学会倾听、学会沟通', '访谈一名成功人士', '选取任何以为你觉得在某方面有所成就的人士，可以是你的师长、可以是某个企业家，倾听他们的人生故事，可以是成功经验，也可以是失败的教训。', ' 访谈前尽可能多的获取对方的基本信息。与访谈者约好时间，在一个轻松的环境中进行。', '写出访谈前的准备、访谈的具体过程以及心得体会\r\n', '提交文档', 0, 0, 0, 1399987784, '李鸥鸥'),
(36, ' 将理论运用于实践', '学以致用', '学习一本理财书籍，并用自己的零花钱进行理财。可以选择任何方式。并记录每一阶段的信息与数据汇总，以及这一阶段选取此种理财方式的原因与成效', ' 多向朋友及老师请教', '提供任务完成的过程及自己的心得、及各个阶段的照片', '提交文档、照片', 0, 0, 0, 1399987840, '李鸥鸥'),
(37, ' 考查对全新环境的适应能力', '一次说走就走的旅行  ', '计划一次说走就走的旅行，可以有朋友结伴而行。记录旅行前的计划，旅途中遇到的困难与解决方式，旅途后的感悟与反思。并附上旅行照片。\r\n', ' 旅行前咨询有经验的朋友，查看相关攻略，安排好线路、行程。', '记录旅行前的计划、旅途中的困难与解决方式、感悟。另附照片', '上传文档及照片', 0, 0, 0, 1399987892, '李鸥鸥'),
(38, '培养考察应聘者逻辑能力、办公软件应用能力、对公司的熟悉度。', '绘制一张组织结构图 ', '在规定时间内了解你关注企业的行政组织结构，绘制一张组织结构图。\r\n', '先分清基本的组织结构系统，再划分好各级之间的隶属关系，用层级表示。\r\n', '用Excel、word等办公软件制作。\r\n', '上传结构图。', 0, 0, 0, 1399987948, '张牧'),
(39, ' 加强面对面沟通的能力', '参加一次面试', '在三个月内参加一次面试，面试完成后写出面试的具体情况及对自己面试情况的具体评价（涉及到具体问题），并给自己打分（总分100分）。文档中请提供面试的职位、公司、具体联系方式。', ' 可通过应届生求职网http://www.yingjiesheng.com/等寻找面试机会，面试前请认真准备个人简历', '参加面试、写出面试具体情况与自我评价、给自己评分\r\n', '提交文档', 0, 0, 0, 1399988041, '李鸥鸥'),
(40, ' 学会克服倾听中存在的主观障碍', '看故事做判断', '在二十分钟内阅读并回答问题', ' 注意人物的称谓与事情发生的先后顺序，切勿结合自己的经验、惯例对事物进行判断。', '完成阅读后对后续的十个问题做出判断\r\n   一个商人刚关上店里的灯，一男子来到店堂并索要钱款。店主打开收银机，收银机内的东西被倒了出来，而那个男子逃走了。一位警察很快接到报案\r\n请仔细阅读故事后，并在“对”“错”“不确定”三者中圈出你认为正确的答案。\r\n（1）店主将店堂内的灯关掉后，一男子到达\r\n（2）抢劫者是一男子\r\n（3）来的那个男子没有索要钱款\r\n（4）打开收银机的那个男子是店主\r\n（5）店', '提交答案', 0, 0, 0, 1399988102, '李鸥鸥'),
(41, '培养考察应聘者的自学能力、公文写作能力。\r\n', '学写会议记录 ', '在规定的时间内学习了解会议记录基本要求，并根据自己参与的某次会议内容，撰写会议记录。\r\n', ' 可通过网络、书籍等方式学习正规的会议记录要求。\r\n', '记录会议内容。\r\n', '上传会议照片，及会议记录。', 0, 0, 0, 1399988180, '张牧'),
(42, ' 使应聘者了解自我职业规划的大致方向及个人所适合的职业等。', '职业测评', '①领取任务者可以结合个人需求，了解八类职业测评的相关背景、测试目的等，并在规定时间内完成相应的测评题目。\r\n          写一份测评报告（分析总结自己的测评结果）\r\n            根据测评报告对自己做一份完整的职业规划书\r\n', ' 由91频道提供八类职业测评方式的简介及测评目的，领取任务者也可通过主流媒体了解八类测评的背景、发展历史及测评的可信度、准确度等相关信息。\r\n在规定时间内所提交的测评报告及职业规划书的质量', '领取任务者需点击链接，在线完成八类职业测评试卷：\r\n              \r\n1、霍兰德职业兴趣测试\r\n               http://www.xjy.cn/ceping/3.htm#main\r\n2、新精英职业健康度测评\r\n http://www.xjy.cn/ceping/careerhealth.htm#main\r\n3、测测你的人生终极关键词？\r\n http://www.xj', '在规定时间内所提交的测评报告及职业规划书的质量', 0, 0, 0, 1399988235, '陆锦辉'),
(43, ' 培养考察应聘者的写作能力。\r\n', '给公司老板拟讲话稿', '在规定的时间内学习了解演讲稿的写作技巧，并为老板写一份公司十周年庆典上的讲话稿。\r\n', ' 注意发言人物、发言对象、发言场合等。\r\n', '完成发言稿。\r\n', '上传发言稿。', 0, 0, 0, 1399988402, '张牧'),
(44, '  掌握同理心倾听的基本方法', '阅读书籍', '选择阅读《同理心：站在老板的角度发现更好的前途》、《同理心训练》和《仁慈的吸引力》，然后写读后感', '  阅读书籍数量不限，可自主选择。', '阅读提供的书籍，然后完成读后感的写作', '上传读后感', 0, 0, 0, 1400052962, '刘明'),
(45, ' 对同理心倾听的技能有深入的了解和掌握', '技能整理', '通过各种途径收集和整理同理心倾听的技能，然后分门别类的整理成文本形式', '  需要掌握快速截取所需信息的能力，发现各种可能的渠道。', '上网搜集资料；阅读相关文集、书籍、数据等等。', '上传“同理心倾听技能”的文本形式', 0, 0, 0, 1400052945, '刘明'),
(46, ' 掌握同理心倾听的基本方法', '玩游戏：我猜我猜我猜猜猜', '', ' 在游戏的过程中，去体会同理心倾听的魅力', '找几个人一起玩这个游戏，要求参与者写下对任务领取者的书面评价', '上传游戏视频及其出面评价的文稿', 0, 0, 0, 1400053299, '刘明'),
(47, ' 使任务领取者能够在顺利地运用“迈克尔·普尔迪调查结果",在工作和生活中成为一个好的倾听者', '倾听对照训练', '首先，学会运用”迈克尔·普尔迪调查结果“，然后运用这项技能做2个人的倾听对照训练', ' 在进行对照训练的过程中，要下意识地区运用到”迈克尔 普尔迪调查结果“这项技能，否则视为无效。', '将对照训练的过程拍摄成为视频，参与者为任务领取者写一个书面评价', '上传视频、图片、文本', 0, 0, 0, 1400053844, '刘明'),
(48, ' 培养善于与人沟通的能力', '阅读书籍', '阅读美国作家科兹、凯逊的《承认不完美，心灵才自由》、严冬冬校译的《少有人走的路》，然后写读后感', '阅读的书籍可增可减，自选。但是要求书籍代表性强烈', '完成规定量的书籍阅读，并且完成读后感的写作任务', '上传读后感', 0, 0, 0, 1400054271, '刘明'),
(49, ' 在人际交往中，提高任务领取者善于与人沟通的能力', '涉及对白', '设计不少于20句在认识一个新朋友时的对白', ' 在对白设计中，考虑要全面。既要具有可以实行的条件和意义，也是考虑对方是否能够接受', '回忆自己在认识新同学时说过的话；阅读相关的书籍；找身边的同学/朋友讨论；', '上传文本', 0, 0, 0, 1400054796, '刘明'),
(50, '提高任务领取者在人际交往方面，善于与别人沟通的能力', '结识新朋友', '在91频道上面去认识1-2个新朋友，或者在生活/工作中去认识1-2个新朋友', ' 完成结识新朋友的这项任务，对于内心的任务领取者来说，最重要的是要有勇气，战胜自己。', '和新朋友合影留念，呼唤联系方式', '91频道的朋友，可以相互认证。现实生活中认识的朋友，可以上传照片', 0, 0, 0, 1400055105, '刘明'),
(51, ' 提高任务领取者在人际交往中善于与人沟通的能力', '玩游戏：快乐传真', '8个人组成一队，依次排开，主持人把题目给第一个人看(其他人不能看），然后第一个人通过肢体语言向第二个人传递信息，依次往下，传到最后一个人，由最后一个人说出题目', ' 游戏不是目的，目的是掌握与人沟通的技能', '任务领取者可以找领取了相同任务的人或者召集自己身边的人一起玩这个”快乐传真“的游戏。游戏完成后，各自说一下感想。', '上传游戏视频，91频道人员可以互相认证，上传感想', 0, 0, 0, 1400055503, '刘明'),
(52, ' 提高任务领取者在人际交往方面处理日常冲突的能力', '运用”托马斯吉尔曼模式“管理冲突', '情境：要实施一项不受团队成员欢迎的重大措施时\r\n例如：财务部决定缩减公司开支，严格公司报销制度，怎么办？', ' 首先，任务领取者要仔细地研究和学习”托马斯吉尔曼模式”。其次，要运用该模式中，多加练习', '按照”托马斯吉尔曼模式“来解决案例，并生成文本', '上传文本', 0, 0, 0, 1400055962, '刘明'),
(53, ' 通过相关书籍的阅读，提高任务领取者在人际交往中解决冲突的能力', '双向沟通', '阅读刘庸的《说话的魅力—你不可不知的沟通技巧》、安东编的《最实用 的101个职场沟通技巧》，然后以“及时进行双向沟通对解决冲突的重要性”为题做文章。', ' 写作主题不变，阅读的书籍可自选', '完成书籍的阅读，然后写文章', '上传文章', 0, 0, 0, 1400056450, '刘明'),
(54, ' 培养任务领取者在人际交往中向他人提供帮助和建议的能力。', '运用“头脑风暴法”进行一次讨论', '运用“头脑风暴法”，自拟主题，组织一次讨论', ' ', '学习“头脑风暴法”，写一篇“我对头脑风暴法的认识”。拟定主题，组织讨论小组进行讨论。', '上传文章。上传视频', 0, 0, 0, 1400057069, '刘明'),
(55, ' 提高任务领取者在人际交往中主动向他人提出帮助和建议的能力', '玩游戏:"倾听“与”反馈“', '3个人角色轮流，”倾听者“、”反馈者“、”观测者“，每轮交流5分钟。三个角色轮完后，三个人进行交流和讨论，并且互相提出帮助和建议', ' 讨论成员建议找91频道里的任务领取者，避免讨论不严谨，成果不突出的问题', '玩游戏，任务领取者写心得体会，并且将参与者的帮助和建议整理成为文本形式', '上传心得体会和整理的建议文本', 0, 0, 0, 1400057800, '刘明'),
(56, ' 提高任务领取者的语言表达能力，能够顺畅表达自己的意图', '游戏：走出地雷战', '准备10张白纸做地雷，在一片空地上随机摆放，一个蒙住眼睛过地雷战，另一个队员站在外围用语言指示，踩到地雷退回原点再次出发，直到成功到达终点。', ' 任务领取者在这个游戏中的定位一定要是语言上的引导者，以便更好的取得实际效果', '任务领取者找一名同伴作为场内行动者，自己做语言上的引导者，完成游戏。最后，反思成功或者失败的原因，总结出”如何才能使别人更好的了解自己的意图？“', '上传文本', 0, 0, 0, 1400064350, '刘明'),
(57, ' 提高任务领导者的语言表达能力，使其能够能够顺畅表达自己的意图', '小组讨论', '在课堂上，积极参与小组讨论', ' 完成这项任务，主要是要发挥积极主动的学习态度。', '参与讨论，并收集小组其他成员的意见和建议，编写文档', '上传文档', 0, 0, 0, 1400065083, '刘明'),
(58, '  提高任务领取者的语言表达能力，使其能够很流畅地进行演讲和演示', '公开演讲', '进行一个5-10分钟的公开演讲，结束后写一篇500字的自评', '  在演讲之前，做准备。拟定题目、演讲内容、写提纲和演讲稿，试讲，正式参赛。', '专注课间十分钟的休息时间，站上讲台，选任意题做一次公开演讲', '上传演讲视频、演讲稿件及其自评', 0, 0, 0, 1400074049, '刘明'),
(59, '  提高任务领取者的语言表达能力，使其能够很流畅地进行演讲和演示', '阿兰·门罗的“门罗促动顺序”', '学会在演讲中运用阿兰·门罗的“门罗促动顺序”。', ' "门罗促动顺序“的内容 \r\nhttp://baike.so.com/doc/1755961.html', '首先，学习“门罗促动顺序”，写学习心得。其次，注重实践，通过视频介绍“门罗促动顺序”，必须包含的内容：', '上传学习心得。演讲视频。', 0, 0, 0, 1400073883, '刘明'),
(60, ' 提高任务领取者的语言表达能力，使其能够自己设计、组织一场培训课程', '写培训方案', '以“提高应该四六级的过级能力”为主题，写一个组织培训方案。', ' 上”管理资源吧“学习方案写作模式\r\nhttp://www.glzy8.com/list/2/', '完成方案写作，生成文本形式', '上传文本', 0, 0, 0, 1400065941, '刘明'),
(61, ' 提高任务领取者的语言表达能力，使其能够自己设计、组织一场培训课程', '组织技能教学', '在任意时间，聚集10名以上人员，教会他们一项技能，如变魔术、踢足球进球的秘诀等等', ' 在技能选择上要做到对参与者具有很强的吸引力', '组织活动，并且确保7成以上参与人员掌握了技能', '上传视频', 0, 0, 0, 1400066178, '刘明'),
(62, ' 提高任务领取者的语言表达能力，使其能够具有较强的说服别人的能力', '阅读卡耐基的《人性的缺点》', '阅读卡耐基的《人性的缺点》，写读后感', ' 对于阅读书籍的选择可自选，具有典型性就可', '阅读书籍，完成读后感的写作', '上传文本', 0, 0, 0, 1400066425, '刘明'),
(63, ' 提高任务领取者的语言表达能力，使其能够具有较强的说服别人的能力', '掌握说服法', '至少掌握以下说服法中的1-2种方法。如：苏格拉底说服法、杜威的“使人信”五步定式、暗示说服法、对比说服法等。', ' 注重理论与实践相结合', '选择两个自己感兴趣的说服法，并加以运用', '运用说服法说服身边的人加入91频道，并上传你使用的说服法及其使用情况', 0, 0, 0, 1400066616, '刘明');

-- --------------------------------------------------------

--
-- 表的结构 `cms_task_custom`
--

CREATE TABLE IF NOT EXISTS `cms_task_custom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL COMMENT '企业id',
  `recruit_id` int(11) NOT NULL COMMENT '岗位id',
  `name` varchar(100) NOT NULL COMMENT '任务名称',
  `content` text NOT NULL COMMENT '任务内容',
  `gold` int(11) NOT NULL COMMENT '消耗的91币',
  `score` float NOT NULL COMMENT '获得的学分',
  `starttime` int(11) NOT NULL COMMENT '开始时间',
  `endtime` int(11) NOT NULL COMMENT '结束时间',
  `ctime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `cms_task_custom`
--

INSERT INTO `cms_task_custom` (`id`, `cid`, `recruit_id`, `name`, `content`, `gold`, `score`, `starttime`, `endtime`, `ctime`) VALUES
(1, 1, 2, '前端工程师', '精通js', 5, 2, 1393927072, 1394791074, 1396173475);

-- --------------------------------------------------------

--
-- 表的结构 `cms_task_member`
--

CREATE TABLE IF NOT EXISTS `cms_task_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL COMMENT '用户id',
  `type` tinyint(2) NOT NULL COMMENT '任务类型，1基本2特定',
  `task_id` int(11) NOT NULL COMMENT '任务id',
  `is_receive` tinyint(2) NOT NULL COMMENT '是否领取,0否1是',
  `receive_time` int(11) NOT NULL COMMENT '领取时间',
  `is_achieve` tinyint(2) NOT NULL COMMENT '任务状态，1完成0未完成',
  `achieve_time` int(11) NOT NULL COMMENT '完成时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `cms_task_member`
--


-- --------------------------------------------------------

--
-- 表的结构 `cms_task_system`
--

CREATE TABLE IF NOT EXISTS `cms_task_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '积分动作',
  `alias` varchar(50) NOT NULL COMMENT '积分名称',
  `gold` int(11) NOT NULL COMMENT '91币值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `cms_task_system`
--


-- --------------------------------------------------------

--
-- 表的结构 `cms_visit_history`
--

CREATE TABLE IF NOT EXISTS `cms_visit_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(2) NOT NULL COMMENT '1：会员2：企业',
  `fid` int(11) NOT NULL COMMENT '访问者id',
  `bid` int(11) NOT NULL COMMENT '被访问者id',
  `ctime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- 转存表中的数据 `cms_visit_history`
--

INSERT INTO `cms_visit_history` (`id`, `type`, `fid`, `bid`, `ctime`) VALUES
(1, 2, 33, 1, 1399968982),
(2, 2, 33, 2, 1398756638),
(3, 2, 5, 1, 1397478479),
(4, 1, 5, 33, 1399629785),
(5, 1, 6, 33, 1399721512),
(6, 2, 6, 1, 1399275865),
(7, 1, 33, 5, 1399630073),
(8, 1, 33, 6, 1399721496),
(10, 1, 0, 5, 1397537635),
(11, 1, 7, 33, 1397962113),
(12, 1, 33, 7, 1399549604),
(13, 1, 33, 44, 1399721644),
(14, 1, 44, 33, 1398751612),
(15, 1, 44, 6, 1397725111),
(16, 2, 33, 5, 1399630175),
(17, 1, 5, 44, 1397726156),
(18, 1, 5, 6, 1399190793),
(19, 1, 33, 43, 1399721554),
(20, 1, 43, 33, 1398256250),
(21, 1, 43, 8, 1399191091),
(22, 1, 33, 8, 1399883794),
(23, 1, 8, 5, 1397805651),
(24, 1, 8, 33, 1399549952),
(25, 1, 0, 8, 1397891139),
(26, 1, 7, 44, 1397960597),
(27, 2, 7, 1, 1397963746),
(28, 2, 43, 1, 1397982240),
(29, 2, 44, 1, 1397972994),
(30, 2, 44, 2, 1397973000),
(31, 1, 8, 7, 1397980225),
(32, 1, 43, 6, 1399290558),
(33, 1, 43, 44, 1397982209),
(34, 1, 43, 5, 1398690114),
(35, 1, 7, 43, 1399191055),
(36, 1, 0, 33, 1397984761),
(37, 2, 6, 2, 1397985000),
(38, 1, 5, 7, 1398751193),
(39, 1, 44, 5, 1398751463),
(40, 1, 33, 0, 1399721648),
(41, 2, 0, 2, 1398768034),
(42, 1, 6, 7, 1399190829),
(43, 1, 8, 6, 1399191118),
(44, 1, 6, 0, 1399693805);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
