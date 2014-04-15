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
	    	if(empty($auth)&&empty($weibo_uid)) $this->redirect(url('default/index/login'));//未登录， 跳转到登录页面
	    	
	    	if($auth)
	    	{
	    		if($auth['is_active']==1) {
	    			$this->uname=$auth['uname'];//登陆成功
	    			$id=$auth['id'];
	    		}
	    		//退出登陆
	    		else {
	    			$this->error('账号未激活~');
	    			session_unset();//释放所有的session
	    			set_cookie('auth','',time()-1);
	    		}
	    	}
	    	
	    	if($weibo_uid)
	    	{
	    		//找出该微博key的用户
	    		$acc=model("member_login")->member_weibo($weibo_uid);
	    		//dump($acc);
	    		if(!empty($acc['id'])){//绑定了，读出用户信息
	    			$this->uname=$acc['uname'];
	    			$_SESSION['uid']=$acc['id'];
	    			//$this->display();
	    		}
	    		else //未绑定
	    		{
	    			session_unset();//释放所有的session
	    			$this->redirect(url('default/index/login'));
	    		}
	    		//微博登陆存储session
	    	}
	    	
	    	//输出会员的头像
	    	$hover="class=\"current\"";//设置当前的导航状态
	    	$this->hover_index=$hover;
	    	
	    	//查询用户人脉通知,是用户收到的，未处理的人脉邀请
	    	$undo=model("member_card")->find("rece_id='{$id}' and status=1");
	    	$send_user=model("member")->user_profile($undo['send_id'],'');//发送者的信息
	    	//$rece_user=model("member")->user_profile($undo['rece_id']);//接受者的信息
	    	$this->send=$send_user;
        	$this->display();
        	//exit;
	    }
}