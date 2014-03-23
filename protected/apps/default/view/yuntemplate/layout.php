<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>云作坊网页模板1.0</title>
<meta name="description" content="云作坊，网页模板">
<meta name="Keywords" content="云作坊，网页模板">
<link href="__PUBLICAPP__/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/main.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/scollpic.js"></script>
</head>

<body>
<!-- 头部 开始-->
<div id="header">
	<div class="top">
   		<!-- 网站的logo-->
    	<div class="logo"><a href="#"><img src="__PUBLICAPP__/images/logo.png" /></a></div>
        <!--这个是用于搜索form表单-->
        <form method="get" action="#" name="form_s" id="form_s" target="_blank">
        	<!--两段隐藏域，用于提交搜索的信息-->
            <input type="hidden" name="c" id="form_s_c" value="tour">
            <input type="hidden" name="a" id="form_s_a"  value="index">
             <!--搜索显示-->
             <div class="search">
                  <input class="txtSearch" type="text" name="keyword" value="" /> 
                  <input id="headSearchType" name="searchType" type="hidden" value="lc">
                  <div class="selSearch">
                  <!--显示隐藏下面的搜索条件-->
                  	<div class="nowSearch" id="headSlected" style="cursor:pointer" onclick="if(document.getElementById('headSel').style.display=='none'){document.getElementById('headSel').style.display='block';}else {document.getElementById('headSel').style.display='none';};return false;" onmouseout="drop_mouseout('head');">搜文章/div>
                   <!-- 增加一个小按钮搜索-->
                    <div class="btnSel"> <a href="#" onclick="if(document.getElementById('headSel').style.display=='none'){document.getElementById('headSel').style.display='block';}else {document.getElementById('headSel').style.display='none';};return false;" onmouseout="drop_mouseout('head');"> </a> </div>
                    <div class="clear"> </div>
                    <ul class="selOption" id="headSel" style="display:none;">
                      <li><a href="#" onclick="return search_show('head','ren',this)"  >搜人</a></li>
                      <li><a href="#" onclick="return search_show('head','lc',this)"  >搜比赛</a></li>
                    </ul>
                  </div>
                   <div class="btnSearch"><a href="#" onclick="$('#form_s').submit();"></a> </div>
             </div>
        </form>
    </div>
</div>
<!-- 头部结束 -->
<!--清除浮动-->
<div class="clear"></div>
<!--导航开始-->
<div id="nav">
		<div class="nav" id="divWatermark" >
        <!--nav_0515作用是什么?-->
        	<div class="nav_0515"  >
            <!--主导航-->
                <div class="main_nav">
                    <ul>
                    <li><a href="#" target="_top"  class="hover">首页</a></li>
                    <li><a href="#" target="_top" >历程</a></li>
                    <li><a href="#" target="_top" >竞争力</a></li>
                    <li><a href="#"  target="_top" >技术交流</a></li>
                    <li><a href="#"  target="_top" >Yunstudio</a></li>
                    </ul>		
                </div>
                    
            <!--用户登录注册-->            
                <div class="user_nav">
                            <div class="snslogin">
                            <a href="#" title="使用腾讯微博登录"><img src="__PUBLICAPP__/images/tx.png" /></a> <a href="#" title="使用新浪微博登录"><img src="__PUBLICAPP__/images/sina.png" /></a></div>
                            <div class="login"><a href="#">登录</a>|<a href="#">注册</a></div>
                        </div>
        
                    </div>
        
        </div>

</div>
<!--导航结束-->
<!--清除浮动-->
<div class="clear"></div>
<!-- 主体 -->
<div id="wrapper">
	<!--广告-->
	  	<div id="index_banner" style=""><a href="#" target="_blank"><img src="__PUBLICAPP__/img/ad.jpg" border="0" width="960" height="80" /></a><div class="adclose">X</div></div>
