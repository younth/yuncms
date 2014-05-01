<?php
class message_listModel extends baseModel{
	protected $table = 'message_list';
	
	//我的所有私信联系人
	public function allmag_user($id)
	{
		$sql="select rece_mid as mid,last_message as msg,id as list_id, ctime as time from {$this->prefix}message_list where from_mid='{$id}' union all select from_mid as mid,last_message as msg ,id as list_id,ctime as time from {$this->prefix}message_list where rece_mid='{$id}'";
		return $this->model->query($sql);
	}
	
	//我的私信联系人
	
}
?>