<?php if(!defined('APP_NAME')) exit;?>
<h1>重设密码</h1>
<p>请进入邮箱重设密码</p>
<p>我们已向 {$member_email} 发送密码重置邮件 请登录邮箱点击重置链接重置密码。</p>
<p><a href="{$login_email}">进入邮箱查看</a></p>

<p>没有收到重置密码邮件？你可以：</p>
<p>到邮箱中的垃圾邮件、广告邮件目录中找找</p>
<p><a href="{url('member/account/lostpassword')}">再次尝试重设密码</a></p>
<p>与我们的客服联系，电话：0731-89676708</p>