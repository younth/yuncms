<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLIC__/admin/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/common.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/kindeditor/kindeditor.js"></script>
<script  type="text/javascript" language="javascript" src="__PUBLIC__/js/jquery.skygqCheckAjaxform.js"></script>
<script language="javascript">
$(function ($) { 
	KindEditor.ready(function(K) {
	K.create('#content', {
		resizeType : 1,
		allowPreviewEmoticons : false,
		allowImageUpload : false,
		items : [
							 'fontname','fontsize', 'forecolor','hilitecolor','bold',
							 'justifyleft','justifycenter', 'justifyright','italic', 
							 'emoticons','image','link' ,'insertfile'
				]
	});
});
   //表单验证
	var items_array = [
		{ name:"title",simple:"标题",focusMsg:''},
		{ name:"content",simple:"内容",focusMsg:''},
	];

	$("#info").skygqCheckAjaxForm({
		items			: items_array
	});
  });
</script>
<title>发送{$t_name}</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【群发{$t_name}】</div>
        </div>



        <form  action=""  method="post" id="info" name="info" >
         <table class="all_cont" width="100%" border="0" cellpadding="5" cellspacing="1"   > 
           
          <tr>
            <td align="right" width="100">主题：</td>
            <td align="left"><input name="title" id="title" type="text" value="" /></td>
            <td class="inputhelp">请填写{$t_name}的主题</td>
          </tr>
          <tr>
            <td align="right">内容：</td>
            <td align="left" colspan="2"><textarea name="body" style=" width:38%;height:200px;visibility:hidden;" id="content"></textarea></td>
          </tr>
          <tr>
            <td></td>
            <td colspan="2" align="left"><input type="submit" class="btn btn-primary btn-small" value="发送">&nbsp;<input class="btn btn-primary btn-small" type="reset" value="重置"></td>
          </tr>           
        </table>
</form>
</div>
</body>
</html>