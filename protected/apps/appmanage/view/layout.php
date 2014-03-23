<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLIC__/admin/css/back.css" type="text/css" rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script language="javascript">
  $(function ($) { 
	$('.all_cont tr').hover(
	function () {
        $(this).children().css('background-color', '#f9f9f9');
	},
	function () {
        $(this).children().css('background-color', '#fff');
	}
	);
  });
</script>
<title>应用管理</title>
</head>
<body>
{include file="$__template_file"}<!-----利用layout必须这样调用---->
<table class="list_bottom" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="list_bottom_l"></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
        <td class="list_bottom_r"></td>
      </tr>
</table>
</body>
</html>