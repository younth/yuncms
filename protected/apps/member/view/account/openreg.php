<?php if(!defined('APP_NAME')) exit;?>
<h1>微博用户注册新账号</h1>
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
</div>