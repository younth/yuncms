<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/common.js"></script>
<title>单页列表</title>
</head>
<body>
<div class="contener">
    <div class="list_head_m">        
           <div class="list_head_ml">当前位置：【{$t_name}信息】</div>                      
    </div> 
         <form action="{url('feedback/del')}" method="post" onSubmit="return confirm('删除不可以恢复~确定要删除吗？');"> 
         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
          <tr>
            <th width="70"><input type="checkbox" name="chkAll" value="checkbox" onClick="CheckAll(this.form)"/></th>
            <th>状态</th>
            <th>邮箱</th>
            <th>留言时间</th>
            <th>操作</th>
          </tr>
          <?php 
                if(!empty($list)){
                     foreach($list as $vo){
						 $is_read=($vo['is_read']==0)?"<span class='red'>未读</span>":"已读";
                         $cont.= '<tr id="'.$vo['id'].'"><td align="center"><input type="checkbox" name="delid[]" value="'.$vo['id'].'" /></td>';
                         $cont.='<td align="center">'.$is_read.'</td>';
                         $cont.= '<td align="center">'.$vo['email'].'</td>';
                         $cont.= '<td align="center">'.date("Y-m-d H:i:s",$vo['ctime']).'</td>'; 
                         $cont.='<td align="center"><a href="'.url('feedback/read',array('id'=>$vo['id'])).'" class="edt">查看</a><div class="del">删除</div><a href="'.url('feedback/sendemail',array('email'=>$vo['email'],'id'=>$vo['id'])).'" class="edt">邮件回复</a></td></tr>';
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