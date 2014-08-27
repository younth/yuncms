<?php

class feedbackModel extends baseModel{
    protected $table = 'feedback';
    
    //标记已读
    public function readfeedback($id)
    {
    	$sql="update {$this->prefix}feedback set is_reply=1 where id='{$id}'";
    	return $this->model->query($sql);
    }
    

}
