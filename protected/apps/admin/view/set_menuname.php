<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<title>【后台模型】</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【后台功能地图】</div>
           <div class="list_head_mr"><a href="{url('set/menuadd')}" class="add">新增</a></div>
        </div>


         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
          <form action="{url('set/menuname')}"  method="post">
          <tr>
            <td align="left">
            <?php    
			//循环出所有的子父级方法      
             if(!empty($list)){
                $menus='<fieldset><legend></legend>';
                foreach($list as $vo){
                    if(empty($vo['name'])) $vo['name']=$vo['operate'];
                    $check=$vo['ifmenu']?'checked="checked"':'';
					$style=$vo['ifmenu']?'style="color:red"':'';//加色显示
					if($vo['rootid']!=0){
                       if($vo['pid']==0)
                          $menus.='</fieldset><fieldset class="pgroup"><legend class="group_tit" title="'.$vo['operate'].'"><input  name="menu[]" '.$check.' style="display:none" id="check'.$vo['id'].'" type="checkbox" value="'.$vo['id'].'" /><input class="gname" name="mname['.$vo['id'].']"  type="text" value="'.$vo['name'].'" /></legend>';
                       else 
                          $menus.='<div class="group_con" title="'.$vo['operate'].'"><input style="display:none" name="menu[]" '.$check.' class="check'.$vo['pid'].'" type="checkbox" value="'.$vo['id'].'" /><input class="cname" '.$style.' name="mname['.$vo['id'].']"  type="text" value="'.$vo['name'].'" /></div>';
                    }
				}
                echo $menus;
             }
           ?>
            </td>
          </tr>         
          <tr>
            <td align="center">
              
              <input  type="submit" value="设置" class="btn btn-primary btn-small">
            </td>
          </tr> 
          </form>      
        </table>
</div>
</body>
</html>