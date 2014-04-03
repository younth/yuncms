<?php
/*
 * 会员模块的公共类
 * */
class commonController extends memberController {
	//protected $layout = 'layout';//layout是基本页面布局
	
	public function __construct()
	{
		parent::__construct();
		@session_start();//开启session
	}
}