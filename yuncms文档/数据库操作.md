Yuncms数据库操作
===================
###常用的数据库操作方法集合

> Note:yuncms规定，数据库操作属于model层，数据库操作的基类是：<kbd>protected/base/model/model.php</kbd>
> 该类也是模型最底层的类，其他数据库操作是在每个单独模块下面基于基类的方法进行具体的操作。


1.执行sql语句
```
query($sql)
```
2.找到符合当前添加的记录，返回数组形式，只查找一条记录
```
find($condition = '', $field = '', $order = '')
```
3.选择查询
```
select($condition = '', $field = '', $order = '', $limit = '')
```	
4.统计总数
```
count($condition = '')
```
5.插入数据,返回上一次插入的id
```
insert($data = array() )
```
6.更新数据
```
update($condition, $data = array() )
```
7.删除数据
```
delete($condition)
```
8.返回sql语句
```
getSql()
```
9.数据过滤
```
escape($value)

```

###组合的数据库操作（联合查询）
1.两个表联合查询，自定义sql语句然后执行
```
//group admin连表查询，获得管理员信息
$sql="SELECTA.id,A.groupid,A.username,A.lastlogin_time,A.lastlogin_ip,A.iflock,B.name FROM {$this->prefix}admin A,{$this->prefix}group B WHERE A.groupid=B.id ORDER BY A.groupid,A.id LIMIT {$limit}";
return $this->model->query($sql);
/*
	1.注意对表进行别名处理，省略了as
	2.sql用双引号包住，里面涉及变量使用{}创造变量环境
*/

```
2.三个表联合查询
```
/*
有三个表
a表字段 :uid name img
b表字段:uid pid cid ageyear
c表字段:pid cid cname
a表b表的uid值相同 b表c表的pid cid值相同
目的需要查询出 name img ageyear pid.cname cid.cname 
原理：用left jion ，把b，c两个表连接到a表上
*/

select a.name as name,b.img as img,b.ageyear as ageyear,b.pid as pid,c.cname as cname 
from a left jion (b, c) on (a.uid=b.uid AND b.pid=c.pid AND b.cid=c.cid)

//Note:别名处理查询字段as
```
example:根据<kbd>$id</kbd>查询指定用户信息
```
$sql="SELECT 
m.id,l.user_group_id,m.uname,m.password,m.ctime,m.lasttime,m.is_active,m.login_email FROM {$this->prefix}member as m left outer join ({$this->prefix}member_group as g,{$this->prefix}member_group_link as l) on (l.uid=m.id AND l.user_group_id=g.id)  WHERE  m.id={$id} ";

```

###其他常用的数据库查询
 - 查询某个表的全部字段<kbd>sheet*</kbd>
```
$sql="SELECT m.id,m.uname,m.login_email,p.* FROM {$this->prefix}member as m,{$this->prefix}member_profile as p WHERE m.id=p.mid AND m.id='{$id}'";
$user= $this->model->query($sql);
return $user[0];
/*
	1.注意select查询的是二维数组，返回会员信息应该是一维数组
*/
```

 -  order by  limit 永远放在最后
```
$sql="SELECT m.id,m.uname,m.login_email,p.school,p.major,h.ctime,h.fid FROM {$this->prefix}member as m left outer join ({$this->prefix}visit_history as h,{$this->prefix}member_profile as p) on (m.id=h.fid AND h.fid=p.mid) where h.bid='{$bid}'  ORDER BY h.ctime LIMIT 6";
return $this->model->query($sql);
```
 - 麻烦的模糊查询，语句长的话注意拆分单独构造where
 - example:查询符合条件的会员数(条件：starttime endtime keyword)
```
		if(empty($starttime)||empty($endtime)) $where=(empty($keyword)?'':'where m.uname like "%'.$keyword.'%"');
else $where='where m.ctime<='.$endtime.' AND m.ctime>='.$starttime.' AND m.uname like "%'.$keyword.'%"';
$sql="SELECT m.id,l.user_group_id,m.uname,m.login_email,m.lastip,m.ctime,m.lasttime,m.is_active,g.group_name FROM {$this->prefix}member as m left outer join ({$this->prefix}member_group as g,{$this->prefix}member_group_link as l) on (l.uid=m.id AND l.user_group_id=g.id)  {$where} ORDER BY m.id LIMIT {$limit}";
return $this->model->query($sql);
```