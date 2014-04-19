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
				$user[$row]['small']=$au->getAvatar($uid,'small');
				$user[$row]['avatar']=$au->getAvatar($uid,'middle');
				$user[$row]['allcart']=model('member_card')->myallcard($uid);//联系人总数
				//用户标签
				$user[$row]['tag']=model("member_tag")->select("mid='{$id}'",'name');
			}
		}
		return $user[0];//$user是二维数组，应该返回一维数组显示会员信息
	}
	
	//可能认识的人,去除已经是发送过申请的或者已经是联系人。。我可能认识的人，根据专业，标签，学校匹配，是当前的用户
	public function maybeknow($id)
	{
		$user=model("member")->user_profile($id,'');
		$mycard=model('member_card')->allcard($id);
		if(!empty($mycard)){
			foreach ($mycard as  $row=>$v){
				$myfriend.=$v['mid'].",";
			}
			$myfriend=rtrim($myfriend,',');//我的联系人字符串
			$where='(school like "%'.$user['school'].'%" or major like "%'.$user['major'].'%") and mid!='.$id.' and mid NOT IN ('.$myfriend.')';
		}else $where='(school like "%'.$user['school'].'%" or major like "%'.$user['major'].'%") and mid!='.$id;
		//我的全部申请，被申请的人
		
		$may=model("member_profile")->select($where,'mid','mid asc','9');//显示9个，其余的用显示更多来显示
		if(!empty($may)){
			foreach ($may as  $row=>$v)
			{
				$may[$row]=model("member")->user_profile($v['mid'],'');
			}
			//$this->mycard=$card;
		}
		return $may;
	}
	
	
	//根据关键字模糊查询匹配用户，姓名、专业、标签、学校，涉及的表member  member_profile  member_tag
	public function findmember($key)
	{
		// and m.id!='.$id  自己也可以找到
		$where='where (m.uname like "%'.$key.'%" or p.school like "%'.$key.'%" or p.major like "%'.$key.'%" or t.name like "%'.$key.'%")';
		//用distinct 去除重复记录
		$sql="SELECT distinct m.id FROM {$this->prefix}member as m left outer join ({$this->prefix}member_tag as t,{$this->prefix}member_profile as p) on (m.id=t.mid AND m.id=p.mid) {$where} order by m.id asc";
		$user= $this->model->query($sql);
		if(!empty($user)){
			foreach ($user as  $row=>$v)
			{
				$user[$row]=model("member")->user_profile($v['id'],'');
			}
		}
		return $user;
	}
}
?>