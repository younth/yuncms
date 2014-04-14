<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>公司管理面板</title>
</head>
<body>
<h1>这是企业管理面板！</h1>
{$info['name']}，
欢迎你的到来！
<br/><br/>
{if $info['is_init']==0}
<font color="red">未完善资料</font>
<a href="{url('company/manage/info')}">现在去完善吧</a>
{else}
<a href="{url('company/manage/info')}">修改资料</a>
{/if}
&nbsp;&nbsp;

<p><a href="{url('company/manage/modifypassword')}">修改密码</a></p>
<p><a href="{url('company/manage/pubnews')}">发布动态</a></p>
<p><a href="{url('company/manage/corbnews')}">动态管理</a></p>
<p><a href="{url('member/account/logout')}">退出</a></p>
<p>当前Logo:<img src="{$path}{$info['logo']}" /><a href="{url('company/manage/company_logo')}">修改</a></p><br/>
<p>当前营业执照:<img src="{$path}{$info['license']}" /><a href="{url('company/manage/company_auth')}">修改</a></p>

</body>
</html>