    <fieldset id="login2" class="pop-login">
      <h3>登录91频道</h3>
      <form accept-charset="UTF-8" action="{url('member/account/login')}" class="simple_form new_account" id="tianji-pop-login-form" method="post" >
        <input id="login_from" name="login_from" type="hidden" value="homepage_login" />        <ul>
          <li>
            <input class="txt" id="tianji-login-email_or_mobile" name="login_email" size="30"  type="text" placeholder="输入登录邮箱" />
          </li>
          <li>
            <input class="txt" id="account_password" maxlength="16" name="password" size="16"  type="password" placeholder="输入登录密码"/>
          </li>
          <li>
            <input class="btn tianji-submit-btn" id="tianji-popup-login-btn" type="submit" value="登录" />
          </li>
          <li class="height_none">
            <label class="checked">保持登录状态</label> 
            <a href="{url('member/account/lostpassword')}" class="get-back-password">找回密码</a>
          </li>
        </ul>
</form>      <span class="xinlang_share border_top">
        <img alt="sina" src="__PUBLIC__/images/sina.png" />
        <a href="{$weibo_login}">用新浪微博账号登录</a>
      </span>
      <span class="next_panel previous">没有91频道账号？<a href="{url('default/index/index')}" >立即注册</a></span>
    </fieldset>
