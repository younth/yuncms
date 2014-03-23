<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLIC__/admin/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/common.js"></script>
<script type="text/javascript" src="__PUBLIC__/lhgcalendar/lhgcore.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/lhgcalendar/lhgcalendar.min.js"></script>
<script type="text/javascript">
J(function(){
    J('#starttime').calendar();
	J('#endtime').calendar();
});
</script>
<script language="javascript">
function lock(obj){
	     obj.click(function(){
			var nowobj=$(this);
			var id=nowobj.parent().parent().attr('id');
			$.post("{url('adminmember/lock')}", {id:id,is_active:0},
   				function(data){
					if(data==1){
                      nowobj.html("激活");
					  nowobj.attr('class','unlock');
					  nowobj.unbind("click");
					  unlock(nowobj);
					}else alert(data);
   			});
		});
}

function unlock(obj){
		obj.click(function(){
			var nowobj=$(this);
			var id=nowobj.parent().parent().attr('id');
			
			$.post("{url('adminmember/lock')}", {id:id,is_active:1},
   				function(data){
					if(data==1){
                      nowobj.html("冻结");
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
	
	//ajax操作
	 $('.del').click(function(){
			if(confirm('删除将不可恢复~')){
			var delobj=$(this).parent().parent();
			var id=delobj.attr('id');
			$.get("{url('adminmember/del')}", {id:id},
   				function(data){
					if(data==1){
                      delobj.remove();
					}else alert(data);
   			});
			}
	  });
  });
  
</script>

<title>会员列表</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">你当前的位置：【会员列表】</div>
           <div class="list_head_mr">
           </div>
        </div>
         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont" >
         <tr>
            <td colspan="9" align="left">
               <form action="{url('adminmember/index')}" method="GET" >
               <!-----为什么提交之后的之后是转到首页呢------->
                <input name="yun" type="hidden" value="{$_GET['yun']}" /><!--get[yun]就是当前的页面方法，不可少，保证页面不跳转-->
                 <div style="float:left; margin-left:10px;"> 
                  	用户名： <input type="text" name="keyword" size="20" placeholder="输入用户名"> 
                 	&nbsp;&nbsp;注册时间： <input type="text" name="starttime" size="20" placeholder="起止时间"   id="starttime" readonly />  — 
                    <input type="text" name="endtime" size="20" placeholder="结束时间" id="endtime" readonly /> 
                 </div>
                 
                  <div style="float:left"><input class="btn btn-success  btn-small" type="submit" value="搜索"></div>
               </form> 
          </tr>
         <form action="{url('adminmember/del')}" method="post" onSubmit="return confirm('删除不可以恢复~确定要删除吗？');"> 
          <tr>
              <th align="center" width="136"><input type="checkbox" name="chkAll" value="checkbox" onClick="CheckAll(this.form)"/></th>
              <th width="130">用户名</th>
              <th width="130">级别</th>
              <th width="130">注册IP</th>
              <th width="236">注册时间</th>
              <th width="130">上次登录IP</th>
              <th width="208">上次登录时间</th>
              <th width="211">管理选项</th>
          </tr>
          <?php 
              if(!empty($list)){
                   foreach($list as $vo){
                     $book.='<tr id="'.$vo['id'].'"><td align="center"><input type="checkbox" name="delid[]" value="'.$vo['id'].'" /></td><td align="center">'.$vo['uname'].'</td><td align="center">'.$vo['name'].'</td><td align="center">'.$vo['regip'].'</td>';
                     $book.='<td align="center">'.date('Y/m/d H:m:s',$vo['ctime']).'</td><td align="center">'.$vo['lastip'].'</td>'; 
					 $book.='<td align="center">'.date('Y/m/d H:m:s',$vo['lasttime']).'</td><td>';
                     $book.=$vo['is_active']?'<div class="lock">冻结</div>':'<div class="unlock">激活</div>';
					 
                     $book.='<a href="'.url('adminmember/edit',array('id'=>$vo['id'])).'" class="edt">编辑</a><div class="del">删除</div><a href="'.url('adminmember/sendemail',array('id'=>$vo['id'])).'" class="edt">发邮件</a><a href="'.url('adminmember/sendmsg',array('id'=>$vo['id'])).'" class="edt">发私信</a></td></tr>';
                    } 
                   echo $book;
               }               
            ?>   
            <tr>
             <td align="center"><input type="submit" class="btn btn-small"  value="删除"></td>
             <td colspan="8"><div class="pagelist">{$page}</div></td>
          </tr>
          </form>  
        </table>
  </div>
</body>
</html>