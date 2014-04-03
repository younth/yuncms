<?php
class member_loginModel extends baseModel{
	protected $table = 'member_login';
	
	//根据用户的weibo_key连表查询用户信息
	public function member_weibo($weibo_key)
	{
		//$sql="SELECT {$this->prefix}member.id,{$this->prefix}member.uname,{$this->prefix}member.regip,{$this->prefix}member.lastip,{$this->prefix}member.ctime,{$this->prefix}member.lasttime,{$this->prefix}member.is_active FROM {$this->prefix}member left outer join {$this->prefix}member_group on {$this->prefix}member.groupid={$this->prefix}member_group.id  {$where} ORDER BY {$this->prefix}member.groupid,{$this->prefix}member.id LIMIT {$limit}";
		$sql="SELECT m.id,m.uname,m.is_active FROM {$this->prefix}member as m,{$this->prefix}member_login as l WHERE m.id=l.mid AND l.weibo_key='{$weibo_key}'";
		$user= $this->model->query($sql);
		return $user[0];//$user是二维数组，应该返回一维数组显示会员信息
	}
	
}
?>