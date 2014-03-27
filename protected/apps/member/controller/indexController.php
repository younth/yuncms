<?php
/*
 * 会员管理首页控制器，该部分为单独模块
 * */
class indexController extends commonController
{
	  public function index()
	    {
	    	//判断是否登录
	    	//新浪微博的session信息,还需要判断是不是第一次用新浪微博登陆
	    	//注意使用新闻微博登录没有存储本地cookie
	    	$weibo_uid=$_SESSION['token']['access_token'];
	    	$auth=$this->auth;//本地登录的cookie信息
	    	if(empty($auth)&&empty($weibo_uid)) $this->redirect(url('member/account/login'));//未登录， 跳转到登录页面
	    	if($weibo_uid)
	    	{
	    		//找出该微博key的用户
	    		$acc=model("member_login")->member_weibo($weibo_uid);
	    		if($acc) $this->uname=$acc['uname'];//绑定了，读出用户信息
	    	}
	    	
	    	if($auth&&$acc['is_active']=1) $this->uname=$auth['uname'];
	    	
        	$this->display();
	    }

    
}
?>