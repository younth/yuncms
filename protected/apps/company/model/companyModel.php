<?php
class companyModel extends baseModel{
	protected $table = 'company';
	
	
	//符合条件的会员数
	public function companycount($keyword="",$starttime,$endtime)
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
}
?>