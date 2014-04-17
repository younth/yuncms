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
		if(empty($id)) $this->redirect(url('default/index/login'));//未登录， 跳转到登录页面
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
			else echo "添加失败";
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

	//ajax加载名片信息
	public function loadcard()
	{
		$id=intval($_GET['id']);
		//查询用户的信息
		$info=model("member")->user_profile($id,'');
		//dump($info);
		//$html.='<dl><dt><a target="_blank" href="showuser.php?uid='.$randuser[$i]['uid'].'">';
		$url=url('profile/user',array('id'=>$id));
		$delurl=url('card/delfriend',array('id'=>$id));
		$html.='<div style="" class="card-type-a" id="J_cardTypeA"><div class="out"><div class="in"><div class="hd">';
		$html.='<a target="_blank" href="'.$url.'"><img src="'.$info['avatar'].'" alt=""></a></div>';
		$html.='<div class="bd"><div class="inform"><p class="com" title="'.$info['school'].'">'.$info['school'].'</p>';
		$html.='<h3 title="'.$info['uname'].'"><a target="_blank" href="">'.$info['uname'].'</a></h3> <p class="job" title="'.$info['major'].' · '.$info['city'].'">'.$info['major'].' · '.$info['city'].'</p></div>';
		$html.='<div class="plus"><p><i>Q&nbsp;Q：</i><em>'.$info['qq'].'</em></p><p><i>手机：</i><em>'.$info['tel'].'</em> </p>';
		$html.='<p> <i>邮箱：</i><em title="'.$info['login_email'].'">'.$info['login_email'].'</em></p></div></div></div></div> <div class="shadow"></div></div>';
		$html.='<div style="z-index: 1; cursor: default;" class="card-type-b" id="J_cardTypeB"> <div class="out"> <div class="in"><table> <tbody> <tr> <td id="personalTags">';
		$tag=$info['tag'];
		$count=count($tag);
		for($i=0;$i<$count;$i++){
			if($i%2==0) $html.='<span>'.$tag[$i]['name'].'</span>';
			else $html.='<span class="fav">'.$tag[$i]['name'].'</span>';
			
		}
	
		$html.='</td></tr></tbody></table></div></div><div class="shadow"></div></div>';
		$html.='<div class="edit-type"><p class="action"><a href="" class="send-msg" title="发私信" id="single_mail" uid="'.$info['id'].'" username="'.$info['uname'].'"></a>';
		$html.='<a target="_blank" href="'.$url.'" title="查看档案" class="person-page"></a><a href="'.$delurl.'" title="解除朋友关系" id="delfriend"></a></p></div>';
		echo $html;
	}
	
	//解除好友关系,应该用ajax，没有处理好
	public function delfriend()
	{
		$auth=$this->auth;//本地登录的cookie信息
		$rece_id=$auth['id'];//读取用户的id
		$send_id=intval($_GET['id']);
		$re=model('member_card')->find("send_id='$rece_id' and rece_id='$send_id'");
		if($re) model('member_card')->delete("id='".$re['id']."'");
		else{
			$re=model('member_card')->find("send_id='$send_id' and rece_id='$rece_id'");
			model('member_card')->delete("id='".$re['id']."'");
		}
		$this->redirect(url('card/index'));
	}
	
	//找人,查询所有的会员
	public function search()
	{
		
	}
	
	//我可能认识的人，根据专业，标签，学校匹配，是当前的用户
	public function mayknow()
	{
		$auth=$this->auth;//本地登录的cookie信息
		$id=$auth['id'];//读取用户的id
		$mayknow=model("member")->maybeknow($id);
		
		//最新加入，根据注册时间以及专业匹配
		//dump($mayknow);
		$this->mayknow=$mayknow;
		$this->display();
	}
	
	//邀请好友注册，增加我的积分
	public function invite()
	{
		$this->display();
	}
}


