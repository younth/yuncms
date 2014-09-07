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
	//ajax实现点击切换
	$('.set').click(function(){	
			if(confirm('切换模板将会清空模板缓存~')){
			var nowobj=$(this);
			var tpfile=nowobj.attr('title');//模板名称
			var id=nowobj.attr('id');//模板的类型,pc 移动
			$.post("{url('set/tpchange')}", {tpfile:tpfile,type:id},
   				function(data){
				if(data==1){
					$('.set'+id).removeClass('on');
					$('.set'+id).html('使用该模板');
					nowobj.html('模板正在使用中');
					nowobj.addClass('on');
				}else alert(data);
   			});
		}
	  });
  });
</script>
<style>.on{ color:#F00}</style>
<title>前台模板</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
		<div class="list_head_ml">当前位置：【前台模板】</div>
		<div class="list_head_mr"></div>
		</div>


		<table width="100%" border="0" cellpadding="0" cellspacing="1"  class="all_cont">
           <tr>
              <th>模板名称</th>
              <th>作者</th>
              <th>PC端</th>
              <th>手机/移动端</th>
              <th>模板编辑</th>
           </tr>
           <?php 
              if(!empty($tpinfo)){
                   foreach ($tpinfo as $key => $vo){
                       $list.='<tr><td align="center">'.$vo['name'].'</td>';
                       $list.='<td align="center">'.$vo['author'].'</td>';
                       $list.=($key==$fileNow)?'<td align="center"><a href="#" id="0" class="set set0 on" title="'.$key.'">模板正在使用中</a></td>':'<td align="center"><a href="#" id="0" class="set set0" title="'.$key.'">使用该模板</a></td>';
					   $list.=($key==$fileNowMobile)?'<td align="center"><a href="#" id="1" class="set set1 on" title="'.$key.'">模板正在使用中</a></td>':'<td align="center"><a href="#" id="1" class="set set1" title="'.$key.'">使用该模板</a></td>';
					   $list.='<td align="center"><a href="'.url('set/tplist',array('Mname'=>$key)).'">管理模板文件</a></td></tr>';
                   }
                 echo $list;
               }
            ?>
		</table>
</div>
</body>
</html>