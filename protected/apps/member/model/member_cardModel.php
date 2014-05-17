<?php
class member_cardModel extends baseModel{
	protected $table = 'member_card';
	
	//查询我的联系人信息，数组形式
	public function mycard($id)
	{
		$sql="select send_id as mid from {$this->prefix}member_card where status=2 and rece_id='{$id}' union all select rece_id as mid from {$this->prefix}member_card where status=2 and send_id='{$id}'";
		return $this->model->query($sql);
	}
	
	//我的联系人，字符串形式
	public function mycardstring($id)
	{
		$sql="select send_id as mid from {$this->prefix}member_card where status=2 and rece_id='{$id}' union all select rece_id as mid from {$this->prefix}member_card where status=2 and send_id='{$id}'";
		$mycard= $this->model->query($sql);
		if(!empty($mycard)){
			foreach ($mycard as  $row=>$v){
				$myfriend.=$v['mid'].",";
			}
			$myfriend=rtrim($myfriend,',');//我的联系人字符串
		}
		return $myfriend;
	}
	
	//我的联系人总数
	public function myallcard($id)
	{
		$sql="select send_id as mid from {$this->prefix}member_card where status=2 and rece_id='{$id}' union all select rece_id as mid from {$this->prefix}member_card where status=2 and send_id='{$id}'";
		$re=$this->model->query($sql);
		if($re) return count($re);
		else return 0;
	}
	
	//我的所有申请或者被申请的联系人
	public function allcard($id)
	{
		$sql="select send_id as mid from {$this->prefix}member_card where rece_id='{$id}' union all select rece_id as mid from {$this->prefix}member_card where send_id='{$id}'";
		return $this->model->query($sql);
	}
	
	//判断两人是否是联系人
	public function idmyfriend($id,$fid)
	{
		
	}
}
?>