<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<link href="__PUBLICAPP__/css/new.css" type=text/css rel=stylesheet>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/highslide.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/common.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/highslide.js"></script>
<script type="text/javascript" src="__PUBLIC__/lhgcalendar/lhgcore.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/lhgcalendar/lhgcalendar.min.js"></script>
<script type="text/javascript">
J(function(){
    J('#starttime').calendar();
	J('#endtime').calendar();
});
</script>
<script language="javascript">
//封面图效果
hs.graphicsDir = "__PUBLIC__/images/graphics/";
hs.showCredits = false;
hs.outlineType = 'rounded-white';
hs.restoreTitle = '关闭';

 //锁定，点击锁定之后，class变成了unlock
function lock(obj){
	     obj.click(function(){
			var nowobj=$(this);
			var id=nowobj.parent().parent().attr('id');
			$.post("{url('news/lock')}", {id:id,ispass:0},
   				function(data){
					if(data==1){
                      nowobj.html("审核");
					  nowobj.attr('class','unlock');//添加未审核的css
					  nowobj.unbind("click");//取消click事件
					 unlock(nowobj);//再次点击,就后审核
					}else alert(data);
   			});
		});
}
//解锁
function unlock(obj){
		obj.click(function(){
			var nowobj=$(this);
			var id=nowobj.parent().parent().attr('id');
			$.post("{url('news/lock')}", {id:id,ispass:1},
   				function(data){
					if(data==1){
                      nowobj.html("锁定");
					  nowobj.attr('class','lock');
					  nowobj.unbind("click");
					  lock(nowobj);//为什么，再次点击就锁定
					}else alert(data);
   			});
		});
}
 //推荐
function recmd(obj){
	    obj.click(function(){
			var nowobj=$(this);
			var id=nowobj.parent().parent().attr('id');
			$.post("{url('news/recmd')}", {id:id,recmd:1},
   				function(data){
					if(data==1){
                      nowobj.html("取消");
					  nowobj.attr('class','unrecmd');
					  nowobj.unbind("click");
					  unrecmd(nowobj);
					}else alert(data);
   			});
		});
}
 //取消推荐
function unrecmd(obj){
	    obj.click(function(){
			var nowobj=$(this);
			var id=nowobj.parent().parent().attr('id');
			$.post("{url('news/recmd')}", {id:id,recmd:0},
   				function(data){
					if(data==1){
                      nowobj.html("推荐");
					  nowobj.attr('class','recmd');
					  nowobj.unbind("click");
					  recmd(nowobj);
					}else alert(data);
   			});
		});
}

$(function ($) { 
	//下拉分类跳转，下拉分类改变了则提交表单
	$('#sort').change(function(){$('#colum').submit()});
	
	//处理执行选择
	$('#dotype').change(function(){
		var delaction= "{url('news/del')}" ;//删除
		var changeaction="{url('news/colchange')}";//移动栏目
		if('del'==$(this).val()){
			//删除信息
		   	$('#dos').attr('action',delaction);//给form表单添加action=del
			$('#col').hide();//隐藏选择栏目部分div
		}else if('change'==$(this).val()){
			//移动栏目
		    $('#dos').attr('action',changeaction);
			$('#col').show();//显示选择栏目
		}
	});
	
	//ajax操作执行
	lock($('.lock'));
	unlock($('.unlock'));
	recmd($('.recmd'));
	unrecmd($('.unrecmd'));
	
	//ajax删除
	 $('.del').click(function(){
			if(confirm('删除将不可恢复~')){
			var delobj=$(this).parent().parent();
			var id=delobj.attr('id');
			$.get("{url('news/del')}", {id:id},
   				function(data){
					if(data==1){
              delobj.remove();
					}else alert(data);
   			});
			}
	  });
  });
