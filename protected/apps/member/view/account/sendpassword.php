<?php if(!defined('APP_NAME')) exit;?>
 {include file="account/header"}
<div id="content" class="wrapper">
  <div class="topCont"></div>
  <div class="centerCont">
    <h2 class="reg_join">
      <h3 class="pwd_reback">重设密码</h3>
     </h2>
    <div class="pwd_send">
        <img alt="" src="__PUBLICAPP__/images/pwd_send_again.jpg">
        <dl>
        <dt>
        我们已向您的登录邮箱：
        <b>{$member_email} </b>
        ，发送密码重置邮件 请登录邮箱点击重置链接重置密码。
        </dt>
        <dd>
       
       <a href="{$login_email}">进入邮箱查看</a>
        <br /><br />
        <p>没有收到重置密码邮件？你可以：</p>
<p>到邮箱中的垃圾邮件、广告邮件目录中找找</p><br />
<p><a href="{url('member/account/lostpassword')}">再次尝试重设密码</a></p>

<p>与我们的客服联系，电话：{$tel}</p>
        </dd>
        </dl>
   </div>
   </div>
   
 {include file="account/footer"}