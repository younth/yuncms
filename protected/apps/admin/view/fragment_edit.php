<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/common.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/kindeditor/kindeditor.js"></script>
<script  type="text/javascript" language="javascript" src="__PUBLIC__/js/jquery.skygqCheckAjaxform.js"></script>
<script language="javascript">
KindEditor.ready(function(K) {
	K.create('#content', {
		allowFileManager : true,
		filterMode:false,
		uploadJson : '{url('fragment/UploadJson')}',
		fileManagerJson : '{url('fragment/FileManagerJson')}'
	});
});
$(function ($) { 
   //表单验证
	var items_array = [
		{ name:"title",simple:"碎片名称",focusMsg:''},
		{ name:"sign",type:"eng",simple:"调用标识",focusMsg:'必须是英文字符'}
	];

	$("#info").skygqCheckAjaxForm({
		items			: items_array
	});
  });
</script>
<title>碎片{$t_name}</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【碎片{$t_name}】</div>
        </div>



        <form  action=""  method="post" id="info" name="info" >
         <table class="all_cont" width="100%" border="0" cellpadding="5" cellspacing="1"   > 
          <tr>
            <td align="right" width="100">用途描述：</td>
            <td align="left"><input name="title" id="title" type="text" value="{$info['title']}" /></td>
            <td class="inputhelp">请避免使用系统关键词作为标识，否则调用会出现错误</td>
          </tr>
          <tr>
            <td align="right">调用标识：</td>
            <td align="left">{piece:<input name="sign" id="sign" type="text" value="{$info['sign']}" />}</td>
            <td class="inputhelp">新增之后，无法修改</td>
          </tr>
          <tr>
            <td align="right">内容：</td>
            <td align="left" colspan="2"><textarea name="content" id="content" style=" width:100%;height:450px;visibility:hidden;">{$info['content']}</textarea></td>
          </tr>
          <tr>
            <td></td>
            <td colspan="2" align="left"><input type="submit" class="btn btn-primary btn-small" value="{$t_name}">&nbsp;<input class="btn btn-primary btn-small" type="reset" value="重置"></td>
          </tr>           
        </table>
</form>
</div>
</body>
</html>