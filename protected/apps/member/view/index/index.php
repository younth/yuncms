 {include file="header"}
 <p>this is your  home page!</p>
 <br />
 人脉邀请：
<a href="{url('profile/user',array('id'=>$send['id']))}"><img src="{$send['avatar']}" /></a>{$send['school']}的{$send['uname']}发来人脉邀请 &nbsp;&nbsp;<a href="">同意</a>
 {include file="footer"}