<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/common.js"></script>
<title>{$h_name}</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【{$h_name}】</div>
           <div class="list_head_mr">
             <a href="{url('task/add')}" class="add">新增</a></div>
</div>

    <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont" style="text-align: center">
         <tr>
            <td colspan="9" align="left">
               <form action="{url('task/index')}" method="GET" >
               <!-----为什么提交之后的之后是转到首页呢------->
                <input name="yun" type="hidden" value="{$_GET['yun']}" /><!--get[yun]就是当前的页面方法，不可少，保证页面不跳转-->
                 <div style="float:left; margin-left:10px;"> 
                  	关键字： <input type="text" name="name" size="20" placeholder="输入任务名称或者作者"> 
                 </div>
                 
                  <div style="float:left"><input class="btn btn-success  btn-small" type="submit" value="搜索"></div>
               </form> 
          </tr>
        <form action="{url('task/del')}" method="post" id="dos"  onSubmit="return confirm('执行后不可以恢复~确定要执行吗？');">
          <tr>
              <th width="119"><input style="color:#E2E2E2" type="checkbox" name="chkAll" value="checkbox" onClick="CheckAll(this.form)"/></th>
              <th width="349">任务目标</th>
              <th width="238">任务名称</th>
              <th width="76">需耗91币</th>
              <th width="74">获得91币</th>
              <th width="85">获得学分值</th>
              <th width="139">添加时间</th>
              <th width="119">发布者</th>
              <th width="132">管理选项</th>
          </tr>
          
          <?php 
                 if(!empty($result)){
                      foreach($result as  $_v){
                          ?><tr>
                              <td><?php echo $i?><input type="checkbox" name="delid[]" value="{$_v['id']}" /></td>
                              <td><?php echo $_v['goal']?></td>
                              <td><?php echo $_v['name']?></td>
                              <td><?php echo $_v['consume_gold']?></td>
                              <td><?php echo $_v['obtain_gold']?></td>
                              <td><?php echo $_v['score']?></td>
                              <td><?php echo date('Y-m-d H:i:s',$_v['ctime'])?></td>
                              <td><?php echo $_v['author']?></td>
                              <td><a href="{url('task/edit',array('tid'=>$_v['id']))}">编辑</a>
                                  <a href="javascript:void(0)" id="del_<?php echo $_v['id'] ?>" onclick="del('<?php echo url('task/del') ?>','<?php echo $_v['id']?>')">删除</a>
                                  
                              </td>
                          </tr>
                             
                             <?php 
                       }
                     }
          ?>          
          <tr>
              <td colspan="2">
                 <div class="listdo">
                     <select name="dotype" id="dotype">
                        <option value="del">删除信息</option>
                     </select>
                 </div>
                 <div class="listdo" id="col"><select  name="col"><option value="">=选择栏目=</option>{$option}</select></div>
                 <div class="listdo"><input type="submit" class="btn btn-small"  value="执行"></div>
             </td><td colspan="5"><div class="pagelist">{$page}</div></td>
             <td></td><td></td>
          </tr>
        </form>
        </table>
</div>
</body>
</html>
