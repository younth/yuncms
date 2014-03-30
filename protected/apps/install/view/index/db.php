<?php if(!defined('APP_NAME')) exit;?>
<div class="install_right">
 <form action="{url('index/db')}" method="post" >
  <div class="install_box">
      <h2>请输入数据库相关信息。若您不清楚，请咨询主机提供商。</h2>
      <table class="form-table"> 
        <tbody>
		   <tr>
            <td><LABEL for=dbhost>数据库主机</LABEL></td>
            <td><input name="DB_HOST" type="text" value="localhost" class="install_input"></td>
            <td>通常情况下，应填写 <CODE>localhost</CODE></td>
          </tr>
          <tr>
            <td><LABEL for=uname>数据库用户名</LABEL></td>
            <td><input name="DB_USER" type="text" class="install_input" value="root"></td>
            <td>您的 MySQL 用户名</td>
          </tr>
          <tr>
            <td><LABEL for=pwd>数据库密码</LABEL></td>
            <td><input type="password"  name="DB_PWD" class="install_input"></td>
            <td>您的  MySQL 密码。</td>
          </tr>
          <tr>
            <td width="15%"><LABEL for=dbname>数据库名</LABEL></td>
            <td width="34%"><input name="DB_NAME" type="text" class="install_input"></td>
            <td width="51%"> 若不存在则尝试自动创建</td>
          </tr>
          <tr>
            <td><LABEL for=dbport>端口</LABEL></td>
            <td><input name="DB_PORT" type="text" value="3306" class="install_input"></td>
            <td>默认3306</td>
          </tr>
          <tr>
            <td><LABEL for=prefix>表名前缀</LABEL></td>
            <td><input name="DB_PREFIX" type="text" value="yun_" class="install_input"></td>
            <td>区分其他数据表，提高安全性，必填</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="install_btn">
      <input class="button" value="上一步" type="button" onClick="window.location.href = '{url('index/env')}'">
      <input class="button" value="开始安装" type="submit" >
    </div>
	</form>
  </div>