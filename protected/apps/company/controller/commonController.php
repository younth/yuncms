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
	
	//文件上传
	protected  function  upload($savePath='',$maxSize='',$allowExts='',$allowTypes='',$saveRule='')
	{
		$upload=new UploadFile($savePath,$maxSize,$allowExts,$allowTypes,$saveRule);
		return $upload;
	}
	
	//访问记录
}