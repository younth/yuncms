<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>头像</title>
</head>
<body>
<h1>修改登录密码</h1>
  <form method="post" action="">
        <table  class="table table-bordered">
            <tr>
              <td width="100" align="right">当前密码：</td>
              <td><input type="password" name="oldpassword" value=""/></td>
            </tr>
            <tr>
              <td width="100" align="right">新密码：</td>
              <td><input type="password" name="password" value=""/></td>
            </tr>
            <tr>
              <td width="100" align="right">再输入一次：</td>
              <td><input type="password" name="surepassword" value=""/></td>
            </tr>
            <tr>
              <td></td>
              <td align="left"><input type="submit" name="dosubmit" value="修改" class="btn"></td>
            </tr>
        </table>
  </form>

</body>
</html>