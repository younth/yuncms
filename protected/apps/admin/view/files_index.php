<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/highslide.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/common.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/highslide.js"></script>
<script language="javascript">
//封面图效果
hs.graphicsDir = "__PUBLIC__/images/graphics/";
hs.showCredits = false;
hs.outlineType = 'rounded-white';
hs.restoreTitle = '关闭';

$(function ($) { 
	$('.del').click(function(){
			if(confirm('删除将不可恢复~')){
				//通过ajax删除文件及文件夹
			var delobj=$(this).parent().parent();//获得当前节点的祖父级节点，即tr
			var id=delobj.attr('id');
			//alert(id);return;
			$.get("{url('files/del')}", {fname:id},//传递当前的id,id是文件夹及文件名组成，定位文件夹/文件
   				function(data){
					if(data==1){
						//alert(delobj);
                      delobj.remove();//删除节点，删除之后加载也不会显示该节点了
					}else alert(data);
   			});
			}
	  });
  });
</script>
<title>上传文件列表</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">        
           <div class="list_head_ml">当前位置：{$daohang}</div>                      
        </div>
         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
          <tr>
            <th width="90%">文件信息</th>
            <th width="10%">操作</th>
          </tr>
          <?php 
                 if(!empty($list)){
                      foreach($list as $vo){
                          $cont.='<tr id="'.$dirget.",".$vo['name'].'">';
						  switch ($vo['type']) {
	   	                        case 1:
								  if(empty($dirget)){
									  switch ($vo['name']) {
	   	                                 case 'fragment':
                                           $vo['cname']='碎片信息';
	   		                             break;
										 case 'links':
                                           $vo['cname']='友情链接';
	   		                             break;
										 case 'news':
                                           $vo['cname']='资讯内容';
	   		                             break;
										 case 'pages':
                                           $vo['cname']='单页栏目';
	   		                             break;
										 default:
                                           $vo['cname']=$vo['name'];
	   		                             break;
	                                  }
									  $cont.='<td align="left" colspan="2"><a class="files" href="'.url('files/index',array('dirget'=>$dirget.",".$vo['name'])).'">'.$vo['cname'].'</a></td>';
								  }else $cont.='<td align="left"><a class="files" href="'.url('files/index',array('dirget'=>$dirget.",".$vo['name'])).'">'.$vo['name'].'</a></td><td><div class="del">删除</div></td>';
	   		                    break;
								
								case 2: //图片
	   		                      $cont.='<td align="left"><a href="'.$upload.$urls.$vo['name'].'" onClick="return hs.expand(this)">'.$vo['name'].'</a>&nbsp;<font size="-1" color="#999">'.$vo['size'].'KB&nbsp;&nbsp;'.$vo['time'].'</font></td><td><div class="del">删除</div></td>';
	   		                    break;
								
								case 3: //合法文件
	   		                      $cont.='<td align="left"><a href="'.$upload.$urls.$vo['name'].'">'.$vo['name'].'</a>&nbsp;<font size="-1" color="#999">'.$vo['size'].'KB&nbsp;&nbsp;'.$vo['time'].'</font></td><td><div class="del">删除</div></td>';
	   		                    break;
								
								case 4: //非法文件
	   		                      $cont.='<td align="left" title="非法文件请马上删除" style="color:red">'.$vo['name'].'&nbsp;<font size="-1" color="#999">'.$vo['size'].'KB&nbsp;&nbsp;'.$vo['time'].'</font></td><td><div class="del">删除</div></td>';
	   		                    break;
	                      }
                          $cont.='</tr>';
                       }
                       echo $cont;
                 }
          ?>
         </table>
</div>
</body>
</html>