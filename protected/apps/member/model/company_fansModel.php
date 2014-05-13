<?php
class company_fansModel extends baseModel{
	protected $table = 'company_fans';
	
	//统计会员数
	function fanscount($cid)
	{
		$where="cid={$cid}";
		return $this->count($where);
	}
	
	//根据学生用户的id连表查询company_fans  company的信息
	public function myfollow($id)
	{
		//$sql="SELECT {$this->prefix}member.id,{$this->prefix}member.uname,{$this->prefix}member.regip,{$this->prefix}member.lastip,{$this->prefix}member.ctime,{$this->prefix}member.lasttime,{$this->prefix}member.is_active FROM {$this->prefix}member left outer join {$this->prefix}member_group on {$this->prefix}member.groupid={$this->prefix}member_group.id  {$where} ORDER BY {$this->prefix}member.groupid,{$this->prefix}member.id LIMIT {$limit}";
		$sql="SELECT c.id,c.name,c.logo,c.quality,c.scale,c.on_industry,c.websites,c.introduce FROM {$this->prefix}company_fans as f,{$this->prefix}company as c WHERE c.id=f.cid AND f.mid='{$id}' ORDER BY f.ctime desc";
		return $this->model->query($sql);
	}
	
	//推荐关注，且自己未关注
	public  function corp_recmd($mid)
	{
		$sql="SELECT c.id FROM {$this->prefix}company_fans as f,{$this->prefix}company as c WHERE c.id=f.cid AND f.mid='{$mid}'";
		$my_follow=$this->model->query($sql);
		if(!empty($my_follow)){
			foreach ($my_follow as $vo){
				$my_follows.=$vo['id'].",";//构造我关注的公司数组
			}
			$my_follows=rtrim($my_follows,',');
			unset($sql);
			$sql="select * FROM {$this->prefix}company where id not in ($my_follows) and recmd=1 limit 6";
		}
		
		return $this->model->query($sql);
	}
	
	//企业最新粉丝
	public function corp_latest_fans($cid)
	{
		$sql="SELECT m.id,m.uname FROM {$this->prefix}company_fans as f,{$this->prefix}member as m WHERE m.id=f.mid AND f.cid='{$cid}' ORDER BY f.ctime desc limit 6";
		return $this->model->query($sql);
	}
}
?>