<?php
/*
 * 人脉控制器
 * */
class messageController extends commonController
{
	public function __construct()
	{
		parent::__construct();
		$this->uploadpath=ROOT_PATH.'upload/company/license/';
	}
	
	//全部私信
	public function index()
	{
		//检索我的全部私信列表
		$auth=$this->auth;//本地登录的cookie信息
		$id=$auth['id'];
		$msg=model("message_list")->allmag_user($id);//我发起的私信记录
		if(!empty($msg)){
			//直接找到私信记录，则判断跟谁的记录
			foreach ($msg as  $row=>$v){
				//获取我的私信联系人的头像
				$msg[$row]['user']=model("member")->user_profile($v['mid'],'');
			}
			//dump($msg);
			$this->msg=$msg;
		}
			//我没有直接发起私信，但是我有私信联系人，我是接受者，这也是我的私信
			/*技术难题
			 * Mysql 实现split字符串分割，用CONCAT联合模糊查询
			 * */
		//两个数组联合查询，也可以是联合where 
		$this->display();
	}
	
	public function unread()
	{
		//我的联系人,查询我的联系人的信息
		$auth=$this->auth;//本地登录的cookie信息
		$id=$auth['id'];
		if(empty($id)) $this->redirect(url('default/index/login'));//未登录， 跳转到登录页面
		$this->display();
	}

	//发送私信
	public function sendmsg()
	{
		if(!$this->isPost()){
			$id=intval($_GET['id']);
			$user=model("member")->find("id={$id}",'uname');
			$this->id=$id;
			$this->re_name=$user['uname'];
			$this->display();
		}else{
			/*
			 * 私信对对应的是会员与会员之间的通信，涉及member_list member_content  member_message
			 * */
			//增加会员之间通信的记录
			
			$id=intval($_POST['id']);
			$content=text_in($_POST['content']);
			$auth=$this->auth;//本地登录的cookie信息
			$mid=$auth['id'];
			$data=array();
			$msg=array();
			//先判断有没有私信记录，有就更新时间与最后一条记录，记录是发还是收，如何判断，1.0版本不做~~
			$re=model("message_list")->find("(from_mid='{$mid}' and rece_mid='{$id}') or (rece_mid='{$mid}' and from_mid='{$id}')");
			if($re){
				//已经有私信记录,更新会员的私信记录，并且增加一条记录！！
				$data['ctime']=time();
				$data['last_message']=$content;//私信内容
				$list_id=$re['id'];
				model("message_list")->update("id='{$list_id}'",$data);
			}else{
				$data['from_mid']=$mid;//发起者id,当前会员
				$data['rece_mid']=$id;//接收者
				$data['ctime']=time();
				$data['last_message']=$content;//私信内容
				$list_id=model("message_list")->insert($data);//私信列表的id
			}
			if($list_id){
				$msg['list_id']=$list_id;//私信列表的id
				$msg['from_uid']=$mid;//发信人id
				$msg['content']=$content;//私信内容
				$msg['ctime']=time();
				if(model("message_content")->insert($msg)) echo 1;
				else echo 0;
			}
		}
	}

	//删除私信记录，一方删除，另一方应该还保留
	public function delmsg()
	{
		echo 1;
	}
	
	//私信通信详情
	public function content()
	{
		$list_id=intval($_GET['id']);//私信id
		$this->name=in($_GET['name']);
		//查询跟该私信记录下面所以的私信记录
		$list=model("message_content")->select("list_id='{$list_id}'");
		if(!empty($list)){
			//直接找到私信记录，则判断跟谁的记录
			foreach ($list as  $row=>$v){
				//获取我的私信联系人的相关信息
				$list[$row]['user']=model("member")->user_profile($v['from_uid'],'');
			}
			$this->msg=$list;
		}
		//dump($list);
		$this->display();
	}
	
	//删除详细私信
	public function del_detailmsg()
	{
		$id=intval($_GET['id']);
		if(model("message_content")->delete("id='{$id}'")) echo 1;
	}
}


