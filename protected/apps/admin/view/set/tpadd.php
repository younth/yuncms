<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<link rel="stylesheet" href="__PUBLIC__/codeEditor/codemirror.css">
<link rel="stylesheet" href="__PUBLIC__/codeEditor/show-hint.css">
<script src="__PUBLIC__/codeEditor/codemirror.js"></script>
<script src="__PUBLIC__/codeEditor/show-hint.js"></script>
<script src="__PUBLIC__/codeEditor/closetag.js"></script>
<script src="__PUBLIC__/codeEditor/html-hint.js"></script>
<script src="__PUBLIC__/codeEditor/xml.js"></script>
<script src="__PUBLIC__/codeEditor/javascript.js"></script>
<script src="__PUBLIC__/codeEditor/css.js"></script>
<script src="__PUBLIC__/codeEditor/php.js"></script>
<script src="__PUBLIC__/codeEditor/htmlmixed.js"></script>
<script type="text/javascript">
$(function ($) { 
	CodeMirror.commands.autocomplete = function(cm) {
          CodeMirror.showHint(cm, CodeMirror.htmlHint);
      }
	 var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
         mode: 'text/html',
         lineNumbers : true,
		 autoCloseTags: true,
		 extraKeys: {"Ctrl-Space": "autocomplete"}
      });
});
</script>
<title>模板"{$tpfile}"新增文件</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
		<div class="list_head_ml">当前位置：【模板"{$tpfile}"新增文件】</div>
		<div class="list_head_mr"></div>
		</div>
		<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="1" class="all_cont">
			<form action="{url('set/tpadd',array('Mname'=>$tpfile))}" method="post" id="info" name="info">
            <tr>
               <td align="right" width="10%">文件名称:</td>
               <td align="left"><input type="text" name="filename">.php</td>
            </tr>
            <tr>
            <td align="right"  width="10%">内容:</td>
               <td  align="left">
               <textarea id="code" name="code"></textarea>
               </td>
            </tr>
			<tr>
				<td align="left" colspan="2"><input type="submit" value="创建" class="btn btn-primary btn-small"></td>
			</tr>
			</form>
		</table>
</div>
</body>

</html>