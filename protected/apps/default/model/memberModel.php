<?php
class memberModel extends baseModel{
	protected $table = 'member';
	
	//按条件检索，member left outer join member_group  左连表查询得到会员组信息
	public function memberANDgroup($keyword='',$starttime,$endtime,$limit='')
	{
		/**构造左连接查询的where条件，分为有无时间限制，有无关键字设置**/
		if(empty($starttime)||empty($endtime)) $where=(empty($keyword)?'':'where '.$this->prefix.'member.uname like "%'.$keyword.'%"');
		else $where='where '.$this->prefix.'member.ctime<='.$endtime.' AND '.$this->prefix.'member.ctime>='.$starttime.' AND '.$this->prefix.'member.uname like "%'.$keyword.'%"';
		//else $where=(empty($keyword)?'where '.$this->prefix.'member.ctime<='.$endtime.' AND '.$this->prefix.'member.ctime>='.$starttime.':"");
		
		//现在连表查询只能使用左连接了，不可用where连表了,where连表适合没有其他where条件
		//构造2个表联合查询
		$sql="SELECT {$this->prefix}member.id,{$this->prefix}member.groupid,{$this->prefix}member.uname,{$this->prefix}member.regip,{$this->prefix}member.lastip,{$this->prefix}member.ctime,{$this->prefix}member.lasttime,{$this->prefix}member.is_active,{$this->prefix}member_group.name FROM {$this->prefix}member left outer join {$this->prefix}member_group on {$this->prefix}member.groupid={$this->prefix}member_group.id  {$where} ORDER BY {$this->prefix}member.groupid,{$this->prefix}member.id LIMIT {$limit}";
		return $this->model->query($sql);
	}
	
	
	public function member_group_link($keyword='',$starttime,$endtime,$limit='')
	{
		
		if(empty($starttime)||empty($endtime)) $where=(empty($keyword)?'':'where '.$this->prefix.'member.uname like "%'.$keyword.'%"');
		else $where='where '.$this->prefix.'member.ctime<='.$endtime.' AND '.$this->prefix.'member.ctime>='.$starttime.' AND '.$this->prefix.'member.uname like "%'.$keyword.'%"';
		//else $where=(empty($keyword)?'where '.$this->prefix.'member.ctime<='.$endtime.' AND '.$this->prefix.'member.ctime>='.$starttime.':"");
		//构造三表联合查询
		$sql="SELECT {$this->prefix}member.id,{$this->prefix}member_group_link.user_group_id,{$this->prefix}member.uname,{$this->prefix}member.regip,{$this->prefix}member.lastip,{$this->prefix}member.ctime,{$this->prefix}member.lasttime,{$this->prefix}member.is_active,{$this->prefix}member_group.group_name FROM {$this->prefix}member left outer join ({$this->prefix}member_group,{$this->prefix}member_group_link) on ({$this->prefix}member_group_link.uid={$this->prefix}member.id AND {$this->prefix}member_group_link.user_group_id={$this->prefix}member_group.id)  {$where} ORDER BY {$this->prefix}member.id LIMIT {$limit}";
		//echo $sql;
		return $this->model->query($sql);
	}

	//符合条件的会员数
	public function membercount($keyword="",$starttime,$endtime)
	{
		if(empty($starttime)||empty($endtime)) $where=(empty($keyword)?'':'uname like "%'.$keyword.'%"');
		else  $where=(empty($keyword)?"ctime<='$endtime' AND ctime>='$starttime'":"ctime<='$endtime' AND ctime>='$starttime' AND uname like '%$keyword%'");
		//$where=(empty($keyword)?"ctime<='$endtime' AND ctime>='$starttime'":"ctime<='$endtime' AND ctime>='$starttime' AND uname like '%$keyword%' ");
		//echo $where;
		return $this->count($where);
	}
	
	//待审核用户
	public function active_membercount($keyword="",$starttime,$endtime)
	{
		if(empty($starttime)||empty($endtime)) $where='uname like "%'.$keyword.'%" AND is_active=0';
		else  $where=(empty($keyword)?"ctime<='$endtime' AND ctime>='$starttime'":"ctime<='$endtime' AND ctime>='$starttime' AND uname like '%$keyword%'");
		return $this->count($where);
	}
	
	public function active_member_group_link($keyword='',$starttime,$endtime,$limit='')
	{
		/**构造左连接查询的where条件，分为有无时间限制，有无关键字设置**/
		if(empty($starttime)||empty($endtime)) $where='where '.$this->prefix.'member.uname like "%'.$keyword.'%" AND '.$this->prefix.'member.is_active=0 ';
		else $where='where '.$this->prefix.'member.ctime<='.$endtime.' AND '.$this->prefix.'member.ctime>='.$starttime.' AND '.$this->prefix.'member.uname like "%'.$keyword.'%"';
		//else $where=(empty($keyword)?'where '.$this->prefix.'member.ctime<='.$endtime.' AND '.$this->prefix.'member.ctime>='.$starttime.':"");
		
		//构造三表联合查询
		$sql="SELECT {$this->prefix}member.id,{$this->prefix}member_group_link.user_group_id,{$this->prefix}member.uname,{$this->prefix}member.regip,{$this->prefix}member.lastip,{$this->prefix}member.ctime,{$this->prefix}member.lasttime,{$this->prefix}member.is_active,{$this->prefix}member_group.group_name FROM {$this->prefix}member left outer join ({$this->prefix}member_group,{$this->prefix}member_group_link) on ({$this->prefix}member_group_link.uid={$this->prefix}member.id AND {$this->prefix}member_group_link.user_group_id={$this->prefix}member_group.id)  {$where} ORDER BY {$this->prefix}member.id LIMIT {$limit}";
		return $this->model->query($sql);
	}
		
	//查询指定用户信息
	public function find_link($id)
	{
		//构造三表联合查询
		$sql="SELECT {$this->prefix}member.id,{$this->prefix}member_group_link.user_group_id,{$this->prefix}member.uname,{$this->prefix}member.password,{$this->prefix}member.tel,{$this->prefix}member.ctime,{$this->prefix}member.lasttime,{$this->prefix}member.is_active,{$this->prefix}member.login_email,{$this->prefix}member.qq FROM {$this->prefix}member left outer join ({$this->prefix}member_group,{$this->prefix}member_group_link) on ({$this->prefix}member_group_link.uid={$this->prefix}member.id AND {$this->prefix}member_group_link.user_group_id={$this->prefix}member_group.id)  WHERE  {$this->prefix}member.id={$id} ";
		$user= $this->model->query($sql);
		return $user[0];//$user是二维数组，应该返回一维数组显示会员信息
	}
	
	
	//前台和用户登录
}
?>