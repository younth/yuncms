<?php
class member_cardModel extends baseModel{
	protected $table = 'member_card';
	
	//查询我的联系人信息,三表联合查询 member member_profile member_card
	public function mycard($id)
	{
		$sql="select send_id as mid from {$this->prefix}member_card where status=2 and rece_id='{$id}' union all select rece_id as mid from {$this->prefix}member_card where status=2 and send_id='{$id}'";
		return $this->model->query($sql);
	}
}
?>