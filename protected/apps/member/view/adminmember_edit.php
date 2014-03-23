<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLIC__/admin/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/common.js"></script>
<title>{$t_name}会员</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
		<div class="list_head_ml">你当前的位置：【{$t_name}会员】</div>
		<div class="list_head_mr"></div>
		</div>


		<table width="100%" border="0" cellpadding="0" cellspacing="1" class="all_cont">
			<form action="" method="post" id="info" name="info">
            <tr>
               <td align="right">用户名：</td>
               <td><input type='text' value='{$info->uname}' name='uname'/></td>
               <td class="inputhelp"></td>
            </tr>
            <tr>
               <td align="right">会员级别：</td>
               <td>
               <select name="groupid">
                 {$select}
               </select>
               </td>
               <td class="inputhelp"></td>
            </tr>
            <tr>
               <td align="right">密码：</td>
               <td><input type="password" name="password" value="{$info['password']}"><input type="hidden" name="oldpassword" value="{$info['password']}"></td>
               <td class="inputhelp"></td>
            </tr>
            
            <tr>
               <td align="right">邮箱：</td>
               <td><input type="text" name="login" value="{$info['login']}"></td>
               <td class="inputhelp"></td>
            </tr>
            <tr>
               <td align="right">手机：</td>
               <td><input type="text" name="tel" value="{$info['tel']}"></td>
               <td class="inputhelp"></td>
            </tr>
            <tr>
               <td align="right">QQ：</td>
               <td><input type="text" name="qq" value="{$info['qq']}"></td>
               <td class="inputhelp"></td>
            </tr>
            <?php if($action!="add") {?>
            <tr>
               <td align="right">注册时间：</td>
               <td>{date($info['ctime'],Y-m-d H:i:s)}</td>
               <td class="inputhelp"></td>
            </tr>
            <tr>
               <td align="right">上次登录时间：</td>
               <td>{date($info['lasttime'],Y-m-d H:i:s)}</td>
               <td class="inputhelp"></td>
            </tr>
            <?php }?>
            <tr>
               <td align="right">是否激活：</td>
               <td>
                    <input name="is_active" type="radio" value="1" <?php echo ($info['is_active']==1)?'checked="checked"':''; ?> />激活 &nbsp;
                    <input name="is_active" type="radio" value="0" <?php echo ($info['is_active']==0)?'checked="checked"':''; ?> />冻结
                </td>
               <td class="inputhelp"></td>
            </tr>
			<tr>
				<td width="200">&nbsp;</td>
				<td align="left" colspan="2"><input type="hidden" name="id" value="{$info['id']}"> <input type="submit" value="修改" class="btn btn-primary btn-small"></td>
			</tr>
			</form>
		</table>
</div>
</body>
</html>