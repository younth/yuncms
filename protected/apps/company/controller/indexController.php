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
	    	//dump($_SESSION);
	    	$weibo_uid=$_SESSION['token']['access_token'];
	    	if(empty($_SESSION['company_id'])&&empty($weibo_uid)) $this->redirect(url('default/index/index'));//未登录， 跳转到登录页面
	    	if($weibo_uid)
	    	{
	    		//找出该微博key的用户
	    		$acc=model("member_login")->member_weibo($weibo_uid);
	    		if($acc) $this->uname=$acc['uname'];//绑定了，读出用户信息
	    	}
	    	
	    	if($_SESSION['company_id']) $this->uname=$_SESSION['name'];
	    	
        	$this->display();
	    }

    
}