</script>
<title>资讯列表</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">        
           <div class="list_head_ml">当前位置：【资讯列表】</div>
           <div class="list_head_mr"><a href="{url('news/add')}" class="add">新增</a></div>                           
        </div>

         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
          <tr>
            <td></td>
            <td></td>
            <td align="center">
            <form action="{url('news/index')}" method="GET" id="colum" >
            <input name="yun" type="hidden" value="{$_GET['yun']}" /><!--get[yun]就是当前的页面news/index/-->
                <select name="sort" id="sort">
                  <option value="">=所有资讯栏目=</option>
                  {$option}
               </select>
            </form>
            </td>
            <td align="center">
                <select name="places" id="places">
                  <option value="">=不限定位=</option>
                  {$poption}
               </select>
            </td>            
            <td colspan="4" align="right">
               <form action="{url('news/index')}" method="GET" >
                  <div class="news-search">新闻标题：<input type="text" name="keyword" size="20">
					&nbsp;&nbsp;时间： <input type="text" name="starttime" size="20" placeholder="起止时间" id="starttime" readonly />  — 
                    <input type="text" name="endtime" size="20" placeholder="结束时间" id="endtime" readonly />
                    <input class="btn btn-success btn-small" type="submit" value="搜索">                              	
                    <input name="yun" type="hidden" value="{$_GET['yun']}" />    
                  </div>
               </form> 
            </td>
          </tr>
         <form action="{url('news/del')}" method="post" id="dos"  onSubmit="return confirm('执行后不可以恢复~确定要执行吗？');"> 
          <tr>
            <th align="center" width="85"><input style="color:#E2E2E2" type="checkbox" name="chkAll" value="checkbox" onClick="CheckAll(this.form)"/></th>
            <th>ID</th>
            <th>所属栏目</th>
            <th>新闻标题(点击)</th>
            <th width="150" >发布者</th>	
            <th width="150" >添加日期</th>	
            <th width="150" align="center">管理选项</th>
          </tr>
          <?php 
                 if(!empty($list)){
                      foreach($list as $vo){
                          $sortid=explode(',',$vo['sort']);
						  $vo['realname']=empty($vo['realname'])?"已被删除":$vo['realname'];
                          $sortstr='';
                          foreach($sortid as $v){
                              $sortstr.=empty($sortname[$v])?'':$sortname[$v].'→';
                          }
                          $cont.= '<tr id="'.$vo['id'].'"><td align="center"><input type="checkbox" name="delid[]" value="'.$vo['id'].'" /></td>';
                          $cont.= '<td  align="center">'.$vo['id'].'</td>';
                          $cont.= '<td >'.$sortstr.'</td>';
                          $cont.= '<td><a title="点击预览" style="color:'.$vo['color'].'" target="_blank" href="'.url('default/'.$vo['method'],array('id'=>$vo['id'])).'">';
						  //次数keyword变绿色
                          $cont.= str_replace($keyword,"<font color=green>$keyword</font>",$vo['title']).'</a><font color=green>（'.$vo['hits'].'点击）</font>';
                          $cont.= $vo['picture']=='NoPic.gif'?'':'<a title="点击查看封面" href="'.$path.$vo['picture'].'" onClick="return hs.expand(this)"><img src="'.$public.'/images/pic.png"></a>';
                          $cont.= '</td><td width="150" align="center">'.$vo['realname'].'</td>';
                          $cont.= '<td width="150" align="center">'.date("Y-m-d H:i:s",$vo['addtime']).'</td><td align="center"  width="150">';
                          $cont.=$vo['ispass']?'<div class="lock" >锁定</div>':'<div class="unlock">审核</div>';
                          $cont.=$vo['recmd']?'<div class="unrecmd">取消</div>':'<div class="recmd">推荐</div>';
                          $cont.= '<a href="'.url('news/edit',array('id'=>$vo['id'])).'" class="edt">编辑</a><div class="del">删除</div></td></tr>';
                       }
                        echo $cont;
                     }
          ?>
          <tr>
             <td colspan="3">
                 <div class="listdo">
                     <select name="dotype" id="dotype">
                        <option value="del">删除信息</option>
                        <option value="change">栏目移动</option>
                     </select>
                 </div>
                 <div class="listdo" id="col"><select  name="col"><option value="">=选择栏目=</option>{$option}</select></div>
                 <div class="listdo"><input type="submit" class="btn btn-small"  value="执行"></div>
             </td>
             <td colspan="4"><div class="pagelist">{$page}</div></td>
          </tr>
          </form>      
        </table>

</div>
</body>
</html>
