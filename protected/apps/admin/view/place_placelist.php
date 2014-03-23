<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/common.js"></script>
<script language="javascript">
//锁定
function lock(obj){
	     obj.click(function(){
			var nowobj=$(this);
			var id=nowobj.parent().parent().attr('id');
			$.post("{url('link/lock')}", {id:id,ispass:0},
   				function(data){
					if(data==1){
                      nowobj.html("审核");
					  nowobj.attr('class','unlock');
					  nowobj.unbind("click");
					  unlock(nowobj);
					}else alert(data);
   			});
		});
}
//解锁
function unlock(obj){
		obj.click(function(){
			var nowobj=$(this);
			var id=nowobj.parent().parent().attr('id');
			$.post("{url('link/lock')}", {id:id,ispass:1},
   				function(data){
					if(data==1){
                      nowobj.html("取消");
					  nowobj.attr('class','lock');
					  nowobj.unbind("click");
					  lock(nowobj);
					}else alert(data);
   			});
		});
}
$(function ($) { 
	lock($('.lock'));
	unlock($('.unlock'));
	$('.del').click(function(){
			if(confirm('删除将不可恢复~')){
			var delobj=$(this).parent().parent();
			var id=delobj.attr('id');
			$.get("{url('link/del')}", {id:id},
   				function(data){
					if(data==1){
                      delobj.remove();
					}else alert(data);
   			});
			}
	  });
  });
</script>
<title>定位列表</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">        
           <div class="list_head_ml">当前位置：【定位列表】</div>
           <div class="list_head_mr"><a href="{url('place/placeadd')}" class="add">新增</a></div>                           
        </div>
         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
          <tr>
            <th width="10%">ID</th>
            <th width="60%">名称</th>
            <th width="10%">排序</th>
            <th width="20%">操作</th>
          </tr>
          <?php 
                 if(!empty($list)){
                      foreach($list as $vo){
                          $cont.= '<tr><td align="center">'.$vo['id'].'</td>';
                          $cont.= '<td align="center">'.$vo['name'].'</td>';
                          $cont.= '<td align="center">'.$vo['norder'].'</td>';
                          $cont.='<td align="center"><a href="'.url('place/placeedit',array('id'=>$vo['id'])).'" class="edt">编辑</a><a href="'.url('place/placedel',array('id'=>$vo['id'])).'" class="edt" onClick="return confirm(\'删除后资讯和图集内容定位将不能选择该项~\')">删除</a></td></tr>';
                       }
                       echo $cont;
                     }
          ?>
          <tr>
             <td colspan="4"><div class="pagelist">{$page}</div></td><a href="" >
          </tr>
         </table>
       </form>
</div>
</body>
</html>