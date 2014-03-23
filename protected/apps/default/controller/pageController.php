<?php
/*
 * 单页模型
 * */
class pageController extends commonController
{
	public $sorttype=3;//资讯栏目类型
	public function index()
	{
		$id=in($_GET['id']);
		//echo $id;
		if(empty($id)) $this->pageerror('404');
        $sortinfo=model('sort')->find("id='{$id}'",'id,path,type,deep,method,name,keywords,description,tplist');
        //print_r($sortinfo);
        //type=3是单页，只显示单页
        if($sortinfo['type']!=$this->sorttype) $this->pageerror('404');
        $deep=$sortinfo['deep']+1;
        //$path是这种形式，因为page表的sort存储的是这样的形式
		$path=$sortinfo['path'].','.$sortinfo['id'];
		//echo $path;
		$info=model('page')->find("sort='{$path}'");
		//print_r($info);
		$info['title']=$sortinfo['name'];
		//文章分页
		$page = new Page();
		$url = url($sortinfo['method'],array('id'=>$id,'page'=>'{page}'));
		//$info[content]数组
		$info['content'] = $page->contentPage(html_out($info['content']), '<hr style="page-break-after:always;" class="ke-pagebreak" />',$url,10,4); //文章分页
		
		$this->sortlist=$this->sortArray(0,$deep,$path);//子分类信息
		//print_r($this->sortlist);
		$this->daohang=$this->crumbs($info['sort']);//面包屑导航
		//print_r($this->daohang);
        $this->title=$sortinfo['name'].'-'.$this->title;//title标签
        
		if(!empty($sortinfo['keywords'])) $this->keywords=$sortinfo['keywords'];
		if(!empty($sortinfo['description'])) $this->description=$sortinfo['description'];
		$this->info=$info;
		$this->rootid=$this->getrootid($_GET['id']);//根节点id
		$this->display($sortinfo['tplist']);
	}
}
?>