<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLIC__/admin/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/common.js"></script>
<title>{$t_name}会员组</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
		<div class="list_head_ml">你当前的位置：【{$t_name}会员组】</div>
		<div class="list_head_mr"></div>
		</div>



		<table width="100%" border="0" cellpadding="0" cellspacing="1" class="all_cont">
			<form action="" method="post" id="info" name="info">
            <tr>
               <td align="right">会员组名：</td>
               <td><input type="text" name="gname" value="{$info['group_name']}"></td>
               <td class="inputhelp"></td>
            </tr>
            <tr>
               <td align="right">会员组图标：</td>
               <td>
               <input type="radio" checked="checked" value="0" name="user_group_icon">暂无信息 
               <input name="user_group_icon" type="radio" value="01.gif" <?php echo ($info['user_group_icon']=='01.gif')?'checked="checked"':''; ?> />
               <img src="__PUBLIC__/images/usergroup/01.gif" /> &nbsp;
               <input name="user_group_icon" type="radio" value="02.gif" <?php echo ($info['user_group_icon']=='02.gif')?'checked="checked"':''; ?> />
               <img src="__PUBLIC__/images/usergroup/02.gif" /> &nbsp;
               <input name="user_group_icon" type="radio" value="03.gif" <?php echo ($info['user_group_icon']=='03.gif')?'checked="checked"':''; ?> />
               <img src="__PUBLIC__/images/usergroup/03.gif" /> &nbsp;
               <input name="user_group_icon" type="radio" value="04.gif" <?php echo ($info['user_group_icon']=='04.gif')?'checked="checked"':''; ?> />
               <img src="__PUBLIC__/images/usergroup/04.gif" /> &nbsp;
               <input name="user_group_icon" type="radio" value="05.gif" <?php echo ($info['user_group_icon']=='05.gif')?'checked="checked"':''; ?> />
               <img src="__PUBLIC__/images/usergroup/05.gif" /> &nbsp;
               <input name="user_group_icon" type="radio" value="06.gif" <?php echo ($info['user_group_icon']=='06.gif')?'checked="checked"':''; ?> />
               <img src="__PUBLIC__/images/usergroup/06.gif" /> &nbsp;
               <input name="user_group_icon" type="radio" value="07.gif" <?php echo ($info['user_group_icon']=='07.gif')?'checked="checked"':''; ?> />
               <img src="__PUBLIC__/images/usergroup/07.gif" /> &nbsp;
               
               </td>
               <td class="inputhelp"></td>
            </tr>
            <tr>
               <td align="right">不允许的操作：</td>
               <td><textarea name="notallow" cols="60" rows="10">{$info['notallow']}</textarea></td>
               <td class="inputhelp">应用/控制器/方法,键=值/键=值/键=值....<回车></td>
            </tr>
			<tr>
				<td width="200">&nbsp;</td>
				<td align="left" colspan="2"><input type="hidden" name="id" value="{$info['id']}"> <input type="submit" value="{$t_name}" class="btn btn-primary btn-small"></td>
			</tr>
			</form>
		</table>
        </div>
</body>
</html>