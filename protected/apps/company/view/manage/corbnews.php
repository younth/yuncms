<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>公司管理面板</title>
</head>
<body>
<h1>企业动态管理</h1>

<ul>
{loop $list $key $vo}
	<li>{$vo['title']}  发布时间：{$vo['addtime']} <a href="{url('manage/editnews',array('id'=>$vo['id']))}">编辑</a>&nbsp;&nbsp;<a href="{url('manage/editnews',array('id'=>$vo['id']))}">删除</a></li>
{/loop}
</ul>
</body>
</html>