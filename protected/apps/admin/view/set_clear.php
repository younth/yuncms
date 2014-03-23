<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/common.js"></script>
<script	language="javascript">
  $(function ($) { 
	//ajax方式提交
	$('.clear').click(function(){
			if(confirm('确定要清空吗？')){
			var delobj=$(this).parent().parent();
			var file=delobj.attr('id');
			$(this).unbind("click");
			var stateob=$(this).parent()
			stateob.html('努力处理中...');			
			$.get("{url('set/clear')}", {file:file},
   				function(data){
                   stateob.html(data);
				   stateob.prev().html('0 kb');
   			});
			}
	  });
  });
</script>
<title>清空缓存</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
		<div class="list_head_ml">当前位置：【前台缓存清空】</div>
		<div class="list_head_mr"></div>
		</div>

		<table width="100%" border="0" cellpadding="0" cellspacing="1"  class="all_cont">
           <tr>
              <th>缓存类型</th>
              <th>缓存大小</th>
              <th  width="7%">操作</th>
           </tr>
           <tr id="db" >
             <td align="center" width="200">数据库缓存</td>
             <td align="center">{$dbsize}&nbsp;kb</td>
             <td align="center"><a href="Javascript:void(0)" class="clear">清空</a></td>
           </tr>
           <tr id="temp" >
             <td align="center" width="200">模板缓存</td>
             <td align="center">{$temsize}&nbsp;kb</td>
             <td align="center"><a href="Javascript:void(0)" class="clear">清空</a></td>
           </tr>
           <tr id="html" >
             <td align="center">静态缓存</td>
             <td align="center">{$htmlsize}&nbsp;kb</td>
             <td align="center"><a href="Javascript:void(0)" class="clear">清空</a></td>
           </tr>
		</table>

</div>
</body>
</html>