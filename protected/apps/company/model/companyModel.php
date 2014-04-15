<?php
class companyModel extends baseModel{
	protected $table = 'company';
	
	
	//符合条件的会员数
	public function companycount($keyword="",$starttime='',$endtime='')
	{
		if(empty($starttime)||empty($endtime)) $where=(empty($keyword)?'':'name like "%'.$keyword.'%"');
		else  $where=(empty($keyword)?"ctime<='$endtime' AND ctime>='$starttime'":"ctime<='$endtime' AND ctime>='$starttime' AND name like '%$keyword%'");
		return $this->count($where);
	}
	
	//连表查询得到，企业行业信息
	public function company_search($keyword,$starttime,$endtime,$limit)
	{
		if(empty($starttime)||empty($endtime)) $where=(empty($keyword)?'':'name like "%'.$keyword.'%"');
		else  $where=(empty($keyword)?"ctime<='$endtime' AND ctime>='$starttime'":"ctime<='$endtime' AND ctime>='$starttime' AND name like '%$keyword%'");
		return $where;
	}
	
	//推荐关注企业,连表查询,member_profile and company, concat 等同于字符串连接符,注意如何排序
	public function quick_follow($mid)
	{
		// or c.on_industry like concat('%',m.tag,'%')  根据自己的标签选择
		$sql="SELECT c.id,c.name,c.logo,c.quality,c.scale,c.on_industry,c.websites,c.introduce,m.mid,m.major FROM {$this->prefix}member_profile as m,{$this->prefix}company as c WHERE c.on_industry like concat('%',m.major,'%') and mid='{$mid}' ORDER BY c.ctime desc limit 6";
		return $this->model->query($sql);
	}
}
?>