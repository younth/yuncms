-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 04 月 20 日 02:52
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理员信息表' AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `cms_admin`
--

INSERT INTO `cms_admin` (`id`, `groupid`, `username`, `password`, `realname`, `lastlogin_time`, `lastlogin_ip`, `iflock`) VALUES
(1, 1, 'admin', '168a73655bfecefdb15b14984dd2ad60', '王洋', 1397912682, 'unknown', 0),
(8, 3, 'test', '168a73655bfecefdb15b14984dd2ad60', '测试', 0, '', 0);

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
(1, '862820606@qq.com', 'df85a226d7e42ef723f21c4c48352b1a', '云作坊', '20140404/thumb_1396624421.png', ',000000,100054,100057', ',000000,100060,100063', '0731-89676708', 's638,s40,s42,s20', '计算机软件+互联网+通信+保险', '长沙理工大学', 'http://wy.yunstudio.net/', '    大学生科技交流平台是一个科技学术交友的平台，并兼有科技交流、名师检索、资料下载、赛事预览、在线报名等功能。 立足于服务学生，以增强在校大学生科技创新与学术交流的氛围为宗旨，以提高大学生的科技创新素质为目标。在线组队，在线交友，在竞争中锻炼自我， 在合作中提升能力。同时加强对科技学术类赛事的管理，提高研究工作实效，推动在校大学生的科技创新活动的开展。 沟通是进步的桥梁，合作是发展的阶梯， 全校的科技学术爱好者齐聚一堂。资料下载、发帖、组队、求名师一气呵成，为我们的科技创新拓宽了视野、提供了空间、觅得了挚友、奠定了基础， 在我们的成功之路上迈出了关键的一步！关注大学生科技交流平台，带给你不一样的精彩。\r\n<br>\r\n<br>\r\n<br>好吧', 0, '', 1397726535, '', '20140404/thumb_1396625120.png', 1, 1, 0, 1),
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

--
-- 转存表中的数据 `cms_company_fans`
--