<div class="clear"></div>

	<!-- 主体内容 -->
    <div id="main_content" class="l">
    <!--首页幻灯片-->
    	<div id="index_focus">
        	<div id="focus">
            	<ul>
                     <li><a href="#" target="_blank"><img src="__PUBLICAPP__/img/yun.jpg" border="0">
                    <div class="rule">
                      <div style="position:absolute; width:400px; height:20px; left:50px; top:2px; font-size:16px; color:#FFF">【热门活动】 云作坊网络开发工作室</div>
                      <div style="position:absolute; width:200px; height:20px; left:58px; color:#CCC; top:25px;">by 云作坊</div>
                      <div style="position:absolute; width:25px; height:25px; left:30px; top:25px; z-index:10; background:url(__PUBLICAPP__/images/daren.png) no-repeat center"></div>
                      <div><img src="__PUBLICAPP__/img/01_avatar_small.jpg"  style="border:1px #999 solid" width="40" height="40" border="0"></div>
                    </div>
                    </a> </li>
                    
                     <li><a href="#" target="_blank"><img src="__PUBLICAPP__/img/yun2.jpg" border="0">
                    <div class="rule">
                      <div style="position:absolute; width:400px; height:20px; left:50px; top:2px; font-size:16px; color:#FFF">【热门活动】 云作坊网络开发工作室</div>
                      <div style="position:absolute; width:200px; height:20px; left:58px; color:#CCC; top:25px;">by 云作坊</div>
                      <div style="position:absolute; width:25px; height:25px; left:30px; top:25px; z-index:10; background:url(__PUBLICAPP__/images/daren.png) no-repeat center"></div>
                      <div><img src="__PUBLICAPP__/img/01_avatar_small.jpg"  style="border:1px #999 solid" width="40" height="40" border="0"></div>
                    </div>
                    </a> </li>
                     <li><a href="#" target="_blank"><img src="__PUBLICAPP__/img/1.jpg" border="0">
                    <div class="rule">
                      <div style="position:absolute; width:400px; height:20px; left:50px; top:2px; font-size:16px; color:#FFF">【热门活动】 云作坊网络开发工作室</div>
                      <div style="position:absolute; width:200px; height:20px; left:58px; color:#CCC; top:25px;">by 云作坊</div>
                      <div style="position:absolute; width:25px; height:25px; left:30px; top:25px; z-index:10; background:url(__PUBLICAPP__/images/daren.png) no-repeat center"></div>
                      <div><img src="__PUBLICAPP__/img/01_avatar_small.jpg"  style="border:1px #999 solid" width="40" height="40" border="0"></div>
                    </div>
                    </a> </li>
                    
                     <li><a href="#" target="_blank"><img src="__PUBLICAPP__/img/3.jpg" border="0">
                    <div class="rule">
                      <div style="position:absolute; width:400px; height:20px; left:50px; top:2px; font-size:16px; color:#FFF">【热门活动】 云作坊网络开发工作室</div>
                      <div style="position:absolute; width:200px; height:20px; left:58px; color:#CCC; top:25px;">by 云作坊</div>
                      <div style="position:absolute; width:25px; height:25px; left:30px; top:25px; z-index:10; background:url(__PUBLICAPP__/images/daren.png) no-repeat center"></div>
                      <div><img src="__PUBLICAPP__/img/01_avatar_small.jpg"  style="border:1px #999 solid" width="40" height="40" border="0"></div>
                    </div>
                    </a> </li>
                </ul>
            </div>
        </div>
        <div class="clear"></div>
        <div class="mainbody">内容板块</div>
    </div>
   <!--主体内容结束 -->
   ﻿<!-- 侧边栏 -->
   
   <div id="main_sidebar" class="r">
   <!--最新公告-->
   	<div class="column_listbox">
        	<div class="title"><h2>最新公告</h2></div>
            <ul>
                <li><a href="#">云作坊，on the way!</a></li>
                <li><a href="#">打造云作坊专属网页模板V1.0</a></li>
                <li><a href="#">规范css的好处</a></li>
                <li><a href="#">怎样才是合格的前端工程师</a></li>
                <li><a href="#">你不努力，如何成功</a></li>
                <li><a href="#">跟别人比技术，先比勤奋</a></li>
				<li class="more"><a href="#">&gt;更多</a></li>
            </ul>
    </div>
    <!--一定要清除浮动-->
    <div class="clear"></div>
    <!--旅游达人-->
    <div class="column_itabbox">
    	<div class="title"><h2>作坊达人</h2></div>
			<div class="ci_list">
                <div class="dis" id="tbc_02">
                	<ul>
                        <li style="height:55px;"> <div class="r_index"><div class="r_number"><span class="Orange">1</span></div><div class="r_usericon"><a href="#" target="_blank" title="nepiay"><img width="40" height="40" src="__PUBLICAPP__/img/01_avatar_small.jpg"  style=" border:1px #999 solid" border="0"  alt="nepiay"></a></div><div class="r_username">方丈<Br /><a onclick="guanzhu(760683,'gz760683')" id="gz760683" href="javascript:void();" class="r_guanzhu"><img src="__PUBLICAPP__/images/btn_addFollow.gif"  /></a><div class="r_jifen">积分:9920</div></div></div></li>
                        
                        <li style="height:55px;"> <div class="r_index"><div class="r_number"><span class="Orange">2</span></div><div class="r_usericon"><a href="#" target="_blank" title="nepiay"><img width="40" height="40" src="__PUBLICAPP__/img/01_avatar_small.jpg"  style=" border:1px #999 solid" border="0"  alt="nepiay"></a></div><div class="r_username">方丈<Br /><a onclick="guanzhu(760683,'gz760683')" id="gz760683" href="javascript:void();" class="r_guanzhu"><img src="__PUBLICAPP__/images/btn_addFollow.gif"  /></a><div class="r_jifen">积分:9920</div></div></div></li>	
                        
                        <li style="height:55px;"> <div class="r_index"><div class="r_number"><span class="Orange">3</span></div><div class="r_usericon"><a href="#" target="_blank" title="nepiay"><img width="40" height="40" src="__PUBLICAPP__/img/01_avatar_small.jpg"  style=" border:1px #999 solid" border="0"  alt="nepiay"></a></div><div class="r_username">方丈<Br /><a onclick="guanzhu(760683,'gz760683')" id="gz760683" href="javascript:void();" class="r_guanzhu"><img src="__PUBLICAPP__/images/btn_addFollow.gif"  /></a><div class="r_jifen">积分:9920</div></div></div></li>	

                        
                        <li style="height:55px;"> <div class="r_index"><div class="r_number"><span class="gray">4</span></div><div class="r_usericon"><a href="#" target="_blank" title="nepiay"><img width="40" height="40" src="__PUBLICAPP__/img/01_avatar_small.jpg"  style=" border:1px #999 solid" border="0"  alt="nepiay"></a></div><div class="r_username">方丈<Br /><a onclick="guanzhu(760683,'gz760683')" id="gz760683" href="javascript:void();" class="r_guanzhu"><img src="__PUBLICAPP__/images/btn_addFollow.gif"  /></a><div class="r_jifen">积分:9920</div></div></div></li>	
                    </ul>
                  </div>
               </div>
         </div>
          <div class="clear"></div>
         <!--广告来啦-->
         <div  class="ads"><a href="#" target="_blank"><img src="__PUBLICAPP__/img/website_right_1219.jpg" /></a></div>

   </div>
   <!-- 侧边栏结束 -->
   <div class="clear"></div>
