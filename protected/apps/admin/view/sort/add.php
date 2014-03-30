<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script  type="text/javascript" language="javascript" src="__PUBLIC__/js/jquery.skygqCheckAjaxform.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/kindeditor/kindeditor.js"></script>
<script language="javascript">
  $(function ($) { 
	//默认加载资讯栏目
	$("#colsort").focus();//自动聚焦
	$('#sortcon').html('<div id="loading"></div>');//加载
	$.get("{url('sort/add')}", {sortaction : 'linkadd'},
   		 function(data){
		   $('#sortcon').html(data);
   	    });
  });
  function getcon() {
	  $('#sortcon').html('<div id="loading"></div>');
	  var sortaction=$('#colsort').val();//获取select的值
	  //alert(sortaction);
	  	//ajax选择添加的模块
      $.get("{url('sort/add')}", {sortaction : sortaction},
   		 function(data){
			 //alert(data);
		   $('#sortcon').html(data);//将data的内容加到sortcon里面
		   //如果是pageadd，则调用kindeditor
		   if(sortaction=='pageadd'){
                KindEditor.create('#content', {
		            allowFileManager : true,
		            filterMode:false,
		            uploadJson : "{url('sort/PageUploadJson')}",
		            fileManagerJson : "{url('sort/PageFileManagerJson')}"
	            });
		   }
   	    });
  }
</script>
<title>添加栏目</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【添加栏目】</div>
           <div class="list_head_mr">

           </div>
</div>
    <table width="100%" border="0" cellpadding="0" cellspacing="1">       
          <tr>
            <td align="center">
             <select id="colsort" onChange="getcon()" style="color:#137cd8">
               <option  value="newsadd" >资讯栏目</option>
               <option value="pageadd" >单页栏目</option>
              <!-- <option value="pluginadd" >应用栏目</option>-->
               <option value="linkadd" selected="selected" >自定义栏目</option>
        </select>
            </td>
          </tr>
    </table>
    <div id="sortcon"></div>

</div>
</body>
</html>