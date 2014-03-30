<?php if(!defined('APP_NAME')) exit;?>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">你当前的位置：【导入应用】</div>
           <div class="list_head_mr">
           </div>
        </div>

         <table width="100%" border="0" cellpadding="0" cellspacing="1" class="all_cont">
           <form enctype="multipart/form-data" method="post" action="{url('index/import')}">
            <tr>
              <td align="right">应用安装包：</td>
              <td><input type="file" name="file" id="file" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td align="left">
                 <input value="yes" type="hidden" name="do" />
                 <input type="submit" value="确 定" class="btn btn-primary btn-small">
              </td>
            </tr>     
           </form>
        </table>
   </div>