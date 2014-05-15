<?php

/* 
 * 基本公司任务模型类
 * by jever
 * 2014.3.29
 */
class task_baseModel extends baseModel{
    protected $table='task_base';
    
    //符合条件的任务数
    public function taskcount($name="")
    {
     	$where=(empty($name)?"":"name like '%$name%'");
    	return $this->count($where);
    }
}
