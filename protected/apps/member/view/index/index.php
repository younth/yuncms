<?php if(!defined('APP_NAME')) exit;?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员中心</title>
</head>
<body>
<h1>这是学生面板</h1>
{$uname}，
欢迎你的到来！

<a href="{url('member/account/logout')}">退出</a>


<br />
<br />
<img src="{$photo}" />
<h2><a href="{url('member/setting/modifypassword')}">修改密码</a></h2>
<h2><a href="{url('member/setting/avatar')}">修改头像</a></h2>
<h2><a href="{url('member/setting/management')}">帐号管理</a></h2></body>
</html>