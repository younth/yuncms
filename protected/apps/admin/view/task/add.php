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
               <td class="inputhelp">填写任务的名称</td>
            </tr>
            <tr>
            <td align="right"  width="10%">任务目的:</td>
               <td  align="left">
                   <textarea  name="goal" rows="4" cols="70"> {$result['goal']}</textarea>
               </td>
               <td class="inputhelp">任务的目的</td>
            </tr>
            <tr>
            <td align="right"  width="10%">任务内容:</td>
               <td  align="left">
               <textarea name="content" rows="4" cols="70">{$result['content']}</textarea>
               </td>
               <td class="inputhelp">任务的内容</td>
            </tr>
            <tr>
            <td align="right"  width="10%">完成途径:</td>
               <td  align="left">
               <textarea name="way" rows="4" cols="70">{$result['way']}</textarea>
               </td>
               <td class="inputhelp">例如：和联系人合影、读后感，联系人对领取任务者的书面评价
               </td>
            </tr>
             <tr>
            <td align="right"  width="10%">认证方式:</td>
               <td  align="left">
               <textarea name="certification_way" rows="4" cols="70">{$result['certification_way']}</textarea>
               </td>
                <td class="inputhelp">例如：上传相关材料（或清晰的图片）</td>
            </tr>
            
            <tr>
            <td align="right"  width="10%">任务提示及帮助:</td>
               <td  align="left">
               <textarea name="reminder" rows="4" cols="70"> {$result['reminder']}</textarea>
               </td>
               <td class="inputhelp">完成该任务一些技巧</td>
            </tr>
            <tr>
               <td align="right" width="10%">需耗91币:</td>
               <td align="left"><input type="text" name="consume_gold" value="{$result['consume_gold']}"></td>
               <td class="inputhelp">学生领取任务需要消耗的91币</td>
            </tr>
              <tr>
               <td align="right" width="10%">完成任务获得91金币:</td>
               <td align="left"><input type="text" name="obtain_gold" value="{$result['obtain_gold']}"></td>
               <td class="inputhelp">学生完成任务能够获得的91币</td>
            </tr>
            
            <tr>
               <td align="right" width="10%">完成任务获得学分值:</td>
               <td align="left"><input type="text" name="score"  value="{$result['score']}"></td>
               <td class="inputhelp">学生完成任务能够获得的学分值</td>
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