<?php if(!defined('APP_NAME')) exit;?>
<h1>欢迎来到91频道</h1>
<p>中国大学生一站式就业自助平台</p>
<table border="0" cellspacing="0" cellpadding="0" class="form_box">
        <form action="{url('member/account/login')}" method="post">
			<tbody>
			  <tr>
				<th align="right">邮箱：</th>
				<td><input type="text" name="login_email" ></td>
			  </tr>
			  <tr>
				<th align="right">密&nbsp;&nbsp;&nbsp;码：</th>
				<td><input type="password"  name="password"></td>
			  </tr>
			  <tr>
				<th>&nbsp;</th>
				<td><input class="button" type="submit" value="登录"></td>
			  </tr>
			</tbody>
        </form>
</table>
<p><a href="{$weibo_login}">用新浪微博账号登录</a></p>
<h2>没有91频道账号，赶紧注册</h2>
<table border="0" cellspacing="0" cellpadding="0" class="form_box">
            <form action="{url('member/account/regist')}" method="post">
			<tbody>
			  <tr>
				<th>邮箱：</th>
				<td><input type="text" name="login_email" ></td>
			  </tr>
			  <tr>
				<th>密&nbsp;&nbsp;&nbsp;码：</th>
				<td><input type="password"  name="password"></td>
			  </tr>
			  <tr>
				<th>真实姓名：</th>
				<td><input type="text"  name="uname"> </td>
			  </tr>
			  <tr>
				<th>&nbsp;</th>
				<td><input class="button" type="submit" value="注册"></td>
			  </tr>
			</tbody>
            </form>
</table>

<h2><a href="{url('member/account/lostpassword')}">忘记密码</a></h2>
