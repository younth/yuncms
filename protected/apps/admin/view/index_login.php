<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$ht_name}_用户登录</title>
<script language="javascript">
//重载验证码函数
function fleshVerify()
{
var timenow = new Date().getTime();
document.getElementById('verifyImg').src= "{url('index/verify')}/"+timenow;
}
</script>
<style type="text/css">
<!--
body{ background-color:#f7f7f7}
*{ margin:0; padding:0; font-size:12px;font-family:'微软雅黑'}
.STYLE1 {
	color: #333;
	font-size: 12px;
	
}
.con{background:url(__PUBLICAPP__/images/login_bg.jpg) center no-repeat; width:489px; height:341px; position:absolute; left:50%; top:50%; margin:-170px 0 0 -244px}
.for{ padding:100px 0 0 100px}
td{ height:45px;}
.intext{height:25px; line-height:25px;border:1px solid #ccc; font-size:12px; color:#333; padding:0 5px}
.code{ float:left; height:25px}
-->
</style>
</head>

<body>
<div class="con">
  <div class="for">
    <form action=""  method="post" >
       <div style="width:200px; float:left">
        <table cellpadding="0" cellspacing="0" width="80%">
            <tr><td width="20%" align="right"><span class="STYLE1">用&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;户：</span></td> <td width="80%"><input type="text" name="username" id="username" class="intext" size="18"></td></tr>
            <tr><td  align="right"><span class="STYLE1">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码：</span></td> <td><input type="password" name="password" id="password" class="intext" size="18"></td></tr>
            <tr><td  align="right"><span class="STYLE1">验&nbsp;证&nbsp;码：</span></td> <td><div class="code"><input type="text" name="checkcode" id="checkcode" class="intext" size="4"></div> <div class="code">&nbsp;<img src="{url('index/verify')}" border="0"  height="25" width="50" style=" cursor:pointer;"  title="点击刷新验证码" alt="如果您无法识别验证码，请点图片更换" onClick="fleshVerify()" id="verifyImg"/></div></td></tr>
        </table>
        </div>
        
       <div style="float:left; width:83px; padding-top:9px"><input type="image" src="__PUBLICAPP__/images/dl.gif" width="83" height="75"></div>
       <p style="display:block; clear:both; padding-top:60px; color: #999">Yuncms {$ver} Copyright  @2013-2014</p>
    </form>
  </div>
</div>
</body>
</html>