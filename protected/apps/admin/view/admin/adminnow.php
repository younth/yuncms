<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/common.js"></script>
<script  type="text/javascript" language="javascript" src="__PUBLIC__/js/jquery.skygqCheckAjaxform.js"></script>
<script language="javascript">
  $(function ($) { 
	//表单验证
	var items_array = [
		{ name:"opassword",simple:"旧密码"},
		{ name:"rpassword",min:6,simple:"新密码",focusMsg:'大于6位'},
		{ name:"spassword",type:'eq',to:'rpassword',simple:"确认密码",focusMsg:'再次输入密码'},
		{ name:"realname",type:'chn',simple:"真实姓名",max:5,focusMsg:'小于5字'}
	];

	$("#info").skygqCheckAjaxForm({
		items			: items_array
	});
  });
</script>
<title>管理账户资料修改</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【{$info['realname']}的信息】</div>
           <div class="list_head_mr">

           </div>
        </div>


         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
          <form action="{url('admin/adminnow',array('id'=>$id))}"  method="post" id="info"> 
          <tr>
            <td align="right">账户：</td>
            <td align="left">
              {$info['username']}
            </td>
            <td align="left" class="inputhelp">&nbsp;</td>
          </tr> 
          <tr>
            <td align="right">旧密码：</td>
            <td align="left">
              <input type="password" value="" name="opassword" id="opassword">
            </td>
            <td align="left" class="inputhelp">&nbsp;</td>
          </tr> 
          <tr>
            <td align="right">新密码：</td>
            <td align="left">
              <input type="password" value="" name="rpassword" id="rpassword">
            </td>
            <td align="left" class="inputhelp">&nbsp;</td>
          </tr> 
          <tr>
            <td align="right">确认新密码：</td>
            <td align="left">
              <input type="password" value="" name="spassword" id="spassword">
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
            <td width="200">&nbsp;</td>
            <td align="left" colspan="2">
              <input type="submit" value="修改" class="btn btn-primary btn-small">
            </td>
          </tr> 
          </form>         
        </table>

</div>
</body>
</html>