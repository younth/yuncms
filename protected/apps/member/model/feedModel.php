<?php
/*
 * feed表的模型方法
 * */
class feedModel extends baseModel{
    //baseModel  extends  model  model  $table是model里面的属性
    protected $table = 'feed';
    
    public function adminfeedANDmember($mid=''){
        $where='where '.$this->prefix.'feed.mid ='.$mid;
        $sql="SELECT {$this->prefix}feed.mid,{$this->prefix}member.uname 
            FROM {$this->prefix}feed left outer join {$this->prefix}member on {$this->prefix}feed.mid = {$this->prefix}member.id {$where}";
//        echo $sql;
        return $this->model->query($sql);
    }
}
