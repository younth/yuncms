<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/common.js"></script>
<script  type="text/javascript" language="javascript" src="../__PUBLIC__/js/jquery.skygqCheckAjaxform.js"></script>
<script language="javascript">
  $(function ($) { 
	  //表单验证
	var items_array = [
	    { name:"username",max:10,simple:"账户",focusMsg:'10位内'},
		{ name:"rpassword",min:6,simple:"密码",focusMsg:'大于6位'},
		/*{ name:"spassword",type:'eq',to:'rpassword',simple:"确认密码",focusMsg:'再次输入密码'},*/
		{ name:"realname",type:'chn',simple:"真实姓名",max:5,focusMsg:'小于5字'}
	];

	$("#info").skygqCheckAjaxForm({
		items			: items_array
	});
  });
</script>
<title>{$t_name}管理员</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【{$t_name}管理员】</div>
           <div class="list_head_mr">

           </div>
        </div>

         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
          <form action=""  method="post">
          <tr>
            <td align="right" width="200">权限级别：</td>
            <td align="left">
             <select name="groupid" id="groupid">
                  <?php
                     if(!empty($grouplist)){
                        foreach($grouplist as $vo){
                          $selected= ($info['groupid']==$vo['id'])?'selected="selected"':'';
                          $option.='<option '.$selected.' value="'.$vo['id'].'">'.$vo['name'].'</option>';
                        }
                      echo $option;
                      }
                 ?>
             </select>
            </td>
            <td align="left" class="inputhelp">权限级别请在<a href="{url('admin/group')}">这里设置</a></td>
          </tr> 
         
          <tr>
            <td align="right">用户名：</td>
            <td align="left">
              <input type="text" name="username" value="{$info['username']}" id="username">
            </td>
            <td align="left" class="inputhelp">&nbsp;</td>
          </tr> 
          
          <tr>
            <td align="right">密码：</td>
            <td align="left">
              <input type="password" value="{$info['password']}" name="rpassword" id="rpassword">
            </td>
            <td align="left" class="inputhelp">&nbsp;</td>
          </tr> 
          
          <tr>
            <td align="right">真实姓名：</td>
            <td align="left">
              <input type="text" name="realname" value="{$info['realname']}" id="realname">
            </td>
            <td align="left" class="inputhelp">该管理员所有操作将会以这个名称标记</td>
          </tr> 
          
          <tr>
            <td align="right">是否锁定</td>
            <td align="left">
              <input name="iflock" <?php echo ($info['iflock']==1)?'checked="checked"':''; ?>  type="radio" value="1" />是 <input <?php echo ($info['iflock']==0)?'checked="checked"':''; ?>  name="iflock" type="radio" value="0" />否
            </td>
            <td align="left" class="inputhelp">锁定后管理员将不能登陆</td>
          </tr> 
          
          <tr>
            <td width="200">&nbsp;</td>
            <td align="left" colspan="2">
              <input type="submit" value="{$t_name}" class="btn btn-primary btn-small">
            </td>
          </tr> 
          </form>         
        </table>
        </td>
      </tr>
</table>
</div>
</body>
</html>