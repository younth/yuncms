<?php

/* 
 * 企业特定任务模型
 * by jever
 * 2014.3.30
 */
class task_customModel extends baseModel{
    protected $table='task_custom';
    
    public function taskcustomAndCompany($condition='',$limit='10',$order=' ctime desc') {
        if(!empty($condition)){
        $sql="select * from {$this->prefix}task_custom inner join {$this->prefix}company where {$condition} limit {$limit} order by {$order}";
        }
        else{ $sql="select * from {$this->prefix}task_custom inner join {$this->prefix}company on({$this->prefix}task_custom.cid = {$this->prefix}company.id)";}
        return $this->query($sql);
    }
    
//    public function with($withTable= '',$withField=''){
//            $result=  model($this->table)->select();
//            $resultWith=  model($withTable)->select($withField=$result[$withField]);
////            $result[$withTable]=$resultWith;
//            return $resultWith;
//        }
}
