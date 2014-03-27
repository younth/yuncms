<?php
/*
 * 会员模块的公共类
 * */
class commonController extends memberController {
	protected $layout = 'layout';//开启基本布局
	
	public function __construct()
	{
		parent::__construct();
		@session_start();//开启session
	}
}
?>