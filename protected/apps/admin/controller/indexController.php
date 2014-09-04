<?php
/*
 * 后台首页的控制器
 * */
class indexController extends commonController
{
	public function __construct()
	{
		parent::__construct();
		//dump(Auth::getModule());//遍历所有模型和方法初始method表中数据
	}
	
	//显示管理后台首页
	public function index()
	{
		/*
		 * 后台通过auth类进行验证
		 * Auth::$config['AUTH_SESSION_PREFIX'].'groupid'; 为auth_groupid，是经过auth处理后的groupid
		 * $_SESSION['auth_groupid']是通过auth保存
		 * */
		$groupid=$_SESSION[Auth::$config['AUTH_SESSION_PREFIX'].'groupid'];
		$power=model('group')->find("id = {$groupid}",'power');//权限组
		//power=-1,系统最高管理员   ifmenu=1获取后台导航菜单
		/***不同权限的管理员检索对应的权限***/
		if($power['power']==-1) $where="ifmenu = '1'";
		else $where="ifmenu = '1' AND id IN(".$power['power'].")";
		//显示所拥有权限的栏目
		$methods=model('method')->select($where,'','rootid,id');
		
		/*****构造菜单,这一块比较复杂,原理就是查询methods表，然后进行分类，注意对拓展应用的单独处理*******/
		if(!empty($methods)){
			$operate='';
			$page=array();
			$pluginlist=array();//拓展应用所有操作的数组
			foreach ($methods as $vo){
				//pid=0,是顶级栏目的各个应用
				if($vo['pid']==0){
					$operate=$vo['operate'];//取得顶级应用的operate
					//echo $operate."<br>";
					$root[$operate]['channel']=$vo['name']?$vo['name']:$vo['operate'];//获得各个功能的名称
					//echo $root[$operate]['channel']."<br>";
					
					$root[$operate]['pages']=array();//拓展应用存储数组
					
					/***rootid=0 是拓展应用，包括应用管理等****/
					if($vo['rootid']==0){
						//调用app下面的api文件中的getadminMenu 函数读取拓展应用下面的栏目
						//echo $operate;
						$plugmenu=api($operate,'getadminMenu');//通过api文件获取拓展应用菜单,包括应用管理和会员管理
						//print_r($plugmenu);
						if(is_array($plugmenu)){
						   $pluginlist[]=$operate;
						   $root[$operate]['pages']=$plugmenu;//拓展应用数组
						}
						//print_r($root[$operate]['pages']);
					   }else {
					   	//pid=0 但是单独的app模块，不属于拓展应用，实际是单独处理会员应用
					   	$membermenu=api($operate,'getadminMenu');//获取栏目
					   	if(is_array($membermenu)){
					   		$memberlist[]=$operate;
					   		$root[$operate]['pages']=$membermenu;//拓展应用数组:会员
					   	}
					   	//print_r($root[$operate]['member']);
					   }//会员模块处理结束
				}else{
					//非顶级应用，即其他普通应用，凑出操作函数
					$page['name']=$vo['name']?$vo['name']:$vo['operate'];
					$page['url']=url($operate.'/'.$vo['operate']);
					$root[$operate]['pages'][]=$page;
					//print_r($page);
				}
			}
		}else $this->error('获取后台导航菜单失败~');
		
		$menu=Array(
		   Array('title'=>'管理首页','channels' => Array($root['set'],$root['admin'],$root['dbback'])),//默认显示菜单
		   Array('title'=>'结构管理','channels' => Array($root['sort'],$root['place'],$root['files'],$root['task'])),
		   Array('title'=>'内容管理','channels' => Array($root['news'],$root['fragment'],$root['link'],$root['feedback'])),
		   Array('title'=>'会员管理','channels' => Array()),
		   Array('title'=>'拓展应用','channels' => Array()),
		);
		//添加拓展应用菜单,拓展应用的所有功能未定义到数据库，而是在appmanageApi.php中自己定义
		//print_r($menu);
		
		//单独处理会员模块
		foreach ($memberlist as $vo){
			$menu[3]['channels'][]=$root[$vo];
		}
		//单独处理企业模块
		
		
		//单独处理拓展应用
		foreach ($pluginlist as $vo){
			$menu[4]['channels'][]=$root[$vo];//拓展应用
		}
		
		$menulist= json_encode($menu);//处理menu
		//print_r($menulist);
		$this->menulist=$menulist;
		$this->username=$_SESSION['admin_realname'];
		//新版本更新,后台点击栏目对于栏目首页内容块出现
		$this->framurl=$_GET['url']?urldecode($_GET['url']):url('index/welcome');//内部iframe显示页
		$menuindex=intval($_GET['menuindex']);
		$this->menuindex=$menuindex?$menuindex:0;//设置初始显示菜单
		$this->display();
	}
	
	//登录页面
	public function login()
	{
		if(!$this->isPost())
		{
			//没有提交，就显示登陆的页面
			$this->ver=config('ver_name');//版本号
			$this->display();
		}else{
		//提交了，说明点击登陆了，进行登陆验证处理
		$username=in($_POST['username']);//in是cp里面的过滤函数
		$password=$this->newpwd($_POST['password']);//密码加密
		//数据验证
		if(empty($username))
		{
			$this->error('请输入用户名');
		}
		if(empty($_POST['password']))
		{
			$this->error('请输入密码');
		}
		if(empty($_POST['checkcode']))
		{
			$this->error('请输入验证码');
		}
		if($_POST['checkcode']!=$_SESSION['verify'])
		{
			$this->error('验证码错误，请重新输入');
		}

		//如果登陆，session设置
		if(model('admin')->login($username,$password))
		{
			//成功登陆的跳转,跳转到首页
			$this->redirect(url('index/index'));
		}
		else
		{
			$this->error('用户名、密码错误或账户已经被锁定~');
		}
	  }
	}
	
	//用户退出
	public function logout()
	{
		Auth::clear();//清除的不是session ,而是auth权限
		$this->success('您已成功退出系统',url('index/login'));
	}
	
	//生成验证码，调用cp框架里面的函数
	public function verify()
	{
		Image::buildImageVerify();
	}
	
	//自动跳转加载welcome函数
	public function welcome()
	{
		$this->ver=config('ver_name');
		$this->display();
	}
}
