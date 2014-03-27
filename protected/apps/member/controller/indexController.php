<?php
/*
 * 会员管理首页控制器，该部分与前台模板，后台管理均脱离，单独处理
 * */
class indexController extends commonController
{
	  public function index()
	    {
	    	//判断是否登录
	    	//新浪微博的session信息,还需要判断是不是第一次用新浪微博登陆
	    	$weibo_uid=$_SESSION['token']['access_token'];
	    	//判断是否登录
	    	$auth=$this->auth;
	    	if(empty($auth)&&empty($weibo_uid)) $this->redirect(url('member/account/login'));//未登录， 跳转到登录页面
        	else $this->display();
	    }

    
}
?>