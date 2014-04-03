-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 04 月 03 日 13:51
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
(1, 1, 'admin', '168a73655bfecefdb15b14984dd2ad60', '王洋', 1396523744, 'unknown', 0),
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
  `sort` varchar(100) NOT NULL COMMENT '所属行业',
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `cms_company`
--

INSERT INTO `cms_company` (`id`, `login_email`, `password`, `name`, `logo`, `quality`, `scale`, `phone`, `sort`, `address`, `websites`, `introduce`, `ctime`, `regip`, `lasttime`, `lastip`, `license`, `is_active`, `is_init`) VALUES
(1, '862820606@qq.com', 'd707c24bd27660ca7d65870027fb9218', '云作坊', '20140403/20140403213316_13924.png', '国企', '100人', '0731-89676708', ',000000,100039,100040,100051', '长沙理工大学', 'http://ww.yunstudio.net/', ' 云作坊，很牛B。', 0, '', 1396494403, '', 'NoPic.gif', 1, 0),
(5, '1@qq.com', 'df85a226d7e42ef723f21c4c48352b1a', '企业', '20140403/20140403212752_42453.jpg', '', '', '', ',000000,100039,100040,100052', '长沙理工大学创业园305', 'www.yunstudio.net', '  你好', 1396525138, 'unknown', 1396525138, 'unknown', 'NoPic.gif', 0, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `cms_company_fans`
--

INSERT INTO `cms_company_fans` (`id`, `mid`, `cid`, `score`, `ctime`) VALUES
(1, 1, 1, 0, 2147483647),
(2, 2, 1, 0, 0),
(3, 3, 1, 0, 0),
(4, 5, 1, 0, 0);

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
  `type` char(50) NOT NULL COMMENT '类型',
  `mid` int(11) NOT NULL COMMENT '会员id',
  `comment_count` int(11) NOT NULL COMMENT '评论数',
  `repost_count` int(11) NOT NULL COMMENT '转发数',
  `ctime` int(11) NOT NULL COMMENT '发布时间',
  `is_repost` tinyint(2) NOT NULL COMMENT '是否转发,0否1是',
  `is_audit` int(11) NOT NULL COMMENT '是否审核,0否1是',
  `feed_content` text NOT NULL COMMENT '心情内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `cms_feed`
--

INSERT INTO `cms_feed` (`id`, `type`, `mid`, `comment_count`, `repost_count`, `ctime`, `is_repost`, `is_audit`, `feed_content`) VALUES
(1, 'post', 1, 2, 3, 0, 1, 1, '112');

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
-- 表的结构 `cms_feed_comment`
--

CREATE TABLE IF NOT EXISTS `cms_feed_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL COMMENT '心情 id',
  `mid` int(11) NOT NULL COMMENT '评论者',
  `content` int(11) NOT NULL COMMENT '评论内容',
  `to_comment_id` int(11) NOT NULL COMMENT '被回复的评论编号',
  `to_uid` int(11) NOT NULL COMMENT '被回复的评论者 id',
  `ctime` int(11) NOT NULL COMMENT '评论时间',
  `is_audit` int(11) NOT NULL COMMENT '是否已审核',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `cms_feed_comment`
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `cms_feed_digg`
--


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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

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
(44, 2, 1, 'unknown', 1396494403);

-- --------------------------------------------------------

--
-- 表的结构 `cms_member`
--

CREATE TABLE IF NOT EXISTS `cms_member` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `login_email` varchar(30) NOT NULL COMMENT '登陆邮箱',
  `password` varchar(60) NOT NULL,
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1男2女',
  `location` varchar(80) NOT NULL DEFAULT '0' COMMENT '籍贯',
  `school` varchar(50) NOT NULL,
  `major` int(50) NOT NULL COMMENT '专业',
  `uname` varchar(30) NOT NULL COMMENT '用户名',
  `tel` varchar(15) NOT NULL,
  `qq` varchar(20) NOT NULL,
  `tag` varchar(200) NOT NULL COMMENT '个人标签',
  `ctime` int(11) NOT NULL,
  `regip` varchar(16) NOT NULL,
  `lasttime` int(11) NOT NULL,
  `lastip` varchar(15) NOT NULL,
  `is_active` tinyint(1) NOT NULL COMMENT '是否激活',
  `is_init` tinyint(1) NOT NULL COMMENT '是否初始化用户资料',
  `last_feed_id` int(11) NOT NULL COMMENT '最后发表心情id',
  `last_feed_time` int(11) NOT NULL COMMENT '最后发表心情时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- 转存表中的数据 `cms_member`
--

INSERT INTO `cms_member` (`id`, `login_email`, `password`, `sex`, `location`, `school`, `major`, `uname`, `tel`, `qq`, `tag`, `ctime`, `regip`, `lasttime`, `lastip`, `is_active`, `is_init`, `last_feed_id`, `last_feed_time`) VALUES
(1, 'yunstudio2012@qq.com', 'd707c24bd27660ca7d65870027fb9218', 1, '3774', '会员演示', 0, 'admin', '13638816362', '404133749', '', 1372135503, '', 1396278486, '', 1, 0, 0, 0),
(33, '825075713@qq.com', '92ce4c1797018ae7f5562d6d682358c5', 0, '0', '', 0, '王洋', '14789998264', '', '', 1396279141, '', 0, '', 1, 0, 0, 0),
(5, '1161499602@qq.com', 'd707c24bd27660ca7d65870027fb9218', 0, '0', '', 0, '蒲精', '', '1161499602', '', 1395580185, '', 0, '', 1, 0, 0, 0),
(6, '1095620719@qq.com', 'd707c24bd27660ca7d65870027fb9218', 0, '0', '', 0, '唐娜', '', '', '', 1395581194, '', 0, '', 1, 0, 0, 0),
(7, '1103349641@qq.com', 'd707c24bd27660ca7d65870027fb9218', 0, '0', '', 0, '赵杰', '', '', '', 1395581233, '', 0, '', 1, 0, 0, 0),
(8, '113771910@qq.com', 'd707c24bd27660ca7d65870027fb9218', 0, '0', '', 0, '田书记', '', '', '', 1395581267, '', 0, '', 1, 0, 0, 0),
(34, '454545@qq.com', 'e4df60eb031ce566119660fe103e35d2', 0, '0', '', 0, '蒲精', '', '', '', 1396507283, 'unknown', 1396507283, 'unknown', 0, 0, 0, 0),
(35, '45454@qq.com', 'aa5b64077da5afc9261768919c0e6a91', 0, '0', '', 0, '王洋', '', '', '', 1396507353, 'unknown', 1396507353, 'unknown', 0, 0, 0, 0),
(36, '46546@qq.com', '74cee31e7ded50fd3efbc07559e8e18f', 0, '0', '', 0, '王洋', '', '', '', 1396507491, 'unknown', 1396507491, 'unknown', 0, 0, 0, 0),
(37, '4674967@qq.com', 'd07de8a8f8c6e2470e302b73ff51a6eb', 0, '0', '', 0, '646', '', '', '', 1396507752, 'unknown', 1396507752, 'unknown', 0, 0, 0, 0),
(38, '487468@qq.com', '18b29ef4ad722fff68f385fa0fc4b806', 0, '0', '', 0, '王洋', '', '', '', 1396509473, 'unknown', 1396509473, 'unknown', 0, 0, 0, 0),
(39, '474646468@qq.com', '778c6a8f012823ebb8690eb099729046', 0, '0', '', 0, '王洋', '', '', '', 1396510083, 'unknown', 1396510083, 'unknown', 0, 0, 0, 0),
(40, '1@qq.com', '599e70cfbde412a061ce3ec1dc26c42d', 0, '0', '', 0, '你妹', '', '', '', 1396510215, 'unknown', 1396510215, 'unknown', 0, 0, 0, 0),
(41, '2@qq.com', 'b7b18e7ad6f7a7f0e1c27e051cfb2c31', 0, '0', '', 0, 'fds', '', '', '', 1396510338, 'unknown', 1396510338, 'unknown', 0, 0, 0, 0);

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
-- 表的结构 `cms_member_follow`
--

CREATE TABLE IF NOT EXISTS `cms_member_follow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL COMMENT '关注者id',
  `fid` int(11) NOT NULL COMMENT '被关注者id',
  `remark` varchar(15) NOT NULL COMMENT '备注信息',
  `ctime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `cms_member_follow`
--


-- --------------------------------------------------------

--
-- 表的结构 `cms_member_follow_group`
--

CREATE TABLE IF NOT EXISTS `cms_member_follow_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '创建者id',
  `name` varchar(15) NOT NULL COMMENT '组名',
  `ctime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `cms_member_follow_group`
--


-- --------------------------------------------------------

--
-- 表的结构 `cms_member_follow_group_link`
--

CREATE TABLE IF NOT EXISTS `cms_member_follow_group_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `follow_group_id` int(11) NOT NULL COMMENT '关注组id',
  `fid` int(11) NOT NULL COMMENT '被关注者id',
  `mid` int(11) NOT NULL COMMENT '关注者id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `cms_member_follow_group_link`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `cms_member_group_link`
--

INSERT INTO `cms_member_group_link` (`id`, `uid`, `user_group_id`) VALUES
(1, 1, 4),
(2, 2, 7),
(9, 33, 2),
(4, 5, 2),
(5, 6, 2),
(6, 7, 2),
(7, 8, 2),
(10, 34, 2),
(11, 35, 2),
(12, 36, 2),
(13, 37, 2),
(14, 38, 2),
(15, 39, 2),
(16, 40, 2),
(17, 41, 2);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

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
(37, 2, 6, '', 'ef9246f8e9630b64f4d87db154c24f17');

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_mid` int(11) NOT NULL COMMENT '发信人id',
  `type` int(11) NOT NULL COMMENT '私信类别，1：一对一；2：多人',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `member_num` int(6) NOT NULL COMMENT '参与者数量',
  `member_mid` int(11) NOT NULL COMMENT '参与者id，用逗号链接',
  `ctime` int(11) NOT NULL COMMENT '时间',
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- 转存表中的数据 `cms_news`
--

INSERT INTO `cms_news` (`id`, `sort`, `account`, `title`, `places`, `color`, `picture`, `keywords`, `description`, `content`, `method`, `tpcontent`, `norder`, `recmd`, `hits`, `ispass`, `origin`, `addtime`) VALUES
(23, ',000000,100028,100036', 'admin', '激情', '100', '#E53333', '20140309/thumb_20140309144706_30440.jpg', '哈哈', '哈哈', '哈', 'news/content', 'news_content', 0, 0, 30, 1, '原创', 1394346935),
(24, ',000000,100028,100036', 'admin', '果敢', '100', '#00D5FF', '20140309/thumb_thumb_thumb_20140309144918_26526.jpg', '果敢', '果敢', '果敢<img src="http://localhost/Yuncms/public/kindeditor/plugins/emoticons/images/31.gif" border="0" alt="" />', 'news/content', 'news_content', 0, 0, 30, 1, '果敢', 1394347730),
(25, ',000000,100028,100036', 'admin', '执着', '100', '', '20140309/thumb_thumb_20140309183130_90592.jpg', '执着', '执着', '执着', 'news/content', 'news_content', 0, 0, 34, 1, '原创', 1394361075),
(26, ',000000,100028,100036', 'admin', '超越', '100', '#B8D100', '20140309/thumb_thumb_thumb_thumb_20140309183155_88695.jpg', '超越', '超越', '超越梦想<img src="http://localhost/Yuncms/public/kindeditor/plugins/emoticons/images/0.gif" border="0" alt="" />', 'news/content', 'news_content', 0, 0, 31, 1, '原创', 1394361101);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100074 ;

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
(100038, 5, ',000000,100037', '周润发', 2, 0, 0, '', '', '', '', ''),
(100039, 5, ',000000', '行业管理', 1, 0, 0, '', '', '', '', ''),
(100040, 5, ',000000,100039', 'IT行业', 2, 0, 0, '', '', '', '', ''),
(100041, 5, ',000000,100039', '金融行业', 2, 0, 0, '', '', '', '', ''),
(100042, 5, ',000000,100039', '专业服务', 2, 0, 0, '', '', '', '', ''),
(100043, 5, ',000000,100039', '教育培训行业', 2, 0, 0, '', '', '', '', ''),
(100044, 5, ',000000,100039', '消费品行业', 2, 0, 0, '', '', '', '', ''),
(100045, 5, ',000000,100039', '文化传媒行业', 2, 0, 0, '', '', '', '', ''),
(100046, 5, ',000000,100039', '建筑/房地产行业', 2, 0, 0, '', '', '', '', ''),
(100047, 5, ',000000,100039', '贸易物流行业', 2, 0, 0, '', '', '', '', ''),
(100048, 5, ',000000,100039', '制造工业', 2, 0, 0, '', '', '', '', ''),
(100049, 5, ',000000,100039', '医疗/卫生', 2, 0, 0, '', '', '', '', ''),
(100050, 5, ',000000,100039', '服务业', 2, 0, 0, '', '', '', '', ''),
(100051, 5, ',000000,100039,100040', '计算机软件', 3, 0, 0, '', '', '', '', ''),
(100052, 5, ',000000,100039,100040', '计算机硬件', 3, 0, 0, '', '', '', '', ''),
(100053, 5, ',000000,100039,100040', '互联网', 3, 0, 0, '', '', '', '', ''),
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
(100073, 5, ',000000,100066', '问题建议', 2, 0, 0, '', '', '', '', '');

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


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
