<?php if(!defined('APP_NAME')) exit;?>
 {include file="account/header"}
 <link href="__PUBLIC__/company/css/corp_reg.css" rel="stylesheet" type="text/css">

 <div class="dj-content-wrap ">
 <div class="dj-content-inner">
            <div class="dj-content-shadow">
<!-- content begin -->
<div class="p-wrap">
    <div class="i-title">
        <h2><i></i>{$weibo_name}，欢迎您！已有91频道帐号，直接登录绑定微博！</h2>
    </div>
    <div class="employment-content0">
        <div class="bd">
            <div class="form-main">
                <form class="p-form" action="" method="post" id="loginbind">
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
							<tr class="last-tr">
                                <th>&nbsp;</th>
                                <td class="input" style="padding:5px 0 0 0">
                                    <a class="p-btn dj-btn-info dj-btn-xl" href="javascript:loginbind.submit()">登录并绑定</a>
                                </td>
                            </tr>                         
                               </tbody>
                        </table>
                    </fieldset>
               </form>
            </div>
        </div>
    </div>
    
     <div class="i-title">
        <h2><i></i>第一次来91频道</h2>
    </div>
    
    <table class="dj-form-smart c-info-form">
    							<tr class="last-tr">
                                <td><img src="{$photo}" /></td>
                                <td class="input">
                                    <a class="p-btn dj-btn-info dj-btn-xl" href="{url('member/account/openreg')}">直接进入</a>
                                </td>
                            </tr>                         
    </table>
</div>
<!-- content end -->
            </div>
    </div>
 </div>
 <br />
 {include file="footer"}
