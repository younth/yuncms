<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>公司管理面板</title>
</head>
<body>
<h1>这是企业面板！</h1>
{$uname}，
欢迎你的到来！


<p><a href="{url('company/manage/info')}">基本资料</a></p>
<p><a href="{url('member/account/logout')}">退出</a></p>


</body>
</html>