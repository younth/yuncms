<?php
class memberModel extends baseModel{
	protected $table = 'member';
	
	//构造三表联合查询,注意多表查询用表的别名
	public function member_group_link($keyword='',$starttime,$endtime,$limit='')
	{
		if(empty($starttime)||empty($endtime)) $where=(empty($keyword)?'':'where m.uname like "%'.$keyword.'%"');
		else $where='where m.ctime<='.$endtime.' AND m.ctime>='.$starttime.' AND m.uname like "%'.$keyword.'%"';
		$sql="SELECT m.id,l.user_group_id,m.uname,m.login_email,m.lastip,m.ctime,m.lasttime,m.is_active,g.group_name FROM {$this->prefix}member as m left outer join ({$this->prefix}member_group as g,{$this->prefix}member_group_link as l) on (l.uid=m.id AND l.user_group_id=g.id)  {$where} ORDER BY m.id LIMIT {$limit}";
	    return $this->model->query($sql);
	}
	
	//符合条件的会员数
	public function membercount($keyword="",$starttime,$endtime)
	{
		if(empty($starttime)||empty($endtime)) $where=(empty($keyword)?'':'uname like "%'.$keyword.'%"');
		else  $where=(empty($keyword)?"ctime<='$endtime' AND ctime>='$starttime'":"ctime<='$endtime' AND ctime>='$starttime' AND uname like '%$keyword%'");
		return $this->count($where);
	}
	
	//待审核用户
	public function active_membercount($keyword="",$starttime,$endtime)
	{
		if(empty($starttime)||empty($endtime)) $where='uname like "%'.$keyword.'%" AND is_active=0';
		else  $where=(empty($keyword)?"ctime<='$endtime' AND ctime>='$starttime'":"ctime<='$endtime' AND ctime>='$starttime' AND uname like '%$keyword%'");
		return $this->count($where);
	}
	
	//构造三表联合查询
	public function active_member_group_link($keyword='',$starttime,$endtime,$limit='')
	{
		/**构造左连接查询的where条件，分为有无时间限制，有无关键字设置**/
		if(empty($starttime)||empty($endtime)) $where='where m.uname like "%'.$keyword.'%" AND m.is_active=0 ';
		else $where='where m.ctime<='.$endtime.' AND m.ctime>='.$starttime.' AND m.uname like "%'.$keyword.'%"';
		$sql="SELECT m.id,l.user_group_id,m.uname,m.login_email,m.lastip,m.ctime,m.lasttime,m.is_active,g.group_name FROM {$this->prefix}member as m left outer join ({$this->prefix}member_group as g,{$this->prefix}member_group_link as l) on (l.uid=m.id AND l.user_group_id=g.id)  {$where} ORDER BY m.id LIMIT {$limit}";
		return $this->model->query($sql);
	}
		
	//查询指定用户信息,连表三次
	public function find_link($id)
	{
		$sql="SELECT m.id,l.user_group_id,m.uname,m.password,m.ctime,m.lasttime,m.is_active,m.login_email FROM {$this->prefix}member as m left outer join ({$this->prefix}member_group as g,{$this->prefix}member_group_link as l) on (l.uid=m.id AND l.user_group_id=g.id)  WHERE  m.id={$id} ";
		$user= $this->model->query($sql);
		return $user[0];//$user是二维数组，应该返回一维数组显示会员信息
	}
	
	//根据ID查询指定用户信息,连表二次,包括读取用户头像信息
	public function user_profile($id,$letter)
	{
		if(empty($letter))
			$sql="SELECT m.id,m.uname,m.first_letter,m.login_email,p.* FROM {$this->prefix}member as m,{$this->prefix}member_profile as p WHERE m.id=p.mid AND m.id='{$id}'";
		else{
			$sql="SELECT m.id,m.uname,m.first_letter,m.login_email,p.* FROM {$this->prefix}member as m,{$this->prefix}member_profile as p WHERE m.id=p.mid AND m.id='{$id}' AND m.first_letter='{$letter}'";
		}
		$user= $this->model->query($sql);
		//获得用户的头像信息
		if(!empty($user)){
			include_once(ROOT_PATH.'/avatar/AvatarUploader.class.php');
			$au = new AvatarUploader();
			foreach ($user as  $row=>$v)
			{
				$uid=$v['id'];
				$user[$row]['avatar']=$au->getAvatar($uid,'small');
				$user[$row]['allcart']=model('member_card')->count("send_id='{$uid}' or rece_id='{$uid}'");//联系人总数
			}
		}
		return $user[0];//$user是二维数组，应该返回一维数组显示会员信息
	}
	
}
?>