INSERT INTO `cms_company_fans` (`id`, `mid`, `cid`, `score`, `ctime`) VALUES
(68, 5, 1, 0, 1397478476),
(67, 5, 5, 0, 1397478476),
(64, 1, 1, 0, 1397230672),
(63, 1, 5, 0, 1397230672),
(66, 33, 1, 0, 1397281522),
(65, 33, 5, 0, 1397281522);

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
  `is_repost` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否转发,0否1是',
  `is_audit` int(11) NOT NULL DEFAULT '1' COMMENT '是否审核,0否1是',
  `feed_content` text NOT NULL COMMENT '心情内容',
  `feed_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '动态类型,0原创1评论2转发3回复',
  `comment_count` int(11) NOT NULL DEFAULT '0' COMMENT '评论数',
  `repost_count` int(11) NOT NULL DEFAULT '0' COMMENT '转发数',
  `praise_count` int(11) NOT NULL DEFAULT '0' COMMENT '赞数',
  `ctime` int(11) NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=90 ;

--
-- 转存表中的数据 `cms_feed`
--

INSERT INTO `cms_feed` (`id`, `mid`, `fid`, `fmid`, `oid`, `is_repost`, `is_audit`, `feed_content`, `feed_type`, `comment_count`, `repost_count`, `praise_count`, `ctime`) VALUES
(1, 7, NULL, NULL, NULL, 1, 1, 'fdsafds', 0, 0, 0, 0, 1397098685),
(2, 7, NULL, NULL, NULL, 1, 1, 'fdasf', 0, 0, 0, 0, 1397098697),
(3, 7, NULL, NULL, NULL, 1, 1, 'fdsafasd', 0, 0, 0, 0, 1397098712),
(4, 7, NULL, NULL, NULL, 1, 1, 'fdadfsa', 0, 0, 0, 0, 1397098833),
(5, 7, NULL, NULL, NULL, 1, 1, 'gasd', 0, 0, 0, 0, 1397098861),
(6, 7, NULL, NULL, NULL, 1, 1, 'fda', 0, 0, 0, 0, 1397099322),
(7, 7, NULL, NULL, NULL, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/0b/tootha_thumb.gif" height="22" width="22" />', 0, 0, 0, -3, 1397131081),
(8, 7, NULL, NULL, NULL, 1, 1, '你好你好，习近平，', 0, 0, 0, 0, 1397278446),
(9, 7, NULL, NULL, NULL, 1, 1, '共产党', 0, 0, 0, 0, 1397278547),
(10, 7, NULL, NULL, NULL, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/6a/laugh.gif" height="22" width="22" />', 0, 0, 0, 0, 1397278813),
(11, 7, NULL, NULL, NULL, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/6a/laugh.gif" height="22" width="22" />', 0, 0, 0, 0, 1397279108),
(12, 7, NULL, NULL, NULL, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/1a/bs_thumb.gif" height="22" width="22" />', 0, 0, 0, 0, 1397279121),
(13, 7, NULL, NULL, NULL, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/81/rabbit_thumb.gif" height="22" width="22" />', 0, 0, 0, 0, 1397279390),
(14, 7, NULL, NULL, NULL, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/70/88_thumb.gif" height="22" width="22" />', 0, 0, 0, 0, 1397279595),
(15, 7, NULL, NULL, NULL, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/1a/bs_thumb.gif" height="22" width="22" />', 0, 0, 0, 0, 1397279634),
(16, 7, NULL, NULL, NULL, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/6d/zhh_thumb.gif" height="22" width="22" />', 0, 0, 0, 0, 1397279757),
(17, 7, NULL, NULL, NULL, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/c7/no_thumb.gif" height="22" width="22" />', 0, 0, 0, 0, 1397279763),
(18, 7, NULL, NULL, NULL, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/62/crazya_thumb.gif" height="22" width="22" />', 0, 12, 2, 1, 1397279806),
(19, 7, 18, 7, NULL, 1, 1, '范德萨分四大发', 1, 0, 0, 0, 1397280851),
(20, 7, 18, 7, NULL, 1, 1, '放大放大上', 1, 0, 0, 0, 1397280875),
(21, 7, 18, 7, NULL, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/6a/laugh.gif" height="22" width="22" />', 1, 0, 0, 0, 1397289993),
(22, 7, 18, 7, NULL, 1, 1, '范德萨发撒旦', 1, 0, 0, 0, 1397291784),
(23, 7, 18, 7, 18, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/d9/dizzya_thumb.gif" height="22" width="22" />', 1, 0, 0, 0, 1397292769),
(24, 7, 23, 7, 18, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/bc/fuyun_thumb.gif" height="22" width="22" />', 3, 0, 0, 0, 1397298144),
(25, 7, 18, 7, 18, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/1a/bs_thumb.gif" height="22" width="22" />', 1, 0, 0, 0, 1397298659),
(26, 7, 18, 7, 18, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/d9/dizzya_thumb.gif" height="22" width="22" />', 1, 0, 0, 0, 1397299343),
(27, 7, 18, 7, 18, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/a5/cza_thumb.gif" height="22" width="22" />', 1, 0, 0, 0, 1397299433),
(28, 7, 27, 7, 18, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/8f/qq_thumb.gif" height="22" width="22" />', 3, 0, 0, 0, 1397299439),
(29, 7, 27, 7, 18, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/5c/yw_thumb.gif" height="22" width="22" />', 3, 0, 0, 0, 1397299471),
(30, 7, 27, 7, 18, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/b6/sb_thumb.gif" height="22" width="22" />', 3, 0, 0, 0, 1397299774),
(31, 7, 30, 7, 18, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/8f/qq_thumb.gif" height="22" width="22" />', 3, 0, 0, 0, 1397300025),
(32, 7, 31, 7, 18, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/70/88_thumb.gif" height="22" width="22" />', 3, 0, 0, 0, 1397300068),
(33, 7, 32, 7, 18, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/af/cry.gif" height="22" width="22" />', 3, 0, 0, 0, 1397300099),
(34, 7, 18, 7, 18, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/5c/yw_thumb.gif" height="22" width="22" />', 2, 0, 0, 0, 1397305265),
(35, 7, 18, 7, 18, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/81/rabbit_thumb.gif" height="22" width="22" />', 2, 0, 1, 0, 1397317222),
(36, 7, 35, 7, 18, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/b6/sb_thumb.gif" height="22" width="22" />', 2, 0, 1, 0, 1397317234),
(37, 7, 36, 7, 18, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/af/cry.gif" height="22" width="22" />', 2, 0, 1, 0, 1397317295),
(38, 7, 37, 7, 18, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/6b/sleepa_thumb.gif" height="22" width="22" />', 2, 0, 0, 0, 1397317564),
(39, 7, NULL, NULL, NULL, 1, 1, '发个图片试试', 0, 0, 0, 0, 1397388619),
(40, 7, NULL, NULL, NULL, 1, 1, '发个图片试试', 0, 0, 1, 0, 1397388665),
(41, 7, NULL, NULL, NULL, 1, 1, '再发个图片试试', 0, 0, 1, 0, 1397388750),
(42, 7, 41, 7, 41, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/81/rabbit_thumb.gif" height="22" width="22" />', 2, 0, 1, 0, 1397389745),
(43, 7, 42, 7, 41, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/c3/zy_thumb.gif" height="22" width="22" />', 2, 0, 0, 0, 1397389969),
(44, 7, 40, 7, 40, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/98/yhh_thumb.gif" height="22" width="22" />', 2, 0, 0, 0, 1397389981),
(45, 7, NULL, NULL, NULL, 1, 1, '是生死是是是试试哈斯是', 0, 0, 0, 0, 1397390592),
(46, 7, NULL, NULL, NULL, 1, 1, '哈哈哈哈哈哈哈', 0, 0, 0, 0, 1397390699),
(47, 7, NULL, NULL, NULL, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/d8/good_thumb.gif" height="22" width="22" />', 0, 1, 0, 0, 1397390749),
(48, 7, NULL, NULL, NULL, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/5c/yw_thumb.gif" height="22" width="22" />', 0, 0, 0, 0, 1397390803),
(49, 7, NULL, NULL, NULL, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/24/sweata_thumb.gif" height="22" width="22" />', 0, 0, 0, 0, 1397391651),
(50, 7, 47, 7, 47, 1, 1, 'mi', 1, 0, 0, 0, 1397391680),
(51, 7, NULL, NULL, NULL, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/ac/smilea_thumb.gif" height="22" width="22" />', 0, 1, 0, 1, 1397651562),
(52, 7, 51, 7, 51, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/0b/tootha_thumb.gif" height="22" width="22" />', 1, 0, 0, 0, 1397703432),
(53, 7, NULL, NULL, NULL, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/5c/yw_thumb.gif" height="22" width="22" />', 0, 0, 0, 0, 1397714143),
(54, 7, NULL, NULL, NULL, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/36/gza_thumb.gif" height="22" width="22" />哈哈哈哈，我做的页面好漂亮啊', 0, 0, 0, 0, 1397718985),
(55, 7, NULL, NULL, NULL, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/36/gza_thumb.gif" height="22" width="22" />', 0, 0, 1, 0, 1397719046),
(56, 7, NULL, NULL, NULL, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/81/rabbit_thumb.gif" height="22" width="22" />', 0, 0, 1, 0, 1397719258),
(57, 7, 56, 7, 56, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/14/tza_thumb.gif" height="22" width="22" />', 2, 12, 0, 1, 1397721103),
(58, 7, 57, 7, 57, 1, 1, '的DSA 打撒DSA 打撒<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/bc/fuyun_thumb.gif" height="22" width="22" />', 1, 0, 0, 0, 1397751507),
(59, 7, 57, 7, 57, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/6e/panda_thumb.gif" height="22" width="22" />', 1, 0, 0, 0, 1397808147),
(60, 7, 57, 7, 57, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/89/hufen_thumb.gif" height="22" width="22" />', 1, 0, 0, 0, 1397808186),
(61, 7, 57, 7, 57, 1, 1, 'gfsdgfsgfds', 1, 0, 0, 0, 1397808691),
(62, 7, 57, 7, 57, 1, 1, 'fdsaf sadf', 1, 0, 0, 0, 1397809192),
(63, 7, 57, 7, 57, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/20/alizuoguiliannew_thumb.gif" height="22" width="22" />', 1, 0, 0, 0, 1397810120),
(64, 7, 57, 7, 57, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/bc/otm_thumb.gif" height="22" width="22" />', 1, 0, 0, 0, 1397810143),
(65, 7, 64, 7, 57, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/c4/liwu_thumb.gif" height="22" width="22" />', 3, 0, 0, 0, 1397810149),
(66, 7, 64, 7, 57, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/6e/panda_thumb.gif" height="22" width="22" />', 3, 0, 0, 0, 1397811110),
(67, 7, 66, 7, 57, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/91/lazu_thumb.gif" height="22" width="22" />', 3, 0, 0, 0, 1397821835),
(68, 7, 67, 7, 57, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/7f/sleepya_thumb.gif" height="22" width="22" />', 3, 0, 0, 0, 1397821898),
(69, 7, 55, 7, 55, 1, 1, 'fdsafdsafasd ', 2, 0, 1, 0, 1397825486),
(70, 7, 69, 7, 55, 1, 1, 'tgretertrewtewrt', 2, 0, 2, 0, 1397825793),
(71, 7, 70, 7, 55, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/bc/otm_thumb.gif" height="22" width="22" />', 2, 0, 0, 0, 1397825879),
(72, 7, 70, 7, 55, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/af/kl_thumb.gif" height="22" width="22" />', 2, 1, 1, 0, 1397827890),
(73, 7, 72, 7, 55, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/e9/sk_thumb.gif" height="22" width="22" />', 2, 7, 0, 0, 1397827908),
(74, 7, 73, 7, 73, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/af/kl_thumb.gif" height="22" width="22" />', 1, 0, 0, 0, 1397828118),
(75, 6, 73, 7, 73, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/f2/wg_thumb.gif" height="22" width="22" />', 1, 0, 0, 0, 1397909205),
(76, 6, 73, 7, 73, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/a6/x_thumb.gif" height="22" width="22" />', 1, 0, 0, 0, 1397909291),
(77, 6, 57, 7, 57, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/14/tza_thumb.gif" height="22" width="22" />', 1, 0, 0, 0, 1397909310),
(78, 6, NULL, NULL, NULL, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/58/mb_thumb.gif" height="22" width="22" />', 0, 0, 0, 1, 1397909556),
(79, 6, NULL, NULL, NULL, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/6b/sleepa_thumb.gif" height="22" width="22" />范德萨仿盛大发生非盛大', 0, 0, 0, 0, 1397909659),
(80, 6, NULL, NULL, NULL, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/a5/cza_thumb.gif" height="22" width="22" />', 0, 0, 0, 0, 1397909704),
(81, 6, NULL, NULL, NULL, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/9e/t_thumb.gif" height="22" width="22" />', 0, 0, 0, 0, 1397909775),
(82, 6, NULL, NULL, NULL, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/24/sweata_thumb.gif" height="22" width="22" />', 0, 0, 1, 0, 1397909821),
(83, 6, 82, 6, 82, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/c9/geili_thumb.gif" height="22" width="22" />', 2, 0, 0, 0, 1397909833),
(84, 7, 73, 7, 73, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/5c/yw_thumb.gif" height="22" width="22" />', 1, 0, 0, 0, 1397910172),
(85, 7, 76, 7, 73, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/af/kl_thumb.gif" height="22" width="22" />', 3, 0, 0, 0, 1397911334),
(86, 7, 76, 7, 73, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/c9/geili_thumb.gif" height="22" width="22" />', 3, 0, 0, 0, 1397911348),
(87, 7, 72, 7, 72, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/bc/fuyun_thumb.gif" height="22" width="22" />', 1, 0, 0, 0, 1397911729),
(88, 7, 76, 6, 73, 1, 1, '<img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/bc/otm_thumb.gif" height="22" width="22" />', 3, 0, 0, 0, 1397911823),
(89, 33, NULL, NULL, NULL, 1, 1, '测试', 0, 0, 0, 0, 1397959903);

-- --------------------------------------------------------

--
-- 表的结构 `cms_feedback`
--

CREATE TABLE IF NOT EXISTS `cms_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL COMMENT '标题',
  `content` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `ctime` int(11) NOT NULL,
  `is_reply` tinyint(2) NOT NULL COMMENT '是否已读',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `cms_feedback`
