<?php
class member_loginModel extends baseModel{
	protected $table = 'member_login';
	
	//根据用户的weibo_key连表查询用户信息
	public function member_weibo($weibo_key)
	{
		$sql="SELECT m.id,m.uname,m.is_active FROM {$this->prefix}member as m,{$this->prefix}member_login as l WHERE m.id=l.mid AND l.weibo_key='{$weibo_key}'";
		$user= $this->model->query($sql);
		return $user[0];//$user是二维数组，应该返回一维数组显示会员信息
	}
	
}
?>