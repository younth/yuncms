<?php
/**
 *功能：会员的个人管理信息，设置
 * @author wy
 * @version 2.1
 */
class settingController extends commonController
{
	protected $layout = 'layout';//开启页面基本布局，仅用于账号管理的基本页面
	
	public function index()
	{
		
		$this->display('setting/avatar');
	}
	
	//会员头像上传，若为微博登陆，则直接读取微博头像
	
	public function avatar()
	{
		//头像上传功能未搞定。。需要存储到数据库
		//$face=CP_PATH.'ext/avatar/avatar.php';
		//$this->face=$face;
		//require(CP_PATH.'ext/avatar/avatar.php');//后台部分配置固定，需要重加载配置
		//$url="http://{$_SERVER['HTTP_HOST']}/avatar/avatar.php";//上传头像的url
		$url='avatar/avatar.php';//用相对地址处理
		$this->avatarurl=$url;
		$hover="class=\"selected\"";//设置当前的导航状态
		$this->nav_avatar=$hover;
		$this->display();
		//$this->redirect($url);
	}
	
	//密码修改
	public function modifypassword()
	{
		if(!$this->isPost()){
			$hover="class=\"selected\"";//设置当前的导航状态
			$this->nav_modifypass=$hover;
			$this->display();
		}else{
			if($_POST['password']!=$_POST['surepassword']) $this->error('确认密码与新密码不符~');
			$auth=$this->auth;
			$id=$auth['id'];
			$info=model('member')->find("id='{$id}'",'password');
			//dump($info);
			$oldpassword=codepwd($_POST['oldpassword']);
			if($oldpassword!=$info['password']) $this->error('旧密码不正确~');
			 
			$data['password']=codepwd($_POST['password']);
			model('member')->update("id='{$id}'",$data);
			$this->success('密码修改成功~',url('member/setting/avatar'));
		}
		
	}
	
	//账号管理
	public function management()
	{
		if(!$this->isPost()){
			//查询新浪微博是否绑定，本地登录与微博登陆获取id不同
			$auth=$this->auth;
			if($auth){
				$id=$auth['id'];
				$re=model('member_login')->find("id='{$id}'",'weibo_key');
				$re?$bind=1:$bind=0;
			}
			$weibo_uid=$_SESSION['token']['access_token'];
			if($weibo_uid){
				$bind=1;
			}
			$this->bind=$bind;
			$hover="class=\"selected\"";//设置当前的导航状态
			$this->nav_manage=$hover;
			$this->display();
		}
		else {
			
		}
	}

	//解除绑定，非核心功能
}