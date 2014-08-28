后台方法的管理
===================

Yuncms后台所有的操作方法保存在数据库里面method表里面，下面对这个表进行分析：

 - pid=0表示父级栏目  pid=其他  是对应的子栏目
 - rootid=0是应用管理  
 - operate是指方法 方法是由pid及id的operate共同形成
 - Pid=0 rootid!=0 则rootid=id  Pid!=0 则rootid=pid
 - iframe=1 代表在菜单中显示

> example:
> id=1 对应的是后台登陆管理，且rootid=1  pid=0  operate=admin
所有pid=1都是其子分类：管理员管理、管理员删除......以账号管理为例：
rootid=1 pid=1 operate=adminnow 则账号管理就是后台登陆管理的子方法，对应的动作时
admin/adminnow


注意true  与  ‘true’ 这里有个坑，ture不是字符串！！