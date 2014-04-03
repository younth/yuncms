<?php
/*
 * 会员模块的接口文件
 * */
class companyApi extends baseApi{
	
	//获取前台的栏目
  public function getdefaultMenu(){
    return array('name'=>'企业面板','yun'=>'company/index/index');   
  }

  //获取会员管理模块后台管理的栏目
  public function getadminMenu(){
		return array(
              array('name'=>'行业管理','url'=>url('admin/sort/index')),
			  array('name'=>'企业管理','url'=>url('company/admincompany/index')),
			  array('name'=>'待激活企业','url'=>url('company/admincompany/active')),
			  array('name'=>'群发私信','url'=>url('company/admincompany/send_allmsg')),
			 array('name'=>'群发邮件','url'=>url('company/admincompany/sendAll')),
			);
  } 
  
  
}