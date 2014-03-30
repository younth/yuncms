<?php if(!defined('APP_NAME')) exit;?>
 
 <h2>{$weibo_name}欢迎来到91频道！</h2>

<p>
已有91频道帐号，你可以继续使用91频道原有的个人信息
</p>
<table border="0" cellspacing="0" cellpadding="0" class="form_box">
        <form action="" method="post">
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
       <h3>第一次来91频道：</h3>
       <img src="{$photo}" />
       <br />
       <a href="{url('member/account/openreg')}">立即进入</a>

