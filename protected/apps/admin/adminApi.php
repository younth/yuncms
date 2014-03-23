<?php
class adminApi extends baseApi{
	
	public function getMenu(){
		return array(
					'sort'=>1,
					'title'=>'示例页面',					
					'list'=>array(
						'添加页面'=>url('demo/add'),
						'列表页面'=>url('demo/index'),
						'配置页面'=>url('demo/config'),
					)
			);
	}
	
	//更新缓存
	public function clearCache(){
	
	}
}