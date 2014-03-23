<?php
/**
 *
 * @author wy
 * @version 
 */
class placeController extends commonController
{
	/*信息位管理开始
	 * 内容定位是对首页的轮播图片，banner一些经常更换的图片新闻进行管理
	* 发新闻可以选择为首页幻灯或者banner
	* */
	public function placelist(){
		$listRows=20;//每页显示的信息条数
		$url=url('place/placelist',array('page'=>'{page}'));
		$limit=$this->pageLimit($url,$listRows);
	
		$count=model('place')->count();
		$list=model('place')->select('','id,name,norder','norder DESC,id DESC',$limit);
		$this->page=$this->pageShow($count);
		$this->list=$list;
		$this->display();
	}
	
	public function placeadd(){
		if(!$this->isPost())
		{
			$this->t_name="添加";
			$this->display("place_placeedit");
		}
		else{
			if(empty($_POST['name'])) $this->error('必须填写位置名称~');
			$data['name']=in($_POST['name']);
			$data['norder']=intval($_POST['norder']);
			//插入数据
			if(model('place')->insert($data)) $this->success('信息定位添加成功~',url('place/placelist'));
			else $this->error('信息定位添加失败~');
		}
	}
	
	public function placeedit(){
		$id=intval($_GET['id']);//修改用的id
		if(empty($id)) $this->error('参数错误');
		
		if(!$this->isPost())
		{
			$info=model('place')->find("id='$id'");
			$this->info=$info;
			$this->t_name="编辑";
			$this->display();
		}else{
			if(empty($_POST['name'])) $this->error('必须填写位置名称~');
			$data['name']=in($_POST['name']);
			$data['norder']=intval($_POST['norder']);
			//插入数据
			if(model('place')->update("id='$id'",$data)) $this->success('信息定位编辑成功~',url('place/placelist'));
			else $this->error('信息定位编辑失败~');
		}
	}
	
	public function placedel(){
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('参数错误');
		if(model('place')->delete("id='$id'")) $this->success('定位类型删除成功~',url('place/placelist'));
		$this->error('删除失败~');
	}	
}