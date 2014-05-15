<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<title>查看留言</title>
</head>
<body>
<div class="contener">
    <div class="list_head_m">
        <div class="list_head_ml">当前位置：【查看留言】</div>
    </div>
    <table class="all_cont" width="60%" border="0" cellpadding="5" cellspacing="1">
    <tr>
       <td align="right" width="16%">图片：</td>
       <td width="84%" align="left">
          <?php 
                if(!empty($pic)){
                     foreach($pic as $vo){
						 ?>
                         <img src="{$path}{$vo['picture']}">
                         <?php
					 }
				}
				?>
       </td>
     </tr>
     <tr>
       <td align="right" width="16%">留言内容：</td>
       <td align="left">
          {$info['content']}
       </td>     
     </tr>
    </table>
</div>
</body>
</html>