<?php
class member_cardModel extends baseModel{
	protected $table = 'member_card';
	
	//查询我的联系人信息
	public function mycard($id)
	{
		$sql="select send_id as mid from {$this->prefix}member_card where status=2 and rece_id='{$id}' union all select rece_id as mid from {$this->prefix}member_card where status=2 and send_id='{$id}'";
		return $this->model->query($sql);
	}
	//我的所有申请或者被申请的联系人
	public function allcard($id)
	{
		$sql="select send_id as mid from {$this->prefix}member_card where rece_id='{$id}' union all select rece_id as mid from {$this->prefix}member_card where send_id='{$id}'";
		return $this->model->query($sql);
	}
}
?>