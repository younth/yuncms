<?php
class newsModel extends baseModel{
	protected $table = 'news';
	
	public function newsANDadmin($sort='',$keyword='',$limit=''){
		$where=empty($sort)?(empty($keyword)?'':'where '.$this->prefix.'news.title like "%'.$keyword.'%"'):'where '.$this->prefix.'news.sort like "'.$sort.'%"';
		$sql="SELECT {$this->prefix}news.id,{$this->prefix}news.sort,{$this->prefix}news.title,{$this->prefix}news.color,{$this->prefix}news.picture,{$this->prefix}news.recmd,{$this->prefix}news.hits,{$this->prefix}news.ispass,{$this->prefix}news.addtime,{$this->prefix}news.method,{$this->prefix}admin.realname FROM {$this->prefix}news left outer join {$this->prefix}admin on {$this->prefix}news.account = {$this->prefix}admin.username  {$where}  ORDER BY {$this->prefix}news.recmd DESC,{$this->prefix}news.norder desc,{$this->prefix}news.id DESC LIMIT {$limit}";
		//echo $sql;
		return $this->model->query($sql);
	}
	
	public function newscount($sort='',$keyword=''){
		$where=empty($sort)?(empty($keyword)?'':'title like "%'.$keyword.'%"'):'sort like "'.$sort.'%"';
		return $this->count($where);
	}
}
?>