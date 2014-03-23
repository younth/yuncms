<?php
/*
 * 公共类,控制后台app的访问权限，针对于拓展的app基于后台的管理
 * */
class appadminController extends baseController{

	public function __construct()
	{
		if( !isset( $_SESSION )) session_starts();
		$appID = config('appID');
		$this->appID = empty($appID) ? $this->appID : $appID;
		
		if(isset($_SESSION['admin_uid'])&&isset($_SESSION['admin_username'])){
			//auth权限认证类运用
		   $apppower=$_SESSION['yunapppower'];//yunapppower是auth类里面的权限控制
		   //echo $apppower;
		   if($apppower!=-1) {//最高管理员
			   if(!(isset($apppower[APP_NAME]) && $apppower[APP_NAME]==-1)) $this->error('您没有权限操作');
		   }
		}else $this->error('您没有登录');
		parent::__construct();
	}
}