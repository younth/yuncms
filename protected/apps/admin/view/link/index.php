<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/common.js"></script>
<script language="javascript">
//解锁和锁定的处理方法，ajax方式在js中实现，也可以直接传参数形式

//锁定
function lock(obj){
	     obj.click(function(){
			var nowobj=$(this);
			var id=nowobj.parent().parent().attr('id');
			$.post("{url('link/lock')}", {id:id,ispass:0},
   				function(data){
					if(data==1){
                      nowobj.html("审核");
					  nowobj.attr('class','unlock');//给当前节点条件css样式
					  nowobj.unbind("click");//删除指定click元素的时间处理
					  unlock(nowobj);//当前元素解锁,没搞懂
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
                      nowobj.html("锁定");
					  nowobj.attr('class','lock');
					  nowobj.unbind("click");
					  lock(nowobj);
					}else alert(data);
   			});
		});
}

$(function ($) { 
	//调用函数
	lock($('.lock'));
	unlock($('.unlock'));
	//ajax删除
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
<title>单页列表</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">        
           <div class="list_head_ml">当前位置：【链接列表】</div>
           <div class="list_head_mr"><a href="{url('link/add')}" class="add">新增</a></div>                           
        </div>
         
         <form action="{url('link/del')}" method="post" onSubmit="return confirm('删除不可以恢复~确定要删除吗？');"> 
         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
          <tr>
            <th width="213"><input type="checkbox" name="chkAll" value="checkbox" onClick="CheckAll(this.form)"/></th>
            <!--<th width="30%">网站LOGO</th>-->
            <th width="212">链接类型</th>
            <th width="497">网站名称</th>
            <th width="130">排序</th>
            <th width="262">操作</th>
          </tr>
          <?php 
                 if(!empty($list)){
                      foreach($list as $vo){
                          $logo=empty($vo['picture'])?empty($vo['logourl'])?$public.'/images/youlink.gif':$vo['logourl']:$path.$vo['picture'];
                          $cont.= '<tr id="'.$vo['id'].'"><td align="center" width="70"><input type="checkbox" name="delid[]" value="'.$vo['id'].'"/></td>';
						  //<td align="center"><img src="'.$logo.'" border="0"></td>
                          $cont.= '<td align="center">';
						  if($vo['type']==1) $name='友情链接';
						  elseif($vo['type']==2) $name='加盟企业';
						  elseif($vo['type']==3) $name='入驻高校';
                          $cont.= $name;
                          $cont.= '</td><td align="center"><a target="_blank" href="'.$vo['url'].'">'.$vo['name'].'</a></td>';
                          $cont.='<td align="center">'.$vo['norder'].'</td><td  width="130">';
                          $cont.=$vo['ispass']?'<div class="lock" >锁定</div>':'<div class="unlock">审核</div>';
                          $cont.='<a href="'.url('link/edit',array('id'=>$vo['id'])).'" class="edt">编辑</a><div class="del">删除</div></td></tr>';
                       }
                       echo $cont;
                     }
          ?>
          <tr>
             <td align="center"><input type="submit" class="btn btn-small"  value="删除"></td>
             <td colspan="5"><div class="pagelist">{$page}</div></td>
          </tr>
         </table>
       </form>
</div>
</body>
</html>