</div>
<!-- 主体结束 -->

<div  style="position:relative; width:100%; height:60px; top:10px; background-color:#cedae7; text-align:left; line-height:25px; color:#585c5e; font-weight:bold">
<div style="position:relative; width:1000px; height:60px; top:5px; margin:0px auto;">
友情链接：
<a href="http://http://www.yunstudio.net/" target="_blank" style="color:#585c5e" >云作坊</a>&nbsp;&nbsp;
<a href="http://http://www.kjjlpt.com/" target="_blank" style="color:#585c5e" >大学生科技交流平台</a>&nbsp;&nbsp;
<a href="http://http://www.yunstudio.net/" target="_blank" style="color:#585c5e" >长理掌上通</a>&nbsp;&nbsp;

</div></div>
<!--返回顶部,改用jquery外部引用方法-->
<div style="display:none;" class="back-to" id="toolBackTop"> <a title="返回顶部" onclick="window.scrollTo(0,0);return false;" href="#top" class="back-top"> 返回顶部</a> </div>
<script type="text/javascript" src="./js/top_gd.js"  ></script>
<div class="clear"></div>

<!-- 底部 -->
<div id="footer" style=" height:180px;">
  <div style="position:relative; width:1000px; height:180px; margin:0px auto; color:#999; font-size:12px; text-align:left; ">
    <div  style="position:absolute; width:400px; height:20px; top:20px; left:10px; color:#b4b4b4; "><a href="#" target="_top" style="color:#c2c2c2"> </a>
      <table width="400" border="0" cellspacing="0" cellpadding="0"  align="left">
        <tr>
          <td width="100" height="25" align="center" style="font-weight:bold">关于我们</td>
          <td width="100" height="25" align="center" style="font-weight:bold">加入我们</td>
          <td width="100" height="25" align="center" style="font-weight:bold">网站条款</td>
          <td width="100" height="25" align="center" style="font-weight:bold">帮助中心</td>
        </tr>
        <tr>
          <td width="100" height="25" align="center"><a href="#" style="color:#8e8c8c;">联系我们</a></td>
          <td width="100" height="25" align="center"><a href="#" target="_blank" style="color:#8e8c8c;" >招才纳贤</a></td>
          <td width="100" height="25" align="center"><a href="#"  style="color:#8e8c8c;" target="_blank">隐私条款</a></td>
          <td width="100" height="25" align="center"><a href="#" style="color:#8e8c8c;"  target="_blank">网站地图</a></td>
        </tr>
        <tr>
          <td width="100" height="25" align="center"></td>
          <td width="100" height="25" align="center"></td>
          <td width="100" height="25" align="center">&nbsp;</td>
          <td width="100" height="25" align="center"><a href="#"  style="color:#8e8c8c;" target="_blank">意见反馈</a></td>
        </tr>
      </table>
      <a href="#" target="_top" style="color:#c2c2c2"></a></div>
    <div style="position:absolute; width:70px; height:20px; top:20px; left:460px;  color:#b4b4b4; font-weight:bold">关注我们</div>
    <div style="position:absolute; width:16px; height:20px; top:50px; left:460px;"><a href="#" target="_blank"><img src="http://img.117go.com/assets/img/bottom_sina.png" width="94" height="32" border="0" title="新浪微博"  /></a></div>
    <div style="position:absolute; width:16px; height:20px; top:80px; left:460px;"><a href="#" target="_blank"><img src="http://img.117go.com/assets/img/bottom_qq.png" width="94" height="32" border="0"  title="腾讯微博" /></a></div>
    <div style="position:absolute; width:70px; height:20px; top:20px; left:580px;  color:#b4b4b4; font-weight:bold"><span style=" position:absolute;font-size:14px; left:0px; top:3px; "><img src="__PUBLICAPP__/images/q.png" width="16" height="16" title="QQ群号"  /></span>&nbsp;&nbsp;&nbsp;&nbsp; QQ群号</div>
    <div style="position:absolute; width:200px; height:20px; top:50px; left:580px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; line-height:20px;">
    1号群:8888888(已满)<br />
      2号群:8888888<br />3号群:8888888<br />"云作坊"技术交流群:8888888<br />
      （验证时需提供技术交流范畴）
