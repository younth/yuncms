<?php if(!defined('APP_NAME')) exit;?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/base.css" />
<link rel="stylesheet" type="text/css" href="__PUBLICAPP__/css/login.css" />
<script language="javascript">
function fleshVerify()
{
var timenow = new Date().getTime();
document.getElementById('verifyImg').src= "{url('index/verify')}/"+timenow;
}
</script>
<div class="reg_bg">
<div class="login_bg_top"></div>
<div class="reg_con">
<div class="login_banner"> 
 <a href="{url('default/index/index')}">  回到首页</a>&nbsp;&nbsp;
 <a href="{url('member/index/login')}">用户登录</a>&nbsp;&nbsp;&nbsp;&nbsp;
</div>
<table border="0" cellspacing="0" cellpadding="0" class="form_box">
            <form action="" method="post">
			<tbody>
			  <tr>
				<th>用户名：</th>
				<td><input type="text" name="name" class="login_input" ></td>
			  </tr>
			  <tr>
				<th>密&nbsp;&nbsp;&nbsp;码：</th>
				<td><input type="password" class="login_input"  name="word"></td>
			  </tr>
              <tr>
				<th>确认密码：</th>
				<td><input type="password" class="login_input"  name="sureword"></td>
			  </tr>
              <tr>
				<th>邮&nbsp;&nbsp;&nbsp;箱：</th>
				<td><input type="text" name="email" class="login_input" ></td>
			  </tr>
			  <tr>
				<th>验证码：</th>
				<td><input type="text" class="login_yz" name="checkcode" id="checkcode" class="intext" size="4"> <img src="{url('index/verify')}" border="0"  height="25" width="50" style=" cursor:hand;" alt="如果您无法识别验证码，请点图片更换" onClick="fleshVerify()" id="verifyImg"/></td>
			  </tr>
			  <tr>
				<th>&nbsp;</th>
				<td><input class="button" type="submit" value="注册"></td>
			  </tr>
			</tbody>
            </form>
</table>
</div>

<div class="login_bg_bot"></div>
</div>