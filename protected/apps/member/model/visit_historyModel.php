<?php
class visit_historyModel extends baseModel{
	protected $table = 'visit_history';
	
	//根据id获得用户信息
	//最近来访,参数是被访问者,联系member,member_profile读取访问者的信息
	public function visitme($bid)
	{
		//$sql="SELECT m.id,m.uname,m.login_email FROM {$this->prefix}member as m,{$this->prefix}visit_history as h WHERE m.id=h.fid AND h.bid='{$bid}' order by h.ctime desc";
		$sql="SELECT m.id,m.uname,m.login_email,p.school,p.major,h.ctime,h.fid FROM {$this->prefix}member as m left outer join ({$this->prefix}visit_history as h,{$this->prefix}member_profile as p) on (m.id=h.fid AND h.fid=p.mid) where h.bid='{$bid}'  ORDER BY h.ctime LIMIT 6";
		return $this->model->query($sql);
	}

}
?>