</div>
    <div  style="position:absolute; width:450px; height:45px; top:135px; left:25px; "> <span><img src="__PUBLICAPP__/images/yunstudio.png" width="111" height="47" /></span>
    <span style="position:absolute; left:120px; top:2px; color:#7e8286; font-family:Arial, Helvetica, sans-serif; line-height:19px;">湘ICP备11041350号</span> 
    <span style="position:absolute; left:120px; top:20px; color:#7e8286; font-family:Arial, Helvetica, sans-serif; line-height:19px;">2013 © 云作坊 All Rights Reserved&nbsp;&nbsp;
    <script src="http://s22.cnzz.com/stat.php?id=4125145&web_id=4125145&show=pic1" language="JavaScript"></script>
    </span>
    </div>
    <div  style="position:absolute; width:128px; height:42px; top:20px; left:830px; "><a href="#" target="_blank"><img src="__PUBLICAPP__/images/bottom_appstore.gif"  width="128" height="42" border="0"  title="App Store" /></a></div>
    <div  style="position:absolute; width:128px; height:42px; top:75px; left:830px; "><a href="#" target="_blank"><img src="__PUBLICAPP__/images/bottom_android.gif" width="128" height="42" border="0"   title="Android应用市场" /></a></div>
  </div>
</div>

<!-- 底部结束 -->
   <!-- Baidu Button BEGIN -->
<script type="text/javascript" id="bdshare_js" data="type=slide&amp;img=4&amp;pos=right&amp;uid=646732" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000);
</script>
<!-- Baidu Button END -->

</body>
</html>
