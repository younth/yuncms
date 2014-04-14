<?php if(!defined('APP_NAME')) exit;?>
 {include file="account/header"}
<div id="content" class="wrapper">
  <div class="topCont"></div>
  <div class="centerCont">
    <h2 class="reg_join">
      <h3 class="pwd_reback">邮箱验证</h3>
     </h2>
    <div class="pwd_send">
        <img alt="" src="__PUBLICAPP__/images/pwd_send_again.jpg">
        <dl>
        <dt>
        我们已向您的登录邮箱：
        <b>{$member_email} </b>
        ，发送验证邮件 请登录邮箱点击激活链接即可完成注册。
        </dt>
        <dd>
       
       <a href="{$login_email}">进入邮箱查看</a>
        <br /><br />
        <p>没有收到重置密码邮件？你可以：</p>
<p>到邮箱中的垃圾邮件、广告邮件目录中找找</p><br />

<p>与我们的客服联系，电话：{$tel}</p>
        </dd>
        </dl>
   </div>
   </div>
   </div>
   <br />
 {include file="footer"}