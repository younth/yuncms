<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/highslide.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/common.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/highslide-with-html.min.js"></script>
<script language="javascript">
//封面图效果
hs.graphicsDir = "__PUBLIC__/images/graphics/";
hs.outlineType = 'rounded-white';
hs.showCredits = false;
hs.wrapperClassName = 'draggable-header';
hs.objectType = 'ajax';
hs.headingText = '备份详细';

  $(function ($) { 
	//数据表显隐
	$('#all_back').click(function(){$('#dbtable').hide()});
	$('#s_back').click(function(){$('#dbtable').show()});
  });
</script>
<title>数据库备份</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【数据库备份】</div>
           <div class="list_head_mr">

           </div>
        </div>
         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
          <form action="{url('dbback/index')}"  method="post">
          <tr>
            <td width="20%" align="right">备份类型:</td>
            <td width="50%" align="left"><input id="all_back" name="backtype" type="radio" value="1" checked="checked" />全部备份&nbsp; <input id="s_back" name="backtype" type="radio" value="0"/>自定义备份</td>
            <td width="30%" align="left" class="inputhelp">备份数据库中所有表</td>
          </tr> 
          
          <tr id="dbtable" style="display:none">
            <td width="20%" align="right">数据库中的表：</td>
            <td width="50%">
              <?php 
                foreach($table as $vo){  
                     $tlist.= '<span><input name="table[]" type="checkbox" value="'.$vo.'"/> '.$vo.'</span><br>';
                    }
                echo $tlist;
            ?>
            </td>
            <td width="30%" class="inputhelp">请勾选您需要备份的表</td>
          </tr>
          
          <tr>
            <td width="20%" align="right">分卷大小:</td>
            <td width="50%"><input name="size" type="text" value="2048">kb</td>
            <td width="30%" class="inputhelp">分卷大小</td>
          </tr>
          
          <tr>
           <td width="20%">&nbsp;</td>
            <td align="left" colspan="2">
              <input type="submit" value="备份" class="btn btn-primary btn-small">
            </td>       
          </tr> 
          </form>         
        </table>


         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
          <tr>
            <th>备份</th>
            <th width="110">管理选项</th>
          </tr>

           <?php         
             if(!empty($files)){
                foreach($files as $vo){  
                     $flist.= '<tr><td align="center"><a href="'.url('dbback/detail',array('f'=>$vo)).'" onclick="return hs.htmlExpand(this)" title="点击查看详细">'.date('Y-m-d H:i:s',$vo).'</a><div class="highslide"></div></td>';
                     $flist.= '<td><a href="'.url('dbback/recover',array('f'=>$vo)).'" class="edt" onClick="return confirm(\'还原后当前所有数据将被覆盖~确定要还原？\')">还原</a><a href="'.url('dbback/del',array('f'=>$vo)).'" class="del" onClick="return confirm(\'删除不可以恢复~确定要删除吗？\')">删除</a></td></tr>';
                    }
                echo $flist;
             }
           ?>
           
        </table>
</div>
</body>
</html>