<?php
/*
 * 会员模块的公共类
 * */
class commonController extends memberController {
	//protected $layout = 'layout';//layout是基本页面布局

	
	public function __construct()
	{
		parent::__construct();
		$auth=$this->auth;//本地登录的cookie信息|
		$id=$auth['id'];
		$all_undo=model('member_card')->count("rece_id='{$id}' and status=1");//未处理的好友邀请数量,自己是接受者
		$this->undo_count=$all_undo;
		
		//未读私信总数，自己是接受者
		$all=model("message_member")->select("member_id='{$id}'",'new');
		if($all){
			foreach ($all as $v)
			{
				$totle+=$v['new'];//统计未读私信总数，用了一个循环
			}
		}
		$this->unread=$totle;
	}

}