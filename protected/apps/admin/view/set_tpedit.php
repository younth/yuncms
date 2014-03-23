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
		tabMode: 'indent',
        lineNumbers : true,
        autoCloseTags: true,
        extraKeys: {"Ctrl-Space": "autocomplete"}
      });
	  //ajax提交到tpgetcode方法，读取文件内容
      $.post("{url('set/tpgetcode')}", {Mname:"{$tpfile}",fname:"{$filename}"},
   		 function(data){
		   editor.setValue(data);
   	    });
});
</script>
<title>模板内容编辑</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
		<div class="list_head_ml">当前位置：【模板内容编辑】</div>
		<div class="list_head_mr"></div>
		</div>
		<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="1" class="all_cont">
			<form action="{url('set/tpedit',array('Mname'=>$tpfile,'fname'=>$filename))}" method="post" id="info" name="info">
            <tr>
               <td width="200"><strong>{$filename}</strong>&nbsp; <input type="submit" value="保存" class="btn btn-primary btn-small"></td>
            </tr>
            <tr>
               <td>
               <textarea id="code" name="code">读取文件中...</textarea>
               </td>
            </tr>
            <tr><td align="left"><input type="submit" value="保存" class="btn btn-primary btn-small"></td></tr>
			</form>
		</table>
</div>
</body>

</html>
