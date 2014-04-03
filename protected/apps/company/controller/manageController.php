<?php
/*
 * 企业管理类
 * */
class manageController extends commonController
{
	static protected $company_sort;//公司性质
	static protected $company_scale;//公司规模
	public function __construct()
	{
		parent::__construct();
		$this->company_sort=100054;//公司性质100054
		$this->company_scale=100060;//公司规模100054
	}
	
	//公司管理首页
      public function index()
      {
      	$this->name=$_SESSION['name'];
      	$this->display();
      }
      
      //基本资料管理
      public function info()
      {
      	if(!$this->isPost()){
      		//当前登陆公司的基本资料
      		$id=$_SESSION['company_id'];
      		$info=model('company')->find("id='{$id}'");
      		$this->info=$info;
      		//构造公司性质，寻找某个栏目下面的全部子栏目,利用mysql 字符串函数 find_in_set(),或者利用RIGHt函数
      		//$where="type=5 AND find_in_set('100054',path)";
      		$where="type=5 AND RIGHT(path,6)=".$this->company_sort;
      		$sortlist=model('sort')->select($where,'id,name,path');
      		//dump($sortlist);
      		//循环构造公司性质select option
      		if(!empty($sortlist)){
      			foreach($sortlist as $vo){
      				$quality_option.= '<option value="'.$vo ['id'].'">'.$vo ['name'].'</option>';
      			}
      			$this->quality_option=$quality_option;
      		}
      		unset($where);
      		unset($sortlist);
      		//循环构造公司性质select option
      		$where="type=5 AND RIGHT(path,6)=".$this->company_scale;
      		$sortlist=model('sort')->select($where,'id,name,path');
      		if(!empty($sortlist)){
      			foreach($sortlist as $vo){
      				$company_scale.= '<option value="'.$vo ['id'].'">'.$vo ['name'].'</option>';
      			}
      			$this->company_scale=$company_scale;
      		}
      		
      		$this->display();
      	}else {
      		
      	}
      }
}