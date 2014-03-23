<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/common.js"></script>
<title>管理员管理</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【管理员列表】</div>
           <div class="list_head_mr">
             <a href="{url('admin/adminadd')}" class="add">新增</a></div>
</div>

         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
          <tr>
              <th>管理员</th>
              <th>最后登录IP</th>
              <th>最后登录时间</th>
              <th>权限级别</th>
              <th width="150">管理选项</th>
          </tr>
          <?php 
                 if(!empty($list)){
                      foreach($list as $vo){
                          $vo['lastlogin_ip'] = $vo['lastlogin_ip']?$vo['lastlogin_ip']:'该用户没有登陆过';
                          $vo['lastlogin_time'] = $vo['lastlogin_time']?date('Y-m-d h:m:s',$vo['lastlogin_time']):'该用户没有登陆过';
                          $cont.= '<tr><td align="center">'.$vo['username'].'</td>';
                          $cont.= '<td align="center">'.$vo['lastlogin_ip'].'</td>';
                          $cont.= '<td align="center">'.$vo['lastlogin_time'].'</td>';
                          $cont.= '<td align="center">'.$vo['name'].'</td>';
                          $cont.= '<td align="center"><a href="'.url('admin/adminedit',array('id'=>$vo['id'])).'" class="edt">修改</a><a href="'.url('admin/admindel',array('id'=>$vo['id'])).'" class="del" onClick="return confirm(\'删除不可以恢复~确定要删除吗？\')">删除</a>';
                          $cont.=$vo['iflock']?'<a class="unlock" href="'.url('admin/adminlock',array('id'=>$vo['id'],'l'=>0)).'">解锁</a>':'<a class="lock" href="'.url('admin/adminlock',array('id'=>$vo['id'],'l'=>1)).'">锁定</a>';
                          $cont.='</td></tr>';
                       }
                        echo $cont;
                     }
          ?>          
          <tr>
             <td colspan="5"><div class="pagelist">{$page}</div></td>
          </tr>
        </table>
</div>
</body>
</html>
