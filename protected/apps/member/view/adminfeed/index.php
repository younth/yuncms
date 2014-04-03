<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLIC__/admin/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/common.js"></script>
<script>
$(function ($) { 
	//ajax操作
	 $('.del').click(function(){
			if(confirm('删除将不可恢复~')){
			var delobj=$(this).parent().parent();
			var id=delobj.attr('id');
			$.get("{url('adminfeed/del')}", {id:id},
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
           <div class="list_head_ml">当前位置：【心情列表】</div>                      
    </div> 
         <form action="{url('adminfeed/del')}" method="post" onSubmit="return confirm('删除不可以恢复~确定要删除吗？');"> 
         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
          <tr>
            <th width="70"><input type="checkbox" name="chkAll" value="checkbox" onClick="CheckAll(this.form)"/></th>
            <th>类型</th>
            <th>会员ID</th>
            <th>评论数</th>
            <th>转发数</th>
            <th>发表时间</th>
            <th>是否转发</th>
            <th>是否审核</th>
            <th>操作</th>
          </tr>
          <?php 
                if(!empty($list)){
                     foreach($list as $vo){
                         $cont.= '<tr id="'.$vo['id'].'"><td align="center"><input type="checkbox" name="delid[]" value="'.$vo['id'].'" /></td>';
                         $cont.='<td align="center">'.$vo['type'].'</td>';
                         $cont.= '<td align="center">'.$vo['mid'].'</td>';
                         $cont.= '<td align="center">'.$vo['comment_count'].'</td>';
                         $cont.= '<td align="center">'.$vo['repost_count'].'</td>';
                         $cont.= '<td align="center">'.date("Y-m-d H:i:s",$vo['ctime']).'</td><td align="center">';
                         $cont.=$vo['is_repost']? '是':'否';
                         $cont.= '</td><td align="center">';
                         $cont.=$vo['is_audit']? '是':'否';
                         $cont.='</td><td align="center"><div class="del">删除</div></td></tr>';
                      }
                    echo $cont;
                }
          ?>
          <tr>
             <td align="center"><input type="submit" class="btn btn-small"  value="删除"></td>
             <td colspan="8"><div class="pagelist">{$page}</div></td>
          </tr>
         </table>
       </form>
</div>
</body>
</html>