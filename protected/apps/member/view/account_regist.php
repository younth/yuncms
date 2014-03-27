<?php if(!defined('APP_NAME')) exit;?>
 <a href="{url('default/index/index')}">  回到首页</a>&nbsp;&nbsp;
 <a href="{url('member/account/login')}">用户登录</a>&nbsp;&nbsp;&nbsp;&nbsp;
<table border="0" cellspacing="0" cellpadding="0" class="form_box">
            <form action="" method="post">
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
</div>