<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/common.js"></script>
<title>配置</title>
</head>
<body>
<div class="contener">
   <div class="list_head_m">
		  <div class="list_head_ml">当前位置：【环境信息】</div>
		  <div class="list_head_mr"></div>
   </div>


		<table width="100%" border="0" cellpadding="0" cellspacing="1" class="all_cont">
			<tr>
				<th colspan="2">服务器概况</th>
			</tr>
			<tr>
				<td width="54%">服务器域名/IP地址：<?php echo $_SERVER['SERVER_NAME']?>(<?php echo @gethostbyname($_SERVER['SERVER_NAME'])?>)</td>
				<td width="46%">服务器时间：<?php echo date("Y年n月j日 H:i:s")?></td>
			</tr>

			<tr>
				<td>服务器操作系统：<?php $os = explode(" ", php_uname());?><?php echo $os[0];?>&nbsp;(内核版本：<?php echo $os[2]?>)</td>
				<td>站点物理路径：<?php echo dirname(dirname($_SERVER['SCRIPT_FILENAME']))?></td>
			</tr>
			<tr>
				<td>服务器解译引擎：<?php echo $_SERVER['SERVER_SOFTWARE']?></td>
				<td>Web服务端口：<?php echo $_SERVER['SERVER_PORT']?></td>
			</tr>
			<tr>
				<td>PHP版本：<?php echo PHP_VERSION?></td>
				<td>PHP运行方式：<?php echo strtoupper(php_sapi_name())?></td>
			</tr>
			<tr>
				<td>MySQL数据库：<?php echo (function_exists('mysql_close'))?'<font color="green">√</font>' : '<font color="red">×</font>' ?></td>
				<td>自动定义全局变量(register_globals)：<?php echo get_cfg_var("register_globals")?'<font color="green">√</font>' : '<font color="red">×</font>'; ?></td>
			</tr>
			<tr>
				<td>允许使用URL打开文件(allow_url_fopen)：<?php echo get_cfg_var("allow_url_fopen")?'<font color="green">√</font>' : '<font color="red">×</font>'; ?></td>
				<td>允许动态加载链接库(enable_dl)：<?php echo get_cfg_var("enable_dl")?'<font color="green">√</font>' : '<font color="red">×</font>'; ?></td>
			</tr>
			<tr>
				<td>显示错误信息(display_errors)：<?php echo get_cfg_var("display_errors")?'<font color="green">√</font>' : '<font color="red">×</font>'; ?></td>
				<td>程序最多允许使用内存量(memory_limit)：<?php echo get_cfg_var("memory_limit"); ?></td>
			</tr>
			<tr>
				<td>POST最大字节数(post_max_size)：<?php echo get_cfg_var("post_max_size"); ?></td>
				<td>允许最大上传文件(upload_max_filesize)：<?php echo get_cfg_var("upload_max_filesize"); ?></td>
			</tr>
			<tr>
				<td>程序最长运行时间(max_execution_time)：<?php echo get_cfg_var("max_execution_time"); ?>秒</td>
				<td>Session支持：<?php echo (function_exists('session_start'))?'<font color="green">√</font>' : '<font color="red">×</font>' ?></td>
			</tr>
		</table>



		<table width="100%" border="0" cellpadding="0" cellspacing="1" class="all_cont">
			<tr>
				<th width="100%" colspan="3">系统信息</th>
			</tr>
			<tr>
				<td>官方网站：<a href="http://cms.yunstudio.net" target="_blank">Yuncms官网</a></td>
				<td>官方微博：<a href="http://weibo.com/yunstudio2" target="_blank"><img src="__PUBLICAPP__/images/sina.png"></a></td>
			</tr>
            <tr>
				<td>版本：{$ver}  </td>
				<td><a target="_blank" href="http://wp.qq.com/wpa/qunwpa?idkey=281b276d61ed1136b117deef58b86b6dd0a2d0b63cd29521c37b57f694c075d7"><img border="0" src="__PUBLICAPP__/images/group.png" alt="Yuncms交流群" title="Yuncms交流群"></a></td>
			</tr>
		</table>

</div>
</body>
</html>
