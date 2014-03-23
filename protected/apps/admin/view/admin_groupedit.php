<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/common.js"></script>
<script language="javascript">
  $(function ($) { 
	//多选框
	$('.group_con input:checkbox').click(function(){
	    var id='#'+$(this).attr('class');
		var tclass='.'+$(this).attr('class');
		var judge=false;
		$(tclass).each( function(n){
           if($(this).attr('checked'))
		      judge=true;
        });
		if(judge)  $(id).attr('checked',true);
		else $(id).attr('checked',false);
	});
	$('#selectAll').click(function(){   
       $("[name='power[]']").attr("checked",'true');//全选 ,name为input标签name属性值
    });

    $('#selectNone').click(function(){   
       $("[name='power[]']").removeAttr("checked");//取消全选   
    });	
  });
</script>
<title>权限编辑</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【权限编辑】</div>
           <div class="list_head_mr">

           </div>
        </div>


         <table width="100%" border="0" cellpadding="0" cellspacing="1"   >
          <form action="{url('admin/groupedit',array('id'=>$id))}"  method="post">
          <tr>
            <td align="right" width="100">权限组名：</td>
            <td align="left"><input type="text" value="{$info['name']}" name="gname" id="gname"><span class="inputhelp">&nbsp;&nbsp;&nbsp;&nbsp;请在下方勾选该管理权限组的管理员可以操作的功能</span></td>
          </tr> 
          
          <tr>
            <td align="right">管理权限：</td>
            <td align="left" >
            <?php          
             if(!empty($powerlist)){
                $powers='<fieldset class="pgroup"><legend class="group_tit"><font color=green>拓展应用</font></legend>';
                foreach($powerlist as $vo){
                    if(empty($vo['name'])) $vo['name']=$vo['operate'];
                    $check=(in_array($vo['id'],explode(',',$info['power'])))?'checked="checked"':'';
                    if($vo['pid']==0&&$vo['rootid']!=0)
                       $powers.='</fieldset><fieldset class="pgroup"><legend class="group_tit"><input name="power[]" id="check'.$vo['id'].'" style="display:none"  type="checkbox" '.$check.' value="'.$vo['id'].'" />'.$vo['name'].'</legend>';
                    else 
                       $powers.='<div class="group_con"><input name="power[]" class="check'.$vo['pid'].'" type="checkbox" '.$check.' value="'.$vo['id'].'" />'.$vo['name'].'</div>';
                    }
                echo $powers;
             }
           ?>
            </td>
          </tr> 
          
          <tr>
            <td>&nbsp;</td>
            <td align="left" >
              <input type="button" value="全选" class="btn btn-primary btn-small" id="selectAll" >
              <input type="button" value="清空" class="btn btn-primary btn-small" id="selectNone" >
              <input type="reset" value="重置" class="btn btn-primary btn-small">
              <input type="submit" value="编辑" class="btn btn-primary btn-small"> 
            </td>
          </tr> 
          </form>         
        </table>
</div>
</body>
</html>