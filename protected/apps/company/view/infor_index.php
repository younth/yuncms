<?php if(!defined('APP_NAME')) exit;?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/base.css" />
<link rel="stylesheet" type="text/css" href="__PUBLICAPP__/css/style.css" />
<div id="contain">
  <div class="admin_title">
   <h2>资料完善</h2>
   </div>
  <form method="post" action="">
     <div class="form_box">
        <table>
            <tr>
              <th>姓名：</th>
              <td><input class="input w200" type="text" name="uname" value="{$info['uname']}"/></td>
            </tr>
            <tr>
              <th>Email：</th>
              <td><input class="input w200" type="text" name="email" value="{$info['email']}"/></td>
            </tr>
            <tr>
              <th>手机：</th>
              <td><input class="input w200" type="text" name="tel" value="{$info['tel']}"/></td>
            </tr>
            <tr>
              <th>学校：</th>
              <td><input class="input w200" type="text" name="school" value="{$info['school']}"/></td>
            </tr>
            <tr>
              <th>学号：</th>
              <td><input class="input w200" type="text" name="number" value="{$info['number']}"/></td>
            </tr>
            <tr>
              <th>航班号：</th>
              <td><input class="input w200" type="text" name="flt_no" value="{$info['flt_no']}"/></td>
            </tr>
            <tr>
              <th>航班到达时间：</th>
              <td><input class="input w200" type="text" name="flt_time" value="{$info['flt_time']}"/></td>
            </tr>
            
        </table>
      </div>
   <div class="btn tac">
   <input type="hidden" name="id" value="{$info['id']}">
   <input type="submit" name="dosubmit" value="修改" class="button">
   </div>
  </form>
</div>
