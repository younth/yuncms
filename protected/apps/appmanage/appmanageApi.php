<?php
class appmanageApi extends baseApi{
  public function getadminMenu(){
		return array(
			        array('name'=>'我的应用','url'=>url('appmanage/index/index')),
			        array('name'=>'导入应用','url'=>url('appmanage/index/import')),
			);
	} 
}