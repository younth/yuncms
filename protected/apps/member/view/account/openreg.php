<?php if(!defined('APP_NAME')) exit;?>
 {include file="account/header"}
 <link href="__PUBLIC__/company/css/corp_reg.css" rel="stylesheet" type="text/css">

 <div class="dj-content-wrap ">
 <div class="dj-content-inner">
            <div class="dj-content-shadow">
<!-- content begin -->
<div class="p-wrap">
    <div class="i-title">
        <h2><i></i>{$weibo_name}，欢迎使用微博注册新账号</h2>
    </div>
    <div class="employment-content0">
        <div class="bd">
            <div class="form-main">
                <form class="p-form" action="{url('member/account/regist')}" method="post" id="open_reg">
                    <fieldset>
                        <table class="dj-form-smart c-info-form">
                            <tbody>
                            <tr><th><em>*</em>邮箱：</th>
                                <td class="input"><input type="text" name="login_email"></td>
                            </tr>
                            <tr><th><em>*</em>密码：</th>
                                <td class="input">
                                    <input type="password"  name="password">
                                </td>
                            </tr>
                            <tr><th><em>*</em>真实姓名：</th>
                                <td class="input">
                                  <input type="text" name="uname">
                                </td>
                            </tr>
							<tr class="last-tr">
                                <th>&nbsp;</th>
                                <td class="input" style="padding:10px 0 0 0">
                                    <a class="p-btn dj-btn-info dj-btn-xl" href="javascript:open_reg.submit()">立即开通</a>
                                </td>
                            </tr>                         
                               </tbody>
                        </table>
                    </fieldset>
               </form>
            </div>
        </div>
        <div class="ft"></div>
    </div>
</div>
<!-- content end -->
            </div>
    </div>
 </div>
 <br />
 {include file="footer"}