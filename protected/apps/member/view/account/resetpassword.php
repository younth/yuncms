<?php if(!defined('APP_NAME')) exit;?>
 {include file="account/header"}

<link href="__PUBLIC__/company/css/corp_reg.css" rel="stylesheet" type="text/css">
 <div class="dj-content-wrap ">
 <div class="dj-content-inner">
            <div class="dj-content-shadow">
<!-- content begin -->
<div class="p-wrap">
    <div class="i-title">
        <h2><i></i>重设密码</h2>
    </div>
    <div class="employment-content0">
        <div class="bd">
            <div class="form-main">
                <form class="p-form" action="" method="post" id="resetpass">
                    <fieldset>
                        <table class="dj-form-smart c-info-form">
                            <tbody>
                            <tr><th><em>*</em>输入新密码：</th>
                                <td class="input"><input type="password" name="password" ></td>
                            </tr>
                            <tr><th><em>*</em>确认密码：</th>
                                <td class="input">
                                 <input type="password"  name="repassword">
                                </td>
                            </tr>
							<tr class="last-tr">
                                <th>&nbsp;</th>
                                <td class="input" style="padding:10px 0 0 0">
                                    <a class="p-btn dj-btn-info dj-btn-xl" href="javascript:resetpass.submit()">修改密码</a>
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
 {include file="footer"}
