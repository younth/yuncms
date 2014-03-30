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
  $(function ($) { 
	//下拉分类跳转，下拉分类改变了则提交表单
	$('#sort').change(function(){$('#colum').submit()});
	
	//处理执行选择
	$('#dotype').change(function(){
		var delaction= "{url('sort/del')}" ;//删除
		var changeaction="{url('sort/sortsmove')}";//移动栏目
		if('del'==$(this).val()){
			//删除信息
		   	$('#dos').attr('action',delaction);//给form表单添加action=del
			$('#col').hide();//隐藏选择栏目部分div
		}else if('move'==$(this).val()){
			//移动栏目
		    $('#dos').attr('action',changeaction);
			$('#col').show();//显示选择栏目
		}
	});
	
	//ajax操作执行  
	lock($('.lock'));
	unlock($('.unlock'));

	//ajax删除
	 $('.del').click(function(){
			if(confirm('删除将不可恢复~')){
			var delobj=$(this).parent().parent();
			var id=delobj.attr('id');
			$.get("{url('sort/del')}", {id:id},
   				function(data){
					if(data==1){
                      delobj.remove();
					}else alert(data);
   			});
			}
	  });
	 //折叠
	 var hode='<img src="__PUBLICAPP__/images/minus.gif">';
	 var show='<img src="__PUBLICAPP__/images/plus.gif">';
	 $.each($(".all_cont tr"), function(i,val){  
        var id=$(this).attr('id');
		if(id){//初始化收缩图标
		  if($("."+id).length <= 0){
			$(this).find(".fold").remove();
		  }else{
			$(this).find(".fold").html(hode);
		  }
		}
		//if($(this).attr('class')){$(this).hide()}
     });
	 
	 $('.fold').click(function(){
			var delobj=$(this).parent().parent();
			var id=delobj.attr('id');
			if(hode==$(this).html()){
				$('.'+id).hide();
				$(this).html(show);
			}else {
				$('.'+id).find(".fold").html(hode);
				$('.'+id).show();
				$(this).html(hode);
			}
	  });
	 //折叠
	  $('#cl').click(function(){
	    $.each($(".all_cont tr"), function(i,val){  
            var id=$(this).attr('id');
		    if(id){
			  var mark=$(this).find(".fold");
			  if($(this).attr('class')){$(this).hide();mark.html(hode);}
			  else {mark.html(show);}
		  }
        });
	 });
	  //展开
	  $('#op').click(function(){
	    $.each($(".all_cont tr"), function(i,val){  
            $(this).show();
			var mark=$(this).find(".fold");
			if(mark){mark.html(hode);}
        });
	 });
	 $('#cl').click();//初始化折叠
  });

//隐藏
function lock(obj){
	     obj.click(function(){
			var nowobj=$(this);
			var id=nowobj.parent().parent().attr('id');
			$.post("{url('sort/ifmenu')}", {id:id,ifmenu:0},
   				function(data){
					if(data==1){
                      nowobj.html("显示");
					  nowobj.attr('class','unlock');
					  nowobj.unbind("click");
					  unlock(nowobj);
					}else alert(data);
   			});
		});
}
//显示
function unlock(obj){
		obj.click(function(){
			var nowobj=$(this);
			var id=nowobj.parent().parent().attr('id');
			$.post("{url('sort/ifmenu')}", {id:id,ifmenu:1},
   				function(data){
					if(data==1){
                      nowobj.html("隐藏");
					  nowobj.attr('class','lock');
					  nowobj.unbind("click");
					  lock(nowobj);
					}else alert(data);
   			});
		});
}
</script>
</script>
<title>栏目管理</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【栏目管理】</div>
           <div class="list_head_mr"><a href="{url('sort/add')}" class="add">新增</a></div>  
</div>
<form action="{url('sort/del')}" method="post" id="dos"  onSubmit="return confirm('执行后不可以恢复~确定要执行吗？');"> 
         <table width="100%" border="0" cellpadding="0" cellspacing="1"  class="all_cont">
          <tr>
            <th width="70"><input style="color:#E2E2E2" type="checkbox" name="chkAll" value="checkbox" onClick="CheckAll(this.form)"/></th>
            <th width="70">ID</th>
            <th width="80">模型</th> 
            <th>栏目名称&nbsp;&nbsp;<a href="#" id="op"><img src="__PUBLICAPP__/images/plus.gif"></a>&nbsp;&nbsp;<a href="#" id="cl"><img src="__PUBLICAPP__/images/minus.gif"></a></th>  
            <th width="80">内容管理</th>    
            <th width="120">排序<font size="-2">[点击修改]</font></th>
            <th width="110">栏目管理</th>
          </tr>
          <?php          
             if(!empty($list)){
                foreach($list as $vo){
					if($vo['picture']!='NoPic.gif' && !empty($vo['picture'])){
					  switch ($vo['type']) {
			            case 1:
				          $vo['picture']='news/image/'.$vo['picture'];
				        break;
						case 3:
				          $vo['picture']='pages/image/'.$vo['picture'];
				        break;
		              }
					}
                     $space = str_repeat('├┈┈┈', $vo['deep']-1); 
					 $class = str_replace(',',' ', substr($vo['path'], 8));
					 
					 $tlist.= '<tr id="'.$vo['id'].'" class="'.$class.'"><td align="center"><input type="checkbox" name="delid['.$vo['deep'].'][]" value="'.$vo['id'].'" /></td>';
					 $tlist.= '<td align="center">'.$vo['id'].'</td>';  
					 $tlist.= '<td align="center">'.$sort[$vo['type']]['name'].'模型</td>'; 
                     $tlist.= '<td>'.$space.$vo['name'].'</a>&nbsp;&nbsp;<span class="fold"></span></td><td>'; 
					 $tlist.=($vo['type']==1 || $vo['type']==2)?'<a href="'.url($sort[$vo['type']]['mark'].'/index',array('sort'=>urlencode($vo['path'].','.$vo['id']))).'" class="edt">查看</a><a href="'.url($sort[$vo['type']]['mark'].'/add',array('sort'=>urlencode($vo['path'].','.$vo['id']))).'" class="edt">添加</a>':'';
                     $tlist.= '</td><td align="center" id="'.$vo['id'].'" class="order">'.$vo['norder'].'</td><td>';  
					 $tlist.=$vo['ifmenu']?'<div class="lock" >隐藏</div>':'<div class="unlock">显示</div>';
                     $tlist.='<a href="'.url('sort/'.$sort[$vo['type']]['mark'].'edit',array('id'=>$vo['id'])).'" class="edt">编辑</a>';
					 $tlist.='<div class="del">删除</div></td></tr>';
                    }
                echo $tlist;
             }
           ?>     
           <tr> 
            <td colspan="7">
                 <div class="listdo">
                     <select name="dotype" id="dotype">
                        <option value="del">删除</option>
                        <option value="move">移动</option>
                      
                     </select>
                 </div>
                 <div class="listdo" id="col"><select  name="col">
                 <option value="">=选择栏目=</option>
                 <option value="top" style="color:#137cd8">顶级栏目</option>
                       <?php
                     foreach($list as $vo){
                        $space = str_repeat('├┈', $vo['deep']-1);
                        $option.= '<option value="'.$vo['id'].'">'.$space.$vo ['name'].'</option>';
                     }
				     echo $option;
			       ?>

                 </select></div>
                 <div class="listdo"><input type="submit" class="btn btn-small"  value="执行"></div>
             </td>
          </tr>
        </table>
    </form>  
</div>
</body>
</html>