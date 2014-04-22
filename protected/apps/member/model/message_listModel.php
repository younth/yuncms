<?php
class message_listModel extends baseModel{
	protected $table = 'message_list';
	
	//查询我参与的私信记录,用concat拼凑然后模糊查询
	public function linkmsg($id)
	{
		$sql="select id,from_mid,ctime,last_message from  {$this->prefix}message_list where member_mid like concat('%','_{$id}','%')";
		return $this->model->query($sql);
	}
	
	//我的所有联系人
	public function allmag_user($id)
	{
		$sql="select send_id as mid from {$this->prefix}member_card where status=2 and rece_id='{$id}' union all select rece_id as mid from {$this->prefix}member_card where status=2 and send_id='{$id}'";
		
	}
}
?>