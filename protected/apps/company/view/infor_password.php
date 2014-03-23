<?php if(!defined('APP_NAME')) exit;?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/base.css" />
<link rel="stylesheet" type="text/css" href="__PUBLICAPP__/css/style.css" />
<div id="contain">
  <div class="admin_title">
   <h2>修改密码</h2>
   </div>
  <form method="post" action="">
     <div class="form_box">
        <table>
            <tr>
              <th>旧密码：</th>
              <td><input class="input w200" type="password" name="oldpassword" value=""/></td>
            </tr>
            <tr>
              <th>新密码：</th>
              <td><input class="input w200" type="password" name="password" value=""/></td>
            </tr>
            <tr>
              <th>密码确认：</th>
              <td><input class="input w200" type="password" name="surepassword" value=""/></td>
            </tr>
        </table>
      </div>
      <div class="btn tac">
        <input type="hidden" name="id" value="{$info['id']}"><input type="submit" name="dosubmit" value="修改" class="button">
      </div>
  </form>
</div>