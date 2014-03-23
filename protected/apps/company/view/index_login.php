<?php if(!defined('APP_NAME')) exit;?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/base.css" />
<link rel="stylesheet" type="text/css" href="__PUBLICAPP__/css/login.css" />
<div class="login_bg">
<div class="login_bg_top"></div>
<div class="login_con">
<div class="login_banner"> 
<a href="{url('default/index/index')}"> < 回到首页</a>&nbsp;&nbsp;
 <a href="{url('member/index/regist')}"> < 注册用户</a>&nbsp;&nbsp;&nbsp;&nbsp;
</div>

<table border="0" cellspacing="0" cellpadding="0" class="form_box">
        <form action="" method="post">
			<tbody>
			  <tr>
				<th align="right">用户名：</th>
				<td><input type="text" name="name" ></td>
			  </tr>
			  <tr>
				<th align="right">密&nbsp;&nbsp;&nbsp;码：</th>
				<td><input type="password"  name="word"></td>
			  </tr>
              <tr>
				<th align="right">登录状态：</th>
				<td>
                <select name="cooktime">
                     <option value="0">浏览器关闭</option>
                     <option value="3600">一小时</option>
                     <option value="86400">一天</option>
                     <option value="604800">一星期</option>
                     <option value="2592000">一个月</option>
                     <option value="31536000">一年</option>
                 </select>
                </td>
			  </tr>
			  <tr>
				<th>&nbsp;</th>
				<td><input type="hidden" value="{$returnurl}" name="returnurl"><input class="button" type="submit" value="登 录"></td>
			  </tr>
			</tbody>
        </form>
</table>
</div>

<div class="login_bg_bot"></div>
</div>
