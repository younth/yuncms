<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/common.js"></script>
<title>{$t_name}定位</title>
</head>
<body>
<div class="contener">
   <div class="list_head_m">
    <div class="list_head_ml">当前位置：【定位{$t_name}】</div>
    <div class="list_head_mr"></div>
    </div>
          <form action=""  method="post" id="info">
          <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">  
          <tr>
            <td align="right">定位名称：</td>
            <td align="left">
              <input type="text" name="name" id="name" value="{$info['name']}">
            </td>
            <td align="left" class="inputhelp"></td>
          </tr>          
          <tr>
            <td align="right">排序：</td>
            <td align="left">
              <input type="text" name="norder" id="norder" value="{$info['norder']}" size="10">
            </td>
            <td align="left" class="inputhelp">值越大越靠前</td>
          </tr>       
          <tr>
            <td width="200">&nbsp;</td>
            <td align="left" colspan="2">              
              <input type="submit" value="{$t_name}" class="btn btn-primary btn-small">
            </td>
          </tr> 
          </table>
          </form>    
</div>
</body>
</html>     