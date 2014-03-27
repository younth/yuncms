<?php
class indexController extends commonController
{
	public function index()
	{
		$weibo_uid=$_SESSION['token']['access_token'];
		$cookie_auth=get_cookie('auth');//获得cookie的值
		//如果登陆了则跳转到首页,auth是存放用户信息的数组
		if(!empty($cookie_auth)||empty($weibo_uid)) $this->redirect(url('member/index/index'));
		else $this->display();
			
	}
	
	//生成验证码
    public function verify()
      {
            Image::buildImageVerify();
      }
}
?>