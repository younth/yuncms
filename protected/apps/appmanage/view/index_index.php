<?php if(!defined('APP_NAME')) exit;?>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">你当前的位置：【应用管理】</div>
           <div class="list_head_mr">
                <a href="{url('index/import')}" class="add">导入</a>
                <a href="{url('index/create')}" class="add">创建</a>
           </div>
        </div>
         <table width="100%" border="0" cellpadding="0" cellspacing="1"  class="all_cont">
          <tr>
             <th width="100">应用</th>
             <th>应用名称</th>
		     <th width="120">版本</th>
		     <th width="150">开发者</th>
             <th width="250">管理操作</th>
          </tr>         
          {loop $apps $app $config}<!-----同时循环三个数组--->
        <tr>         
          <td align="center">{$app}</td>
		  <td align="center">{$config['APP_NAME']}</td>
		  <td align="center">{$config['APP_VER']}</td>
		  <td align="center">{$config['APP_AUTHOR']}</td>
          <td>
            {if $config['APP_STATE'] == 1}
              <a href="{url('index/export', array('app'=>$app))}" target="_self">导出</a>
              | <a href="{url('index/uninstall', array('app'=>$app))}" onclick="return confirm('卸载将会删除所有数据表和文件,确定要卸载吗？')" target="_self"><font color="red">卸载</font></a>
              | <a href="{url('index/state', array('app'=>$app,'state'=>2))}" target="_self"><font color="red">停用</font></a> 
         
			{elseif $config['APP_STATE'] == 2}
              <a href="{url('index/export', array('app'=>$app))}" target="_self">导出</a>
              | <a href="{url('index/uninstall', array('app'=>$app))}" onclick="return confirm('卸载将会删除所有数据表和文件,确定要卸载吗？')" target="_self"><font color="red">卸载</font></a>
              | <a href="{url('index/state', array('app'=>$app,'state'=>1))}" target="_self"><font color="green">启用</font></a>            
			{else}
              <a href="{url('index/install', array('app'=>$app))}" target="_self"><font color="green">安装</font></a>  
			{/if}
        </td>
       </tr> 
       {/loop}     
        </table>
</div>