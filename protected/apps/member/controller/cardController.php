<?php
/*
 * 人脉控制器
 * */
class cardController extends commonController
{
	public function __construct()
	{
		parent::__construct();
		$this->uploadpath=ROOT_PATH.'upload/company/license/';
		$hover="class=\"current\"";//设置当前的导航状态
		$this->hover_card=$hover;
	}
	
	public function index()
	{
		//我的联系人,查询我的联系人的信息
		$auth=$this->auth;//本地登录的cookie信息
		$id=$auth['id'];
		$card=model('member_card')->mycard($id);//好友分组
		$allcard=model('member_card')->count("send_id='{$id}' or rece_id='{$id}'");//联系人总数
		if(!empty($card)){
			foreach ($card as  $row=>$v)
			{
				$card[$row]=model("member")->user_profile($v['mid'],'');
			}
			$this->mycard=$card;
		}

		//查询我的联系人，分组A-Z,如何分组未解决
		//dump($card);
		$this->display();
	}
	
	//发送添加请求
	public function send( )
	{
		$auth=$this->auth;//本地登录的cookie信息
		$data=array();
		$data['send_id']=$send_id=$auth['id'];//读取用户的id
		$data['rece_id']=$rece_id=intval($_GET['id']);
		$data['status']=1;
		$data['ctime']=time();
		$re=model('member_card')->find("send_id='{$send_id}' and rece_id='{$rece_id}'");
		if(empty($re))
		{
			if(model("member_card")->insert($data)) echo 1;
			else echo "发送失败";
		}else echo 0;
	}
	
	//我同意别人的邀请,更新别人的申请记录，status设为2，两人互为好友
	public function accept()
	{
		$auth=$this->auth;//本地登录的cookie信息
		$rece_id=$auth['id'];//读取用户的id
		$send_id=intval($_GET['id']);//申请人id
		$data=array();
		$data['status']=2;
		$data['ctime']=time();
		if(model("member_card")->update("send_id='{$send_id}' and rece_id='{$rece_id}'",$data)) echo 1;
		else echo "失败~";
	}

	
}