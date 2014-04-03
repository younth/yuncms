    <fieldset id="login1" class="pop-reg">
      <h3>加入91频道，建立人脉</h3>
      <form  action="{url('member/account/regist')}" class="simple_form new_account" id="tianji-pop-reg-form" method="post" >
        <ul>
          <li>
            <input class="txt"  name="uname"  size="30" type="text" placeholder="真实姓名" />
          </li>
          <li>
            <input class="txt" data-register="true"  name="login_email"  size="30" type="text" placeholder="邮箱" />
          </li>
          <li>
            <input class="txt" maxlength="16" name="password"  size="16" type="password" placeholder="密码" />
          </li>
          <li>
            <input class="btn tianji-submit-btn" id="tianji-popup-reg-btn"  type="submit" value="立即注册" />
          </li>
        </ul>
</form>      
		<span class="xinlang_share">
        企业免费注册，<a href="{url('company/account/welcome')}">点击这里</a>
      </span>
      <span class="next_panel next">已有91频道账号？<a href="{url('default/index/login')}" >立即登录</a></span>
    </fieldset>
