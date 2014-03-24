<?php
class company_fansModel extends baseModel{
	protected $table = 'company_fans';
	
	//统计会员数
	function fanscount($cid)
	{
		$where="cid={$cid}";
		return $this->count($where);
	}
}
?>