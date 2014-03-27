<?php if(!defined('APP_NAME')) exit;?>

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
				<td><input class="button" type="submit" value="登录并绑定"></td>
			  </tr>
			</tbody>
        </form>
</table>
