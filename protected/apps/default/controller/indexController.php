<?php
class indexController extends commonController
{
	static protected $we_akey;
	static protected $we_skey;
	static protected $we_callback_url;//新浪微博回调地址
	
	public function __construct()
	{
		parent::__construct();
		$config=require(BASE_PATH.'/config.php');//后台部分配置固定，需要重加载配置
		require(CP_PATH . 'ext/saetv2.ex.class.php');//加载新浪微博接口文件
		$this->we_akey=$config['sina_wb_akey'];
		$this->we_skey=$config['sina_wb_skey'];
		//$this->we_callback_url='http://cms.yunstudio.net/index.php?yun=member/account/weibo';//回调地址
		$this->we_callback_url=url('member/account/weibo');
	
	}
	
	public function index()
	{
		//构造新浪微博登陆url
		$o = new SaeTOAuthV2( $this->we_akey , $this->we_skey );
		$code_url = $o->getAuthorizeURL($this->we_callback_url);
		$this->weibo_login=$code_url;
		$weibo_uid=$_SESSION['token']['access_token'];
		//如果微博登陆了
		if($weibo_uid) $this->redirect(url('member/index/index'));//跳转到会员首页
		
		if(!empty($_SESSION['company_id'])) $this->redirect(url('company/manage/index'));//企业登陆，跳转到企业面板
		
		//如果登陆了则跳转到首页,auth是存放用户信息的数组
		$auth=$this->auth;//本地登录的cookie信息
		if($auth['is_active']==1) $this->redirect(url('member/index/index'));//未激活，跳转到会员首页
		
		$this->display();
			
	}
	
	//sns登陆
	public function login()
	{
		//新浪微博登陆url处理
		$o = new SaeTOAuthV2( $this->we_akey , $this->we_skey );
		$code_url = $o->getAuthorizeURL($this->we_callback_url);
		$this->weibo_login=$code_url;
		$weibo_uid=$_SESSION['token']['access_token'];
		//微博登陆
		if($weibo_uid) $this->redirect(url('member/index/index'));//跳转到会员首页
		$auth=$this->auth;//本地登录的cookie信息
		if(!empty($_SESSION['company_id'])) $this->redirect(url('company/index/index'));//跳转到公司首页
		if(!empty($auth)||!empty($weibo_uid)) $this->redirect(url('member/index/index'));//跳转到会员首页
		else {
			$this->display();
		}
			
	}
	
	
	//生成验证码
    public function verify()
      {
            Image::buildImageVerify();
      }
      
}
?>