<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理员登录</title>
<link rel="stylesheet" href="__PUBLICAPP__/css/login.css"/>
</head>

<body>
<div class="con">
<h1>Yuncms内容管理系统</h1>
  <div class="for">
    <form action=""  method="post" >
       <div style="width:200px; float:left">
        <table cellpadding="0" cellspacing="0" width="80%">
            <tr><td width="20%" align="right"><span class="STYLE1">用&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;户：</span></td> <td width="80%"><input type="text" name="username" id="username" class="intext" size="18"></td></tr>
            <tr><td  align="right"><span class="STYLE1">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码：</span></td> <td><input type="password" name="password" id="password" class="intext" size="18"></td></tr>
            <tr><td  align="right"><span class="STYLE1">验&nbsp;证&nbsp;码：</span></td> <td><div class="code"><input type="text" name="checkcode" id="checkcode" class="intext" size="6"></div> <div class="code">&nbsp;<img src="{url('index/verify')}" border="0"  height="25" width="50" style=" cursor:pointer;"  title="点击刷新验证码" alt="如果您无法识别验证码，请点图片更换" onClick="fleshVerify()" id="verifyImg"/></div></td></tr>
        </table>
        </div>
        
       <div class="login"><input type="submit" value="登 陆"></div>
    </form>
  </div>
  <p>Yuncms {$ver} Copyright  @2012-2014</p>
</div>
<script>
//重载验证码函数
function fleshVerify(){
	var timenow = new Date().getTime();
	document.getElementById('verifyImg').src= "{url('index/verify')}/"+timenow;
}
</script>
</body>
</html>