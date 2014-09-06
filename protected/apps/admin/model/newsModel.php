<?php
class newsModel extends baseModel{
	protected $table = 'news';
	
	public function newsANDadmin($sort='',$keyword='',$starttime,$endtime,$limit=''){
        if(empty($starttime)||empty($endtime)){
            //不能合写，因为starttime/endtime为空报错
            $where='where '.$this->prefix.'news.sort like "%'.$sort.'%" AND '.$this->prefix.'news.title like "%'.$keyword.'%" ';

        }else{
            $where='where '.$this->prefix.'news.sort like "%'.$sort.'%" AND '.$this->prefix.'news.title like "%'.$keyword.'%" AND '.$this->prefix.'news.addtime<='.$endtime.' AND '.$this->prefix.'news.addtime>='.$starttime;
        }
        //除了最高管理员，其他管理员只检索自己发布的新闻。需要与admin表进行连表查询出管理员的真实姓名
        $groupid=$_SESSION[Auth::$config['AUTH_SESSION_PREFIX'].'groupid'];
        if($groupid!=1){
            $username=$_SESSION['admin_username'];
            $where.=' AND '.$this->prefix.'news.account="'.$username.'"';
        }
        $sql="SELECT {$this->prefix}news.id,{$this->prefix}news.sort,{$this->prefix}news.title,{$this->prefix}news.color,{$this->prefix}news.picture,{$this->prefix}news.recmd,{$this->prefix}news.hits,{$this->prefix}news.ispass,{$this->prefix}news.addtime,{$this->prefix}news.method,{$this->prefix}admin.realname FROM {$this->prefix}news left outer join {$this->prefix}admin on {$this->prefix}news.account = {$this->prefix}admin.username  {$where}  ORDER BY {$this->prefix}news.recmd DESC,{$this->prefix}news.norder desc,{$this->prefix}news.id DESC LIMIT {$limit}";
        return $this->model->query($sql);
	}

	public function newscount($sort='',$keyword='',$starttime,$endtime){
        if(empty($starttime)||empty($endtime)){
            $where=empty($keyword)?'sort like "'.$sort.'%"':'title like "%'.$keyword.'%" and sort like "'.$sort.'%"';
        }else{
            //带有时间的检索
            $where=empty($keyword)?"addtime<='$endtime' AND addtime>='$starttime' AND sort like '%$sort%'":"addtime<='$endtime' AND addtime>='$starttime' AND title like '%$keyword%' AND sort like '%$sort%'";
        }
        $groupid=$_SESSION[Auth::$config['AUTH_SESSION_PREFIX'].'groupid'];
        if($groupid!=1){
            $username=$_SESSION['admin_username'];
            $where.=' AND '.$this->prefix.'news.account="'.$username.'"';
        }
		return $this->count($where);
	}
}
?>