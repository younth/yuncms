<?php
/*
 * admin表的模型方法
 * */
class adminModel extends baseModel{
	//baseModel  extends  model  model  $table是model里面的属性
	protected $table = 'admin';
	
	//登录验证方法,返回结果是true false
	public function login($username,$password)
	{
		$condition=array();//condition空数组，查询的条件采用数组的形式
		
		$condition['username']=$username;
		$condition['password']=$password;
		$field='id,groupid,username,realname,password,iflock';//字段
		//find 查询，格式是数组键值对形式
		$user_info=$this->find($condition,$field);//查找符合条件的记录
		//print_r($user_info);return;
		//用户名密码正确且没有锁定
		if(($user_info['password']==$password)&&($user_info['iflock']==0))
		{
			//更新帐号信息
			$data=array();//data空数组
			$data['lastlogin_time']=time();
			$data['lastlogin_ip']=get_client_ip();//获取客户端IP地址
			$this->update($condition,$data);

			//Auth权限认证类,cp框架类里面的调用
			Auth::set($user_info['groupid']);//$user_info['groupid']是group里面的id,设置认证用户组id
			Auth::getGroupPower($user_info['groupid']);//获取用户组权限信息
			//设置登录信息
			//用户的信息存入session
			$_SESSION['admin_uid']=$user_info['id'];
			$_SESSION['admin_username']=$user_info['username'];
			$_SESSION['admin_realname']=$user_info['realname'];
			return true;
		}
		return false;
	}
	
	//group admin连表查询，获得管理员信息
	public function adminANDgroup($limit=''){
		//组合查询，自定义sql语句
		$sql="SELECT A.id,A.groupid,A.username,A.lastlogin_time,A.lastlogin_ip,A.iflock,B.name FROM {$this->prefix}admin A,{$this->prefix}group B WHERE A.groupid=B.id ORDER BY A.groupid,A.id LIMIT {$limit}";
		return $this->model->query($sql);
	}
	
}
?>