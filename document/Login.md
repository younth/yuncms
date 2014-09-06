Yuncms处理登陆的两种方式
=========
###1.session
普通的方式，登陆的信息存入session。yuncms后台采用此方式。

加强的地方：将session存入本地文件。

后台的权限判断采用的是auth方式：
```
$groupid=$_SESSION[Auth::$config['AUTH_SESSION_PREFIX'].'groupid'];
```
后台管理员的groupid存放在auth里面。
groupid=-1是最高管理员。
后台session存入的信息：
```
Array
(
    [verify] => 6356
    [auth_groupid] => 1
    [auth_power] => -1
    [yunapppower] => -1
    [admin_uid] => 1
    [admin_username] => admin
    [admin_realname] => 王洋
)
```



###2.auth方式
前台采用的登陆方式。会员的登陆。安全性较高。