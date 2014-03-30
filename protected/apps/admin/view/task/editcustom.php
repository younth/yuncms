<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>

 <script type="text/javascript" src="__PUBLIC__/lhgcalendar/lhgcore.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/lhgcalendar/lhgcalendar.min.js"></script>
 <script type="text/javascript">
            J(function() {
                J('#starttime').calendar({format:'yyyy-MM-dd HH:mm:ss'});
                J('#endtime').calendar({format:'yyyy-MM-dd HH:mm:ss'});
            });
        </script>
<title>{$h_name}</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
		<div class="list_head_ml">当前位置：【{$h_name}】</div>
		<div class="list_head_mr"></div>
		</div>
		<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="1" class="all_cont">
			<form action="" method="post" id="info" name="info">
            <tr>
               <td align="right" width="10%">任务名称:</td>
               <td align="left"><input type="text" name="name" value="{$result['name']}"></td>
            </tr>
            <tr>
            <td align="right"  width="10%">企业:</td>
            <td>  
                <select name="com" id="com">
 <?php   foreach ($comlist as $_v) {?>
                    <option value="<?php echo $_v['id'] ?>" <?php if($_v['id']==$result['cid']){ ?>selected="selected" <?php }?>><?php echo $_v['name'] ?></option>	
<?php	  }?>
                </select>
            </td>
            </tr>
            <tr>
            <td align="right"  width="10%">任务内容:</td>
               <td  align="left">
               <textarea name="content" rows="3" cols="70">{$result['content']}</textarea>
               </td>
            </tr>
            <tr>
            <tr>
               <td align="right" width="10%">需耗91币值:</td>
               <td align="left"><input type="text" name="gold" value="{$result['gold']}"></td>
            </tr>
            <tr>
               <td align="right" width="10%">任务学分值:</td>
               <td align="left"><input type="text" name="score"  value="{$result['score']}"></td>
            </tr>
            <tr>
               <td align="right" width="10%">开始时间:</td>
               <td align="left"><input type="text" name="starttime" size="20"  value="<?php if(!empty($result['starttime'])){ echo date('Y-m-d H:i:s',$result['starttime']); }?>"  id="starttime" readonly /></td>
            </tr>
            <tr>
               <td align="right" width="10%">结束时间:</td>
               <td align="left"><input type="text" name="endtime" size="20" value="<?php if(!empty($result['endtime'])){ echo date('Y-m-d H:i:s',$result['endtime']); }?>"  id="endtime" readonly /></td>
            </tr>
			<tr>
			<td></td>
                                <td align="left" colspan="2"><input type="submit" value="<?php if(ACTION_NAME=='edit'){ ?>更新<?php }else{ ?> 创建<?php }?>" class="btn btn-primary btn-small"></td>
			</tr>
			</form>
		</table>
</div>
</body>

</html>