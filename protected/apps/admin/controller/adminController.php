<?php
/*
 * 后台管理员控制器
 * */
class adminController extends commonController
{
	//管理员列表
	public function index()
	{
	 	$grouplist=model('group')->select('','id,name','id');//用户组数组
		//print_r($grouplist);
	 	$listRows=10;//每页显示的信息条数
		$url=url('admin/index',array('page'=>'{page}'));//分页的url格式
	    $limit=$this->pageLimit($url,$listRows);//分页查询limit  0,10
		//echo $limit;
	 	$count=model('admin')->count();//管理员总数
	 	$list=model('admin')->adminANDgroup($limit);//获得管理员权限信息
	 	//print_r($list);
	 	$this->list=$list;//这个变量传到后台模板文件直接使用
	 	$this->count=$count;
	 	$this->page=$this->pageShow($count);//分页结果显示
	 	$this->grouplist=$grouplist;
	 	$this->display();
	}
	
	//添加管理员
	public function adminadd()
	{
		if(!$this->isPost()){
			//未提交，显示
			$grouplist=model('group')->select('','id,name','id');//用户组
			$this->grouplist=$grouplist;
			$this->t_name="增加";
			$this->display("admin/adminedit");
		}else{
			//提交添加管理员
			if(empty($_POST['username'])||empty($_POST['rpassword'])) $this->error('信息没有填写完整!');
			
			$data=array();
			$data['groupid']=intval($_POST['groupid']);
			$data['username']=$_POST['username'];
			$data['password']=$this->newpwd($_POST['rpassword']);
			$data['realname']=$_POST['realname'];
			$data['iflock']=intval($_POST['iflock']);
			if(model('admin')->insert($data))
				$this->success('管理员添加成功~',url('admin/index'));
			else $this->error('管理员添加失败!');
		}
		
	}
	
	//管理员删除，通过传参数过来删除
	public function admindel()  
	{
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('参数错误');
		$num=model('admin')->count("groupid='1'");//超级管理员总数
		if($num<2) $this->error('必须保留至少一个超级管理员~');//防止后台没用超级管理员
		if(model('admin')->delete("id='{$id}'"))
		$this->success('管理员已删除',url('admin/index'));
		else $this->error('没有该管理员');
	}
	
	//管理员修改,通过传递参数
	public function adminedit()  
	{
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('参数错误');
		
		$info=model('admin')->find("id='{$id}'",'id,groupid,username,realname,password,iflock');
		//print_r($info);return ;
		if(!$this->isPost()){
			//未提交则显示
			$grouplist=model('group')->select('','id,name','id');//管理员级别列表
			$this->info=$info;//当前管理员信息数组
			$this->id=$id;
			$this->t_name="编辑";
			$this->grouplist=$grouplist;
			$this->display();
		}else{
			//提交，修改
			$data=array();//要保存的数组
			$data['groupid']=intval($_POST['groupid']);
			$data['username']=$_POST['username'];
			if($_POST['rpassword']!=$info['password'])
				//密码修改了，则重新加密
			 $data['password']=$this->newpwd($_POST['rpassword']);
			$data['realname']=$_POST['realname'];
			$data['iflock']=intval($_POST['iflock']);
			if(model('admin')->update("id='{$id}'",$data))
			$this->success('信息修改成功~',url('admin/index'));
			else $this->error('没有任何修改，不需要执行');
		}
	}

	//管理员锁定，通过传递参数
	public function adminlock() 
	{
		$id=intval($_GET['id']);
		$lock['iflock']=intval($_GET['l']);
		if(empty($id)) $this->error('非法操作~');
		if($lock['iflock']==0 || $lock['iflock']==1){
			model('admin')->update("id='{$id}'",$lock);
			$this->success('操作成功~',url('admin/index'));
		}
		else $this->error('非法操作~');
	}
	
	//管理员分组权限管理，重要！！！
	public function group()  
	{
		if(!$this->isPost()){
			//未提交，显示后台所有的功能
			$powerlist=model('method')->select('','','rootid,id');//所有的功能列表
			//print_r($powerlist);
			//所有不是超级管理员组的组别
			$grouplist=model('group')->select("power!='-1'",'id,name','id');//-1是系统最高管理员，不显示出来
			$this->powerlist=$powerlist;//赋值
			$this->grouplist=$grouplist;
			$this->display();
		}else{
			if(empty($_POST['gname'])) $this->error('必须填写组名~');
			$data=array();
			$data['name']=$_POST['gname'];
			$data['power']=implode(',',$_POST['power']);
			if(model('group')->insert($data))
			$this->success('权限组添加成功~',url('admin/group'));
		}
	}

	//分组编辑,接收参数
	public function groupedit()
	{
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('参数错误~');
		$group=model('group')->find("id='{$id}'",'name,power');//当前待编辑的权限组信息
		//print_r($group);
		if($group['power']=='-1') $this->error('非法操作');//-1是系统最高管理员，不能被编辑
		if(!$this->isPost()){
			//未提交，显示
			$powerlist=model('method')->select('','','rootid,id');//所有的功能列表
			$this->powerlist=$powerlist;
			$this->info=$group;
			$this->id=$id;
			$this->display();
		}else{
			//提交编辑
			if(empty($_POST['gname'])) $this->error('必须填写组名~');
			$data=array();
			$data['name']=$_POST['gname'];//权限组名
			$data['power']=implode(',',$_POST['power']);//提交所有的power权限数组，用‘，’分割
			//echo $data['power'];return ;
			if(model('group')->update("id='{$id}'",$data))
			$this->success('权限组编辑成功~',url('admin/group'));
			else $this->error('没有任何修改，不需要执行');
		}
	}
	
	//分组删除
	public function groupdel()  
	{
		$id=intval($_GET['id']);//权限组的id
		if(empty($id)||$id==-1) $this->error('非法操作~');//-1 系统最高管理员，不可被删除
		if(model('admin')->find("groupid='{$id}'",'id'))
		$this->error('请先删除该权限下的管理员~');//
		if(model('group')->delete("id='{$id}'"))
		$this->success('删除成功~',url('admin/group'));
		else $this->error('删除失败');
	}

	//当前账户资料管理
	public function adminnow() 
	{
		if(!isset($_SESSION['admin_uid'])) $this->error('未知的账户信息~');
		$id=$_SESSION['admin_uid'];//登陆用户id
		$info=model('admin')->find("id='{$id}'",'id,username,realname,password');
		if(!$this->isPost()){
			$this->info=$info;
			//print_r($info);
			$this->display();
		}else{
			if($_POST['rpassword']!=$_POST['spassword']) $this->error('确认密码与密码不同~');
			if($this->newpwd($_POST['opassword'])!=$info['password']) $this->error('旧密码错误~!');
			$data=array();
			$data['password']=$this->newpwd($_POST['rpassword']);
			$data['realname']=$_POST['realname'];
			if(model('admin')->update("id='{$id}'",$data))
			$this->success('信息修改成功~',url('admin/adminnow'));
			else $this->error('没有任何修改，不需要执行');
		}
	}
}