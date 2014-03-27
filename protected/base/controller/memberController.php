<?php
/*
 * 会员模块的基类，因为系统的前台需要调用，所以作为base基类
 * */
class memberController extends baseController{
  protected $auth=array();//auth是用户信息的数组
	public function __construct()
	{
    parent::__construct(); 
    	//powerCheck，返回1没有权限，返回2未登陆有权限，返回数组登陆有权限
		$power=api('member','powerCheck');//加载member模块的powerCheck方法，获得登陆会员的相关信息
    switch ($power) {
      case false:
      	//会员应用没有开启
        $this->assign('memberoff',true);
        break;
      case 1://没有权限访问
      	//$_SERVER['HTTP_REFERER'] 获取当前链接的上一个连接的来源地址  起到防盗链作用
        $this->error('您没有登陆或是权限不够进入~',$_SERVER['HTTP_REFERER']);
		//跳转到登录的页面
        break;
      case 2://游客没有权限访问
      	//$this->error('您没有登陆或是权限不够进入~',$_SERVER['HTTP_REFERER']);
        break;
      default://会员信息数组,会员有权限访问
        $this->auth=$power;//auth是用户信息的数组,
        //print_r($power);
        $this->assign('auth',$power);//auth的默认值是3,auth传到模板
        break;
    }
	}
}