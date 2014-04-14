            <div class="manage-panel clearfix">
                <div class="set-title">修改登录密码</div>
                <div class="pwd-modify-box">
                <form method="post" action="" id="modifypass">
                    <table class="reg-table">
                      
                        <tbody><tr>
                            <th><label for="reg-pwd1">当前密码:</label></th>
                            <td>
                                <input id="reg-pwd1" class="reg-input-wrap" type="password"  name="oldpassword" maxlength="20">
                                <a class="g9" href="/account/lostpassword" title="">忘记密码？</a>

                                <div class="error"></div>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="reg-pwd2">新密码:</label></th>
                            <td>
                                <input id="reg-pwd2"  class="reg-input-wrap" type="password" name="password" maxlength="20">

                                <div class="error"></div>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="reg-pwd3">再输入一次:</label></th>
                            <td>
                                <input  id="reg-pwd3" class="reg-input-wrap" type="password" name="surepassword" maxlength="20">

                                <div class="error"></div>
                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
								<a class="p-btn dj-btn-info dj-btn-xl" href="javascript:modifypass.submit()">确定修改</a>
                            </td>
                        </tr>
                    </tbody></table>
                    </form>
                </div>
            </div>
