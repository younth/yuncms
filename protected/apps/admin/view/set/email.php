<?php
 if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/common.js"></script>
<title>邮件配置</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
		<div class="list_head_ml">当前位置：【SMTP邮件服务器设置】</div>
		<div class="list_head_mr"></div>
		</div>
        <form action="" method="post" id="info" name="info">
        <ul class="tab_conbox" id="tab_conbox">
           <li class="tab_con">
           <table width="100%" border="0" cellpadding="0" cellspacing="1"  class="all_cont">
           <tr><th colspan="4">SMTP邮件服务器设置</th></tr>
           <tr>
				<td align="right" width="150">smtp服务器地址：</td>
				<td><input type='text' value="{$config['EMAIL']['SMTP_HOST']}" name="EMAIL[SMTP_HOST]" size="36"/></td>
               <td align="right" width="150">smtp服务器端口：</td>
				<td><input type='text' value="{$config['EMAIL']['SMTP_PORT']}" name="EMAIL[SMTP_PORT]" size="6"/></td>
			</tr>
            <tr>	
                <td align="right" width="150">smtp服务器帐号：</td>
				<td><input type='text' value="{$config['EMAIL']['SMTP_USERNAME']}" name="EMAIL[SMTP_USERNAME]" size="36"/></td>
                <td align="right" width="150">smtp服务器帐号密码：</td>
				<td><input type='password' value="{$config['EMAIL']['SMTP_PASSWORD']}" name="EMAIL[SMTP_PASSWORD]" size="36"/></td>
			</tr>
             <tr>
                <td align="right" width="150">是否启用SSL安全连接：</td>
				<td>
                <?php if($config['EMAIL']['SMTP_SSL']){ ?> 
				<input type="radio" name="EMAIL[SMTP_SSL]" value="true" checked="checked" />开启 
				<input type="radio" name="EMAIL[SMTP_SSL]" value="false" />关闭 
				<?php }else{?> 
				<input type="radio" name="EMAIL[SMTP_SSL]" value="true" />开启 
				<input type="radio" name="EMAIL[SMTP_SSL]" value="false" checked="checked" />关闭 
				<?php }?>
                </td>
                <td align="right" width="150">是否开启SMTP验证功能：</td>
				<td>
                <?php if($config['EMAIL']['SMTP_AUTH']){ ?> 
				<input type="radio" name="EMAIL[SMTP_AUTH]" value="true" checked="checked" />开启 
				<input type="radio" name="EMAIL[SMTP_AUTH]" value="false" />关闭 
				<?php }else{?> 
				<input type="radio" name="EMAIL[SMTP_AUTH]" value="true" />开启 
				<input type="radio" name="EMAIL[SMTP_AUTH]" value="false" checked="checked" />关闭 
				<?php }?>
                </td>
			</tr>
             <tr>
				<td align="right" width="150">发送的邮件内容编码：</td>
				<td><input type='text' value="{$config['EMAIL']['SMTP_CHARSET']}" name="EMAIL[SMTP_CHARSET]" size="6"/></td>
                <td align="right" width="150">发件人邮件地址：</td>
				<td><input type='text' value="{$config['EMAIL']['SMTP_FROM_TO']}" name="EMAIL[SMTP_FROM_TO]" size="36"/></td>
			</tr>
             <tr>
				<td align="right" width="150">发件人姓名：</td>
				<td><input type='text' value="{$config['EMAIL']['SMTP_FROM_NAME']}" name="EMAIL[SMTP_FROM_NAME]" size="36"/></td>
                <td align="right" width="150">是否显示调试信息	：</td>
				<td>
                <?php if($config['EMAIL']['SMTP_DEBUG']){ ?> 
				<input type="radio" name="EMAIL[SMTP_DEBUG]" value="true" checked="checked" />开启 
				<input type="radio" name="EMAIL[SMTP_DEBUG]" value="false" />关闭 
				<?php }else{?> 
				<input type="radio" name="EMAIL[SMTP_DEBUG]" value="true" />开启 
				<input type="radio" name="EMAIL[SMTP_DEBUG]" value="false" checked="checked" />关闭 
				<?php }?>&nbsp;<a href="{url('set/sendemail')}"  title="发送到站长邮箱">点击测试</a>
                </td>
			</tr>
            <tr>
              <td align="center" colspan="4"><input type="submit" class="btn btn-primary btn-small" value="设置"></td>
            </tr> 
      </table>
     </form>
</div>
</body>
</html>