--

INSERT INTO `cms_feedback` (`id`, `title`, `content`, `email`, `ctime`, `is_reply`) VALUES
(2, '测试留言', '留言测试啊', 'yunstudio2012@qq.com', 0, 1),
(3, '测试留言2', '测试留言2', 'yunstudio2012@qq.com', 0, 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=78 ;

--
-- 转存表中的数据 `cms_feed_digg`
--

INSERT INTO `cms_feed_digg` (`id`, `mid`, `feed_id`, `ctime`) VALUES
(72, 7, 57, 1397747021),
(77, 7, 78, 1397913521),
(71, 7, 51, 1397746884),
(52, 7, 18, 1397300361);

-- --------------------------------------------------------

--
-- 表的结构 `cms_feed_pic`
--

CREATE TABLE IF NOT EXISTS `cms_feed_pic` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `fid` int(11) NOT NULL COMMENT '心情ID',
  `url` varchar(200) NOT NULL COMMENT '地址',
  `thumb_url` varchar(200) NOT NULL COMMENT '缩略图地址',
  `ctime` int(11) NOT NULL COMMENT '创建时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_feed_pic`
--

INSERT INTO `cms_feed_pic` (`id`, `fid`, `url`, `thumb_url`, `ctime`) VALUES
(0, 40, '/91pindao/upload/member/img/4501397388653.jpg', '/91pindao/upload/member/img/thumb_4501397388653.jpg', 1397388665),
(0, 41, '/91pindao/upload/member/img/8081397388746.jpg', '/91pindao/upload/member/img/thumb_8081397388746.jpg', 1397388750),
(0, 45, '/91pindao/upload/member/img/3011397390581.jpg', '/91pindao/upload/member/img/thumb_3011397390581.jpg', 1397390592),
(0, 46, '/91pindao/upload/member/img/8551397390693.jpg', '/91pindao/upload/member/img/thumb_8551397390693.jpg', 1397390699),
(0, 47, '/91pindao/upload/member/img/7091397390742.jpg', '/91pindao/upload/member/img/thumb_7091397390742.jpg', 1397390749),
(0, 49, '/91pindao/upload/member/img/8821397391643.jpg', '/91pindao/upload/member/img/thumb_8821397391643.jpg', 1397391651),
(0, 53, '/91pindao/upload/member/img/3941397714136.jpg', '/91pindao/upload/member/img/thumb_3941397714136.jpg', 1397714143),
(0, 54, '/91pindao/upload/member/img/9541397718961.png', '/91pindao/upload/member/img/thumb_9541397718961.png', 1397718985),
(0, 55, '/91pindao/upload/member/img/4201397719039.jpg', '/91pindao/upload/member/img/thumb_4201397719039.jpg', 1397719046),
(0, 56, '/91pindao/upload/member/img/7301397719249.jpg', '/91pindao/upload/member/img/thumb_7301397719249.jpg', 1397719258);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `cms_group`
--

INSERT INTO `cms_group` (`id`, `name`, `power`) VALUES
(1, '超级管理员', '-1'),
(2, '普通管理员', '277,283,1,2,4,5,6,7,8,9,228,10,11,12,13,14,15,16,157,158,174,268,288'),
(3, 'test', '277,283,1,2,4,5,6,7,8,9,228');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=188 ;

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
(187, 1, 33, 'unknown', 1397962187);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- 转存表中的数据 `cms_member`
--

INSERT INTO `cms_member` (`id`, `login_email`, `password`, `uname`, `first_letter`, `ctime`, `regip`, `lasttime`, `lastip`, `is_active`, `is_init`, `last_feed_id`, `last_feed_time`) VALUES
(1, 'yunstudio2012@qq.com', 'd707c24bd27660ca7d65870027fb9218', 'admin', 'a', 1372135503, '', 1397230586, '', 1, 0, 0, 0),
(33, '825075713@qq.com', 'df85a226d7e42ef723f21c4c48352b1a', '王洋', 'W', 1396279141, '', 1397962187, '', 1, 0, 0, 0),
(5, '1161499602@qq.com', 'df85a226d7e42ef723f21c4c48352b1a', '蒲精', 'P', 1395580185, '', 1397910449, '', 1, 0, 0, 0),
(6, '1095620719@qq.com', 'df85a226d7e42ef723f21c4c48352b1a', '唐娜', 'T', 1395581194, '', 1397548435, '', 1, 0, 0, 0),
(7, '1103349641@qq.com', 'df85a226d7e42ef723f21c4c48352b1a', '赵杰', 'Z', 1395581233, '', 1397960567, '', 1, 0, 0, 0),
(8, '113771910@qq.com', 'df85a226d7e42ef723f21c4c48352b1a', '田书记', 'T', 1395581267, '', 1397885935, '', 1, 0, 0, 0),
(43, 'tianyufang@qq.com', 'df85a226d7e42ef723f21c4c48352b1a', '田玉方', 'T', 1397473278, '', 1397805423, '', 1, 0, 0, 0),
(44, '1085195131@qq.com', 'df85a226d7e42ef723f21c4c48352b1a', '易武', 'Y', 1397473574, '', 1397725099, '', 1, 0, 0, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- 转存表中的数据 `cms_member_card`
--

INSERT INTO `cms_member_card` (`id`, `send_id`, `rece_id`, `status`, `remark`, `ctime`) VALUES
(46, 33, 8, 2, '', 1397889502),
(16, 33, 6, 1, '', 1397720619),
(35, 5, 33, 2, '', 1397885893),
(20, 5, 44, 1, '', 1397726157),
(21, 5, 6, 1, '', 1397726159),
(24, 33, 44, 1, '', 1397784550),
(47, 7, 33, 2, '', 1397962207),
(45, 33, 43, 1, '', 1397889358);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

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
(19, 43, 2);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

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
(42, 2, 11, '', '748aa180e88f082056090250455f72bb');

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
(33, 1, '安徽,合肥', '长沙理工大学', '825075713', '14789998264', '湖南,长沙', '计算机科学与技术', '经济学,经济学相关类', '1', 1314806400, 1435680000, '招聘,兼职,找投资,投资项目,商务活动', 'linux,编程,php,mysql', NULL, '云作坊网络开发团队主管，开发了以&lt;大学生科技交流平台&gt;为核心的自主产品，科技立项一等奖，挑战杯校二等奖，创新实验项目。探索 出自主项目为主，商业项目为辅的团队发展模式。长沙理工大学第二届十佳自强之星，优秀毕业生。'),
(43, 0, '', '', '', '', NULL, '', NULL, NULL, 0, 0, NULL, NULL, NULL, ''),
(44, 0, '', '长沙理工大学', '', '', NULL, '计算机', '工学,仪器仪表相关类', '3', 537465600, 1169654400, NULL, NULL, NULL, ''),
(8, 0, '', '', '', '', NULL, '', NULL, NULL, 0, 0, NULL, NULL, NULL, ''),
(7, 0, '', '长沙理工大学', '', '', NULL, '计算机科学与技术', '工学,计算机相关类', '3', 979574400, 1484064000, NULL, NULL, NULL, ''),
(6, 1, ',', '北京林业大学', '', '', '湖南,长沙', '计算机科学与技术', '哲学,哲学相关类', '3', 1231948800, 1263830400, NULL, NULL, NULL, '我是唐娜'),
(5, 0, '江西,南昌', '北京大学', '4545', '1223', '湖南,长沙', '计算机', '经济学,财政学相关类', '3', -30268800, 1925481600, NULL, NULL, NULL, '我是长沙理工大学蒲精。');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=68 ;

--
-- 转存表中的数据 `cms_member_tag`
--

INSERT INTO `cms_member_tag` (`id`, `mid`, `tid`, `name`) VALUES
(36, 33, '100084', '公文写作'),
(35, 33, '100088', '表达能力'),
(34, 33, '100086', '沟通协调'),
(33, 33, '100091', 'photoshop'),
(30, 33, '100081', '商务谈判'),
(32, 33, '100104', 'flash'),
(17, 33, '100078', 'powerpoint'),
(16, 33, '100077', 'excel'),
(15, 33, '100076', 'word'),
(37, 33, '100084', '公文写作'),
(38, 33, '100084', '公文写作'),
(39, 33, '100080', 'outlook'),
(40, 5, '100087', '逻辑分析'),
(41, 5, '100081', '商务谈判'),
(42, 5, '100089', '创新能力'),
(43, 5, '100091', 'photoshop'),
(44, 33, '100076', 'word'),
(45, 33, '100078', 'powerpoint'),
(46, 33, '100080', 'outlook'),
(47, 33, '100081', '商务谈判'),
(48, 33, '100078', 'powerpoint'),
(49, 33, '100091', 'photoshop'),
(50, 33, '100077', 'excel'),
(51, 33, '100077', 'excel'),
(52, 33, '100078', 'powerpoint'),
(53, 33, '100091', 'photoshop'),
(54, 33, '100077', 'excel'),
(55, 33, '100091', 'photoshop'),
(56, 33, '100081', '商务谈判'),
(57, 33, '100084', '公文写作'),
(58, 7, '100091', 'photoshop'),
(59, 7, '100087', '逻辑分析'),
(60, 7, '100088', '表达能力'),
(61, 7, '100098', '电话接待'),
(62, 7, '100096', '文件管理'),
(63, 7, '-1', 'php'),
(64, 43, '100076', 'word'),
(65, 43, '100077', 'excel'),
(66, 8, '100088', '表达能力'),
(67, 8, '100098', '电话接待');

-- --------------------------------------------------------

--
-- 表的结构 `cms_message_content`
--

CREATE TABLE IF NOT EXISTS `cms_message_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `list_id` int(11) NOT NULL COMMENT '私信id',
  `from_uid` int(11) NOT NULL COMMENT '发信人id',
  `content` text NOT NULL COMMENT '内容',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `ctime` int(11) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `cms_message_content`
--


-- --------------------------------------------------------

--
-- 表的结构 `cms_message_list`
--

CREATE TABLE IF NOT EXISTS `cms_message_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '私信id',
  `from_mid` int(11) NOT NULL COMMENT '发信人id',
  `type` int(11) NOT NULL COMMENT '私信类别，1：一对一；2：多人',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `member_num` int(6) NOT NULL COMMENT '参与者数量',
  `member_mid` int(11) NOT NULL COMMENT '参与者id，用逗号链接',
  `ctime` int(11) NOT NULL COMMENT '时间',
  `last_message` int(11) NOT NULL COMMENT '最新的一条会话',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `cms_message_list`
--


-- --------------------------------------------------------

--
-- 表的结构 `cms_message_member`
--

CREATE TABLE IF NOT EXISTS `cms_message_member` (
  `list_id` int(11) NOT NULL COMMENT '私信id',
  `member_id` int(11) NOT NULL COMMENT '参与私信用户id',
  `new` smallint(8) NOT NULL COMMENT '未读消息数',
  `message_num` int(11) NOT NULL COMMENT '消息总数(通信双方)',
  `ctime` int(11) NOT NULL COMMENT '该参与者最后会话时间',
  `list_ctime` int(11) NOT NULL COMMENT '私信最后回话时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_message_member`
--


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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=343 ;

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
(342, 339, 339, 'custom', '企业特定任务', 1);

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
  `gold` int(11) NOT NULL COMMENT '领取任务消耗91币',
  `score` float NOT NULL COMMENT '任务学分值',
  `starttime` int(11) NOT NULL COMMENT '任务开始时间',
  `endtime` int(11) NOT NULL COMMENT '任务结束时间',
  `ctime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `cms_task_base`
--

INSERT INTO `cms_task_base` (`id`, `goal`, `name`, `content`, `reminder`, `way`, `gold`, `score`, `starttime`, `endtime`, `ctime`) VALUES
(1, ' 考察应聘者对公司的熟知度', '测试任务', '了解公司概况、主要业务、企业文化、\r\n社会评价等', ' 可从公司网站、主流媒体报道、\r\n其他宣传材料获取有关信息', '', 2, 0, 0, 0, 1396185838),
(2, '   考察应聘者对公司的熟知度ha ', '测试任务', '了解公司概况、主要业务、企业文化、社会评价等\r\n还有什么', '   可从公司网站、主流媒体报道、公司其他宣传材料获取有关信息', '', 0, 0, 0, 0, 1396185730);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- 转存表中的数据 `cms_visit_history`
--

INSERT INTO `cms_visit_history` (`id`, `type`, `fid`, `bid`, `ctime`) VALUES
(1, 2, 33, 1, 1397405850),
(2, 2, 33, 2, 1397725936),
(3, 2, 5, 1, 1397478479),
(4, 1, 5, 33, 1397884944),
(5, 1, 6, 33, 1397548446),
(6, 2, 6, 1, 1397489894),
(7, 1, 33, 5, 1397959870),
(8, 1, 33, 6, 1397806010),
(10, 1, 0, 5, 1397537635),
(11, 1, 7, 33, 1397962113),
(12, 1, 33, 7, 1397962206),
(13, 1, 33, 44, 1397746555),
(14, 1, 44, 33, 1397725112),
(15, 1, 44, 6, 1397725111),
(16, 2, 33, 5, 1397725922),
(17, 1, 5, 44, 1397726156),
(18, 1, 5, 6, 1397726158),
(19, 1, 33, 43, 1397893742),
(20, 1, 43, 33, 1397805541),
(21, 1, 43, 8, 1397805563),
(22, 1, 33, 8, 1397911929),
(23, 1, 8, 5, 1397805651),
(24, 1, 8, 33, 1397891942),
(25, 1, 0, 8, 1397891139),
(26, 1, 7, 44, 1397960597);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
