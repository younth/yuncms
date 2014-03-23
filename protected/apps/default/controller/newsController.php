<?php
/*
 * 前台新闻控制器
 * */
class newsController extends commonController
{
	public $sorttype=1;//资讯栏目类型
	//新闻列表
	public function index()
	{
		$id=in($_GET['id']);//类别的id
		if(empty($id)) $this->pageerror('404');//错误404页面
		else{
			$sortinfo=model('sort')->find("id='{$id}'",'id,name,path,url,type,deep,tplist,keywords,description');
			if($sortinfo['type']!=$this->sorttype) $this->pageerror('404');//栏目不存在
			$path=$sortinfo['path'].','.$sortinfo['id'];
			$deep=$sortinfo['deep']+1;
		}

		$listRows=empty($sortinfo['url'])?10:intval($sortinfo['url']);//每页显示的信息条数,默认每页十条
		$url=url('news/index',array('id'=>$id,'page'=>'{page}'));
	    $limit=$this->pageLimit($url,$listRows);
	    
		$where="sort LIKE '{$path}%' AND ispass='1'";
		$count=model('news')->count($where);
		$list=model('news')->select($where,'id,title,color,sort,addtime,origin,hits,method,picture,keywords,description','recmd DESC,norder desc,id DESC',$limit);
		//对Lists数组增加url字段  tags字段数组，数组重新处理
		if(!empty($list)){
		   foreach ($list as $key=>$vo) {
			  $list[$key]['url']=url($vo['method'],array('id'=>$vo['id']));
			  $list[$key]['sort']=substr($vo['sort'],-6);
			  if(!empty($vo['keywords'])) $list[$key]['tags']=gettags($vo['keywords']);//没有关键字就用tag
		   }
		}
		//print_r($list);
		$this->daohang=$this->crumbs($path);//面包屑导航
		//print_r($this->daohang);
		
		$this->sortlist=$this->sortArray(0,$deep,$path);//deep+1的子分类信息
		$this->alist=$list;
		$this->num=$count;
		$this->id=$id;
		$this->page=$this->pageShow($count);
		$this->title=$sortinfo['name'].'-'.$this->title;//title标签
		if(!empty($sortinfo['keywords'])) $this->keywords=$sortinfo['keywords'];
		if(!empty($sortinfo['description'])) $this->description=$sortinfo['description'];
		$this->rootid=$this->getrootid($id);//获取根节点id
		//echo $this->rootid;
		$tp=explode(',', $sortinfo['tplist']);//模板列表,分为内容模板与列表模板
		//print_r($tp);
		$this->display($tp[0]);//显示的模板
	}
        
	public function content()
	{
		$id=intval(in($_GET['id']));
		if(empty($id)) $this->pageerror('404');
		$info=model('news')->find("id='{$id}'");//查询对应的新闻
		if(empty($info)) $this->pageerror('404');
        model('news')->update("id='$id'","hits=hits+1");//点击次数+1
        
		//文章分页，kind分页
		$page = new Page();
		$url =url($info['method'],array('id'=>$id));
		//数组content
		//<hr style="page-break-after:always;" class="ke-pagebreak" />  kindeditor的分页
		$info['content'] = $page->contentPage(html_out($info['content']), '<hr style="page-break-after:always;" class="ke-pagebreak" />',$url,10,4); //文章分页
		//print_r($info['content']);
		$sortid=substr($info['sort'],-6,6);//截取最后6个字符,即为对应的sort,这个是直接的上级分类
		//echo $sortid;
		//获取拓展数据结束
        $topsort=substr($info['sort'],0,14); //获取所有的所属分类,前14个字符
        //echo $topsort;
        
		$upnews=model('news')->find("ispass='1'  AND id>'$id' AND sort like '{$topsort}%'",'id,title,method','id ASC');//上一篇
		$downnews=model('news')->find("ispass='1' AND id<'$id' AND sort like '{$topsort}%'",'id,title,method','id DESC');//下一篇
		$crumbs=$this->crumbs($info['sort']);//面包屑导航
		$lastCrumb=end($crumbs);
		
		$this->title=$info['title'].'-'.$lastCrumb['name'].'-'.$this->title;//title标题
		if(!empty($info['keywords'])) {
			$this->keywords=$info['keywords'];
			if(!empty($info['keywords'])) $info['tags']=gettags($info['keywords']);
		}
		if(!empty($info['description'])) $this->description=$info['description'];
		$this->daohang=$crumbs;//面包屑导航
		//print_r($crumbs);
		$this->info=$info;//$info数组赋值给模板
		//print_r($info);
		$this->rootid=substr($info['sort'],8,6);//根分类
		$this->downnews=$downnews;
		$this->upnews=$upnews;
		$this->display($info['tpcontent']);//新闻模板显示输出
	}
}
?>