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
		{ name:"name",simple:"功能名称",focusMsg:''},
		{ name:"sign",type:"eng",simple:"调用标识",focusMsg:'必须是英文字符'}
	];

	$("#info").skygqCheckAjaxForm({
		items			: items_array
	});
  });
</script>
<title>管理员管理</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【添加功能】</div>
           <div class="list_head_mr">
             
           </div>
</div>


         <table width="100%" border="0" cellpadding="0" cellspacing="1"    class="all_cont">
          <form action=""  method="post" id="info" name="info">
          <tr>
            <td align="right" width="200">选择功能栏目：</td>
            <td align="left">
             <select name="pid" id="pid">
             <option selected="selected" value="0" >=作为顶级分类=</option>
                  <?php
                     if(!empty($list)){
                        foreach($list as $vo){
                          $option.='<option value="'.$vo['id'].'">'.$vo['name'].'</option>';
                        }
                      echo $option;
                      }
                 ?>
             </select>
            </td>
            <td align="left" class="inputhelp"></td>
          </tr> 
          
          <tr>
            <td align="right">功能名称：</td>
            <td align="left">
              <input type="text" name="name" id="name">
            </td>
            <td align="left" class="inputhelp">&nbsp;</td>
          </tr> 
          
          
          <tr>
            <td align="right">操作(operate)：</td>
            <td align="left">
              <input type="text" name="operate" id="operate">
            </td>
            <td align="left" class="inputhelp">方法的操作名</td>
          </tr> 
          
          <tr>
            <td align="right">是否菜单显示</td>
            <td align="left">
              <input name="ifmenu"  type="radio" value="1" />是 <input checked="checked"  name="ifmenu" type="radio" value="0" />否
            </td>
            <td align="left" class="inputhelp">选择是将在后台的显示</td>
          </tr> 
          
          <tr>
            <td width="200">&nbsp;</td>
            <td align="left" colspan="2">
              <input type="submit" value="添加" class="btn btn-primary btn-small">
            </td>
          </tr> 
          </form>         
        </table>

</div>
</body>
</html>
