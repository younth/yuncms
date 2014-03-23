<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{$title}</title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link rel="stylesheet" type="text/css" href="__PUBLICAPP__/images/install.css" />
</head>
<body>
<div class="install_main">
  <div class="install_title">{$title}</div>
  <div class="install_left">
    <ul>
	  {loop $menu $action $title}
		{if $action == ACTION_NAME}
			<li class="on">{$title}</li>
		{else}
			<li>{$title}</li>	
		{/if}
	  {/loop}
    </ul>
  </div>
  {include file="$__template_file"}
</div>
</body>
</html>